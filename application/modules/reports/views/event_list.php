<style type="text/css">
  @media print {
    .printable, #printDiv{
       display: block !important;
    }
   .non-printable,  #details{
         display: none !important;

   }
}
</style>
<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url()?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <?php if($this->ion_auth->is_admin()){ ?>
              <div class="pull-right">
                 <a > <input class="btn btn-primary btn-xs btn-mini" type="button" onclick="printSpecificContents('printDiv')" value="Print" media="print" /></a>
                <a href="<?=base_url('events/create_event')?>" class="btn btn-primary btn-xs btn-mini"> Create Events </a>
              </div> 
            <?php } ?>          
          </div>

          <div class="grid-body " id="printDiv" >
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                    <a class="close" data-dismiss="alert">&times;</a>
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>
            <table class="table table-hover table-condensed" >
              <thead>
                <tr>
                  <th style="width:2%"> SL </th>
                  <th style="width:20%">Event Name</th>
                  <th style="width:14%">Venu</th>
                  <th style="width:10%">From Date</th>
                  <th style="width:10%">To Date</th>
                  <th style="width:10%">Event Type</th>
                  <th style="width:10%">Status</th>
                  <th style="width:24%" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($event)){
                  $i=0;
                  foreach ($event as $row) {
                    ?>
                  <tr>
                    <td class="v-align-middle"><?=++$i?></td>
                    <td class="v-align-middle"><?=$row->event_title?></td>
                    <td class="v-align-middle"><?=$row->event_venu?></td>
                    <td class="v-align-middle"><?=$row->event_start_date?></td>
                    <td class="v-align-middle"><?=$row->event_end_date?></td>
                    <td class="v-align-middle"><?=$row->event_type?></td>
                    <td class="v-align-middle">
                        <?php
                          if($row->event_start_date>date('Y-m-d')){
                            echo 'Upcomming';
                          }else if($row->event_end_date>date('Y-m-d')){
                            echo 'Running';
                          }else{
                            echo 'Past';
                          }
                        ?>
                    </td>
                    <td class="text-center">
                      <a  id="details" href="<?=base_url('events/details/'.$row->id);?>" class="btn btn-primary btn-xs btn-mini">Details</a>     
                     
                    </td>
                  </tr>
                    <?php
                  }
                }?>
              
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>