<?php

if (!defined('ABSPATH')) {
  die;
}


class ZEN_AdminSettings
{

  public function __construct()
  {
    add_action('wp_ajax_get_search_data', [$this, 'get_search_data']);
    add_action('wp_ajax_nopriv_get_search_data', [$this, 'get_search_data']);
    add_filter('plugin_action_links_' . ZEN_PLUGIN_BASENAME, [$this, 'add_plugin_setting_link']);
  }

  public function add_plugin_setting_link($links)
  {
    $custom_link = '<a href="admin.php?page=zen_settings_page">Settings</a>';
    array_push($links, $custom_link);
    return $links;
  }

  public function get_search_data()
  {
    $optins = get_option('zen_settings_options');
    $showItems = $optins['show_search_items'] ?? 5;
    $enabled_post_types = $optins['enabled_post_types'] ?? ['pages', 'posts'];

    $post_type_map = [
      'post' => 'posts',
      'page' => 'pages',
      'attachment' => 'media',
      'user' => 'users',
    ];

    $api_post_types = array_map(function ($post_type) use ($post_type_map) {
      return $post_type_map[$post_type] ?? $post_type;
    }, $enabled_post_types);


    $data = [
      'siteName' => parse_url(site_url(), PHP_URL_HOST),
      'postTypes' => $api_post_types,
      'showItems' => $showItems,
    ];
    wp_send_json($data);
  }
}