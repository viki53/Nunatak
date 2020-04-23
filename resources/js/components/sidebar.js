const sidebar = document.querySelector('#sidebar');
const sidebarController = document.querySelector('#sidebar-toggle-input');
const sidebarControllerLabel = document.querySelector('#sidebar-toggle');
const sidebarMediaQuery = window.matchMedia('(min-width: 60rem)');

let sidebarOpen = true;

function updateSidebar() {
	sidebar.setAttribute('aria-hidden', !sidebarOpen);
	sidebarController.checked = sidebarOpen;
	sidebarControllerLabel.setAttribute('aria-expanded', sidebarOpen);
}
function checkSidebarSpace() {
	const shouldBeOpen = sidebarMediaQuery.matches;

	if (shouldBeOpen !== sidebarOpen) {
		sidebarOpen = shouldBeOpen;
		updateSidebar();
	}
}

if (sidebar) {
	// sidebarController.checked.addEventListener('click', (evt) => {
	// 	evt.preventDefault();
	// 	sidebarOpen = !sidebarOpen;
	// 	updateSidebar();
	// })

	checkSidebarSpace();

	window.addEventListener('resize', checkSidebarSpace, { passive: true });
}
else if (sidebarController) {
	sidebarController.parentNode.removeChild(controller);
}
