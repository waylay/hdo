<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Enable features from Soil when plugin is activated
  // https://roots.io/plugins/soil/
  add_theme_support('soil-clean-up');
  add_theme_support('soil-nav-walker');
  add_theme_support('soil-nice-search');
  add_theme_support('soil-jquery-cdn');
  add_theme_support('soil-relative-urls');

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage')
  ]);

  register_nav_menus([
    'footer_navigation' => __('Footer Navigation', 'sage')
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/main.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Alternative', 'sage'),
    'id'            => 'sidebar-alternative',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('After Content CTA', 'sage'),
    'id'            => 'sidebar-cta',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer', 'sage'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="col-sm-4 widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);



}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_front_page(),
    is_page('contact'),
    is_page_template('template-custom.php'),
  ]);

  return apply_filters('sage/display_sidebar', $display);
}

/**
 * Theme assets
 */
function assets() {
  wp_enqueue_style('jasny/css', '//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css', false, null);
  wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
  wp_enqueue_script('jasny/js', '//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js', ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);


/* Meta Boxes */
function custom_meta_box_markup($object)
{
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

    ?>
        <div>

            <?php
                $checkbox_value = get_post_meta($object->ID, "show-alternative-sidebar", true);

                if($checkbox_value == "")
                {
                    ?>
                        <input name="show-alternative-sidebar" id="show-alternative-sidebar" type="checkbox" value="true">
                    <?php
                }
                else if($checkbox_value == "true")
                {
                    ?>
                        <input name="show-alternative-sidebar" id="show-alternative-sidebar" type="checkbox" value="true" checked>
                    <?php
                }
                unset($checkbox_value);
            ?>
            <label for="show-alternative-sidebar">Use Alternative Sidebar</label>
            <br />

            <?php
                $checkbox_value = get_post_meta($object->ID, "hide-bottom-cta", true);

                if($checkbox_value == "")
                {
                    ?>
                        <input name="hide-bottom-cta" id="hide-bottom-cta" type="checkbox" value="true">
                    <?php
                }
                else if($checkbox_value == "true")
                {
                    ?>
                        <input name="hide-bottom-cta" id="hide-bottom-cta" type="checkbox" value="true" checked>
                    <?php
                }
            ?>
            <label for="hide-bottom-cta">Hide After Content CTA</label>
        </div>
    <?php
}

function add_custom_meta_box()
{
    add_meta_box("demo-meta-box", "Quick Settings", __NAMESPACE__ . '\\custom_meta_box_markup', array("post","page"), "side", "low", null);
}

add_action("add_meta_boxes", __NAMESPACE__ . '\\add_custom_meta_box');

function save_custom_meta_box($post_id, $post, $update)
{
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $post_types = array("post","page");
    if(!in_array($post->post_type, $post_types))
        return $post_id;


    $alternative_sidebar = isset($_POST["show-alternative-sidebar"]) ? $_POST["show-alternative-sidebar"] : "";
    $hide_bottom_cta = isset($_POST["hide-bottom-cta"]) ? $_POST["hide-bottom-cta"] : "";

    update_post_meta($post_id, "show-alternative-sidebar", $alternative_sidebar);
    update_post_meta($post_id, "hide-bottom-cta", $hide_bottom_cta);


}

add_action("save_post", __NAMESPACE__ . '\\save_custom_meta_box', 10, 3);
