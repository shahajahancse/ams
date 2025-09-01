<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>
      <style type="text/css">
         #memberDiv td{padding: 5px;}
      </style>
      
      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('my_profile')?>" class="btn btn-success btn-xs btn-mini"> My Profile</a>  

                  </div>
               </div>
               <div class="grid-body">
                  <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
                  <div><?php //echo validation_errors(); ?></div>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  <?php 
                    $attributes = array('id' => 'update_award');
                    echo form_open_multipart(uri_string(),$attributes);
                  ?>


                  <div class="row" style="margin-bottom: 30px;">
                     <div id="msgMember"> </div>
                     <div class="col-md-12" >
                        <label class="form-label">Scouts Award</label>
                        <table width="100%" border="1" id="memberDiv">
                           <tr>
                              <td width="250">Award ID</td>
                              <td width="200">Certificate No</td>
                              <td width="200">Achived Date</td>
                              <td width="100"> <a href="javascript:void();" id="addRow"  class="label label-success"> <i  class="fa fa-plus-circle"></i> Add More</a> </td>
                           </tr>
                           <?php foreach ($my_award as $row) { ?>
                           <tr>
                            <td>
                              <?php 
                              // echo $row->award_id; 
                             $more_attr = 'class=" input-sm"';
                             echo form_error('award_id[]');
                             echo form_dropdown('award_id[]', $award_dropdown_list, set_value('award_id[]', $row->award_id), $more_attr); ?>
                            </td>
                            <td><?php echo form_error('certificate_no[]');?><input name="certificate_no[]" class="form-control input-sm" value="<?=set_value('certificate_no[]', $row->certificate_no)?>"></td>

                            <td><?php echo form_error('achived_date[]');?><input type="text" name="achived_date[]" class="form-control input-sm datetime" placeholder="DD-MM-YYYY" value="<?=set_value('achived_date[]', date_browse_format($row->achived_date))?>"></td>
                            <td width="120"> 
                               <input type="hidden" name="hide_id[]" value="<?=$row->id?>">
                               <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeRowMember(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> Remove</a> </td>
                            </tr>
                          <?php } ?>
                       </table>
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

<?php
    $award_list_data = '';
    foreach ($award_list as $item) {      
       $award_list_data .= '<option value="'.$item->id.'">'.addslashes($item->award_name).'</option>';
    }
    // echo $award_list_data; exit();
?>

<script>
   $("#addRow").click(function(e) {
     var items = '';
     items+= '<tr>';        
     items+= '<td><select class=" input-sm" name="award_id[]"><?php echo $award_list_data;?></select></td>';
     items+= '<td><input type="text" name="certificate_no[]" class="form-control input-sm"></td>';
     items+= '<td><input type="text" name="achived_date[]" class="form-control input-sm datetime" placeholder="DD-MM-YYYY" value="<?=date('d-m-Y');?>"></td>';
     items+= '<td><input type="hidden" name="hide_id[]" value=""> <a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> Remove </a></td>';
     items+= '</tr>';
        // items+= '</div>';
        $('#memberDiv tr:last').after(items);

        $('.datetime').datepicker({
          format: "dd-mm-yyyy",
          autoclose: true
        });
   }); 

   function removeRow(id){ 
     $(id).closest("tr").remove();
  }

  function removeRowMember(id){ 
    var dataId = $(id).attr("data-id");
        // alert(dataId);

        var txt;
        if (confirm("Are you remove this infomation from database?") == true) {
          $.ajax({
            type: "POST",
            url: hostname+"my_profile/ajax_award_del/"+dataId,
            success: function (response) {
              $("#msgMember").addClass('alert alert-success').html(response);
              $(id).closest("tr").remove();
           }
        });
       }
    }

</script>  

<script type="text/javascript">
    $(document).ready(function() {
      $('#update_award').validate({
          // focusInvalid: false, 
          ignore: "",
          rules: {
             award_id[]: {
                required: true
             },
             certificate_no[]: {
                required: true
             },
             achived_date[]: {
                required: true
             },
          },

          invalidHandler: function (event, validator) {
            //display error alert on form submit    
         },

         errorPlacement: function (label, element) { // render error placement for each input type   
            $('<span class="error"></span>').insertAfter(element).append(label)
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('success-control').addClass('error-control');  
         },

         highlight: function (element) { // hightlight error inputs
            var parent = $(element).parent();
            parent.removeClass('success-control').addClass('error-control'); 
         },

         unhighlight: function (element) { // revert the change done by hightlight

         },

         success: function (label, element) {
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('error-control').addClass('success-control'); 
         },

         submitHandler: function (form) {
            form.submit();
         },

       });
    });   
</script>   