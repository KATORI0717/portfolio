<?php get_header(); ?>

<section class="page-head">
	<div class="section-title">
		<h1 class="heading"><?php echo is_home() ? 'お知らせ' : esc_html( wp_get_document_title() ); ?></h1>
	</div>
</section>

<div class="page-content">
	<?php if ( have_posts() ) : ?>
		<ul class="post-list">
			<?php while ( have_posts() ) : the_post(); ?>
				<li>
					<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</li>
			<?php endwhile; ?>
		</ul>
		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<p>記事がありません。</p>
	<?php endif; ?>
</div>

<?php get_footer(); ?>
