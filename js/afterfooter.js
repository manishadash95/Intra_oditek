// JavaScript Document
//  Find any element starting with a # in the URL
	//  And listen to any click events it fires
	$('a[href^=""]').click(function() {
		//  Find the target element
		var target = $($(this).attr('href'));

		//  And get its position
		var pos = target.offset(); // fallback to scrolling to top || {left: 0, top: 0};

		//  jQuery will return false if there's no element
		//  and your code will throw errors if it tries to do .offset().left;
		if(pos) {
			//  Scroll the page
			$('html, body').animate({
				scrollTop: pos.top,
				scrollLeft: pos.left
			}, 1000);
		}

		//  Don't let them visit the url, we'll scroll you there
		return false;
	});

	var GoSquared = {acct: 'GSN-396664-U'};
	
	function tick(){
		$('#ticker_01 li:first').slideUp( function () { $(this).appendTo($('#ticker_01')).slideDown(); });
	}
	setInterval(function(){ tick () }, 10000);


	function tick2(){
		$('#ticker_02 li:first').slideUp( function () { $(this).appendTo($('#ticker_02')).slideDown(); });
	}
	setInterval(function(){ tick2 () }, 10000);
	
function showSignuphome(){
	$('#overlay').fadeIn('fast',function(){
		$('#box').animate({'top':'60px'},500);
	});
}

//})();	



window.supportusers=new Array();
$(function() {
	$('#activator, #activator1').click(function(){
		$('#overlay').fadeIn('fast',function(){	$('#box').animate({'top':'60px'},500);	});
	});
	$('#boxclose').click(function(){
		$('#box').animate({'top':'-700px'},500,function(){	$('#overlay').fadeOut('fast');	});
	});
	$('#boxclose1').click(function(){
		$('#box').animate({'top':'-700px'},500,function(){	$('#overlay').fadeOut('fast');	});
	});
	$('#testDiv4').slimscroll({ height: '351px' }).parent().css({  border: '0px',  width:'100%'});
	  
	$('#testDiv5').slimscroll({	height: '351px' }).parent().css({  border: '0px',  width:'100%'});
	
	var id = '#dialog';

	//Get the screen height and width
	var maskHeight = $(document).height();
	var maskWidth = $(window).width();

	//Set heigth and width to mask to fill up the whole screen
	$('#masknew').css({'width':maskWidth,'height':maskHeight});
	
	//transition effect		
	$('#masknew').fadeIn(1000);	
	$('#masknew').fadeTo("slow",0.4);	

	//Get the window height and width
	var winH = $(window).height();
	var winW = $(window).width();
		  
	//Set the popup window to center
	$(id).css('top',  winH/2-$(id).height()/2);
	$(id).css('left', winW/2-$(id).width()/2);

	//transition effect
	$(id).fadeIn(2000); 	
	
	//if close button is clicked
	$('.window .close').click(function (e) {
		e.preventDefault();	
		$('#masknew').hide();
		$('.window').hide();
	});		
	
	//if mask is clicked
	$('#masknew').click(function () {
		$(this).hide();
		$('.window').hide();
	});	
	

	
    // Setup form validation on the #register-form element
     $("#frmemployee").validate({
          
      showErrors: function(errorMap, errorList) {
 
          // Clean up any tooltips for valid elements
          $.each(this.validElements(), function (index, element) {
              var $element = $(element);
 
              $element.data("title", "") // Clear the title - there is no error associated anymore
                  .removeClass("error")
				  .addClass("vborder")
                  .tooltip("destroy");
          });
 
          // Create new tooltips for invalid elements
          $.each(errorList, function (index, error) {
              var $element = $(error.element);
 
              $element.tooltip("destroy") // Destroy any pre-existing tooltip so we can repopulate with new tooltip content
                  .data("title", error.message)
                  .addClass("error")
				  .removeClass("vborder")
                  .tooltip(); // Create a new tooltip based on the error messsage we just set in the title
          });
      },
 
      submitHandler: function(form) {
          //alert("This is a valid form!");
      }
  });
  
$("#btnSavPersonal").on('click', function(){
alert("Hiiiiiiiiii");
	if($("#forceno").valid()){
		alert("HI");
		if($("#rank").valid()){
			if($("#name").valid()){
				if($("#coy").valid()){
					if($("#dcps_no").valid()){
						
					}else{
						$("#dcps_no").focus();
					}
				}else{
					$("#coy").focus();
				}
			}else{
			$("#name").focus();
			}
		}else{
			$("#rank").focus();
		}
	}else{
		alert("Heelo");
		$("#forceno").focus();
	}
    
});
	



		

		
		
			

	
	
	$("#btnquery1").on('click', function(){
		if($("#user_name").valid()){
			if($("#user_email").valid()){
				if($("#user_message").valid()){
						if($("#txtQryCaptcha").valid()){
						var str = jQuery("#frmquery").serialize();
						jQuery("#showmsg111").ajaxStart(function(event, request, settings){
							jQuery(this).html("Please Wait..");
							 });
								jQuery.ajax({
								type: "POST",
								url: "",
								data: str,
								success: function(msg){
								//jQuery("#showmsg111").ajaxComplete(function(event, request, settings){
								if(msg==="Invalid"){
									$("#txtQryCaptcha").tooltip("destroy").data("title","Invalid text entered").addClass("error").removeClass("qvborder").tooltip().focus();
								}else{
									if(msg==="success"){
										jQuery(this).html("Thank you for your inquiry! We will respond shortly!");
										$("#user_name").val("");
										$("#user_email").val("");
										$("#user_message").val("");
										$("#txtQryCaptcha").val("");
										setTimeout(function (){jQuery(this).html("");},10000);
									}else{
										//msg="<img src='image/iconinfo.png' /> &nbsp;"+msg;
										jQuery(this).html(msg);
									}
								}
							 // });        
							}    
						});
						return false;
						}
					}else{
					$("#user_message").focus();
					  }
				}else{
				$("#user_email").focus();
			  }
		}else{
			$("#user_name").focus();
		}
	});

});