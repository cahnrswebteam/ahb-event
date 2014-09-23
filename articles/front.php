<?php // Just a stub for now ?>
		
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( spine_get_option( 'articletitle_show' ) == 'true' ) : ?>
	<header class="article-header">
	</header>
	<?php endif; ?>
	<?php the_content(); ?>
</article>