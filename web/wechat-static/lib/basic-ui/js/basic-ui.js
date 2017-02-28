//修复 移动端 css :active 伪类失效
document.addEventListener("touchstart", function () {
}, false);
//window.addEventListener('load', function () {
//	window.FastClick && FastClick.attach(document.body);
//}, false);
//rem单位
(function (doc, win) {
	var docEl = doc.documentElement,
		resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
		recalc = function () {
			var clientWidth = docEl.clientWidth;
			if (!clientWidth) return;
			docEl.style.fontSize = 100 * (clientWidth / 320) + 'px';
		};
	// Abort if browser does not support addEventListener
	if (!doc.addEventListener) return;
	win.addEventListener(resizeEvt, recalc, false);
	doc.addEventListener('DOMContentLoaded', recalc, false);
})(document, window);

var BC_JS = window["BC_JS"] = {};
BC_JS.actionSheet = function (target, option) {
	var $target = $(target);
	var data = $target.data("actionSheet");
	if (!data) {
		data = new BC_JS["animateDiv"](target, {
			animatedClass: "bc-actionsheet-animated",
			animateInClass: "slideInUp",
			animateOutClass: "slideOutDown",
			activeClass: "bc-actionsheet-toggle",
			actionCancelClass: "bc-actionsheet-cancel"
		});
		$target.data("actionSheet", data);
	}

	if (typeof option == "string") {
		data[option]();
	}
	return data;
};

BC_JS.animateDiv = function (selector, option) {

	option = $.extend({
		animatedClass: "bc-actionsheet-animated",
		animateInClass: "slideInUp",
		animateOutClass: "slideOutDown",
		activeClass: "bc-actionsheet-toggle",
		actionCancelClass: "bc-actionsheet-cancel"
	}, option || {});

	var mask = $('<div class="bc-mask"></div>');
	$("body").append(mask);

	var $actionSheet = $(selector);

	mask.click(function () {
		_func.close();
	});

	$actionSheet.find("." + option.actionCancelClass).click(function () {
		_func.close();
	});

	var _func = {
		show: function () {
			mask.show().addClass('bc-mask-toggle');
			$actionSheet.removeClass(option.animateOutClass);
			$actionSheet.addClass(option.animateInClass);
			$actionSheet.addClass(option.animatedClass);
			$actionSheet.addClass(option.activeClass);
			$actionSheet.unbind('animationend').unbind('webkitAnimationEnd');
			$actionSheet.on('animationend', function () {
				$actionSheet.removeClass(option.animateInClass);
				$actionSheet.removeClass(option.animatedClass);
			}).on('webkitAnimationEnd', function () {
				$actionSheet.removeClass(option.animateInClass);
				$actionSheet.removeClass(option.animatedClass);
			});
		},
		close: function () {
			$actionSheet.removeClass(option.animateInClass);
			$actionSheet.addClass(option.animateOutClass);
			$actionSheet.addClass(option.animatedClass);
			$actionSheet.removeClass(option.activeClass);
			$actionSheet.unbind('animationend').unbind('webkitAnimationEnd');
			$actionSheet.on('animationend', function () {
				mask.removeClass('bc-mask-toggle');
				$actionSheet.removeClass(option.animatedClass);
				$actionSheet.removeClass(option.animateOutClass);
				mask.hide();
			}).on('webkitAnimationEnd', function () {
				mask.removeClass('bc-mask-toggle');
				$actionSheet.removeClass(option.animatedClass);
				$actionSheet.removeClass(option.animateOutClass);
				mask.hide();
			});
		}
	};

	return _func;


};


