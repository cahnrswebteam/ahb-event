<?php 
	$is_frontpage = ( is_front_page() )? 'site-front-page' : '';
	$has_horiz_nav = has_nav_menu( 'cahnrs_horizontal' );
	$is_cropped =( $is_frontpage )? 'cropped_spine' : ''; // TO Do: Create this for real
	?>
<header id="global-header" class="header-croppedfull <?php echo $is_frontpage;?>">
	<div class="site-banner">
    	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<span class="cahnrs-site-title"><?php bloginfo( 'name' ); ?></span>
            <span class="cahnrs-site-description"><?php bloginfo( 'description' );?></span>
        </a>
    </div>
    <nav>
    	<?php
		if( $has_horiz_nav ){
			wp_nav_menu( array(
				'theme_location' => 'cahnrs_horizontal',
				'container'      => false,
				'menu_class'     => 'nav-wrapper is_dropdown',
				/*'fallback_cb'    => 'featured_nav_fallback',*/
				'depth'          => 1
				) );
		} 
		else if( $is_cropped ) {
			wp_nav_menu( array(
				'theme_location' => 'site',
				'container'      => false,
				'menu_class'     => 'nav-wrapper is_dropdown',
				/*'fallback_cb'    => 'featured_nav_fallback',*/
				'depth'          => 1
				) );
		}
		?>
    </nav>
</header>