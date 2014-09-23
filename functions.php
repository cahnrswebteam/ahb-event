<?php
class cahnrs_events_spine_child {
	
	public function __construct() {
		/**************************** 
		** DEFINE DIRECTORY, URI, AND OTHER THEME CONSTANTS - DB **
		***************************/
		$this->define_constants();
		/**************************** 
		** ADD CUSTOM IMAGE SIZES **
		*****************************/
		add_action( 'init', array( $this, 'add_image_sizes' ) );
		add_filter( 'image_size_names_choose', array( $this, 'add_custom_image_sizes' ) );
		add_post_type_support('page', 'excerpt');
	}

	
	private function define_constants() {
		define( 'CAHNRS2014DIR', get_stylesheet_directory() ); // CONSTANT FOR THEME DIRECTORY - DB
		define( 'CAHNRS2014URI', get_stylesheet_directory_uri() ); // CONSTANT FOR THEM URI - DB
	}

	public function add_image_sizes() {
		 add_image_size( '4x3-medium', 400, 300, true );
		 add_image_size( '3x4-medium', 300, 400, true );
		 add_image_size( '16x9-medium', 400, 225, true );
		 add_image_size( '16x9-large', 800, 450, true );
	}

	public function add_custom_image_sizes( $sizes ) {
		return array_merge( $sizes, array(
			'4x3-medium' => '4x3-medium',
			'3x4-medium' => '3x4-medium',
			'16x9-medium' => '16x9-medium',
			'16x9-large' => '16x9-large',
		) );
	}
}

$wsu_cahnrs_events_spine = new cahnrs_events_spine_child();
?>