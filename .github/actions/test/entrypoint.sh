#!/bin/sh

# Fail on error
set -e

composer require drupal/coder ^8.3
ls vendor/bin
vendor/bin/phpcs --standard=Drupal,DrupalPractice ./
