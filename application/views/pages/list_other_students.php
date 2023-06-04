<div class="row">
    <?php
    if($type = $this->input->get('type')){
         $getNumber = (($type == 'urgent') ? 1 : 2);
    ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">List Of Student(s) <?=get_admission_type($getNumber) ?></h3>
        </div>
        <div class="panel-body">
            <?php
            if($_SESSION['type'] == 2)
                $this->db->where('center_id',$_SESSION['loginid']);
            $get = $this->db->get_where('students',['vip' => $getNumber]);
            if($get->num_rows()){
                ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#.</th>
                                <th>Date</th>
                                <th>Enrollment Number</th>
                                <?php
                                if($_SESSION['type'] == 1)
                                    echo '<th>Center</th>';
                                ?>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach($get->result() as $row){
                                echo '<tr>
                                        <td>'.$i++.'.</td>
                                        <td>'.date('d-M-Y',strtotime($row->timestamp)).'</td>
                                        <td>'.$row->enrollment_no.'</td>';
                                    
                                    if($_SESSION['type'] == 1){
                                        $_row = @$this->db->get_where('centers',['id' => $row->center_id])->row()->center_name;
                                        echo '<td>'.@$_row.'</td>';
                                    }
                                        
                                    echo '<td>'.$row->name.'</td>
                                        <td>'.$row->email.'</td>
                                        <td>'.$row->mobile.'</td>
                                      </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                
                <?php
            }
            else{
                echo '<div class="alert alert-danger">Student are not found.</div>';
            }
            ?>
        </div>
    </div>
    <?php
    }
    else{
        echo '<div class="alert alert-danger">Student not found in this area</div>';
    }
    
       // echo '<div class="alert alert-danger">Student not found in this area</div>';
    ?>

</div>