<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> Manage User </li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
        <div class="col-md-12">
          <div class="grid simple horizontal">
            <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">                
                <a href="<?=base_url('scouts_member/all')?>" class="btn btn-success btn-xs btn-mini"> Scouts Member List</a>  
              </div>
             </div>
            <div class="grid-body ">
              <div class="row">
                <form id="commentForm">
                  <div id="rootwizard" class="col-md-12">
                    <div class="form-wizard-steps">
                      <ul class="wizard-steps">
                        <li class="" data-target="#step1"> <a href="#tab1" data-toggle="tab"> <span class="step">1</span> <span class="title">Basic Information</span> </a> </li>
                        <li data-target="#step2" class=""> <a href="#tab2" data-toggle="tab"> <span class="step">2</span> <span class="title">Education Information</span> </a> </li>
                        <li data-target="#step3" class=""> <a href="#tab3" data-toggle="tab"> <span class="step">3</span> <span class="title">Scouts Settings</span> </a> </li>
                        <li data-target="#step4" class=""> <a href="#tab4" data-toggle="tab"> <span class="step">4</span> <span class="title">Login Credential <br>
                          </span> </a> </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="tab-content">
                      <div class="tab-pane" id="tab1"> <br>
                        <h4 class="semi-bold">Step 1 - <span class="light">Basic Information</span></h4>
                        <br>
                        <div class="row form-row">
                          <div class="col-md-4">                            
                            <input type="text" placeholder="First Name" class="form-control" name="txtFirstName" id="txtFirstName">
                          </div>
                          <div class="col-md-4">
                            <input type="text" placeholder="Last Name" class="form-control" name="txtLastName" id="txtLastName">
                          </div>
                          <div class="col-md-4">
                            Gender: <input type="radio" name="gender" value="Male" <?php echo set_value('gender', $this->input->post('gender')) == 'Male' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">Male </span> 
                                <input type="radio" name="gender" value="Female" <?php echo set_value('gender', $this->input->post('gender')) == 'Female' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">Female</span>
                          </div>
                        </div>

                        <div class="row form-row">
                          <div class="col-md-4">
                            <input type="text" placeholder="Date of Birth" class="form-control" name="txtFullName" id="txtFullName">
                          </div>
                          <div class="col-md-4">
                            <input type="text" placeholder="Mobile Number" class="form-control" name="txtFullName" id="txtFullName">
                          </div>
                        </div>
                        
                      </div> <!-- tab1 -->

                      <div class="tab-pane" id="tab2"> <br>
                        <h4 class="semi-bold">Step 2 - <span class="light">Education Information</span></h4>
                        <br>
                        <div class="row form-row">
                          <div class="col-md-8">
                            <input type="text" placeholder="Institute Name" class="form-control" name="txtCountry" id="txtCountry">
                          </div>
                          <div class="col-md-4">
                            <input type="text" placeholder="Current Class" class="form-control" name="txtPostalCode" id="txtPostalCode">
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-4">
                            <?php echo form_dropdown('req_group', $district, set_value('req_group'), 'style="max-width:90%;"'); ?>
                          </div>
                          <div class="col-md-4">
                            <?php echo form_dropdown('req_group', $upazila, set_value('req_group'), 'style="max-width:90%;"'); ?>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane" id="tab3"> <br>
                        <h4 class="semi-bold">Step 3 - <span class="light">Scouts Settings</span></h4>
                        <br>
                        <div class="row form-row">
                          <div class="col-md-4">                            
                            <input type="text" placeholder="Unit Name" class="form-control" name="txtFirstName" id="txtFirstName">
                          </div>
                          <div class="col-md-4">
                            <input type="text" placeholder="Section" class="form-control" name="txtLastName" id="txtLastName">
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-4">                            
                            <input type="text" placeholder="Joining Date of Scouting" class="form-control" name="txtFirstName" id="txtFirstName">
                          </div>
                          <div class="col-md-4">
                            <?php echo form_dropdown('req_group', $scout_group, set_value('req_group'), 'style="max-width:90%;"'); ?>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane" id="tab4"> <br>
                        <h4 class="semi-bold">Step 4 - <span class="light">Login Credential &amp; Submit</span></h4>
                        <br>
                        <div class="row form-row">
                          <div class="col-md-4">                            
                            <input type="text" placeholder="Email Address" class="form-control" name="txtFirstName" id="txtFirstName">
                          </div>                          
                        </div>
                        <div class="row form-row">
                          <div class="col-md-4">                            
                            <input type="text" placeholder="Password" class="form-control" name="txtFirstName" id="txtFirstName">
                          </div>
                          <div class="col-md-4">
                            <input type="text" placeholder="Confirm Password" class="form-control" name="txtLastName" id="txtLastName">
                          </div>
                        </div>
                      </div>

                      <ul class=" wizard wizard-actions pull-right">
                        <li class="previous first" style="display:none;"><a href="javascript:;" class="btn">&nbsp;&nbsp;First&nbsp;&nbsp;</a></li>
                        <li class="previous"><a href="javascript:;" class="btn">&nbsp;&nbsp;Previous&nbsp;&nbsp;</a></li>
                        <li class="next last" style="display:none;"><a href="javascript:;" class="btn btn-primary">&nbsp;&nbsp;Last&nbsp;&nbsp;</a></li>
                        <li class="next"><a href="javascript:;" class="btn btn-primary">&nbsp;&nbsp;Next&nbsp;&nbsp;</a></li>
                      </ul>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>

  </div>
</div>