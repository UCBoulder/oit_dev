#!/bin/sh

# Fail on error
set -e

echo "--------- Directory looking / -------------"
ls -al /
echo "--------- Directory looking /home-------------"
ls -al /home
echo "--------- Directory looking /root-------------"
ls -al /root
echo "--------- /Directory looking -------------"
composer validate
composer global require drupal/coder
composer global require overtrue/phplint
export PATH="$PATH:$HOME/.config/composer/vendor/bin"
echo "--------- CS O'Clock -------------"
phpcs --standard=Drupal,DrupalPractice ./
