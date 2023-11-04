<?php

/**
 * Plugin Name: Star Wars Starships
 * Version: 1.0.0
 * Author: Liav Rozenberg
 * Description: A task from an interview, the purpose of this plugin is to show on choosen pages list of Star Wars starships
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
  die;
}

require_once dirname(__FILE__) . '/fields/option-page.php';
require_once dirname(__FILE__) . '/ui/display-starships.php';

class StarWarsPlugin
{
  public function __construct()
  {
    $this->init();
  }

  private function init()
  {
    add_action('wp_enqueue_scripts', [$this, 'register_plugin_assets']);
    add_action('template_redirect', [$this, 'render_starships_ui']);
  }

  public function register_plugin_assets()
  {
    wp_enqueue_script('sw-script',  plugins_url('/sw-list-plugin/src/javascript/sw.js'));
    wp_enqueue_style('sw-style',  plugins_url('/sw-list-plugin/src/css/sw.css'));
  }

  public function render_starships_ui()
  {
    if (get_the_ID() == get_option('selected_page_id') && !is_admin()) {
      ob_start();
      display_starships();
      $ui_content = ob_get_clean();
      echo $ui_content;
    }
  }
}

add_action('wp', function () {
  $swp = new StarWarsPlugin();
});
