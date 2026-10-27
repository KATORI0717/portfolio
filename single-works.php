<?php get_header(); ?>

<?php
while ( have_posts() ) :
	the_post();
	$type   = ap_work_type_label( get_the_ID() );
	$role   = get_post_meta( get_the_ID(), 'ap_role', true );
	$client = get_post_meta( get_the_ID(), 'ap_client', true );
	$url     = get_post_meta( get_the_ID(), 'ap_url', true );
	$back_id = (int) get_post_meta( get_the_ID(), 'ap_back_image', true );
	$gallery = ap_get_gallery( get_the_ID() );
	?>
	<article class="work-single">
		<header class="work-single__head">
			<?php if ( $type ) : ?>
				<span class="work-card__type"><?php echo esc_html( $type ); ?></span>
			<?php endif; ?>
			<h1 class="heading"><?php the_title(); ?></h1>
			<?php if ( has_excerpt() ) : ?>
				<p class="work-single__lead"><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>
		</header>

		<?php if ( count( $gallery ) >= 3 ) : ?>
			<!-- 3枚以上の作品：すべて大きく並べる -->
			<div class="work-single__gallery">
				<?php foreach ( $gallery as $i => $gid ) : ?>
					<figure><?php echo wp_get_attachment_image( $gid, 'full', false, array( 'alt' => get_the_title() . ' ' . ( $i + 1 ) ) ); ?></figure>
				<?php endforeach; ?>
			</div>
		<?php
		elseif ( has_post_thumbnail() && $back_id ) :
			$labels = ap_sheet_labels( get_the_ID() );
			?>
			<div class="work-single__sheets">
				<figure>
					<?php the_post_thumbnail( 'full', array( 'alt' => get_the_title() . ' ' . $labels[0]['ja'] ) ); ?>
					<figcaption class="en"><?php echo esc_html( $labels[0]['en'] ); ?><span><?php echo esc_html( $labels[0]['ja'] ); ?></span></figcaption>
				</figure>
				<figure>
					<?php echo wp_get_attachment_image( $back_id, 'full', false, array( 'alt' => get_the_title() . ' ' . $labels[1]['ja'] ) ); ?>
					<figcaption class="en"><?php echo esc_html( $labels[1]['en'] ); ?><span><?php echo esc_html( $labels[1]['ja'] ); ?></span></figcaption>
				</figure>
			</div>
		<?php elseif ( has_post_thumbnail() ) : ?>
			<div class="work-single__img"><?php the_post_thumbnail( 'full' ); ?></div>
		<?php endif; ?>

		<dl class="work-single__info">
			<?php if ( $client ) : ?>
				<div><dt>クライアント</dt><dd><?php echo esc_html( $client ); ?></dd></div>
			<?php endif; ?>
			<?php if ( $role ) : ?>
				<div><dt>担当範囲</dt><dd><?php echo esc_html( $role ); ?></dd></div>
			<?php endif; ?>
		</dl>

		<?php if ( $url ) : ?>
			<!-- サイトを公開したら、管理画面の「URL」欄に入れるとここに表示される -->
			<p class="work-single__url">
				<span class="en">URL</span>
				<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $url ); ?></a>
			</p>
		<?php endif; ?>

		<div class="work-single__content entry-content">
			<?php the_content(); ?>
		</div>

		<a class="btn btn--outline" href="<?php echo esc_url( get_post_type_archive_link( 'works' ) ); ?>">一覧に戻る</a>
	</article>
<?php endwhile; ?>

<?php get_footer(); ?>
