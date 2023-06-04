<?php
$profile=$this->db->get('profile')->row();
?>

<!--Banner Wrap Start-->
    <div class="kf_inr_banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                	<!--KF INR BANNER DES Wrap Start-->
                    <div class="kf_inr_ban_des">
                    	<div class="inr_banner_heading">
							<h3>Center List </h3>
                    	</div>
                       
                        <div class="kf_inr_breadcrumb">
							<ul>
								<li><a href="#">Home</a></li>
								<li><a href="#"> Center List </a></li>
							</ul>
						</div>
                    </div>
                    <!--KF INR BANNER DES Wrap End-->
                </div>
            </div>
        </div>
    </div>

        <!--Banner Wrap End-->

<!--Banner Wrap End-->

    	<!--Content Wrap Start-->
    	<!--search bar start-->
    	<div class="kf_content_wrap overflow_visible">
    		<div class="search_bar_outer_wrap">
	    		<div class="container" >
	    			<div class="inr_pg_search_wrap">
		    			<form  method="get">
		    				<div class="search_bar_des">
		    					
		    					 <select id="basic" class="col-md-6 state" name="state" style="height: 50px;">
		    					    <option>--select State--</option>
		    					 <?php
	    					        $query=$this->db->query('select * from  state  ');
                                    // $count_service = $query->num_rows();
                                    foreach($query->result() as $row){
                                ?>
                                    
                                    <option value="<?php echo $row->STATE_ID;?>"><?php echo $row->STATE_NAME;?></option>
                                 <?php
                                    }
                                ?>
                                </select>
                                
                                
                                
                                <select id="basic" class="col-md-6 city" name="district" style="height: 50px;">
		    					    <option>--select District --</option>
		    					 
                                </select>
		    					
		    				</div>
		    				
		    				<button type="submit">Search Now</button>
		    			</form>
		    		</div>
			    </div>
		    </div>
		    <!--search bar end-->
		    
		    











<div class=""style="padding-left:30px;padding-right:30px">
    

<div class="box box-success">
	<div class="box-header" style="text-align: center;background: chartreuse;">
	    <h3>Center List</h3>
	</div>
	<div class="row">
	    <div class="col-md-12">
	        
	    </div>
	</div>
	
	
	
	<div class="box-body">
		 <div style="overflow-x:auto;">
		<table class="table table-bordered">
			<thead>
				<tr><th>SR.No</th>
					<th>Photo</th>
					<th>ID</th>
					<th>Institute owner Name</th>
					<th>Institute Name</th>
					<th>Institute Address</th>
					
					<th> State </th>
					<th> District </th>
					<th>Contact No </th>
					<!--<th>Transection</th>-->
					<!--<th>Edit</th>-->
					
					
				</tr>
			</thead>
			<tbody>
				<?php
				$x = 1;
				    if($this->input->get()){
				        $get = $this->db->query("SELECT * FROM `centers` LEFT JOIN state ON state.STATE_ID=centers.state_id LEFT JOIN district ON district.DISTRICT_ID=centers.city_id WHERE centers.state_id LIKE '".$_GET['state']."' AND centers.city_id LIKE '".$_GET['district']."' and status = 1");
				    }else{
				        $get = $this->db->query("SELECT * FROM centers LEFT JOIN state ON state.STATE_ID=centers.state_id LEFT JOIN district ON district.DISTRICT_ID=centers.city_id where status = 1");
				    }
				    
				    
					
					
					foreach($get->result() as $row)
					{
					    ?>
					        <tr>
						        <th> <?php 
						            echo $x++;
						            //echo date('d-M-y',strtotime($row->timestamp)); ?> </th>
						        <th><img src="<?=base_url('uploads/'.$row->image)?>" width=550></th>								<th><?php echo $row->center_number;?></th>
								<th><?php echo $row->name; ?></th>
								
								<th><?php echo $row->institute_name; ?></th>
								<th><?php echo $row->center_full_address; ?></th>
							
								
								<th> <?php echo $row->STATE_NAME; ?></th>
								<th><?php echo $row->DISTRICT_NAME; ?></th>
								<th> <a href="tel:<?php echo $profile->ORG_PHONE;?>"><i class="fa fa-phone btn btn-primary"> Call Now</i></a> </th>
								<!--
								<td><a href="notification.php?id='.<?php $row->id ?>.'" class="btn btn-primary"><i class="fa fa-envelope"></i></a></td>';-->
							    <?php
								// if($row->transection_id=='') {
								?>
								   <!--<td><i class="text-danger">no transection</i></td>-->
								<?php
								// } else {
								?>
								<!--    <td><a href="transection_details.php?id='.<?php $row->transection_id ?>.'" class="btn btn-warning"><i class="fa fa-eye"></i></a></td>-->
								    <?php
								    // }
								    ?>
								<!--<td><a href="view_center.php?id='.<?php $row->id ?>.'" class="btn btn-info"><i class="fa fa-edit"></i></a></td>-->
								
						</tr>
				<?php
				}
				?>
			</tbody>
		</table>
		</div>
	</div>
</div>
</div>

