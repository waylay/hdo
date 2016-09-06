<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php', // Theme customizer
  'lib/wp_bootstrap_navwalker.php', // Bootstrap Walker
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);


/* Programatically import all previous SEO Title and Descriptions to YOAST */
function convert_seo_meta() {

  $all_pages = get_posts(array(
    'posts_per_page'   => -1,
    "post_type" => array("post","page")
  ));

  foreach ($all_pages as $single_page) {

    $post_id = $single_page->ID;

    $uxi_seo_title = get_post_meta($post_id, "uxi_seo_title", true);
    $uxi_seo_description = get_post_meta($post_id, "uxi_seo_description", true);
    update_post_meta($post_id, "_yoast_wpseo_title", $uxi_seo_title);
    update_post_meta($post_id, "_yoast_wpseo_metadesc", $uxi_seo_description);
    update_post_meta($post_id, "_yoast_wpseo_focuskw_text_input", "Dentist Lady Lake");
    update_post_meta($post_id, "_yoast_wpseo_focuskw", "Dentist Lady Lake");

  }

}

if(isset($_GET['import_seo']) && $_GET['import_seo'] == "true"){
  convert_seo_meta();
}
