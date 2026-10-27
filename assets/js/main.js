/**
 * スマホメニューの開閉
 */
document.addEventListener('DOMContentLoaded', function () {
	var toggle = document.querySelector('.header__menu-button');
	if (!toggle) return;

	toggle.addEventListener('click', function () {
		var isOpen = document.body.classList.toggle('is-menu-open');
		toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
		toggle.setAttribute('aria-label', isOpen ? 'メニューを閉じる' : 'メニューを開く');
	});

	// メニュー内のリンクを押したら閉じる（ページ内リンク用）
	document.querySelectorAll('.header__nav a').forEach(function (link) {
		link.addEventListener('click', function () {
			document.body.classList.remove('is-menu-open');
			toggle.setAttribute('aria-expanded', 'false');
		});
	});
});
