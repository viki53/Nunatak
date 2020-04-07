const sidebar = document.querySelector('#sidebar');
const sidebarControllers = Array.from(document.querySelectorAll('[aria-controls="sidebar"]'));
const sidebarMediaQuery = window.matchMedia('(min-width: 50rem)');

let sidebarOpen = false;

function updateSidebar() {
	sidebar.classList.toggle('open', !!sidebarOpen);
	sidebarControllers.forEach((ctrl) => {
		ctrl.setAttribute('aria-expanded', !!sidebarOpen);
	})
}
function checkSidebarSpace() {
	const shouldBeOpen = sidebarMediaQuery.matches;

	if (shouldBeOpen !== sidebarOpen) {
		sidebarOpen = shouldBeOpen;
		updateSidebar();
	}
}

if (sidebar) {
	sidebarControllers.forEach((controller) => {
		controller.addEventListener('click', (evt) => {
			evt.preventDefault();
			sidebarOpen = !sidebarOpen;
			updateSidebar();
		})
	});

	checkSidebarSpace();

	window.addEventListener('resize', (evt) => {
		checkSidebarSpace();
	}, { passive: true });
}
else {
	sidebarControllers.forEach((controller) => {
		controller.parentNode.removeChild(controller);
	})
}
