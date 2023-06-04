$(document).ready(function () {



	$("#whyus").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'whyus',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {

					      location.href = base_loc + 'whyus';

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});



	$("#profile").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'update_profile',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {

					      location.href = base_loc + 'profile';

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});













$('body').on('click', '.publish_feedback ', function () {





	if(!confirm("Do you really want to do this?")) {

    return false;

  	}else{



  

		

		var feedbackid = $(this).attr('feedbackid');

			

		if (feedbackid != '') {

			$.ajax({

				type: 'POST',

				url: post_loc + 'update_feedback_status',

				data: 'feedbackid=' + feedbackid,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				beforeSend: function () {

					$(this).attr("disabled", "disabled");

					$('.cover').show();

				},

				success: function (msg) {

					if (msg.message == "ok") {

						$(this).attr("disabled", false);

				/////////////////////////////////////////						

					$('#feedback_list').dataTable().fnDestroy();

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

					

					///////////// end get status ///////////////////////

					} else {

						show_message('Error', msg.message, 'error');

					}

					$('.cover').hide();



				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

		} else {

			show_message('Error', 'Please fill all inputs', 'error');



		}

	}	

	});







	$("#blogsubmit").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'blogsubmit',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});









$('body').on('click', '.publish_blog ', function () {





	if(!confirm("Do you really want to do this?")) {

    return false;

  	}else{

		var blogid = $(this).attr('blogid');

		//alert(blogid)	

		if (blogid != '') {

			$.ajax({

				type: 'POST',

				url: post_loc + 'publish_blog',

				data: 'blogid=' + blogid,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				beforeSend: function () {

					$(this).attr("disabled", "disabled");

					$('.cover').show();

				},

				success: function (msg) {

					if (msg.message == "ok") {

						$(this).attr("disabled", false);

				/////////////////////////////////////////						

					$('#blog_list').dataTable().fnDestroy();

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

					

					///////////// end get status ///////////////////////

					} else {

						show_message('Error', msg.message, 'error');

					}

					$('.cover').hide();



				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

		} else {

			show_message('Error', 'Please fill all inputs', 'error');



		}

	}	

	});





	$("#visiontitle").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'visiontitle',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {

					      location.href = base_loc + 'vision';

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});



	$("#question_answer").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'question_answer',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {

					      location.href = base_loc + 'fquestion';

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});







$('body').on('click', '.publish_question ', function () {





	if(!confirm("Do you really want to do this?")) {

    return false;

  	}else{

		var questionid = $(this).attr('questionid');

		//alert(blogid)	

		if (questionid != '') {

			$.ajax({

				type: 'POST',

				url: post_loc + 'publish_question',

				data: 'questionid=' + questionid,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				beforeSend: function () {

					$(this).attr("disabled", "disabled");

					$('.cover').show();

				},

				success: function (msg) {

					if (msg.message == "ok") {

						$(this).attr("disabled", false);

				/////////////////////////////////////////						

					$('#fquestion_list').dataTable().fnDestroy();

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

					

					///////////// end get status ///////////////////////

					} else {

						show_message('Error', msg.message, 'error');

					}

					$('.cover').hide();



				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

		} else {

			show_message('Error', 'Please fill all inputs', 'error');



		}

	}	

	});







$('body').on('click', '.publish_event', function () {





	if(!confirm("Do you really want to do this?")) {

    return false;

  	}else{

		var blogid = $(this).attr('blogid');

		//alert(blogid)	

		if (blogid != '') {

			$.ajax({

				type: 'POST',

				url: post_loc + 'publish_blog',

				data: 'blogid=' + blogid,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				beforeSend: function () {

					$(this).attr("disabled", "disabled");

					$('.cover').show();

				},

				success: function (msg) {

					if (msg.message == "ok") {

						$(this).attr("disabled", false);

				/////////////////////////////////////////						

					$('#events_list').dataTable().fnDestroy();

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

					

					///////////// end get status ///////////////////////

					} else {

						show_message('Error', msg.message, 'error');

					}

					$('.cover').hide();



				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

		} else {

			show_message('Error', 'Please fill all inputs', 'error');



		}

	}	

	});

	

	

	$('body').on('click', '.publish_gallery', function () {





	if(!confirm("Do you really want to do this?")) {

    return false;

  	}else{

		var blogid = $(this).attr('blogid');

		//alert(blogid)	

		if (blogid != '') {

			$.ajax({

				type: 'POST',

				url: post_loc + 'publish_blog',

				data: 'blogid=' + blogid,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				beforeSend: function () {

					$(this).attr("disabled", "disabled");

					$('.cover').show();

				},

				success: function (msg) {

					if (msg.message == "ok") {

						$(this).attr("disabled", false);

				/////////////////////////////////////////						

					$('#gallery_list').dataTable().fnDestroy();

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

					

					///////////// end get status ///////////////////////

					} else {

						show_message('Error', msg.message, 'error');

					}

					$('.cover').hide();



				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

		} else {

			show_message('Error', 'Please fill all inputs', 'error');



		}

	}	

	});

	



	$("#add_member").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'add_member',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {

					    //  location.href = base_loc + 'member';

					//}, 3000);

					$('#member_list').dataTable().fnDestroy();

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

				



				$('#modal_add_member').modal('hide');

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});





	$("#update_member").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'update_member',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {

					    //  location.href = base_loc + 'member';

					//}, 3000);

					$('#member_list').dataTable().fnDestroy();

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

				



				$('#modal_update_member').modal('hide');

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});



	$('body').on('click', '.publish_member', function () {





	if(!confirm("Do you really want to do this?")) {

    return false;

  	}else{

		var memberid = $(this).attr('memberid');

		//alert(blogid)	

		if (memberid != '') {

			$.ajax({

				type: 'POST',

				url: post_loc + 'publish_member',

				data: 'memberid=' + memberid,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				beforeSend: function () {

					$(this).attr("disabled", "disabled");

					$('.cover').show();

				},

				success: function (msg) {

					if (msg.message == "ok") {

						$(this).attr("disabled", false);

				/////////////////////////////////////////						

					$('#member_list').dataTable().fnDestroy();

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

							{ "data": "MEMBER_STATUS" },

							{ "data": "ACTION" },



						]

					});

					

					///////////// end get status ///////////////////////

					} else {

						show_message('Error', msg.message, 'error');

					}

					$('.cover').hide();



				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

		} else {

			show_message('Error', 'Please fill all inputs', 'error');



		}

	}	

	});







$("#changefavicon").on('submit', function (e) {



//alert('hh');

	if(!confirm("Do you really want to do this?")) {

    return false;

  	}else{



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'favicon',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {

					      location.href = base_loc + 'site_setting';

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});	

		

		}	

	});









	$("#header_logo").on('submit', function (e) {



//alert('hh');

	if(!confirm("Do you really want to do this?")) {

    return false;

  	}else{



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'header_logo',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {

					      location.href = base_loc + 'site_setting';

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});	

		

		}	

	});



$("#fotter_logo").on('submit', function (e) {



//alert('hh');

	if(!confirm("Do you really want to do this?")) {

    return false;

  	}else{



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'fotter_logo',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {

					      location.href = base_loc + 'site_setting';

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});	

		

		}	

	});



$("#background_image").on('submit', function (e) {



//alert('hh');

	if(!confirm("Do you really want to do this?")) {

    return false;

  	}else{



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'background_image',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {

					      location.href = base_loc + 'site_setting';

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});	

		

		}	

	});



$("#background_image2").on('submit', function (e) {



//alert('hh');

	if(!confirm("Do you really want to do this?")) {

    return false;

  	}else{



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'background_image',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {

					      location.href = base_loc + 'site_setting';

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});	

		

		}	

	});





$("#social_link").on('submit', function (e) {



//alert('hh');

	if(!confirm("Do you really want to do this?")) {

    return false;

  	}else{



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'social_link',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {

					      location.href = base_loc + 'site_setting';

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});	

		

		}	

	});



$('body').on('click', '.remove_social_links', function () {
	if(!confirm("Do you really want to do this?")) {
    return false;
  	}else{
		var linkid = $(this).attr('sociallinkid');
		if (linkid != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'remove_social_links',
				data: 'linkid=' + linkid,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				beforeSend: function () {
					$('.cover').show();
				},
				success: function (msg) {
					 location.href = base_loc + 'site_setting';
					$('.cover').hide();
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
				}
			});
		} else {
			show_message('Error', 'Please fill all inputs', 'error');
	    }
	}	
});





$('body').on('click', '.remove_vision', function () {

	if(!confirm("Do you really want to do this?")) {
    return false;
  	}else{
		var linkid = $(this).attr('visionid');
		//alert(blogid)	
		if (linkid != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'remove_vision',
				data: 'linkid=' + linkid,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				beforeSend: function () {
					$('.cover').show();
				},
				success: function (msg) {
					 location.href = base_loc + 'vision';
					$('.cover').hide();
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
				}
			});
		} else {
			show_message('Error', 'Please fill all inputs', 'error');
		}
	}	
	});



	
/*---------------- remove banner -----------------------------------*/
$('body').on('click', '.delete_banner_list', function () {
	if(!confirm("Do you really want to do this?")) {
    return false;
  	}else{
		var id = $(this).attr('bannerid');
		if (id != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'remove_delete_banner_list',
				data: 'id=' + id,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				beforeSend: function () {
					$('.cover').show();
				},
				success: function (msg) {
					 location.href = base_loc + 'list_banner';
					$('.cover').hide();
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
				}
			});
		} else {
			show_message('Error', 'Please fill all inputs', 'error');
	    }
	}	
});



/*--------------------- end remove banner ---------------------------*/










$("#upload_certificate").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'upload_certificate',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {

					      // location.href = base_loc+upload_certificate;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});

// update volunteer
// $("#update_volunteer").on('submit', function (e) {



// 		e.preventDefault();

// 			$.ajax({

// 				type: 'POST',

// 				url: post_loc + 'update_volunteer',

// 				data: new FormData(this),

// 				contentType: false,

// 				cache: false,

// 				processData: false,

// 				headers: {

// 					'Client-Service': 'frontend-client',

// 					'Auth-Key': 'simplerestapi',

// 					'User-ID': loginid,

// 					'Authorization': token,

// 					'type': type

// 				},

// 				success: function (msg) {

// 				console.log(msg);

// 				 	setTimeout(function() {

// 					     location.href = base_loc + 'member';

// 					}, 3000);
// 			$('#modal_update_member').modal('hide');

// 				},

// 				error: function (msg) {

// 					if (msg.responseJSON['status'] == 303) {

// 						location.href = base_loc;

// 					}

// 				}

// 			});

// 	});

// $('body').on('submit', "#update_volunteer", function (e) {
// 		e.preventDefault();
// 		$.ajax({
// 			type: 'POST',
// 			url: post_loc + 'update_volunteer',
// 			data: new FormData(this),
// 			contentType: false,
// 			cache: false,
// 			processData: false,
// 			headers: {
// 				'Client-Service': 'frontend-client',
// 				'Auth-Key': 'simplerestapi',
// 				'User-ID': loginid,
// 				'Authorization': token,
// 				'type': type
// 			},
// 			beforeSend: function () {
// 				$('.update_vol').attr("disabled", "disabled");
// 			},
// 			success: function (msg) {
				
// 				//console.log(msg);
// 				if (msg.message == "ok") {
// 				 	setTimeout(function() {
// 				 	       location.href = base_loc + 'request';
// 				 	    }, 3000);
				
// 				// } else {
// 				// 	show_message('Error', msg.message, 'error');
// 				// 	$('.editfirm').attr("disabled", false);
// 				 }else{
// 				 	alert('Some thing is Missing')
// 				 }
// 			},
// 			error: function (msg) {
// 				if (msg.responseJSON['status'] == 303) {
// 					location.href = base_loc;
// 				}
// 			}
// 		});
// 	});
// // end update volunteer
// /*-----------------delete volunteer*/ 
// $('body').on('submit', "#delete_volunteer", function (e) {
// 		e.preventDefault();
// 		$.ajax({
// 			type: 'POST',
// 			url: post_loc + 'delete_volunteer',
// 			data: new FormData(this),
// 			contentType: false,
// 			cache: false,
// 			processData: false,
// 			headers: {
// 				'Client-Service': 'frontend-client',
// 				'Auth-Key': 'simplerestapi',
// 				'User-ID': loginid,
// 				'Authorization': token,
// 				'type': type
// 			},
// 			beforeSend: function () {
// 				$('.delete_volunteer_btn').attr("disabled", "disabled");
// 			},
// 			success: function (msg) {
				
// 				//console.log(msg);
// 				if (msg.message == "ok") {
// 				 	setTimeout(function() {
// 				 	       location.href = base_loc + 'request';
// 				 	    }, 3000);
				
// 				// } else {
// 				// 	show_message('Error', msg.message, 'error');
// 				// 	$('.editfirm').attr("disabled", false);
// 				 }else{
// 				 	alert('Some thing is Missing')
// 				 }
// 			},
// 			error: function (msg) {
// 				if (msg.responseJSON['status'] == 303) {
// 					location.href = base_loc;
// 				}
// 			}
// 		});
// 	});
// // end delete volunteer

// /*-----------------update feedback----------------------*/ 
// $('body').on('submit', "#update_feedback", function (e) {
// 		e.preventDefault();
// 		$.ajax({
// 			type: 'POST',
// 			url: post_loc + 'update_feedback',
// 			data: new FormData(this),
// 			contentType: false,
// 			cache: false,
// 			processData: false,
// 			headers: {
// 				'Client-Service': 'frontend-client',
// 				'Auth-Key': 'simplerestapi',
// 				'User-ID': loginid,
// 				'Authorization': token,
// 				'type': type
// 			},
// 			beforeSend: function () {
// 				$('.update_feedback_btn').attr("disabled", "disabled");
// 			},
// 			success: function (msg) {
				
// 				//console.log(msg);
// 				if (msg.message == "ok") {
// 				 	setTimeout(function() {
// 				 	       location.href = base_loc + 'feedback';
// 				 	    }, 3000);
				
// 				// } else {
// 				// 	show_message('Error', msg.message, 'error');
// 				// 	$('.editfirm').attr("disabled", false);
// 				 }else{
// 				 	alert('Some thing is Missing')
// 				 }
// 			},
// 			error: function (msg) {
// 				if (msg.responseJSON['status'] == 303) {
// 					location.href = base_loc;
// 				}
// 			}
// 		});
// 	});
// // end update feedback
// /*-----------------delete feedback----------------------*/ 
// $('body').on('submit', "#delete_feedback", function (e) {
// 		e.preventDefault();
// 		$.ajax({
// 			type: 'POST',
// 			url: post_loc + 'delete_feedback',
// 			data: new FormData(this),
// 			contentType: false,
// 			cache: false,
// 			processData: false,
// 			headers: {
// 				'Client-Service': 'frontend-client',
// 				'Auth-Key': 'simplerestapi',
// 				'User-ID': loginid,
// 				'Authorization': token,
// 				'type': type
// 			},
// 			beforeSend: function () {
// 				$('.delete_feedback_btn').attr("disabled", "disabled");
// 			},
// 			success: function (msg) {
				
// 				//console.log(msg);
// 				if (msg.message == "ok") {
// 				 	setTimeout(function() {
// 				 	       location.href = base_loc + 'feedback';
// 				 	    }, 3000);
				
// 				// } else {
// 				// 	show_message('Error', msg.message, 'error');
// 				// 	$('.editfirm').attr("disabled", false);
// 				 }else{
// 				 	alert('Some thing is Missing')
// 				 }
// 			},
// 			error: function (msg) {
// 				if (msg.responseJSON['status'] == 303) {
// 					location.href = base_loc;
// 				}
// 			}
// 		});
// 	});
// // end delete feedback
// /*-----------------slider details----------------------*/ 
$('body').on('submit', "#slider", function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: post_loc + 'add_slider_details',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			headers: {
				'Client-Service': 'frontend-client',
				'Auth-Key': 'simplerestapi',
				'User-ID': loginid,
				'Authorization': token,
				'type': type
			},
			beforeSend: function () {
				$('.add_slider_btn').attr("disabled", "disabled");
			},
			success: function (msg) {
				
				//console.log(msg);
				if (msg.message == "ok") {
				 	setTimeout(function() {
				 	       location.href = base_loc + 'slider_details';
				 	    }, 3000);
				
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
// end slider details
/*-----------------update slider details----------------------*/ 
$('body').on('submit', "#update_slider_details", function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: post_loc + 'update_slider_details',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			headers: {
				'Client-Service': 'frontend-client',
				'Auth-Key': 'simplerestapi',
				'User-ID': loginid,
				'Authorization': token,
				'type': type
			},
			beforeSend: function () {
				$('.update_slider').attr("disabled", "disabled");
			},
			success: function (msg) {
				
				//console.log(msg);
				if (msg.message == "ok") {
				 
				 	       location.href = base_loc + 'slider_list';
				 	  
				
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
// end slider details
/*-----------------delete slider details----------------------*/ 
$('body').on('submit', "#delete_slider_details", function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: post_loc + 'delete_slider_details',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			headers: {
				'Client-Service': 'frontend-client',
				'Auth-Key': 'simplerestapi',
				'User-ID': loginid,
				'Authorization': token,
				'type': type
			},
			beforeSend: function () {
				$('.delete_slider_btn').attr("disabled", "disabled");
			},
			success: function (msg) {
				
				//console.log(msg);
				if (msg.message == "ok") {
				 	setTimeout(function() {
				 	       location.href = base_loc + 'slider_list';
				 	    }, 3000);
				
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
// // end slider details
// /*-----------------service details----------------------*/ 
$('body').on('submit', "#service", function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: post_loc + 'add_our_services',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			headers: {
				'Client-Service': 'frontend-client',
				'Auth-Key': 'simplerestapi',
				'User-ID': loginid,
				'Authorization': token,
				'type': type
			},
			beforeSend: function () {
				$('.service_btn').attr("disabled", "disabled");
			},
			success: function (msg) {
				
				//console.log(msg);
				if (msg.message == "ok") {
				 //	setTimeout(function() {
				 	       location.href = base_loc + 'our_services';
				 //	    }, 3000);
				
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
// end slider details
/*-----------------update vision---------------------*/ 
$('body').on('submit', "#update_vision", function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: post_loc + 'update_vision',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			headers: {
				'Client-Service': 'frontend-client',
				'Auth-Key': 'simplerestapi',
				'User-ID': loginid,
				'Authorization': token,
				'type': type
			},
			beforeSend: function () {
				$('.update_vision_btn').attr("disabled", "disabled");
			},
			success: function (msg) {
				
				//console.log(msg);
				if (msg.message == "ok") {
				 	setTimeout(function() {
				 	       location.href = base_loc + 'vision';
				 	    }, 3000);
				
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
// end visiion details
/*-----------------delete vision---------------------*/ 
$('body').on('submit', "#delete_vision", function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: post_loc + 'delete_vision',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			headers: {
				'Client-Service': 'frontend-client',
				'Auth-Key': 'simplerestapi',
				'User-ID': loginid,
				'Authorization': token,
				'type': type
			},
			beforeSend: function () {
				$('.delete_vision_btn').attr("disabled", "disabled");
			},
			success: function (msg) {
				
				//console.log(msg);
				if (msg.message == "ok") {
				 	setTimeout(function() {
				 	       location.href = base_loc + 'vision';
				 	    }, 3000);
				
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
// end delete vision
/*-----------------update fquestion---------------------*/ 
$('body').on('submit', "#update_fquestion", function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: post_loc + 'update_question_answer',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			headers: {
				'Client-Service': 'frontend-client',
				'Auth-Key': 'simplerestapi',
				'User-ID': loginid,
				'Authorization': token,
				'type': type
			},
			beforeSend: function () {
				$('.update_fquestion_btn').attr("disabled", "disabled");
			},
			success: function (msg) {
				
				//console.log(msg);
				if (msg.message == "ok") {
				 	setTimeout(function() {
				 	       location.href = base_loc + 'fquestion';
				 	    }, 3000);
				
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
// end update fquestion
/*-----------------delete fquestion---------------------*/ 
$('body').on('submit', "#delete_fquestion", function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: post_loc + 'delete_question_answer',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			headers: {
				'Client-Service': 'frontend-client',
				'Auth-Key': 'simplerestapi',
				'User-ID': loginid,
				'Authorization': token,
				'type': type
			},
			beforeSend: function () {
				$('.delete_fquestion_btn').attr("disabled", "disabled");
			},
			success: function (msg) {
				
				//console.log(msg);
				if (msg.message == "ok") {
				 	setTimeout(function() {
				 	       location.href = base_loc + 'fquestion';
				 	    }, 3000);
				
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
// end slider details

/*-----------------add enquiry web---------------------*/ 
$('body').on('submit', "#add_enquiry", function (e) {
	alert('web')
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
				 	setTimeout(function() {
				 	    //    location.href = site_loc + 'index';
						 location.reload();
				 	    }, 3000);
				
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
// end update fquestion

/*-----------------delete enquiry---------------------*/ 
$('body').on('submit', "#delete_enquiry", function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: post_loc + 'delete_enquiry_answer',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			headers: {
				'Client-Service': 'frontend-client',
				'Auth-Key': 'simplerestapi',
				'User-ID': loginid,
				'Authorization': token,
				'type': type
			},
			beforeSend: function () {
				$('.delete_enquiry_btn').attr("disabled", "disabled");
			},
			success: function (msg) {
				
				//console.log(msg);
				if (msg.message == "ok") {
				 	setTimeout(function() {
				 	       location.href = base_loc + 'contact_form_list';
				 	    }, 3000);
				
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
// end slider details
/*-----------------update causes---------------------*/ 
$('body').on('submit', "#update_causes", function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: post_loc + 'update_cause_details',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			headers: {
				'Client-Service': 'frontend-client',
				'Auth-Key': 'simplerestapi',
				'User-ID': loginid,
				'Authorization': token,
				'type': type
			},
			beforeSend: function () {
				$('.update_cause_btn').attr("disabled", "disabled");
			},
			success: function (msg) {
				
				//console.log(msg);
				if (msg.message == "ok") {
				 	setTimeout(function() {
				 	       location.href = base_loc + 'our_causes';
				 	    }, 3000);
				
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
// // end update cause
/*-----------------delete causes---------------------*/ 
$('body').on('submit', "#delete_cause", function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: post_loc + 'delete_cause_details',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			headers: {
				'Client-Service': 'frontend-client',
				'Auth-Key': 'simplerestapi',
				'User-ID': loginid,
				'Authorization': token,
				'type': type
			},
			beforeSend: function () {
				$('.delete_cause_btn').attr("disabled", "disabled");
			},
			success: function (msg) {
				
				//console.log(msg);
				if (msg.message == "ok") {
				 	//setTimeout(function() {
				 	       location.href = base_loc + 'our_causes';
				 	  //  }, 3000);
				
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
// end add causes

/*-----------------add causes---------------------*/ 
$('body').on('submit', "#add_causes", function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: post_loc + 'add_cause_details',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			headers: {
				'Client-Service': 'frontend-client',
				'Auth-Key': 'simplerestapi',
				'User-ID': loginid,
				'Authorization': token,
				'type': type
			},
			beforeSend: function () {
				$('.add_cause_btn').attr("disabled", "disabled");
			},
			success: function (msg) {
				
				//console.log(msg);
				if (msg.message == "ok") {
				 	//setTimeout(function() {
				 	       location.href = base_loc + 'our_causes';
				 	    //}, 3000);
				
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

 
/*------------ end of debtor form ---------------*/ 
// form fields data
	$('body').on('submit', "#seller_form", function (e) {
					 // alert('inseidf');
				e.preventDefault();
				$.ajax({
				type: 'POST',
				url: post_loc + 'seller_form',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				headers: {
				'Client-Service': 'frontend-client',
				'Auth-Key': 'simplerestapi',
				'User-ID': loginid,
				'Authorization': token,
				'type': type
				},
				beforeSend: function () {
				$('.seller_form_btn').attr("disabled", "disabled");
				},
				success: function (msg) {
					//alert('sucess');
				console.log(msg);
				if (msg.message == "ok") {
				setTimeout(function() {
				location.href = base_loc + 'form_fields';
				}, 3000);

				// } else {
				// show_message('Error', msg.message, 'error');
				// $('.editfirm').attr("disabled", false);
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
// update form fields data
	$('body').on('submit', "#update_seller_form", function (e) {
					 alert('inseidf');
				e.preventDefault();
				$.ajax({
				type: 'POST',
				url: post_loc + 'update_seller_form',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				headers: {
				'Client-Service': 'frontend-client',
				'Auth-Key': 'simplerestapi',
				'User-ID': loginid,
				'Authorization': token,
				'type': type
				},
				beforeSend: function () {
				$('.update_form_btn').attr("disabled", "disabled");
				},
				success: function (msg) {
					//alert('sucess');
				console.log(msg);
				if (msg.message == "ok") {
				setTimeout(function() {
				location.href = base_loc + 'update_agent_form';
				}, 3000);

				// } else {
				// show_message('Error', msg.message, 'error');
				// $('.editfirm').attr("disabled", false);
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
				
// agent form data
	/*----------------- START OF seller form data -------------------*/


			$('body').on('submit', "#agent_form_fields", function (e) {
					// console.log(this);
					// alert('this');
				e.preventDefault();
				$.ajax({
				type: 'POST',
				url: post_loc + 'agent_form_fields',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				headers: {
				'Client-Service': 'frontend-client',
				'Auth-Key': 'simplerestapi',
				'User-ID': loginid,
				'Authorization': token,
				'type': type
				},
				beforeSend: function () {
				$('.add_agent_feilds').attr("disabled", "disabled");
				},
				success: function (msg) {

				console.log(msg);
				if (msg.message == "ok") {
				// setTimeout(function() {
				// 	location.href = base_loc + 'preview/';
				// }, 3000);

				// } else {
				// show_message('Error', msg.message, 'error');
				// $('.editfirm').attr("disabled", false);
				}else{
				alert('Some thing is Missing')
				}

				// location.reload();	
			},
				error: function (msg) {
				if (msg.responseJSON['status'] == 303) {
					location.href = base_loc;
				}
				else if (msg.responseJSON.status == 400) {
					// show_message('Error', msg.responseJSON.message, 'error');
					alert(msg.responseJSON.message);
				}
		}
	});
});
/*-----------------add causes---------------------*/ 
$('body').on('submit', "#delete_member", function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: post_loc + 'delete_member',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			headers: {
				'Client-Service': 'frontend-client',
				'Auth-Key': 'simplerestapi',
				'User-ID': loginid,
				'Authorization': token,
				'type': type
			},
			beforeSend: function () {
				$('.delete_member_btn').attr("disabled", "disabled");
			},
			success: function (msg) {
				
				//console.log(msg);
				if (msg.message == "ok") {
				 	setTimeout(function() {
				 	       location.href = base_loc + 'member';
				 	    }, 3000);
				
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
  /*------------------add comment--------------*/

$('body').on('submit', "#add_comment", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'add_comment',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.add_comment_btn').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {
location.reload();
				 	      //  location.href = base_loc + 'user_data_list';

				 	    }, 3000);

				

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
/*------------------add wallet amount--------------*/

$('body').on('submit', "#add_wallet", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'add_my_wallet',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.add_wallet_btn').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'my_wallet';

				 	    }, 3000);

				

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
	// active/deactive service
	$('body').on('change', '.change-service', function () {
		
	var id = $(this).data('id');
		alert(id);
		
		if (id != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'update_service_status',
				data: 'checkid=' + id,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
						location.href = base_loc + 'service_list';
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
  	// active/deactive news
	$('body').on('change', '.change-news', function () {
	var id = $(this).data('id');
		
		
		if (id != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'update_news_status',
				data: 'checkid=' + id,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
						location.href = base_loc + 'news_list';
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
	// flash image
		$('body').on('change', '.change-flash-image', function () {
	var id = $(this).data('id');
		
		
		if (id != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'update_flash_image_status',
				data: 'checkid=' + id,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
						location.href = base_loc + 'flash_image_list';
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
  	$('body').on('change', '.change-event', function () {
	var id = $(this).data('id');
		
    // alert(id);
		
		if (id != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'update_event_status',
				data: 'checkid=' + id,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
						location.href = base_loc + 'event_list';
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
    	$('body').on('change', '.change-gallery', function () {
	var id = $(this).data('id');
		
    // alert(id);
		
		if (id != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'update_gallery_status',
				data: 'checkid=' + id,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
						location.href = base_loc + 'gallery_list';
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
    	$('body').on('change', '.change-exam', function () {
	var id = $(this).data('id');
		
    // alert(id);
		
		if (id != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'update_exam_status',
				data: 'checkid=' + id,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
						location.href = base_loc + 'examination_list';
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
    	$('body').on('change', '.change-add', function () {
	var id = $(this).data('id');
		
    // alert(id);
		
		if (id != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'update_add_status',
				data: 'checkid=' + id,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
						location.href = base_loc + 'add_list';
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
	$('body').on('change', '.change-student', function () {
	var id = $(this).data('id');
		
    // alert(id);
		
		if (id != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'update_student_status',
				data: 'checkid=' + id,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
						location.href = base_loc + 'student_corner_list';
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



		// active/deactive branches
	$('body').on('change', '.change-branches', function () {
	var id = $(this).data('id');
	alert(id);
		
		
		if (id != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'update_branches_status',
				data: 'checkid=' + id,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
						location.href = base_loc + 'our_branches_list';
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
	 	// active/deactive advance notice
	$('body').on('change', '.change-advance-notice', function () {
	var id = $(this).data('id');
		
		
		if (id != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'update_advance_notice_status',
				data: 'checkid=' + id,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
						location.href = base_loc + 'advance_notice_list';
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
    	// active/deactive latest news
	$('body').on('change', '.change-latest-news', function () {
	var id = $(this).data('id');
		
		
		if (id != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'update_latest_news_status',
				data: 'checkid=' + id,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
						location.href = base_loc + 'latest_news_list';
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
  	// active/deactive notice
	$('body').on('change', '.change-notice', function () {
	var id = $(this).data('noticeid');
  
		
		
		if (id != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'update_notice_status',
				data: 'checkid=' + id,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
						location.href = base_loc + 'notice_list';
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
/*------------------add AGENT--------------*/
// alert	('post');
$('body').on('submit', "#add_agent", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'add_agent',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.add_agent').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'add_agent';

				 	    }, 3000);

				

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
/*------------------UPDATE AGENT--------------*/

$('body').on('submit', "#update_agent", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'update_agent',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.update_agent_btn').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'agent_list';

				 	    }, 3000);

				

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
/*------------------delete AGENT--------------*/

$('body').on('submit', "#deleteagent", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'delete_agent',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.delete_agent_btn').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'agent_list';

				 	    }, 3000);

				

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

/*------------------ADD plan--------------*/

$('body').on('submit', "#add_plan", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'add_plan',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.add_plan').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'plan_list';

				 	    }, 3000);

				

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
/*------------------update plan--------------*/

$('body').on('submit', "#update_plan", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'update_plan',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.update_plan_btn').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'plan_list';

				 	    }, 3000);

				

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
/*------------------update plan--------------*/

$('body').on('submit', "#deleteplan", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'delete_plan',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.delete_plan_btn').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'plan_list';

				 	    }, 3000);

				

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

/*------------------add DOCUMENT--------------*/
// alert	('post');
$('body').on('submit', "#add_document", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'add_document',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.add_agent').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'agent_data_list';

				 	    }, 3000);

				

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
// wallet request
$('body').on('submit', "#wallet_request", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'wallet_request',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.add_wallet_request').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'wallet_request';

				 	    }, 3000);

				

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
// wallet request
$('body').on('click', ".cancel_request", function (e) {

		e.preventDefault();
		var rq_id = $(this).data('requestcancelid');
console.log(rq_id);
		var form = new FormData();
		form.append('rq_id',rq_id);
		$.ajax({

			type: 'POST',

			url: post_loc + 'cancel_wallet_request',


			data: form,

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.cancel_request').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'wallet_request';

				 	    }, 3000);

				

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
// $('body').on('click', ".approved", function (e) {
// // alert('approve');
// 		e.preventDefault();
// 		// console.log($(this).data('agentid'));

// 		$.ajax({

// 			type: 'POST',

// 			url: post_loc + 'wallet_request_approve',

// 			data: new FormData(this),

// 			contentType: false,

// 			cache: false,

// 			processData: false,

// 			headers: {

// 				'Client-Service': 'frontend-client',

// 				'Auth-Key': 'simplerestapi',

// 				'User-ID': loginid,

// 				'Authorization': token,

// 				'type': type

// 			},

// 			beforeSend: function () {

// 				$('.add_wallet_request').attr("disabled", "disabled");

// 			},

// 			success: function (msg) {

				

// 				//console.log(msg);

// 				if (msg.message == "ok") {

// 				 	setTimeout(function() {

// 				 	       location.href = base_loc + 'agent_data_list';

// 				 	    }, 3000);

				

// 				// } else {

// 				// 	show_message('Error', msg.message, 'error');

// 				// 	$('.editfirm').attr("disabled", false);

// 				 }else{

// 				 	alert('Some thing is Missing')

// 				 }

// 			},

// 			error: function (msg) {

// 				if (msg.responseJSON['status'] == 303) {

// 					location.href = base_loc;

// 				}

// 			}

// 		});

// 	});
// approve wallet request
$('body').on('submit', "#approve_wallet_request", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'approve_wallet_request',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.approve_wallet_request').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'agent_wallet_request';

				 	    }, 3000);

				

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
// reject request
$('body').on('submit', "#reject_wallet_request", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'reject_wallet_request',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.reject_wallet_request').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'agent_wallet_request';

				 	    }, 3000);

				

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
	$('body').on('submit', "#add_account", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'add_account',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.add_account_btn').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'add_account';

				 	    }, 3000);

				

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
	$('body').on('submit', "#add_vedio", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'add_vedio',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.add_vedio').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'add_vedio';

				 	    }, 3000);

				

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
  	$('body').on('submit', "#add_pdf", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'add_pdf',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.add_pdf').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'add_pdf';

				 	    }, 3000);

				

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
	$('body').on('submit', "#add_link", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'add_link',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.add_link').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'links';

				 	    }, 3000);

				

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
	/*------------------add DOCUMENT--------------*/
// alert	('post');
$('body').on('submit', "#add_documents", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'add_documents',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.add_documents').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'documents';

				 	    }, 3000);

				

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
// add department
$('body').on('submit', "#add_dpt", function (e) {
	// alert('inside');

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'add_dpt',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.add_dpt').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'add_department';

				 	    }, 3000);

				

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
	$('body').on('submit', "#add_user", function (e) {
	// alert('inside');

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'add_user',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.add_br').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	    //    location.href = base_loc + 'add_user';

				 	    }, 3000);

				

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
  // update user
// alert('outrosd');
$('body').on('submit', "#updateuser", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'update_user',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.update_user_btn').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'listuser';

				 	    }, 3000);

				

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




	// active/deactive department
	$('body').on('change', '.change-dpt', function () {
	var id = $(this).data('id');
		
		
		if (id != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'update_dpt_status',
				data: 'checkid=' + id,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
						location.href = base_loc + 'list_department';
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
   	// active/deactive user
	$('body').on('change', '.change-user', function () {
	var id = $(this).data('id');
		
		
		if (id != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'update_user_status',
				data: 'checkid=' + id,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
						location.href = base_loc + 'listuser';
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
// delete user

$('body').on('submit', "#deleteuser", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'delete_user',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.delete_user_btn').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'listuser';

				 	    }, 3000);

				

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
	// update department

$('body').on('submit', "#add_service_comment", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'add_service_comment',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.add_comment_btn').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'service_list';

				 	    }, 3000);

				

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

// update department

$('body').on('submit', "#update_department", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'update_department',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.update_dpt_btn').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'list_department';

				 	    }, 3000);

				

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
  $('body').on('submit', "#update_service", function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: post_loc + 'update_our_services',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			headers: {
				'Client-Service': 'frontend-client',
				'Auth-Key': 'simplerestapi',
				'User-ID': loginid,
				'Authorization': token,
				'type': type
			},
			beforeSend: function () {
				$('.service_btn').attr("disabled", "disabled");
			},
			success: function (msg) {
				
				//console.log(msg);
				if (msg.message == "ok") {
				 	//setTimeout(function() {
				 	       location.href = base_loc + 'list_service';
				 	 //   }, 3000);
				
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
	// 	delete services

$('body').on('submit', "#delete_service", function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: post_loc + 'delete_our_services',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			headers: {
				'Client-Service': 'frontend-client',
				'Auth-Key': 'simplerestapi',
				'User-ID': loginid,
				'Authorization': token,
				'type': type
			},
			beforeSend: function () {
				$('.delete_service_btn').attr("disabled", "disabled");
			},
			success: function (msg) {
				
				//console.log(msg);
				if (msg.message == "ok") {
				 	setTimeout(function() {
				 	       location.href = base_loc + 'list_service';
				 	      //  location.href = base_loc + 'our_services';
				 	    }, 3000);
				
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
    $('body').on('submit', "#update_features", function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: post_loc + 'update_our_features',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			headers: {
				'Client-Service': 'frontend-client',
				'Auth-Key': 'simplerestapi',
				'User-ID': loginid,
				'Authorization': token,
				'type': type
			},
			beforeSend: function () {
				$('.service_btn').attr("disabled", "disabled");
			},
			success: function (msg) {
				
				//console.log(msg);
				if (msg.message == "ok") {
				 	setTimeout(function() {
				 	       location.href = base_loc + 'our_features';
				 	    }, 3000);
				
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
	// 	delete services

$('body').on('submit', "#delete_features", function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: post_loc + 'delete_our_features',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			headers: {
				'Client-Service': 'frontend-client',
				'Auth-Key': 'simplerestapi',
				'User-ID': loginid,
				'Authorization': token,
				'type': type
			},
			beforeSend: function () {
				$('.delete_service_btn').attr("disabled", "disabled");
			},
			success: function (msg) {
				
				//console.log(msg);
				if (msg.message == "ok") {
				 	setTimeout(function() {
				 	       location.href = base_loc + 'our_features';
				 	    }, 3000);
				
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
    	// 	add our featues
$('body').on('submit', "#our_features", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'our_features',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				// $('.add_documents').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'our_features';

				 	    }, 3000);

				

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
		$("#news").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'news',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
	// NOTICE BOARD
		$("#notice_board").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'notice_board',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
    // LATEST NEWS
		$("#latest_news").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'latest_news',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
    // ADMISSION NOTICE
		$("#admission_notice").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'admission_notice',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
    // INFORMATION BOARD
		$("#updateinformationboard").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'update_information_board',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
  $("#deleteinformationboard").on('submit', function (e) {

// alert('fkjdk');

		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'delete_information_board',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
  // UPDATE INFORAMTION BOARD
		$("#information_board").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'information_board',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
// ADVANCE NOTICE
		$("#advance_notice").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'advance_notice',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
	  // INFORMATION BOARD
		$("#updateadmissionnotice").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'update_admission_notice',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
  $("#deleteadmissionnotice").on('submit', function (e) {

// alert('fkjdk');

		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'delete_admission_notice',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
    // OUR BRANCHES
		$("#add_our_branches").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'our_branches',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
	$("#flash_image").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'flash_image',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
		$("#update__news").on('submit', function (e) {
			// alert();



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'update_news',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
		$("#deletenews").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'delete_news',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
  // OUR BRANCHES
  	$("#updatebranches").on('submit', function (e) {
			// alert();



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'update_branches',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
		$("#deletebranches").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'delete_branches',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
    // UPDATE LATEST NEWS
    	$("#update__latest_news").on('submit', function (e) {
			// alert();



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'update_latest_news',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
		$("#deletelatestnews").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'delete_latest_news',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
   // UPDATE ADVANCE NOTICE
    	$("#update_advance_notice").on('submit', function (e) {
			// alert();



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'update_advance_notice',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
	 // UPDATE EVENT 
    	$("#updateevent").on('submit', function (e) {
			// alert();



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'update_event',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
	// delete event
	$("#deleteevent").on('submit', function (e) {
			// alert();



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'delete_event',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
    // update exam
    	$("#updateexam").on('submit', function (e) {
			// alert();



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'update_exam',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
	// delete exam
	$("#deleteexam").on('submit', function (e) {
			// alert();



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'delete_exam',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
    // update student
     
    	$("#updatestudent").on('submit', function (e) {
			// alert();



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'update_student',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
	// delete exam
	$("#deletestudent").on('submit', function (e) {
			// alert();



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'delete_student',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
    
    // update add
    
    	$("#updateadd").on('submit', function (e) {
			// alert();



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'update_add',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
	// delete add
	$("#deleteadd").on('submit', function (e) {
			// alert();



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'delete_add',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
    // update gallery

    
    	$("#updategallery").on('submit', function (e) {
			// alert();



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'update_gallery',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
	// delete gallery
	$("#deletegallery").on('submit', function (e) {
			// alert();



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'delete_gallery',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
    

	$("#deleteadvancenotice").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'delete_advance_notice',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
  // update notice
  $("#update__notice").on('submit', function (e) {
			// alert();



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'update_notice',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
		$("#deletenotice").on('submit', function (e) {



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'delete_notice',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
	
	
	// update status
		// active/deactive branch
	$('body').on('change', '.change-admin', function () {
	var id = $(this).data('id');
		
		
		if (id != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'update_admin_status',
				data: 'checkid=' + id,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
						location.href = base_loc + 'agent_list';
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

		// active/deactive information board
	$('body').on('change', '.change-information-board', function () {
	var id = $(this).data('id');
	// alert(id);	
		
		
		if (id != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'update_information_board_status',
				data: 'checkid=' + id,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
						location.href = base_loc + 'information_board_list';
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
	$('body').on('change', '.change-admission-notice', function () {
	var id = $(this).data('id');
	// alert(id);	
		
		
		if (id != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'update_admission_notice_status',
				data: 'checkid=' + id,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
						location.href = base_loc + 'admission_notice_list';
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
// flash image
	$("#updateflashimage").on('submit', function (e) {
			// alert();



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'update_flash_image',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
	// delete flash image
	$("#deleteflashimage").on('submit', function (e) {
			// alert();



		e.preventDefault();

			$.ajax({

				type: 'POST',

				url: post_loc + 'delete_flash_image',

				data: new FormData(this),

				contentType: false,

				cache: false,

				processData: false,

				headers: {

					'Client-Service': 'frontend-client',

					'Auth-Key': 'simplerestapi',

					'User-ID': loginid,

					'Authorization': token,

					'type': type

				},

				success: function (msg) {

				console.log(msg);

				 	//setTimeout(function() {
             location.reload();

					      // location.href = base_loc + page_name;

					//}, 3000);

				

					

				},

				error: function (msg) {

					if (msg.responseJSON['status'] == 303) {

						location.href = base_loc;

					}

				}

			});

	});
	

	
	
	$('body').on('submit', "#menu", function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: post_loc + 'add_menu',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			headers: {
				'Client-Service': 'frontend-client',
				'Auth-Key': 'simplerestapi',
				'User-ID': loginid,
				'Authorization': token,
				'type': type
			},
			beforeSend: function () {
				$('.btn_menu').attr("disabled", "disabled");
			},
			success: function (msg) {
			//console.log(msg);
				if (msg.message == "ok") {
				 	// setTimeout(function() {
				 	       location.href = base_loc + 'menu';
				 	   // }, 3000);
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
	
	


	$('body').on('submit', "#add_submenu", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'add_submenu',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.btn_submenu').attr("disabled", "disabled");

			},

			success: function (msg) {

			//console.log(msg);

				if (msg.message == "ok") {

				 	// setTimeout(function() {

				 	       location.href = base_loc + 'menu';

				 	   // }, 3000);

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

$('body').on('submit', "#page_link", function (e) {

		e.preventDefault();

		$.ajax({

			type: 'POST',

			url: post_loc + 'page_link',

			data: new FormData(this),

			contentType: false,

			cache: false,

			processData: false,

			headers: {

				'Client-Service': 'frontend-client',

				'Auth-Key': 'simplerestapi',

				'User-ID': loginid,

				'Authorization': token,

				'type': type

			},

			beforeSend: function () {

				$('.btn_page').attr("disabled", "disabled");

			},

			success: function (msg) {

				

				//console.log(msg);

				if (msg.message == "ok") {

				 	setTimeout(function() {

				 	       location.href = base_loc + 'menu';

				 	    }, 3000);

				

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



/*--------------------------------------------------------------*/

$("#add_brand").on('submit', function (e) {
    
        e.preventDefault();
            $.ajax({
                type: 'POST',
                url: post_loc + 'add_brand',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                headers: {
                    'Client-Service': 'frontend-client',
                    'Auth-Key': 'simplerestapi',
                    'User-ID': loginid,
                    'Authorization': token,
                    'type': type
                },
                beforeSend: function () {
                    $('.cover').show();
                    //$(this).attr("disabled", "disabled");
                },
                success: function (msg) {
                console.log(msg);
                location.href=base_loc+ 'brands';
 
                //$('#modal_add_firm').modal('hide');
                $('.cover').hide();
                },
                error: function (msg) {
                    if (msg.responseJSON['status'] == 303) {
                        location.href = base_loc;
                    }
                }
            });

        
    });



$("#add_category").on('submit', function (e) {
    
        e.preventDefault();
            $.ajax({
                type: 'POST',
                url: post_loc + 'add_category',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                headers: {
                    'Client-Service': 'frontend-client',
                    'Auth-Key': 'simplerestapi',
                    'User-ID': loginid,
                    'Authorization': token,
                    'type': type
                },
                beforeSend: function () {
                    $('.cover').show();
                    //$(this).attr("disabled", "disabled");
                },
                success: function (msg) {
                //console.log(msg);
                location.reload();
                
 
                //$('#modal_add_firm').modal('hide');
                $('.cover').hide();
                },
                error: function (msg) {
                    if (msg.responseJSON['status'] == 303) {
                        location.href = base_loc;
                    }
                }
            });
    });


$("#add_sub_category").on('submit', function (e) {
    
        e.preventDefault();
            $.ajax({
                type: 'POST',
                url: post_loc + 'add_sub_category',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                headers: {
                    'Client-Service': 'frontend-client',
                    'Auth-Key': 'simplerestapi',
                    'User-ID': loginid,
                    'Authorization': token,
                    'type': type
                },
                beforeSend: function () {
                    $('.cover').show();
                    //$(this).attr("disabled", "disabled");
                },
                success: function (msg) {
                console.log(msg);
                location.reload();
 
                //$('#modal_add_firm').modal('hide');
                $('.cover').hide();
                },
                error: function (msg) {
                    if (msg.responseJSON['status'] == 303) {
                        location.href = base_loc;
                    }
                }
            });
    });


$("#add_product").on('submit', function (e) {
    
        e.preventDefault();
            $.ajax({
                type: 'POST',
                url: post_loc + 'add_product',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                headers: {
                    'Client-Service': 'frontend-client',
                    'Auth-Key': 'simplerestapi',
                    'User-ID': loginid,
                    'Authorization': token,
                    'type': type
                },
                beforeSend: function () {
                    $('.cover').show();
                    //$(this).attr("disabled", "disabled");
                },
                success: function (msg) {
                console.log(msg);
                
                    location.reload();
 
                $('#add_product_type').modal('hide');
                $('.cover').hide();
                },
                error: function (msg) {
                    if (msg.responseJSON['status'] == 303) {
                        location.href = base_loc;
                    }
                }
            });
    });



$('body').on('click', '.assignrole', function () {

          var check = '0';

         var role_name = $(this).attr('rolename');
         var userid = $(this).attr('roleid');
        
         if (role_name!= '' && userid!= '') {
            check = '1';
         }
         if (check == 1) {
        //alert('jj');
            //'stateid=' + $(this).val(),

            $.ajax({
                type: 'POST',
                url: post_loc + 'update_assign_role',
                data: 'userid=' + userid + '&role_name=' + role_name, 
                dataType: "json",
                headers: {
                    'Client-Service': 'frontend-client',
                    'Auth-Key': 'simplerestapi',
                    'User-ID': loginid,
                    'Authorization': token,
                    'type': type
                },
                beforeSend: function () {
                    $('.cover').show();
                    // $('.change_branch_password').attr("disabled", "disabled");
                    // $('.change_branch_password').attr("value", "Updating....");
                },
                success: function (msg) {
                console.log(msg);
                    if (msg.message == "ok") {
                        location.href = base_loc + '/master_setting/' + projecttempid;
                    } else {
                        alert('Number Exits');
                    }
                    $('.cover').hide();
                },
                error: function (msg) {
                    if (msg.responseJSON['status'] == 303) {
                        location.href = base_loc;
                    }
                }
            });
        }else{
            alert('Fill All Fields');
        }
    });

/*---------------------- end of brajesh program ------------*/
/*---------- start add banner image -----------------------*/
$("#add_banner").on('submit', function (e) {
    
        e.preventDefault();
            $.ajax({
                type: 'POST',
                url: post_loc + 'add_banner',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                headers: {
                    'Client-Service': 'frontend-client',
                    'Auth-Key': 'simplerestapi',
                    'User-ID': loginid,
                    'Authorization': token,
                    'type': type
                },
                beforeSend: function () {
                    $('.cover').show();
                    //$(this).attr("disabled", "disabled");
                },
                success: function (msg) {
                console.log(msg);
                location.reload();
 
                //$('#modal_add_firm').modal('hide');
                $('.cover').hide();
                },
                error: function (msg) {
                    if (msg.responseJSON['status'] == 303) {
                        location.href = base_loc;
                    }
                }
            });
    });

/*----------------- end  of add banner image -------------*/
    /*---------- start add coupan image -----------------------*/
    $("#add_coupan").on('submit', function (e) {
    
        e.preventDefault();
            $.ajax({
                type: 'POST',
                url: post_loc + 'add_coupan',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                headers: {
                    'Client-Service': 'frontend-client',
                    'Auth-Key': 'simplerestapi',
                    'User-ID': loginid,
                    'Authorization': token,
                    'type': type
                },
                beforeSend: function () {
                    $('.cover').show();
                    //$(this).attr("disabled", "disabled");
                },
                success: function (msg) {
                console.log(msg);
                //location.reload();
 
                //$('#modal_add_firm').modal('hide');
                $('.cover').hide();
                },
                error: function (msg) {
                    if (msg.responseJSON['status'] == 303) {
                        location.href = base_loc;
                    }
                }
            });
    });

    
    $('body').on('submit', "#add_page", function (e) {

        e.preventDefault();

        $.ajax({

            type: 'POST',

            url: post_loc + 'add_page',

            data: new FormData(this),

            contentType: false,

            cache: false,

            processData: false,

            headers: {

                'Client-Service': 'frontend-client',

                'Auth-Key': 'simplerestapi',

                'User-ID': loginid,

                'Authorization': token,

                'type': type

            },

            beforeSend: function () {

                $('.add_page').attr("disabled", "disabled");

            },

            success: function (msg) {


                            location.href = base_loc + 'page';

             

                

            },

            error: function (msg) {

                if (msg.responseJSON['status'] == 303) {

                    location.href = base_loc;

                }

            }

        });

    });


/*----------------------------------------------------------------------------*/
/*----------------- start add other services----------------------------------------------*/	
	$("#add_news_letter_services").on('submit', function (e) {
		e.preventDefault();
			$.ajax({
				type: 'POST',
				url: post_loc + 'add_news_letter_services',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				
				success: function (msg) {
				console.log(msg);
				 	
				 	
					$('#marquee_list').dataTable().fnDestroy();
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
                		//	{ "data": "MARQUEE_LINK" },
                		  	{ "data": "ACTION" },	
                		]
                	}); 

				    $('#modal_add_news_letter_services').modal('hide');
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
				}
			});
	});
	
/*----------------- end add other services -----------------------------------------------*/	



/*----------------- start news letter list ------------------------------*/
$('body').on('click', '.delete_news_letter ', function () {

	if(!confirm("Do you really want to do this?")) {
    return false;
  	}else{

		var serviceid = $(this).attr('delete_news_letter_id');
		if (serviceid != '') {
		    
			$.ajax({
				type: 'POST',
				url: post_loc + 'delete_news_letter_list',
				data: 'serviceid=' + serviceid,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				beforeSend: function () {
					$(this).attr("disabled", "disabled");
					$('.cover').show();
				},
				success: function (msg) {
					if (msg.message == "ok") {
						$(this).attr("disabled", false);
						
					     location.href = base_loc + 'add_marquee';
					
					
					} else {
						show_message('Error', msg.message, 'error');
					}
					$('.cover').hide();

				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
				}
			});
		} else {
			show_message('Error', 'Please fill all inputs', 'error');

		}
	}	
});


/*---------------- end delete news letter list ---------------------------------*/



/*----------------- start update other services----------------------------------------------*/	
	$("#update_news_letter_services").on('submit', function (e) {
		e.preventDefault();
			$.ajax({
				type: 'POST',
				url: post_loc + 'update_news_letter_services',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
				 	
				 	
					$('#marquee_list').dataTable().fnDestroy();
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

				    $('#update_news_letter_modal').modal('hide');
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
				}
			});
	});
	
/*----------------- end update other services -----------------------------------------------*/	



/*----------------- start update brand name ----------------------------------------------*/	
	$("#update_brand").on('submit', function (e) {
		e.preventDefault();
			$.ajax({
				type: 'POST',
				url: post_loc + 'update_brand',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
				 	
			 	
					$('#brand_list').dataTable().fnDestroy();
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

				    $('#edit_brand_model').modal('hide');
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
				}
			});
	});
	
/*----------------- end update brand name -----------------------------------------------*/	

/*---------------- start remove brand -----------------------------------------*/
$('body').on('click', '.remove_brand', function () {
	if(!confirm("Do you really want to do this?")) {
    return false;
  	}else{
		var linkid = $(this).attr('remove_brand_id');
		if (linkid != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'remove_brand',
				data: 'linkid=' + linkid,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				beforeSend: function () {
					$('.cover').show();
				},
				success: function (msg) {
					 location.href = base_loc + 'list_brands';
					$('.cover').hide();
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
				}
			});
		} else {
			show_message('Error', 'Please fill all inputs', 'error');
	    }
	}	
});



/*--------------------- end remove brand ------------------------------------*/


/*----------------- start update category name ----------------------------------------------*/	
	$("#update_category").on('submit', function (e) {
		e.preventDefault();
			$.ajax({
				type: 'POST',
				url: post_loc + 'update_category',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
				 	
			 	
					$('#category_list').dataTable().fnDestroy();
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

				    $('#update_category_modal').modal('hide');
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
				}
			});
	});
	
/*----------------- end update category name -----------------------------------------------*/	

/*---------------- start remove category -----------------------------------------*/
$('body').on('click', '.remove_category', function () {
	if(!confirm("Do you really want to do this?")) {
    return false;
  	}else{
		var linkid = $(this).attr('rc_id');
		if (linkid != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'remove_category',
				data: 'linkid=' + linkid,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				beforeSend: function () {
					$('.cover').show();
				},
				success: function (msg) {
					 location.href = base_loc + 'list_category';
					$('.cover').hide();
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
				}
			});
		} else {
			show_message('Error', 'Please fill all inputs', 'error');
	    }
	}	
});



/*--------------------- end remove category ------------------------------------*/












/*----------------- start update sub category name ----------------------------------------------*/	
	$("#update_sub_category").on('submit', function (e) {
		e.preventDefault();
			$.ajax({
				type: 'POST',
				url: post_loc + 'update_sub_category',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
				 	
			 	
					$('#sub_category_list').dataTable().fnDestroy();
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


				    $('#update_sub_category_modal').modal('hide');
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
				}
			});
	});
	
/*----------------- end update sub category name -----------------------------------------------*/	

/*---------------- start remove sub category -----------------------------------------*/
$('body').on('click', '.remove_sub_category', function () {
	if(!confirm("Do you really want to do this?")) {
    return false;
  	}else{
		var linkid = $(this).attr('r_sc_id');
		if (linkid != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'remove_sub_category',
				data: 'linkid=' + linkid,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				beforeSend: function () {
					$('.cover').show();
				},
				success: function (msg) {
					 location.href = base_loc + 'list_sub_category';
					$('.cover').hide();
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
				}
			});
		} else {
			show_message('Error', 'Please fill all inputs', 'error');
	    }
	}	
});



/*--------------------- end remove sub category ------------------------------------*/













/*----------------- start update product  name ----------------------------------------------*/	
	$("#update_product").on('submit', function (e) {
		e.preventDefault();
			$.ajax({
				type: 'POST',
				url: post_loc + 'update_product_list',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
				 	
			 	
					$('#product_list').dataTable().fnDestroy();
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


				    $('#edit_product_modal').modal('hide');
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
				}
			});
	});
	
/*----------------- end update product name -----------------------------------------------*/	

/*---------------- start remove product  -----------------------------------------*/
$('body').on('click', '.remove_product', function () {
	if(!confirm("Do you really want to do this?")) {
    return false;
  	}else{
		var linkid = $(this).attr('remove_product_id');
		if (linkid != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'remove_product',
				data: 'linkid=' + linkid,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				beforeSend: function () {
					$('.cover').show();
				},
				success: function (msg) {
					 location.href = base_loc + 'list_product';
					$('.cover').hide();
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
				}
			});
		} else {
			show_message('Error', 'Please fill all inputs', 'error');
	    }
	}	
});



/*--------------------- end remove product  ------------------------------------*/


/*----------------- start delete page --------------------------------------*/

$('body').on('click', '.delete_page ', function () {

	if(!confirm("Do you really want to do this?")) {
    return false;
  	}else{

		var id = $(this).attr('deletepageid');
		if (id != '') {
			$.ajax({
				type: 'POST',
				url: post_loc + 'delete_page',
				data: 'id=' + id,
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				beforeSend: function () {
					$(this).attr("disabled", "disabled");
					$('.cover').show();
				},
				success: function (msg) {
					if (msg.message == "ok") {
			            location.href = base_loc + 'page_list';
					} else {
		
					}
					$('.cover').hide();
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
				}
			});
		} else {
			show_message('Error', 'Please fill all inputs', 'error');
		}
	}	
	});





/*----------------- end of start page ----------------------------------*/







}); 




function update_fixed_menu(id){
	var menuid = id;

	$.ajax({	
		type: 'POST',
		url: post_loc + 'update_menu_status',	
		data: 'menuid=' + menuid,
		dataType: "json",
		headers: {
			'Client-Service': 'frontend-client',
			'Auth-Key': 'simplerestapi',
			'User-ID': loginid,
			'Authorization': token,
			'type': type,
		},
		beforeSend: function () {
			$('.cover').show();
			
		},
		success: function (msg) {
		console.log(msg);
			if (msg.message == "ok") {
				location.href = base_loc + 'fixed_menu';
			} else {
				location.href = base_loc + 'fixed_menu';
				//alert('Number Exits');
			}
			
			$('.cover').hide();
		},
		error: function (msg) {
			if (msg.responseJSON['status'] == 303) {
				location.href = base_loc;
			}
		}
	});
}






/*-------------------------- start update color setting ------------------------*/
function update_color(id){
	var menuid = id;
	var color_name = $('#font_'+id).val(); 

	$.ajax({	
		type: 'POST',
		url: post_loc + 'update_color',	
		data: 'id=' + menuid + '&color_name=' + color_name,
		dataType: "json",
		headers: {
			'Client-Service': 'frontend-client',
			'Auth-Key': 'simplerestapi',
			'User-ID': loginid,
			'Authorization': token,
			'type': type,
		},
		beforeSend: function () {
			$('.cover').show();
			
		},
		success: function (msg) {
		console.log(msg);
			if (msg.message == "ok") {
				location.href = base_loc + 'color_setting';
			} else {
				location.href = base_loc + 'color_setting';
				//alert('Number Exits');
			}
			
			$('.cover').hide();
		},
		error: function (msg) {
			if (msg.responseJSON['status'] == 303) {
				location.href = base_loc;
			}
		}
	});
}


function update_background_color(id){
	var menuid = id;
    var color_name = $('#color_'+id).val();
    
	$.ajax({	
		type: 'POST',
		url: post_loc + 'update_background_color',	
		data: 'id=' + menuid + '&color_name=' + color_name,
		dataType: "json",
		headers: {
			'Client-Service': 'frontend-client',
			'Auth-Key': 'simplerestapi',
			'User-ID': loginid,
			'Authorization': token,
			'type': type,
		},
		beforeSend: function () {
			$('.cover').show();
			
		},
		success: function (msg) {
		console.log(msg);
			if (msg.message == "ok") {
				location.href = base_loc + 'color_setting';
			} else {
				location.href = base_loc + 'color_setting';
				//alert('Number Exits');
			}
			
			$('.cover').hide();
		},
		error: function (msg) {
			if (msg.responseJSON['status'] == 303) {
				location.href = base_loc;
			}
		}
	});
}




function update_background_hover_color(id){
	var menuid = id;
    var color_name = $('#hover_bc_'+id).val();
    
	$.ajax({	
		type: 'POST',
		url: post_loc + 'update_background_hover_color',	
		data: 'id=' + menuid + '&color_name=' + color_name,
		dataType: "json",
		headers: {
			'Client-Service': 'frontend-client',
			'Auth-Key': 'simplerestapi',
			'User-ID': loginid,
			'Authorization': token,
			'type': type,
		},
		beforeSend: function () {
			$('.cover').show();
			
		},
		success: function (msg) {
		console.log(msg);
			if (msg.message == "ok") {
				location.href = base_loc + 'color_setting';
			} else {
				location.href = base_loc + 'color_setting';
				//alert('Number Exits');
			}
			
			$('.cover').hide();
		},
		error: function (msg) {
			if (msg.responseJSON['status'] == 303) {
				location.href = base_loc;
			}
		}
	});
}




function update_hover_color(id){
	var menuid = id;
    var color_name = $('#hover_font_'+id).val();
    
	$.ajax({	
		type: 'POST',
		url: post_loc + 'update_hover_color',	
		data: 'id=' + menuid + '&color_name=' + color_name,
		dataType: "json",
		headers: {
			'Client-Service': 'frontend-client',
			'Auth-Key': 'simplerestapi',
			'User-ID': loginid,
			'Authorization': token,
			'type': type,
		},
		beforeSend: function () {
			$('.cover').show();
			
		},
		success: function (msg) {
		console.log(msg);
			if (msg.message == "ok") {
				location.href = base_loc + 'color_setting';
			} else {
				location.href = base_loc + 'color_setting';
				//alert('Number Exits');
			}
			
			$('.cover').hide();
		},
		error: function (msg) {
			if (msg.responseJSON['status'] == 303) {
				location.href = base_loc;
			}
		}
	});
}

/*----------------------------- end update color setting ---------------------------*/

/*--------------------- start update front end setting--------------------------------------*/
function update_frontend(id){
	var menuid = id;
    var order_name = $('#front_order_'+id).val();
    
	$.ajax({	
		type: 'POST',
		url: post_loc + 'update_frontend',	
		data: 'id=' + menuid + '&order=' + order_name,
		dataType: "json",
		headers: {
			'Client-Service': 'frontend-client',
			'Auth-Key': 'simplerestapi',
			'User-ID': loginid,
			'Authorization': token,
			'type': type,
		},
		beforeSend: function () {
			$('.cover').show();
			
		},
		success: function (msg) {
		console.log(msg);
			if (msg.message == "ok") {
				location.href = base_loc + 'manage_frontent';
			} else {
				location.href = base_loc + 'manage_frontent';
				//alert('Number Exits');
			}
			
			$('.cover').hide();
		},
		error: function (msg) {
			if (msg.responseJSON['status'] == 303) {
				location.href = base_loc;
			}
		}
	});
}


function show_hide_frontend(id){
	var menuid = id;
    
    
	$.ajax({	
		type: 'POST',
		url: post_loc + 'show_hide_frontend',	
		data: 'id=' + menuid,
		dataType: "json",
		headers: {
			'Client-Service': 'frontend-client',
			'Auth-Key': 'simplerestapi',
			'User-ID': loginid,
			'Authorization': token,
			'type': type,
		},
		beforeSend: function () {
			$('.cover').show();
			
		},
		success: function (msg) {
		console.log(msg);
			if (msg.message == "ok") {
				location.href = base_loc + 'manage_frontent';
			} else {
				location.href = base_loc + 'manage_frontent';
				//alert('Number Exits');
			}
			
			$('.cover').hide();
		},
		error: function (msg) {
			if (msg.responseJSON['status'] == 303) {
				location.href = base_loc;
			}
		}
	});
}


/*------------------------- end update front end setting ----------------------------------------*/


/*--------------------- start update back end setting--------------------------------------*/
function update_back_end(id){
	var menuid = id;
    var menu_name = $('#back_end_name_'+id).val();
    
	$.ajax({	
		type: 'POST',
		url: post_loc + 'update_back_end',	
		data: 'id=' + menuid + '&name=' + menu_name,
		dataType: "json",
		headers: {
			'Client-Service': 'frontend-client',
			'Auth-Key': 'simplerestapi',
			'User-ID': loginid,
			'Authorization': token,
			'type': type,
		},
		beforeSend: function () {
			$('.cover').show();
			
		},
		success: function (msg) {
		console.log(msg);
			if (msg.message == "ok") {
				location.href = base_loc + 'manage_backend';
			} else {
				location.href = base_loc + 'manage_backend';
				//alert('Number Exits');
			}
			
			$('.cover').hide();
		},
		error: function (msg) {
			if (msg.responseJSON['status'] == 303) {
				location.href = base_loc;
			}
		}
	});
}


function update_back_end_order(id){
	var menuid = id;
    var menu_name = $('#back_end_order_'+id).val();
    
	$.ajax({	
		type: 'POST',
		url: post_loc + 'update_back_end_order',	
		data: 'id=' + menuid + '&order=' + menu_name,
		dataType: "json",
		headers: {
			'Client-Service': 'frontend-client',
			'Auth-Key': 'simplerestapi',
			'User-ID': loginid,
			'Authorization': token,
			'type': type,
		},
		beforeSend: function () {
			$('.cover').show();
			
		},
		success: function (msg) {
		console.log(msg);
			if (msg.message == "ok") {
				location.href = base_loc + 'manage_backend';
			} else {
				location.href = base_loc + 'manage_backend';
				//alert('Number Exits');
			}
			
			$('.cover').hide();
		},
		error: function (msg) {
			if (msg.responseJSON['status'] == 303) {
				location.href = base_loc;
			}
		}
	});
}




function show_hide_back_end(id){
	var menuid = id;
   
    
	$.ajax({	
		type: 'POST',
		url: post_loc + 'update_back_end_status',	
		data: 'id=' + menuid,
		dataType: "json",
		headers: {
			'Client-Service': 'frontend-client',
			'Auth-Key': 'simplerestapi',
			'User-ID': loginid,
			'Authorization': token,
			'type': type,
		},
		beforeSend: function () {
			$('.cover').show();
			
		},
		success: function (msg) {
		console.log(msg);
			if (msg.message == "ok") {
				location.href = base_loc + 'manage_backend';
			} else {
				location.href = base_loc + 'manage_backend';
				//alert('Number Exits');
			}
			
			$('.cover').hide();
		},
		error: function (msg) {
			if (msg.responseJSON['status'] == 303) {
				location.href = base_loc;
			}
		}
	});
}


/*------------------ start  update menu name ---------------------------------------------*/
function update_menu_name(id){
	var menuid = id;
    var menu_name = $('#update_menu_'+id).val();
	$.ajax({	
		type: 'POST',
		url: post_loc + 'update_menu_name',	
		data: 'id=' + menuid + '&name=' + menu_name,
		//data: 'menuid=' + menuid,
		dataType: "json",
		headers: {
			'Client-Service': 'frontend-client',
			'Auth-Key': 'simplerestapi',
			'User-ID': loginid,
			'Authorization': token,
			'type': type,
		},
		beforeSend: function () {
			$('.cover').show();
			
		},
		success: function (msg) {
		console.log(msg);
			if (msg.message == "ok") {
				location.href = base_loc + 'list_menu';
			} else {
				location.href = base_loc + 'list_menu';
				//alert('Number Exits');
			}
			
			$('.cover').hide();
		},
		error: function (msg) {
			if (msg.responseJSON['status'] == 303) {
				location.href = base_loc;
			}
		}
	});
}



function update_menu_order(id){
	var menuid = id;
    var menu_name = $('#update_menu_order_'+id).val();
	$.ajax({	
		type: 'POST',
		url: post_loc + 'update_menu_order',	
		data: 'id=' + menuid + '&order=' + menu_name,
		//data: 'menuid=' + menuid,
		dataType: "json",
		headers: {
			'Client-Service': 'frontend-client',
			'Auth-Key': 'simplerestapi',
			'User-ID': loginid,
			'Authorization': token,
			'type': type,
		},
		beforeSend: function () {
			$('.cover').show();
			
		},
		success: function (msg) {
		console.log(msg);
			if (msg.message == "ok") {
				location.href = base_loc + 'list_menu';
			} else {
				location.href = base_loc + 'list_menu';
				//alert('Number Exits');
			}
			
			$('.cover').hide();
		},
		error: function (msg) {
			if (msg.responseJSON['status'] == 303) {
				location.href = base_loc;
			}
		}
	});
}


function update_menu_status(id){
	var menuid = id;

	$.ajax({	
		type: 'POST',
		url: post_loc + 'update_menu_backend_status',	
		data: 'menuid=' + menuid,
		dataType: "json",
		headers: {
			'Client-Service': 'frontend-client',
			'Auth-Key': 'simplerestapi',
			'User-ID': loginid,
			'Authorization': token,
			'type': type,
		},
		beforeSend: function () {
			$('.cover').show();
			
		},
		success: function (msg) {
		console.log(msg);
			if (msg.message == "ok") {
				location.href = base_loc + 'list_menu';
			} else {
				location.href = base_loc + 'list_menu';
				//alert('Number Exits');
			}
			
			$('.cover').hide();
		},
		error: function (msg) {
			if (msg.responseJSON['status'] == 303) {
				location.href = base_loc;
			}
		}
	});
}



/*-------------------- end update menu name --------------------------------------------*/


/*------------------ start  update sub menu name ---------------------------------------------*/
function update_sub_menu_name(id){
	var menuid = id;
    var menu_name = $('#update_sub_menu_name_'+id).val();
	$.ajax({	
		type: 'POST',
		url: post_loc + 'update_sub_menu_name',	
		data: 'id=' + menuid + '&name=' + menu_name,
		//data: 'menuid=' + menuid,
		dataType: "json",
		headers: {
			'Client-Service': 'frontend-client',
			'Auth-Key': 'simplerestapi',
			'User-ID': loginid,
			'Authorization': token,
			'type': type,
		},
		beforeSend: function () {
			$('.cover').show();
			
		},
		success: function (msg) {
		console.log(msg);
			if (msg.message == "ok") {
				location.href = base_loc + 'list_sub_menu';
			} else {
				location.href = base_loc + 'list_sub_menu';
				//alert('Number Exits');
			}
			
			$('.cover').hide();
		},
		error: function (msg) {
			if (msg.responseJSON['status'] == 303) {
				location.href = base_loc;
			}
		}
	});
}



function update_sub_menu_order(id){
	var menuid = id;
    var menu_name = $('#update_sub_menu_order_'+id).val();
	$.ajax({	
		type: 'POST',
		url: post_loc + 'update_menu_order',	
		data: 'id=' + menuid + '&order=' + menu_name,
		//data: 'menuid=' + menuid,
		dataType: "json",
		headers: {
			'Client-Service': 'frontend-client',
			'Auth-Key': 'simplerestapi',
			'User-ID': loginid,
			'Authorization': token,
			'type': type,
		},
		beforeSend: function () {
			$('.cover').show();
			
		},
		success: function (msg) {
		console.log(msg);
			if (msg.message == "ok") {
				location.href = base_loc + 'list_sub_menu';
			} else {
				location.href = base_loc + 'list_sub_menu';
				//alert('Number Exits');
			}
			
			$('.cover').hide();
		},
		error: function (msg) {
			if (msg.responseJSON['status'] == 303) {
				location.href = base_loc;
			}
		}
	});
}


function update_sub_menu_status(id){
	var menuid = id;

	$.ajax({	
		type: 'POST',
		url: post_loc + 'update_sub_menu_status',	
		data: 'id=' + menuid,
		dataType: "json",
		headers: {
			'Client-Service': 'frontend-client',
			'Auth-Key': 'simplerestapi',
			'User-ID': loginid,
			'Authorization': token,
			'type': type,
		},
		beforeSend: function () {
			$('.cover').show();
			
		},
		success: function (msg) {
		console.log(msg);
			if (msg.message == "ok") {
				location.href = base_loc + 'list_sub_menu';
			} else {
				location.href = base_loc + 'list_sub_menu';
				//alert('Number Exits');
			}
			
			$('.cover').hide();
		},
		error: function (msg) {
			if (msg.responseJSON['status'] == 303) {
				location.href = base_loc;
			}
		}
	});
}



/*-------------------- end update sub menu name --------------------------------------------*/





 var post_url = 'https://cssupgov.org/';
// //Ajax.php
// function center_login(){
//   // alert('ok');
// 	var username = 'newhope';
//     var password = 'Burdwan@2020';
//     var Check_Login = 'Check_Login';
//     $.ajax({	
// 		type: 'POST',
// 		//var url = 'https://marksheet.doctoroncalls.in/admin/';
// 		url: post_url + 'Ajax2.php',	


// 				processData: false,
// 		data: 'status=' + Check_Login + '&username=' + username + '&password=' + password,
//         // data: {
//         //     status: 'Check_Logn', 
//         //     username: username,
//         //     password: password,
//         // },
// 		dataType: "json",
// // 		cors: true ,
//           contentType:'application/json',
//         //   secure: true,
//           headers: {
//             // 'Access-Control-Allow-Origin': '*',
        
// //             'Access-Control-Allow-Headers': '*',
// // 'Access-Control-Allow-Methods': 'GET, POST, OPTIONS, PUT, DELETE', 
//           },
// 		beforeSend: function () {
// 			$('.cover').show();
			
// 		},
// 		success: function (msg) {
// 		console.log(msg);
// 			if (msg.message == "ok") {
// 				location.href = post_url;
// 			} else {
// 			//	location.href = base_loc + 'list_sub_menu';
// 				//alert('Number Exits');
// 			}
			
// 			$('.cover').hide();
// 		},
// 		error: function (msg) {
// 			if (msg.responseJSON['status'] == 303) {
// 				location.href = base_loc;
// 			}
// 		}
// 	});
// }
function center_login(){

	var username = 'admin';
    var password = 'admin';
    var Check_Login = 'Check_Login';
	$.ajax({	
		type: 'POST',
		url: 'https://cssupgov.org/test/admin/Ajax2.php',	
		data: 'status=' + Check_Login + '&username=' + username + '&password=' + password,
		dataType: "json",
	
		beforeSend: function () {
			$('.cover').show();
			
		},
		success: function (msg) {
		console.log(msg);
			if (msg == "1") {
				 location.href = post_url + 'test/admin';
			} else {
				// location.href = base_loc + 'list_sub_menu';
				//alert('Number Exits');
			}
			
			$('.cover').hide();
		},
		error: function (msg) {
			if (msg.responseJSON['status'] == 303) {
				// location.href = base_loc;
			
			    
			}
			console.log(msg);
			
		}
	});
}





function update_link_status(id){
	var menuid = id;
    var menu_link = $('#menu_link_status_'+id).val();
	$.ajax({	
		type: 'POST',
		url: post_loc + 'update_link_status',	
		data: 'id=' + menuid + '&link=' + menu_link,
		//data: 'menuid=' + menuid,
		dataType: "json",
		headers: {
			'Client-Service': 'frontend-client',
			'Auth-Key': 'simplerestapi',
			'User-ID': loginid,
			'Authorization': token,
			'type': type,
		},
		beforeSend: function () {
			$('.cover').show();
			
		},
		success: function (msg) {
		console.log(msg);
			if (msg.message == "ok") {
				location.href = base_loc + 'list_menu';
			} else {
				location.href = base_loc + 'list_menu';
				//alert('Number Exits');
			}
			
			$('.cover').hide();
		},
		error: function (msg) {
			if (msg.responseJSON['status'] == 303) {
				location.href = base_loc;
			}
		}
	});
}


function update_sub_menu_link_status(id){
	var menuid = id;
    var menu_link = $('#sub_menu_link_status_'+id).val();
	$.ajax({	
		type: 'POST',
		url: post_loc + 'update_link_status',	
		data: 'id=' + menuid + '&link=' + menu_link,
		//data: 'menuid=' + menuid,
		dataType: "json",
		headers: {
			'Client-Service': 'frontend-client',
			'Auth-Key': 'simplerestapi',
			'User-ID': loginid,
			'Authorization': token,
			'type': type,
		},
		beforeSend: function () {
			$('.cover').show();
			
		},
		success: function (msg) {
		console.log(msg);
			if (msg.message == "ok") {
				location.href = base_loc + 'list_sub_menu';
			} else {
				location.href = base_loc + 'list_sub_menu';
				//alert('Number Exits');
			}
			
			$('.cover').hide();
		},
		error: function (msg) {
			if (msg.responseJSON['status'] == 303) {
				location.href = base_loc;
			}
		}
	});
}






