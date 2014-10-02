<?php
	$opts = get_option( 'cahnrs_select_theme' ); // Get the options from theme
	$theme = ( isset( $opts['theme'] ) &&  $opts['theme']  )? $opts['theme']: ''; // Check for theme
	if( isset( $opts['header'] ) &&  $opts['header']  ) $theme = $opts['header']; // Check if header override is set
	/** get_temp looks for parts/header-[name] first **
	** if the file does not exist it will default to parts/header **/
	get_template_part( 'parts/header' , $theme );
?>

