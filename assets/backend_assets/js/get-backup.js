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
				error: function (msg) {

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



	/* get district */

	$('body').on('change', '.state', function () {

		$(this).closest('.row').find('.city option').remove();

		var d = $(this);

		if ($(this).val() != '') {

			$.ajax({

				type: 'POST',

				url: get_loc + 'get_district',

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
			"data": { crsftoken: crsfharsh,status: '0',page_name: '1', }
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

			"data": { crsftoken: crsfharsh,status: '0', }

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
		//	{ "data": "ACTION" },

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
			
	});
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
		$(this).closest('.row').find('.category option').remove();
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
					$('.category option').remove();
					var str = '';
					str += "<option value=''>--Select Category--</option>";
					$.each(msg, function (index, element) {
						str += "<option value='" + element.CAT_ID + "'>" + element.CATEGORY_NAME + "</option>";
					});
					d.closest('.row').find('.category').append(str);
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


/*----------------------- end new user registration list ----------------------------------------------------*/






});

