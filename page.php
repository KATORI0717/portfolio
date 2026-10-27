<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<section class="page-head">
		<div class="section-title">
			<h1 class="heading"><?php the_title(); ?></h1>
		</div>
	</section>
	<div class="page-content entry-content">
		<?php the_content(); ?>
	</div>
<?php endwhile; ?>

<?php get_footer(); ?>
