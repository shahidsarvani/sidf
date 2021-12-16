
function nextItem() {
	var nextItem = document.querySelector('.next');
	if (nextItem) {
		// nextItem.dispatchEvent(new Event('click'));
	} else {
		document.getElementById("sl_detail_step_tab").value = '0';
		operate_steps('11'); /* diverting to thank you page */
	}
}

function video_switcher() {
	const items = document.querySelectorAll('.process-list li');
	const videoContainer = document.querySelector('.video-container');

	items.forEach(function (item, index) {
		item.addEventListener('click', function (e) {
			if($('video#fetch_tab_detail_video').get(0)){
				$('video#fetch_tab_detail_video').addClass('d-none')
			}
			var currentItem = document.querySelector('.current');
			var currentAnimItem = document.querySelector('.animated-current');
			var nextItem = document.querySelector('.next');
			var animatedItems = document.querySelectorAll('.animated');
			if (currentItem) {
				currentItem.classList.remove('current');
			}
			if (currentAnimItem) {
				currentAnimItem.classList.remove('animated-current');
			}
			if (nextItem) {
				nextItem.classList.remove('next');
			}
			if (animatedItems) {
				animatedItems.forEach(function (animatedItem) {
					animatedItem.classList.remove('animated');
				});
			}
			item.classList.add('current')
			var nextSibling = item.nextElementSibling;
			if (nextSibling) {
				nextSibling.classList.add('next');
				var siblings = $(this).siblings();
				var x1 = Math.floor(Math.random() * siblings.length);
				var x2 = Math.floor(Math.random() * siblings.length);

				siblings[x1].classList.add('animated');
				siblings[x2].classList.add('animated');
			}
			var src = item.dataset.src;
			var type = item.dataset.type;
			var loop = ''
			if (index !== items.length - 1) {
				loop = 'loop'; 
			}
			
			document.getElementById("sl_detail_step_tab").value = index + 1;
			
			$(videoContainer).fadeOut('slow', function() {
				videoContainer.innerHTML = '<video autoplay ' + loop + ' class="myVideo" onended="nextItem();"><source src="' + src + '" type="' + type + '">Your browser does not support HTML5 video.</video>';
				$(videoContainer).fadeIn();
				$(videoContainer).addClass('active');
			})
		});
	});
}

/* direct setting if not move in xx seconds script starts */
var max_time = 180;
function noMovement() {
	var cc_current_step = document.getElementById("sl_current_step").value;

	if (max_time == 0) {
		//window.location = "./home-ar.html";
		if (cc_current_step > 0) {
			operate_steps('0'); // go back to home 
		}
		resetGlobal();
	} else {
		max_time--;
	}
}

function resetGlobal() {
	max_time = 180;
}

setInterval(function () { noMovement() }, 1000);
$('html').mousemove(function (event) {
	resetGlobal();
});

$('html').click(function (event) {
	resetGlobal();
});
/* direct setting if not move in xx seconds script starts */