<?
// require_once 'admin/includes/config.php';

	$admit = $this->db->query("SELECT * FROM certificates where enrollment_no = '".$_POST['enrollment_no']."'");
	$stu = $this->db->query("SELECT * FROM students where enrollment_no = '".$_POST['enrollment_no']."' AND dob = '".$_POST['dob']."'");
	if($stu->num_rows>0 && $admit->num_rows>0)
	{
		$s = $stu->row();
		$a = $admit->row();
		$c = $con->query("SELECT * FROM centers where id = '".$s['center_id']."'")->row();
		$course = $con->query("SELECT * FROM courses where id = '".$s['course_id']."'")->row();
	    /*
	    
	    
		?>
		<style>
		    .certi-img{
		            position: absolute;
                    z-index: 999;
                    right: 8.8%;
                    top: 26%;
                    width: 107px;
                    height: 134px;
		    }
		    .time-label{
		        position:absolute;
		        top: 441px;
		    }
		</style>
		    <div style="width:100%;height:400px;text-align:center;position:relative;" align="center">
            <img src="certificate.jpeg" style="z-index:-9;position:absolute;width:100%;right:0">
            <img src="uploads/students/<?=$s['photo']?>" class="certi-img" align="right">
            <br>
            <div style="position:absolute;width:800px;left:20%;top:60%;">
                <h2 style="margin-top:15%"><b><?=$c['institute_name']?></b></h2>
                <div style="padding-left:40px;padding-right:40px"><?=$a['content']?></div>
                <p style="font-size:8px;text-align:left;padding-left:40px;padding-right:40px">
                    THIS AUTHORIZATION IS VALID FOR IIFE TIME UNLESS THE CENTRE IS NOT DISCONTINUED FOR MORE THAN SIX MONTH
                </p>
                <div class="time-label">
                    <?=date('d-m-Y',strtotime($a['timestamp']))?>
                </div>
            </div>
            </div>
		<?
		
		*/
		?>
		<style>
.container {
  position: relative;
  text-align: center;
  color: white;
}

.bottom-left {
    position: absolute;
    bottom: 22%;
    left: 11%;
    color: black;
}

.top-left {
  position: absolute;
  top: 8px;
  left: 16px;
}

.top-right {
    position: absolute;
    /*top: 49px;*/
    /*right: 48px;*/
    /*width: 79px;*/
    top: 10.5%;
    right: 8.7%;
    width: 10%;
}

.bottom-right {
  position: absolute;
  bottom: 8px;
  right: 16px;
}

.centered {
   /*
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%); */
    position: absolute;
    top: 43%;
    padding-left: 64px;
    width: 78%;
}

</style>
		<div class="container">
          <img src="certificate.jpeg" alt="Snow" style="width:100%;">
          <div class="bottom-left"><?=date('d-m-Y',strtotime($a['timestamp']))?></div>
          <div class="top-left"></div>
          <img src="uploads/students/<?=$s['photo']?>" class="top-right" align="right">
          <div class="bottom-right"></div>
          <div class="centered" style="color:black">
            <center><h1><b><?=$c['institute_name']?></b></h1></center>
            <?=strip_tags($a['content'])?>
            <p style="font-size:8px;text-align:left;padding-left:40px;padding-right:40px">
                    THIS AUTHORIZATION IS VALID FOR IIFE TIME UNLESS THE CENTRE IS NOT DISCONTINUED FOR MORE THAN SIX MONTH
            </p>
          </div>
          <img src="uploads/qr/<?=$a['qr_code']?>" style="width: 90px;
    height: 90px;
    border: 1px solid black;
    position: absolute;
    bottom: 7.5%;
    right: 19.6%;">
        </div>
		<?
	}
	else
	{
		echo '<script>alert("Enrollment or date of birth not matched.");location.href="get_certificate"</script>';
	}
?>
