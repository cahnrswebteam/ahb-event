<?php get_header(); ?>

<main class="spine-page-default">

<?php get_template_part('parts/headers'); ?>
<section class="row side-right gutter pad-ends">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part('articles/article'); ?>
		<?php endwhile; ?>
</section>

</main>

<?php get_footer(); ?>