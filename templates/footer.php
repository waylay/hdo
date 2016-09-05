<footer class="content-info">
  <div class="container">
    <?php
    if (has_nav_menu('footer_navigation')) :
      wp_nav_menu(['theme_location' => 'footer_navigation']);
    endif;
    ?>
  </div>
  <div class="container">
    <?php dynamic_sidebar('sidebar-footer'); ?>
  </div>
</footer>
