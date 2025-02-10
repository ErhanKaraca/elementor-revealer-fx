(function (window) {
	'use strict';

	document.addEventListener("DOMContentLoaded", () => {
		const defaults = {
			duration: 500,
			easing: 'easeInOutQuint',
			delay: 0,
			bgcolor: '#000000',
			direction: 'lr',
			coverArea: 0
		};

		document.querySelectorAll(".elementor-reveal-fx").forEach(element => {
			const settings = Object.assign({}, defaults, {
				duration: parseInt(element.dataset.duration) || defaults.duration,
				easing: element.dataset.easing || defaults.easing,
				delay: parseInt(element.dataset.delay) || defaults.delay,
				bgcolor: element.dataset.bgcolor || defaults.bgcolor,
				direction: element.dataset.direction || defaults.direction,
				coverArea: parseInt(element.dataset.coverarea) || defaults.coverArea,
				onCover: (contentEl, revealerEl) => contentEl.style.opacity = 1
			});

			
			var reveal = new RevealFx(element, { revealSettings: settings });
			var watcher = scrollMonitor.create(element, -100);
			watcher.enterViewport(function() {
				reveal.reveal();
				watcher.destroy();
			});
		});
	});

})(window);
