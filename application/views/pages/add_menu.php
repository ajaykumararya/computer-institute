
<script src="https://ilikenwf.github.io/jquery.mjs.nestedSortable.js"></script>
    




 
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-sm-6">
                <div class="dd" id="nestable">
                   <div class="widget-box">
                      <div class="widget-header">
                        <h4 class="widget-title"> Add Menu </h4>
                      </div>
                      <div class="widget-body">
                        <div class="widget-main">
                          <form action="" id="menu" method="post" class="form-inline" enctype="multipart/form-data">
                            <div class="profile-user-info profile-user-info-striped">
                              <div class="profile-info-row">
                                <div class="profile-info-name"> Menu Name </div>
                                <div class="profile-info-value">
                                  <?php 
                                  echo form_input(array('id'=>'menu_name','name'=>'menu_name','Placeholder'=>'Menu Name','class'=>'col-sm-12 col-xs-12','style' =>'', 'value'=>set_value('menu_name')));
                                  ?>
                                </div>
                              </div>

                              <div class="profile-info-row">
                                <div class="profile-info-name"> External Url </div>
                                <div class="profile-info-value">
                                  <?php 
                                  echo form_input(array('id'=>'external_url_link','name'=>'external_url_link','Placeholder'=>'External Url LINK','class'=>'col-sm-12 col-xs-12','style' =>'', 'value'=>set_value('external_url')));
                                  ?>
                                </div>
                              </div>
                              <div class="profile-info-row">
                                <div class="profile-info-name"> Yes/No   </div>
                                <div class="profile-info-value">
                                  Externale Url <input type="checkbox" name="external_url" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  Open In New Tab <input type="checkbox" name="new_tab" > 

                                </div>
                              </div>


                            <div class="profile-info-name"> UPLOAD FILE </div>
                              <div class="profile-info-value">
                                <input type="file" name="fileToUpload" class="col-sm-6 col-xs-12" >
                              </div>
                            </div>





                            <div class="form-actions center">
                              <button type="submit" class="btn btn-sm btn-success">
                                Click To Add 
                                <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                              </button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div> 
                </div>
            </div>

            <div class="vspace-16-sm"></div>

            <div class="col-sm-6">
                <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('menu_item_list'); ?></h3>
                    </div><!-- /.box-header -->
                    <form id="form1" action="<?php echo site_url('admin/front/menus/update') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <div class="mailbox-controls">
                                <div class="pull-right">
                                </div><!-- /.pull-right -->
                            </div>
                            <div class="table-responsive mailbox-messages">
                                <div class="download_label"><?php echo $this->lang->line('menu_item_list'); ?></div>

                                <div class="menu-box">

                                    <?php
                                     echo $menu_ul;
                                    ?>


                                    
                                    
                                </div>
                            </div><!-- /.mail-box-messages -->
                        </div><!-- /.box-body -->

                    </form>
            </div>
        </div><!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div>

<script type="text/javascript">
  
   
    // $(document).ready(function () {
       
    //   alert('j');

    //     $('ol.sortable').nestedSortable({
    //         handle: 'div',
    //         items: 'li',
    //         toleranceElement: '> div',
    //         update: function () {
    //           alert('update');
    //             var list = $(this).nestedSortable('toHierarchy');
    //             var urls = baseurl + "admin/front/menus/updateMenu";
    //             // $.ajax({
    //             //     url: urls,
    //             //     type: 'post',
    //             //     data: {order: list},

    //             //     dataType: "html",
    //             //     success: function (response) {

    //             //     },
    //             //     beforeSend: function () {

    //             //     },
    //             //     complete: function () {


    //             //     }
    //             // });
    //         }
    //     });
    // });




    // $('#list').nestable({maxDepth: 1});

    //   $('.sortable').change(function(){
    //     alert('draggable_listvs ')
    //      $('#list').toggleClass('drag_disabled drag_enabled');
    //  });


</script>



<!--------------------------------------------------------------------->

<script type="text/javascript">
    $(document).ready(function () {
        $('.delmodal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        })
        $('#confirm-delete').on('show.bs.modal', function (e) {
            var data = $(e.relatedTarget).data();
            $('.del_menuid', this).val("");
            $('.del_menuid', this).val(data.id);
        });


        $('#confirm-delete').on('click', '.btn-ok', function (e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $('.del_menuid').val();


            $.ajax({
                type: "post",
                url: '<?php echo site_url("admin/front/menus/deleteMenuItem") ?>',
                dataType: 'JSON',
                data: {'id': id},
                beforeSend: function () {
                    $modalDiv.addClass('modalloading');
                },
                success: function (data) {
                    if (data.status == 1) {
                        successMsg(data.message);
                        location.reload(true);

                    } else {
                        errorMsg(data.message);
                    }
                },
                complete: function () {

                    $modalDiv.removeClass('modalloading');

                }
            });


        });


    });


</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#postdate').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });



        $('.ext_url_chk').change(function () {
            var c = this.checked ? 1 : 0;
            if (c) {
                $('#ext_url_link').prop("disabled", false);
            } else {
                $('#ext_url_link').prop("disabled", true);

            }
        });
        $('ol.sortable').nestedSortable({
            disableNesting: 'no-nest',
            forcePlaceholderSize: true,
            handle: 'div',
            helper: 'clone',
            items: 'li',
            maxLevels: 2,
            opacity: .6,
            tabSize: 25,
            tolerance: 'pointer',
            toleranceElement: '> div',
            update: function () {
                var list = $(this).nestedSortable('toHierarchy');
                var urls = baseurl + "admin/front/menus/updateMenu";
                $.ajax({
                    url: urls,
                    type: 'post',
                    data: {order: list},

                    dataType: "html",
                    success: function (response) {

                    },
                    beforeSend: function () {

                    },
                    complete: function () {


                    }
                });
            }
        });
    });

</script>
<div class="delmodal modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('confirmation'); ?></h4>
            </div>

            <div class="modal-body">

                <p>Are you sure want to delete item, this action is irreversible!</p>
                <p>Do you want to proceed?</p>
                <p class="debug-url"></p>
                <input type="hidden" name="del_menuid" class="del_menuid" value="">

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                <a class="btn btn-danger btn-ok"><?php echo $this->lang->line('delete'); ?></a>
            </div>
        </div>
    </div>
</div>







