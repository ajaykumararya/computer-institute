<div class="row">
<?php



 if($_SESSION['type'] == 2)
    $this->db->where('center_id',$_SESSION['loginid']);
    
$get = $this->db->order_by('id','desc')->get('wallet_transactions');
?>
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">List All Transactin(s)</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <?php
                    if($get->num_rows()){
                    ?>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#.</th>
                                <th>Date</th>
                                <?php
                                if($_SESSION['type'] == 1){
                                    echo '<th>Center Name</th>';
                                }
                                ?>
                                <th>Trans. Id</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <!--<th>Action</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach($get->result() as $tow){
                                echo '<tr>
                                            <td>'.$i++.'</td> 
                                            <td>'.date('d-M-Y',$tow->transaction_id).'</td>';
                                            $centerName = 'You';
                                            if($_SESSION['type'] == 1){
                                                $center = $this->db->get_where('centers',['id' => $tow->center_id])->row();
                                                    echo '<td>'.($centerName = $center->name).'</th>';
                                                }
                                
                                        echo '<td>'.$tow->transaction_id.'</td>
                                            <td>'.($tow->type == 'credit' ? '<label class="label label-success">Credit ' : '<label class="label label-danger">Debit ') .' via '. ( $tow->via == 'self' ? $centerName : 'Admin').'</td>
                                            <td><b>'.$tow->amount.' <i class="fa fa-rupee"></i></b></td>
                                            <td>'.($tow->status  ? '<label class="label label-success">Success</label>' : '<label class="label label-danger">Failed</label>').'</td>
                                        </tr>';
                            }
                            
                            ?>
                        </tbody>
                    </table>
                    <?php
                    }
                    else{
                      echo '<div class="alert alert-danger">Data Not found..</div>';  
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>