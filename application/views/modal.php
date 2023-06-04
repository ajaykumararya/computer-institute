<!--update exam details-->
<div class="modal fade" id="update_exam_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>

      </div>

      <form class="form-horizontal tasi-form" id="update_exam">

        <input type="hidden" name="updateexamid" class="updateexamid">
        <input type="hidden" name="studentid" class="studentid">

        <div class="modal-body">

       
         <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">Exam date</label>

               <div class="col-lg-6">

                <select name="exam_date">
                    <option>select date</option>
                    <?php
                        foreach($exam as $row){
                    ?>
                    <option value="<?php echo $row->id;?>"> <?php echo $row->exam_date;?></option>
                    <?php
                        }
                    ?>
                </select> 

               </div>

         </div>
        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary update_slider">Save </button>

        </div>

      </form>

    </div>

  </div>

</div> 

<!-- delete exam modal -->
<div class="modal fade" id="delete_exam_date" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>
    <form class="form-horizontal tasi-form" id="delete_exam">

      <div class="modal-body">
        <input type="hidden" name="deleteexamid" class="deleteexamid">
        <div class="container">
            <h1 class="text-danger">Delete Detail !</h1>
            <p>Are you sure you want to delete your Details?</p>
           </div> 
               
        
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger delete_slider_btn">delete </button>
      </div>
    </form>
    </div>
  </div>
</div>
<!-- update slider details -->

<div class="modal fade" id="update_slider_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>

      </div>

      <form class="form-horizontal tasi-form" id="update_slider_details">

        <input type="hidden" name="updatesliderid" class="updatesliderid">

        <div class="modal-body">

       
         <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">TITLE</label>

               <div class="col-lg-6">

                 <input type="text" name="slider_title" class="form-control  slider_title" placeholder="TITLE" required="">

               </div>

         </div>
         <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">DESCRIPTION </label>

               <div class="col-lg-6">

                 <input type="text" name="slider_desc1" class="form-control  slider_desc1" placeholder="ENTER DESCRIPTION1" required="">

               </div>

         </div>


         <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">SLIDER IMAGE</label>

               <div class="col-lg-6">

                 <input type="file" name="slider_image" class="form-control" placeholder="VOLUNTEER PHOTO" >

               </div>

         </div>

        



        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary update_slider">Save </button>

        </div>

      </form>

    </div>

  </div>

</div> 
<!-- end update blog request -->
<!-- delete slider modal -->
<div class="modal fade" id="delete_slider_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>
    <form class="form-horizontal tasi-form" id="delete_slider_details">

      <div class="modal-body">
        <input type="hidden" name="sliderdeleteid" class="sliderdeleteid">
        <div class="container">
            <h1 class="text-danger">Delete Detail !</h1>
            <p>Are you sure you want to delete your Details?</p>
           </div> 
               
        
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger delete_slider_btn">delete </button>
      </div>
    </form>
    </div>
  </div>
</div>
<div class="modal fade" id="update_service" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>

      </div>

      <form class="form-horizontal tasi-form" id="update_service">

        <input type="hidden" name="service_id" class="service_id">

        <div class="modal-body">

          <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> TITLE</label>

               <div class="col-lg-6">

                 <input type="text" name="servicetitle" class="form-control servicetitle" placeholder="SERVICE TITLE..." >

               </div>
          </div>
          

          <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> SERVICE DESCRIPTION</label>

               <div class="col-lg-6">

                  <textarea name="service_dec" class="form-control service_dec" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>

     
       <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> SERVICE IMAGE</label>

               <div class="col-lg-6">

                  <input type="file" name="image" class="form-control image" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>

      </div>
	   </div>

      <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary service_btn">Save </button>

      </div>

      </form>

    </div>

  </div>
  <div class="modal fade" id="delete_service" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>
    <form class="form-horizontal tasi-form" id="delete_service">

      <div class="modal-body">
        <input type="hidden" name="delete_service_id" class="delete_service_id">
        <div class="container">
            <h1 class="text-danger">Delete Detail !</h1>
            <p>Are you sure you want to delete your Details?</p>
           </div> 
               
        
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger delete_service_btn">delete </button>
      </div>
    </form>
    </div>
  </div>
</div>
<div class="modal fade" id="update_news" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>

      </div>

      <form class="form-horizontal tasi-form" id="update__news">

        <input type="hidden" name="updatenewsid" class="updatenewsid">

        <div class="modal-body">

          <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> TITLE</label>

               <div class="col-lg-6">

                 <input type="text" name="news_title" class="form-control news_title" placeholder="NEWS TITLE..." >

               </div>
          </div>
          

          <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> NEWS DESCRIPTION</label>

               <div class="col-lg-6">

                  <textarea name="news_desc" class="form-control news_desc" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>
		     <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> NEWS DATE</label>

               <div class="col-lg-6">

                  <input type="date" name="news_date" class="form-control news_date" placeholder=" ENTER  DESCRIPTION...."></textarea>
                 

               </div>

           </div>

     
       <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  IMAGE</label>

               <div class="col-lg-6">

                  <input type="file" name="image" class="form-control image" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>

      </div>
	   </div>

      <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary update_news_btn">Save </button>

      </div>

      </form>

    </div>

  </div>
  <div class="modal fade" id="delete_news" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>
    <form class="form-horizontal tasi-form" id="deletenews">

      <div class="modal-body">
        <input type="hidden" name="deletenewsid" class="deletenewsid">
        <div class="container">
            <h1 class="text-danger">Delete Detail !</h1>
            <p>Are you sure you want to delete your Details?</p>
           </div> 
               
        
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger delete_news_btn">delete </button>
      </div>
    </form>
    </div>
  </div>
</div>
<div class="modal fade" id="update_service" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>

      </div>

      <form class="form-horizontal tasi-form" id="update_service">

        <input type="hidden" name="service_id" class="service_id">

        <div class="modal-body">

          <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> TITLE</label>

               <div class="col-lg-6">

                 <input type="text" name="servicetitle" class="form-control servicetitle" placeholder="SERVICE TITLE..." >

               </div>
          </div>
          

          <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> SERVICE DESCRIPTION</label>

               <div class="col-lg-6">

                  <textarea name="service_dec" class="form-control service_dec" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>

     
       <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> SERVICE IMAGE</label>

               <div class="col-lg-6">

                  <input type="file" name="image" class="form-control image" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>

      </div>
	   </div>

      <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary service_btn">Save </button>

      </div>

      </form>

    </div>

  </div>
  <div class="modal fade" id="delete_service" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>
    <form class="form-horizontal tasi-form" id="delete_service">

      <div class="modal-body">
        <input type="hidden" name="delete_service_id" class="delete_service_id">
        <div class="container">
            <h1 class="text-danger">Delete Detail !</h1>
            <p>Are you sure you want to delete your Details?</p>
           </div> 
               
        
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger delete_service_btn">delete </button>
      </div>
    </form>
    </div>
  </div>
</div>
<div class="modal fade" id="update_notice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>

      </div>

      <form class="form-horizontal tasi-form" id="update__notice">

        <input type="hidden" name="updatenoticeid" class="updatenoticeid">

        <div class="modal-body">

          <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> TITLE</label>

               <div class="col-lg-6">

                 <input type="text" name="notice_title" class="form-control notice_title" placeholder="NOTICE TITLE..." >

               </div>
          </div>
          

          <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  DESCRIPTION</label>

               <div class="col-lg-6">

                  <textarea name="notice_desc" class="form-control notice_desc" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>
            <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> DATE</label>

               <div class="col-lg-6">

                 <input type="date" name="notice_date" class="form-control notice_date" placeholder="NOTICE TITLE..." >

               </div>
          </div>
		    
     
       <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  IMAGE</label>

               <div class="col-lg-6">

                  <input type="file" name="image" class="form-control image" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>

      </div>
	   </div>

      <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary update_news_btn">Save </button>

      </div>

      </form>

    </div>

  </div>
  <div class="modal fade" id="delete_notice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>
    <form class="form-horizontal tasi-form" id="deletenotice">

      <div class="modal-body">
        <input type="hidden" name="deletenoticeid" class="deletenoticeid">
        <div class="container">
            <h1 class="text-danger">Delete Detail !</h1>
            <p>Are you sure you want to delete your Details?</p>
           </div> 
               
        
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger delete_notice_btn">delete </button>
      </div>
    </form>
    </div>
  </div>
</div>
<div class="modal fade" id="update_latest_news" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>

      </div>

      <form class="form-horizontal tasi-form" id="update__latest_news">

        <input type="hidden" name="updatelatestnewsid" class="updatelatestnewsid">

        <div class="modal-body">

          <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> TITLE</label>

               <div class="col-lg-6">

                 <input type="text" name="latest_news_title" class="form-control latest_news_title" placeholder="NEWS TITLE..." >

               </div>
          </div>
          

          <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  DESCRIPTION</label>

               <div class="col-lg-6">

                  <textarea name="latest_news_desc" class="form-control latest_news_desc" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>
            
     
       <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  IMAGE</label>

               <div class="col-lg-6">

                  <input type="file" name="image" class="form-control image" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>

      </div>
	   </div>

      <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary update_news_btn">Save </button>

      </div>

      </form>

    </div>

  </div>
  <div class="modal fade" id="delete_latest_news" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>
    <form class="form-horizontal tasi-form" id="deletelatestnews">

      <div class="modal-body">
        <input type="hidden" name="deletelatestnewsid" class="deletelatestnewsid">
        <div class="container">
            <h1 class="text-danger">Delete Detail !</h1>
            <p>Are you sure you want to delete your Details?</p>
           </div> 
               
        
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger delete_notice_btn">delete </button>
      </div>
    </form>
    </div>
  </div>
</div>
<!-- advance notice-->
<div class="modal fade" id="update_advance_notice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>

      </div>

      <form class="form-horizontal tasi-form" id="update_advance_notice">

        <input type="hidden" name="updateadvancenoticeid" class="updateadvancenoticeid">

        <div class="modal-body">

          <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> TITLE</label>

               <div class="col-lg-6">

                 <input type="text" name="advance_notice_title" class="form-control advance_notice_title" placeholder="ADVANCE NOTICE TITLE..." >

               </div>
          </div>
          

          <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  DESCRIPTION</label>

               <div class="col-lg-6">

                  <textarea name="advance_notice_desc" class="form-control advance_notice_desc" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>
            
     
       <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  IMAGE</label>

               <div class="col-lg-6">

                  <input type="file" name="image" class="form-control image" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>

      </div>
	   </div>

      <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary update_news_btn">Save </button>

      </div>

      </form>

    </div>

  </div>
  <div class="modal fade" id="delete_advance_notice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>
    <form class="form-horizontal tasi-form" id="deleteadvancenotice">

      <div class="modal-body">
        <input type="hidden" name="deleteadvancenoticeid" class="deleteadvancenoticeid">
        <div class="container">
            <h1 class="text-danger">Delete Detail !</h1>
            <p>Are you sure you want to delete your Details?</p>
           </div> 
               
        
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger delete_notice_btn">delete </button>
      </div>
    </form>
    </div>
  </div>
</div>
<!-- flash image -->

<div class="modal fade" id="update_flash_image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>

      </div>

      <form class="form-horizontal tasi-form" id="updateflashimage">

        <input type="hidden" name="updateflashimageid" class="updateflashimageid">

        <div class="modal-body">

          <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> TITLE</label>

               <div class="col-lg-6">

                 <input type="text" name="flash_image_title" class="form-control flash_image_title" placeholder=" TITLE..." >

               </div>
          </div>
          

          <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  DESCRIPTION</label>

               <div class="col-lg-6">

                  <textarea name="flash_image_desc" class="form-control flash_image_desc" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>
            
     
       <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  IMAGE</label>

               <div class="col-lg-6">

                  <input type="file" name="image" class="form-control image" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>

      </div>
	   </div>

      <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary update_news_btn">Save </button>

      </div>

      </form>

    </div>

  </div>
  <div class="modal fade" id="delete_flash_image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>
    <form class="form-horizontal tasi-form" id="deleteflashimage">

      <div class="modal-body">
        <input type="hidden" name="deleteflashimageid" class="deleteflashimageid">
        <div class="container">
            <h1 class="text-danger">Delete Detail !</h1>
            <p>Are you sure you want to delete your Details?</p>
           </div> 
               
        
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger delete_notice_btn">delete </button>
      </div>
    </form>
    </div>
  </div>
</div>

<div class="modal fade" id="update_news" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>

      </div>

      <form class="form-horizontal tasi-form" id="update__news">

        <input type="hidden" name="updatenewsid" class="updatenewsid">

        <div class="modal-body">

          <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> TITLE</label>

               <div class="col-lg-6">

                 <input type="text" name="news_title" class="form-control news_title" placeholder="NEWS TITLE..." >

               </div>
          </div>
          

          <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  DESCRIPTION</label>

               <div class="col-lg-6">

                  <textarea name="news_desc" class="form-control news_desc" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>
            <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> DATE</label>

               <div class="col-lg-6">

                 <input type="date" name="news_date" class="form-control news_date" placeholder="NEWS TITLE..." >

               </div>
          </div>
		    
     
       <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  IMAGE</label>

               <div class="col-lg-6">

                  <input type="file" name="image" class="form-control image" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>

      </div>
	   </div>

      <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary update_news_btn">Save </button>

      </div>

      </form>

    </div>

  </div>
  <div class="modal fade" id="delete_news" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>
    <form class="form-horizontal tasi-form" id="deletenotice">

      <div class="modal-body">
        <input type="hidden" name="deletenewsid" class="deletenewsid">
        <div class="container">
            <h1 class="text-danger">Delete Detail !</h1>
            <p>Are you sure you want to delete your Details?</p>
           </div> 
               
        
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger delete_notice_btn">delete </button>
      </div>
    </form>
    </div>
  </div>
</div>
<div class="modal fade" id="update_information_board" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>

      </div>

      <form class="form-horizontal tasi-form" id="updateinformationboard">

        <input type="hidden" name="updateinformationboardid" class="updateinformationboardid">

        <div class="modal-body">

          <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> LINK NAME</label>

               <div class="col-lg-6">

                 <input type="text" name="board_name" class="form-control board_name" placeholder="BOARD NAME..." >

               </div>
          </div>
          

          <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  LINK URL</label>

               <div class="col-lg-6">

                  <input type="text" name="board_url" class="form-control board_url" placeholder=" ENTER  URL...."></textarea>

               </div>

           </div>
        
     
       
      </div>
	   </div>

      <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary update_news_btn">Save </button>

      </div>

      </form>

    </div>

  </div>
  <div class="modal fade" id="delete_information_baord" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>
    <form class="form-horizontal tasi-form" id="deleteinformationboard">

      <div class="modal-body">
        <input type="hidden" name="deleteinformationboardid" class="deleteinformationboardid">
        <div class="container">
            <h1 class="text-danger">Delete Detail !</h1>
            <p>Are you sure you want to delete your Details?</p>
           </div> 
               
        
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger delete_notice_btn">delete </button>
      </div>
    </form>
    </div>
  </div>
</div>
<div class="modal fade" id="update_admission_notice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>

      </div>

      <form class="form-horizontal tasi-form" id="updateadmissionnotice">

        <input type="hidden" name="updateadmissionnoticeid" class="updateadmissionnoticeid">

        <div class="modal-body">

          <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> LINK NAME</label>

               <div class="col-lg-6">

                 <input type="text" name="notice_name" class="form-control notice_name" placeholder=" NAME..." >

               </div>
          </div>
          

          <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  LINK URL</label>

               <div class="col-lg-6">

                  <input type="text" name="notice_url" class="form-control notice_url" placeholder=" ENTER  URL...."></textarea>

               </div>

           </div>
        
     
       
      </div>
	   </div>

      <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary update_news_btn">Save </button>

      </div>

      </form>

    </div>

  </div>
  <div class="modal fade" id="delete_admission_notice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>
    <form class="form-horizontal tasi-form" id="deleteadmissionnotice">

      <div class="modal-body">
        <input type="hidden" name="deleteadmissionnoticeid" class="deleteadmissionnoticeid">
        <div class="container">
            <h1 class="text-danger">Delete Detail !</h1>
            <p>Are you sure you want to delete your Details?</p>
           </div> 
               
        
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger delete_notice_btn">delete </button>
      </div>
    </form>
    </div>
  </div>
</div>
<div class="modal fade" id="update_branches" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
      <form class="form-horizontal tasi-form" id="updatebranches">
        <input type="hidden" name="updatebranchesid" class="updatebranchesid">
        <div class="modal-body">
          <div class="form-group ">
               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> TITLE</label>
               <div class="col-lg-6">
                 <input type="text" name="branches_title" class="form-control branches_title" placeholder=" TITLE..." >
               </div>
          </div>
          <div class="form-group">
               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> NEWS DESCRIPTION</label>
               <div class="col-lg-6">
                  <textarea name="branches_desc" class="form-control branches_desc" placeholder=" ENTER  DESCRIPTION...."></textarea>
               </div>
            </div>
	        <div class="form-group">
               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> URL</label>
               <div class="col-lg-6">
                  <input type="text" name="branches_url" class="form-control branches_url" placeholder=" ENTER  URL...."></textarea>
               </div>
           </div>
            <div class="form-group">
               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  IMAGE</label>
               <div class="col-lg-6">
                  <input type="file" name="image" class="form-control image" placeholder=" ENTER  DESCRIPTION...."></textarea>
               </div>
           </div>
      </div>
	</div>

      <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary update_news_btn">Save </button>

      </div>

      </form>

    </div>

  </div>
  
  
  
  <div class="modal fade" id="delete_branches" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>
    <form class="form-horizontal tasi-form" id="deletebranches">

      <div class="modal-body">
        <input type="hidden" name="deletebranchesid" class="deletebranchesid">
        <div class="container">
            <h1 class="text-danger">Delete Detail !</h1>
            <p>Are you sure you want to delete your Details?</p>
           </div> 
               
        
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger delete_news_btn">delete </button>
      </div>
    </form>
    </div>
  </div>
</div>
<div class="modal fade" id="update_event" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>

      </div>

      <form class="form-horizontal tasi-form" id="updateevent">

        <input type="hidden" name="updateeventid" class="updateeventid">

        <div class="modal-body">

          <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> TITLE</label>

               <div class="col-lg-6">

                 <input type="text" name="updateeventtitle" class="form-control updateeventtitle" placeholder=" TITLE..." >

               </div>
          </div>
          

          <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> NEWS DESCRIPTION</label>

               <div class="col-lg-6">

                  <textarea name="updateeventdesc" class="form-control updateeventdesc" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>
		    
     
       <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  IMAGE</label>

               <div class="col-lg-6">

                  <input type="file" name="image" class="form-control image" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>

      </div>
	   </div>

      <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary update_news_btn">Save </button>

      </div>

      </form>

    </div>

  </div>
  <div class="modal fade" id="delete_event" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>
    <form class="form-horizontal tasi-form" id="deleteevent">

      <div class="modal-body">
        <input type="hidden" name="blogeventid" class="blogeventid">
        <div class="container">
            <h1 class="text-danger">Delete Detail !</h1>
            <p>Are you sure you want to delete your Details?</p>
           </div> 
               
        
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger delete_news_btn">delete </button>
      </div>
    </form>
    </div>
  </div>
</div>
<!--exam-->
<div class="modal fade" id="update_exam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>

      </div>

      <form class="form-horizontal tasi-form" id="updateexam">

        <input type="hidden" name="updateexamid" class="updateexamid">

        <div class="modal-body">

          <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> TITLE</label>

               <div class="col-lg-6">

                 <input type="text" name="updateexamtitle" class="form-control updateexamtitle" placeholder=" TITLE..." >

               </div>
          </div>
          

          <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> NEWS DESCRIPTION</label>

               <div class="col-lg-6">

                  <textarea name="updateexamdesc" class="form-control updateexamdesc" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>
		    
     
       <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  IMAGE</label>

               <div class="col-lg-6">

                  <input type="file" name="image" class="form-control image" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>

      </div>
	   </div>

      <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary update_news_btn">Save </button>

      </div>

      </form>

    </div>

  </div>
  <div class="modal fade" id="delete_exam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>
    <form class="form-horizontal tasi-form" id="deleteexam">

      <div class="modal-body">
        <input type="hidden" name="deleteexamid" class="deleteexamid">
        <div class="container">
            <h1 class="text-danger">Delete Detail !</h1>
            <p>Are you sure you want to delete your Details?</p>
           </div> 
               
        
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger delete_news_btn">delete </button>
      </div>
    </form>
    </div>
  </div>
</div>
<!--student-->
<div class="modal fade" id="update_student" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>

      </div>

      <form class="form-horizontal tasi-form" id="updatestudent">

        <input type="hidden" name="updateeventid" class="updatestudentid">

        <div class="modal-body">

          <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> TITLE</label>

               <div class="col-lg-6">

                 <input type="text" name="updatestudenttitle" class="form-control updatestudenttitle" placeholder=" TITLE..." >

               </div>
          </div>
          

          <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> NEWS DESCRIPTION</label>

               <div class="col-lg-6">

                  <textarea name="updatestudentdesc" class="form-control updatestudentdesc" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>
		    
     
       <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  IMAGE</label>

               <div class="col-lg-6">

                  <input type="file" name="image" class="form-control image" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>

      </div>
	   </div>

      <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary update_news_btn">Save </button>

      </div>

      </form>

    </div>

  </div>
  <div class="modal fade" id="delete_student" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>
    <form class="form-horizontal tasi-form" id="deleteexam">

      <div class="modal-body">
        <input type="hidden" name="deletestudentid" class="deletestudentid">
        <div class="container">
            <h1 class="text-danger">Delete Detail !</h1>
            <p>Are you sure you want to delete your Details?</p>
           </div> 
               
        
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger delete_news_btn">delete </button>
      </div>
    </form>
    </div>
  </div>
</div>
<!--add-->
<div class="modal fade" id="update_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>

      </div>

      <form class="form-horizontal tasi-form" id="updateadd">

        <input type="hidden" name="updateaddid" class="updateaddid">

        <div class="modal-body">

          <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> TITLE</label>

               <div class="col-lg-6">

                 <input type="text" name="updateaddtitle" class="form-control updateaddtitle" placeholder=" TITLE..." >

               </div>
          </div>
          

          <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> NEWS DESCRIPTION</label>

               <div class="col-lg-6">

                  <textarea name="updateadddesc" class="form-control updateadddesc" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>
		    
     
       <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  IMAGE</label>

               <div class="col-lg-6">

                  <input type="file" name="image" class="form-control image" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>

      </div>
	   </div>

      <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary update_news_btn">Save </button>

      </div>

      </form>

    </div>

  </div>
  <div class="modal fade" id="delete_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>
    <form class="form-horizontal tasi-form" id="deleteadd">

      <div class="modal-body">
        <input type="hidden" name="deleteaddid" class="deleteaddid">
        <div class="container">
            <h1 class="text-danger">Delete Detail !</h1>
            <p>Are you sure you want to delete your Details?</p>
           </div> 
               
        
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger delete_news_btn">delete </button>
      </div>
    </form>
    </div>
  </div>
</div>
<!--gallery-->
<div class="modal fade" id="update_gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>

      </div>

      <form class="form-horizontal tasi-form" id="updategallery">

        <input type="hidden" name="updategalleryid" class="updategalleryid">

        <div class="modal-body">

          <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> TITLE</label>

               <div class="col-lg-6">

                 <input type="text" name="updategallerytitle" class="form-control updategallerytitle" placeholder=" TITLE..." >

               </div>
          </div>
          

          <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> NEWS DESCRIPTION</label>

               <div class="col-lg-6">

                  <textarea name="updategallerydesc" class="form-control updategallerydesc" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>
		    
     
       <div class="form-group">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  IMAGE</label>

               <div class="col-lg-6">

                  <input type="file" name="image" class="form-control image" placeholder=" ENTER  DESCRIPTION...."></textarea>

               </div>

           </div>

      </div>
	   </div>

      <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary update_news_btn">Save </button>

      </div>

      </form>

    </div>

  </div>
  <div class="modal fade" id="delete_gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>
    <form class="form-horizontal tasi-form" id="deletegallery">

      <div class="modal-body">
        <input type="hidden" name="deletegalleryid" class="deletegalleryid">
        <div class="container">
            <h1 class="text-danger">Delete Detail !</h1>
            <p>Are you sure you want to delete your Details?</p>
           </div> 
               
        
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger delete_news_btn">delete </button>
      </div>
    </form>
    </div>
  </div>
</div>


<!----------------------- start model add news letter --------------------------------------->




<div class="modal fade" id="modal_add_news_letter_services" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
		    </div>
			<form class="form-horizontal tasi-form" id="add_news_letter_services">
				<div class="modal-body">
					<div class="form-group ">
    			         <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">TITLE </label>
			         <div class="col-lg-6">
			           <input type="text" name="title" class="form-control " placeholder="TITLE " >
			         </div>
                </div>
                 <div class="form-group ">
                   <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">DESCRIPTION</label>
                    <div class="col-lg-6">
                        <input type="text" name="desc" class="form-control  " placeholder="DESCRIPTION" >
                    </div>
                 </div>
                
                <div class="form-group ">
                   <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">WEB LINK</label>
                   <div class="col-lg-6">
                     <input type="text" name="web_link" class="form-control " placeholder="WEBSITE LINK" >
                   </div>
                </div>
                
                
                
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save </button>
			</div>
			</form>
		</div>
	</div>
</div>


<div class="modal fade" id="update_news_letter_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
		    </div>
			<form class="form-horizontal tasi-form" id="update_news_letter_services">
			    
			    <input type="hidden" name="news_letter_id" class="update_news_letter_id" >  
				<div class="modal-body">
					<div class="form-group ">
    			         <label class="col-sm-2 control-label col-lg-3 update_news_letter_title" for="inputSuccess">TITLE </label>
			         <div class="col-lg-6">
			           <input type="text" name="title" class="form-control " placeholder="TITLE " >
			         </div>
                </div>
                 <div class="form-group ">
                   <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">DESCRIPTION</label>
                    <div class="col-lg-6">
                        <input type="text" name="desc" class="form-control update_news_letter_desc " placeholder="DESCRIPTION" >
                    </div>
                 </div>
                
                <div class="form-group ">
                   <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">WEB LINK</label>
                   <div class="col-lg-6">
                     <input type="text" name="web_link" class="form-control update_news_letter_link" placeholder="WEBSITE LINK" >
                   </div>
                </div>
               
                
                
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save </button>
			</div>
			</form>
		</div>
	</div>
</div>


<!----------------------- end model add news lettter ----------------------------------------->

<!-- end update feedback request -->
	<div class="modal fade" id="modal_add_member" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

				<h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>

			</div>

			<form class="form-horizontal tasi-form" id="add_member">

				<div class="modal-body">

					<div class="form-group ">

			         <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">MEMBER NAME</label>

			         <div class="col-lg-6">

			           <input type="text" name="member_name" class="form-control " placeholder="MEMBER NAME" >

			         </div>

         </div>

         <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">MEMBER CONTACT</label>

               <div class="col-lg-6">

                 <input type="text" name="member_contact" class="form-control  " placeholder="MEMBER CONTACT" >

               </div>

         </div>

         <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">MEMBER ADDRESS</label>

               <div class="col-lg-6">

                 

                 <textarea name="member_address" class="form-control " placeholder=" MEMBER ADDRESS">

                   

                 </textarea>

               </div>

         </div>

         <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">MEMBER POST</label>

               <div class="col-lg-6">

                 <input type="text" name="member_post" class="form-control " placeholder="MEMBER POST" >

               </div>

         </div>

          <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">STATE </label>

               <div class="col-lg-6">

                 <select class="form-control state selectpicker" data-live-search="true" name="state">

                    <option value="all">-- CHOOSE STATE </option>

                    <?php

                    $state = get_all_states();

                    foreach ($state as $states) {

                      echo '<option value="'.$states->STATE_ID.'">'.$states->STATE_NAME.'</option>';

                    }

                    ?>

                 </select>

               </div>

         </div>

         <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">MEMBER DISTRICT</label>

               <div class="col-lg-6">

                 <select class="form-control city" name="district">

                   <option value="0"> -- Select District --</option>

                 </select>

               </div>

         </div>

         <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">MEMBER PHOTO</label>

               <div class="col-lg-6">

                 <input type="file" name="image" class="form-control" placeholder="MEMBER POST" >

               </div>

         </div>

         <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">ABOUT US </label>

               <div class="col-lg-6">

                 

                 <textarea name="member_about_us" class="form-control " placeholder=" MEMBER ADDRESS">

                   

                 </textarea>

               </div>

         </div>

				</div>

				<div class="modal-footer">

					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

					<button type="submit" class="btn btn-primary">Save </button>

				</div>

			</form>

		</div>

	</div>

</div>









<div class="modal fade" id="edit_brand_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
      <form class="form-horizontal tasi-form" id="update_brand">
        <input type="hidden" name="updatebrandid" class="updatebrandid">
        <div class="modal-body">
            <div class="form-group ">
               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> <?php echo $title;  ?></label>
               <div class="col-lg-6">
                 <input type="text" name="brand_name" class="form-control update_brand_name" placeholder="<?php echo $title;  ?> name" >
               </div>
            </div>
          
            <div class="form-group">
               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  IMAGE</label>
               <div class="col-lg-6">
                  <input type="file" name="fileToUpload" class="form-control image" placeholder=" ENTER  DESCRIPTION...."></textarea>
               </div>
           </div>
      </div>
	</div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary update_brand_btn">Save </button>
      </div>
      </form>
    </div>
</div>




<div class="modal fade" id="update_category_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
      <form class="form-horizontal tasi-form" id="update_category">
        <input type="hidden" name="update_category_id" class="update_category_id">
        <div class="modal-body">
            <div class="form-group ">
               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> <?php echo $title;  ?></label>
               <div class="col-lg-6">
                 <input type="text" name="category_name" class="form-control update_category_name" placeholder="<?php echo $title;  ?> name" >
               </div>
            </div>
          
            <div class="form-group">
               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  IMAGE</label>
               <div class="col-lg-6">
                  <input type="file" name="fileToUpload" class="form-control image" placeholder=" ENTER  DESCRIPTION...."></textarea>
               </div>
           </div>
      </div>
	</div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary update_brand_btn">Save </button>
      </div>
      </form>
    </div>
</div>



<div class="modal fade" id="update_sub_category_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
      <form class="form-horizontal tasi-form" id="update_sub_category">
        <input type="hidden" name="update_sub_category_id" class="update_sub_category_id">
        <div class="modal-body">
            <div class="form-group ">
               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> <?php echo $title;  ?></label>
               <div class="col-lg-6">
                 <input type="text" name="sub_category_name" class="form-control update_sc_name" placeholder="<?php echo $title;  ?> name" >
               </div>
            </div>
          
            <div class="form-group">
               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  IMAGE</label>
               <div class="col-lg-6">
                  <input type="file" name="fileToUpload" class="form-control image" placeholder=" ENTER  DESCRIPTION...."></textarea>
               </div>
           </div>
      </div>
	</div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary update_brand_btn">Save </button>
      </div>
      </form>
    </div>
</div>






<div class="modal fade" id="edit_product_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
      <form class="form-horizontal tasi-form" id="update_product">
        <input type="hidden" name="update_product_id" class="update_product_id">
        <div class="modal-body">
            <div class="form-group ">
               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> <?php echo $title;  ?></label>
               <div class="col-lg-6">
                 <input type="text" name="product_name" class="form-control update_product_name" placeholder="<?php echo $title;  ?> name" >
               </div>
            </div>
          
            <div class="form-group">
               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">  IMAGE</label>
               <div class="col-lg-6">
                  <input type="file" name="fileToUpload" class="form-control image" placeholder=" ENTER  DESCRIPTION...."></textarea>
               </div>
           </div>
      </div>
	</div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary update_brand_btn">Save </button>
      </div>
      </form>
    </div>
</div>






  <div class="modal fade" id="modal_update_member" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>

      </div>

      <form class="form-horizontal tasi-form" id="update_member">

        <input type="hidden" name="memberid" class="memberid">

        <div class="modal-body">

          <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">MEMBER NAME</label>

               <div class="col-lg-6">

                 <input type="text" name="member_name" class="form-control member_name" placeholder="MEMBER NAME" >

               </div>

         </div>

         <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">MEMBER CONTACT</label>

               <div class="col-lg-6">

                 <input type="text" name="member_contact" class="form-control  member_contact" placeholder="MEMBER CONTACT" >

               </div>

         </div>

         <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">MEMBER ADDRESS</label>

               <div class="col-lg-6">

                 

                 <textarea name="member_address" class="form-control member_address" placeholder=" MEMBER ADDRESS">

                   

                 </textarea>

               </div>

         </div>

         <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">MEMBER POST</label>

               <div class="col-lg-6">

                 <input type="text" name="member_post" class="form-control member_post" placeholder="MEMBER POST" >

               </div>

         </div>

          <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">STATE </label>

               <div class="col-lg-6">

                 <select class="form-control state selectpicker" data-live-search="true" name="state">

                    <option value="all">-- CHOOSE STATE </option>

                    <?php

                    $state = get_all_states();

                    foreach ($state as $states) {

                      echo '<option value="'.$states->STATE_ID.'">'.$states->STATE_NAME.'</option>';

                    }

                    ?>

                 </select>

               </div>

         </div>

         <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">MEMBER DISTRICT</label>

               <div class="col-lg-6">

                 <select class="form-control city" name="district">

                   <option value="0">-- Select District --</option>

                 </select>

               </div>

         </div>

         <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">MEMBER PHOTO</label>

               <div class="col-lg-6">

                 <input type="file" name="image" class="form-control" placeholder="MEMBER POST" >

               </div>

         </div>

         <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">ABOUT US</label>

               <div class="col-lg-6">

                <textarea name="member_about_us" class=" form-control member_about_us">

                  

                </textarea>

               </div>

         </div>



        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary">Save </button>

        </div>

      </form>

    </div>

  </div>

</div>
<!-- delete member modal -->
<div class="modal fade" id="delete_member" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>
    <form class="form-horizontal tasi-form" id="delete_member">

      <div class="modal-body">
        <input type="hidden" name="memberdeleteid" class="memberdeleteid">
        <div class="container">
            <h1 class="text-danger">Delete Detail !</h1>
            <p>Are you sure you want to delete your Details?</p>
           </div> 
               
        
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger delete_member_btn">delete </button>
      </div>
    </form>
    </div>
  </div>
</div>

<!--add cause request --> 
<div class="modal fade" id="add_causes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
      <form class="form-horizontal tasi-form" id="add_causes">
        <!-- <input type="hidden" name="updatecausesid" class="updatecausesid"> -->
        <div class="modal-body">
          <div class="form-group ">
               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">TITLE</label>
               <div class="col-lg-6">
                 <input type="text" name="causes" class="form-control" placeholder="ENTER TITLE" required=""> 
               </div>
         </div>
         <div class="form-group ">
               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">CAUSE TITLE</label>
               <div class="col-lg-6">
                 <input type="text" name="add_cause_title" class="form-control" placeholder=" ENTER CAUSE TITLE" required="">
               </div>
         </div>
          <div class="form-group ">
               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">CAUSE DESCRIPTION</label>
               <div class="col-lg-6">
                 <textarea  name="cause_desc" class="form-control  cause_desc" placeholder="ENTER DESCRIPTION" required="">
                  </textarea>
               </div>
         </div>
         <div class="form-group ">
               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> IMAGE</label>
               <div class="col-lg-6">
                 <input type="file" name="image" class="form-control"  required="">
               </div>
         </div>
         <div class="form-group ">
            <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">RAISE</label>
             <div class="col-lg-6">
                  <input type="number" name="raise" class="form-control raise" placeholder=" ENTER RAISE PRICE">
              </div>
         </div>
          <div class="form-group ">
            <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">GOAL</label>
             <div class="col-lg-6">
                  <input type="number" name="goal" class="form-control" placeholder=" ENTER RAISE GOAL">
              </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">BUTTON NAME</label>
             <div class="col-lg-6">
                  <input type="text" name="button_name" class="form-control" placeholder=" ENTER BUTTON NAME">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary add_cause_btn">Save </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end add cause request -->


<!--update cause request --> 
<div class="modal fade" id="update_causes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>

      </div>

      <form class="form-horizontal tasi-form" id="update_causes">

        <input type="hidden" name="updatecausesid" class="updatecausesid">

        <div class="modal-body">

          <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">TITLE</label>

               <div class="col-lg-6">

                 <input type="text" name="causes" class="form-control causes" placeholder="ENTER TITLE" required=""> 

               </div>

         </div>

         <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">CAUSE TITLE</label>

               <div class="col-lg-6">

                 <input type="text" name="cause_title" class="form-control  cause_title" placeholder="CAUSE TITLE" required="">

               </div>

         </div>
          <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">CAUSE DESCRIPTION</label>

               <div class="col-lg-6">

                 <textarea  name="cause_desc" class="form-control  cause_desc" placeholder="ENTER DESCRIPTION" required="">
                  </textarea>
               </div>

         </div>
         <div class="form-group ">

               <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> IMAGE</label>

               <div class="col-lg-6">

                 <input type="file" name="image" class="form-control  image"  required="">

               </div>
         </div>
         <div class="form-group ">
            <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">RAISE</label>
             <div class="col-lg-6">
                  <input type="number" name="raised" class="form-control raised" placeholder=" ENTER RAISE PRICE">
              </div>

         </div>
          <div class="form-group ">
            <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">GOAL</label>
             <div class="col-lg-6">
                  <input type="number" name="goal" class="form-control goal" placeholder=" ENTER RAISE GOAL">
              </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">BUTTON NAME</label>
             <div class="col-lg-6">
                  <input type="text" name="button_name" class="form-control button_name" placeholder=" ENTER BUTTON NAME">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary update_cause_btn">Save </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end update cause request -->
<!-- delete cause modal -->
<div class="modal fade" id="delete_cause" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>
    <form class="form-horizontal tasi-form" id="delete_cause">

      <div class="modal-body">
        <input type="hidden" name="causesdeleteid" class="causesdeleteid">
        <div class="container">
            <h1 class="text-danger">Delete Detail !</h1>
            <p>Are you sure you want to delete your Details?</p>
           </div> 
               
        
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger delete_cause_btn">delete </button>
      </div>
    </form>
    </div>
  </div>
</div>


