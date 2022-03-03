#!/bin/sh

# Fail on error
set -e

composer global require drupal/coder
export PATH="$PATH:$HOME/.config/composer/vendor/bin"
phpcs --standard=Drupal,DrupalPractice ./
