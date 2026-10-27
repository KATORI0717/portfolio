<?php
/**
 * 制作実績のカード（トップ・一覧で共通）
 * 裏面画像があるとき（チラシなど）は、表面と裏面を重ねて表示する
 */
$type    = ap_work_type_label( get_the_ID() );
$role    = get_post_meta( get_the_ID(), 'ap_role', true );
$client  = get_post_meta( get_the_ID(), 'ap_client', true );
$back_id = (int) get_post_meta( get_the_ID(), 'ap_back_image', true );
$gallery = ap_get_gallery( get_the_ID() );
?>
<a class="work-card" href="<?php the_permalink(); ?>">
	<?php if ( count( $gallery ) >= 3 ) : ?>
		<?php
		// すべて横長（サムネイルなど）なら、1枚を大きく・2枚を右に重ねる並べ方にする
		$all_wide = true;
		foreach ( array_slice( $gallery, 0, 3 ) as $gid ) {
			$m = wp_get_attachment_metadata( $gid );
			if ( empty( $m['height'] ) || $m['width'] / $m['height'] < 1.3 ) {
				$all_wide = false;
			}
		}
		?>
		<!-- 3枚以上の作品：台紙に3枚を並べる -->
		<div class="work-card__img work-card__img--gallery<?php echo $all_wide ? ' is-wide' : ''; ?>">
			<?php foreach ( array_slice( $gallery, 0, 3 ) as $i => $gid ) : ?>
				<?php echo wp_get_attachment_image( $gid, 'large', false, array( 'class' => 'gallery-item', 'loading' => 'eager', 'sizes' => '(max-width: 767px) 30vw, 14vw', 'alt' => get_the_title() . ' ' . ( $i + 1 ) ) ); ?>
			<?php endforeach; ?>
		</div>
	<?php
	elseif ( has_post_thumbnail() && $back_id ) :
		// 1枚目の縦横比で、横長・正方形・縦長の並べ方を切り替える
		$meta  = wp_get_attachment_metadata( get_post_thumbnail_id() );
		$ratio = ! empty( $meta['height'] ) ? $meta['width'] / $meta['height'] : 1;
		if ( $ratio > 1.15 ) {
			$orientation = 'landscape';
		} elseif ( $ratio >= 0.87 ) {
			$orientation = 'square';
		} else {
			$orientation = 'portrait';
		}
		$labels = ap_sheet_labels( get_the_ID() );
		?>
		<div class="work-card__img work-card__img--sheets is-<?php echo esc_attr( $orientation ); ?>">
			<?php
			// WordPressの遅延読み込み（sizes="auto"）が付ける仮の大きさで崩れないよう、sizes を指定する
			$sheet_attr = array( 'sizes' => '(max-width: 767px) 45vw, 22vw', 'loading' => 'eager' );
			the_post_thumbnail( 'large', $sheet_attr + array( 'class' => 'sheet sheet--front', 'alt' => get_the_title() . ' ' . $labels[0]['ja'] ) );
			echo wp_get_attachment_image( $back_id, 'large', false, $sheet_attr + array( 'class' => 'sheet sheet--back', 'alt' => get_the_title() . ' ' . $labels[1]['ja'] ) );
			?>
		</div>
	<?php
	else :
		// 1枚だけの縦長の作品（ポスターなど）は、切り抜かずに台紙の上に全体を見せる
		$single_meta = has_post_thumbnail() ? wp_get_attachment_metadata( get_post_thumbnail_id() ) : array();
		$is_poster   = ! empty( $single_meta['height'] ) && $single_meta['width'] / $single_meta['height'] < 0.9;
		?>
		<div class="work-card__img<?php echo $is_poster ? ' work-card__img--poster' : ''; ?>">
			<?php if ( $is_poster ) : ?>
				<?php the_post_thumbnail( 'large', array( 'class' => 'poster', 'loading' => 'eager', 'sizes' => '(max-width: 767px) 50vw, 20vw' ) ); ?>
			<?php elseif ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'large' ); ?>
			<?php else : ?>
				<span class="work-card__noimg">NO IMAGE</span>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<div class="work-card__body">
		<?php if ( $type ) : ?>
			<span class="work-card__type"><?php echo esc_html( $type ); ?></span>
		<?php endif; ?>
		<span class="work-card__title"><?php the_title(); ?></span>
		<?php
		// クライアント名と担当範囲は、タイトルの下に小さくまとめる
		$meta = array_filter( array( $client, $role ? '担当：' . $role : '' ) );
		if ( $meta ) :
			?>
			<span class="work-card__role"><?php echo esc_html( implode( ' ／ ', $meta ) ); ?></span>
		<?php endif; ?>
	</div>
</a>
