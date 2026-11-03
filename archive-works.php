<?php get_header(); ?>

<div class="works-archive">
	<p class="works-archive__bg-text" aria-hidden="true">Works</p>
	<div class="works-archive__head">
		<p class="works-archive__label">( WORKS )</p>
		<h1 class="works-archive__title">制作実績</h1>
	</div>

	<?php if (have_posts() ) : ?>
		<div class="works-archive__list">
			<?php while (have_posts() ) :
				the_post() ;
				get_template_part('template-parts/work-card' );
				endwhile;
			?>
		</div>

		<?php the_posts_pagination( array(
			'mid_size' => 1,
			'class' =>
			'works-archive__pagination',
			'screen_reader_text' => '制作実績のページ送り',
			'aria_label' => '制作実績のページ送り')); ?>
		<?php else : ?>
			<p class="works-archive__empty">制作実績は準備中です。</p>
		<?php endif; ?>
</div>

<?php get_footer(); ?>