<?php
/**
 * Plugin Name: ZEN Plugin
 * Description: ZEN Plugin - blank template.
 * Version:     1.0.0
 * Author:      Dmitry Conquer
 */

 if (!defined('ABSPATH')) {
  die;
}

define('ZEN_PLUGIN_MAIN_FILE', plugin_dir_path(__FILE__));
define('ZEN_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('ZEN_PLUGIN_URL', plugin_dir_url(__FILE__));
define('ZEN_PLUGIN_BASENAME', plugin_basename(__FILE__));

require_once ZEN_PLUGIN_PATH . 'includes/admin/admin-settings.php';
require_once ZEN_PLUGIN_PATH . 'includes/admin/settings-page.php';
require_once ZEN_PLUGIN_PATH . 'includes/admin/enqueue-assets.php';

function zen_plugin_init() {
  new ZEN_AdminSettings();
  new ZEN_SettingsPage();
  new ZEN_EnqueueAssets();
}
add_action('plugins_loaded', 'zen_plugin_init');