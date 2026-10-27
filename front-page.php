<?php get_header(); /* header.php を読み込む */ ?>

<!-- ===== HERO ===== -->
<!--
	・写真：<?php echo ap_img( 'hero.jpg' ); ?>
	・キャッチコピー、ひとこと、「制作実績を見る」リンク
	・スクロールの↓矢印（心電図はやめる）
-->
<div class="hero">
	<!-- 写真（飾りなのでaltは空にする） -->
	 <div class="hero__image">
		<img class="hero__img" src="<?php echo ap_img('hero.jpg'); ?>" alt="">
	</div>

	<div class="hero__body">
		<!-- 飾りの英字：読み上げさせない -->
		 <p class="hero__en" aria-hidden="true">Design<br>with Care</p>
		 <p class="hero__catch">看護の視点で、<br>やさしく伝わるデザインを。</p>
		 <p class="hero__label">( WEB DESIGNER )</p>
		 <p class="hero__lead">医療・美容・子育てのジャンルを中心に、<br>使う人の気持ちに寄りそってデザインしています。</p>
		 <a class="hero__link" href="<?php echo esc_url(get_post_type_archive_link('works')); ?>">制作実績を見る</a>
	</div>

	<!-- スクロールの案内：押すと　ABOUT に移動する -->
	 <a class="hero__scroll" href="#about">
		<span class="hero__scroll-text">SCROLL</span>
		<span class="hero__scroll-arrow" aria-hidden="true"></span>
	</a>
</div>


<!-- ===== ABOUT ===== -->
<!--
	・id="about" を付ける（ナビの「ABOUT」から飛んでくる場所）
	・写真：<?php echo ap_img( 'profile.jpg' ); ?>
	　　　　<?php echo ap_img( 'about-work.jpg' ); ?>
-->
<section class="about" id="about">
	<!-- 飾りの大きな英字：読み上げさせない -->
	 <p class="about__bg-text" aria-hidden="true">About</p>
	 <div class="about__text">
		<p class="about__label">( ABOUT )</p>
		<h2  class="about__title">看護師から、<br>WEBデザイナーへ。</h2>
		<div class="about__body">
				<p>大学病院で10年以上、看護師として患者さんやご家族と向き合ってきました。</p>
				<p>現在は子育てをしながら、WEBデザイナーとして活動しています。<br>「不安な人に、どう伝えたら安心してもらえるか」<br>看護の現場で考え続けてきたことを大切に、「誰に、何を伝えたいのか」から一緒に考えてデザインしています。</p>
		</div>
		<ul class="about__tags">
				<li class="about__tag">医療・介護</li>
				<li class="about__tag">美容・コスメ</li>
				<li class="about__tag">子育て・暮らし</li>
		</ul>
	</div>

	<div class="about__images">
		<img class="about__img about__img--main" src="<?php echo ap_img('profile.jpg'); ?>" alt="プロフィール">
		<img class="about__img about__img--sub" src="<?php echo ap_img('about-work.jpg'); ?>" alt="ノートパソコンとコーヒー">
	</div>
</section>

<!-- ===== WORKS ===== -->
<!--
	・id="works" を付ける
	・見出しの右の「VIEW ALL →」はなし。下の丸いボタンだけ残す
	・作品カードは、下のPHPが4件分並べてくれます。
	　このPHPを、作品を並べる箱（div など）で囲んでください
-->
<section class="works" id="works">
	<p class="works__bg-text" aria-hidden="true">Works</p>

	<div class="works__head">
		<p class="works__label"> ( WORKS )</p>
		<h2 class="works__title">制作実績</h2>
		<p class="works__lead">医療・美容・子育てのジャンルを中心に、<br>WEBサイトから紙ものまで制作しています。</p>
	</div>

	<div class="works__list">
		<?php
		$works = new WP_Query( array(
			'post_type'      => 'works',
			'posts_per_page' => 4,
			'orderby'        => ap_works_order_args(),
		) );
		while ( $works->have_posts() ) :
			$works->the_post();
			get_template_part( 'template-parts/work-card' ); // 作品カード1枚分（template-parts/work-card.php）
		endwhile;
		wp_reset_postdata();
		?>
	</div>

	<a class="works__button" href="<?php echo esc_url(get_post_type_archive_link('works')); ?>">VIEW ALL WORKS</a>
</section>


<!-- ===== SERVICE ===== -->
<!--
	・id="service" を付ける
	・できること3つ、料金のひとこと、制作の流れ
-->
<section class="service" id="service">
	<!-- 飾りの大きな英字：読み上げさせない -->
	 <p class="service__bg-text" aria-hidden="true">Service</p>

	 <div class="service__head">
		<p class="service__label">( SERVICE )</p>
		<h2 class="service__title">できること</h2>
	</div>

	<div class="service__list">
		<div class="service__card">
			<p class="service__card-num" aria-hidden="true">01</p>
			<h3 class="service__card-title">WEBサイト制作</h3>
			<p class="service__card-text">WordPressのオリジナルテーマ制作から、既存テーマを使ったサイト制作まで。ご予算や運用に合わせてご提案します。</p>
		</div>
		<div class="service__card">
			<p class="service__card-num" aria-hidden="true">02</p>
			<h3 class="service__card-title">LP（ランディングページ）制作</h3>
			<p class="service__card-text">お客さまの不安や疑問に先回りして答える構成で、申し込みにつなげます。</p>
		</div>
		<div class="service__card">
			<p class="service__card-num" aria-hidden="true">03</p>
			<h3 class="service__card-title">バナー・印刷物</h3>
			<p class="service__card-text">広告バナーやSNS画像、サムネイル、チラシ・名刺・ショップカードまで。限られたスペースで、目に留まるキャッチと情報を組み立てます。</p>
		</div>
	</div>

	<p class="service__note">料金は、ご相談内容に合わせてお見積もりいたします。まずは<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">お問い合わせ</a>からお気軽にどうぞ。</p>
	<h3 class="service__flow-title">制作の流れ</h3>
	<ol class="service__flow">
		<li class="service__flow-item">ヒアリング</li>
		<li class="service__flow-item">構成・デザイン</li>
		<li class="service__flow-item">コーディング</li>
		<li class="service__flow-item">確認・修正</li>
		<li class="service__flow-item">公開</li>
	</ol>
	</section>

<!-- ===== CONTACT ===== -->
<!--
	・「Let's work together」はスマホでも消さない
	・お問い合わせフォームへのボタン
-->
	<section class="contact" id="contact">
		<p class="contact__bg-text" aria-hidden="true">Let's work together</p>
		<div class="contact__card">
			<p class="contact__en" aria-hidden="true">Contact</p>
			<h2 class="contact__title">お問い合わせ</h2>
			<p class="contact__text">お仕事のご相談・ご依頼は、お気軽にお問い合わせください。</p>
			<a class="contact__button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">お問い合わせフォームへ</a>
		</div>
	</section>


<?php get_footer(); /* footer.php を読み込む */ ?>
