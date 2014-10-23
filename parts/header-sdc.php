<?php
class header_view {
	private $controller;
	private $header_model;
	
	public function __construct( $controller , $header_model ){
		$this->controller = $controller;
		$this->header_model = $header_model;
	}
	
	public function get_header( $header_name = 'sdc' ){
		switch ( $header_name ){
			case 'sdc':
				include 'header-sdc-2.php';
		}
	}
}

class header_model {
	public $is_front_page;
	public $post;
	public $has_horiz_nav;
	public $meta;
	public $site;
	public $has_banner;
	public $has_featured_image;
	public $use_post_image;
	
	public function __construct( $post ){
		$this->post = $post;
		$this->is_front_page = is_front_page();
		$this->has_horiz_nav = has_nav_menu( 'cahnrs_horizontal' );
		$this->meta = get_post_meta( $this->post->ID );
		$this->site = $this->get_site();
		$this->has_banner = $this->check_banner();
		$this->has_featured_image = has_post_thumbnail( $this->post->ID );
		$this->use_post_image = ( isset( $this->meta['_use_post_image'] ) && $this->meta['_use_post_image'][0] );
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
	
	private function check_banner(){
		if( $this->is_front_page ) return false;
		if( isset( $this->meta['_collapse_banner'] ) && $this->meta['_collapse_banner'][0]  ) return false;
		return true;
	}
}

class header_control {
	private $post;
	private $header_model;
	private $header_view;
	
	public function __construct( $post ){
		$this->post = $post;
		$this->header_model = new header_model( $this->post );
		$this->header_view = new header_view( $this , $this->header_model );
		$this->header_view->get_header();
	}
}
global $post;
$cahnrs_header = new header_control( $post );