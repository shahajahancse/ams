<div class="page-content"> 
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('scouts_member')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>              
                <div class="pull-right">
                  <!-- <a href="<?=base_url('events/event_list')?>" class="btn btn-success btn-xs btn-mini"> All Events List</a>  -->                  
                </div> 
             </div>
             <div class="grid-body">

      <div id="calendar"></div>
        </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
  $('#calendar').fullCalendar({
    eventSources: [
            {
                events: [
                    {
                        title: 'Event 1',
                        start: '2018-01-13'
                    },
                    {
                        title: 'Event 2',
                        start: '2018-01-19'
                    }
                ]
            }
        ]
  });
});
</script>

