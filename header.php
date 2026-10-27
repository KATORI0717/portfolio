<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); /* WordPressがCSSやタイトルを読み込む場所。消さない */ ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); /* 消さない */ ?>

<!--
	ここに、サイト共通のヘッダーを書きます。
	・ロゴ（トップへのリンク）
	・ナビゲーション（ABOUT / WORKS / SERVICE / CONTACT）
	・スマホ用のメニューボタン

	使えるURL（コピーして href="" の中に入れる）
	トップ　　：<?php echo esc_url( home_url( '/' ) ); ?>
	ABOUT 　　：<?php echo esc_url( home_url( '/#about' ) ); ?>
	WORKS一覧 ：<?php echo esc_url( get_post_type_archive_link( 'works' ) ); ?>
	SERVICE 　：<?php echo esc_url( home_url( '/#service' ) ); ?>
	お問い合わせ：<?php echo esc_url( home_url( '/contact/' ) ); ?>
-->

<header class="header">
	<!--ロゴ：トップページではh1、他のページではpにする -->
	<?php if ( is_front_page() ) : ?>
		<h1 class="header__logo">
			<a class="header__logo-link" href="<?php echo esc_url(home_url('/') ); ?>">
				<span class="header__logo-name">katori design</span>
				<span class="header__logo-sub">WEB DESIGN</span>
			</a>
		</h1>
	<?php else : ?>
		<p class="header__logo">
			<a class="header__logo-link" href="<?php echo esc_url(home_url('/')); ?>">
				<span class="header__logo-name">katori design</span>
				<span class="header__logo-sub">WEB DESIGN</span>
			</a>
		</p>
	<?php endif; ?>

	<!-- スマホ用のメニューボタン：押すとメニューが開く -->
	<button class="header__menu-button" type="button" aria-label="メニューを開く" aria-expanded="false" aria-controls="header-nav">
		<span class="header__menu-line"></span>
		<span class="header__menu-line"></span>
	</button>

	<!-- メニュー -->
	<nav class="header__nav" id="header-nav" aria-label="メインメニュー">
		<ul class="header__nav-list">
			<li class="header__nav-item"><a class="header__nav-link" href="<?php echo esc_url( home_url( '/#about' )); ?>">ABOUT</a></li>
			<li class="header__nav-item"><a class="header__nav-link" href="<?php echo esc_url(get_post_type_archive_link( 'works' )); ?>">WORKS</a></li>
			<li class="header__nav-item"><a class="header__nav-link" href="<?php echo esc_url( home_url( '/#service' )); ?>">SERVICE</a></li>
		</ul>
		<a class="header__contact" href="<?php echo esc_url(home_url('/contact/' )); ?>">CONTACT</a>
	</nav>
</header>
<!-- メインの中身の始まり。閉じタグ </main> は footer.php にあります -->
<main>
