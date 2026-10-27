<?php
/**
 * katori design テーマ機能
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // 直接アクセス禁止
}

/**
 * テーマセットアップ
 */
function ap_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	register_nav_menus( array(
		'primary' => 'メインナビゲーション',
	) );
}
add_action( 'after_setup_theme', 'ap_setup' );

/**
 * スタイル・スクリプトの読み込み
 */
/**
 * テーマのファイルの更新日時を、読み込むときのバージョン番号にする。
 * ファイルを上書きするたびに番号が変わるので、ブラウザが古いファイルを使い続けない
 */
function ap_asset_ver( $relative_path ) {
	$file = get_template_directory() . '/' . ltrim( $relative_path, '/' );
	return file_exists( $file ) ? (string) filemtime( $file ) : '1.0';
}

function ap_enqueue_assets() {
	// Google Fonts（英字：Cormorant Garamond / 和文：Zen Kaku Gothic New）
	wp_enqueue_style(
		'ap-fonts',
		'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;1,400&family=Zen+Kaku+Gothic+New:wght@400;500;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style( 'ap-style', get_stylesheet_uri(), array(), ap_asset_ver( 'style.css' ) );

	wp_enqueue_script(
		'ap-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		ap_asset_ver( 'assets/js/main.js' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'ap_enqueue_assets' );

/**
 * テーマ内の画像URLを返す（assets/img/ 以下）
 */
function ap_img( $file ) {
	return esc_url( add_query_arg( 'ver', ap_asset_ver( 'assets/img/' . $file ), get_template_directory_uri() . '/assets/img/' . $file ) );
}

/**
 * カスタム投稿タイプ「Works（制作実績）」とカテゴリー
 */
function ap_register_works() {
	register_post_type( 'works', array(
		'labels'       => array(
			'name'          => '制作実績',
			'singular_name' => '制作実績',
			'add_new_item'  => '制作実績を追加',
			'edit_item'     => '制作実績を編集',
		),
		'public'       => true,
		'has_archive'  => true,
		'menu_position'=> 5,
		'menu_icon'    => 'dashicons-portfolio',
		'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ), // page-attributes：並び順の欄
		'show_in_rest' => true, // ブロックエディタを使う
		'rewrite'      => array( 'slug' => 'works' ),
	) );

	register_taxonomy( 'work_type', 'works', array(
		'labels'            => array(
			'name'          => '制作物の種類',
			'singular_name' => '制作物の種類',
		),
		'hierarchical'      => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'works/type' ),
	) );
}
add_action( 'init', 'ap_register_works' );

/**
 * テーマ有効化時にパーマリンクを更新（/works/ を表示できるようにする）
 */
function ap_flush_rewrite() {
	ap_register_works();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'ap_flush_rewrite' );

/**
 * 制作実績の入力欄（担当範囲・クライアント・URL）
 */
function ap_works_fields() {
	return array(
		'ap_role'    => '担当範囲（例：デザイン / コーディング）',
		'ap_client'  => 'クライアント（例：自主制作）',
		'ap_url'     => 'サイトURL（あれば）',
		'ap_label_1' => '1枚目の名前（例：写真ver.／空欄なら「表面」）',
		'ap_label_2' => '2枚目の名前（例：イラストver.／空欄なら「裏面」）',
	);
}

/**
 * 1枚目・2枚目の見出し（英字＋日本語）を返す
 * 名前が入力されていればそれを、なければ「Front 表面」「Back 裏面」を使う
 */
function ap_sheet_labels( $post_id ) {
	$label_1 = get_post_meta( $post_id, 'ap_label_1', true );
	$label_2 = get_post_meta( $post_id, 'ap_label_2', true );
	return array(
		$label_1 ? array( 'en' => '01', 'ja' => $label_1 ) : array( 'en' => 'Front', 'ja' => '表面' ),
		$label_2 ? array( 'en' => '02', 'ja' => $label_2 ) : array( 'en' => 'Back', 'ja' => '裏面' ),
	);
}

function ap_add_works_meta_box() {
	add_meta_box( 'ap_works_info', '制作情報', 'ap_render_works_meta_box', 'works', 'side' );
}
add_action( 'add_meta_boxes', 'ap_add_works_meta_box' );

function ap_render_works_meta_box( $post ) {
	wp_nonce_field( 'ap_works_save', 'ap_works_nonce' );
	$fields      = ap_works_fields();
	$label_keys  = array( 'ap_label_1', 'ap_label_2' );
	$print_field = function ( $key ) use ( $fields, $post ) {
		printf(
			'<p><label for="%1$s">%2$s</label><br><input type="text" id="%1$s" name="%1$s" value="%3$s" style="width:100%%"></p>',
			esc_attr( $key ),
			esc_html( $fields[ $key ] ),
			esc_attr( get_post_meta( $post->ID, $key, true ) )
		);
	};

	foreach ( array_diff( array_keys( $fields ), $label_keys ) as $key ) {
		$print_field( $key );
	}

	// 2枚目の画像（チラシの裏面、バナーの別パターンなど）。1枚目はアイキャッチ画像を使う
	$back_id = (int) get_post_meta( $post->ID, 'ap_back_image', true );
	?>
	<hr>
	<p><strong>2枚目の画像（チラシの裏面・別パターンなど）</strong><br>
	<span class="description">1枚目は「アイキャッチ画像」に設定してください。</span></p>
	<div class="ap-back-image__preview"><?php echo $back_id ? wp_get_attachment_image( $back_id, 'medium' ) : ''; ?></div>
	<input type="hidden" name="ap_back_image" class="ap-back-image__id" value="<?php echo esc_attr( $back_id ? $back_id : '' ); ?>">
	<p>
		<button type="button" class="button ap-back-image__select">画像を選択</button>
		<button type="button" class="button-link ap-back-image__remove"<?php echo $back_id ? '' : ' hidden'; ?>>削除</button>
	</p>
	<?php
	foreach ( $label_keys as $key ) {
		$print_field( $key );
	}

	// 3枚以上の作品（バナー集・サムネイル集など）
	$gallery = ap_get_gallery( $post->ID );
	?>
	<hr>
	<p><strong>作品画像（3枚以上のとき）</strong><br>
	<span class="description">バナー集などをまとめて載せるときに使います。ここに登録すると、こちらが優先して表示されます。</span></p>
	<div class="ap-gallery__preview" style="display:flex;flex-wrap:wrap;gap:6px">
		<?php foreach ( $gallery as $gid ) : ?>
			<?php echo wp_get_attachment_image( $gid, 'thumbnail', false, array( 'style' => 'width:60px;height:60px;object-fit:cover' ) ); ?>
		<?php endforeach; ?>
	</div>
	<input type="hidden" name="ap_gallery" class="ap-gallery__ids" value="<?php echo esc_attr( implode( ',', $gallery ) ); ?>">
	<p>
		<button type="button" class="button ap-gallery__select">画像を選択（複数可）</button>
		<button type="button" class="button-link ap-gallery__remove"<?php echo $gallery ? '' : ' hidden'; ?>>すべて削除</button>
	</p>

	<?php $pages = ap_get_ids_meta( $post->ID, 'ap_pages' ); ?>
	<hr>
	<p><strong>ページ全体の画像（WEBサイト用）</strong><br>
	<span class="description">詳細ページだけに表示されます。画像の「タイトル」が見出しになります（例：トップ、当院について）。横幅1000px以上はPC、それ未満はスマホとして並びます。</span></p>
	<div class="ap-pages__preview" style="display:flex;flex-wrap:wrap;gap:6px">
		<?php foreach ( $pages as $pid ) : ?>
			<?php echo wp_get_attachment_image( $pid, 'thumbnail', false, array( 'style' => 'width:60px;height:60px;object-fit:cover' ) ); ?>
		<?php endforeach; ?>
	</div>
	<input type="hidden" name="ap_pages" class="ap-pages__ids" value="<?php echo esc_attr( implode( ',', $pages ) ); ?>">
	<p>
		<button type="button" class="button ap-pages__select">画像を選択（複数可）</button>
		<button type="button" class="button-link ap-pages__remove"<?php echo $pages ? '' : ' hidden'; ?>>すべて削除</button>
	</p>
	<?php
}

/**
 * カンマ区切りで保存した画像IDのメタを、配列で返す
 */
function ap_get_ids_meta( $post_id, $key ) {
	$raw = (string) get_post_meta( $post_id, $key, true );
	return array_values( array_filter( array_map( 'absint', explode( ',', $raw ) ) ) );
}

/**
 * 3枚以上の作品画像（ギャラリー）のIDを配列で返す
 */
function ap_get_gallery( $post_id ) {
	return ap_get_ids_meta( $post_id, 'ap_gallery' );
}

/**
 * 管理画面：制作実績の編集画面でメディア選択を使えるようにする
 */
function ap_admin_assets( $hook ) {
	if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) || 'works' !== get_current_screen()->post_type ) {
		return;
	}
	wp_enqueue_media();
	wp_enqueue_script( 'ap-admin', get_template_directory_uri() . '/assets/js/admin.js', array( 'jquery' ), ap_asset_ver( 'assets/js/admin.js' ), true );
}
add_action( 'admin_enqueue_scripts', 'ap_admin_assets' );

function ap_save_works_meta( $post_id ) {
	if ( ! isset( $_POST['ap_works_nonce'] ) || ! wp_verify_nonce( $_POST['ap_works_nonce'], 'ap_works_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	foreach ( array_keys( ap_works_fields() ) as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			$value = 'ap_url' === $key ? esc_url_raw( $_POST[ $key ] ) : sanitize_text_field( $_POST[ $key ] );
			update_post_meta( $post_id, $key, $value );
		}
	}
	foreach ( array( 'ap_gallery', 'ap_pages' ) as $key ) {
		if ( ! isset( $_POST[ $key ] ) ) {
			continue;
		}
		$ids = array_filter( array_map( 'absint', explode( ',', sanitize_text_field( $_POST[ $key ] ) ) ) );
		if ( $ids ) {
			update_post_meta( $post_id, $key, implode( ',', $ids ) );
		} else {
			delete_post_meta( $post_id, $key );
		}
	}
	if ( isset( $_POST['ap_back_image'] ) ) {
		$back_id = absint( $_POST['ap_back_image'] );
		if ( $back_id ) {
			update_post_meta( $post_id, 'ap_back_image', $back_id );
		} else {
			delete_post_meta( $post_id, 'ap_back_image' );
		}
	}
}
add_action( 'save_post_works', 'ap_save_works_meta' );

/**
 * 制作物の種類（最初の1つ）を英字ラベルで返す
 * 管理画面で種類のスラッグを「flyer」「lp」などにすると、それが大文字で表示される
 */
function ap_work_type_label( $post_id ) {
	$terms = get_the_terms( $post_id, 'work_type' );
	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return '';
	}
	return strtoupper( str_replace( '-', ' ', $terms[0]->slug ) );
}

/**
 * ナビゲーションのフォールバック（メニュー未設定時）
 */
function ap_fallback_menu() {
	$links = array(
		'ABOUT'   => home_url( '/#about' ),
		'WORKS'   => get_post_type_archive_link( 'works' ),
		'SERVICE' => home_url( '/#service' ),
	);
	echo '<ul class="nav-list">';
	foreach ( $links as $label => $url ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}

/**
 * 制作実績の並び順：「順序」の数字が小さいものから。同じ数字なら新しい順
 */
function ap_works_order_args() {
	return array(
		'menu_order' => 'ASC',
		'date'       => 'DESC',
	);
}

function ap_works_archive_order( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( $query->is_post_type_archive( 'works' ) || $query->is_tax( 'work_type' ) ) {
		$query->set( 'orderby', ap_works_order_args() );
	}
}
add_action( 'pre_get_posts', 'ap_works_archive_order' );

/**
 * お問い合わせフォーム：ご相談の内容の選択肢
 */
function ap_contact_types() {
	return array( 'WEBサイト制作', 'LP制作', 'バナー・印刷物', '画像の修正・高画質化', 'その他' );
}

/**
 * お問い合わせフォームの送信処理（page-contact.php のフォームから送られてくる）
 * 管理者のメールアドレス（設定 → 一般）あてにメールを送る
 */
function ap_handle_contact() {
	$back = home_url( '/contact/' );

	if ( ! isset( $_POST['ap_contact_nonce'] ) || ! wp_verify_nonce( $_POST['ap_contact_nonce'], 'ap_contact' ) ) {
		set_transient( 'ap_contact_last_error', 'フォームの確認コード（nonce）が一致しませんでした。ページを再読み込みしてからお試しください。', HOUR_IN_SECONDS );
		wp_safe_redirect( add_query_arg( 'contact', 'error', $back ) );
		exit;
	}

	// 迷惑メール対策の欄に入力があれば、送信したことにして何もしない
	if ( ! empty( $_POST['ap_website'] ) ) {
		wp_safe_redirect( add_query_arg( 'contact', 'sent', $back ) );
		exit;
	}

	$name    = isset( $_POST['ap_name'] ) ? sanitize_text_field( wp_unslash( $_POST['ap_name'] ) ) : '';
	$email   = isset( $_POST['ap_email'] ) ? sanitize_email( wp_unslash( $_POST['ap_email'] ) ) : '';
	$type    = isset( $_POST['ap_type'] ) ? sanitize_text_field( wp_unslash( $_POST['ap_type'] ) ) : '';
	$message = isset( $_POST['ap_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['ap_message'] ) ) : '';

	if ( '' === $name || ! is_email( $email ) || '' === $message || ! in_array( $type, ap_contact_types(), true ) ) {
		set_transient( 'ap_contact_last_error', '入力チェックで止まりました（名前・メール・内容・種類のどれか）', HOUR_IN_SECONDS );
		wp_safe_redirect( add_query_arg( 'contact', 'error', $back ) );
		exit;
	}

	$subject = sprintf( '[katori design] お問い合わせ：%s 様', $name );
	$body    = "ポートフォリオサイトからお問い合わせがありました。\n\n"
		. "お名前：{$name}\n"
		. "メールアドレス：{$email}\n"
		. "ご相談の内容：{$type}\n\n"
		. "お問い合わせ内容：\n{$message}\n";
	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

	// 送信に失敗したときの理由を、管理者にだけ見えるように一時保存する
	$capture_error = function ( $error ) {
		set_transient( 'ap_contact_last_error', $error->get_error_message(), HOUR_IN_SECONDS );
	};
	add_action( 'wp_mail_failed', $capture_error );

	$sent = wp_mail( get_option( 'admin_email' ), $subject, $body, $headers );
	if ( ! $sent && ! get_transient( 'ap_contact_last_error' ) ) {
		set_transient( 'ap_contact_last_error', 'wp_mail が失敗しました（詳細不明）。送信先：' . get_option( 'admin_email' ), HOUR_IN_SECONDS );
	}

	wp_safe_redirect( add_query_arg( 'contact', $sent ? 'sent' : 'error', $back ) );
	exit;
}
add_action( 'admin_post_nopriv_ap_contact', 'ap_handle_contact' );
add_action( 'admin_post_ap_contact', 'ap_handle_contact' );

/**
 * ページ全体のスクリーンショットのような、縦にとても長い画像は
 * アップロード時に自動で縮小されると細くつぶれてしまうため、縮小しない
 */
function ap_keep_tall_images( $threshold, $imagesize ) {
	if ( ! empty( $imagesize[0] ) && $imagesize[1] > $imagesize[0] * 3 ) {
		return false;
	}
	return $threshold;
}
add_filter( 'big_image_size_threshold', 'ap_keep_tall_images', 10, 2 );

/**
 * ユーザー名が外から見えないようにする
 * ・サイトマップ（wp-sitemap.xml）に投稿者ページを載せない
 * ・投稿者ページ（/author/ユーザー名/）はトップへ移動させる
 */
add_filter( 'wp_sitemaps_add_provider', function ( $provider, $name ) {
	return 'users' === $name ? false : $provider;
}, 10, 2 );

function ap_redirect_author_archive() {
	if ( is_author() ) {
		wp_safe_redirect( home_url( '/' ), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'ap_redirect_author_archive' );
