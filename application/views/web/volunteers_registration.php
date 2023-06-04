
<?

define('RAZOR_KEY_ID','rzp_live_VOGpAfzDbcQjUE');
define('RAZOR_KEY', 'sW2uSyiFutTd1G7vmOwt0IGc');



$txnid = time();
$surl = site_url().'razorpay/success';
$furl = site_url().'razorpay/failer';        
$key_id = RAZOR_KEY_ID;
$currency_code = 'INR';
$card_holder_name = 'Pankaj';
$email = 'pankajkumar01.330@gmail.com';
$phone = '6397650818';
$name = 'Bizknowindia';
$return_url = site_url().'razorpay/callback';

?>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>


<section>
<?php

if($this->uri->segment(2)!= ''){
 ?>
<div class="col-md-12" style="padding-left:8%;">
    <a id="cmd" href="javascript:void(0);" onclick="CreatePDFfromHTML()" class="btn btn-primary"> Downloads</a>
</div>
 <?php 
}

?>

      <div class="container" >

        <div class="section-content">

          <div class="row">

            <div class="col-md-12">

<?php

if($this->uri->segment(2)!= ''){
    
   $num = $this->db->get_where('payment_transaction',['MEMBER_REG_CODE'=>$this->uri->segment(2)])->num_rows();
   if($num  > 0){
       
        $member = $this->db->get_where('member_list',['MEMBER_CODE'=>$this->uri->segment(2)])->row();
        $district = $this->db->get_where('district',['DISTRICT_ID'=>$member->MEMBER_DISTRICT])->row('DISTRICT_NAME');
        $state = $this->db->get_where('state',['STATE_ID'=> $member->MEMBER_STATE])->row('STATE_NAME');
       
       
   ?>
   <center>
    <div class="col-md-6 sm-text-center mt-40" id="content">


              <img id="background_image" src="<?php echo base_url(); ?>/webpages/membership_card.jpeg" alt="">
            <!------------------------------------------------------------------->
            
        <style>
        #main_div_css{
            margin-top:-403px;
          }
        #main_div_sub_child_css{
          margin-left:-30px;
        } 
         #id_image{
                height:100px;
                width:100px;
                border: 1px solid black;border-radius: 5px;
            }
        @media only screen and (max-width: 600px) {
          #main_div_css{
            padding-left:0px;padding-right:0px;margin-top:-350px;text-align:left;
          }
          #child_div_css{
            padding-left:0px;padding-right:0px;margin-right: -10px;margin-left:-30px;
          }
          #main_div_sub_child_css{
          margin-left:0px;
        }
            #id_image{
                height:100px;
                width:100px;
                border: 1px solid black;border-radius: 5px;
                margin-top: -60px;
            }
             #background_image{
                height:650px;
              
            }
            
            
        }
        
        </style>
        <!---
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <div class="col-md-12" style="padding-left:8%;">
         
            <a id="cmd" href="javascript:void(0);" onclick="CreatePDFfromHTML()" class="btn btn-primary"> Download</a>
          
          </div>
        --->


        <div class="col-xs-12 col-md-12" id="main_div_css" >
            <center>
            <div class="col-xs-12 col-md-12" style="padding-left:0px;padding-right:0px;">
                <div class="col-xs-12 col-md-12" style="padding-left:0px;padding-right:0px;">
                  <img  id="id_image" src="<?php echo base_url('uploads/'.$member->MEMBER_PHOTO.''); ?>" >
                </div>
            </div>
            </center>
            <div class="col-xs-12 col-md-12" id="id="main_div_sub_child_css""  >
                <table style="font-weight:900;">
                    <tr ><td> ID        </td><td>  : &nbsp;&nbsp;&nbsp; ICA<?php echo $this->uri->segment(2); ?>   </td></tr>
                    <tr><td>नाम      </td><td> : &nbsp;&nbsp;&nbsp;  <?php echo $member->MEMBER_NAME; ?>     </td></tr>
                    <tr><td style="vertical-align:top"> पता       </td><td style="overflow: hidden;"> : &nbsp;&nbsp;&nbsp;  <?php echo $member->MEMBER_ADDRESS; ?>     </td></tr>
                    <tr><td>जन्मदिन    </td><td> : &nbsp;&nbsp;&nbsp;  <?php echo $member->MEMBER_DOB; ?>     </td></tr>
                    <tr><td> शहर      </td><td> : &nbsp;&nbsp;&nbsp;  <?php echo  $member->MEMBER_CITY; ?>     </td></tr>
                    <tr><td> जिला      </td><td> : &nbsp;&nbsp;&nbsp;  <?php echo $district; ?>     </td></tr>
                    <tr><td> राज्य      </td><td>: &nbsp;&nbsp;&nbsp;  <?php echo $state; ?>     </td></tr>
                    <tr><td> मो        </td><td> : &nbsp;&nbsp;&nbsp;  <?php echo $member->MEMBER_PHONE; ?>     </td></tr>
                </table>
            </div>
        </div>
        <div class="col-md-12" style="margin-top:-299px;">
            <div class="col-sm-6 col-xs-6">
            </div>
          <!-- Job Form Validation-->
        </div>
            <!------------------------------------------------------------------->
    </div>
   
   </center>
   <?php
   }else{
       $member = $this->db->get_where('member_list',['MEMBER_CODE'=>$this->uri->segment(2)])->row();
    ?>


        <h3 class="bg-theme-colored p-15 pl-30 mb-0 text-white text-center"> Dear Member 
         <br>
         Thanks For Registration. <br>
         Your Name  =<?php echo @$member->MEMBER_NAME; ?><br>
         Your  Registration Id = ICA<?php echo $this->uri->segment(2); ?>
         <br>
         <i class="fa fa-inr btn btn-primary " > Click To Generate Id Card </i>
         </h3>
        
        
        
        <form  name="razorpay_form" id="razorpay_form" action="<?php echo $return_url; ?>" method="POST" class="bg-light p-30 pb-15"  >
                
              <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id1" />
              <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo time(); ?>"/>
              <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
              <input type="hidden" name="merchant_plan_id" id="merchant_plan_id" value="1"/>
              <input type="hidden" name="phone" value="<?php echo @$member->MEMBER_PHONE; ?>">
              <input type="hidden" name="email" value="<?php echo @$member->MEMBER_EMAIL; ?>">
              
              <input type="hidden" name="uid" id="uid" value="<?php echo @$this->uri->segment(2); ?>"/>    
              <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="Basic Plan, 100 / per month"/>
              <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
              <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
              <input type="hidden" name="card_holder_name_id"  value="pankaj kumar"/>
              <input type="hidden" name="card_holder_emailid_id"  value="provisioningtech@gmaill.com"/>
              <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo 10*100; ?>"/>
              <input type="hidden" name="merchant_amount" id="merchant_amount" value="1"/>
              
                    <button type="button" onclick="razorpaySubmit(this)" class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10" data-loading-text="Please wait...">
                      Pay Now [ <i class="fa fa-inr"></i>10]
                    </button>
                    
              
              </form>    
   
   
   
   
   
  
   
    <?php
   } 
    
?>

<?php
}else{
 ?>   
    


              <h3 class="bg-theme-colored p-15 pl-30 mb-0 text-white">Member Registration</h3>

              <form  name="razorpay_form" id="razorpay_form2" action="<?php echo $return_url; ?>" method="POST" class="bg-light p-30 pb-15"  enctype="multipart/form-data" >
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="form_name">Name <small>*</small></label>
                      <input id="form_name" name="name" type="text" placeholder="Enter Name" required="" class="form-control" aria-required="true" required="required">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="form_email">Email <small>*</small></label>
                      <input id="merchchant_email_id" name="email" class="form-control  email" type="email" placeholder="Enter Email" aria-required="true" required="required">
                    </div>
                  </div>
                </div>
                <div class="row">               
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="form_email">Phone <small>*</small></label>
                      <input id="form_phone" name="phone" class="form-control required" type="number" maxlength="10"  placeholder="Enter Phone" aria-required="true" required="required">
                    </div>
                 </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="form_message">State <small>*</small></label>
                      <select class="form-control" name="state" id="state" class="form-control state" required>
                      <?php
                      $state = get_all_states();
                      foreach($state as $state_list){
                        echo'<option value="'.$state_list->STATE_ID.'">'.$state_list->STATE_NAME.'</option>';
                      }
                      ?>
                      </select>
				   
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="form_message">District <small>*</small></label>
                    <select name="district" class="form-control" id="disctrict" required>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="form_message">City <small>*</small></label>
                    <input  name="city" class="form-control" type="text" placeholder="Enter City" aria-required="true" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="form_message">D.O.B (M-D-Y) <small>*</small></label>
                    <input  name="date" class="form-control" type="date" placeholder="Enter City" aria-required="true" value="<?php echo date('Y-m-d'); ?>" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="form_message">Address <small>*</small></label>
                    <textarea class="form-control " name="address" placeholder="ENTER ADDRESS" required></textarea>
                  </div>
                </div>
                <!--
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="form_attachment"> NEED Id Card *</label>
                            <select name="need_id_card" onchange="myFunction(this.value)" class="form-control">
                              <option value="1"> No </option>
                              <option value="0"> Yes </option>
                              
                            </select>
                    </div>
                </div>
                
                --->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="form_attachment">Upload Image</label>
                            <input id="form_image" name="image" class="file" type="file" >
                    </div>
                </div>
                
              </div>
              <!---
              <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id1" />
              <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo time(); ?>"/>
              <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
              <input type="hidden" name="merchant_plan_id" id="merchant_plan_id" value="1"/>
            
              <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="Basic Plan, 100 / per month"/>
              <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
              <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
              <input type="hidden" name="card_holder_name_id"  value="pankaj kumar"/>
              <input type="hidden" name="card_holder_emailid_id"  value="provisioningtech@gmaill.com"/>
              <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo 1*100; ?>"/>
              <input type="hidden" name="merchant_amount" id="merchant_amount" value="1"/>
              
              <div class="form-group" id="make_payment" style="visibility:hidden;display:none;">
                  <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value="">
                    <button type="button" onclick="pay_now()" class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10" data-loading-text="Please wait...">
                      Pay Now [ <i class="fa fa-inr"></i>100]
                    </button>
                    <button type="button" onclick="razorpaySubmit(this)" class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10" data-loading-text="Please wait...">
                      Pay Now [ <i class="fa fa-inr"></i>100]
                    </button>
                    
              </div>
              --->
              <div class="form-group" id="make_no_payment" >
                  <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value="">
                  <button type="submit"  class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10" data-loading-text="Please wait...">Apply Now</button>
              </div>
              <!--
              <button type="button" onclick="razorpaySubmit(this)" class="btn btn-success text-uppercase"><i class="fa fa-inr"></i> Make Payment </button>
              -->
              </form>

              <!-- Job Form Validation-->

    <?php
}
?>          

            </div>
<!---
            <div class="col-md-6 sm-text-center mt-40">
              <img class="hidden-sm hidden-xs" src="https://sakhaesociety.org/webpages/images/photos/v1.png" alt="">
            </div>
--->
          </div>
        </div>

      </div>

    </section>
<script>
function myFunction(id){
  if (id==0) {
		$('#make_payment').css('display','block');
		$('#make_payment').css('visibility','visible');


		$('#make_no_payment').css('display','none');
		$('#make_no_payment').css('visibility','hidden');
	}else{
		$('#make_payment').css('display','none');
		$('#make_payment').css('visibility','hidden');

    $('#make_no_payment').css('display','block');
		$('#make_no_payment').css('visibility','visible');


		
	}
}

</script>


 <script>
$(document).ready(function () {
    $('body').on('change', '#state', function () {

		$(this).closest('.row').find('.city option').remove();
		var d = $('#state').val();
			$.ajax({
				type: 'POST',
				url: get_loc + 'get_district',
				data: 'stateid=' + d,
				dataType: "json",
				success: function (msg) {
				console.log(msg);
					var str = '';
                    $('#disctrict option').remove();
					str += "<option value='0'>--Select District--</option>";
					$.each(msg, function (index, element) {
						str += "<option value='" + element.DISTRICT_ID + "'>" + element.DISTRICT_NAME + "</option>";
					});
					$('#disctrict').append(str);
            d.closest('.row').find('.city').append(str);
				},
			});

		

	});



});




$("#razorpay_form2").on('submit', function (e) {
		e.preventDefault();
			$.ajax({
				type: 'POST',
				url: payment + '/callback2',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				
				success: function (msg) {
				console.log(msg);

					    location.href = 'member-registration/' + msg;

				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = volunteer_loc + 'voulenteer-registration';
					}
				}
			});
	});


 </script>


                    




<script>
    // var name: $("#form_name").val();
    //  var email = $("#merchchant_email_id").val();
    //  var contact = $("#form_phone").val(); 

  //  var  name = $("#form_name").val();
     var   email_id =  $("#merchchant_email_id").val();
     var contact_no = $("#form_phone").val();

  var x = 'pankajkumar01.330@gmail.com';


function razorpaySubmit() {
   
    var  name = $("#form_name").val();
     var   email_id =  $("#merchchant_email_id").val();
    var contact_no = $("#form_phone").val();
    
    var x = email_id;
    
    if(typeof Razorpay == 'undefined'){
      setTimeout(razorpaySubmit, 200);
      if(!razorpay_submit_btn && el){
        razorpay_submit_btn = el;
        el.disabled = true;
        el.value = 'Please wait...';  
        
        alert('1');
      }
    } else {
      if(!razorpay_instance){
        razorpay_instance = new Razorpay(razorpay_options);
        if(razorpay_submit_btn){
          razorpay_submit_btn.disabled = false;
          razorpay_submit_btn.value = "Pay Now";
          
          
          alert('2');
          
         
          
          
          
          
          
          ////////////////////////////////////////////////////////////////////////////////////////////////////
          
          
        }
    }
      razorpay_instance.open();
    }
 // var razorpay_form = document.forms.razorpay_form;
  //razorpay_form.submit();
  
 
 
 
 ////////////////////////////////////////////////////////////////////////////////////////////////////
}


////////////////////////////////////////////////////////////////////////////////////////////////////
 
        var razorpay_options = {
            key: "<?php echo $key_id; ?>",
            amount: $("#merchant_total").val(),
            name: $("#form_name").val(),
            email_id: $("#merchchant_email_id").val(),
            description: "Order # <?php echo time(); ?>",
            netbanking: true,
            currency: "<?php echo $currency_code; ?>",
            prefill: {
              name:'<?php echo @$member->MEMBER_NAME; ?>',
              email: '<?php echo @$member->MEMBER_EMAIL; ?>',
              contact: '<?php echo @$member->MEMBER_PHONE; ?>',
            },
            notes: {
              soolegal_order_id: "<?php echo time(); ?>",
            },
            handler: function (transaction) {
           // alert(transaction.razorpay_payment_id);
            //alert(transaction.razorpay_order_id);
            //alert(transaction.razorpay_signature)
            //cosole.log(transaction);
            
            
                document.getElementById('razorpay_payment_id1').value = transaction.razorpay_payment_id;
               // document.getElementById('razorpay_form').submit();
                document.getElementById("razorpay_form").submit();
            },
            "modal": {
                "ondismiss": function(){
                    location.reload()
                }
            }
          };
      

 var razorpay_submit_btn, razorpay_instance;

 ////////////////////////////////////////////////////////////////////////////////////////
          
          



</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<!--
<script src="<?php echo base_url(); ?>assets/theme_assets/js/jquery-3.2.1.min.js"></script>
-->
<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<script type="text/javascript">
function CreatePDFfromHTML() {
    var HTML_Width = 720;
    
    var HTML_Height = 840;
    // alert([HTML_Width,HTML_Height]);
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($("#content")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        pdf.save("preview.pdf");
        // $("#content").hide();
    });
}
</script>
<!---
<form>
          <div class="form-group">
            <label for="">Name:</label>
            <input type="text"  class="form-control" placeholder="Enter Name" name="name" id="name" >
          </div>
          <div class="form-group">
            <label for="">Email address:</label>
            <input type="email" class="form-control"  placeholder="Enter email" name="email" id="email">
          </div>
          <div class="form-group">
            <label for="">Mobile Number:</label>
            <input type="text"  class="form-control" placeholder="Enter Mobile No."  name="mobile" id="phone">
          </div>
    
          
          <div class="form-group">
            <label for="">Amount</label>
            <input type="text" class="form-control"  placeholder="Enter Amount" value="<?php echo 100;?>" id="amt" name="amt" readonly>
          </div>
          <button type="button" name="btn" id="btn" onclick="pay_now()" class="btn btn-primary w-100">Pay Now</button>
      </form>

--->


<script>
    function pay_now(){
        var name='<?php echo @$member->MEMBER_NAME; ?>';
        var amt=jQuery('#merchant_amount').val();
        var email = '<?php echo @$member->MEMBER_EMAIL; ?>';
        var contact = '<?php echo @$member->MEMBER_PHONE; ?>'; 
        var uid = '<?php echo @$this->uri->segment(2); ?>';
       
         jQuery.ajax({
               type:'post',
               	url: payment + '/callback',
                data: $('#razorpay_form').serialize(),
               data:"amt="+amt+"&name="+name+"&email="+email+"&contact="+contact + "&uid="+uid,
               success:function(result){
                   var options = {
                        "key": "<?php echo $key_id; ?>", 
                        "amount": "<?php echo (10*100);?>", 
                        "currency": "INR",
                        "name": name,
                        "description": "Order # <?php echo time(); ?>",
                        "image": "https://bizknowindia.in.net/public/uploads/seller/60ab8f461ee0c.jpg",
                        "handler": function (response){
                            console.log(response);
                           jQuery.ajax({
                               type:'post',
                               url: payment + '/callback',
                               data:"razorpay_payment_id="+response.razorpay_payment_id,
                              success:function(result){
                                   console.log(result)
                                   window.location.href="volunteer-registration/" + result;
                                }
                           });
                        },
                        "prefill":{
                            "email": email,
                            "contact": contact

                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.on('payment.failed', function (response){
    
                    console.log(response.error)
})
                    rzp1.open();
               }
           });
        
        
    }
</script>
   




