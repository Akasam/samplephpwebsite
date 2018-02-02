<?php

/**
 * Displays site name.
 */
function siteName()
{
    echo config('name');
}

/**
 * Displays site version.
 */
function siteVersion()
{
    echo config('version');
}

/**
 * Website navigation.
 */
function navMenu($sep = ' | ')
{
    $nav_menu = '';

    foreach (config('nav_menu') as $uri => $name) {
        $nav_menu .= '<a href="/'.(config('pretty_uri') || $uri == '' ? '' : '?page=').$uri.'">'.$name.'</a>'.$sep;
    }

    echo trim($nav_menu, $sep);
}

/**
 * Displays page title. It takes the data from 
 * URL, it replaces the hyphens with spaces and 
 * it capitalizes the words.
 */
function pageTitle()
{
    $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'Home';
    if($page == '/') $page = 'home';

    echo ucwords(str_replace('/', '', str_replace('-', ' ', $page)));
}

/**
 * Displays page content. It takes the data from 
 * the static pages inside the pages/ directory.
 * When not found, display the 404 error page.
 */
function pageContent()
{
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

    if($page == '/') $page = 'home';

    $path = getcwd().'/'.config('content_path').'/'.$page.'.php';

    if (file_exists(filter_var($path, FILTER_SANITIZE_URL))) {
        include $path;
    } else {
        include config('content_path').'/404.php';
    }
}

/**
 * Check for required versions.
 */
function checkRequiredVersions()
{
    $nginx_version = $_SERVER['SERVER_SOFTWARE'];
    $nginx_required_version = config('nginx_version');
    $php_version = $_SERVER['PHP_VERSION'];
    $php_required_version = config('php_version');

//    printf("NGINX Version: %s /// %s\n", $nginx_version, $nginx_required_version);
//    printf("PHP Version: %s /// %s\n", $php_version, $php_required_version);

    if(strpos($nginx_version, $nginx_required_version) === false)
        die("Wrong NGINX Version");

    if(strpos($php_version, $php_required_version) === false)
        die("Wrong PHP Version");

    $extensions = config('php_modules');
    foreach ($extensions as $extension) {
        if(!extension_loaded($extension))
            die("Missing PHP Extension");
    }

    $mysqli = new mysqli("db", config('db_user'), config('db_password'));
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $mariadb_version = $mysqli->server_info;
    $mariadb_required_version = config('mariadb_version');
    $mysqli->close();

    if(strpos($mariadb_version, $mariadb_required_version) === false)
        die("Wrong MariaDB Version");
}

/**
 * Starts everything and displays the template.
 */
function run()
{
    checkRequiredVersions();
    include config('template_path').'/template.php';
}

