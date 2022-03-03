#!/bin/sh

# Fail on error
set -e

composer global require drupal/coder
composer global require overtrue/phplint
export PATH="$PATH:$HOME/.config/composer/vendor/bin"
echo "--------- Lint O'Clock -------------"
phplint --no-cache -v ./
echo "--------- CS O'Clock -------------"
phpcs --standard=Drupal,DrupalPractice ./
