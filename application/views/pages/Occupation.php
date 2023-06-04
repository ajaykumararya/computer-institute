<?php
$row = $this->db->get_where('business_list',['BUSSINESS_ID'=> @$this->uri->segment(3) ])->row();

?>

<div class="row">
  <div class="col-xs-12 col-sm-6">
    <div class="widget-box">
      <div class="widget-header">
        <h4 class="widget-title"> Add <?php echo $title; ?> </h4>
      </div>
      <div class="widget-body">
        <div class="widget-main">
          <form action="" id="add_occupation" method="post" class="form-inline" enctype="multipart/form-data">
              <?php
              if(@$this->uri->segment(3)!=''){
                  echo '<input type="hidden" name="businessid" value="'.@$this->uri->segment(3).'" >';
              }
              ?>
              
            <div class="profile-user-info profile-user-info-striped">
              <div class="profile-info-row">
                <div class="profile-info-name"> <?php echo $title; ?> NAME </div>
                <div class="profile-info-value">
                  <input type="text" name="name" class="col-sm-12 col-xs-12" value="<?php echo  @$row->BUSINESS_NAME; ?>">
                  
                </div>
              </div>
              
             
              
              
              <div class="profile-info-value">
               
              </div>
            </div>
            <div class="form-actions center">
              <button type="submit" class="btn btn-sm btn-success">
                ADD CATEGORY
                <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>       
</div>                   
                    




<div class="page-header">
	<h1>
		VHTEC
		<small>
			<i class="ace-icon fa fa-angle-double-right"></i>
			OCCUPATION LIST
		</small>
	</h1>
</div>
<div class="row">
	<div class="col-xs-12">
		<table  class="table table-striped table-bordered table-hover dataTable no-footer" id="occupation_list">
			<thead>
				<tr>
					<th>SR. NO </th>
					<th><?php echo $title; ?> NAME</th>
					<th>ACTION</th>
					
					
				</tr>
			</thead>

			<tbody>
				<tr>
					<td> </td>
					<td> </td>
					<td> </td>
					
				</tr>
			</tbody>
		</table>
	</div><!-- /.span -->
</div>