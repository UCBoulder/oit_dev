#!/bin/sh

# Fail on error
set -e

composer require dealerdirect/phpcodesniffer-composer-installer ^0.7.0
composer require drupal/coder
ls vendor/bin
vendor/bin/phpcs --standard=Drupal,DrupalPractice ./
