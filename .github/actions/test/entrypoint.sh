#!/bin/sh

# Fail on error
set -e

composer global show -P
ls ~/
vendor/bin/phpcs --standard=Drupal,DrupalPractice ./
