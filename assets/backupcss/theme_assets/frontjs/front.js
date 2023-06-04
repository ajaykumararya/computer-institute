$('document').ready(function(){
   $('[data-toggle="tooltip"]').tooltip();
   $('#search_plot').on('submit',function(e){
        e.preventDefault();
        var d=new FormData(this);
        var text=$( ".status option:selected" ).text();
        var prop_type=$( ".prop_type option:selected" ).text();
        $('.plot_items').html('');
        $('.textstatus').html(text);
        $.ajax({
    		type: 'POST',
    		url: site_loc + 'finish_prod_search',
    		data: d,
    		contentType: false,
			cache: false,
			processData: false,
			async:false,
    		success: function (msg) {
    		    
    		    if(msg!=''){
        		    $('.plot_items').attr('style','position: unset !important; height:unset !important;');
        		    $('.plot_items').html(msg);
    		    }else{
    		        $('.plot_items').attr('style','position: unset !important; height:unset !important;');
    		        $('.plot_items').html("<div class='col-md-12'><h1>NO DATA AVAILABLE</h1></div>");
    		    }
    		    $('[data-toggle="tooltip"]').tooltip();
    		    $('html, body').animate({
                    scrollTop: $(".portfolio").offset().top
                }, 2000);
               
    		}
    	});
    
   });
   
  
   $('#contactformfront').on('submit',function(e){
        e.preventDefault();
        $.ajax({
			type: 'POST',
			url: site_loc + 'insertcontact',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function () {
				$('.contactformfront').attr("disabled", "disabled");
				$('.contactformfront').html("Submitting...");
			},
			success: function (msg) {
				if (msg == "ok") {
				    $('.contactformfront').attr("disabled", false);
				    $('#error').hide();
				    $('#success').show();
				    $('.contactformfront').html("Submit");
				    $('#contactformfront').trigger('reset');
				} else {
				    $('#error').show();
				    $('#success').hide();
					$('.contactformfront').attr("disabled", false);
					$('.contactformfront').html("Submit");
					$('#contactformfront').trigger('reset');
				}
			}
		});
   });
   
    $("body").floatingSocialShare({
    buttons: [
      "facebook","twitter","linkedin", 
      "telegram", "whatsapp"
    ],
    text: "share with: ",
    url: "miplhousing.com"
  });
});
