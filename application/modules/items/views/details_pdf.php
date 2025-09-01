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
            

            <div class="tiles white details">
                <table class="tg">
                    <tr>
                      <th class="tg-9vst">Name:</th>
                      <td class="tg-031e" width="300"><?=$complain->name?></td>
                      <th rowspan="4" class="tg-9vst">Problem Details:</th>
                      <td rowspan="4" class="tg-031e" valign="top"><?=$complain->complain_details?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Mobile:</th>
                      <td class="tg-031e"><?=$complain->phone?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Email:</th>
                      <td class="tg-031e"><?=$complain->email?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Address:</th>
                      <td class="tg-031e"><?=$complain->address?></td>
                    </tr>
                </table>
            </div>
            
          </div>
        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>