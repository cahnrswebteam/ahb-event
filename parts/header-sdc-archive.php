<?php
class cahnrs_header{
	public $post;
	public $is_frontpage;
	public $is_cropped;
	public $meta;
	public $has_banner;
	
	public function __construct(){
		global $post;
		$this->post = $post;
		$this->is_frontpage = is_front_page();
		$this->horizontal_nav = has_nav_menu( 'cahnrs_horizontal' );
		//$this->is_cropped = has_nav_menu( 'cahnrs_horizontal' );
		$this->meta = get_post_meta( $this->post->ID );
		$this->has_banner = $this->test_for_banner();
		$this->site = $this->get_site();
		$this->banner_class = $this->get_banner_type();
	}
	
	private function test_for_banner(){
		if( $this->is_frontpage ) return false;
		if( isset( $this->meta['_hide_banner'] ) && implode( $this->meta['_hide_banner'] ) ) return false;
		return true;
	}
	
	private function get_banner_type(){
		if( isset( $this->meta['_collapse_banner'] ) && implode( $this->meta['_collapse_banner'] ) ) return 'banner_less';
		return '';
	}
	
	private function get_site(){
		$site = array();
		$site_terms = get_the_terms( $post->ID , 'site' );
		if( $site_terms ) {
			$site_terms = reset( $site_terms );
			$site['name'] = $site_terms->name;
			$site['url'] = esc_url( home_url( '/' ) );
		} else {
			$site['name'] = get_bloginfo( 'name' );
			$site['url'] = esc_url( home_url( '/' ) );
		}
		return $site;
	}
}
$cahnrs_header = new cahnrs_header();
?>
<header id="global-header" class="header-sdc <?php echo $is_frontpage;?> <?php echo $cahnrs_header->banner_class;?>">
	<div class="site-banner">
    	<a href="<?php echo $cahnrs_header->site['url']; ?>" rel="home">
			<span class="cahnrs-site-title"><?php echo $cahnrs_header->site['name']; ?></span>
            <span class="cahnrs-site-description"><?php echo get_the_title( $post->ID ); ?></span>
        </a>
    </div>
    <nav>
    	<?php
		if( $cahnrs_header->horizontal_nav ){
			wp_nav_menu( array(
				'theme_location' => 'cahnrs_horizontal',
				'container'      => false,
				'menu_class'     => 'nav-wrapper is_dropdown',
				/*'fallback_cb'    => 'featured_nav_fallback',*/
				'depth'          => 2
				) );
		}?>
    </nav>
</header>
<?php if( $cahnrs_header->has_banner ):?>
<div id="pagebanner" class="unbound recto verso <?php echo $cahnrs_header->banner_class;?>" >
	<?php if( has_post_thumbnail( $post->ID ) ){
    	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'wide-banner' );
		$url = $thumb['0'];
		echo '<div class="banner-image" style="background-image: url('.$url.');">';
			echo '<img src="'.$url.'" />';
		echo '</div>';
    };?>  
</div>
<?php endif;?>