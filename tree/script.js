/* Setting all li's draggable */

/* Handling drop */
const tree = document.querySelector('.tree');
let draggedElement;
tree.addEventListener('dragstart', event => {
	event.stopPropagation();
	draggedElement = event.target;
});
tree.addEventListener('dragover', event => event.preventDefault());
tree.addEventListener('drop', event => {
	event.stopPropagation();
	let currentElement = event.target;
	if(!draggedElement.contains(currentElement)) {
		const form = document.forms[0],
		input = document.createElement('input');
		input.type = 'hidden';
		const inputClone = input.cloneNode();
		input.name = 'source';
		input.value = draggedElement.dataset.path;
		inputClone.name = 'destination';

		if(currentElement.classList.contains('tree'))
			inputClone.value = '';
		else {
			while(!currentElement.dataset.hasOwnProperty('path'))
				currentElement = currentElement.parentNode;
			inputClone.value = currentElement.dataset.path;
		}
		
		form.appendChild(inputClone);
		form.appendChild(input);
		form.submit();
	}
});

/* Toggle all checkboxes */
const checkboxes = [...document.querySelectorAll('[type=checkbox]')];
let toggle = true;
function toggles() {
	checkboxes.forEach(element => {
		toggle = !toggle;
		element.checked = toggle;
	});
}

document.querySelector('#show-all').addEventListener('click', event => checkboxes.forEach(element => {
	element.checked = event.currentTarget.checked;
}));
