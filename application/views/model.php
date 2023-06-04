


<div class="modal fade" id="model_add_color" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
			</div>
			<form class="form-horizontal tasi-form" id="add_color">
				<div class="modal-body">
					<div class="form-group ">
			            <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">COLOR NAME</label>
			                <div class="col-lg-6">
			                <input type="text" class="form-control" name="color_name" placeholder="COLOR NAME" >
			                </div>
			        </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary btn_add_color">Save </button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="size" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
			</div>
			<form id="add_measurement" class="form-horizontal tasi-form">
				<div class="modal-body">
					<div class="form-group ">
			            <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">SIZE NAME</label>
			                <div class="col-lg-6">
			                <input type="text" name="measurement_name" class="form-control measurement_name" placeholder="SIZE NAME" required="required" >
			                </div>
			        </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary add_measurement">Save </button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="edit_measurement_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
      <form id="update_measurement" class="form-horizontal tasi-form">
        <div class="modal-body">
          <div class="form-group ">
                  <input type="hidden" name="mid" class="mid">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">SIZE NAME</label>
                      <div class="col-lg-6">
                      <input type="text" name="measurement_name" class="form-control mname" placeholder="SIZE NAME" required="required" >
                      </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary update_measurement">Save </button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="create_project" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
			</div>
			<form class="form-horizontal tasi-form">
				<div class="modal-body">
							<div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">PROJECT NAME</label>
                                  <div class="col-lg-10">
                                      <input type="text" class="form-control" id="inputSuccess" placeholder="PROJECT NAME">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputWarning">ITEM CODE</label>
                                  <div class="col-lg-10">
                                      <input type="text" class="form-control" id="inputWarning" placeholder="ITEM CODE">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputError">ITEM SIZE</label>
                                  <div class="col-lg-10">
                                      <input type="text" class="form-control" id="inputError" placeholder="ITEM SIZE">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputError">DIE NUMBER </label>
                                  <div class="col-lg-10">
                                      <input type="text" class="form-control" id="inputError" placeholder="ITEM SIZE">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputError">DIMENSION </label>
                                  <div class="col-lg-10">
                                      <input type="text" class="form-control" id="inputError" placeholder="ITEM SIZE">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputError">DIE IMAGE </label>
                                  <div class="col-lg-10">
                                      <input type="file" class="form-control" id="inputError" placeholder="ITEM SIZE">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputError">PRODUCT IMAGE </label>
                                  <div class="col-lg-10">
                                      <input type="file" class="form-control" id="inputError" placeholder="ITEM SIZE">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputError"> </label>
                                  <div class="col-lg-10">
                                      <button type="submit" class="btn btn-theme">Sign in</button>
                                  </div>
                              </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save </button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_add_firm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
			</div>
			<form class="form-horizontal tasi-form" id="add_firm">
				<div class="modal-body">
							<div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">FIRM NAME</label>
                                  <div class="col-lg-10">
                                      <input type="text" class="form-control" name="firm_name" id="inputSuccess" placeholder="FIRM NAME">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >FIRM NUMBER </label>
                                  <div class="col-lg-10">
                                      <input type="number" name="number" class="form-control" id="inputWarning" placeholder="NUMBER ">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >ADDRESS </label>
                                  <div class="col-lg-10">
                                  	<textarea name="address" class="form-control" placeholder="ADDRESS ">
                                  		
                                  	</textarea>
                                      
                                  </div>
                              </div>
                </div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary add_firm_btn">Save </button>
				</div>
			</form>
		</div>
	</div>
</div>



<div class="modal fade" id="new_production" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
			</div>
			<form class="form-horizontal tasi-form" id="create_project_order">
        <input type="text" name="die_create_status" id="die_create_status" value="0">
				<div class="modal-body">
							              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">PROJECT NAME</label>
                                  <div class="col-lg-10">
                                      <select name="projectid" class="form-control selectpicker get_die_by_projectid" data-live-search="true" required="required" >
                                      	<option value=""> -- Select Project --</option>
                                      	<?php
                                      	$project =	get_allproject(0);
                                      	foreach ($project as $projectlist) {
                                      		echo '<option value="'.$projectlist->PROJECT_ID.'">'.$projectlist->PROJECT_NAME.' ('.$projectlist->PROJECT_CODE.')</option>';
                                      	}
                                      	?>
                                      </select>
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">DIE NAME</label>
                                  <a href="javascript:;" class="replace_die_box"> <span class="badge bg-success pull-right ">+</span></a>
                                  <div class="col-lg-10 " >
                                      
                                      <select name="dieid"  id="dieid_box" class="form-control col-lg-8 dielist "  required="required" >
                                        <option value="0"> -- Select DIE --</option>
                                      </select>
                                      
                                  </div>
                                  
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">THEKEDAR NAME</label>
                                  <div class="col-lg-10">
                                      <select name="thekedarid" class="form-control selectpicker" data-live-search="true" required="required" >
                                      	<option value=""> -- Select Thekedar --</option>
                                      	<?php
                                      	$thekedar =	get_allthekedar(0);
                                      	foreach ($thekedar as $thekedarlist) {
                                      		echo '<option value="'.$thekedarlist->THEKEDAR_ID.'">'.$thekedarlist->THEKEDAR_NAME.' ('.$thekedarlist->THEKEDAR_PHONE.')</option>';
                                      	}
                                      	?>
                                      </select>
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >ITEM WEIGHT </label>
                                  <div class="col-lg-10">
                                      <input type="text" name="item_weight" class="form-control"  placeholder="ITEM WEIGHT " required="required">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >TOTAL WEIGHT </label>
                                  <div class="col-lg-10">
                                  	<input type="text" name="total_weight" id="production_total_weight" class="form-control calculate_production_average" placeholder="TOTAL WEIGHT"  required="required">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-2 control-label col-lg-2" >RECEIVED PCS </label>
                                  <div class="col-lg-10">
                                  	<input type="text" name="recieved_pcs" id="production_received_pcs" class="form-control calculate_production_average" placeholder="RECEIVED PCS"  required="required">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >AVERAGE </label>
                                  <div class="col-lg-10">
                                    <input type="text" name="production_average" id="production_average" class="form-control " placeholder="AVERAGE"  required="required" readonly="readonly">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >COMMENT </label>
                                  <div class="col-lg-10">
                                  	<textarea name="comment" class="form-control" placeholder="Comment HERE"></textarea>
                                  </div>
                              </div>
                </div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary add_firm_btn">Save </button>
				</div>
			</form>
		</div>
	</div>
</div> 
<div class="modal fade" id="edit_new_production_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
      <form class="form-horizontal tasi-form" id="update_create_project_order">
        <div class="modal-body">
                            <input type="hidden" name="productionorderid" class="productionorderid">
                            <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">PROJECT NAME</label>
                                  <div class="col-lg-10">
                                      <select name="projectid" class="form-control selectpicker get_die_by_projectid" data-live-search="true" required="required" >
                                        <option value=""> -- Select Project --</option>
                                        <?php
                                        $project =  get_allproject(0);
                                        foreach ($project as $projectlist) {
                                          echo '<option value="'.$projectlist->PROJECT_ID.'">'.$projectlist->PROJECT_NAME.' ('.$projectlist->PROJECT_CODE.')</option>';
                                        }
                                        ?>
                                      </select>
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">DIE NAME</label>
                                  <div class="col-lg-10">
                                      <select name="dieid" class="form-control dielist"  required="required" >
                                        <option value="0"> -- Select DIE --</option>
                                        
                                      </select>
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">THEKEDAR NAME</label>
                                  <div class="col-lg-10">
                                      <select name="thekedarid" class="form-control selectpicker" data-live-search="true" required="required" >
                                        <option value=""> -- Select Thekedar --</option>
                                        <?php
                                        $thekedar = get_allthekedar(0);
                                        foreach ($thekedar as $thekedarlist) {
                                          echo '<option value="'.$thekedarlist->THEKEDAR_ID.'">'.$thekedarlist->THEKEDAR_NAME.' ('.$thekedarlist->THEKEDAR_PHONE.')</option>';
                                        }
                                        ?>
                                      </select>
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >ITEM WEIGHT </label>
                                  <div class="col-lg-10">
                                      <input type="text" name="item_weight" class="form-control productionitemweight"  placeholder="ITEM WEIGHT " required="required">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >TOTAL WEIGHT </label>
                                  <div class="col-lg-10">
                                    <input type="text" name="total_weight" id="calculate_update_production" class="form-control productiontotalweight" placeholder="TOTAL WEIGHT"  required="required">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >RECEIVED PCS </label>
                                  <div class="col-lg-10">
                                    <input type="text" name="recieved_pcs"  id="calculate_update_production" class="form-control productionreceivedpcs" placeholder="RECEIVED PCS"  required="required">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >AVERAGE </label>
                                  <div class="col-lg-10">
                                    <input type="text" name="recieved_pcs"  id="total_updated_pro_avg" class="form-control total_updated_pro_avg" placeholder="RECEIVED PCS"  required="required" readonly="readonly">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >COMMENT </label>
                                  <div class="col-lg-10">
                                    <textarea name="comment" class="form-control productioncomment" placeholder="Comment HERE"></textarea>
                                  </div>
                              </div>
                </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary update_create_project_order">Save </button>
        </div>
      </form>
    </div>
  </div>
</div> 

<div class="modal fade" id="model_add_new_item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
      <form class="form-horizontal tasi-form" id="create_project_order2">
        <div class="modal-body">
              <div class="form-group ">
                                  <input type="hidden" name="project_stage" class="project_stage">
                                  <label class="col-sm-2 control-label col-lg-2">PROJECT NAME</label>
                                  <div class="col-lg-10">
                                      <select name="projectid" class="form-control selectpicker get_die_by_projectid" data-live-search="true" required="required" >
                                        <option value=""> -- Select Project --</option>
                                        <?php
                                        $project =  get_allproject(0);
                                        foreach ($project as $projectlist) {
                                          echo '<option value="'.$projectlist->PROJECT_ID.'">'.$projectlist->PROJECT_NAME.' ('.$projectlist->PROJECT_CODE.')</option>';
                                        }
                                        ?>
                                      </select>
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">DIE NAME</label>
                                  <div class="col-lg-10">
                                      <select name="dieid" class="form-control dielist"  required="required" >
                                        <option value="0"> -- Select DIE --</option>
                                        
                                      </select>
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">THEKEDAR NAME</label>
                                  <div class="col-lg-10">
                                      <select name="thekedarid" class="form-control selectpicker" data-live-search="true" required="required" >
                                        <option value=""> -- Select Thekedar --</option>
                                        <?php
                                        $thekedar = get_allthekedar(0);
                                        foreach ($thekedar as $thekedarlist) {
                                          echo '<option value="'.$thekedarlist->THEKEDAR_ID.'">'.$thekedarlist->THEKEDAR_NAME.' ('.$thekedarlist->THEKEDAR_PHONE.')</option>';
                                        }
                                        ?>
                                      </select>
                                  </div>
                              </div>
                              
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >RECEIVED PCS </label>
                                  <div class="col-lg-10">
                                    <input type="text" name="recieved_pcs" class="form-control" placeholder="RECEIVED PCS"  required="required">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >TOOT  </label>
                                  <div class="col-lg-10">
                                      <input type="number" name="toot" class="form-control"  placeholder="ITEM TOOT " required="required">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >REJECT  </label>
                                  <div class="col-lg-10">
                                    <input type="number" name="reject" class="form-control" placeholder="TOTAL REJECT"  required="required">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >COMMENT </label>
                                  <div class="col-lg-10">
                                    <textarea name="comment" class="form-control" placeholder="Comment HERE"></textarea>
                                  </div>
                              </div>
                </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary add_firm_btn">Save </button>
        </div>
      </form>
    </div>
  </div>
</div>   

<div class="modal fade" id="new_demand_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">ADD DEMAND</h4>
      </div>
      <form class="form-horizontal tasi-form" id="add_project_demand">
        <div class="modal-body">
                              <div class="form-group ">
                                  <input type="hidden" name="timestamp" class="timestamp" value="<?php echo $this->uri->segment(3); ?>">
                                  <label class="col-sm-2 control-label col-lg-2">DIE NAME</label>
                                  <div class="col-lg-10">
                                      <select class="dieid form-control selectpicker" name="dieid"  data-live-search="true" required="required" >
                                        <option value="0">--Select DIE--</option>
                                        <?php
                                        if (isset($alldie)) {
                                         foreach ($alldie as $die_list) {
                                           echo '<option value="'.$die_list->DIE_ID.'">'.$die_list->DIE_NAME.' - ('.$die_list->DIE_NUMBER.')</option>';
                                         }
                                        }
                                        ?>
                                       
                                      </select>
                                  </div>
                              </div>
                              
                              
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >DEMAND </label>
                                  <div class="col-lg-10">
                                    <input type="text" name="demand" class="form-control" placeholder="DEMAND"  required="required">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >SIZE </label>
                                  <div class="col-lg-10">
                                    <select name="size" class="form-control">
                                      <option value="0">-- Select Size --</option>
                                      <option value="1">INCH</option>
                                      <option value="2">CENTI METER </option>
                                    </select>
                                    
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >COLOR NAME </label>
                                  <div class="col-lg-10">
                                    <input type="text" name="color" class="form-control" placeholder="DEMAND"  required="required">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >PRODUCT TYPE </label>
                                  <div class="col-lg-10">
                                   <select name="product_type" class="form-control">
                                     <option value="0">-- Select Type--</option>
                                     <option value="1">WAX</option>
                                     <option value="2">Fragnance</option>
                                   </select>
                                  
                                  </div>
                              </div>
                               <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >DESCRIPTION </label>
                                  <div class="col-lg-10">
                                    <textarea name="desc" class="form-control" placeholder="Enter Narration Here.."></textarea>
                                   
                                  </div>
                              </div>
                </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary add_project_demand">Save </button>
        </div>
      </form>
       <div class="panel-body">
        <table class="table table-bordered table-striped table-condensed" id="project_demand_list">
          <thead>
            <tr>
              <th>SR NO.</th>
              <th>DIE NAME</th>
              <th>DEMAND </th>
              <th>IMAGE</th>
              <th>ACTION</th>
            </tr>
          </thead>
          <tbody>                            
          </tbody>
        </table>  
      </div>
    </div>
  </div>
</div>

  <div class="modal fade" id="edit_thekedar_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
      <form class="form-horizontal tasi-form" id="update_thekedar_list">
        <div class="modal-body">
          <input type="hidden" name="thekedarid" class="thekedarid">
          <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">THEKEDAR NAME</label>
                      <div class="col-lg-6">
                      <input type="text" name="thekedar_name" class="form-control thekedar_name" placeholder="THEKEDAR NAME" >
                      </div>
          </div>
          <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">THEKEDAR PHONE</label>
                      <div class="col-lg-6">
                      <input type="text" name="thekedar_phone" class="form-control thekedar_phone" placeholder="THEKEDAR_PHONE " >
                      </div>
          </div>
          <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">THEKEDAR ADDRESS</label>
                      <div class="col-lg-6">
                      <input type="text" name="thekedar_address" class="form-control thekedar_address" placeholder="THEKEDAR ADDRESS" >
                      </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary update_thekedar_list">Save </button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="edit_add_new_item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
      <form class="form-horizontal tasi-form" id="update_create_project_order2">
        <div class="modal-body">
                            <input type="hidden" name="chakkaorderid" class="chakkaorderid">
                            <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">PROJECT NAME</label>
                                  <div class="col-lg-10">
                                      <select name="projectid" class="form-control selectpicker get_die_by_projectid" data-live-search="true" required="required" >
                                        <option value=""> -- Select Project --</option>
                                        <?php
                                        $project =  get_allproject(0);
                                        foreach ($project as $projectlist) {
                                          echo '<option value="'.$projectlist->PROJECT_ID.'">'.$projectlist->PROJECT_NAME.' ('.$projectlist->PROJECT_CODE.')</option>';
                                        }
                                        ?>
                                      </select>
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">DIE NAME</label>
                                  <div class="col-lg-10">
                                      <select name="dieid" class="form-control dielist"  required="required" >
                                        <option value="0"> -- Select DIE --</option>
                                        
                                      </select>
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">THEKEDAR NAME</label>
                                  <div class="col-lg-10">
                                      <select name="thekedarid" class="form-control selectpicker" data-live-search="true" required="required" >
                                        <option value=""> -- Select Thekedar --</option>
                                        <?php
                                        $thekedar = get_allthekedar(0);
                                        foreach ($thekedar as $thekedarlist) {
                                          echo '<option value="'.$thekedarlist->THEKEDAR_ID.'">'.$thekedarlist->THEKEDAR_NAME.' ('.$thekedarlist->THEKEDAR_PHONE.')</option>';
                                        }
                                        ?>
                                      </select>
                                  </div>
                              </div>
                              
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >RECEIVED PCS </label>
                                  <div class="col-lg-10">
                                    <input type="text" name="recieved_pcs" class="form-control chakkareceived" placeholder="RECEIVED PCS"  required="required">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >TOOT  </label>
                                  <div class="col-lg-10">
                                      <input type="number" name="toot" class="form-control chakkatoot"  placeholder="ITEM TOOT " required="required">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >REJECT  </label>
                                  <div class="col-lg-10">
                                    <input type="number" name="reject" class="form-control chakkareject" placeholder="TOTAL REJECT"  required="required">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >COMMENT </label>
                                  <div class="col-lg-10">
                                    <textarea name="comment" class="form-control chakkacomment" placeholder="Comment HERE"></textarea>
                                  </div>
                              </div>
                </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary update_create_project_order">Save </button>
        </div>
      </form>
    </div>
  </div>
</div>




<div class="modal fade" id="demand_status_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Update Sample Project Status</h4>
      </div>
      <form class="form-horizontal tasi-form" id="update_demand_status">
        <input type="hidden" name="demandstatusid" class="demandstatusid">
        <div class="modal-body">
          <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">SELECT STATUS</label>
                      <div class="col-lg-6">
                      <select name="status" class="form-control selectpicker" data-live-search="true" required="required">
                        <option value="0"> Select Status</option>
                        <?php 
                        $stage = get_allsamplingstage();
                        foreach ($stage as $stagelist) {
                          echo '<option value="'.$stagelist->PROJECT_STAGE_ID.'">'.$stagelist->STAGE_NAME.'</option>';
                        }
                        ?>  
                        
                      
                      </select>
                     
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




<div class="modal fade" id="finalizing_sample_project_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">  Update Deadlines Sample Project</h4>
      </div>
      <form class="form-horizontal tasi-form" id="demand_deadline">
        <input type="hidden" name="demanddeadlineid" class="demanddeadlineid">
        <div class="modal-body">
          <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">EX-FACTORY DATE</label>
                      <div class="col-lg-6">
                      <input type="text" name="factory_date" class="form-control startdate" placeholder="FACTORY DATE" value="<?php echo date('d-m-Y') ?>" required="required" >
                      </div>
          </div>
          <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">PORT DATE</label>
                      <div class="col-lg-6">
                      <input type="text" name="port_date" class="form-control startdate" placeholder="PORT DATE" value="<?php echo date('d-m-Y') ?>" required="required" >
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


<div class="modal fade" id="demand_cancelled_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"> Demand Cancelled Sample Project</h4>
      </div>
      <form class="form-horizontal tasi-form" id="demand_cancelled">
        <input type="hidden" name="demandcancelledid" class="demandcancelledid">
        <div class="modal-body">
          <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">DATE</label>
                      <div class="col-lg-6">
                      <input type="text" name="date" class="form-control startdate" placeholder=" DATE" value="<?php echo date('d-m-Y') ?>" required="required" >
                      </div>
          </div>
          <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">DESC</label>
                    <div class="col-lg-6">
                    <textarea name="desc" class="form-control" placeholder="DESCRIPTION" required="required"></textarea>
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



<div class="modal fade" id="model_add_new_blower" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">ADD <?php echo $title; ?></h4>
      </div>
      <form class="form-horizontal tasi-form" id="add_new_blower">
        <div class="modal-body">
             
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">BLOWER NAME</label>
                                  <div class="col-lg-10">
                                      <input type="text" name="blower_name" class="form-control" placeholder="BLOWER NAME">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">BLOWER PHONE</label>
                                  <div class="col-lg-10">
                                     <input type="number" name="blower_number" class="form-control" placeholder="BLOWER PHONE">
                                  </div>
                              </div>
                              
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >BLOWER ADDRESS </label>
                                  <div class="col-lg-10">
                                    <input type="text" name="blower_address" class="form-control" placeholder="BLOWER ADDRESS "  required="required">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >COMMENT </label>
                                  <div class="col-lg-10">
                                    <textarea name="comment" class="form-control" placeholder="Comment HERE"></textarea>
                                  </div>
                              </div>
                </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary add_firm_btn">Save </button>
        </div>
      </form>
    </div>
  </div>
</div>



  <div class="modal fade" id="edit_blower_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
      <form class="form-horizontal tasi-form" id="update_blower_list">
        <div class="modal-body">
          <input type="hidden" name="blowerid" class="blowerid">
          <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">THEKEDAR NAME</label>
                      <div class="col-lg-6">
                      <input type="text" name="blower_name" class="form-control blower_name" placeholder="BLOWER NAME" >
                      </div>
          </div>
          <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">THEKEDAR PHONE</label>
                      <div class="col-lg-6">
                      <input type="text" name="blower_phone" class="form-control blower_phone" placeholder="BLOWER PHONE " >
                      </div>
          </div>
          <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">THEKEDAR ADDRESS</label>
                      <div class="col-lg-6">
                      <input type="text" name="blower_address" class="form-control blower_address" placeholder="BLOWER ADDRESS" >
                      </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary update_blower_list">Save </button>
        </div>
      </form>
    </div>
  </div>
</div>

  <div class="modal fade" id="edit_factory_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
      <form class="form-horizontal tasi-form" id="update_factory_list">
        <div class="modal-body">
          <input type="hidden" name="factoryid" class="factoryid">
          <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">FACTORY NAME</label>
                      <div class="col-lg-6">
                      <input type="text" name="factory_name" class="form-control factory_name" placeholder="THEKEDAR NAME" >
                      </div>
          </div>
          <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">FACTORY PHONE</label>
                      <div class="col-lg-6">
                      <input type="text" name="factory_phone" class="form-control factory_phone" placeholder="FACTORY PHONE " >
                      </div>
          </div>
          <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">FACTORY ADDRESS</label>
                      <div class="col-lg-6">
                      <input type="text" name="factory_address" class="form-control factory_address" placeholder="FACTORY ADDRESS" >
                      </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary update_factory_list">Save </button>
        </div>
      </form>
    </div>
  </div>
</div>





<div class="modal fade" id="model_add_new_adda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
      <form class="form-horizontal tasi-form" id="add_new_adda">
        <div class="modal-body">
                            <div class="form-group">
                                
                              <label class="col-sm-2 control-label col-lg-2">PROJECT NAME</label>
                              <div class="col-lg-10">
                                  <input type="text" name="projectid" class="form-control" >
                                     <!--  <select name="projectid" class="form-control selectpicker get_die_by_projectid" data-live-search="true" required="required" >
                                        <option value=""> -- Select Project --</option>
                                        <?php
                                        $project =  get_allproject(0);
                                        foreach ($project as $projectlist) {
                                          echo '<option value="'.$projectlist->PROJECT_ID.'">'.$projectlist->PROJECT_NAME.' ('.$projectlist->PROJECT_CODE.')</option>';
                                        }
                                        ?>
                                      </select> -->
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">DIE NAME</label>
                                  <div class="col-lg-10">
                                      <input type="text" name="dieid" class="form-control">
                                      <!-- <select name="dieid" class="form-control dielist"  required="required" >
                                        <option value="0"> -- Select DIE --</option>
                                        
                                      </select> -->
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">BLOWER NAME</label>
                                  <div class="col-lg-8">
                                      <select name="blowerid" id="firm_blower" class="form-control selectpicker" data-live-search="true" required="required" >
                                        <option value=""> -- Select Blower --</option>
                                        <?php
                                        $blower = get_allblower();
                                        foreach ($blower as $blowerlist) {
                                          echo '<option value="'.$blowerlist->BLOWER_ID.'">'.$blowerlist->BLOWER_NAME.' ('.$blowerlist->BLOWER_PHONE.')</option>';
                                        }
                                        ?>
                                      </select>
                                  </div><i class="fa fa-plus btn btn-primary" data-toggle="modal" data-target="#model_add_new_firm_blower">ADD</i>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">FACTORY NAME</label>
                                  <div class="col-lg-8">
                                      <select name="factoryid" id="firm_type_id" class="form-control selectpicker" data-live-search="true" required="required" >
                                        <option value=""> -- Select Factory --</option>
                                        <?php
                                        $factory = get_allfactory();
                                        foreach ($factory as $factorylist) {
                                          echo '<option value="'.$factorylist->FACTORY_ID.'">'.$factorylist->FACTORY_NAME.' ('.$factorylist->FACTORY_PHONE.')</option>';
                                        }
                                        ?>
                                      </select>
                                  </div><i class="fa fa-plus btn btn-primary" data-toggle="modal" data-target="#model_add_new_factory">ADD</i>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">ADDA TYPE (अड़ड़े का प्रकार)</label>
                                  <div class="col-lg-8">
                                      <select name="adda_type" id="adda_type_id" class="form-control selectpicker" data-live-search="true" required="required" >
                                        <option value="0"> -- Select Adda Type --</option>
                                        <?php
                                        $addatype = get_alladdatype();
                                        foreach ($addatype as $addatypelist) {
                                          echo '<option value="'.$addatypelist->ADDA_TYPE_ID.'">'.$addatypelist->ADDA_NAME.'</option>';
                                        }
                                        ?>
                                      </select>
                                  </div><i class="fa fa-plus btn btn-primary" data-toggle="modal" data-target="#model_add_new_adda_type">ADD</i>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >GLASS WEIGHT  </label>
                                  <div class="col-lg-10">
                                      <input type="text" name="total_weight" id="adda_glassweight" class="form-control adda_average_weight"  placeholder="GLASS WEIGHT"  required="required">
                                  </div>
                              </div>
                               <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >RECEIVED PCS </label>
                                  <div class="col-lg-10">
                                    <input type="text" name="recieved_pcs" id="adda_recieved_pcs"  class="form-control adda_average_weight" placeholder="RECEIVED PCS" required="required">
                                  </div>
                              </div>
                             <!--  <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >AVERAGE WEIGHT  </label>
                                  <div class="col-lg-10"> -->
                                      <input type="hidden" name="average_weight" id="add_average_weight" class="form-control"  placeholder="AVERAGE WEIGHT " required="required">
                                  <!-- </div>
                              </div> -->
                             
                              
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >QUANTITY (अड्डा चले ) </label>
                                  <div class="col-lg-10">
                                    <input type="text" name="quantity" class="form-control" placeholder="QUANTITY"  required="required">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >DATE </label>
                                  <div class="col-lg-10">
                                    <input type="text" name="date" class="form-control startdate" placeholder="DATE"  required="required" value="<?php echo date('d-m-Y'); ?>">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >COMMENT </label>
                                  <div class="col-lg-10">
                                    <textarea name="comment" class="form-control" placeholder="Comment HERE"></textarea>
                                  </div>
                              </div>
                </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary add_firm_btn">Save </button>
        </div>
      </form>
    </div>
  </div>
</div>




<div class="modal fade" id="cancelled_sample_project_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Cancelled Sample Project</h4>
      </div>
      <form class="form-horizontal tasi-form" id="cancelled_sample_project">
        <input type="hidden" name="sample_projectid" class="cancell_projectid">
        <div class="modal-body">
          <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">DATE</label>
                      <div class="col-lg-6">
                      <input type="text" name="date" class="form-control startdate" placeholder="FACTORY DATE" value="<?php echo date('d-m-Y') ?>" >
                      </div>
          </div>
          <div class="form-group ">
                <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">Description</label>
                  <div class="col-lg-6">
                  <textarea name="desc" class="form-control"></textarea>  
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



<div class="modal fade" id="cancelled_project_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Cancelled Project</h4>
      </div>
      <form class="form-horizontal tasi-form" id="cancelled_project">
        <input type="hidden" name="projectid" class="cancell_projectid2">
        <div class="modal-body">
          <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">DATE</label>
                      <div class="col-lg-6">
                      <input type="text" name="date" class="form-control startdate" placeholder="FACTORY DATE" value="<?php echo date('d-m-Y') ?>" >
                      </div>
          </div>
          <div class="form-group ">
                <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">Description</label>
                  <div class="col-lg-6">
                  <textarea name="desc" class="form-control"></textarea>  
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





<div class="modal fade" id="project_status_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Update Project Status</h4>
      </div>
      <form class="form-horizontal tasi-form" id="update_demand_status2">
        <input type="hidden" name="demandstatusid" class="demandstatusid2">
        <div class="modal-body">
          <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">SELECT STATUS</label>
                      <div class="col-lg-6">
                      <select name="status" class="form-control selectpicker" data-live-search="true" required="required">
                        <option value="0"> Select Status</option>
                        <?php 
                        $stage = get_allsamplingstage();
                        foreach ($stage as $stagelist) {
                          echo '<option value="'.$stagelist->PROJECT_STAGE_ID.'">'.$stagelist->STAGE_NAME.'</option>';
                        }
                        ?>  
                        
                      
                      </select>
                     
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




<div class="modal fade" id="project_deadline_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">  Update Deadlines Project</h4>
      </div>
      <form class="form-horizontal tasi-form" id="demand_deadline2">
        <input type="hidden" name="demanddeadlineid" class="demanddeadlineid2">
        <div class="modal-body">
          <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">EX-FACTORY DATE</label>
                      <div class="col-lg-6">
                      <input type="text" name="factory_date" class="form-control startdate" placeholder="FACTORY DATE" value="<?php echo date('d-m-Y') ?>" required="required" >
                      </div>
          </div>
          <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">PORT DATE</label>
                      <div class="col-lg-6">
                      <input type="text" name="port_date" class="form-control startdate" placeholder="PORT DATE" value="<?php echo date('d-m-Y') ?>" required="required" >
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


<div class="modal fade" id="project_cancelled_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"> Demand Cancelled Project</h4>
      </div>
      <form class="form-horizontal tasi-form" id="demand_cancelled2">
        <input type="hidden" name="demandcancelledid" class="demandcancelledid2">
        <div class="modal-body">
          <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">DATE</label>
                      <div class="col-lg-6">
                      <input type="text" name="date" class="form-control startdate" placeholder=" DATE" value="<?php echo date('d-m-Y') ?>" required="required" >
                      </div>
          </div>
          <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">DESC</label>
                    <div class="col-lg-6">
                    <textarea name="desc" class="form-control" placeholder="DESCRIPTION" required="required"></textarea>
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


<div class="modal fade" id="model_add_new_adda_type" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"> ADDA TYPE </h4>
      </div>
      <form class="form-horizontal tasi-form" id="adda_new_type">
        <div class="modal-body">
          <div class="form-group ">
            <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">ADDA TYPE</label>
              <div class="col-lg-6">
                 <input type="text" name="adda_type" class="form-control " placeholder="ADDA TYPE"  >
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



<div class="modal fade" id="update_labour_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"> UPDATE LABOUR </h4>
      </div>
      <form class="form-horizontal tasi-form" id="update_labour">
        <input type="hidden" name="labourid" class="labourid">
        <div class="modal-body">
          <div class="form-group ">
            <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">LABOUR NAME</label>
              <div class="col-lg-6">
                 <input type="text" name="labour_name" class="form-control labour_name" placeholder="LABOUR NAME"  >
              </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">LABOUR PHONE</label>
              <div class="col-lg-6">
                 <input type="text" name="labour_phone" class="form-control labour_phone" placeholder="LABOUR PHONE"  >
              </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">LABOUR ADDRESS</label>
              <div class="col-lg-6">
                 <input type="text" name="labour_address" class="form-control labour_address" placeholder="LABOUR ADDRESS"  >
              </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">LEAVE APPROVED </label>
              <div class="col-lg-6">
                 <input type="text" name="labour_amount" class="form-control labour_amount" placeholder="LEAVE APPROVED"  >
              </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">GROSS SALARY </label>
              <div class="col-lg-6">
                 <input type="text" name="gross_amount" class="form-control gross_amount" placeholder="GROSS SALARY"  >
              </div>
          </div>
           <div class="form-group ">
            <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">CREATION DATE</label>
              <div class="col-lg-6">
                 <input type="text" name="labour_date" class="labour_date form-control startdate " placeholder="CREATION DATE"  >
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


<div class="modal fade" id="model_add_new_factory" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"> ADD FACTORY </h4>
      </div>
      <form class="form-horizontal tasi-form" id="add_new_factory">
        <div class="modal-body">
          <div class="form-group ">
            <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">FACTORY NAME</label>
              <div class="col-lg-6">
                 <input type="text" name="factory_name" class="form-control " placeholder="FACTORY NAME"  >
              </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">FACTORY PHONE</label>
              <div class="col-lg-6">
                 <input type="text" name="factory_number" class="form-control " placeholder="FACTORY PHONE"  >
              </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">FACTORY ADDRESS</label>
              <div class="col-lg-6">
                 <input type="text" name="factory_address" class="form-control " placeholder="FACTORY ADDRESS"  >
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




<div class="modal fade" id="model_add_new_firm_blower" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">ADD <?php echo $title; ?></h4>
      </div>
      <form class="form-horizontal tasi-form" id="add_new_firm_blower">
        <div class="modal-body">
             
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">BLOWER NAME</label>
                                  <div class="col-lg-10">
                                      <input type="text" name="blower_name" class="form-control" placeholder="BLOWER NAME">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">BLOWER PHONE</label>
                                  <div class="col-lg-10">
                                     <input type="number" name="blower_number" class="form-control" placeholder="BLOWER PHONE">
                                  </div>
                              </div>
                              
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >BLOWER ADDRESS </label>
                                  <div class="col-lg-10">
                                    <input type="text" name="blower_address" class="form-control" placeholder="BLOWER ADDRESS "  required="required">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >COMMENT </label>
                                  <div class="col-lg-10">
                                    <textarea name="comment" class="form-control" placeholder="Comment HERE"></textarea>
                                  </div>
                              </div>
                </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary add_firm_btn">Save </button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="model_add_new_sample" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
      <form class="form-horizontal tasi-form" id="add_purchase_sample">
        <div class="modal-body">
                             <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">DATE </label>
                                  <div class="col-lg-10">
                                      <input type="text" name="creation_date" class="form-control startdate" required="required" value="<?php echo date('d-m-Y'); ?>">
                                  </div>
                              </div>
                              
                               <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">NAME/NO </label>
                                  <div class="col-lg-6">
                                      <input type="text" name="sampling_name" class="form-control" placeholder="SAMPLING NAME"  required="required">
                                  </div>
                                  <div class="col-lg-4">
                                      <input type="text" name="sampling_no" class="form-control" placeholder="SAMPLING NO" >
                                  </div>
                              </div>
                              
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">DIMENSION </label>
                                  <div class="col-lg-3">
                                     <input type="text" name="length" class="form-control" placeholder="LENGTH" required="required">
                                  </div>
                                  <div  class="col-lg-3">
                                    <input type="text" name="width" class="form-control" placeholder="WIDTH" required="required">
                                  </div>
                                  <div  class="col-lg-2">
                                    <input type="text" name="height" class="form-control" placeholder="HEIGHT">
                                  </div>
                                  <div  class="col-lg-2">
                                    <input type="text" name="weight" class="form-control" placeholder="WEIGHT">
                                  </div>
                              </div>
                              
                              
                               <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >ITEM  </label>
                                  <div class="col-lg-6">
                                    <input type="text" name="received_by" class="form-control" placeholder="RECEIVED BY">
                                  </div>
                                  <div class="col-lg-4">
                                    <input type="text" name="send_by" class="form-control" placeholder="SEND BY" >
                                  </div>
                              </div>
                              
                              <div class="form-group ">
                                <label class="col-sm-2 control-label col-lg-2" for="inputSuccess"> INWARD</label>
                                    <div class="col-lg-6">
                                    <select class="form-control" name="inwardpartyid">
                                      <option value="0">-- Select Party --</option>
                                      <?php
                                      $party = get_sample_party(1,1);
                                      foreach ($party as $parties) {
                                        echo '<option value="'.$parties->SAMPLE_PARTY_ID.'">'.$parties->NAME.'</option>';
                                      }
                                      ?>
                                    </select>
                                    </div>
                                    <div class="col-lg-4">
                                     <input type="text" name="inward_quantity" class="form-control" placeholder="INWARD ITEM"  >
                                    </div>
                               </div>
                              
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >OUTWARD </label>
                                  <div class="col-lg-6">
                                    <select class="form-control" name="outwardpartyid">
                                      <option value="0">-- Select Party --</option>
                                      <?php
                                      $party = get_sample_party(1,1);
                                      foreach ($party as $parties) {
                                        echo '<option value="'.$parties->SAMPLE_PARTY_ID.'">'.$parties->NAME.'</option>';
                                      }
                                      ?>
                                    </select>
                                    </div>
                                  <div class="col-lg-4">
                                    <input type="text" name="outward_quantity" class="form-control" placeholder="OUTWARD ITEM">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >IMAGE  </label>
                                  <div class="col-lg-10">
                                      <input type="file" name="piece_image" class="form-control">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">DESCRIPTION </label>
                                  <div class="col-lg-10">
                                      <textarea name="desc" class="form-control">
                                      </textarea>
                                  </div>
                              </div>
                </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary add_purchase_sample_btn">Save </button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="model_add_sample_party" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">ADD PARTY</h4>
      </div>
      <form class="form-horizontal tasi-form" id="add_sample_party">
        <div class="modal-body">
                             <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">NAME </label>
                                  <div class="col-lg-10">
                                      <input type="text" name="name" class="form-control" placeholder="NAME" >
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">PHONE </label>
                                  <div class="col-lg-10">
                                      <input type="text" name="phone" class="form-control" placeholder="PHONE"  >
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">ADDRESS </label>
                                  <div class="col-lg-10">
                                      <input type="text" name="address" class="form-control" placeholder="address"  >
                                  </div>
                              </div>
                              
                </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary add_purchase_sample_party_btn">Save </button>
        </div>
      </form>
    </div>
  </div>
</div>



<div class="modal fade" id="model_update_add_new_sample" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
      <form class="form-horizontal tasi-form" id="update_add_purchase_sample">
        <input type="hidden" name="sampleid" class="sampleid">
        <div class="modal-body">
                             <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">CREATION DATE </label>
                                  <div class="col-lg-10">
                                      <input type="text" name="creation_date" class="form-control startdate" value="<?php echo date('d-m-Y'); ?>">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">SAMPLE PARTIES</label>
                                      <div class="col-lg-10">
                                      <select class="form-control" name="partyid">
                                        <?php
                                        $party = get_sample_party(1,1);
                                        foreach ($party as $parties) {
                                          echo '<option value="'.$parties->SAMPLE_PARTY_ID.'">'.$parties->NAME.'</option>';
                                        }
                                        ?>
                                      </select>
                                      </div>
                              </div>
                               <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">SAMPLING NAME </label>
                                  <div class="col-lg-10">
                                      <input type="text" name="sampling_name" class="form-control sample_name"  >
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">SAMPLING NO </label>
                                  <div class="col-lg-8">
                                      <input type="text" name="sampling_no" class="form-control sample_no"  >
                                  </div><i class="fa fa-plus btn btn-primary" data-toggle="modal" data-target="#model_add_new_firm_blower"> GEN </i>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">DIMENSION NAME</label>
                                  <div class="col-lg-2">
                                     <input type="text" name="length" class="form-control sample_length" placeholder="LENGTH">
                                  </div>
                                  <div  class="col-lg-2">
                                    <input type="text" name="width" class="form-control sample_width" placeholder="WIDTH">
                                  </div>
                                  <div  class="col-lg-2">
                                    <input type="text" name="height" class="form-control sample_height" placeholder="HEIGHT">
                                  </div>

                              </div>
                              
                              
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >IMAGE  </label>
                                  <div class="col-lg-10">
                                      <input type="file" name="piece_image" class="form-control">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">DESCRIPTION </label>
                                  <div class="col-lg-10">
                                      <textarea name="desc" class="form-control sample_description">
                                      </textarea>
                                  </div>
                              </div>
                </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary update_add_new_sample_btn">Save </button>
        </div>
      </form>
    </div>
  </div>
</div>



<div class="modal fade" id="outward_sample_product_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">OUTWARD</h4>
      </div>
      <form class="form-horizontal tasi-form" id="outward_sample_product">
        <input type="hidden" name="outwardid" class="outwardid">
        <div class="modal-body">
               <input type="hidden" class="form-control outwardid" name="projectid" placeholder="OUTWARD SAMPLE " >
              <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">SAMPLE PARTIES</label>
                      <div class="col-lg-6">
                      <select class="form-control" name="partyid">
                        <?php
                        $party = get_sample_party(1,1);
                        foreach ($party as $parties) {
                          echo '<option value="'.$parties->SAMPLE_PARTY_ID.'">'.$parties->NAME.'</option>';
                        }
                        ?>
                      </select>
                      </div>
              </div>
              <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">SAMPLE QTY</label>
                      <div class="col-lg-6">
                      <input type="text" name="quantity" class="form-control">
                      </div>
              </div>
              <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">ORDER DATE</label>
                      <div class="col-lg-6">
                      <input type="text" name="order_date" class="form-control startdate" value="<?php echo date('d-m-Y'); ?>">
                      </div>
              </div>
              <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> ITEM WIGHT </label>
                      <div class="col-lg-6">
                      <input type="text" name="item_weight" class="form-control" placeholder="ENTER ITEM WEIGHT">
                      </div>
              </div>
              <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">ORDER NARRATION</label>
                      <div class="col-lg-6">
                      <textarea name="order_narration"  class="form-control">
                        
                      </textarea>
                      </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary outward_btn">Save </button>
        </div>
      </form>
    </div>
  </div>
</div>



<div class="modal fade" id="inward_sample_product_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">INWARD ITEM</h4>
      </div>
      <form class="form-horizontal tasi-form" id="inward_sample_product">
        <input type="hidden" name="projectid" class="inwardid">
        <div class="modal-body">
           <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">SAMPLE PARTIES</label>
                      <div class="col-lg-6">
                      <select class="form-control" name="partyid">
                        <?php
                        $party = get_sample_party(1,1);
                        foreach ($party as $parties) {
                          echo '<option value="'.$parties->SAMPLE_PARTY_ID.'">'.$parties->NAME.'</option>';
                        }
                        ?>
                      </select>
                      </div>
              </div>
              <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">SAMPLE QTY</label>
                      <div class="col-lg-6">
                      <input type="text" name="quantity" class="form-control " placeholder="QUANTITY">
                      </div>
              </div>
              <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">ORDER DATE</label>
                      <div class="col-lg-6">
                      <input type="text" name="order_date" class="form-control startdate " value="<?php echo date('d-m-Y'); ?>">
                      </div>
              </div>
              
              <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> ITEM WIGHT </label>
                      <div class="col-lg-6">
                      <input type="text" name="item_weight" class="form-control " placeholder="ENTER ITEM WEIGHT">
                      </div>
              </div>
              <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">ORDER NARRATION</label>
                      <div class="col-lg-6">
                      <textarea name="order_narration"  class="form-control">
                        
                      </textarea>
                      </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary inward_btn">Save </button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="update_inward_outward_sample_product_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">UPDATE INWARD OUTWARD ITEM</h4>
      </div>
      <form class="form-horizontal tasi-form" id="update_inward_sample_product">
        <input type="hidden" name="projectid" class="sample_record_projectid">
        <input type="hidden" name="projectrecordid" class="edit_recordid">
        <input type="hidden" name="sample_in_out" class="sample_in_out" value="0">
        <div class="modal-body">
           <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">SAMPLE PARTIES</label>
                      <div class="col-lg-6">
                      <select class="form-control" name="partyid">
                        <?php
                        $party = get_sample_party(1,1);
                        foreach ($party as $parties) {
                          echo '<option value="'.$parties->SAMPLE_PARTY_ID.'">'.$parties->NAME.'</option>';
                        }
                        ?>
                      </select>
                      </div>
              </div>
              <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">SAMPLE QTY</label>
                      <div class="col-lg-6">
                      <input type="text" name="quantity" class="form-control sample_record_order_quantity" placeholder="QUANTITY">
                      </div>
              </div>
              <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">ORDER DATE</label>
                      <div class="col-lg-6">
                      <input type="text" name="order_date" class="form-control startdate sample_record_order_date" value="<?php echo date('d-m-Y'); ?>">
                      </div>
              </div>
              
              <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess"> ITEM WIGHT </label>
                      <div class="col-lg-6">
                      <input type="text" name="item_weight" class="form-control sample_record_order_item_weight" placeholder="ENTER ITEM WEIGHT">
                      </div>
              </div>
              <div class="form-group ">
                  <label class="col-sm-2 control-label col-lg-3" for="inputSuccess">ORDER NARRATION</label>
                      <div class="col-lg-6">
                      <textarea name="order_narration"  class="form-control sample_record_order_narration">
                        
                      </textarea>
                      </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary inward_btn">Save </button>
        </div>
      </form>
    </div>
  </div>
</div>







<div class="modal fade" id="model_add_new_outwards" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
      <form class="form-horizontal tasi-form" id="add_new_outwards">
        <div class="modal-body">
                            <div class="form-group">
                                
                              <label class="col-sm-2 control-label col-lg-2">PARTY NAME</label>
                              <div class="col-lg-10">
                                  <input type="text" name="party_name" class="form-control" >
                                    
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">DIE NAME</label>
                                  <div class="col-lg-10">
                                      
                                      <select name="dieid" class="form-control dielist"  required="required" >
                                        <option value="0"> -- Select DIE --</option>
                                        <?php
                                         $die =  get_all_die_by_status(1);
                                         foreach ($die as $dielist) {
                                          echo '<option value="'.$dielist->DIE_ID.'"> '.$dielist->DIE_NAME.' </option>';
                                          
                                         }
                                        ?>
                                        
                                        
                                      </select>
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >QUANTITY  </label>
                                  <div class="col-lg-10">
                                    <input type="text" name="quantity" class="form-control" placeholder="QUANTITY"  required="required">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >DATE </label>
                                  <div class="col-lg-10">
                                    <input type="text" name="date" class="form-control startdate" placeholder="DATE"  required="required" value="<?php echo date('d-m-Y'); ?>">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >COMMENT </label>
                                  <div class="col-lg-10">
                                    <textarea name="comment" class="form-control" placeholder="Comment HERE"></textarea>
                                  </div>
                              </div>
                </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary add_firm_btn">Save </button>
        </div>
      </form>
    </div>
  </div>
</div> 



<div class="modal fade" id="model_add_labour_advance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
      <form class="form-horizontal tasi-form" id="add_new_outwards">
        <div class="modal-body">
                            
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">LABOUR NAME</label>
                                  <div class="col-lg-10">
                                      
                                      <select name="thekedarid" id="labour_report_id" class="form-control selectpicker " data-live-search="true" required="required" >
                                        <option value="all"> -- Select All Labour --</option>
                                        <?php
                                       // $labour = get_all_labour(0);
                                        foreach ($labour as $labourlist) {
                                          echo '<option value="'.$labourlist->LABOUR_ID.'">'.$labourlist->LABOUR_NAME.' ('.$labourlist->LABOUR_PHONE.')</option>';
                                        }
                                        ?>
                                      </select>
                                  </div>
                              </div>
                             
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >DATE </label>
                                  <div class="col-lg-10">
                                    <input type="text" name="date" class="form-control startdate" placeholder="DATE"  required="required" value="<?php echo date('d-m-Y'); ?>">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >COMMENT </label>
                                  <div class="col-lg-10">
                                    <textarea name="comment" class="form-control" placeholder="Comment HERE"></textarea>
                                  </div>
                              </div>
                </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary add_firm_btn">Save </button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="model_add_labour_leave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
      <form class="form-horizontal tasi-form" id="add_new_outwards">
        <div class="modal-body">
                            
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2">LABOUR NAME</label>
                                  <div class="col-lg-10">
                                      
                                      <select name="thekedarid" id="labour_report_id" class="form-control selectpicker " data-live-search="true" required="required" >
                                        <option value="all"> -- Select All Labour --</option>
                                        <?php
                                       
                                        foreach ($labour as $labourlist) {
                                          echo '<option value="'.$labourlist->LABOUR_ID.'">'.$labourlist->LABOUR_NAME.' ('.$labourlist->LABOUR_PHONE.')</option>';
                                        }
                                        ?>
                                      </select>
                                  </div>
                              </div>
                             
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >DATE </label>
                                  <div class="col-lg-10">
                                    <input type="text" name="date" class="form-control startdate" placeholder="DATE"  required="required" value="<?php echo date('d-m-Y'); ?>">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" >COMMENT </label>
                                  <div class="col-lg-10">
                                    <textarea name="comment" class="form-control" placeholder="Comment HERE"></textarea>
                                  </div>
                              </div>
                </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary add_firm_btn">Save </button>
        </div>
      </form>
    </div>
  </div>
</div>                    