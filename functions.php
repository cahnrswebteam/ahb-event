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
		add_action('wp_footer', array( $this , 'add_footer') );
		add_action( 'wp_enqueue_scripts', array( $this, 'cahnrs_scripts' ), 20 );
		add_action( 'init', array( $this, 'cahnrs_menu' ) );
		add_action( 'init', array( $this, 'add_sites' ), 0 );
		add_filter( 'wp_nav_menu_args', array( $this , 'modify_nav_menu_args' ) );

		if ( is_admin() ){
			include CAHNRS2014DIR.'/admin-settings/admin_settings.php';
			$admin_settings = new init_admin_settings();
			add_action( 'admin_init', array( $admin_settings ,'register_settings' ) );
		}
	}
	
	public function modify_nav_menu_args( $args ){
		if( 'site' == $args['theme_location'] ){
			$args['depth'] = 2;
		}

	return $args;
	}
	
	public function add_sites(){
		$labels = array(
			'name'              => _x( 'Sites', 'taxonomy general name' ),
			'singular_name'     => _x( 'Site', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Sites' ),
			'all_items'         => __( 'All Sites' ),
			'parent_item'       => __( 'Parent Site' ),
			'parent_item_colon' => __( 'Parent Site:' ),
			'edit_item'         => __( 'Edit Site' ),
			'update_item'       => __( 'Update Site' ),
			'add_new_item'      => __( 'Add New Site' ),
			'new_item_name'     => __( 'New Site Name' ),
			'menu_name'         => __( 'Sites' ),
		);
	
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'public' => false,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'sites' ),
		);
		register_taxonomy( 'site', array( 'page' ), $args );
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
		 add_image_size( 'wide-banner', 1600, 600, true );
	}

	public function add_custom_image_sizes( $sizes ) {
		return array_merge( $sizes, array(
			'4x3-medium' => '4x3-medium',
			'3x4-medium' => '3x4-medium',
			'16x9-medium' => '16x9-medium',
			'16x9-large' => '16x9-large',
		) );
	}
	
	public function add_footer(){
		include 'footer-footerselector.php';
	}
	
	public function cahnrs_scripts() {
		
		wp_enqueue_script( 'theme-script', CAHNRS2014URI . '/js/script.js' , array(), '1.0.0', false );
		$opts = get_option( 'cahnrs_select_theme' ); // Get the options from theme
		$theme = ( isset( $opts['theme'] ) &&  $opts['theme']  )? $opts['theme']: ''; // Check for theme
		if( isset( $opts['style'] ) &&  $opts['style']  ) $theme = $opts['style']; // Check if header override is set
		wp_enqueue_style( 'custom_css', CAHNRS2014URI . '/css/style-'.$theme.'.css' , array(), '1.0.0', false );
	}
	
	public function cahnrs_menu() {
		register_nav_menu( 'cahnrs_horizontal', 'Horizontal' );
		register_nav_menu( 'cahnrs_deeplinks', 'Site Deeplinks' );
	}
}

$wsu_cahnrs_events_spine = new cahnrs_events_spine_child();
?>