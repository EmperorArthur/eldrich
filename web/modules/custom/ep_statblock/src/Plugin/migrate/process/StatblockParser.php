<?php

namespace Drupal\ep_statblock\Plugin\migrate\process;

use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;

/**
 * Parses a simple damage string into its component parts.
 *
 * @MigrateProcessPlugin(
 *   id = "stat_block",
 *   handle_multiples = FALSE
 * )
 *
 * @ingroup migration
 */
class StatBlockParser extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    $value = strtolower(str_replace(' ', '', $value));
    $raw = explode(',', $value);
    $results = [];
    foreach ($raw as $pair) {
      $kv = explode(':', $pair);
      $results[$kv[0]] = $kv[1];
    }
    return $results;
  }

  /**
   * {@inheritdoc}
   */
  public function multiple() {
    return FALSE;
  }
}
