<div class="row" style="min-height:10px">
    <div class="col-md-12">
        <?php
        $CI = &get_instance();
        if($x = $CI->session->flashdata('msg'))
            echo $x;
        $CI->load->model('Paymentsetting_model','paymentM');
        $CI = &get_instance();
        $status = $CI->paymentM->few_setting('active_payment');
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <form method="POST" action="">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Payment Setting</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>Payment Getway Status</label>
                        <select class="form-control" name="active_payment" >
                            <option <?=$status == 'yes' ? 'selected' : ''?> value="yes">Active</option>
                            <option <?=$status == 'no' ? 'selected' : ''?> value="no">In-Active</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Student Fee</label>
                        <input type="number" name="student_fee" class="form-control" value="<?=$CI->paymentM->few_setting('student_fee')?>">
                    </div>
                    <div class="form-group">
                        <label>Center Fee</label>
                        <input type="number" name="center_fee" class="form-control" value="<?=$CI->paymentM->few_setting('center_fee')?>">
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <form method="POST" action="">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Payu Setting</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>Marchent Salt</label>
                        <input type="" name="payu_salt" class="form-control" value="<?=$CI->paymentM->few_setting('payu_salt')?>">
                    </div>
                    <div class="form-group">
                        <label>Marchent Key</label>
                        <input type="" name="payu_key" class="form-control" value="<?=$CI->paymentM->few_setting('payu_key')?>">
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
</div>