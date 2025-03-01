<?php

if (!defined('ABSPATH')) {
  exit;
}

return [
  'show_resulTS' => [
      'label' => 'Show resultS',
      'type' => 'number',
      'default' => 1,
  ],
  'post_types_to_search' => [
      'label' => 'Enabled post types to search',
      'type' => 'checkbox_list',
      'default' => ['post', 'page'],
  ],
  'just_text_value'=> [
      'label' => 'Just text value',
      'type' => 'text',
      'default' => 'Defaule text value',
  ],
];