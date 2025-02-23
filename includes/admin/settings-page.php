<?php
if (!defined('ABSPATH')) {
  die;
}

class ZEN_SettingsPage
{

  private array $fields = [
    'title' => ['label' => 'Title', 'type' => 'text'],
    'results_per_view' => ['label' => 'Results per view', 'type' => 'number'],
  ];

  public function __construct()
  {
    add_action('admin_menu', [$this, 'register_settings_page']);
    add_action('admin_init', [$this, 'register_settings']);
  }

  public function register_settings_page()
  {
    add_menu_page(
      'ZEN Settings Page',
      'ZEN',
      'manage_options',
      'zen_settings_page',
      [$this, 'zen_page'],
      'dashicons-admin-multisite',
      100
    );
  }

  public function register_settings()
  {
    register_setting('zen_settings', 'zen_settings_options');
    add_settings_section('zen_settings_section', 'Settings', [$this, 'settings_section_html'], 'zen_settings_page');
    foreach ($this->fields as $field_id => $field) {
      add_settings_field(
        $field_id,
        $field['label'],
        [$this, 'render_field'],
        'zen_settings_page',
        'zen_settings_section',
        ['id' => $field_id, 'type' => $field['type']]
      );
    }
  }

  public function render_field(array $args)
  {
    $field_id = esc_attr($args['id']);
    $field_type = $args['type'];
    $options = get_option('zen_settings_options', []);
    $value = $options[$field_id] ?? '';

    if ($field_type === 'checkbox') {
      $checked = checked($value, '1', false);
      echo "<input type='checkbox' id='{$field_id}' name='zen_settings_options[{$field_id}]' value='1' {$checked} />";
    } else {
      echo "<input type='{$field_type}' id='{$field_id}' name='zen_settings_options[{$field_id}]' value='" . esc_attr($value) . "' />";
    }
  }

  public function settings_section_html(){
    echo 'Section title';
}


  public function zen_page()
  {
    require_once ZEN_PLUGIN_PATH . 'includes/admin/templates/settings-page.php';
  }
}
