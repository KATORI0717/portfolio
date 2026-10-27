<?php get_header(); ?>

<section class="page-head page-head--dark">
	<p class="page-head__en en" aria-hidden="true">Works</p>
	<div class="section-title section-title--light">
		<h1 class="heading">制作実績</h1>
		<span class="label">( WORKS )</span>
	</div>
</section>

<section class="works works--archive">
	<?php if ( have_posts() ) : ?>
		<div class="works-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/work-card' );
			endwhile;
			?>
		</div>
		<div class="pagination">
			<?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?>
		</div>
	<?php else : ?>
		<p class="works__empty">制作実績は準備中です。</p>
	<?php endif; ?>
</section>

<?php get_footer(); ?>
