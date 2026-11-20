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
/**
 * 画面に入ったら、1回だけ .is-visible を付ける（ふわっと浮き上がる動き）
 */
document.documentElement.classList.add('is-js');

document.addEventListener('DOMContentLoaded', function () {
	var targets = document.querySelectorAll('.fade-up');

	var observer = new IntersectionObserver(function (entries) {
		entries.forEach(function (entry) {
			if (entry.isIntersecting) {
				entry.target.classList.add('is-visible');
				observer.unobserve(entry.target);
			}
		});
	}, { rootMargin: '0px 0px -10% 0px' });

	targets.forEach(function (target) {
		observer.observe(target);
	});
});