<?php

/**
 * @file
 * Aurora template overrides file.
 */

/**
 * Override or insert variables into the maintenance page template.
 *
 * @param array $vars
 *   An array of variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
function feather_preprocess_maintenance_page(&$vars, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  // feather_preprocess_html($variables, $hook);
  // feather_preprocess_page($variables, $hook);
  //
  // This preprocessor will also be used if the db is inactive. To ensure your
  // theme is used, add the following line to your settings.php file:
  // $conf['maintenance_theme'] = 'feather';
  // Also, check $vars['db_is_active'] before doing any db queries.
}

/**
 * Implements hook_modernizr_load_alter().
 */
// function feather_modernizr_load_alter(&$load) {}

/**
 * Implements hook_preprocess_html().
 */
// function feather_preprocess_html(&$vars) {}

/**
 * Implements hook_preprocess_page().
 */
function feather_preprocess_page(&$vars) {
  // global $base_path, $base_url;
  // $theme_path = drupal_get_path('theme', 'feather');

  // H&FJ Fonts
  drupal_add_css('//cloud.typography.com/6578432/747402/css/fonts.css', array('group' => CSS_THEME, 'type' => 'external'));
}

/**
 * Override or insert variables into the page template.
 */
// function feather_process_page(&$vars) {}

/**
 * Override or insert variables into the region templates.
 *
 * @param array $vars
 *   An array of variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("region" in this case.)
 */
// function feather_preprocess_region(&$vars, $hook) {}

/**
 * Override or insert variables into the block templates.
 *
 * @param array $vars
 *   An array of variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("block" in this case.)
 */
// function feather_preprocess_block(&$vars, $hook) {}

/**
 * Implements template_preprocess_views_view_fields().
 */
// function feather_preprocess_views_view_fields(&$vars) {}

/**
 * Override or insert variables into the entity template.
 *
 * @param array $vars
 *   An array of variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("entity" in this case.)
 */
// function feather_preprocess_entity(&$vars, $hook) {}

/**
 * Override or insert variables into the node template.
 *
 * @param array $vars
 *   An array of variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("node" in this case.)
 */
function feather_preprocess_node(&$vars, $hook) {
  $vars['theme_hook_suggestions'][] = 'node__' . $vars['node']->type . '__' . $vars['view_mode'];
  $vars['classes_array'][] = $vars['type'];
  $vars['classes_array'][] = "_" . $vars['type'];
  // dpm($vars);
}

/**
 * Override or insert variables into the field template.
 *
 * @param array $vars
 *   An array of variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("field" in this case.)
 */
function feather_preprocess_field(&$vars, $hook) {
  if (isset($vars['items'][0]['node'])) {
    $node = reset($vars['items'][0]['node']);
    $vars['theme_hook_suggestions'][] = 'field__' .  $vars['element']['#field_name'] . '__' . $node['#view_mode'];
  }
  // dpm($vars);

  // paths
  $vars['base_path'] = base_path();
  $vars['theme_path'] = path_to_theme();

  /* Set shortcut variables. Hooray for less typing! */
  /* reference: http://atendesigngroup.com/blog/adding-css-classes-fields-drupal */
  $name = $vars['element']['#field_name'];
  $bundle = $vars['element']['#bundle'];
  $mode = $vars['element']['#view_mode'];

  // /* Uncomment the lines below to see variables you can use to target a field */
  // print '<strong>Name:</strong> ' . $name . '<br/>';
  // print '<strong>Bundle:</strong> ' . $bundle  . '<br/>';
  // print '<strong>Mode:</strong> ' . $mode .'<br/>';

  /* Add specific classes to targeted fields */
  // switch ($bundle) {
  //   case 'client' :
  //     switch ($name) {
  //       case 'field_link' :
  //         switch ($mode) {
  //           case 'full' :
  //             dpm($vars);
  //             // $vars['attributes_array']['data-eq-pts'] = 'medium: 580, large: 750';
  //             break;
  //         }
  //         break;
  //     }
  //     break;
  // }

  switch ($name) {
    case 'field_email' :
      switch ($bundle) {
        case 'user' :
          foreach ($vars['items'] as &$item) {
            $item = l(t('Contact Form'), 'user/' . $vars['element']['#object']->uid . '/contact');
          }
          break;
      }
      break;
  }
}

/**
 * Override or insert variables into the comment template.
 *
 * @param array $vars
 *   An array of variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
// function feather_preprocess_comment(&$vars, $hook) {}

/**
 * Override or insert variables into the views template.
 *
 * @param array $vars
 *   An array of variables to pass to the theme template.
 */
// function feather_preprocess_views_view(&$vars) {}

/**
 * Override or insert css on the site.
 *
 * @param array $css
 *   An array of all CSS items being requested on the page.
 */
// function feather_css_alter(&$css) {}

/**
 * Override or insert javascript on the site.
 *
 * @param array $js
 *   An array of all JavaScript being presented on the page.
 */
// function feather_js_alter(&$js) {}

/**
 * Implements hook_preprocess_image().
 */
function feather_preprocess_image(&$variables) {
  // Adds the RDF type for image. We cannot use the usual entity-based mapping
  // to get 'foaf:Image' because image does not have its own entity type or
  // bundle.
  if (isset($variables['style_name']) && $variables['style_name'] == 'footer_promo_image') {
    unset($variables['width']);
    unset($variables['height']);
  }
}


/**
 * Implements hook_preprocess_panels_pane().
 */
// function feather_preprocess_panels_pane(&$vars) {}


function feather_preprocess_file_entity(&$vars) {
  if($vars['view_mode'] == 'media_link') {
    $vars['classes_array'][] = "file-download--image";
  }
}
