<?php 
	$is_frontpage = ( is_front_page() )? 'site-front-page' : '';
	$has_horiz_nav = has_nav_menu( 'cahnrs_horizontal' );
	$is_cropped =( $is_frontpage )? 'cropped_spine' : ''; // TO Do: Create this for real
	global $post;
	?>
<header id="global-header" class="header-sdc <?php echo $is_frontpage;?>">
	<div class="site-banner">
    <?php $site = get_the_terms( $post->ID , 'site' );?>
    <?php if( !$site ):?>
    	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<span class="cahnrs-site-title"><?php bloginfo( 'name' ); ?></span>
            <span class="cahnrs-site-description"><?php echo get_the_title( $post->ID ); ?></span>
        </a>
    <?php else:?>
    	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
        	<?php $site = reset( $site ); ?>
			<span class="cahnrs-site-title is_subsite"><?php echo $site->name; ?></span>
            <span class="cahnrs-site-description is_subsite"><?php echo get_the_title( $post->ID ); ?></span>
        </a>
    <?php endif;?>
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
				'depth'          => 2
				) );
		}
		?>
    </nav>
</header>
<?php if( !is_front_page() ):?>
<div id="pagebanner" class="unbound recto verso" >
	<?php if( has_post_thumbnail( $post->ID ) ){
    	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'wide-banner' );
		$url = $thumb['0'];
		echo '<div class="banner-image" style="background-image: url('.$url.');">';
			echo '<img src="'.$url.'" />';
		echo '</div>';
    };?>
   
</div> 
<?php endif;?>