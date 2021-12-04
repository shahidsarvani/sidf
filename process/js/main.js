
function nextItem() {
    var nextItem = document.querySelector('.next');
    if(nextItem) {
        nextItem.dispatchEvent(new Event('click'));
    }else{
        var lang = $('html').attr('lang');
		operate_steps('11'); /* diverting to thank you page */
        /*if(lang !== 'ar') {
            window.location.href = 'thank-you.html'
        } else {
            window.location.href = 'thank-you-ar.html'
        }*/
    }
}

function video_switcher(){
	const items = document.querySelectorAll('.process-list li');
	const videoContainer = document.querySelector('.video-container');

	items.forEach(function (item) {
		item.addEventListener('click', function (e) {
			var currentItem = document.querySelector('.current');
			var nextItem = document.querySelector('.next');
			var animatedItems = document.querySelectorAll('.animated');
			if (currentItem) {
				currentItem.classList.remove('current');
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
			videoContainer.innerHTML = '<video autoplay class="myVideo" onended="nextItem();"><source src="' + src + '" type="' + type + '">Your browser does not support HTML5 video.</video>';
		});
	});
}

/* direct setting if not move in xx seconds script starts */
var max_time = 180;
function noMovement() {
	var cc_current_step = document.getElementById("sl_current_step").value;
	
	if (max_time == 0) {
		//window.location = "./home-ar.html";
		if(cc_current_step >0){
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