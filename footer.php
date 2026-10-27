<!-- メインの中身の終わり（始まりの <main> は header.php にあります） -->
</main>

<!--
	ここに、サイト共通のフッターを書きます。
	・ロゴ
	・ナビゲーション
	・コピーライト

	今年の西暦を自動で出す：<?php echo esc_html( date( 'Y' ) ); ?>
	（使えるURLは header.php の上のメモと同じです）
-->
<footer class="footer">
	<!-- ロゴ・フッターは見出しにしない -->
	 <p class="footer__logo">
		<a class="footer__logo-link" href="<?php echo esc_url(home_url('/')); ?>">
			<span class="footer__logo-name">katori design</span>
			<span class="footer__logo-sub">WEB DESIGN</span>
		</a>
	</p>

	<nav class="footer__nav" aria-label="フッターメニュー">
		<ul class="footer__nav-list">
			<li class="footer__nav-item"><a class="footer__nav-link" href="<?php echo esc_url( home_url( '/#about' ) ); ?>">ABOUT</a></li>
			<li class="footer__nav-item"><a class="footer__nav-link" href="<?php echo esc_url(get_post_type_archive_link('works')); ?>">WORKS</a></li>
			<li class="footer__nav-item"><a class="footer__nav-link" href="<?php echo esc_url( home_url('/#service')); ?>">SERVICE</a></li>
			<li class="footer__nav-item"><a class="footer__nav-link" href="<?php echo esc_url(home_url('/contact/')); ?>">CONTACT</a></li>
		</ul>
	</nav>

	<small class="footer__copyright">&copy; <?php echo esc_html( date ('Y')); ?> katori design</small>
</footer>

<?php wp_footer(); /* WordPressがJavaScriptを読み込む場所。消さない */ ?>
</body>
</html>
