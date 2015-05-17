function main(){

	$('.enterEmail').bind('keyup', function(e) {

	    if ( e.keyCode === 13 ) { // 13 is enter key

	    	var userEmail = $('.enterEmail').val();
	    	submitEmail(userEmail);

	    }

	});

	$(".submitEmail").click(function(){
		
		var userEmail = $('.enterEmail').val();
	    submitEmail(userEmail);
	
	});

	function submitEmail(userEmail){

		var isEmailValid = isValidEmailAddress(userEmail);
		if(isEmailValid){
			postEmail(userEmail);
		}else{
			alert("Hmm, something looks odd with your email address. Can you try another?");
			return;
		}

	};

	function postEmail(userEmail){

		$.ajax({
	        url: "backend/createLead.php",
	        type: 'POST',
	        crossDomain: false,
	        dataType: 'json',
	        data: {email:userEmail},
	        async: true,
	        cache: false,
	        error: function(data){
	            console.log(data);
	            alert(data.responseJSON.msg);
	            return true;
	        },
	        success: function(data){ 
	        	console.log(data);
	            alert("Thanks! "+userEmail+" has been added to the list. We'll be in touch.");
	        }
	    });	

	}

	$(".enterEmail").keyup(function(event){
		var email = $(".enterEmail").val();
		var isEmailValid = isValidEmailAddress(email);
		if(email == ""){
			$(".enterEmail").css("border", "2px solid #cacbcc");
		}else if(isEmailValid){
			$(".enterEmail").css("border", "2px solid #149924");
		}else{
			$(".enterEmail").css("border", "1px solid red");
		}
	});
		

	function isValidEmailAddress(emailAddress) {
	    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
	    return pattern.test(emailAddress);
	};
}