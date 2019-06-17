#!/bin/bash
wget -O v1.tgz https://git.io/fjaro
wget -O v2.tgz https://git.io/fjari
wget -O v3.tgz https://git.io/fjarM

mkdir v1
mkdir v2
mkdir v3

tar xvfz v1.tgz -C v1
tar xvfz v2.tgz -C v2
tar xvfz v3.tgz -C v3

