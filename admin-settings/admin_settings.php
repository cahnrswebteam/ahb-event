<?php
class init_admin_settings{
	
	public $themes = array(
		0 => 'Default',
		'sdc' => 'SDC',
		'events' => 'Events',
	);
	public $headers = array(
		0 => 'Default',
		'sdc' => 'SDC',
		'events' => 'Events',
	);
	public $css = array(
		0 => 'Default',
		'sdc' => 'SDC',
		'events' => 'Events',
	);
	public $footers = array(
		0 => 'Default',
		'events' => 'Events',
	);
	
	public function add_settings(){
		
	}
	
	
	public function register_settings(){
		add_settings_section(
			'cahnrs_theme_options',
			'Options for CAHNRS theme',
			array( $this , 'theme_options_text' ),
			'reading'
		);
		
		add_settings_field(
			'cahnrs_select_theme',
			'Select Custom Theme: ',
			array( $this , 'get_custom_themes' ),
			'reading',
			'cahnrs_theme_options'
		);
		register_setting( 'reading', 'cahnrs_select_theme' );
		
	}
	
	public function theme_options_text(){
		echo 'here is some text';
	}
	
	public function get_custom_themes(){
		$ops = get_option( 'cahnrs_select_theme' );
		echo '<p>';
			echo '<select name="cahnrs_select_theme[theme]">';
			foreach( $this->themes as $id => $title ){
				echo '<option value="'.$id.'" '.selected( $id , $ops['theme']   ).' >'.$title.'</option>';
			}
			echo '</select>';
		echo '</p>';
		echo '<p>';
			echo '<select name="cahnrs_select_theme[header]">';
			foreach( $this->headers as $id => $title ){
				echo '<option value="'.$id.'" '.selected( $id , $ops['header']   ).' >'.$title.'</option>';
			}
			echo '</select>';
		echo '</p>';
		echo '<p>';
			echo '<select name="cahnrs_select_theme[style]">';
			foreach( $this->css as $id => $title ){
				echo '<option value="'.$id.'" '.selected( $id , $ops['style']   ).' >'.$title.'</option>';
			}
			echo '</select>';
		echo '</p>';
		echo '<p>';
			echo '<select name="cahnrs_select_theme[footer]">';
			foreach( $this->footers as $id => $title ){
				echo '<option value="'.$id.'" '.selected( $id , $ops['footer']   ).' >'.$title.'</option>';
			}
			echo '</select>';
		echo '</p>';
	}
}

?>