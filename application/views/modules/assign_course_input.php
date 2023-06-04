<div class="col-md-12">
    <form action="" method="POST">
        
    
    <?php
    
    // $this->load->model('center_model');
    $courses = $this->center_model->get_course($center_id);
    
     $get = $this->db->get('courses');
     if($get->num_rows()){
         echo '<ul class="list-group">';
         foreach($get->result() as $row){
             $checked = in_array($row->id,$courses) ? 'checked' : '';
             echo '<li class="list-group-item">
                          <label class="form-check-label" for="item_'.$row->id.'"><input '.$checked.' class="form-check-input course_id" name="courseName[]" type="checkbox" id="item_'.$row->id.'" value="'.$row->id.'"> '.$row->course_name.'</label>
                  </li>';
         }
        echo '</ul>';
     }
     else
        echo '<div class="alert alert-danger">Course Not Availabel.</div>';
    ?>
    </form>
    
</div>