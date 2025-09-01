<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('my_profile')?>" class="active"> My Profile </a> </li>
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
                  <div><?php //echo validation_errors(); ?></div>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  <?php 
                    $attributes = array('id' => '');
                    echo form_open_multipart(uri_string(), $attributes);
                  ?>
                  <div class="row" style="margin-bottom: 30px;">
                    <div class="col-md-12">
                      <div id="msgEducation"> </div>
                        <table width="100%" border="1" id="memberDiv">
                           <tr>
                              <td width="25%">Education / Exam</td>
                              <td width="50%">Institute / University / Board</td>
                              <td width="15%">Result</td>
                              <td width="15%">Passing Year</td>
                              <td width="10%"> <a href="javascript:void();" id="addRow" class="label label-success"> <i class="fa fa-plus-circle"></i> Add More</a> </td>
                           </tr>
                           <?php foreach ($my_education as $row) { ?>
                           <tr>
                              <td><?php 
                                 $more_attr = 'class="form-control input-sm"';
                                 echo form_dropdown('edu_level_id[]', $education_level_dropdown_list, set_value('edu_level_id', $row->edu_level_id), $more_attr); ?>
                              </td>
                              <td><input type="text" name="institute_board[]" value="<?=$row->institute_board?>" class="form-control input-sm"></td>
                              <td><input type="text" name="result[]" value="<?=$row->result?>" class="form-control input-sm"></td>
                              <td><input type="number" name="pass_year[]" value="<?=$row->pass_year?>" class="form-control input-sm"></td>
                              <td width="100"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeRowEducationFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> Remove</a> </td>
                              <input type="hidden" name="hide_exam_id[]" value="<?=$row->id?>">
                           </tr>
                           <?php } ?>
                           <tr></tr>
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
    $education_level_data = '';
    foreach ($education_level_list as $item) {      
       $education_level_data .= '<option value="'.$item->id.'">'.addslashes($item->edu_level_name).'</option>';
    }

    // echo $award_list_data; exit();
?>

<script>
  // Education
   $("#addRow").click(function(e) {
      var items = '';
      items+= '<tr>';        
      items+= '<td><select class="input-sm" name="edu_level_id[]"><?php echo $education_level_data;?></select></td>';
      items+= '<td><input type="text" name="institute_board[]" class="form-control input-sm"></td>';
      items+= '<td><input type="text" name="result[]" class="form-control input-sm"></td>';
      items+= '<td><input type="number" name="pass_year[]" class="form-control input-sm"></td>';
      items+= '<td><a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> Remove </a></td>';
      items+= '</tr>';
      
      $('#memberDiv tr:last').after(items);
   });

   function removeRow(id){ 
      $(id).closest("tr").remove();
   }

   function removeRowEducationFunc(id){ 
      var dataId = $(id).attr("data-id");

      if (confirm("Are you sure you want to delete this information from database?") == true) {
         $.ajax({
          type: "POST",
          url: hostname+"my_profile/ajax_education_del/"+dataId,
          success: function (response) {
            $("#msgEducation").addClass('alert alert-success').html(response);
            $(id).closest("tr").remove();
         }
      });
      }
   }

  //  $("#addRow").click(function(e) {
  //    var items = '';
  //    items+= '<tr>';        
  //    items+= '<td><select class=" input-sm" name="edu_level_id[]"><?php echo $education_level_data;?></select></td>';
  //    items+= '<td><input type="text" name="institute_name[]" class="form-control input-sm" style="padding:0; margin:0;"></td>';
  //    items+= '<td><input type="text" name="pass_year[]" class="form-control input-sm"></td>';
  //    items+= '<td><a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> Remove </a></td>';
  //    items+= '</tr>';
  //       // items+= '</div>';
  //       $('#memberDiv tr:last').after(items);
  //  }); 

  //  function removeRow(id){ 
  //    $(id).closest("tr").remove();
  // }

  // function removeRowMember(id){ 
  //   var dataId = $(id).attr("data-id");
  //       // alert(dataId);

  //       var txt;
  //       if (confirm("Are you remove this infomation from database?") == true) {
  //         $.ajax({
  //           type: "POST",
  //           url: hostname+"my_profile/ajax_education_del/"+dataId,
  //           success: function (response) {
  //             $("#msgMember").addClass('alert alert-success').html(response);
  //             $(id).closest("tr").remove();
  //          }
  //       });
  //      }
  //   }

</script>  