<style type="text/css">
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 25px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>x`
<div id="morris">
                  <div class="row mt">

                      <div class="col-lg-6">

                          <div class="content-panel">

                              <h4><i class="fa fa-image"></i>ADD MENU</h4>

                              <div class="panel-body">

                                  <div id="hero-graph" class="graph col-lg-6">

                                    <form class="form-horizontal tasi-form" id="menu" enctype="multipart/form-data">

                                      <div class="form-group ">

                                          <label class="col-sm-2 control-label col-lg-4" for="inputSuccess">MENU NAME</label>

                                          <div class="col-lg-8">

                                              <input type="text" name="menu" class="form-control"  placeholder="ENTER MENU NAME...">

                                          </div>

                                      </div>

                                      <div class="form-group ">

                                          <label class="col-sm-2 control-label col-lg-2" for="inputError"> </label>

                                          <div class="col-lg-10">

                                              <button type="submit" class="btn btn-theme btn_menu">Submit</button>

                                          </div>

                                      </div>

                                    </form>

                                  </div>




                              </div>

                          </div>

                      </div>
                       <div class="row mt">

                      <div class="col-lg-6">

                          <div class="content-panel">

                              <h4><i class="fa fa-image"></i>ADD MENU</h4>

                              <div class="panel-body">

                                  <div id="hero-graph" class="graph col-lg-6">

                                    <form class="form-horizontal tasi-form" id="add_submenu" enctype="multipart/form-data">

                                      <div class="form-group ">

                                          <label class="col-sm-2 control-label col-lg-4" for="inputSuccess">MENU NAME</label>

                                          <div class="col-lg-8">

                                                       <select class="form-control  selectpicker" data-live-search="true" name="menu">
                                                           <option value="0">-- select Menu --</option>
                              <?php
                               $plan =  $this->db->get('menu');
                               foreach ($plan->result() as $key) {
                                   
                                  echo '<option  value="'.$key->id.'">'.$key->menu_name.'</option>';
                                }
                                 
                                ?>
                                               </select>


                                          </div>

                                      </div>
                                      <div class="form-group">
                                                <div class="col-lg-4">
                                                
                                                ADD SUBMENU
                                                </div>
                                                 <div class="col-lg-8">
                                                
                                                        <label class="switch">
                                                                <input type="checkbox" name="sub_menu" id="sub_menu" class="form-control sub_menu" />
                                                                <span class="slider round"></span>
                                                        </label>
                                                        <input type="hidden" name="hidden_status" id="hidden_status" value="1">
                                                </div>		
				        </div>	
                                      
                                       <div class="form-group " id="submenu" style="display:none;">

                                          <label class="col-sm-2 control-label col-lg-4" for="inputSuccess">SUB MENU NAME</label>

                                          <div class="col-lg-8">

                                              <input type="text" name="submenu" class="form-control"  placeholder="ENTER SUB MENU NAME...">

                                          </div>

                                        </div>
                                          <div class="form-group" id="toggle_submenu" style="display:none;">
                                                <div class="col-lg-4">
                                                
                                                ADD SUBSUBMENU
                                                </div>
                                                 <div class="col-lg-8" >
                                                
                                                        <label class="switch">
                                                                <input type="checkbox" name="sub_sub_menu" id="sub_sub_menu" class="form-control sub_sub_menu" />
                                                                <span class="slider round"></span>
                                                        </label>
                                                        <input type="hidden" name="hidden_status" id="hidden_status" value="1">
                                                </div>		
				        </div>	
                                        <div class="form-group " id="subsubmenu" style="display:none;">

                                          <label class="col-sm-2 control-label col-lg-4" for="inputSuccess">SUBSUB MENU NAME</label>

                                          <div class="col-lg-8">

                                              <input type="text" name="subsubmenu" class="form-control"  placeholder="ENTER SUB SUB MENU NAME...">

                                          </div>

                                        </div>
                                      <div class="form-group">
                                                <div class="col-lg-4">
                                                
                                                EXTERNAL LINK 
                                                </div>
                                                 <div class="col-lg-8">
                                                
                                                        <label class="switch">
                                                                <input type="radio" name="ext_url" id="ext_url" value="ext_link" class="form-control ext_url_chk" unchecked/>
                                                                <span class="slider round"></span>
                                                        </label>
                                                        <input type="hidden" name="ext_url_status" id="ext_url_status" value="0">
                                                </div>		
				       				 </div>
										<div class="form-group">
                                                <div class="col-lg-4">
                                                
                                                INTERNAL LINK 
                                                </div>
                                                 <div class="col-lg-8">
                                                
                                                        <label class="switch">
                                                                <input type="radio" name="ext_url" id="int_url" value="int_link" class="form-control int_url_chk" unchecked/>
                                                                <span class="slider round"></span>
                                                        </label>
                                                        <input type="hidden" name="int_url_status" id="int_url_status" value="0">
                                                </div>		
				       				 </div>		
                                        
                                           <div class="form-group" id="open_link" style="display:none">
                                      OPEN LINK IN NEW TAB	<label class="switch">
								            <input type="checkbox" name="openlink" id="openlink" class="form-control" />
								            <span class="slider round"></span>
							            </label>
							            <input type="hidden" name="openlinkstatus" id="openlinkstatus" value="0">
						
						                </div>		
                                        <div class="form-group " id="ext_url_link" style="display:none;">

                                          <label class="col-sm-2 control-label col-lg-4" for="inputSuccess">ENTER URL ADDRESS</label>

                                          <div class="col-lg-8">

                                              <input type="text" name="ext_url_link" class="form-control"  placeholder="ENTER URL ADDRESS...">

                                          </div>

                                        </div>
                                           <div class="form-group " id="int_url_link" style="display:none">

                                          <label class="col-sm-2 control-label col-lg-4" for="inputSuccess">PAGE NAME</label>

                                          <div class="col-lg-8">

                                           <select class="form-control " data-live-search="true" name="page">
                              <?php
                               $plan =  $this->db->get('page');
                               foreach ($plan->result() as $key) {
                                   
                                  echo '<option  value="'.$key->id.'">'.$key->title.'</option>';
                                }
                                 
                                ?>
                                               </select>

                                          </div>

                                      </div>


                                      <div class="form-group ">

                                          <label class="col-sm-2 control-label col-lg-2" for="inputError"> </label>

                                          <div class="col-lg-10">

                                              <button type="submit" class="btn btn-theme btn_menu">Submit</button>

                                          </div>

                                      </div>

                                    </form>

                                  </div>




                              </div>

                          </div>

                      </div>

                                      
                 <div class="row-mt">
                        <div class="col-lg-6">

                          <div class="content-panel">

                              <h4><i class="fa fa-image"></i> PAGE</h4>

                              <div class="panel-body">

                                  <div id="hero-bar" class="graph col-lg-6">

                                    <form class="form-horizontal tasi-form" id="page_link" enctype="multipart/form-data">

                                      <div class="form-group ">

                                          <label class="col-sm-2 control-label col-lg-4" for="inputSuccess">MENU</label>

                                          <div class="col-lg-8">

                                           <select class="form-control  get_submenu" data-live-search="true" name="menu">
                                               <option value="0">-- select Menu --</option>
                              <?php
                               $plan =  $this->db->get('menu');
                               foreach ($plan->result() as $key) {
                                   
                                  echo '<option  value="'.$key->id.'">'.$key->menu_name.'</option>';
                                }
                                 
                                ?>
                                               </select>

                                          </div>

                                      </div>
                                       <div class="form-group ">

                                          <label class="col-sm-2 control-label col-lg-4" for="inputSuccess">SUB MENU</label>

                                          <div class="col-lg-8">

                                                <select class="form-control get_subsubmenu submenu" name="submenu" >
                                
                                                        <option value="">--Select submenu--</option>
                                            
                                                </select>

                                          </div>

                                      </div>
                                      <div class="form-group ">

                                          <label class="col-sm-2 control-label col-lg-4" for="inputSuccess">SUB SUB MENU</label>

                                          <div class="col-lg-8">

                                                <select class="form-control subsubmenu" name="subsubmenu" >
                                
                                                        <option value="">--Select SubSubmenu--</option>
                                            
                                                </select>

                                          </div>

                                      </div>
                                      <div class="form-group ">

                                          <label class="col-sm-2 control-label col-lg-4" for="inputSuccess">PAGE NAME</label>

                                          <div class="col-lg-8">

                                           <select class="form-control " data-live-search="true" name="page">
                                               <option value="0"> -- Select Page Name ---</option>
                              <?php
                               $plan =  $this->db->get('page');
                               foreach ($plan->result() as $key) {
                                   
                                  echo '<option  value="'.$key->id.'">'.$key->title.'</option>';
                                }
                                 
                                ?>
                                               </select>

                                          </div>

                                      </div>

                                      <div class="form-group ">

                                          <label class="col-sm-2 control-label col-lg-2" for="inputError"> </label>

                                          <div class="col-lg-10">

                                              <button type="submit" class="btn btn-theme btn_page">Submit</button>

                                          </div>

                                      </div>

                                    </form>

                                  </div>

                                
                              </div>

                          </div>

                      </div>
                  

              </div>
        