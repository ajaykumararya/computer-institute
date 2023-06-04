
<div class="row">
    <?php
    if(!$course->fees){
        echo '<div class="col-md-12"><div class="alert alert-danger"><b>Alert</b>, This Course fees is zeero.</div></div>';
    }
    
    ?>
    <div class="col-md-4">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Course Info</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Course Name</th>
                        <td><?=$course->course_name?></td>
                    </tr>
                    <tr>
                        <th>Duration </th>
                        <td><?php
                        if($course->type ==1 || $course->type == 3 ){
        			        $duration= $course->duration;
        			    }elseif($course->type==2){
        			        $duration=$course->years;
        			    }
                        echo getDurationName($duration,$course->type,false);
                         
                        ?></td>
                    </tr>
                    <tr>
                        <th>Course Fee</th>
                        <td><?=$course->fees?> <i class="fa fa-rupee"></i></td>
                    </tr>
                    <tr>
                        <th>Payable Amount</th>
                        <td><?php
                        $payableAmount = 0;
                        if($course->type ==1){
                            echo $payableAmount = ($course->fees - $total_collect_fee);
                        }
                        
                        ?> <i class="fa fa-rupee"></i></td>
                    </tr>
                    <tr>
                        <th>Total Collect Fee</th>
                        <td><?=$total_collect_fee?> <i class="fa fa-rupee"></i></td>
                    </tr>
                </table>
            </div> 
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title">Create Transaction</h3>
            </div>
            <div class="panel-body">
                
                <div class="form-group">
                    <label>Your Wallet Ammount is <strong><?=$this->center_model->get_wallet($_SESSION['loginid'])?> <i class="fa fa-rupee"></i></strong>.</label>
                </div>
                
                <div class="form-group">
                    <label>Enter Payable Amount</label>
                    <input type="number" id="amount" class="form-control" placeholder="Enter Amount" autofocus>
                </div>
                
                
            </div>
            <div class="panel-footer">
                <button type="button" class="btn btn-success payfee" data-course_id="<?=$course->id?>" data-duration="<?=$duration?>" data-enroll_no="<?=$enroll_id?>"><i class="fa fa-save"></i> Pay</button>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">This Course Transactions</h3>
            </div>
            <div class="panel-body">
                <?php
                $alls = $this->center_model->get_collection_transaction($course->id);
                if($alls->num_rows()){
                    echo '<table class="table table-borderd">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Duration</th>
                            </tr>
                            </thead><tbody>';
                    foreach($alls->result() as $row){
                        echo '<tr>
                                <td>'.$row->time.'</td>
                                <td>'.date('d-M-Y',$row->time).'</td>
                                <td>'.$row->fee.' <i class="fa fa-rupee"></i></td>
                                <td>';
                                // if($row->type == 1){
                                    echo getDurationName($row->year,$row->type,false);
                                // }
                                // else
                                echo '</td>
                            </tr>';
                    }
                    
                    echo '</tbody></table>';
                }
                else{
                    echo '<div class="alert alert-danger">Not Found</div>';
                }
                ?>
            </div>
            <div class="panel-footer">
                <a href="<?=base_url('Admin/list-all-transaction')?>" class="btn btn-primary"><i class="fa fa-eye"></i> View</a>
            </div>
        </div>
    </div>
    
    
    <div class="col-md-12 message-show">
        
    </div>
    
    
    
    
</div>



