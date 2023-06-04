<div class="page-content">
	<div class="page-header">
		<h1>
			MASTER SETTING
			<small>
				<i class="ace-icon fa fa-angle-double-right"></i>
				User Role &amp; Permission
			</small>
		</h1>
	</div><!-- /.page-header -->
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-xs-12">
					<table id="simple-table" class="table  table-bordered table-hover">
						<thead>
							<tr>
							<th class="center">
								<label class="pos-rel">
								<input type="checkbox" class="ace">
									<span class="lbl"></span>
								</label>
							</th>
							
							<th>CATEGORY</th>
							<th>UPDATE</th>
							<th >DELETE</th>
							<th>VIEW</th>
							<th >ADD</th>
							
							</tr>
						</thead>

						<tbody>
						<?php

						$method = $this->db->get('method_list')->result();
						foreach ($method as $methodlist) {
						
						?>


						<tr>
							<td class="center">
								<label class="pos-rel">
									<input type="checkbox" class="ace">
									<span class="lbl"></span>
								</label>
							</td>
							<td>
								<?php echo $methodlist->METHOD_TITLE;  ?>
							</td>
							<td>
								<label class="pos-rel">
									<input type="checkbox" class="ace">
									<span class="lbl"></span>
								</label>
							</td>
							<td class="hidden-480">
								<label class="pos-rel">
									<input type="checkbox" class="ace">
									<span class="lbl"></span>
								</label>
							</td>
							<td>
								<label class="pos-rel">
									<input type="checkbox" class="ace">
									<span class="lbl"></span>
								</label>
							</td>

							<td class="hidden-480">
								
								<?php
								$method = checkrole_exits(''.$methodlist->METHOD_NAME.'',''.$this->uri->segment(3).'');
           // print_r($method);
				            if (@$method->METHOD_STATUS == '1') {
				             echo'
				             	<label class="pos-rel">
									<input type="checkbox" class="ace assignrole id="'.$methodlist->METHOD_ID.'"  rolename="'.$methodlist->METHOD_NAME.'" roleid="'.$this->uri->segment(3).'"  " checked>
									<span class="lbl"></span>
								</label>
				             '; 
				              
				            }else{

				             echo'<label class="pos-rel">
									<input type="checkbox" class="ace assignrole id="'.$methodlist->METHOD_ID.'"  rolename="'.$methodlist->METHOD_NAME.'" roleid="'.$this->uri->segment(3).'"  " >
									<span class="lbl"></span>
								</label>';
				            }
								?>	
								
							</td>
							
						</tr>
						<?php
						}
						?>
						</tbody>
					</table>
				</div><!-- /.span -->
			</div><!-- /.row -->
			<!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</div>