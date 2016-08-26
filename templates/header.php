<header class="banner" role="banner">
    <div class="container">
      <!-- Mobile Header -->
      <div class="content row hidden-sm hidden-md hidden-lg">

        <div class="col-sm-3">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>            

          </div>
        </div>

        <div class="col-sm-6">
          <?php if ( get_theme_mod( 'header_logo' ) ) : // Logo ?> 
            <a href="<?php get_bloginfo('url'); ?>">
             <img src="<?php echo get_theme_mod( 'header_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" >
            </a>
          <?php else : ?>
            <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
          <?php endif; ?>
        </div>

        <div class="col-sm-3">

        </div>

      </div>
      
      <!-- Desktop Header -->
      <div class="content row hidden-xs ">

        <div class="col-sm-3">
            <?php if ( get_theme_mod( 'header_logo' ) ) : // Logo ?>
              <a href="<?php echo get_bloginfo('url'); ?>" class="navbar-brand">
               <img src="<?php echo get_theme_mod( 'header_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" >
              </a>
            <?php else : ?>
              <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
            <?php endif; ?>
        </div>

        <div class="col-sm-6">

        </div>

        <div class="col-sm-3">

        </div>


      </div>
    </div>
    
    <!-- Main Navigation -->
    <nav class="navbar navbar-inverse navbar-static-top collapse navbar-collapse bg-primary" role="navigation">
      <div class="container">
        <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav']);
        endif;
        ?>
      </div>
    </nav>
  
</header>