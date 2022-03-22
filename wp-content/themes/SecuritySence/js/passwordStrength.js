jQuery(document).ready(function($) {


var stopAnim = false;
function animateTitle(scrollingWidth, initialOffset, sss){
    if(!stopAnim ){
    var $a = sss;

    $a.animate({left: (($a.offset().left == (scrollingWidth + initialOffset ))?-initialOffset:("-="+scrollingWidth))}, 
       { 
            duration: 10000, 
            easing: 'swing',
            complete: function(){
                if($a.offset().left < 0){
                    $(this).css("left", scrollingWidth);
                }
                
                animateTitle(scrollingWidth);
       }
       
     });
    }
}
$('.container').hover(
    function () {
	var sss = $(this).find('div.title-holder a');	
        var scrollingWidth = $(this).find('div.title-holder').find('a').width();
       scrollingWidth = scrollingWidth + 10;
        var initialOffset = $(this).find('div.title-holder').find('a').offset().left;
        stopAnim = false;
       animateTitle(scrollingWidth, initialOffset, sss);
    },
    function () {
        stopAnim  = true;
        $(this).find('div.title-holder a').stop(true, true).css("left", "0");
    }
);





$(".scrollText").hover(function(){
    scroll($(this));
});

function scroll(ele){

    var s = $(ele).text().substr(1)+$(ele).text().substr(0,1);
    $(ele).text(s);
}

	$('#password').keyup(function(){
		$('#result').html(checkStrength($('#password').val()))
	});	
	
	function checkStrength(password){
    
	//initial strength
    var strength = 0
	
    //if the password length is less than 6, return message.
    if (password.length < 1) { 
		$('#result').removeClass()
		$('#result').addClass('short')
		return '' 
	}
    
	if (password.length < 3) { 
		$('#result').removeClass()
		return 'Too short' 
	}
    
    //length is ok, lets continue.
	
	//if length is 8 characters or more, increase strength value
	if (password.length > 7) strength += 1
	
	//if password contains both lower and uppercase characters, increase strength value
	if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
	
	//if it has numbers and characters, increase strength value
	if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 
	
	//if it has one special character, increase strength value
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
	
	//if it has two special characters, increase strength value
    if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
	
	//now we have calculated strength value, we can return messages
	
	//if value is less than 2
	if (strength < 2 ) {
		$('#result').removeClass()
		$('#result').addClass('weak')
		return 'Weak'			
	} else if (strength == 2 ) {
		$('#result').removeClass()
		$('#result').addClass('good')
		return 'Good'		
	} else {
		$('#result').removeClass()
		$('#result').addClass('strong')
		return 'Strong'
	}
}
});
