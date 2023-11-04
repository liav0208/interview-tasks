<?php


function sw_list_option_page()
{
  add_menu_page(
    'Star Wars Starships', // Page title
    'Star Wars Starships', // Menu title
    'manage_options', // Capability required to access
    'sw-list', // Menu slug
    'display_options_page',
    'dashicons-star-filled'
  );
}

function display_options_page()
{
?>
  <div>
    <h1>Star Wars Starships Plugin</h1>
    <form method="post" action="options.php">
      <?php
      settings_fields('plugin-settings-group');
      do_settings_sections('plugin-settings');
      submit_button('Save Page');
      ?>
    </form>
  </div>
<?php
}

function plugin_settings_init()
{
  register_setting('plugin-settings-group', 'selected_page_id', 'sanitize_callback');
  add_settings_section('page_section', 'Page Selection', 'page_section_callback', 'plugin-settings');
  add_settings_field('page_id_field', 'Select a Page', 'page_id_field_callback', 'plugin-settings', 'page_section');
}

function page_section_callback()
{
  echo 'Choose the page you want to select.';
}

function page_id_field_callback()
{
  $selected_page_id = get_option('selected_page_id');
  $args = array(
    'selected' => $selected_page_id, // The currently selected page
    'name' => 'selected_page_id',
    'show_option_none' => 'Select a Page',
  );
  wp_dropdown_pages($args);
}

function sanitize_callback($input)
{
  // Ensure that the selected page ID is a valid integer
  return is_numeric($input) ? intval($input) : '';
}


add_action('admin_init', 'plugin_settings_init');
add_action('admin_menu', 'sw_list_option_page');
