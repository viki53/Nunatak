const Quill = require('quill');

const textEditor = document.querySelectorAll('[data-text-editor]');

Array.from(textEditor).forEach((textarea) => {
	const editor = document.createElement('div');
	editor.className = textarea.className;
	editor.classList.add('text-editor');
	editor.id = textarea.id + '_editor';
	editor.innerHTML = textarea.value;

	textarea.parentElement.insertBefore(editor, textarea.nextElementSibling);

	textarea.hidden = true;

	const pageEditorQuill = new Quill(`#${editor.id}`, {
		theme: 'snow',
		scrollingContainer: `#${editor.id}`,
		formats: [
			'bold',
			'italic',
			'strike',
			'underline',
			'script',
			'code',
			'link',
			'header',
			'blockquote',
			'list',
			'image',
			'video',
		],
		modules: {
			toolbar: [
				[{ 'header': [1, 2, 3, 4, 5, 6, false] }],
				['bold', 'italic', 'underline', 'strike'],
				['link'],
				[{ 'script': 'sub' }, { 'script': 'super' }],
				[{ 'list': 'ordered' }, { 'list': 'bullet' }],
				['blockquote', 'image', 'video'],
				['clean']
			]
		}
	});

	pageEditorQuill.on('text-change', (delta) => {
		textarea.innerHTML = pageEditorQuill.root.innerHTML;
	});

	const labels = document.querySelectorAll(`label[for="${textarea.id}"]`);
	Array.from(labels).forEach((label) => {
		label.setAttribute('for', editor.id);
		label.addEventListener('click', () => {
			pageEditorQuill.focus();
		});
	})
});
