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
	b.push(document.querySelector('.jeden'));
	b.push(document.querySelector('.dwa'));
	b.push(document.querySelector('.trzy'));
	b.push(document.querySelector('.cztery'));
	b.push(document.querySelector('.piec'));
	b.push(document.querySelector('.szesc'));
	b.push(document.querySelector('.siedem'));
	b.push(document.querySelector('.osiem'));
	b.push(document.querySelector('.dziewiec'));

	
	window.addEventListener('keydown', function(event) {
			
			const key = event.keyCode;
			switch(key)
			{
				case 49:
				location.href = b[0].id; break;
				case 50:
				location.href = b[1].id; break;
				case 51:
				location.href = b[2].id; break;
				case 52:
				location.href = b[3].id; break;
				case 53:
				location.href = b[4].id; break;
				case 54:
				location.href = b[5].id; break;
				case 55:
				location.href = b[6].id; break;
				case 56:
				location.href = b[7].id; break;
				
			}
		
	}, false);

	setInterval(() => {
		$.ajax({
            url: "ajax.php",
            method: "post",
            data: {
                co: "lastLogin"
            }
        })
	}, '1000');

	
})