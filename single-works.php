<?php get_header(); ?>

<?php while ( have_posts() ) :
the_post();
$type = ap_work_type_label(get_the_ID() );
$role = get_post_meta(get_the_ID(), 'ap_role' , true );
$client = get_post_meta(get_the_ID(), 'ap_client', true );
$url = get_post_meta(get_the_ID(), 'ap_url', true );
$back_id = (int) get_post_meta(get_the_ID(), 'ap_back_image', true);
$gallery = ap_get_gallery(get_the_ID() );
?>

<article class="work-detail">
	<header class="work-detail__head">
		<?php if ( $type ): ?>
			<p class="work-detail__type"><?php echo esc_html( $type ); ?></p>
			<?php endif; ?>
			<h1 class="work-detail__title"><?php the_title(); ?></h1>
			<?php if ( has_excerpt() ): ?>
				<p class="work-detail__lead"><?php echo esc_html(get_the_excerpt() ); ?></p>
			<?php endif; ?>
	</header>

	<?php if ( count ( $gallery ) >= 3 ): ?>
		<div class="work-detail__gallery">
			<?php foreach ( $gallery as $i => $gid ): ?>
				<figure class="work-detail__figure">
					<?php echo wp_get_attachment_image( $gid, 'full', false, array( 'alt' => get_the_title() . ' ' .( $i + 1 ) ) ); ?>
				</figure>
				<?php endforeach; ?>
		</div>
		<?php elseif ( has_post_thumbnail() && $back_id ):
		$labels = ap_sheet_labels(get_the_ID() ); ?>

		<div class="work-detail__sheets">
			<figure class="work-detail__figure">
				<?php the_post_thumbnail( 'full' , array( 'alt' => get_the_title() . ' ' . $labels[0] ['ja'] ) ); ?>
				<figcaption class="work-detail__caption">
					<span class="work-detail__caption-en"><?php echo esc_html( $labels[0]['en'] ); ?></span>
					<?php echo esc_html($labels[0]['ja']); ?>
				</figcaption>
			</figure>
			<figure class="work-detail__figure">
				<?php echo wp_get_attachment_image( $back_id,'full', false, array( 'alt' =>get_the_title() . ' ' .$labels[1]['ja'] ) ); ?>
				<figcaption class="work-detail__caption">
					<span class="work-detail__caption-en"><?php echo esc_html( $labels[1]['en'] ); ?></span>
					<?php echo esc_html($labels[1]['ja'] ); ?>
				</figcaption>
			</figure>
		</div>
		<?php elseif (has_post_thumbnail() ) : ?>
			<figure class="work-detail__image">
				<?php the_post_thumbnail( 'full' ); ?>
			</figure>
			<?php endif; ?>

			<dl class="work-detail__info">
				<?php if ( $client ) : ?>
					<div class="work-detail__info-row">
						<dt class="work-detail__info-term">クライアント</dt>
						<dd class="work-detail__info-desc"><?php echo esc_html( $client ); ?></dd>
					</div>
					<?php endif; ?>
					<?php if ( $role ) : ?>
						<div class="work-detail__info-row">
							<dt class="work-detail__info-term">担当範囲</dt>
							<dd class="work-detail__info-desc"><?php echo esc_html( $role ); ?></dd>
						</div>
					<?php endif; ?>
					<?php if ( $url ) : ?>
					<div class="work-detail__info-row">
						<dt class="work-detail__info-term"> URL</dt>
						<dd class="work-detail__info-desc">
							<a class="work-detail__link" href="<?php echo esc_url( $url ); ?>"
							target="_blank" rel="noopener"><?php echo esc_html( $url ); ?></a>
							<?php if ( 0 === strpos( (string) wp_parse_url($url, PHP_URL_PATH ), '/demo/' ) ): ?>
								<small class="work-detail__note">自主制作したサイトのため、閲覧用として公開しています。（店舗は架空です。）</small>
								<?php endif; ?>
						</dd>
					</div>
				<?php endif; ?>
			</dl>

			<div class="work-detail__content">
				<?php the_content(); ?>
			</div>

			<a class="work-detail__back" href="<?php echo esc_url(get_post_type_archive_link( 'works')); ?>">一覧に戻る</a>
			</article>

		<?php endwhile; ?>
		<?php get_footer(); ?>
					