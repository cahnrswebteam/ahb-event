<?php
	/*$header = ( get_option( 'cahnrs_use_header' ) )? get_option( 'cahnrs_use_header' ) : 'default';*/
	$header = 'header-croppedfull';
	switch ( $header ){
		case 'header-croppedfull':
			get_template_part('parts/header-croppedfull');
			break;
		case 'default':
		default:
			get_template_part('parts/header-default');
			break;
	}
	//$uses_global = get_option( 'cahnrs_use_header' );
	//$has_horiz_nav = has_nav_menu( 'cahnrs_horizontal' );
?>

