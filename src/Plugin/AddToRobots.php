<?php

namespace Drupal\oit_dev\Plugin;

/**
 * Create file to add to robots.txt.
 */
class AddToRobots {

  /**
   * Function to pull in archived news to add to add to robots.txt.
   */
  public function __construct() {
    $news_archive = \Drupal::entityQuery('node');
    $news_archive->condition('field_news_archive', 3);
    $news_results = $news_archive->execute();
    $news_archive_string = "# Paths OIT\n";
    $news_archive_string .= "Disallow: /taxonomy/term/*\n";
    $news_archive_string .= "Disallow: /node?page=*\n";
    $news_archive_string .= "Disallow: /tutorial/hotmail-configure-outlook-windows?page=2\n";
    $news_archive_string .= "Disallow: /tutorial/hotmail-configure-outlook-windows?page=3\n";
    $news_archive_string .= "Disallow: /it-security/email-phishing/*\n";
    $news_archive_string .= "# Archived news nodes\n";
    foreach ($news_results as $news_result) {
      $news_archive_string .= "Disallow: /node/$news_result\n";
    }
    file_put_contents('../add-to-robots.txt', $news_archive_string);
    return 'Created maybe';
  }

}
