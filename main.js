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


	let b = [];
	b.push(document.querySelector('.1'));
	b.push(document.querySelector('.2'));
	b.push(document.querySelector('.3'));
	b.push(document.querySelector('.4'));
	b.push(document.querySelector('.5'));
	b.push(document.querySelector('.6'));
	b.push(document.querySelector('.7'));
	b.push(document.querySelector('.8'));
	b.push(document.querySelector('.9'));

	
	window.addEventListener('keydown', function(event) {
			
			const key = event.keyCode;
			
			switch(key)
			{
				case 97:
				location.href = b[0].id; break;
				case 98:
				location.href = b[1].id; break;
				case 99:
				location.href = b[2].id; break;
				case 100:
				location.href = b[3].id; break;
				case 101:
				location.href = b[4].id; break;
				case 102:
				location.href = b[5].id; break;
				case 103:
				location.href = b[6].id; break;
				case 104:
				location.href = b[7].id; break;
				
			}
		
	}, false);


	
})