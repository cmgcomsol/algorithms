#! /bin/sh
sudo snap refresh 
sudo apt-get --yes --force-yes update
sudo apt-get --yes --force-yes full-upgrade
sudo apt-get --yes --force-yes dist-upgrade
sudo apt-get --yes --force-yes autoremove
sudo apt-get clean

