<?php

/**
 * @file
 * Hooks provided by Nuke Drupal Frontend module.
 */

/**
 * @addtogroup hooks
 * @{
 */

/**
 * Defines a default white list of allowed paths to be spared.
 *
 * @return array
 *   A list of internal drupal path patterns, suitable for the $patterns param
 *   of drupal_match_path(). Invocations of this hook will explode the array
 *   with "\n", so just return an array.
 *
 * @see ndf_menu_alter()
 */
function hook_ndf_allowed_paths() {
  $allowed_paths = array();

  // Example: Allow private files directory.
  $allowed_paths[] = file_stream_wrapper_get_instance_by_scheme('private')->getDirectoryPath() . '*';

  // Example: Allow some Devel menu paths.
  $allowed_paths[] = 'devel/cache/clear';
  $allowed_paths[] = 'node/*/devel';

  return $allowed_paths;
}

/**
 * Implements hook_ndf_entity_remap().
 *
 * @return array
 *   An associative of entity remap info, keyed by entity type including:
 *   - path: The entity view URI.
 *   - tab_root: Optional. See hook_menu() item tab_root key.
 *   - position: The entity's wildcard object loader position. Will be used as
 *     the $position param to call menu_get_object().
 *   - redirect: The redirect path pattern. The wildcard will be replaced with
 *     the menu loaded entity's ID.
 */
function hook_ndf_entity_remap() {
  return array(
    'my_entity' => array(
      'path' => 'my_entity/%my_entity/view',
      'tab_root' => 'my_entity/%my_entity',
      'position' => 1,
      'redirect' => 'my_entity/%my_entity/edit',
    ),
  );
}

/**
 * @} End of "addtogroup hooks".
 */
