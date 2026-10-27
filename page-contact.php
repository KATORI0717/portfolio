<?php
/**
 * お問い合わせページ（スラッグ contact の固定ページで使われる）
 * 送信処理は functions.php の ap_handle_contact()
 */
get_header();

$status = isset( $_GET['contact'] ) ? sanitize_key( $_GET['contact'] ) : '';
$types  = ap_contact_types();
?>

<section class="page-head contact-head">
	<p class="section-bg-en section-bg-en--right en" aria-hidden="true">Contact</p>
	<div class="section-head">
		<span class="label">( CONTACT )</span>
		<h1 class="heading">お問い合わせ</h1>
	</div>
	<p class="contact-page__lead">
		お仕事のご相談・ご依頼は、こちらのフォームからお気軽にどうぞ。<br class="pc-only">
		「何から決めればよいかわからない」という段階でも大丈夫です。<br class="pc-only">
		内容を確認のうえ、原則24時間以内にご返信いたします。
	</p>
</section>

<div class="contact-page">
	<?php if ( 'sent' === $status ) : ?>
		<div class="contact-page__message is-success" role="status">
			<p class="en">Thank you</p>
			<p>お問い合わせを受け付けました。<br>内容を確認のうえ、ご連絡いたします。</p>
			<a class="btn btn--outline" href="<?php echo esc_url( home_url( '/' ) ); ?>">トップへ戻る</a>
		</div>
	<?php else : ?>
		<?php if ( 'error' === $status ) : ?>
			<p class="contact-page__message is-error" role="alert">入力内容に不足があるか、送信に失敗しました。お手数ですが、もう一度お試しください。
				<?php
				// 管理者がログインしているときだけ、失敗した理由を表示する
				$last_error = get_transient( 'ap_contact_last_error' );
				if ( $last_error && current_user_can( 'manage_options' ) ) :
					?>
					<br><small>【管理者にだけ表示】<?php echo esc_html( $last_error ); ?></small>
				<?php endif; ?>
			</p>
		<?php endif; ?>

		<form class="contact-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
			<input type="hidden" name="action" value="ap_contact">
			<?php wp_nonce_field( 'ap_contact', 'ap_contact_nonce' ); ?>

			<!-- 迷惑メール対策：人には見えない欄。入力されていたら送信しない -->
			<p class="contact-form__hp" aria-hidden="true">
				<label>この欄は空のままにしてください<input type="text" name="ap_website" tabindex="-1" autocomplete="off"></label>
			</p>

			<div class="contact-form__row">
				<label for="ap_name">お名前<span class="req">必須</span></label>
				<input type="text" id="ap_name" name="ap_name" required autocomplete="name">
			</div>

			<div class="contact-form__row">
				<label for="ap_email">メールアドレス<span class="req">必須</span></label>
				<input type="email" id="ap_email" name="ap_email" required autocomplete="email">
			</div>

			<div class="contact-form__row">
				<label for="ap_type">ご相談の内容</label>
				<select id="ap_type" name="ap_type">
					<?php foreach ( $types as $type ) : ?>
						<option value="<?php echo esc_attr( $type ); ?>"><?php echo esc_html( $type ); ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="contact-form__row">
				<label for="ap_message">お問い合わせ内容<span class="req">必須</span></label>
				<textarea id="ap_message" name="ap_message" rows="8" required placeholder="ご依頼の内容、ご希望の納期やご予算など、わかる範囲でご記入ください。"></textarea>
			</div>

			<p class="contact-form__note">ご入力いただいた情報は、お問い合わせへの返信のためだけに使用します。</p>

			<button type="submit" class="btn btn--accent contact-form__submit">送信する<span class="arrow" aria-hidden="true"></span></button>
		</form>
	<?php endif; ?>
</div>

<?php get_footer(); ?>
