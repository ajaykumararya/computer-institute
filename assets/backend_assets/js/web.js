$(document).ready(function () {
// 	alert('web');
    /*-----------------add enquiry web---------------------*/ 
  $('body').on('change', '.get_category', function () {
		$(this).closest('.row').find('.ccategory option').remove();
		var d = $(this);
		if ($(this).val() != '') {
			$.ajax({
				type: 'POST',
				url: web_loc + 'get_category',
				data: 'brandid=' + $(this).val(),
				dataType: "json",
				// headers: {
				// 	'Client-Service': 'frontend-client',
				// 	'Auth-Key': 'simplerestapi',
				// 	'User-ID': loginid,
				// 	'Authorization': token,
				// 	'type': type
				// },
				// success: function (msg) {
				// console.log(msg);
				// 	$('.ccategory option').remove();
				// 	var str = '';
				// 	str += "<option value=''>--Select Course--</option>";
				// 	$.each(msg, function (index, element) {
				// 		str += "<option value='" + element.id + "'>" + element.course_name + "</option>";
				// 	});
				// 	d.closest('.row').find('.ccategory').append(str);
				// 	//d.closest('.row').find('#category').append(str);
				// },
				success: function (msg) {
				console.log(msg);
					var str = '';
					 $('.ccategory option').remove();
					str += "<option value='0'>--Select Course--</option>";
					$.each(msg, function (index, element) {
						str += "<option value='" + element.id + "'>" + element.course_name + "</option>";
					});
                    $('.ccategory').append(str);
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
				}
			});
		} else {
			var str = '';
			str += "<option value=''>--Select District--</option>";
			$('.city').append(str);
		}
	});
	
	
	$('body').on('change', '.get_course_type', function () {
            
        var d = $(this).val();
		$.ajax({
			type: 'POST',
			url: web_loc + 'get_course_type',
			data:{
			    'course_id':d,
			},
			dataType: "json",
			success: function (msg) {
			console.log(msg);
			   
			   $('.course_type').html(msg);
			   
			},
			error: function (msg) {
				if (msg.responseJSON['status'] == 303) {
					location.href = base_loc;
				}
			}
		});    
	});
	
	
	
	
	$('body').on('change', '.get_year_web', function () {
            
             var d = $(this).val();
            //  var result_id=$(this).attr('result_id');
            //  console.log(result_id);
            //  alert(d);

        			$.ajax({
        				type: 'POST',
        				url: web_loc + 'get_year_web',
        				data:{
        				    'course_id':d,
        				    // 'status':'subjects',
        				    // 'result_id':result_id,
        				},
        				// data: 'course_id=' + d + '&status=' + 'subjects'  , 'result_id=' + result_id,
        				dataType: "json",
        				// headers: {
        				// 	'Client-Service': 'frontend-client',
        				// 	'Auth-Key': 'simplerestapi',
        				// 	'User-ID': loginid,
        				// 	'Authorization': token,
        				// 	'type': type
        				// },
        				success: function (msg) {
        				console.log(msg);
        				   
        				   $('.course_type_web').html(msg);
        				   
        				},
        				error: function (msg) {
        					if (msg.responseJSON['status'] == 303) {
        						location.href = base_loc;
        					}
        				}
        			});    
				
				    
				
				
				
				
			
	});
    $('body').on('submit', "#add_enquiry", function (e) {
	// alert('web');  
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: site_loc + 'add_enquiry',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			
			beforeSend: function () {
				$('.enquiry_btn').attr("disabled", "disabled");
			},
			success: function (msg) {
				
				//console.log(msg);
				if (msg.message == "ok") {
				 	
				 	alert('Message Send Successfully');
				 	    //    location.href = site_loc + 'index';
						  location.reload();
				 	  
				
				// } else {
				// 	show_message('Error', msg.message, 'error');
				// 	$('.editfirm').attr("disabled", false);
				 }else{
				 	alert('Some thing is Missing')
				 }
			},
			error: function (msg) {
				if (msg.responseJSON['status'] == 303) {
					location.href = base_loc;
				}
			}
		});
	});
	
    
    
    $("#login_web").on('submit', function (e) {
	//var check = $('#checked').val();
    // alert('login');
    e.preventDefault();
        $.ajax({
            type: 'POST',
            url: web_loc + 'login_web',
            data: new FormData(this),
			dataType: "json",
            processData: false,
            contentType: false,
            beforeSend: function () {
                // $('.login_btn').attr("disabled", "disabled");
            },
            success: function (msg) {
                console.log(msg);
				// location.reload();
                location.href =  'student-registration' ;
                
            },
            error: function (msg) {
                // console.log(msg);
                if (msg.responseJSON['status'] == 400) {
						alert(msg.responseJSON['message']);
					}
            }
        });
	});
    	/* for logout */	
	
	$('.logout').on('click', function () {
        // alert('in');
       
		$.ajax({
			type: 'POST',
			url: web_loc + 'logout',
			dataType: "json",
			success: function (msg) {
				console.log(msg);
				// location.reload();
				location.href = site_loc;
			},
			error: function (msg) {
			console.log(msg);

				// if (msg.responseJSON['status'] == 303) {
				// //	location.href = base_loc;
				// }
				// if (msg.responseJSON['status'] == 401) {
				// //	location.href = base_loc;
				// }
			}
		});
	});
	
	
	$("#register-form").on('submit', function (e) {

	// alert('inside');
		e.preventDefault();
			$.ajax({
				type: 'POST',
				url: web_loc + 'registration_form',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				
				beforeSend: function () {
					$('.cover').show();
					//$(this).attr("disabled", "disabled");
				},
				success: function (msg) {
    				console.log(msg);
    				location.href =  '/student-registration';
    				// alert('signup successfully');
    				// $('#add_product_type').modal('hide');
    				 $('.cover').hide();
    				//  location.reload();
				},
				error: function (msg,b,n) {
				    console.log(msg.responseText);
				    
					if (msg.responseJSON['status'] == 420) {
						alert(msg.responseJSON['message']);
					}
					if (msg.responseJSON['status'] == 400) {
						//location.href = base_loc;
					}
				}
			});
	});
		$("#subscription").on('submit', function (e) {

// 	alert('inside');
		e.preventDefault();
			$.ajax({
				type: 'POST',
				url: web_loc + 'subscription',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				
				beforeSend: function () {
					$('.cover').show();
					//$(this).attr("disabled", "disabled");
				},
				success: function (msg) {
				console.log(msg);
				// $('#add_product_type').modal('hide');
				 $('.cover').hide();
				 location.reload();
				},
				error: function (msg) {
				// 	if (msg.responseJSON['status'] == 303) {
				// 		location.href = base_loc;
				// 	}
				}
			});
	});
		$("#contact_form").on('submit', function (e) {

	// alert('inside');
		e.preventDefault();
			$.ajax({
				type: 'POST',
				url: web_loc + 'add_enquiry',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				
				beforeSend: function () {
					$('.cover').show();
					//$(this).attr("disabled", "disabled");
				},
				success: function (msg) {
				console.log(msg);
				// $('#add_product_type').modal('hide');
				 $('.cover').hide();
				 location.reload();
				},
				error: function (msg) {
				// 	if (msg.responseJSON['status'] == 303) {
				// 		location.href = base_loc;
				// 	}
				}
			});
	});
// 	search course

/*
	$("#search_course").on('submit', function (e) {
		e.preventDefault();
			$.ajax({
				type: 'POST',
				url: web_loc + 'search_course',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				
				beforeSend: function () {
					$('.cover').show();
					//$(this).attr("disabled", "disabled");
				},
				success: function (msg) {
				console.log(msg);
				    location.href = 'course-detail' + '/'+msg.id;
				 $('.cover').hide();
				},
				error: function (msg) {
			    if (msg.responseJSON['status'] == 420) {
					alert(msg.responseJSON['message']);
				}
				
				}
			});
	});

*/	
	
	
	$("#search_course").on('submit', function (e) {
	    e.preventDefault();
	     var categoryid = $('#basic').val();
        location.href = base_loc + 'course-detail/'+ categoryid;
	});
	
	
	
	
	
// load more courses
    var course=9;
    $(".load-courses").on('click', function (e) {
// alert();

        // var id=$(this).attr('id');
		e.preventDefault();
			$.ajax({
				type: 'POST',
				url: web_loc + 'load_more_courses',
				
				data: {
				    offset:  course,
				    
				    
				},
				dataType: "json",
				beforeSend: function () {
					$('.cover').show();
					//$(this).attr("disabled", "disabled");
				},
				success: function (msg) {
				  console.log(msg);  
				//   return;  
				course+=9;
				// let li = '';
				let div = '';
				$.each(msg, function (index, el) {
				    let img = base_loc+'/uploads/'+el.brand_image;
				    let href = base_loc+'/course-detail/'+el.id;
		
                        div+=`
                                  <div class="col-md-4">
                                                <div class="edu2_cur_wrap">
                                                    <figure>
                                                        <img src="${img}" alt="">
                                                        <figcaption><a href="${href}">See More</a></figcaption>
                                                    </figure>
                                                    <div class="edu2_cur_des">
                                                        
                                                        <h5><a href="#">${el.course_name}</a></h5>
                                                        <strong>
                                                            
                                                        </strong>
                                                        <p>${el.description}</p>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                        `;
   				});
				console.log(div);
				$('#more_course').append(div);
				
					$('.cover').hide();
				
				
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
					if (msg.responseJSON['status'] == 420) {
						alert(msg.responseJSON['message']);
						
							$('.cover').hide();
					}
				}
			});
	});
// load more gallery
var offset=12;
    $(".load-more-gallery").on('click', function (e) {
// alert();
        
        // var id=$(this).attr('id');
		e.preventDefault();
			$.ajax({
				type: 'POST',
				url: web_loc + 'load_more_gallery',
				
				data: {
				    offset:  offset,
				
				    
				},
				dataType: "json",
				beforeSend: function () {
					$('.cover').show();
					//$(this).attr("disabled", "disabled");
				},
				success: function (msg) {
				  console.log(msg);  
				//   return;  
				offset+=12;
				// let li = '';
				let div = '';
				$.each(msg, function (index, el) {
				    let img = base_loc+'/uploads/'+el.BLOG_IMAGE;
				    // let href = base_loc+'/course-detail/'+el.id;
				    div+=`
				        <div class="col-md-3 col-sm-6">
    						
    						<div class="filterable_thumb">
    							<figure>
    								<img src="${img}" alt=""/>
    								<figcaption>${img}" data-rel="prettyPhoto[gallery2]"><i class="fa fa-plus"></i></a></figcaption>
    							</figure>
    						</div>
    						
    					</div>
				    `;
                    
				});
				console.log(div);
				$('#load_gallery').append(div);
				
					$('.cover').hide();
				
				
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
					if (msg.responseJSON['status'] == 420) {
						alert(msg.responseJSON['message']);
						
							$('.cover').hide();
					}
				}
			});
	});
// laod more teacher
var teacher=12;
    $(".load-teacher").on('click', function (e) {
// alert();

        // var id=$(this).attr('id');
		e.preventDefault();
			$.ajax({
				type: 'POST',
				url: web_loc + 'load_more_teacher',
				
				data: {
				    offset:  teacher,
				    
				    
				},
				dataType: "json",
				beforeSend: function () {
					$('.cover').show();
					//$(this).attr("disabled", "disabled");
				},
				success: function (msg) {
				  console.log(msg);  
				//   return;  
				teacher+=12;
				// let li = '';
				let div = '';
				$.each(msg, function (index, el) {
				    let img = base_loc+'/uploads/'+el.MEMBER_PHOTO;
				    let href = base_loc+'/course-detail/'+el.id;
		            div+=`
		                <div class="col-lg-3 col-md-4 col-sm-6">
    						
							<div class="edu2_faculty_des">
										<figure><img src="${img}" alt=""/>
											<figcaption>
												<a href="#"><i class="fa fa-facebook"></i></a>
												<a href="#"><i class="fa fa-twitter"></i></a>
												<a href="#"><i class="fa fa-linkedin"></i></a>
												<a href="#"><i class="fa fa-google-plus"></i></a>
											</figcaption>
										</figure>
										<div class="edu2_faculty_des2">
											<h6><a href="#">${el.MEMBER_NAME}</a></h6>
											<strong>${el.MEMBER_POST}</strong>
											<p>${el.MEMBER_ABOUT_US}</p>
										</div>
									</div>
							
    					</div>
		            `;
                        // div+=`
                        //           <div class="col-md-4">
                        //                         <div class="edu2_cur_wrap">
                        //                             <figure>
                        //                                 <img src="${img}" alt="">
                        //                                 <figcaption><a href="${href}">See More</a></figcaption>
                        //                             </figure>
                        //                             <div class="edu2_cur_des">
                                                        
                        //                                 <h5><a href="#">${el.course_name}</a></h5>
                        //                                 <strong>
                                                            
                        //                                 </strong>
                        //                                 <p>${el.description}</p>
                        //                             </div>
                                                    
                        //                         </div>
                        //                     </div>
                        // `;
   				});
				console.log(div);
				$('#more_teacher').append(div);
				
					$('.cover').hide();
				
				
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
					if (msg.responseJSON['status'] == 420) {
						alert(msg.responseJSON['message']);
						
							$('.cover').hide();
					}
				}
			});
	});
// load eveents
var events=4;
    $(".load-events").on('click', function (e) {
// alert();

        // var id=$(this).attr('id');
		e.preventDefault();
			$.ajax({
				type: 'POST',
				url: web_loc + 'load_more_events',
				
				data: {
				    offset:  events,
				    
				    
				},
				dataType: "json",
				beforeSend: function () {
					$('.cover').show();
					//$(this).attr("disabled", "disabled");
				},
				success: function (msg) {
				//   console.log(msg);  
				//   return;  
				events+=4;
				// let li = '';
				let div = '';
				$.each(msg, function (index, el) {
				    let timestamp=el.BLOG_TT;
                    let date=new Date(timestamp) ;
                    let day = date.getDate();
                    // console.log(date);
                    let month = date.toLocaleString('en-us', { month: 'short' });
				    let img = base_loc+'/uploads/'+el.BLOG_IMAGE;
				    let href = base_loc+'/blog-detail/'+el.BLOG_ID;
				    div+=`
				        <div class="col-md-6">
							<div class="edu2_event_wrap">
							    
								<div class="edu2_event_des">
									<h4>${month}</h4>
									<p>${el.BLOG_TITLE}</p>
									
									<a href="${href}" class="readmore">read more<i class="fa fa-long-arrow-right"></i></a>
									<span>${day}</span>
								</div>
									
								<figure><img src="${img}" alt=""/>
									<figcaption><a href="${href}"><i class="fa fa-plus"></i></a></figcaption>
								</figure>
							</div>
						</div>
				    `;
		  //          div+=`
		  //              <div class="col-lg-3 col-md-4 col-sm-6">
    						
				// 			<div class="edu2_faculty_des">
				// 						<figure><img src="${img}" alt=""/>
				// 							<figcaption>
				// 								<a href="#"><i class="fa fa-facebook"></i></a>
				// 								<a href="#"><i class="fa fa-twitter"></i></a>
				// 								<a href="#"><i class="fa fa-linkedin"></i></a>
				// 								<a href="#"><i class="fa fa-google-plus"></i></a>
				// 							</figcaption>
				// 						</figure>
				// 						<div class="edu2_faculty_des2">
				// 							<h6><a href="#">${el.MEMBER_NAME}</a></h6>
				// 							<strong>${el.MEMBER_POST}</strong>
				// 							<p>${el.MEMBER_ABOUT_US}</p>
				// 						</div>
				// 					</div>
							
    // 					</div>
		  //          `;
                        
   				});
				console.log(div);
				$('#more_events').append(div);
				
					$('.cover').hide();
				
				
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
					if (msg.responseJSON['status'] == 420) {
						alert(msg.responseJSON['message']);
						
							$('.cover').hide();
					}
				}
			});
	});
var blogs=12;
    $(".load-blogs").on('click', function (e) {
// alert();

        // var id=$(this).attr('id');
		e.preventDefault();
			$.ajax({
				type: 'POST',
				url: web_loc + 'load_more_blogs',
				
				data: {
				    offset:  blogs,
				    
				    
				},
				dataType: "json",
				beforeSend: function () {
					$('.cover').show();
					//$(this).attr("disabled", "disabled");
				},
				success: function (msg) {
				//   console.log(msg);  
				//   return;  
				blogs+=12;
				// let li = '';
				let div = '';
				$.each(msg, function (index, el) {
				    let timestamp=el.BLOG_TT;
                    let date=new Date(timestamp) ;
                    let day = date.getDate();
                    // console.log(date);
                    let month = date.toLocaleString('en-us', { month: 'short' });
				    let img = base_loc+'/uploads/'+el.BLOG_IMAGE;
				    let href = base_loc+'/blog-detail/'+el.BLOG_ID;
				    div+=`
				        <div class="col-md-4">
    						<!--BLOG 3 WRAP START-->
    						<div class="blog_3_wrap">
    							<!--BLOG 3 SIDE BAR START-->
    							<ul class="blog_3_sidebar">
    								<li>
										<a href="#">
											${day}
											<span>${month}</span>
										</a>
									</li>
								
    							</ul>
    							<div class="blog_3_des">
									<figure>
										<img src="${img}" alt=""/>
										<figcaption><a href="${href}"><i class="fa fa-search-plus"></i></a></figcaption>
									</figure>
									<h5>${el.BLOG_TITLE}</h5>
									<p>${el.BLOG_DESC}</p>
									<a class="readmore" href="${href}">
										read more
										<i class="fa fa-long-arrow-right"></i>
									</a>
								</div>
								
    						</div>
    						
    					</div>
				    `;
				//     div+=`
				//         <div class="col-md-6">
				// 			<div class="edu2_event_wrap">
							    
				// 				<div class="edu2_event_des">
				// 					<h4>${month}</h4>
				// 					<p>${el.BLOG_TITLE}</p>
									
				// 					<a href="${href}" class="readmore">read more<i class="fa fa-long-arrow-right"></i></a>
				// 					<span>${day}</span>
				// 				</div>
									
				// 				<figure><img src="${img}" alt=""/>
				// 					<figcaption><a href="${href}"><i class="fa fa-plus"></i></a></figcaption>
				// 				</figure>
				// 			</div>
				// 		</div>
				//     `;
		
                        
   				});
				console.log(div);
				$('#more_blogs').append(div);
				
					$('.cover').hide();
				
				
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
					if (msg.responseJSON['status'] == 420) {
						alert(msg.responseJSON['message']);
						
							$('.cover').hide();
					}
				}
			});
	});
		/* get district */

	$('body').on('change', '.state', function () {
		$(this).closest('.row').find('.city option').remove();
		var d = $(this).val();
		if (d != '') {
			$.ajax({
				type: 'POST',
				url: web_loc + 'get_state',
				data: 'stateid=' + $(this).val(),
				dataType: "json",
				success: function (msg) {
				console.log(msg);
					var str = '';
					 $('.city option').remove();
					str += "<option value='0'>--Select City--</option>";
					$.each(msg, function (index, element) {
						str += "<option value='" + element.DISTRICT_ID + "'>" + element.DISTRICT_NAME + "</option>";
					});
                    $('.city').append(str);
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
				}
			});
		} else {
			var str = '';
			str += "<option value=''>--Select District--</option>";
			$('.city').append(str);
		}
	});
	
	
	
	$('body').on('change', '#residental_state', function () {
		$(this).closest('.row').find('.residental_district option').remove();
		var d = $(this).val();
		if (d != '') {
			$.ajax({
				type: 'POST',
				url: get_loc + 'get_district',
				data: 'stateid=' + $(this).val(),
				dataType: "json",
				success: function (msg) {
				console.log(msg);
				     
					var str = '';
					 $('#residental_district option').remove();
					str += "<option value='0'>--Select District--</option>";
				   
				
					$.each(msg, function (index, element) {
						str += "<option value='" + element.DISTRICT_ID + "'>" + element.DISTRICT_NAME + "</option>";
					});
                    $('#residental_district').append(str);
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
				}
			});
		} else {
			var str = '';
			str += "<option value=''>--Select District--</option>";
			$('#residental_district').append(str);
		}
	});
    
    
//     $('body').on('change', '.get_category', function () {
//         console.log('hellohii');
// 		$(this).closest('.row').find('.ccategory option').remove();
// 		var d = $(this);
// 		if ($(this).val() !== '') {
// 			$.ajax({
// 				type: 'POST',
// 				url: web_loc + 'get_category',
// 				data: 'brandid=' + $(this).val(),
// 				dataType: "json",
// 				success: function (msg) {
// 				console.log(msg);
// 					$('.ccategory option').remove();
// 					var str = '';
// 					str += "<option value=''>--Select Course--</option>";
// 					$.each(msg, function (index, element) {
// 						str += "<option value='" + element.id + "'>" + element.course_name + "</option>";
// 					});
// 					d.closest('.row').find('.ccategory').append(str);
// 					//d.closest('.row').find('#category').append(str);
// 				},
// 				error: function (msg) {
// 					if (msg.responseJSON['status'] == 303) {
// 						location.href = base_loc;
// 					}
// 				}
// 			});
// 		} else {
// 			var str = '';
// 			str += "<option value=''>--Select District--</option>";
// 			$('.city').append(str);
// 		}
// 	});


	$('body').on('change', '.get_sub_category', function () {
		$(this).closest('.row').find('.sub_category option').remove();
		var d = $(this);
		if ($(this).val() !== '') {
			$.ajax({
				type: 'POST',
				url: web_loc + 'get_sub_category',
				data: 'catid=' + $(this).val(),
				dataType: "json",
				success: function (msg) {
				console.log(msg);
					$('.sub_category option').remove();
					var str = '';

					str += "<option value=''>--Select Category--</option>";

					$.each(msg, function (index, element) {
						str += "<option value='" + element.SUB_CAT_ID + "'>" + element.SUB_CAT_NAME + "</option>";
					});
					$('.sub_category').append(str);
					//d.closest('.row').find('.category2').append(str);
				//	d.closest('.row').find('#category2').append(str);
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
				}
			});
		} else {
			var str = '';
			str += "<option value=''>--Select District--</option>";
			$('.city').append(str);
		}
	});
// center login
	$("#center_login").on('submit', function (e) {

	// alert('inside');
		e.preventDefault();
			$.ajax({
				type: 'POST',
				url: web_loc + 'center_login',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				
				beforeSend: function () {
					$('.cover').show();
					//$(this).attr("disabled", "disabled");
				},
				success: function (msg) {
				console.log(msg);
				// location.reload();
 
				// $('#add_product_type').modal('hide');
				// $('.cover').hide();
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
				}
			});
	});
	$("#center_registration").on('submit', function (e) {

// 	alert('inside');
		e.preventDefault();
			$.ajax({
				type: 'POST',
				url: web_loc + 'center_registration',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				
				beforeSend: function () {
					$('.cover').show();
					//$(this).attr("disabled", "disabled");
				},
				success: function (msg) { 
				console.log(msg);
				    console.log(msg);
				    if(msg.FORM){
				        var form = $(msg.FORM);
				        $('body').append(form); 
				        form.submit();
				    }
    				 $('.cover').hide();
    				//  location.reload();
				},
				error: function (msg,v,c) {
				// 	if (msg.responseJSON['status'] == 303) {
				// 		location.href = base_loc;
				// 	}
				    console.log(msg.responseText);
				}
			});
	});
// student registration
	$("#student_registration").on('submit', function (e) {

	// alert('inside');
		e.preventDefault();
			$.ajax({
				type: 'POST',
				url: web_loc + 'student_registration',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				
				beforeSend: function () {
					$('.cover').show();
					//$(this).attr("disabled", "disabled");
				},
				success: function (msg) {
				console.log(msg);
				if(msg.FORM){
			        var form = $(msg.FORM);
			        $('body').append(form); 
			        form.submit();
			    }
				$('.cover').hide();
				
				// alert(msg.responseJSON['message']);
				// if (msg.responseJSON['status'] == 200) {
				// 		alert(msg.responseJSON['message']);
					//	location.reload();
				// 	}
				
 
				// $('#add_product_type').modal('hide');
				
				},
				error: function (msg,v,c) {
				    console.warn(msg.responseText);
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
					if (msg.responseJSON['status'] == 420) {
						alert(msg.responseJSON['message']);
					}
				}
			});
	});

    
	
	
});
