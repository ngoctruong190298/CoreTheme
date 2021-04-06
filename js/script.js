(function ($, window, document) {
    "use strict";

    let CCT2 = window.CCT2 || {};

    var $body		= $('body'),
        $window		= $(window),
        $loading	= $('.cct-load');

	CCT2.StickyMenu = function () {
		var header_height = $('.header-sticky').height();
		$(window).scroll(function () {
			if ($(window).scrollTop() > header_height) {
				$('.header-sticky').addClass('affix-mobile');
			} else {
				$('.header-sticky').removeClass('affix-mobile');
			}
		});
	};

	CCT2.MobileMenu = function() {
		if ($window.width() < cct_script.view_port) {
			$body.addClass('mobile-mode');
		} else {
			$body.removeClass('mobile-mode');
		}

		let toogle_menu = $('#cct-menu-toggle');

		toogle_menu.on('click', function () {
			if ($body.hasClass('open-menu-mobile')) {
				$body.removeClass('open-menu-mobile');
				$('.mobile-menu-bg').remove();
			} else {
				$body.addClass('open-menu-mobile');
				$body.append('<div class="mobile-menu-bg"></div>');

				$('.mobile-menu-bg').on('click', function () {
					$body.removeClass('open-menu-mobile');
					$('.mobile-menu-bg').remove();
				});
			}
		});
	};

	CCT2.Slide = function() {
		let slick = $('.cct-slick');
		if (slick.length) {
			slick.slick();
		}
	};

	CCT2.Select = function() {
		let select = $('select');
		if (select.length) {
			select.amyuiFancySelect();
		}
	};

	CCT2.InputNumber = function() {
		let input = $('.qty');
		if (input.length) {
			input.amyuiNumberInput();
		}
	};

	CCT2.Tabs = function() {
		if ($('.cct-tab-nav').length) {
			$(document).on('click.bs.tab.data-api', '.bs-tab-nav a', function (e) {
				e.preventDefault();
				$(this).tab('show');
			});
		}
	};

	CCT2.Fancybox = function() {
		let fancybox = $('.cct-fancybox');
		if (fancybox.length) {
			fancybox.fancybox();
		}
	};

	CCT2.Masonry = function() {
		let $masonry = $('.cct-masonry');
		if ($masonry.length) {
			$masonry.each(function () {
				let $this	= $(this),
					column	= $this.attr('data-column');

				$this.imagesLoaded(function() {
					$this.isotope({
						itemSelector: '.masonry-item',
						masonry: {
							columnWidth: column
						}
					});
				});
			});
		}
	};

	CCT2.HeaderSearch = function() {
		let wrapper = $('.cct-h-search');

		$('.st').on('click', function () {
			if (wrapper.hasClass('open')) {
				wrapper.removeClass('open');
			} else {
				wrapper.addClass('open');
			}
		});

		$('.close-button').on('click', function () {
			wrapper.removeClass('open');
		});
	};

	CCT2.WooChangeViewMode = function() {
		$('.woocommerce-view-mode a').on('click', function () {
			let content = $(this).parents('.shop-actions').siblings('.products');

			content.removeClass().addClass('products').addClass('mode-' + $(this).attr('data-view'));

		});
	};

	CCT2.EGallery = function() {
		let gallery = $('.cct-elementor-gallery');

		gallery.find('.bar-list .item-name').on('click', function () {
			gallery.find('.bar-list .item-name').removeClass('active');
			gallery.find('.item-gallery').removeClass('active');

			$(this).addClass('active');
			gallery.find('.content-list').find('[data-index="' + $(this).attr('data-index') + '"]').addClass('active');
			CCT2.Masonry();
		});
	};

	CCT2.WooQuickView = function() {
		let $btn = $('.cct-qv-btn');

		$btn.on('click', function (el) {
			el.preventDefault();

			let data = {};

			data['pid'] 	= $(this).attr('data-product');
			data['action']	= 'cct_woocommerce_shop_quickview';

			$.ajax({
				type: 'POST',
				url: cct_script.ajax_url,
				data: data,
				dataType: 'json',
				beforeSend: function () {
					$loading.addClass('open');
				},
				success: function (response) {
					$loading.removeClass('open');

					let popup = $('<div/>', {class: 'cct-popup-quickview'}).append(response);
					$.fancybox.open(popup);
					CCT2.InputNumber();
					CCT2.Select();

				}
			});
		});
	};

	CCT2.WooNotice = function() {
		$(document.body).append('<div id="cct-wc-popup-message" style="display: none;"><div id="cct-wc-message"></div></div>').on('wc_fragments_refreshed', function() {
			$('.quantity input[type="number"]').not('.ni-initialized').amyuiNumberInput();
		}).on('adding_to_cart', function($button, data) {}).on('added_to_cart', function(fragments, cart_hash, $button) {
			let $wrapper;
			$('#cct-wc-message').html(cct_script.product_added);
			$wrapper = $('#cct-wc-popup-message');
			$wrapper.css('margin-left', 0 - $wrapper.width() / 2);
			$wrapper.fadeIn();
			setTimeout(function() {
				return $wrapper.fadeOut();
			}, 2000);
		});
	};

    $(document).ready(function () {
		CCT2.StickyMenu();
		CCT2.Tabs();
		CCT2.Fancybox();
		CCT2.Slide();
		CCT2.Masonry();
		CCT2.Select();
		CCT2.InputNumber();
		CCT2.WooChangeViewMode();
		CCT2.EGallery();
		CCT2.WooQuickView();
		CCT2.MobileMenu();
		CCT2.HeaderSearch();
		CCT2.WooNotice();
    });

    $window.on('resize', function () {
		CCT2.MobileMenu();
    });

	$window.on('load', function () {
		$('.cct-page-load').addClass('loaded');
	});

    $window.on('scroll', function() {

    });

})(jQuery, window, document);
