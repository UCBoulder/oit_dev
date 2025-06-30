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

    $node = $this->entityTypeManager->getStorage('node');
    $query = $node->getQuery();
    $query->condition('type', 'service_alert');
    $query->condition('created', strtotime('-2 years'), '<');
    $query->accessCheck(FALSE);
    $sa_results = $query->execute();

    $disallow_string = "# Paths OIT\n";
    $disallow_string .= "Disallow: /taxonomy/term/*\n";
    $disallow_string .= "Disallow: /node?page=*\n";
    $disallow_string .= "Disallow: /tutorial/hotmail-configure-outlook-windows?page=2\n";
    $disallow_string .= "Disallow: /tutorial/hotmail-configure-outlook-windows?page=3\n";
    $disallow_string .= "Disallow: /it-security/email-phishing/*\n";
    $disallow_string .= "Disallow: /services/search\n";
    $disallow_string .= "Disallow: /tutorial/search\n\n";

    $disallow_string .= "# Archived news nodes\n";
    foreach ($news_results as $news_result) {
      $disallow_string .= "Disallow: /node/$news_result\n";
    }

    $disallow_string .= "# Service alerts over 2 years old\n";
    foreach ($sa_results as $sa_result) {
      $disallow_string .= "Disallow: /node/$sa_result\n";
    }

    file_put_contents('../robo/assets/robots.append.txt', $disallow_string);
  }

}
