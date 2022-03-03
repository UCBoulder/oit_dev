#!/bin/sh

# Fail on error
set -e

echo "--------- Directory looking /root/.config -------------"
ls -al /root/.config
echo "--------- Directory looking /root/.config/composer -------------"
ls -al /root/.config/composer
echo "--------- Directory looking /root/.config/composer/vendor/bin -------------"
ls -al /root/.config/composer/vendor/bin
echo "--------- /Directory looking -------------"
composer validate
composer global require drupal/coder
composer global require overtrue/phplint
export PATH="$PATH:$HOME/.config/composer/vendor/bin"
echo "--------- CS O'Clock -------------"
phpcs --standard=Drupal,DrupalPractice ./
