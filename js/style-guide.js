function copyToClipboard(textToCopy) {
	var $temp = $('<input>');
	$('body').append($temp);
	$temp.val( textToCopy ).select();
	document.execCommand('copy');
	$temp.remove();
}

var initialText;
$('.style-guide-color').click(function(){
	copyToClipboard(initialText);
	$(this).fadeOut(200).fadeIn(200);
})

$('.style-guide-color').mouseenter(function(){
	initialText = $(this).text();
	$('span', this).text('Copy');
})

$('.style-guide-color').mouseleave(function(){
	$('span', this).text(initialText);
})

$(document).ready(function(){
	setInterval(function(){
		$('[data-shuffle-font="true"]').each(function(){
			var randomBoolean = Math.random() >= 0.5;
			if(randomBoolean) {
				$(this).toggleClass('italic');
			} else {
				$(this).toggleClass('bold');
			}
		})
	}, 400)
})

$('[contenteditable="true"]:not([data-return="allowed"])').keypress(function(event) {
	return event.which != 13;
})