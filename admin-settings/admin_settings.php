<?php
class init_admin_settings{
	
	public function add_settings( $settings = array() ){
		
		add_settings_section(
			'reading_settings',
			'Theme Settings',
			array( $this , 'get_reading_section' ),
			'reading'
		);
		
	}
}

?>