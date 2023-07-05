<?php

namespace Drupal\oit_dev\Plugin;

use Drupal\Core\Entity\EntityTypeManagerInterface;

/**
 * Create file to add to robots.txt.
 */
class AddToRobots {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Function to pull in archived news to add to add to robots.txt.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager) {
    $this->entityTypeManager = $entity_type_manager;
    $node = $this->entityTypeManager->getStorage('node');
    $query = $node->getQuery();
    $query->condition('field_news_archive', 3);
    $query->accessCheck(FALSE);
    $news_results = $query->execute();
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
    file_put_contents('../blt/assets/robots.append.txt', $news_archive_string);
    return 'Created maybe';
  }

}
