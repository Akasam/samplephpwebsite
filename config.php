<?php

/**
 * Used to store website configuration information.
 *
 * @var string
 */
function config($key = '')
{
    $config = [
        'name' => 'Simple PHP Website',
        'nav_menu' => [
            '' => 'Home',
            'about-us' => 'About Us',
            'products' => 'Products',
            'contact' => 'Contact',
        ],
        'template_path' => 'template',
        'content_path' => 'content',
        'pretty_uri' => true,
        'version' => 'v2.0',
        'nginx_version' => 'nginx/1.12',
        'php_version' => '7.1',
        'php_modules' => ['mysqli', 'gd'],
        'mariadb_version' => '10.1',
        'db_user' => 'php_user',
        'db_password' => 'sdrugntqqsciur',
    ];

    return isset($config[$key]) ? $config[$key] : null;
}
