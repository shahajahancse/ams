<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"><?=lang('Dashboard')?> </a> </li>
      <li> <a href="<?=base_url($this->uri->segment(1).'/all')?>" class="active"> <?php echo lang($this->uri->segment(1).'_list');?></a></li>
      <li><?=lang('Add New')?></li>
    </ul>
	
	
	
<form class="form-horizontal has-validation-callback" method="post" action="" onsubmit="return validatefltr()">
<table width="100%" border="0">
	<tr>
		<td>&nbsp;</td>
		<td width="100" align="right"><?=lang('course_name_id')?>&nbsp;&nbsp;</td>
		<td width="200">
			<select name="course_name_id" class="form-control" onchange="this.form.submit()">
				<option value=""><?=lang('select')?></option>
				<?php foreach ($course_name_id[2] as $value) {
					
						if($value['id']==$_POST['course_name_id'])
							$checkval='selected="selected"';
						else
							$checkval='';
						?> 
					
					<option <?=$checkval?> value="<?php echo $value['id']; ?>"><?php echo $value['course_name'] ?></option>
				<?php } ?>
			</select>
			
			
		</td>
		<td>&nbsp;</td>
		<td width="100" align="right"><?=lang('prosikkhon_start_date')?>&nbsp;&nbsp;</td>
		<td width="200"><input class="form-control datetime" placeholder="<?=lang('start_date')?>" value="<?=$from_date?$from_date:''?>" name="from_date" id="from_date" type="text"></td>
		<td width="10">&nbsp;</td>
		<td width="200"><input class="form-control  datetime" placeholder="<?=lang('end_date')?>" value="<?=$t_date?$t_date:''?>" name="t_date" id="t_date" type="text"></td>
		<td width="10">&nbsp;</td>
		<td width="100"><input class="form-control btn green" value="<?=lang('filter_data')?>" name="filter" type="submit" ></td>
		<td>&nbsp;</td>
	</tr>
</table>
<div style="clear:both"></div><br />
<br />
</form>



    <div class="row">
       <div class="col-md-12">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">
                <a href="<?=base_url($this->uri->segment(1).'/all')?>" class="btn btn-primary btn-xs btn-mini"> <?php echo lang($this->uri->segment(1).'_list');?></a>  
              </div>
             </div>
             <div class="grid-body">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                    <a class="close" data-dismiss="alert">&times;</a>
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>
            <table class="table table-hover table-condensed" id="example">
              <thead>
                <tr>
                  <?php
						foreach($printcolumn as $value)
						{
							?>
							<th>
								<?php echo lang($value); ?>
							</th>
						<?php }?>
					
                </tr>
              </thead>
              <tbody>
                                <?php
                                if($all_list > 0) {//print_r($all_list);exit;
                                foreach ($all_list as $row) {  ?>
                                  

                                    <tr>
										
										<?php
										foreach($printcolumn as $value)
										{
											?>
											<td>
												<?php 
													if($value=='data_sheet_type')
													{
														if($row[$value]==1)echo 'জনপ্রতিনিধি';
														else echo 'কর্মকর্তা / কর্মচারীর';
													}
													else
														echo  $row[$value]; 
												?>
											</td>
										<?php }?>
										
										
                                        
                                    </tr>
                                <?php }} else{ ?>


                                <?php } ?>
                            </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>