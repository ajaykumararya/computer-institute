$(document).ready(function () {

	/* for login */
	$("#login").on('submit', function (e) {
    	//var check = $('#checked').val();
		e.preventDefault();
		var check = 1;
        if (check == 1) {
			$.ajax({
				type: 'POST',
				url: get_loc + 'login',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
				},
				beforeSend: function () {
					$('.login_cl').attr("disabled", "disabled");
				},
				success: function (msg) {
				console.log(msg);
				
				//alert(msg.message);
				
					if (msg.message == "ok") {
							location.href = base_loc + 'dashboard';
					} else if(msg.message == 'Unauthorized') {
						location.href = base_loc;
					}else{
						location.href = base_loc;
					} 
				},
				error: function (msg,v,c) {
                    console.warn(msg.responseText);
					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

		}

	});
		/* for logout */





	$('.logoutside').on('click', function () {

		$.ajax({

			type: 'POST',

			url: get_loc + 'logoutside',

			dataType: "json",

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			success: function (msg) {

				location.href = base_loc;



				

			},

			error: function (msg) {

				if (msg.responseJSON['status'] == 303) {

					location.href = base_loc;

				}

				if (msg.responseJSON['status'] == 401) {

					location.href = base_loc;

				}

			}

		});

	});
	$('body').on('change', '.get_submenu', function () {
		$(this).closest('.row').find('.submenu option').remove();
		var d = $(this);
		if ($(this).val() != '') {
			$.ajax({
				type: 'POST',
				url: get_loc + 'get_submenu',
				data: 'sub_id=' + $(this).val(),
				dataType: "json",
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
				$(this).closest('.row').find('.submenu option').remove();
					var str = '';
					str += "<option value=''>--Select submenu--</option>";
			  		if (msg instanceof Object){
                      $.each(msg, function (index, element) {
                        str += "<option value='" + element.id + "'>" + element.submenu + "</option>";
                      });
                    }
					d.closest('.row').find('.submenu').append(str);
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
	
	$("#password_reset").on('submit', function (e) {
    	//var check = $('#checked').val();
		e.preventDefault();
		var check = 1;
        if (check == 1) {
			$.ajax({
				type: 'POST',
				url: get_loc + 'password_reset_req',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
				},
				beforeSend: function () {
					$('.login_cl').attr("disabled", "disabled");
				},
				success: function (msg) {
				console.log(msg);
				return false;
				alert(msg.message);
				
					if (msg.message == "ok") {
							alert('Password Request Send')
							location.href = base_loc;
							
					} else if(msg.message == 'Unauthorized') {
						location.href = base_loc;
					}else{
						location.href = base_loc;
					} 
				},
				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

		}

	});
	
	
    $('body').on('change', '.get_subsubmenu', function () {
        // alert();
		$(this).closest('.row').find('.subsubmenu option').remove();
		var d = $(this);
		if ($(this).val() != '') {
			$.ajax({
				type: 'POST',
				url: get_loc + 'get_subsubmenu',
				data: 'subsub_id=' + $(this).val(),
				dataType: "json",
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
				$(this).closest('.row').find('.subsubmenu option').remove();
				var str = '';
				str += "<option value=''>--Select subsubmenu--</option>";
				if (msg instanceof Object){
					$.each(msg, function (index, element) {
						if(element.subsubmenu != undefined || element.subsubmenu != null){
							str += "<option value='" + element.id + "'>" + element.subsubmenu + "</option>";
						}
					});
				}
				d.closest('.row').find('.subsubmenu').append(str);
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

// get enroll
$('body').on('change', '.get_enroll', function () {
        // alert();
		$(this).closest('.row').find('.enroll option').remove();
		var d = $(this);
console.log($(this).val());
		if ($(this).val() != '') {
			$.ajax({
				type: 'POST',
				url: get_loc + 'get_enroll',
				data: 'center_id=' + $(this).val(),
				dataType: "json",
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
				$(this).closest('.row').find('.enroll option').remove();
				var str = '';
				str += "<option value=''>--Select Enrollment no--</option>";
				if (msg instanceof Object){
					$.each(msg, function (index, element) {
						if(element.enrollment_no != undefined || element.enrollment_no != null){
							str += "<option value='" + element.enrollment_no + "' selected>" + element.enrollment_no +'('+element.name+')'+ "</option>";
						}
					});
				}
				d.closest('.row').find('.enroll').append(str);
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

    $('body').on('change', '.get_roll', function () {
        
        var d = $(this).val();
        // var dataString = 'course_id='+$('#course_id').val()+'&status=subjects';
		//alert(dataString);
		//$(this).closest('.row').find('.subsubmenu option').remove();
	
		if ($(this).val() != '') {
			$.ajax({
				type: 'POST',
				url: get_loc + 'get_roll',
				data: 'enrollment_no=' + $(this).val() + '&status=' + 'get_roll',
				dataType: "json",
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (res) {
				console.log(res);
				var data = res.split('|');
					$('#roll').val(data[0]);
					$('#course_id').val(data[1]);
					$('#data').val(data[2]);
					//return get_subject();

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
		
		
		
		
		 /*------------ start get course ----------------------------------*/    		
        	
    			
        		
        		$.ajax({
    				type: 'POST',
    				url: get_loc + 'get_course_by_enrollment',
    				data: 'enrollment_no=' + d + '&status=' + 'get_courses',
    				dataType: "json",
    				headers: {
    					'Client-Service': 'frontend-client',
    					'Auth-Key': 'simplerestapi',
    					'User-ID': loginid,
    					'Authorization': token,
    					'type': type
    				},
    				success: function (msg) {
    			        $('.append_course').html(msg);
    				
    				
    				},
    				error: function (msg) {
    				    alert('course is no available for this enrollment');
    				}
    			});
        		
        		
    /*----------- end get course ----------------------------------------*/  
		
		
	});
// 	get enroll
//     $('body').on('change', '.get_enroll', function () {
//         // 
//         var d = $(this).val();
//         console.log(d);
//         // var dataString = 'course_id='+$('#course_id').val()+'&status=subjects';
// 		//alert(dataString);
// 		//$(this).closest('.row').find('.subsubmenu option').remove();
	
// 		if ($(this).val() != '') {
// 			$.ajax({
// 				type: 'POST',
// 				url: get_loc + 'get_enroll',
// 				data: 'center_id=' + d,
// 				dataType: "json",
// 				headers: {
// 					'Client-Service': 'frontend-client',
// 					'Auth-Key': 'simplerestapi',
// 					'User-ID': loginid,
// 					'Authorization': token,
// 					'type': type
// 				},
// 				success: function (res) {
// 				console.log(res);
// 				var data = res.split('|');
// 					$('#roll').val(data[0]);
// 					$('#course_id').val(data[1]);
// 					$('#data').val(data[2]);
// 					//return get_subject();
				
        		
//         		/*
//         			$.ajax({
//         				type: 'POST',
//         				url: get_loc + 'get_subject',
//         				data: 'course_id=' + $('#course_id').val() + '&status=' + 'subjects',
//         				dataType: "json",
//         				headers: {
//         					'Client-Service': 'frontend-client',
//         					'Auth-Key': 'simplerestapi',
//         					'User-ID': loginid,
//         					'Authorization': token,
//         					'type': type
//         				},
//         				success: function (msg) {
//         				console.log(msg);
        				   
//         				   $('#list').html(msg);
        				   
//         				},
//         				error: function (msg) {
//         					if (msg.responseJSON['status'] == 303) {
//         						location.href = base_loc;
//         					}
//         				}
//         			});    
				
// 				    */
				
				
				
				
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

    
    
    
    $('body').on('change', '.get_course', function () {
        
        var d = $(this).val();
        // var dataString = 'course_id='+$('#course_id').val()+'&status=subjects';
		//alert(dataString);
		//$(this).closest('.row').find('.subsubmenu option').remove();
	
		if ($(this).val() != '') {
			$.ajax({
				type: 'POST',
				url: get_loc + 'get_course',
				data: 'enrollment_no=' + $(this).val() + '&status=' + 'get_courses',
				dataType: "json",
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (res) {
			
				       var  data = res.split('|');
                       //alert(data[0]);
                       
                        $('#data').val(data[0]);
                        $('#course_id').val(data[1]);
				
				
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
    // get course by enrollment
        $('body').on('change', '#get_course_by_enrollment', function () {
        
        var d = $(this).val();
        // var dataString = 'course_id='+$('#course_id').val()+'&status=subjects';
		//alert(dataString);
		//$(this).closest('.row').find('.subsubmenu option').remove();
	
		if ($(this).val() != '') {
			$.ajax({
				type: 'POST',
				url: get_loc + 'get_course_by_enrollment',
				data: 'enrollment_no=' + $(this).val() + '&status=' + 'get_courses',
				dataType: "json",
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				    console.log(msg);
			        $('.append_course').html(msg);
				    $('.course_type').html('');
				
				},
				error: function (msg) {
				    alert('course is no available for this enrollment');
				    $('.course_type').html('');
				    console.warn(msg.responseText);
				}
			});
		} else {
			var str = '';
			str += "<option value=''>--Select District--</option>";
			$('.city').append(str);
		}
	});
    
    
     $('body').on('change', '.get_subject_list', function () {
        
        var d = $(this).val();
        //alert(d);  
	
		if ($(this).val() != '') {
			$.ajax({
				type: 'POST',
				url: get_loc + 'get_subject_list',
				data: 'course_id=' + $(this).val() + '&status=' + 'get_subjects',
				dataType: "json",
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (res) {
			
				      	$('#subject_list').html(res);
				
				
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




	/* get district */

	$('body').on('change', '.state', function () {

		$(this).closest('.row').find('.city option').remove();

		var d = $(this);

		if ($(this).val() != '') {

			$.ajax({

				type: 'POST',

				url: get_loc + 'get_state',

				data: 'stateid=' + $(this).val(),

				dataType: "json",

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				

					var str = '';

					str += "<option value='0'>--Select District--</option>";

					$.each(msg, function (index, element) {

					str += "<option value='" + element.DISTRICT_ID + "'>" + element.DISTRICT_NAME + "</option>";

					});

					d.closest('.row').find('.city').append(str);

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



    $('#course_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "course_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh,status: '0', }
		},
		"columns": [
			{ "data": "SR_NO" },
			{ "data": "IMAGE" },
			{ "data": "COURSE_CATEGORY" },
			{ "data": "COURSE_NAME" },
			{ "data": "COURSE_TYPE" },
			{ "data": "COURSE_DURATION" },
			{ "data": "COURSE_CODE" },
			{ "data": "MIN_QUALIFICATION" },
			{ "data": "FEES" },
			{ "data": "ACTION" },
		]
	});


    
    
    





$('#subscriber_list').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "subscriber_list",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [



			{ "data": "SR_NO" },

			{ "data": "EMAIL" },

// 			{ "data": "VOL_EMAIL" },

// 			{ "data": "VOL_PHONE" },

// 			{ "data": "VOL_MESSAGE" },

// 			{ "data": "STATUS" },

// 			{ "data": "ACTION" },



		]

	});
// 	generate certificate
$('#gererate_certificate_student').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "gererate_certificate_student",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', },
			error: function (xhr, error, code) {
                console.warn(xhr.responseText, code);
            }

		},

		"columns": [
			{ "data": "SR_NO" },
			{ "data": "DATE" },
    		{ "data": "NAME" },
    		{ "data": "ENROLLMENT" },
    		{ "data": "COURSE" },
    		{ "data": "DURATION" },
    		{ "data": "YEAR" },
    		{ "data": "PERCENTAGE" },
    		{ "data": "RESULT" },
    		{ "data": "STATUS" },
    		{ "data": "GENRATE_DATE" },
			{ "data": "ACTION" },
    	]

	});
	
	
	
	
	
	
	
	
	
	// 	generate certificate
    $('#print_student_certificate').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "print_student_certificate",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [
			{ "data": "SR_NO" },
			{ "data": "DATE" },
    		{ "data": "NAME" },
    		{ "data": "ENROLLMENT" },
    		{ "data": "COURSE" },
    		{ "data": "DURATION" },
    		{ "data": "YEAR" },
    		{ "data": "PERCENTAGE" },
    		{ "data": "RESULT" },
    		{ "data": "STATUS" },
			{ "data": "ACTION" },
    	]

	});

	
	
	
	
	
	
	
	
	
	
	
	
	
	
// PENDING LIST
$('#pending_enquiry').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "pending_enquiry",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [



			{ "data": "SR_NO" },
    		{ "data": "ENQ_DATE" },
    		{ "data": "FOLLOW_DATE" },
    		{ "data": "NAME" },
    		{ "data": "EMAIL" },
    		{ "data": "MOBILE" },
    		{ "data": "DOB" },
			{ "data": "COURSE" },
    		{ "data": "SESSION" },
    		{ "data": "REMARKS" },
    		{ "data": "SOURCE" },
			{ "data": "STATUS" },



		]

	});
// 	approve list
$('#approve_enquiry').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "pending_enquiry",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '1', }

		},

		"columns": [



			{ "data": "SR_NO" },

			{ "data": "ENQ_DATE" },

			{ "data": "FOLLOW_DATE" },

			{ "data": "NAME" },

			{ "data": "EMAIL" },

			{ "data": "MOBILE" },

			{ "data": "DOB" },
			{ "data": "COURSE" },

			{ "data": "SESSION" },

			{ "data": "REMARKS" },

			{ "data": "SOURCE" },
			{ "data": "STATUS" },



		]

	});
// all	enquiry
$('#all_enquiry').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "all_enquiry",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh, }

		},

		"columns": [



			{ "data": "SR_NO" },

			{ "data": "ENQ_DATE" },

			{ "data": "FOLLOW_DATE" },

			{ "data": "NAME" },

			{ "data": "EMAIL" },

			{ "data": "MOBILE" },

			{ "data": "DOB" },
			{ "data": "COURSE" },

			{ "data": "SESSION" },

			{ "data": "REMARKS" },

			{ "data": "SOURCE" },
			{ "data": "STATUS" },
			{ "data": "ACTION" },



		]

	});
	$('#cancel_enquiry').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "pending_enquiry",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '2', }

		},

		"columns": [



			{ "data": "SR_NO" },

			{ "data": "ENQ_DATE" },

			{ "data": "FOLLOW_DATE" },

			{ "data": "NAME" },

			{ "data": "EMAIL" },

			{ "data": "MOBILE" },

			{ "data": "DOB" },
			{ "data": "COURSE" },

			{ "data": "SESSION" },

			{ "data": "REMARKS" },

			{ "data": "SOURCE" },
			{ "data": "STATUS" },



		]

	});




	$('#volunteer_request_list').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "volunteer_request_list",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [



			{ "data": "SR_NO" },

			{ "data": "VOL_NAME" },

			{ "data": "VOL_EMAIL" },

			{ "data": "VOL_PHONE" },

			{ "data": "VOL_MESSAGE" },

			{ "data": "STATUS" },

			{ "data": "ACTION" },



		]

	});

// vision
	$('#vision_list').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "vision_list",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [



			{ "data": "SR_NO" },

			{ "data": "VOL_NAME" },

			{ "data": "VOL_EMAIL" },

			{ "data": "ACTION" },



		]

	});
// slider list

	$('#slider_list').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "slider_list",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [



			{ "data": "SR_NO" },

			{ "data": "BLOG_IMAGE" },

			{ "data": "BLOG_ID" },
			{ "data": "BLOG_TITLE" },

			{ "data": "BLOG_DESC1" },

			// { "data": "BLOG_DESC2" },
			// { "data": "STATUS" },
			{ "data": "ACTION" },



		]

	});
	// our causes

	$('#our_causes').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "cause_list",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [



			{ "data": "SR_NO" },

			{ "data": "BLOG_IMAGE" },

			{ "data": "BLOG_ID" },
			{ "data": "BLOG_TITLE" },

			{ "data": "BLOG_DESC1" },

			{ "data": "BLOG_DESC2" },
			{ "data": "BLOG_goal" },
			{ "data": "STATUS" },
			{ "data": "ACTION" },



		]

	});

	$('#feedback_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "feedback_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh,status: '0', }
		},
		"columns": [
			{ "data": "SR_NO" },
			{ "data": "FB_PER_NAME" },
			{ "data": "FB_COMMENT" },
			{ "data": "STATUS" },
			{ "data": "ACTION" },
		]
	});



/*------------- start state office -----------------------------------------------*/
$('#state_office_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "state_office_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh,status: '0', }
		},
		"columns": [
			{ "data": "SR_NO" },
			{ "data": "FB_PER_NAME" },
			{ "data": "FB_COMMENT" },
			{ "data": "STATUS" },
			{ "data": "ACTION" },
		]
	});




/*---------------- end state office -----------------------------------------------*/






/*-------------------- start director -------------------------------------*/

    	$('#director_list').DataTable({
    		dom: 'Bfrtip,l',
    		pageLength: '10',
    		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
    		buttons: [
    			'excel', 'pdf', 'print'
    		],
    		"processing": true,
    		"serverSide": true,
    		"bDestroy": true,
    		"ajax": {
    			"url": get_loc + "director_list",
    			"dataType": "json",
    			"type": "POST",
    			"data": { crsftoken: crsfharsh,status: '0', }
    		},
    		"columns": [
    			{ "data": "SR_NO" },
    			{ "data": "FB_PER_NAME" },
    			{ "data": "FB_COMMENT" },
    			{ "data": "STATUS" },
    			{ "data": "ACTION" },
    		]
    	});



/*--------------------- end director -------------------------------------*/













	$('#blog_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "list_blog",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh,status: '0',page_name: '2', }
		},
		"columns": [
			{ "data": "SR_NO" },
			{ "data": "BLOG_IMAGE" },
			{ "data": "BLOG_TITLE" },
			{ "data": "BLOG_DESC" },
			{ "data": "STATUS" },
			{ "data": "ACTION" },
		]
	});

    
    
    
    



    $('#color_setting_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "color_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh,status: '0',page_name: '1', }
		},
		"columns": [
			{ "data": "SR_NO" },
			{ "data": "CS_NAME" },
			{ "data": "CS_CODE" },
			{ "data": "CS_COLOR" },
			{ "data": "CS_BACKGROUN_HOVER" },
			{ "data": "CS_FONT_HOVER" },
		]
	});




	$('#events_list').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "list_blog",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,page_name: '2', }

		},

		"columns": [



			{ "data": "SR_NO" },

			{ "data": "BLOG_IMAGE" },

			{ "data": "BLOG_TITLE" },

			{ "data": "BLOG_DESC" },

			{ "data": "STATUS" },

			{ "data": "ACTION" },



		]

	});
	$('#exam_list').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "list_blog",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,page_name: '4', }

		},

		"columns": [



			{ "data": "SR_NO" },

			{ "data": "BLOG_IMAGE" },

			{ "data": "BLOG_TITLE" },

			{ "data": "BLOG_DESC" },

			{ "data": "STATUS" },

			{ "data": "ACTION" },



		]

	});
	$('#student_list').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "list_blog",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,page_name: '6', }

		},

		"columns": [



			{ "data": "SR_NO" },

			{ "data": "BLOG_IMAGE" },

			{ "data": "BLOG_TITLE" },

			{ "data": "BLOG_DESC" },

			{ "data": "STATUS" },

			{ "data": "ACTION" },



		]

	});
	$('#add_list').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "list_blog",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,page_name: '5', }

		},

		"columns": [



			{ "data": "SR_NO" },

			{ "data": "BLOG_IMAGE" },

			{ "data": "BLOG_TITLE" },

			{ "data": "BLOG_DESC" },

			{ "data": "STATUS" },

			{ "data": "ACTION" },



		]

	});

	$('#gallery_list').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "list_blog",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0',page_name: '3', }

		},

		"columns": [



			{ "data": "SR_NO" },

			{ "data": "BLOG_IMAGE" },

			{ "data": "BLOG_TITLE" },

			{ "data": "BLOG_DESC" },

			{ "data": "STATUS" },

			{ "data": "ACTION" },



		]

	});







	$('#fquestion_list').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "fquestion_list",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0',code:projecttempid }

		},

		"columns": [



			{ "data": "SR_NO" },

			{ "data": "FQUESTION" },

			{ "data": "FANSWER" },

			{ "data": "FSTATUS" },

			{ "data": "ACTION" },



		]

	});







	$('#member_list').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "member_list",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [



			{ "data": "SR_NO" },

			{ "data": "MEMBER_PHOTO" },

			{ "data": "MEMBER_NAME" },

			{ "data": "MEMBER_CONTACT" },

			{ "data": "MEMBER_ADDRESS" },

			{ "data": "MEMBER_POST" },

			{ "data": "MEMBER_STATE" },

			{ "data": "MEMBER_DISTRICT" },

			{ "data": "MEMBER_ABOUT_US" },

			{ "data": "MEMBER_STATUS" },

			{ "data": "ACTION" },



		]

	});

	

	$('#enquiry_list').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "enquiry_list",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [



			{ "data": "SR_NO" },

			{ "data": "PERSON_NAME" },

			{ "data": "PERSON_EMAIL" },

			{ "data": "PERSON_SUBJECT" },

			{ "data": "PERSON_COMMENT" },
			{ "data": "PERSON_MOBILE"},
		//	{ "data": "ACTION" },

		]

	});
// 	Admit card list
$('#admit_card_list').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "admit_card_list",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [



			{ "data": "SR_NO" },

			{ "data": "Enrollment" },

			{ "data": "Name" },

			{ "data": "Roll" },

			{ "data": "Course" },
			{ "data": "year" },
			{ "data": "ACTION" },

		]

	});
	$('#seller_forms').dataTable().fnDestroy();
	$('#seller_forms').DataTable({
    dom: 'Bfrtip,l',
    pageLength: '10',
    "lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
    buttons: [
      'excel', 'pdf', 'print'
    ],
 
   
  
  });
	
$('#agent_forms').dataTable().fnDestroy();
$('#agent_forms').DataTable({
    dom: 'Bfrtip,l',
    pageLength: '10',
    "lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
    buttons: [
      'excel', 'pdf', 'print'
    ],
 
   
  
  });
  $('#user_forms').dataTable().fnDestroy();
$('#user_forms').DataTable({
    dom: 'Bfrtip,l',
    pageLength: '10',
    "lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
    buttons: [
      'excel', 'pdf', 'print'
    ],
 
   
  
  });
$('#add_wallet_list').DataTable({



		dom: 'Bfrtip,l',



		pageLength: '10',



		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],



		buttons: [



			'excel', 'pdf', 'print'



		],



		"processing": true,



		"serverSide": true,



		"bDestroy": true,



		"ajax": {



			"url": get_loc + "wallet_list",



			"dataType": "json",



			"type": "POST",



			"data": { crsftoken: crsfharsh,status: '0', }



		},



		"columns": [







			{ "data": "SR_NO" },
			{ "data": "loginid" },



			{ "data": "VOL_NAME" },



			{ "data": "VOL_EMAIL" },
			{ "data": "amt" },



			{ "data": "ACTION" },







		]



	});

$('#wallet_amount_list').DataTable({



		dom: 'Bfrtip,l',



		pageLength: '10',



		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],



		buttons: [



			'excel', 'pdf', 'print'



		],



		"processing": true,



		"serverSide": true,



		"bDestroy": true,



		"ajax": {



			"url": get_loc + "wallet_amount_list",



			"dataType": "json",



			"type": "POST",



			"data": { crsftoken: crsfharsh,status: '0', }



		},



		"columns": [







			{ "data": "SR_NO" },
			{ "data": "date" },
			{ "data": "agent_name" },
			{ "data": "transaction" },
			{ "data": "wallet" },
			{ "data": "debit" },
			{ "data": "VOL_EMAIL" },
			{ "data": "form_fee" },
			{ "data": "massage" },



			// { "data": "ACTION" },







		]



	});
  $('#wallet_report').DataTable({



		dom: 'Bfrtip,l',



		pageLength: '10',



		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],



		buttons: [



			'excel', 'pdf', 'print'



		],



		"processing": true,



		"serverSide": true,



		"bDestroy": true,



		"ajax": {



			"url": get_loc + "wallet_report",



			"dataType": "json",



			"type": "POST",



			"data": { crsftoken: crsfharsh,status: '0', }



		},



		"columns": [







			{ "data": "SR_NO" },
			{ "data": "date" },
			{ "data": "agent_name" },
			
			{ "data": "transaction" },
			{ "data": "wallet" },
			{ "data": "debit" },
			{ "data": "VOL_EMAIL" },
			{ "data": "form_fee" },
			{ "data": "massage" },



			// { "data": "ACTION" },







		]



	});
// $('#upload_document').DataTable({



// 		dom: 'Bfrtip,l',



// 		pageLength: '10',



// 		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],



// 		buttons: [



// 			'excel', 'pdf', 'print'



// 		],



// 		"processing": true,



// 		"serverSide": true,



// 		"bDestroy": true,



// 		"ajax": {



// 			"url": get_loc + "upload_document_list",



// 			"dataType": "json",



// 			"type": "POST",



// 			"data": { crsftoken: crsfharsh,status: '0', }



// 		},



// 		"columns": [







// 			{ "data": "SR_NO" },
// 			{ "data": "date" },
// 			{ "data": "VOL_EMAIL" },
			
// 			{ "data": "form_fee" },
// 			// { "data": "form_fee" },
// 			{ "data": "ACTION" },



// 			// { "data": "ACTION" },







// 		]



// 	});
$('#agent_list').DataTable({



		dom: 'Bfrtip,l',



		pageLength: '10',



		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],



		buttons: [



			'excel', 'pdf', 'print'



		],



		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "add_agent_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [
			{ "data": "SR_NO" },
			{ "data": "date" },
			{ "data": "VOL_EMAIL" },
			
			{ "data": "form_fee" },
			{ "data": "dpt_name" },
			{ "data": "pay" },
			{ "data": "ACTION" },

		]

	});
$('#plan_list').DataTable({



		dom: 'Bfrtip,l',



		pageLength: '10',



		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],



		buttons: [



			'excel', 'pdf', 'print'



		],



		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "plan_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [
			{ "data": "SR_NO" },
			{ "data": "date" },
			{ "data": "VOL_EMAIL" },
			
			{ "data": "form_fee" },
			// { "data": "form_fee" },
			{ "data": "ACTION" },

		]

	});
$('#wallet_amount').DataTable({



		dom: 'Bfrtip,l',



		pageLength: '10',



		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],



		buttons: [



			'excel', 'pdf', 'print'



		],



		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "wallet_request_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [
			{ "data": "SR_NO" },

			{ "data": "request" },
			{ "data": "action_date" },
			{ "data": "bank_name" },
			{ "data": "amount" },
			
			{ "data": "massage" },
			{ "data": "status" },
			
			// { "data": "form_fee" },
			{ "data": "ACTION" },

		]

	});
$('#agent_wallet_request').DataTable({



		dom: 'Bfrtip,l',



		pageLength: '10',



		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],



		buttons: [



			'excel', 'pdf', 'print'



		],



		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "agent_wallet_request",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [
			{ "data": "SR_NO" },
			{ "data": "name" },
			{ "data": "request" },
			{ "data": "transaction" },
			{ "data": "bank_name" },
			{ "data": "amount" },
			
			// { "data": "request" },
			// { "data": "request" },
			{ "data": "massage" },
			{ "data": "reciept" },
			{ "data": "status" },
			
			// { "data": "form_fee" },
			{ "data": "ACTION" },

		]

	});
		// commision betweden dates
	$("#date_form").on('submit', function (e) {
    // alert('hlw');
		// $('body').on('click', '.search_by_cat', function () {
		e.preventDefault();
		
				$('#account_statement').dataTable().fnDestroy();
				$('#account_statement').DataTable({
					dom: 'Bfrtip,l',
					pageLength: '10',
					"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
					buttons: [
						'excel', 'pdf', 'print'
					],
					"processing": true,
					"serverSide": true,
					"ajax": {
						"url": get_loc + "account_statement",
						"dataType": "json",
						"type": "POST",
						"data": { crsftoken: crsfharsh, from:$('.from').val(), to:$('.to').val(),  }
					},
			"columns": [
			{ "data": "SR_NO" },
			{ "data": "name" },
			{ "data": "request" },
			{ "data": "ACTION" },
			
			{ "data": "transaction" },
			{ "data": "bank_name" },
			{ "data": "amount" },
			
			// { "data": "request" },
			// { "data": "request" },
			{ "data": "massage" },
			{ "data": "reciept" },
			{ "data": "status" },
			
			// { "data": "form_fee" },

		]

						});
			
	})
	$('#bank_detail').DataTable({



		dom: 'Bfrtip,l',



		pageLength: '10',



		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],



		buttons: [



			'excel', 'pdf', 'print'



		],



		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "bank_detail",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh,status: '0', }

		},

			"columns": [
			{ "data": "SR_NO" },
			{ "data": "policy_no" },
			{ "data": "agent_name" },
			{ "data": "ifsc" },
			{ "data": "holder_name" },
			{ "data": "father_name" },
			
			

		]

	});
		$('#download_document').DataTable({



		dom: 'Bfrtip,l',



		pageLength: '10',



		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],



		buttons: [



			'excel', 'pdf', 'print'



		],



		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "download_document_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh,status: '0', }

		},

			"columns": [
			{ "data": "SR_NO" },
			{ "data": "policy_no" },
			{ "data": "agent_name" },
			{ "data": "ifsc" },
			// { "data": "holder_name" },
			// { "data": "father_name" },
			
			

		]

	});
				$('#download_form').DataTable({



		dom: 'Bfrtip,l',



		pageLength: '10',



		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],



		buttons: [



			'excel', 'pdf', 'print'



		],



		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "download_form_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh,status: '0', }

		},

			"columns": [
			{ "data": "SR_NO" },
			{ "data": "policy_no" },
			// { "data": "agent_name" },
			{ "data": "ifsc" },
			// { "data": "holder_name" },
			// { "data": "father_name" },
			
			

		]

	});
	// download form department
	$('#download').DataTable({



		dom: 'Bfrtip,l',



		pageLength: '10',



		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],



		buttons: [



			'excel', 'pdf', 'print'



		],



		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "download_form",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh,status: '0', }

		},

			"columns": [
			{ "data": "SR_NO" },
			{ "data": "policy_no" },
			// { "data": "agent_name" },
			{ "data": "ifsc" },
			// { "data": "holder_name" },
			// { "data": "father_name" },
			
			

		]

	});

	// department list
$('#dpt').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "dpt_list",
			"dataType": "json",
			"type": "POST",
	"data": { crsftoken: crsfharsh,status: '0', }
		},
		"columns": [
			{ "data": "SR_NO" },
			{ "data": "date" },
			{ "data": "com_date" },
  	// { "data": "policy_no" },
			{ "data": "pay" },

			{ "data": "ACTION" },

]
	});


// $('#agent_wallet_request').DataTable({



// 		dom: 'Bfrtip,l',



// 		pageLength: '10',



// 		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],



// 		buttons: [



// 			'excel', 'pdf', 'print'



// 		],



// 		"processing": true,
// 		"serverSide": true,
// 		"bDestroy": true,
// 		"ajax": {
// 			"url": get_loc + "agent_wallet_request",
// 			"dataType": "json",
// 			"type": "POST",
// 			"data": { crsftoken: crsfharsh,status: '0', }

// 		},

// 		"columns": [
// 			{ "data": "SR_NO" },
// 			{ "data": "name" },
			
// 			{ "data": "request" },
// 			// { "data": "action_date" },
// 			{ "data": "amount" },
// 			{ "data": "massage" },
// 			{ "data": "status" },
			
// 			// { "data": "form_fee" },
// 			{ "data": "ACTION" },

// 		]

// 	});
/*---------- end Game ----------------------------*/
$('#user').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "user",
			"dataType": "json",
			"type": "POST",
	"data": { crsftoken: crsfharsh,status: '0', }
		},
		"columns": [
			{ "data": "SR_NO" },
			{ "data": "date" },
			{ "data": "com_date" },
  	{ "data": "policy_no" },
  	{ "data": "premium" },
			{ "data": "pay" },

			{ "data": "ACTION" },

]
	});
  // service list
  $('#service_list').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "service_list",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [



			{ "data": "SR_NO" },

			{ "data": "NAME" },

			{ "data": "FEE" },
			{ "data": "DPT" },

			{ "data": "STATUS" },
			{ "data": "comment" },

			


		]

	});
     // service list user
  $('#service_list_user').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "service_list_user",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [



			{ "data": "SR_NO" },

			{ "data": "NAME" },

			{ "data": "FEE" },
			{ "data": "DPT" },

			{ "data": "STATUS" },
			{ "data": "comment" },

			


		]

	});
  // date between 
		$("#apply_date_between").on('submit', function (e) {
    // alert('hlw');
		// $('body').on('click', '.search_by_cat', function () {
		e.preventDefault();
		
				$('#apply_list').dataTable().fnDestroy();
				$('#apply_list').DataTable({
					dom: 'Bfrtip,l',
					pageLength: '10',
					"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
					buttons: [
						'excel', 'pdf', 'print'
					],
					"processing": true,
					"serverSide": true,
					"ajax": {
						"url": get_loc + "apply_list",
						"dataType": "json",
						"type": "POST",
						"data": { crsftoken: crsfharsh, from:$('.from').val(), to:$('.to').val(),  }
					},
		"columns": [
			{ "data": "SR_NO" },

			{ "data": "NAME" },

			{ "data": "FORM" },
		]
						});
			
	});

   //complete date between 
		$("#complete_date_between").on('submit', function (e) {
    // alert('hlw');
		// $('body').on('click', '.search_by_cat', function () {
		e.preventDefault();
		
				$('#complete_list').dataTable().fnDestroy();
				$('#complete_list').DataTable({
					dom: 'Bfrtip,l',
					pageLength: '10',
					"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
					buttons: [
						'excel', 'pdf', 'print'
					],
					"processing": true,
					"serverSide": true,
					"ajax": {
						"url": get_loc + "complete_list_user",
						"dataType": "json",
						"type": "POST",
						"data": { crsftoken: crsfharsh, from:$('.from').val(), to:$('.to').val(),  }
					},
		"columns": [
			{ "data": "SR_NO" },

			{ "data": "NAME" },

			{ "data": "FORM" },
		]
						});
			
	});
  
  // // complete list
  // $('#complete_list').DataTable({

	// 	dom: 'Bfrtip,l',

	// 	pageLength: '10',

	// 	"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

	// 	buttons: [

	// 		'excel', 'pdf', 'print'

	// 	],

	// 	"processing": true,

	// 	"serverSide": true,

	// 	"bDestroy": true,

	// 	"ajax": {

	// 		"url": get_loc + "complete_list",

	// 		"dataType": "json",

	// 		"type": "POST",

	// 		"data": { crsftoken: crsfharsh,status: '0', }

	// 	},

	// 	"columns": [



	// 		{ "data": "SR_NO" },

	// 		{ "data": "NAME" },

	// 		{ "data": "FORM" },
	// 		// { "data": "DPT" },

	// 		// { "data": "STATUS" },

			


	// 	]

	// });
		$("#date_form").on('submit', function (e) {
    // alert('hlw');
		// $('body').on('click', '.search_by_cat', function () {
		e.preventDefault();
		
				$('#report_date').dataTable().fnDestroy();
				$('#report_date').DataTable({
					dom: 'Bfrtip,l',
					pageLength: '10',
					"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
					buttons: [
						'excel', 'pdf', 'print'
					],
					"processing": true,
					"serverSide": true,
					"ajax": {
						"url": get_loc + "report",
						"dataType": "json",
						"type": "POST",
						"data": { crsftoken: crsfharsh, from:$('.from').val(), to:$('.to').val(),  }
					},
		"columns": [
			{ "data": "SR_NO" },
			{ "data": "NAME" },
			
			{ "data": "FORM" },
		
		]
						});
			
	});
// date between 
		$("#date_between").on('submit', function (e) {
    // alert('hlw');
		// $('body').on('click', '.search_by_cat', function () {
		e.preventDefault();
		
				$('#wallet_report_date').dataTable().fnDestroy();
				$('#wallet_report_date').DataTable({
					dom: 'Bfrtip,l',
					pageLength: '10',
					"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
					buttons: [
						'excel', 'pdf', 'print'
					],
					"processing": true,
					"serverSide": true,
					"ajax": {
						"url": get_loc + "wallet_report_date",
						"dataType": "json",
						"type": "POST",
						"data": { crsftoken: crsfharsh, from:$('.from').val(), to:$('.to').val(),  }
					},
		"columns": [
			{ "data": "SR_NO" },
			{ "data": "date" },
			{ "data": "agent_name" },
			{ "data": "transaction" },
			{ "data": "wallet" },
			{ "data": "debit" },
			{ "data": "VOL_EMAIL" },
			{ "data": "form_fee" },
			{ "data": "massage" },
		]
						});
			
	});
	// GET USER NAME
	           	/* get cities*/
$('body').on('change', '.get_user', function () {
		$(this).closest('.row').find('.user_name option').remove();
		var d = $(this);
		if ($(this).val() != '') {
			$.ajax({
				type: 'POST',
				url: get_loc + 'get_user',
				data: 'user_id=' + $(this).val(),
				dataType: "json",
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
				$(this).closest('.row').find('.user_name option').remove();
					var str = '';
					str += "<option value=''>--Select user	--</option>";
					$.each(msg, function (index, element) {
						str += "<option value='" + element.ADMIN_ID + "'>" + element.ADMIN_NAME + "</option>";
					});
					d.closest('.row').find('.user_name').append(str);
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
// service list
// service list
  $('#list_service').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "list_service",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [



			{ "data": "SR_NO" },
            		{ "data": "IMAGE" },
                
			{ "data": "NAME" },
                
			{ "data": "DES" },
		  	{ "data": "ACTION" },	


		]

	});
	//  features list
	
	
	
	$('#list_service_course').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "list_service",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [



			{ "data": "SR_NO" },
            		{ "data": "IMAGE" },
                
			{ "data": "NAME" },
                
			{ "data": "DES" },
		  	{ "data": "ACTION" },	


		]

	});


	
	
	
	

  $('#features_list').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "features_list",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [



			{ "data": "SR_NO" },
            		
                
			{ "data": "NAME" },
                
			
		  	{ "data": "ACTION" },	


		]

	});
// news list
	
  $('#news_list').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "news_list",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [



			{ "data": "SR_NO" },            
			{ "data": "IMAGE" },
			{ "data": "TITLE" },
			{ "data": "DESCRITPION" },
			{ "data": "DATE" },
			{ "data": "STATUS" },
      
                
			
		  	{ "data": "ACTION" },	


		]

	});
	// our branches list
// select students
        $("#select_student").on('submit', function (e) {
	        e.preventDefault();
	
			$('#show_student').dataTable().fnDestroy();
			$('#show_student').DataTable({
				dom: 'Bfrtip,l',
				pageLength: '10',
				"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
				buttons: [
					'excel', 'pdf', 'print'
				],
				"processing": true,
				"serverSide": true,
				"ajax": {
					"url": get_loc + "show_student",
					"dataType": "json",
					"type": "POST",
					"data": { crsftoken: crsfharsh, course_id:$('.course').val(),year:$('.year').val(),enrollid:$('.get_enroll_id').val(),}
				},
        			"columns": [
        			{ "data": "SR_NO" },
        			{ "data": "name" },
        			{ "data": "mobile" },
        			{ "data": "course" },
        			{ "data": "subject" },
        			{ "data": "course_type" },
        			{ "data": "session" },
        			{ "data": "doa" },
        			{ "data": "enroll_no" },
        			
        			// { "data": "request" },
        			// { "data": "request" },
        			{ "data": "center" },
        			{ "data": "exam_date" },
        			{ "data": "status" },
        			
        			// { "data": "form_fee" },
        
        		]

			});
	    })

  	
		
// 				$('#show_student').dataTable().fnDestroy();
// 				$('#show_student').DataTable({
// 					dom: 'Bfrtip,l',
// 					pageLength: '10',
// 					"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
// 					buttons: [
// 						'excel', 'pdf', 'print'
// 					],
// 					"processing": true,
// 					"serverSide": true,
// 					"ajax": {
// 						"url": get_loc + "show_student",
// 						"dataType": "json",
// 						"type": "POST",
// 						"data": { crsftoken: crsfharsh, course_id:$('.course').val(),}
// 					},
// 			"columns": [
// 			{ "data": "SR_NO" },
// 			{ "data": "name" },
// 			{ "data": "mobile" },
// 			{ "data": "course" },
			
// 			{ "data": "session" },
// 			{ "data": "doa" },
// 			{ "data": "enroll_no" },
			
// 			// { "data": "request" },
// 			// { "data": "request" },
// 			{ "data": "center" },
// 			{ "data": "exam_date" },
// 			{ "data": "status" },
			
// 			// { "data": "form_fee" },

// 		]

// 						});
			
// exam schedule list
$('#assign_exam_list').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "assign_exam_list",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [
	{ "data": "SR_NO" },
			{ "data": "name" },
			{ "data": "mobile" },
			{ "data": "course" },
			
			{ "data": "session" },
			{ "data": "doa" },
			{ "data": "enroll_no" },
		
			{ "data": "center" },
			{ "data": "exam_date" },
				
			{ "data": "start_date" },
			{ "data": "end_date" },
			{ "data": "status" },


		]

	});
  $('#our_branches').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "our_branches",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [



			{ "data": "SR_NO" },            
			{ "data": "IMAGE" },
			{ "data": "TITLE" },
			{ "data": "DESCRITPION" },
			{ "data": "DATE" },
			{ "data": "STATUS" },
      
                
			
		  	{ "data": "ACTION" },	


		]

	});

    //latest news list
	
  $('#latest_news_list').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "latest_news_list",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [



			{ "data": "SR_NO" },            
			{ "data": "IMAGE" },
			{ "data": "TITLE" },
			{ "data": "DESCRITPION" },
			// { "data": "DATE" },
			{ "data": "STATUS" },
      
                
			
		  	{ "data": "ACTION" },	


		]

	});
  // notice baord
	
  $('#notice_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "notice_board_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh,status: '0', }
		},
		"columns": [
			{ "data": "SR_NO" },            
			{ "data": "IMAGE" },
			{ "data": "TITLE" },
			{ "data": "DESCRITPION" },
			{ "data": "DATE" },
			{ "data": "STATUS" },
		  	{ "data": "ACTION" },	
		]
	});
	$('#page_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "all_page_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh,status: '0', }
		},
		"columns": [
			{ "data": "SR_NO" },            
			{ "data": "IMAGE" },
			{ "data": "TITLE" },
			{ "data": "URL" },
			{ "data": "ACTION" },	
		]
	});


    // advance notice
    $('#advance_notice_list').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "advance_notice_list",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [



			{ "data": "SR_NO" },            
			{ "data": "IMAGE" },
			{ "data": "TITLE" },
			{ "data": "DESCRITPION" },
			// { "data": "DATE" },
			{ "data": "STATUS" },
      
                
			
		  	{ "data": "ACTION" },	


		]

	});
    // information list
   
    $('#information_list').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "information_baord_list",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [
			{ "data": "SR_NO" },            
			{ "data": "LINK_NAME" },
			{ "data": "LINK_URL" },
			// { "data": "DATE" },
			{ "data": "STATUS" },	
		  	{ "data": "ACTION" },	
		]

	});
	 // ADMISSION NOTICE
   
    $('#admission_notice_list').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "admission_notice_list",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [
			{ "data": "SR_NO" },            
			{ "data": "LINK_NAME" },
			{ "data": "LINK_URL" },
			// { "data": "DATE" },
			{ "data": "STATUS" },	
		  	{ "data": "ACTION" },	
		]

	});
    // FLASH IMAGE
   
    $('#flash_image_list').DataTable({

		dom: 'Bfrtip,l',

		pageLength: '10',

		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],

		buttons: [

			'excel', 'pdf', 'print'

		],

		"processing": true,

		"serverSide": true,

		"bDestroy": true,

		"ajax": {

			"url": get_loc + "flash_image_list",

			"dataType": "json",

			"type": "POST",

			"data": { crsftoken: crsfharsh,status: '0', }

		},

		"columns": [
			{ "data": "SR_NO" },            
			{ "data": "IMAGE" },
			{ "data": "TITLE" },
			{ "data": "DESCRIPTION" },
			{ "data": "STATUS" },	
		  	{ "data": "ACTION" },	
		]

	});



/*------------------------ start game -------------------------------------------------------*/
$('body').on('change', '.get_category', function () {
		$(this).closest('.row').find('.ccategory option').remove();
		var d = $(this);
		if ($(this).val() != '') {
			$.ajax({
				type: 'POST',
				url: get_loc + 'get_category',
				data: 'brandid=' + $(this).val(),
				dataType: "json",
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
					$('.ccategory option').remove();
					var str = '';
					str += "<option value=''>--Select Course--</option>";
					$.each(msg, function (index, element) {
						str += "<option value='" + element.id + "'>" + element.course_name + "</option>";
					});
					d.closest('.row').find('.ccategory').append(str);
					//d.closest('.row').find('#category').append(str);
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


	$('body').on('change', '.get_sub_category', function () {
		$(this).closest('.row').find('.sub_category option').remove();
		var d = $(this);
		if ($(this).val() != '') {
			$.ajax({
				type: 'POST',
				url: get_loc + 'get_sub_category',
				data: 'catid=' + $(this).val(),
				dataType: "json",
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
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


// $('#new_order_list').DataTable({
// 		dom: 'Bfrtip,l',
// 		pageLength: '10',
// 		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
// 		buttons: [
// 			'excel', 'pdf', 'print'
// 		],
// 		"processing": true,
// 		"serverSide": true,
// 		"ajax": {
// 			"url": get_loc + "new_order_list",
// 			"dataType": "json",
// 			"type": "POST",
// 			"data": { crsftoken: crsfharsh, hrmtype: '1', }
// 		},
// 		"columns": [

// 			{ "data": "SR_NO" },
// 			{ "data": "ORDER_NO" },
// 			{ "data": "NAME" },
// 			{ "data": "BRAND"},
// 			{ "data": "CATEGORY" },
// 			{ "data": "SUB_CATEGORY" },
// 			{ "data": "PRODUCT_NAME" },
// 			{ "data": "ORDER" },
// 			{ "data": "ACTION" },
			

// 		]
// 	});
 
	$('#new_order_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
		"url": get_loc + "new_order_list",
		"dataType": "json",
		"type": "POST",
		"data": { crsftoken: crsfharsh,hrmtype: '2', }
		},
		"columns": [
			{ "data": "SR_NO" },
			{ "data": "ORDER_NO" },
			{ "data": "NAME" },
			{ "data": "BRAND"},
			{ "data": "CATEGORY" },
			{ "data": "SUB_CATEGORY" },
			{ "data": "PRODUCT_NAME" },
			{ "data": "ORDER" },
			{ "data": "ACTION" },
			
		]
	});


    $('#brand_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "brand_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "BRAND_NAME" },
			{ "data": "ACTION" },

		]
	});

/*--------- start occupation list --------------------------*/
    $('#occupation_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "occupation_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "BRAND_NAME" },
			{ "data": "ACTION" },

		]
	});


/*------------ end occupation list ----------------------------*/


/*--------- start occupation list --------------------------*/
    $('#batch_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "batch_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "BRAND_NAME" },
			{ "data": "ACTION" },

		]
	});


/*------------ end occupation list ----------------------------*/






    $('#category_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "category_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "BRAND_NAME" },
			{ "data": "CATEGORY_NAME" },
			{ "data": "ACTION" },

		]
	});

$('#sub_category_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "sub_category_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "BRAND_NAME" },
			{ "data": "CATEGORY_NAME" },
			{ "data": "SUB_CATEGORY_NAME" },
			{ "data": "ACTION" },

		]
	});

	

	$('#product_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "product_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "BRAND_NAME" },
			{ "data": "CATEGORY_NAME" },
			{ "data": "SUB_CATEGORY_NAME" },
			{ "data": "PRODUCT_NAME" },
			{ "data": "ACTION" },

		]
	});



	$('#delivered_order_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
		"url": get_loc + "delivered_order_list",
		"dataType": "json",
		"type": "POST",
		"data": { crsftoken: crsfharsh,hrmtype: '2', }
		},
		"columns": [
			{ "data": "SR_NO" },
			{ "data": "ORDER_NO" },
			{ "data": "NAME" },
			{ "data": "BRAND"},
			{ "data": "CATEGORY" },
			{ "data": "SUB_CATEGORY" },
			{ "data": "PRODUCT_NAME" },
			{ "data": "ORDER" },
			{ "data": "ACTION" },
			
		]
	});

	$('#pending_order_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
		"url": get_loc + "pending_order_list",
		"dataType": "json",
		"type": "POST",
		"data": { crsftoken: crsfharsh,hrmtype: '2', }
		},
		"columns": [
			{ "data": "SR_NO" },
			{ "data": "ORDER_NO" },
			{ "data": "NAME" },
			{ "data": "BRAND"},
			{ "data": "CATEGORY" },
			{ "data": "SUB_CATEGORY" },
			{ "data": "PRODUCT_NAME" },
			{ "data": "ORDER" },
			{ "data": "ACTION" },
			
		]
	});

	$('#cancelled_order_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
		"url": get_loc + "cancelled_order_list",
		"dataType": "json",
		"type": "POST",
		"data": { crsftoken: crsfharsh,hrmtype: '2', }
		},
		"columns": [
			{ "data": "SR_NO" },
			{ "data": "ORDER_NO" },
			{ "data": "NAME" },
			{ "data": "BRAND"},
			{ "data": "CATEGORY" },
			{ "data": "SUB_CATEGORY" },
			{ "data": "PRODUCT_NAME" },
			{ "data": "ORDER" },
			{ "data": "ACTION" },
			
		]
	});

	
$('#list_banners').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "list_banners",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "IMAGE" },
			{ "data": "TITLE" },
			{ "data": "ACTION" },

		]
	});


	$('#list_coupans').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "list_coupans",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "IMAGE" },
			{ "data": "TITLE" },
			{ "data": "VALID_UO_TO" },
			{ "data": "ACTION" },

		]
	});
/*---------- end Game ----------------------------*/



/*----------- START MARQUEE LIST --------------------------------------------------*/
    $('#marquee_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "marquee_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh,status: '0', }
		},
		"columns": [
			{ "data": "SR_NO" },
    		{ "data": "MARQUEE_TITLE" },
			{ "data": "MARQUEE_DESC" },
			{ "data": "ACTION" },	
		]
	});


/*------------- END MARQUEE LIST ---------------------------------------------------*/


    $('#fixed_menu_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "fixed_menu_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "MENU_NAME" },
			{ "data": "ACTION" },

		]
	});

    
    $('#front_setting_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "front_setting_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "FB_NAME" },
			{ "data": "FB_ORDER" },
			{ "data": "FB_SHOW_HIDE" },

		]
	});

/*--------------------- start menu list ----------------------------------------------------------*/
    $('#menu_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "menu_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "MENU_NAME" },
			{ "data": "MENU_ORDER" },
			{ "data": "MENU_SHOW_HIDE" },
			{ "data": "PAGE_TYPE" },
			{ "data": "ACTION" },

		]
	});
    
    
    $('#sub_menu_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "sub_menu_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "MENU_NAME" },
			{ "data": "MENU_ORDER" },
			{ "data": "MENU_SHOW_HIDE" },
			{ "data": "ACTION" },

		]
	});
	
	$('#sub_sub_menu_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "sub_sub_menu_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "MENU_NAME" },
			{ "data": "MENU_ORDER" },
			{ "data": "MENU_SHOW_HIDE" },
			{ "data": "ACTION" },

		]
	});

    

/*------------------------- end menu list -----------------------------------------------------------*/

/*--------------------- start backend list ---------------------------------------------------*/
    $('#backend_setting_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "backend_setting_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "FB_NAME" },
			{ "data": "FB_ORDER" },
			{ "data": "FB_SHOW_HIDE" },

		]
	});


/*----------------------- end backend list ----------------------------------------------------*/

/*--------------------- start new registration list ---------------------------------------------------*/
    $('#new_user_registration_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "new_user_registration_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "name" },
			{ "data": "email" },
			{ "data": "mobile" },
			{ "data": "address" },
			{ "data": "dob" },
			{ "data": "father_name" },
			{ "data": "mother_name" },
			{ "data": "gender" },
			{ "data": "category" },
			{ "data": "city" },
			{ "data": "appearing_school_name" },
			{ "data": "apprearing_disctrict" },
			{ "data": "appearing_city" },
			{ "data": "enroll_for" },
			{ "data": "course" },
			{ "data": "exam_type" },
			{ "data": "registration_date" },
			{ "data": "total_downloads" },
			{ "data": "action" },

		]
	});
// vedio list
    
    
    
    $('#vedio_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "vedio_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "TITLE" },
			{ "data": "URL" },
			{ "data": "ACTION" },

		]
	});



    $('#center_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "center_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "PHOTO" },
			{ "data": "OWNER_NAME" },
			{ "data": "INSTITUTE_NAME" },
			
// 			{ "data": "DOB" },
// 			{ "data": "PANCARD" },
            // { "data": "AADHAR_CARD" },
            { "data": "INSTITUTE_ADDRESS" },
            { "data": "STATE" },
            { "data": "DISTRICT" },
            // { "data": "CLASS_ROOMS" },
            { "data": "INSTITTUTE_HEAD" },
            // { "data": "RECEPTION" },
            // { "data": "STAFF" },
            // { "data": "WATER_SUPPLY" },
            // { "data": "TOILET" },
            { "data": "PASSWORD" },
            
            { "data": "CITY_NAME" },
            { "data": "MOBILE" },
            { "data": "EMAIL" },
            // { "data": "SEAT_CAPACITY" },
            { "data": "COURSE_BTN" },
            { "data": "WALLET_BTN" },
            { "data": "ACTION" },
		]
	});
	$(document).on('click','.load-wallet',function(){
	   var  td = $(this).closest('td'),
	        id = $(this).data('id'),
	        balance = $(td).find('.wallet-balance');
	        
    	        $.confirm({
                    title: 'Wallet!',
                    content: '' +
                    '<form action="" class="formName">' +
                    '<div class="form-group">' +
                    '<label>Enter Amount</label>' +
                    '<input type="number" autofocus placeholder="Enter Amount" class="amount form-control" required />' +
                    '</div>' +
                    '</form>',
                    buttons: {
                        formSubmit: {
                            text: 'Submit',
                            btnClass: 'btn-blue',
                            action: function () {
                                var amount = this.$content.find('.amount').val();
                                if(!amount){
                                    $.alert('provide a valid amount');
                                    return false;
                                }
                                $.ajax({
                                    type : 'POST',
                                    url : get_loc + 'load_wallet',
                                    data : {amount,id},
                                    dataType : 'json',
                                    success : function(r){
                                        console.log(r);
                                        if(r.status)
                                            $(balance).html(r.amount+ ' <i class="fa fa-rupee"></i>');
                                        toastr.success('wallet load successfully..');
                                    },
                                    error:function(a,v,c){
                                        $.alert(a.responseText);
                                    }
                                });
                                //$.alert('Your amount is ' + amount);
                            }
                        },
                        cancel: function () {
                            //close
                        },
                    },
                    onContentReady: function () {
                        // bind to events
                        var jc = this;
                        this.$content.find('form').on('submit', function (e) {
                            // if the user submits the form by pressing enter in the field.
                            e.preventDefault();
                            jc.$$formSubmit.trigger('click'); // reference the button and click it
                        });
                    }
                });
	   
	});
	$(document).on('click','.load-wallet-center',function(){
        var that = this;
        var old_html = $(this).html();
        $(this).html(loader_btn_html).prop('disabled',true);
        
        var surl = base_url + '/admin/wallet_payment_status';
        var furl = surl,
            udf2 = 'wallet';
            
        var message = ' Wallet Load Money.';
        $.confirm({
            type : 'green',
            theme : 'bootstrap',
            icon : 'fa fa-money',
            title : 'Enter Amount',
            content : `<input autofocus class="form-control get-amount" placeholder="Enter Amount" type="number">`,
            buttons : {
                ok : {
                    text : 'GO',
                    btnClass : 'btn-primary',
                    keys : ['enter','y'],
                    action : function(){
                        var amount = this.$content.find('.get-amount').val();
                        if( !amount || amount <= 0 ){
                            $.alert('Provide a valid amount.');
                            this.$content.find('.get-amount').focus();
                        }
                        else{
                            this.$$ok.prop('disabled', true);
                            this.buttons.ok.setText('<i class="fa fa-spin fa-spinner"></i> Please wait..');
                            $.ajax({
                                type : 'POST',
                                data : { udf2: udf2, amount : amount, surl:surl, furl:furl,message:message},
                                url : get_loc+ 'create_transaction',
                                dataType :'json',
                                success:function(res){
                                    
                                        console.log(res.form.html);
                                    if(res.form.status){
                                        var form = $(res.form.html);
                                            $('body').append(form); 
                                            form.submit();
                                    }
                                    else{
                                        $.confirm({
                                            title :'Notification!',
                                            icon :'fa fa-bell',
                                            content : res.form.html,
                                        })
                                    }
                                },
                                error:function(r,v,c){
                                    console.warn(r.responseText);
                                }
                            });
                        }

                        return false;

                    }
                },
                cancel:function(){
                    $(that).html(old_html).prop('disabled',false);
                }
            }
        });
        
    });
    $(document).on('click','.assign-course',function(){
            var id = $(this).data('id'),
                btn = $(this).html(),
                that = this;
                
                $(this).html('<i class="fa fa-spin fa-spinner"></i> Please Wait..').prop('disabled',true);
                var box = $.confirm({
                        title: 'Assign Course!',
                        content: 'url:' + get_loc+'assign_course_input?center_id='+id,
                        columnClass : 'col-md-12',
                        buttons: {
                            formSubmit: {
                                text: 'Submit',
                                btnClass: 'btn-blue',
                                action: function () {
                                    // alert(3);
                                    var checked = this.$content.find('.course_id:checked');
                                    var fromData = this.$content.find('form').serialize();
                                    var self = this;
                                    self.buttons.formSubmit.setText('Wait...');
                                    self.buttons.formSubmit.disable();
                                    $.ajax({
                                        type:"POST",
                                        url : get_loc+'assign_course_input?center_id='+id,
                                        data : 'status=update&'+fromData,
                                        dataType : 'json',
                                        success : function(r){
                                            self.buttons.formSubmit.setText('Submit');
                                            self.buttons.formSubmit.enable();
                                            alert('Changes Successfully..');
                                            box.close();
                                        },
                                        error:function(c,x,r){
                                            console.warn(c.responseText);
                                            self.buttons.formSubmit.setText('Submit');
                                            self.buttons.formSubmit.enable();
                                        }
                                    })
                                    
                                    return false;
                                }
                            },
                            cancel: function () {
                                $(that).html(btn).prop('disabled',false);
                            },
                        },
                        onContentReady: function () {
                            // bind to events
                            var jc = this;
                            this.$content.find('form').on('submit', function (e) {
                                // if the user submits the form by pressing enter in the field.
                                e.preventDefault();
                                jc.$$formSubmit.trigger('click'); // reference the button and click it
                            });
                        }
                    });
    })
    $('#get_student_pending_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "student_pending_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "ENTOLLMENT" },
			{ "data": "STUDENT_NAME" },
			{ "data": "GENDER" },
			{ "data": "FATHER_NAME" },
			{ "data": "MOTHER_NAME" },
            { "data": "DOB" },
            { "data": "MOBILE" },
            { "data": "EMAIL" },
            { "data": "STATE" },
            { "data": "DISTRICT" },
            { "data": "EXAM_PASS" },
            { "data": "MARKS" },
            { "data": "USER_NAME" },
            { "data": "COURSE_NAME" },
            { "data": "CENTER_NAME" },
            { "data": "CITY" },
            { "data": "PINCODE" },
            { "data": "HIGHEST_QUALIFICATION" },
            { "data": "PASSING_YEAR" },
            { "data": "ADHAR_NUMBER" },
            { "data": "PHOTO" },
			{ "data": "SIG" },
			{ "data": "LEFT_THUMB" },
            { "data": "STATUS" },
            { "data": "ACTION" },
		]
	});
	    $('#get_student_approve_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "student_approve_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
		
			{ "data": "ENTOLLMENT" },
			{ "data": "STUDENT_NAME" },
			{ "data": "GENDER" },
			
			{ "data": "FATHER_NAME" },
			{ "data": "MOTHER_NAME" },
            { "data": "DOB" },
            { "data": "MOBILE" },
            { "data": "EMAIL" },
            { "data": "STATE" },
            { "data": "DISTRICT" },
            { "data": "EXAM_PASS" },
            { "data": "MARKS" },
            { "data": "USER_NAME" },
            { "data": "COURSE_NAME" },
            { "data": "CENTER_NAME" },
            
            { "data": "CITY" },
            { "data": "PINCODE" },
            { "data": "HIGHEST_QUALIFICATION" },
            { "data": "PASSING_YEAR" },
            { "data": "ADHAR_NUMBER" },
            { "data": "PHOTO" },
			{ "data": "SIG" },
			{ "data": "LEFT_THUMB" },
            
            { "data": "STATUS" },
            { "data": "ACTION" },
		]
	});
	$('#get_student_cancel_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "student_cancel_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
		
			{ "data": "ENTOLLMENT" },
			{ "data": "STUDENT_NAME" },
			{ "data": "GENDER" },
			
			{ "data": "FATHER_NAME" },
			{ "data": "MOTHER_NAME" },
            { "data": "DOB" },
            { "data": "MOBILE" },
            { "data": "EMAIL" },
            { "data": "STATE" },
            { "data": "DISTRICT" },
            { "data": "EXAM_PASS" },
            { "data": "MARKS" },
            { "data": "USER_NAME" },
            { "data": "COURSE_NAME" },
            { "data": "CENTER_NAME" },
            
            { "data": "CITY" },
            { "data": "PINCODE" },
            { "data": "HIGHEST_QUALIFICATION" },
            { "data": "PASSING_YEAR" },
            { "data": "ADHAR_NUMBER" },
            { "data": "PHOTO" },
			{ "data": "SIG" },
			{ "data": "LEFT_THUMB" },
            
            { "data": "STATUS" },
            { "data": "ACTION" },
		]
	});
	    $('#get_student_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "student_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "PHOTO" },
			{ "data": "SIG" },
			{ "data": "LEFT_THUMB" },
			{ "data": "ENTOLLMENT" },
			{ "data": "STUDENT_NAME" },
			{ "data": "GENDER" },
			
			{ "data": "FATHER_NAME" },
			{ "data": "MOTHER_NAME" },
            { "data": "DOB" },
            { "data": "MOBILE" },
            { "data": "EMAIL" },
            { "data": "STATE" },
            { "data": "DISTRICT" },
            { "data": "EXAM_PASS" },
            { "data": "MARKS" },
            { "data": "USER_NAME" },
            { "data": "COURSE_NAME" },
            { "data": "CENTER_NAME" },
            
            { "data": "CITY" },
            { "data": "PINCODE" },
            { "data": "HIGHEST_QUALIFICATION" },
            { "data": "PASSING_YEAR" },
            { "data": "ADHAR_NUMBER" },
            
            
            { "data": "STATUS" },
            { "data": "ACTION" },
		]
	});
	$('#download_admit_card').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "download_admit_card",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "PHOTO" },
			{ "data": "ENTOLLMENT" },
			
			{ "data": "STUDENT_NAME" },
		    { "data": "COURSE" },
		    { "data": "SESSION" },
			
			{ "data": "FATHER_NAME" },
			{ "data": "MOTHER_NAME" },
            { "data": "DOB" },
            { "data": "MOBILE" },
            { "data": "EMAIL" },
            { "data": "ADDRESS" },
            { "data": "CENTER_NAME" },
            
         
            { "data": "ACTION" },
		]
	});
    
    
    $('#uploaded_certificate_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "uploaded_certificate_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "PHOTO" },
			{ "data": "ROLL_NO" },
			{ "data": "ACTION" },
		]
	});
    
     $('#upload_result_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "uploaded_result_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "PHOTO" },
			{ "data": "ROLL_NO" },
			{ "data": "ACTION" },
		]
	});    



	$('#result_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "result_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "STUDENT" },
			{ "data": "ROLL_NO" },
			{ "data": "COURSE" },
			{ "data": "YEAR" },
			{ "data": "SESSION" },
			{ "data": "SUBJECT" },
			{ "data": "GENRATE_DATE" },

			{ "data": "ACTION" },
// 			{ "data": "DOWNLOAD" },
		]
		
	});
	
	$(document).on('change','.update-date',function(){
	    var date = this.value,
	        type = $(this).data('type'),
	        type_id = $(this).data('type_id'),
	        that  = this;
	        $(this).parent().find("strong").remove();
	        $(this).prop('disabled',true).parent().append('<strong><br><i class="fa fa-spin fa-spinner"></i> Please Wait...</strong>');
	    $.ajax({
	        type : 'POST',
	        url : get_loc + 'update_date',
	        data : {date,type,type_id,crsftoken: crsfharsh},
	        dataType : 'json',
	        success : function(rs){
	            console.log(rs);
	            $(that).prop('disabled',false).parent().find('strong').text('Update Success');
	        },
	        error:function(a,b,c){
	            console.warn(a.responseText);
	            $(that).prop('disabled',false).parent().find('strong').remove();
	        }
	    });
	})
	$('#print_result_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '10',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"bDestroy": true,
		"ajax": {
			"url": get_loc + "print_result_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh }
		},
		"columns": [

			{ "data": "SR_NO" },
			{ "data": "STUDENT" },
			{ "data": "ROLL_NO" },
			{ "data": "COURSE" },
			{ "data": "YEAR" },
			{ "data": "SESSION" },
			{ "data": "SUBJECT" },

			{ "data": "ACTION" },
// 			{ "data": "DOWNLOAD" },
		]
		
	});  
	
	
	

/*----------------------- end new user registration list ----------------------------------------------------*/
//alert('kk');

$('ol.sortable').nestedSortable({


	update : function () {
		var orderNew = $('ol.sortable').nestedSortable('serialize', {startDepthCount: 0});
 // var x= $('ol.sortable').nestedSortable('serialize');
 		 

 		 $.ajax({
            type: 'post',
            url: post_loc + 'save_position',
            //url: 'helloboss-get.js',
            data: {data:orderNew}
        });
	}
});

//alert(orderNew);


var menuarray;
$('ol.sortable').nestedSortable({
    disableNesting: 'no-nest',
    forcePlaceholderSize: true,
    handle: 'div',
    helper: 'clone',
    items: 'li',
    maxLevels: 5,
    opacity: .6,
    placeholder: 'placeholder',
    revert: 250,
    tabSize: 25,
    tolerance: 'pointer',
    toleranceElement: '> div',
    
});

$('#form-menu').submit(function () {

// $("#send").click(function(){
        var data = $("ol.sortable").nestedSortable();
        //alert(data);
    });

var data = $("ol.sortable").nestedSortable();
       // alert(JSON.stringify(data));
var orderNew = $('sortable').nestedSortable('serialize');
var myJSON = JSON.stringify(orderNew);
//	alert(myJSON);









    $('body').on('change', '.get_subject', function () {
            
             var d = $(this).val();
             var result_id=$(this).attr('result_id');
             var course_id=$(this).attr('course_id');
             var enrol = $('#get_course_by_enrollment').val();
             console.log('year',d);
             console.log('course_id',course_id);
             
             //alert(d);

        			$.ajax({
        				type: 'POST',
        				url: get_loc + 'get_subject',
        				data:{
        				    'year':d,
        				    'course_id':course_id,
        				    'status':'subjects',
        				    'result_id':result_id,
        				    'enrol' : enrol
        				},
        				// data: 'course_id=' + d + '&status=' + 'subjects'  , 'result_id=' + result_id,
        				dataType: "json",
        				headers: {
        					'Client-Service': 'frontend-client',
        					'Auth-Key': 'simplerestapi',
        					'User-ID': loginid,
        					'Authorization': token,
        					'type': type
        				},
        				success: function (msg) {
        				console.log(msg);
        				   
        				   $('#list').html(msg);
        				   
        				},
        				error: function (msg) {
        					if (msg.responseJSON['status'] == 303) {
        						location.href = base_loc;
        					}
        				}
        			});    
				
				    
				
				
				
				
			
	});

    
    $('body').on('change', '.get_course_type', function () {
            
             var d = $(this).val();
            //  var result_id=$(this).attr('result_id');
            //  console.log(result_id);
             //alert(d);

        			$.ajax({
        				type: 'POST',
        				url: get_loc + 'get_course_type',
        				data:{
        				    'course_id':d,
        				    // 'status':'subjects',
        				    // 'result_id':result_id,
        				},
        				// data: 'course_id=' + d + '&status=' + 'subjects'  , 'result_id=' + result_id,
        				dataType: "json",
        				headers: {
        					'Client-Service': 'frontend-client',
        					'Auth-Key': 'simplerestapi',
        					'User-ID': loginid,
        					'Authorization': token,
        					'type': type
        				},
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
	    $('body').on('change', '.get_year', function () {
            
             var d = $(this).val();
            //  var result_id=$(this).attr('result_id');
            //  console.log(result_id);
             //alert(d);

        			$.ajax({
        				type: 'POST',
        				url: get_loc + 'get_year',
        				data:{
        				    'course_id':d,
        				    // 'status':'subjects',
        				    // 'result_id':result_id,
        				},
        				// data: 'course_id=' + d + '&status=' + 'subjects'  , 'result_id=' + result_id,
        				dataType: "json",
        				headers: {
        					'Client-Service': 'frontend-client',
        					'Auth-Key': 'simplerestapi',
        					'User-ID': loginid,
        					'Authorization': token,
        					'type': type
        				},
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
	
	
/*--------- start get year with course -----------------*/
     $('body').on('change', '.get_year_with_course', function () {
            
             var d = $(this).val();
            var enroll_id = $('#get_course_by_enrollment').val()
        	
        			$.ajax({
        				type: 'POST',
        				url: get_loc + 'get_year_by_course',
        				data:{
        				    'course_id':d,
        				    'enroll_id':enroll_id,
        				    // 'result_id':result_id,
        				},
        				// data: 'course_id=' + d + '&status=' + 'subjects'  , 'result_id=' + result_id,
        				dataType: "json",
        				headers: {
        					'Client-Service': 'frontend-client',
        					'Auth-Key': 'simplerestapi',
        					'User-ID': loginid,
        					'Authorization': token,
        					'type': type
        				},
        				success: function (msg) {
        				// console.log(msg);
        				   
        				   $('.course_type').html(msg);
        				   
        				},
        				error: function (msg,v,c) {
            				// 	if (msg.responseJSON['status'] == 303) {
            				// 		location.href = base_loc;
            				// 	}
            				console.warn*(msg.responseText);
        				}
        			});    
	});
	
	$(document).on('change','.get_student_fee',function(){
	   // console.log(this);
	    var d = $(this).val();
         var result_id=$(this).attr('result_id');
         var course_id=$(this).attr('course_id');
         var enrol = $('#get_course_by_enrollment').val();
        //  console.log('year',d);
        //  console.log('course_id',course_id);
        //  console.log('enrol',enrol);
        $('.cover').show();
	    	$.ajax({
        				type: 'POST',
        				url: get_loc + 'get_fee_structer',
        				data:{ 
        				    'course_id':course_id,
        				    'enroll_id':enrol,
        				    'duration':d,
        				},
        				// data: 'course_id=' + d + '&status=' + 'subjects'  , 'result_id=' + result_id,
        				dataType: "json",
        				headers: {
        					'Client-Service': 'frontend-client',
        					'Auth-Key': 'simplerestapi',
        					'User-ID': loginid,
        					'Authorization': token,
        					'type': type
        				},
        				success: function (msg) {
        				console.log(msg);
        				$('.cover').hide();
        				   
        				  $('#list').html(msg.html);
        				   
        				},
        				error: function (msg,v,c) {
            				// 	if (msg.responseJSON['status'] == 303) {
            				// 		location.href = base_loc;
            				// 	}
            				console.warn(msg.responseText);
            				$('.cover').hide();
        				}
        			});    
	});
	$(document).on('click','.payfee',function(){
        var course_id = $(this).data('course_id'),
            that = this,
            box = $(this).closest('.panel'),
            enrol = $(this).data('enroll_no'),
            duration = $(this).data('duration'),
            payableAmount = $(box).find('#amount').val(),
            btnHTml = $(this).html();
            $('.message-show').html('');
            
            if(!payableAmount){
                $.alert('Please Enter Amount.');
                $(box).find('#amount').focus()
                return false;
            }
            
            $(this).html('<i class="fa fa-spin fa-spinner"></i> Please Wait...').prop('disabled',true);
            $('.cover').show();
            
	    	$.ajax({
        				type: 'POST',
        				url: get_loc + 'payfee_by_center',
        				data:{ 
        				    'course_id':course_id,
        				    'enroll_id':enrol,
        				    'amount' : payableAmount,
        				    'duration' : duration
        				}, 
        				dataType: "json",
        				headers: {
        					'Client-Service': 'frontend-client',
        					'Auth-Key': 'simplerestapi',
        					'User-ID': loginid,
        					'Authorization': token,
        					'type': type
        				},
        				success: function (msg) {
            				console.log(msg);
            				$('.cover').hide();
            				$(that).html(btnHTml).prop('disabled',false);
        				   $('.message-show').html(msg.message);
        				   if(msg.status)
        				   $(document).find('.get_student_fee').trigger('change');
        				},
        				error: function (msg,v,c) {
            				// 	if (msg.responseJSON['status'] == 303) {
            				// 		location.href = base_loc;
            				// 	}
            				console.warn(msg.responseText);
            				$('.cover').hide();
            				$(that).html(btnHTml).prop('disabled',false);
            				$('.message-show').html(msg.responseText); 
        				}
        			});  
    })
	
	 $('body').on('change', '.get_year_with_course_for_fee', function () {
            
             var d = $(this).val();
            var enroll_id = $('#get_course_by_enrollment').val()
        	
        			$.ajax({
        				type: 'POST',
        				url: get_loc + 'get_year_by_course',
        				data:{
        				    'course_id':d,
        				    'enroll_id':enroll_id,
        				    'type' : 'get_student_fee'
        				    // 'result_id':result_id,
        				},
        				// data: 'course_id=' + d + '&status=' + 'subjects'  , 'result_id=' + result_id,
        				dataType: "json",
        				headers: {
        					'Client-Service': 'frontend-client',
        					'Auth-Key': 'simplerestapi',
        					'User-ID': loginid,
        					'Authorization': token,
        					'type': type
        				},
        				success: function (msg) {
        				// console.log(msg);
        				   
        				   $('.course_type').html(msg);
        				   
        				},
        				error: function (msg,v,c) {
            				// 	if (msg.responseJSON['status'] == 303) {
            				// 		location.href = base_loc;
            				// 	}
            				console.warn*(msg.responseText);
        				}
        			});    
	});





/*--------------- end get year with course -------------------------------*/
	
	
	
	
	
// 	get_admit_card_subject
	$('body').on('change', '.get_admit_card_subject', function () {
            
             var d = $(this).val();
            //  var result_id=$(this).attr('result_id');
            //  console.log(result_id);
             alert(d);

        			$.ajax({
        				type: 'POST',
        				url: get_loc + 'get_admit_card_subject',
        				data:{
        				    'course_id':d,
        				    // 'status':'subjects',
        				    // 'result_id':result_id,
        				},
        				// data: 'course_id=' + d + '&status=' + 'subjects'  , 'result_id=' + result_id,
        				dataType: "json",
        				headers: {
        					'Client-Service': 'frontend-client',
        					'Auth-Key': 'simplerestapi',
        					'User-ID': loginid,
        					'Authorization': token,
        					'type': type
        				},
        				success: function (msg) {
        				console.log(msg);
        				   
        				   $('.get_admit_card_subject').html(msg);
        				   
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
             //alert(d);

        			$.ajax({
        				type: 'POST',
        				url: get_loc + 'get_year_web',
        				data:{
        				    'course_id':d,
        				    // 'status':'subjects',
        				    // 'result_id':result_id,
        				},
        				// data: 'course_id=' + d + '&status=' + 'subjects'  , 'result_id=' + result_id,
        				dataType: "json",
        				headers: {
        					'Client-Service': 'frontend-client',
        					'Auth-Key': 'simplerestapi',
        					'User-ID': loginid,
        					'Authorization': token,
        					'type': type
        				},
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







});



/*------------ start check content type  --------------------------------*/
function myFunction(id){
   	var catid = id;
    if(catid == 1){
        $("#content_type").html('<input type="text" name="video" class="form-control" id="inputSuccess" placeholder="TITLE NAME"  required="required">');
        $("#content_type_title").html('URL');
        
        
    }else {
       
        
        $("#content_type").html('<input type="file" name="image" class="form-control startdate" id="inputError"  required="required">');
        $("#content_type_title").html('IMAGE');
       
    }
}
/*----------- end check content type -----------------------------------*/



/*

function get_subject()
{
    $.ajax({
		type: 'POST',
		url: get_loc + 'get_subject',
		data: 'sub_id=' + $('#course_id').val() + '&status=' + subjects,
		dataType: "json",
		headers: {
			'Client-Service': 'frontend-client',
			'Auth-Key': 'simplerestapi',
			'User-ID': loginid,
			'Authorization': token,
			'type': type
		},
		success: function (msg) {
		console.log(msg);
		   
		   $('#list').html(msg);
		   
		},
		error: function (msg) {
			if (msg.responseJSON['status'] == 303) {
				location.href = base_loc;
			}
		}
	});
}


*/


