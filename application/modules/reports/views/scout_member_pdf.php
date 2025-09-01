<style type="text/css">

table, td, th {  
  border: 1px solid #ddd;
  text-align: left;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  color: black;

}
</style>

<div class="page-content">     
   <div class="content"> 
      <style type="text/css">
         .marTopSearch{margin-top: 10px;}
      </style>
      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple ">
             <div class="grid-title">
               <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
               <div class="pull-right">

                
               </div>            
            </div>

            <div class="grid-body ">

               <?php if($results) { ?>
               <table class="table table-hover table-condensed" id="example">
                 <thead>
                   <tr>
                     <th width="5%"> SL </th>
                     <th width="5%">Image</th>
                     <th width="25%">Full Name</th>
                     <th width="10%">Scout ID</th>
                     <th width="12%">Member Type</th>
                     <th width="10%">Section</th>
                     <th width="25%">Group Name</th>
                     <th width="10%">Username</th>
                     <?php /* <!-- <th> U.Group</th> --> */ ?>
                     <th width="10%">Action</th>
                  </tr>
               </thead>
               <tbody>
                <?php 
                $sl=$pagination['current_page'];
                foreach ($results as $row):
                  $sl++;
                  // Profile Image
               $path = base_url().'profile_img/';
               if($row->profile_img != NULL){
                  $img_url = '<img src="'.$path.$row->profile_img.'" height="20">';
               }else{
                  $img_url = '<img src="'.$path.'no-img.png" height="20">';
               }
               $cont = 'Some content <br> <strong>inside</strong> the popover';
               ?>
               <tr>
                  <td class="v-align-middle"><?=$sl.'.'?></td>
                  <td class="v-align-middle"><?=$img_url?></td>
                  <td class="v-align-middle"><?php echo $row->first_name;?></td>
                  <td class="v-align-middle"><strong><span class="trigger-scout-id"><?=$row->scout_id?> </span></strong>
                    <td class="v-align-middle"><?=$row->member_type_name?></td>
                    <td class="v-align-middle"><span class="label label-green"><?=get_scout_section($row->sc_section_id);?></span></td>
                    <td class="v-align-middle"><?=$row->grp_name?></td>
                    <td class="v-align-middle"><strong><?=$row->username?></strong></td>
                    <?php /* <!-- <td class="v-align-middle"> -->
                      <?php 
                        // foreach ($row->groups as $group):
                        // echo '<span class="btn btn-primary btn-xs btn-mini" style="background-color:#6b64d0;margin-bottom:1px;">'.htmlspecialchars($group->description,ENT_QUOTES,'UTF-8').'</span>';
                        // echo '&nbsp;';
                        // endforeach;
                        ?>
                        <!-- </td> --> */?>
                        <td align="right">
                         <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                          <ul class="dropdown-menu pull-right">
                           <li><a href="<?=base_url("scouts_member/details/".encrypt_url($row->id))?>" target="_blank">Details Scouts Member</a></li>
                           <li><a href="<?=base_url("scouts_member/edit/".encrypt_url($row->id))?>" target="_blank">Update Scouts Member</a></li>
                           <li><a href="<?=base_url("scouts_member/archive/".encrypt_url($row->id))?>" onclick="return confirm('Are you sure you want to archive this scouts member?');">Archive Scouts Member</a></li>
                           <li class="divider"></li>
                           <li><a href="<?=base_url("scouts_member/delete/".encrypt_url($row->id))?>" onclick="return confirm('Be careful! are you sure you want to delete this user?');">Member Delete Request</a></li>
                        </ul>
                     </div>
                  </td> 
               </tr>
            <?php endforeach;?>                      
         </tbody>
      </table>
      <div class="row">
         <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Total Members </span></div>
         <div class="col-sm-8 col-md-8 text-right">
           <?php echo $pagination['links']; ?>
        </div>
     </div>

     <?php }else{ ?>

     <div class="alert alert-block alert-error fade in">
      <h4 class="alert-heading"><i class="icon-warning-sign"></i>No data found!</h4>
   </div>

   <?php } ?>

</div>
</div>
</div>
</div>

</div> <!-- END ROW -->

</div>