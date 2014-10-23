<?php
$slides = array();
$header_class = ( $this->header_model->is_front_page )? ' is-front-page' : '';
$header_class .= ( $this->header_model->has_banner )? ' has-banner' : '';
if( !$this->header_model->has_banner && !$this->header_model->is_front_page ){
	$slides = array();
}
else if( !$this->header_model->is_front_page && $this->header_model->use_post_image && $this->header_model->has_featured_image ){
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $this->header_model->post->ID ), 'full' );
	$slides[0][0] = new \stdClass;
	$slides[0][0]->post_image = $image[0]; 
}
else {
	$sites = ( $this->header_model->is_front_page )? array('architecture','construction-management'): array('architecture');
	foreach( $sites as $site ){
		$args = array(
			'post_type' => 'any',
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'site',
					'field'    => 'slug',
					'terms'    => array( $site ),
				),
				array(
					'taxonomy' => 'category',
					'field'    => 'slug',
					'terms'    => array( 'homepage-feature' ),
				),
			),
		);
		$query = new WP_Query( $args );
		while ( $query->have_posts() ) {
			$query->the_post();
			if( has_post_thumbnail( $query->post->ID ) ) {
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $query->post->ID ), 'full' );
				$query->post->post_image = $image[0];
			} else {
				$query->post->post_image = false;
			}
			if( !$query->post->post_excerpt ) $query->post->post_excerpt = get_the_excerpt(); 
			$slides[$site][] = $query->post;
		}
		wp_reset_postdata();
	}
} 

?>
<header id="global-header" class="header-sdc <?php echo $header_class;?>">
	<div class="site-banner">
		<a class="site-title" href="<?php echo $this->header_model->site['url'];?>" rel="home">
			<?php echo $this->header_model->site['name'];?>
        </a>
        <a class="site-subtitle" href="<?php echo $this->header_model->site['url'];?>" rel="home">
        	<?php echo get_the_title( $this->header_model->post->ID );?>
    	</a>
    </div>
    <nav>
    <?php 
	if( $this->header_model->has_horiz_nav ){
		
        wp_nav_menu( array(
            'theme_location' => 'cahnrs_horizontal',
            'container'      => false,
            'menu_class'     => 'nav-wrapper is_dropdown',
            'depth'          => 2
            ) );
			
    } 
	else if( $this->header_model->is_front_page ){
		
		wp_nav_menu( array(
            'theme_location' => 'site',
            'container'      => false,
            'menu_class'     => 'nav-wrapper is_dropdown',
            'depth'          => 2
            ) );
			
	}; ?>
    </nav>
</header>
<?php if( $this->header_model->is_front_page && $slides ):?>
<?php shuffle( $slides );?>
<div class="cycle-slideshow cahnrs-full-slider" 
	data-cycle-fx="scrollHorz"
    data-cycle-speed="500"
    data-cycle-slides="> div" 
    data-cycle-loader=true
    data-cycle-pager=".cycle-pager"
    data-cycle-timeout=6000 
    data-cycle-pager-template="<a style=background-image:url('{{children.0.src}}') href='#'></a>" />
	<?php foreach( $slides as $slideid => $slide ):?>
    <div style="background-image: url('<?php echo $slide[0]->post_image;?>');" >
    	<img src="<?php echo $slide[0]->post_image;?>"/ >
        <ul class="slide-caption">
        	<li>
            	<h3 ><?php echo $slide[0]->post_title;?></h3>
            	<span class="slide-description"><?php echo $slide[0]->post_excerpt;?></span>
            </li>
        </ul>
        <a href="#"></a>
    </div>
    <?php endforeach;?>
</div>
<div class="cycle-pager"></div>
<?php elseif ( $this->header_model->has_banner && $slides ):?>
	<?php $slide = reset($slides);?>
	<div id="default-banner" style="background-image: url('<?php echo $slide[0]->post_image;?>');" >
	</div>
<?php endif;?>