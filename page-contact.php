<?php get_header();

$status = isset( $_GET['contact'] )?sanitize_key( $_GET['contact'] ): '';
$types = ap_contact_types();
?>

<div class="contact-page">
	<p class="contact-page__bg-text"aria-hidden="true">Contact</p>
	<div class="contact-page__head">
		<p class="contact-page__label">( CONTACT )</p>
		<h1 class="contact-page__title">お問い合わせ</h1>
		<p class="contact-page__lead">お仕事のご相談・ご依頼は、こちらのフォームからお気軽にどうぞ。<br class="contact-page__br">「何から決めればよいかわからない」という段階でも大丈夫です。<br class="contact-page__br">内容を確認のうえ、原則24時間以内にご返信いたします。</p>
	</div>

	<?php if ( 'sent' === $status ) :?>
		<div class="contact-page__message contact-page__message--success" role="status">
			<p class="contact-page__thanks">Thank you</p>
			<p>お問い合わせを受け付けました。<br>内容を確認のうえ、ご連絡いたします。</p>
			<a class="contact-page__top-link" href="<?php echo esc_url(home_url( '/' ) ); ?>">トップへ戻る</a>
		</div>
		<?php else : ?>
		<?php if ( 'error' === $status ) : ?>
			<p class="contact-page__message contact-page__message--error" role="alert">入力内容に不足があるか、送信に失敗しました。お手数ですが、もう一度お試しください。
				<?php $last_error = get_transient('ap_contact_last_error'); if ( $last_error && current_user_can ( 'manage_options' ) ) : ?>
					<br><small>【管理者にだけ表示】<?php echo esc_html( $last_error); ?></small>
					<?php endif; ?>
			</p>
		<?php endif; ?>

		<form class="contact-form" action="<?php echo esc_url(admin_url( 'admin-post.php' ) ); ?>" method="post">
			<input type="hidden" name="action" value="ap_contact">
			<?php wp_nonce_field( 'ap_contact' , 'ap_contact_nonce' ); ?>

			<p class="contact-form__hp" aria-hidden="true">
				<label>この欄は空のままにしてください<input type="text" name="ap_website" tabindex="-1" autocomplete="off"></label>
			</p>

			<div class="contact-form__row">
				<label class="contact-form__label" for="ap_name">お名前<span class="contact-form__required">必須</span></label>
				<input class="contact-form__input" type="text" id="ap_name" name="ap_name" required autocomplete="name">
			</div>

			<div class="contact-form__row">
				<label class="contact-form__label" for="ap_email">メールアドレス<span class="contact-form__required">必須</span></label>
				<input class="contact-form__input" type="email" id="ap_email" name="ap_email" required autocomplete="email">
			</div>

			<div class="contact-form__row">
				<label class="contact-form__label" for="ap_type">ご相談の内容</label>
				<select class="contact-form__input" id="ap_type" name="ap_type">
					<?php foreach ( $types as $type ) : ?>
					<option value="<?php echo esc_attr( $type ); ?>"><?php echo esc_html( $type ); ?></option>
					<?php endforeach; ?>
				</select>
			</div> 

			<div class="contact-form__row">
				<label class="contact-form__label" for="ap_message">お問い合わせ内容<span class="contact-form__required">必須</span></label>
				<textarea class="contact-form__input contact-form__input--textarea" id="ap_message" name="ap_message" rows="8" required placeholder="ご依頼の内容、ご希望の納期やご予算など、わかる範囲でご記入ください。"></textarea>
			</div>
			
			<p class="contact-form__note">ご入力いただいた情報は、お問い合わせへの返信のためだけに使用します。</p>
			<button class="contact-form__submit" type="submit">送信する</button>
		</form>
		<?php endif; ?>

	</div>

	<?php get_footer(); ?>


