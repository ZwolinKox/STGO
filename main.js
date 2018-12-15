document.addEventListener('DOMContentLoaded', () =>  {

	let buttons = document.querySelectorAll('.href');
		
	for(let i = 0; i < buttons.length; i++) {
		const thisButton = buttons[i];
		buttons[i].addEventListener('click', () => {
			location.href = thisButton.id;
		})
	}
	
	buttons = document.querySelectorAll('.href-blank');
	
	for(let i = 0; i < buttons.length; i++) {
		buttons[i].addEventListener('click', () => {
			window.open(buttons[i].id, '_blank');
	})
	
	}
})