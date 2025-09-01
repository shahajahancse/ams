<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('acl/task_register')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-8">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">                
                <a href="<?=base_url('acl/task_register')?>" class="btn btn-blueviolet btn-xs btn-mini"> Task Register List</a>  
              </div>
             </div>
             <div class="grid-body">
              <!-- <form id="form_traditional_validation" action="#"> -->
              <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
              <div><?php //echo validation_errors(); ?></div>
              <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                      <?php echo $this->session->flashdata('success');;?>
                  </div>
              <?php endif; ?>
              <?php echo form_open("acl/create_task_register");?>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">Task Name (English)</label>
                  <?php echo form_error('task_name_en'); ?>
                  <input name="task_name_en" id="task_name_en" type="text" class="form-control input-sm" placeholder="e.g. Create scouts" value="<?=set_value('task_name_en')?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Task Name (Bangla)</label>
                  <?php echo form_error('task_name_bn'); ?>
                  <input name="task_name_bn" id="task_name_bn" type="text"  class="form-control input-sm" placeholder="উদাহরণ: স্কাউটস তৈরি করা " value="<?=set_value('task_name_bn')?>">
                </div>
              </div>

              <br>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">Select Controller</label>
                  <?php echo form_error('controller_name'); ?>
                  <select name="controller_name" id="controller_name" class="select2 form-control" onchange="controller_methods(this.value)">
                    <option value="">Select One</option>
                    <?php foreach ($controllers as $key => $value) { ?>
                      <option value="<?php echo $key?>"><?php echo $key?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Select Function </label>
                  <?php echo form_error('controller_function'); ?>
                  <div id="class_methods"></div>                  
                </div>
              </div>

            <div class="form-actions">  
              <div class="pull-right">
                <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
              </div>
            </div>
          <?php echo form_close();?>

          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>
<?php //print_r($controllers);exit;?>
<script type="text/javascript">
  function controller_methods(contName)
  {
    var myArr = new Array();
    <?php
      foreach($controllers as $key=>$val)
      {
        $methodsall=implode(',', $val);
        echo 'myArr["'.$key.'"] = new Array("'.$methodsall.'");';
      }
    ?>
    item=myArr[contName][0].split(',');
    
    selectbox='<select name="controller_function" id="controller_function" class="form-control">';
    selectbox+='<option value="">--- Select Function ---</option>';
    for(i=0;i<item.length;i++)
    {
      selectbox+='<option value="'+item[i]+'">'+item[i]+'</option>';
    }
    selectbox+='</select>';
    
    $("#class_methods").html(selectbox);
  }
</script>
