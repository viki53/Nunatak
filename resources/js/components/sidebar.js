const sidebar = document.querySelector('#sidebar');
const sidebarController = document.querySelector('#sidebar-toggle-input');
const sidebarControllerLabel = document.querySelector('#sidebar-toggle');
const page = document.querySelector('#page');
const sidebarMediaQuery = window.matchMedia('(max-width: 60rem)');

let sidebarOpen = true;

function updateSidebar() {
	sidebar.setAttribute('aria-hidden', !sidebarOpen);

	if (page) {
		page.style.setProperty('--delta-sidebar-slide', sidebarOpen ? '1' : '0');
		page.style.setProperty('--time-sidebar-animation', null);
	}

	sidebarController.checked = sidebarOpen;
	sidebarControllerLabel.setAttribute('aria-expanded', sidebarOpen);
}
function checkSidebarSpace() {
	const shouldBeOpen = !sidebarMediaQuery.matches;

	if (shouldBeOpen !== sidebarOpen) {
		sidebarOpen = shouldBeOpen;
		updateSidebar();
	}
}

let sidebarListenersSet = false;

if (sidebar) {
	checkSidebarSpace();
	setSidebarListeners();

	if (sidebarController) {
		sidebarController.addEventListener('change', (event) => {
			sidebarOpen = !!sidebarController.checked;
			updateSidebar();
		});
	}

	window.addEventListener('resize', checkSidebarSpace, { passive: true });
	window.addEventListener('resize', setSidebarListeners, { passive: true });
}
else if (sidebarController) {
	sidebarController.parentNode.removeChild(controller);
}

function setSidebarListeners() {
	if (sidebarListenersSet || !page || !sidebarMediaQuery.matches) {
		return;
	}

	let originalTouch = null;
	let deltaX = 0;

	page.addEventListener('touchstart', (event) => {
		if (event.touches.length > 1) {
			return;
		}

		originalTouch = event.touches[0];
	});
	page.addEventListener('touchmove', (event) => {
		if (!originalTouch || event.touches.length > 1) {
			return;
		}

		deltaX = event.touches[0].clientX - originalTouch.clientX;
		deltaY = event.touches[0].clientY - originalTouch.clientY;

		if (Math.abs(deltaY) > Math.abs(deltaX)) {
			return;
		}
		if (Math.abs(deltaX) < 5) {
			return;
		}

		let slideRatio = (sidebarOpen ? 1 : 0) + deltaX / sidebar.clientWidth;

		slideRatio = Math.min(1, Math.max(0, slideRatio));

		page.style.setProperty('--delta-sidebar-slide', `${slideRatio}`);
		page.style.setProperty('--time-sidebar-animation', `0`);
	});
	page.addEventListener('touchend', (event) => {
		if (!originalTouch || event.touches.length > 1) {
			return;
		}

		let slideRatio = (sidebarOpen ? 1 : 0) + deltaX / sidebar.clientWidth;

		slideRatio = Math.min(1, Math.max(0, slideRatio));

		if (!sidebarOpen) {
			if (slideRatio > 0.5) {
				sidebarOpen = true;
			}

			updateSidebar();
		}
		else if (sidebarOpen) {
			if (slideRatio < 0.5) {
				sidebarOpen = false;
			}

			updateSidebar();
		}

		originalTouch = null;
		deltaX = 0;
		deltaY = 0;
	});

	sidebarListenersSet = true;
}
