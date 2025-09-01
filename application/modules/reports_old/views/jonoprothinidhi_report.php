<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> <?=lang('Dashboard')?> </a> </li>
      <li> <a href="<?=base_url($this->uri->segment(1).'/all')?>" class="active"> <?php echo lang($this->uri->segment(1).'_list');?></a></li>
      <li><?=$meta_title?></li>
    </ul>

    <div class="row">
       <div class="col-md-12">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
             </div>
             <div class="grid-body">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                    <a class="close" data-dismiss="alert">&times;</a>
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>

            <form action="<?=base_url().'personal_datas/jonoprothinidhi_report';?>" method="get">
                
                <table>
                  <tr>
                    <td style="padding-left: 10px;"><input type="text" name="national_id" placeholder="National ID" style="min-height: 34px;"></td> 
                    <td style="padding-left: 10px;"><select class="form-control input-sm" name="district" id="distirict">
                      <option value="">Select District</option>
                        <?php
                          for($i=0;$i<sizeof($districts);$i++)
                          {
                            $selected='';
                            if(set_value('district_id')==$districts[$i]->id)
                              $selected='selected="selected"';
                            echo '<option '.$selected.' value="'.$districts[$i]->id.'">'.$districts[$i]->district_name.'</option>';
                          }
                        ?>
                      </select></td>
                      
                      <td style="padding-left: 10px;"><select name="upazila_thana" id="upazila_thana_id" class="upazila_thana form-control input-sm">
                                <option value="">Select thana/upazila</option>
                              </select></td>
                      <td style="padding-left: 10px;">
                        <?php
                          $more_attr = 'class="form-control input-sm"';
                          echo form_dropdown('designation', $designation, set_value(''), $more_attr);
                        ?>
                      </td>

                      <td style="padding-left: 10px;">
                        লিঙ্গ:
                         <input type="radio" name="gender" value="Male"> <span style="color: black; font-size: 15px;">Male </span> 
                        <input type="radio" name="gender" value="Female"> <span style="color: black; font-size: 15px;">Female</span>
                      </td>

                      <td><input type="submit" name="search" value="খুজুন" class="btn btn-xs btn-primary" style="margin-left: 20px;"></td>
                  </tr>
                </table>
            </form>
            <br>

            <table class="table table-hover table-condensed">
              <thead>
                <tr>
                  <th>ক্রম</th>
                  <th>নাম</th> 
                  <th>ন্যাশনাল আইডি</th>                 
                  <th>জেলা</th>
                  <th>উপজেলা </th>
                  <th>বর্তমান পদবি</th>                  
                  <th>বর্তমান ঠিকানা</th>
                  <th>লিঙ্গ</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sl=0;
                  if($all_list > 0) {
                    foreach ($all_list as $row) {  $sl++;?>
                    <tr>
                      <td> <?=$sl?> </td>
  										<?php foreach($printcolumn as $value) { ?>
  											<td> <?php  echo  $row[$value];  ?> </td>
  										<?php }?>
                    </tr>
                  <?php }} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>



<script>

    //district dropdown
    $('#distirict').change(function(){
      $('.upazila_thana').addClass('form-control input-sm');
      $(".upazila_thana > option").remove();
      var dis_id = $('#distirict').val();
      $.ajax({
          type: "POST",
          url: hostname +"personal_datas/ajax_get_upa_tha_by_dis/" + dis_id,
          success: function(upazilaThanas)
          {
              $.each(upazilaThanas,function(id,ut_name)
              {
                  var opt = $('<option />');
                  opt.val(id);
                  opt.text(ut_name);
                  $('.upazila_thana').append(opt);
              });
          }
      });
    });

    $('#upazila_thana_id').change(function(){
      $('.organization_val').addClass('form-control input-sm');
      $(".organization_val > option").remove();
      var up_th_id = $('#upazila_thana_id').val();
      // alert(up_th_id);
      $.ajax({
          type: "POST",
          url: hostname +"personal_datas/ajax_get_organization_by_up_th_id/" + up_th_id,
          success: function(organization)
          {
              // alert(organization);
              $.each(organization,function(id,orgnization_name)
              {
                  var opt = $('<option />');
                  opt.val(id);
                  opt.text(orgnization_name);
                  $('.organization_val').append(opt);
              });
          }
      });
    });


</script>