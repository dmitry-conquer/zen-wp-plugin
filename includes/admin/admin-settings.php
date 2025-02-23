<?php

if (!defined('ABSPATH')) {
  die;
}


class ZEN_AdminSettings {

  public function __construct() {
    add_filter('plugin_action_links_'.ZEN_PLUGIN_BASENAME, [$this,'add_plugin_setting_link']);  
  }

  public function add_plugin_setting_link($links) {
    $custom_link = '<a href="admin.php?page=zen_settings_page">Settings</a>';
    array_push($links, $custom_link);
    return $links;
  }
  
}
