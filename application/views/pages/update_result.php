
<div class="box box-primary">
	<div class="box-header"><h3>Create Result</h3></div>
	<div class="box-body">
		
<?php 
    $result=$this->db->get_where('results',['id'=>$this->uri->segment(3)])->row();
?>
	    <form  id="update_result"  enctype="multipart/form-data">
	        <input type="hidden" name="result_id" value="<?php echo $this->uri->segment(3)?>">
			
			<?php
				$i=1;
            	$ttl=0;
            	$tot=0;
            	$tot_practical=0;
            	$tot_marks=0;
            	$grand_ttl=0;
            	$grand_total=0;
	
			$marks = $this->db->query("SELECT * FROM marks_table where result_id = '".$this->uri->segment(3)."'");
			foreach($marks->result() as $mm){    
        		$sub = $this->db->query("SELECT * FROM subjects where id = '".$mm->subject_id."'")->row();
        		$total_marks= @$sub->max_marks + @$sub->practical_max_marks;
        		$ob_marks=@$mm->marks + @$mm->practical_marks;
                
                
                echo '  <div class="form-group col-md-3">
							<label style="height:38px;">'.$sub->subject_name.'&nbsp; </label><br> <span class="text-danger">[Max Marks: '.$sub->max_marks.'] | [Min Marks: '.$sub->min_marks.']</span>
							<input type="number" class="form-control" min="0" name="marks_'.@$mm->id.'" placeholder="Enter Marks '.$sub->subject_name.'" value="'.@$ob_marks.'" required>
						</div>';
                
                
                /*
                $bill_list .= '   
                			
                			
                			
                			<tr>
        						    <th style="border: 1px solid;"><b>'.@$i.'</b></th>
        							<th style="border: 1px solid;"><b>'.@$sub->subject_name.'</b></th>
        							<td style="border: 1px solid;">'.@$sub->max_marks.'</td>
        							<td style="border: 1px solid;">'.@$sub->min_marks.'</td>
        							<td style="border: 1px solid;">'.@$mm->marks.'</td>
        							
        							
        							<td style="border: 1px solid;">'.@$sub->practical_max_marks.'</td>
        							<td style="border: 1px solid;">'.@$sub->practical_min_marks.'</td>
        							<td style="border: 1px solid;">'.@$mm->practical_marks.'</td>
        							<td style="border: 1px solid;">'.@$total_marks.'</td>
        							<td style="border: 1px solid;">'.@$ob_marks.'</td>
        				
        							
        					</tr>	';
        					
        		*/			
        				$ttl+=$mm->marks;
        				$tot+=$sub->max_marks;
        				$tot_practical+=$sub->practical_max_marks;
        				$tot_marks+=$mm->practical_marks;
        				$grand_ttl+=$ob_marks;
        				$grand_total+=$total_marks;
        				
        				$i++;
        	}
     
			
			?>
			<div class="form-group col-md-12">
				<button class="btn btn-primary" type="submit" >Submit</button>
			</div>
			
		</form>

	</div>

</div>
