#!/bin/sh

# Fail on error
set -e

composer require dealerdirect/phpcodesniffer-composer-installer ^0.7.0
ls vendor/bin
vendor/bin/phpcs --standard=Drupal,DrupalPractice ./
