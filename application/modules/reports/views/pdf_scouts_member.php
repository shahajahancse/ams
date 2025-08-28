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
     <div style="text-align: center;">
         <div  style="font-size: 20px;">BANGLADESH SCOUTS</div>
         <span>www.scouts.gov.bd</span>
      </div>
      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple ">
             <div class="grid-title">
              <h4 align="center"><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div style="text-align: right;margin-bottom: 5px;">Date: <?= date('d F, Y') ?></div>       
            </div>

          <div class="grid-body ">
		  	     
            <?php if($district_id && !empty($rows)){?>
            <a href="<?=$doc_url?>" class="btn btn-blueviolet btn-xs btn-mini" style="float: right;margin-left: 10px;">DOC Download</a>
            <a href="<?=$download_url?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a>&nbsp;&nbsp;
            
            <?php } ?>
            <table class="table table-hover table-condensed">
              <thead>
                <tr>
                  <th>SL</th>
                  <th>Image</th>
                  <th>Scout ID</th>
                  <th>Full Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                $sl = $pagination['current_page'];
                foreach ($rows as $row):
                  $sl++;

                  // Profile Image
                  $path = base_url().'profile_img/';
                  if($row->profile_img != NULL){
                    $img_url = '<img src="'.$path.$row->profile_img.'" height="20">';
                  }else{
                    $img_url = '<img src="'.$path.'no-img.png" height="20">';
                  }
              ?>
                <tr>
                  <td class="v-align-middle"><?=$sl.'.'?></td>
                  <td class="v-align-middle"><?=$img_url?></td>
                  <td class="v-align-middle"><?=$row->scout_id?></td>
                  <td class="v-align-middle"><?php echo $row->first_name;?></td>
                  <td class="v-align-middle"><?php echo $row->phone;?></td>
                  <td class="v-align-middle"><?php echo $row->email;?></td>
                </tr>
                <?php endforeach;?>                      
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>