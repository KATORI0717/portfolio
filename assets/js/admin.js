/**
 * 管理画面：制作実績の「裏面画像」をメディアライブラリから選ぶ
 */
jQuery(function ($) {
	var frame;
	var $box = $('#ap_works_info');

	$box.on('click', '.ap-back-image__select', function (e) {
		e.preventDefault();
		if (!frame) {
			frame = wp.media({
				title: '裏面画像を選択',
				button: { text: 'この画像を使う' },
				library: { type: 'image' },
				multiple: false
			});
			frame.on('select', function () {
				var img = frame.state().get('selection').first().toJSON();
				var url = img.sizes && img.sizes.medium ? img.sizes.medium.url : img.url;
				$box.find('.ap-back-image__id').val(img.id);
				$box.find('.ap-back-image__preview').html('<img src="' + url + '" alt="" style="max-width:100%;height:auto">');
				$box.find('.ap-back-image__remove').prop('hidden', false);
			});
		}
		frame.open();
	});

	$box.on('click', '.ap-back-image__remove', function (e) {
		e.preventDefault();
		$box.find('.ap-back-image__id').val('');
		$box.find('.ap-back-image__preview').empty();
		$(this).prop('hidden', true);
	});

	// 複数の画像を選ぶ欄（3枚以上の作品画像・ページ全体の画像）
	function setupMulti(prefix, title) {
		var frame;
		$box.on('click', '.' + prefix + '__select', function (e) {
			e.preventDefault();
			if (!frame) {
				frame = wp.media({
					title: title,
					button: { text: 'この画像を使う' },
					library: { type: 'image' },
					multiple: 'add'
				});
				frame.on('select', function () {
					var ids = [], html = '';
					frame.state().get('selection').each(function (att) {
						var img = att.toJSON();
						var url = img.sizes && img.sizes.thumbnail ? img.sizes.thumbnail.url : img.url;
						ids.push(img.id);
						html += '<img src="' + url + '" alt="" style="width:60px;height:60px;object-fit:cover">';
					});
					$box.find('.' + prefix + '__ids').val(ids.join(','));
					$box.find('.' + prefix + '__preview').html(html);
					$box.find('.' + prefix + '__remove').prop('hidden', ids.length === 0);
				});
			}
			frame.open();
		});
		$box.on('click', '.' + prefix + '__remove', function (e) {
			e.preventDefault();
			$box.find('.' + prefix + '__ids').val('');
			$box.find('.' + prefix + '__preview').empty();
			$(this).prop('hidden', true);
		});
	}
	setupMulti('ap-gallery', '作品画像を選択（複数可）');
	setupMulti('ap-pages', 'ページ全体の画像を選択（複数可）');
});
