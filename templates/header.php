<header class="banner" role="banner">
  <div class="container">
    <!-- Mobile Header -->
    <div class="content row hidden-sm hidden-md hidden-lg mobile-header">
        <nav id="offcanvas-menu" class="navmenu navmenu-inverse navmenu-fixed-left offcanvas" role="navigation">
          <div class="container">
            <?php
            if (has_nav_menu('primary_navigation')) :
              wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav']);
            endif;
            ?>
          </div>
        </nav>
        <div class="col-xs-3">
        
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target="#offcanvas-menu" data-canvas="body">
              <span class="sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>            
          </div>

        </div>

        <div class="col-xs-6">
          <?php if ( get_theme_mod( 'header_logo' ) ) : // Logo ?> 
            <a href="<?php echo get_bloginfo('url'); ?>">
             <img src="<?php echo get_theme_mod( 'header_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" >
            </a>
          <?php else : ?>
            <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
          <?php endif; ?>
        </div>

        <div class="col-xs-3">

        </div>

    </div>
      
      <!-- Desktop Header -->
      <div class="content row hidden-xs desktop-header">

        <div class="col-sm-4">
          <?php if ( get_theme_mod( 'header_logo' ) ) : // Logo ?>
            <a href="<?php echo get_bloginfo('url'); ?>" class="navbar-brand">
             <img src="<?php echo get_theme_mod( 'header_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" >
            </a>
          <?php else : ?>
            <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
          <?php endif; ?>
        </div>

        <div class="col-sm-4">
          <?php if ( get_theme_mod( 'header_textarea' ) ) : // Header Text ?>
            <div class="header_textarea">
              <?php echo get_theme_mod( 'header_textarea' ); ?>
            </div>
          <?php endif; ?>
        </div>

        <div class="col-sm-4">
          <?php if ( get_theme_mod( 'header_button_url' ) ) : // Header Button ?>
            <div class="header_button">
              <a href="<?php echo get_theme_mod('header_button_url'); ?>" class="btn btn-primary"><?php echo get_theme_mod('header_button_text'); ?></a>
            </div>
          <?php endif; ?>
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