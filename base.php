<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>

    <?php  if(is_page() && !is_front_page()): ?>
    <div class="text-center page-top">
      <h1>COMPREHENSIVE DENTAL CARE</h1>
      <h2>A TOP RATED LOCAL® DENTAL PRACTICE</h2>
    </div>

    <?php endif; ?>

    <div class="wrap container" role="document">
      <div class="content row">
        <main class="main">
          <?php include Wrapper\template_path();
          if(!get_post_meta( get_the_ID(), 'hide-bottom-cta', true )){
            dynamic_sidebar('sidebar-cta');
          }
          ?>

        </main><!-- /.main -->
        <?php if (Setup\display_sidebar()) : ?>
          <aside class="sidebar">
          <?php if(get_post_meta( get_the_ID(), 'show-alternative-sidebar', true )){ ?>
            <div class="sidebar-alternative">
              <?php dynamic_sidebar('sidebar-alternative'); ?>
            </div><!-- /.sidebar -->
          <?php }else{
            include Wrapper\sidebar_path(); }
          ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
