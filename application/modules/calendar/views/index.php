<div class="page-content"> 
  <div class="content">
    <div class="row" style="max-height:600px;">
      <div class="tiles row tiles-container red no-padding">
        <div class="col-md-4 tiles red no-padding">
          <div class="tiles-body">
            <div class="calender-options-wrapper">
              <h2 class="text-white pull-left" id="calender-current-date"></h2>
              <h3 class="text-white semi-bold pull-right" id="calender-current-day"></h3>
              <div class="clearfix"></div>
              <div id='external-events' class="hide-inphone events-wrapper">
                <div class="events-heading">&nbsp;Draggable Events</div>
                <div class='external-event'>My Event 1</div>
                <div class='external-event'>My Event 2</div>
                <div class='external-event'>My Event 3</div>
                <div class='external-event'>My Event 4</div>
                <div class='external-event'>My Event 5</div>
        
                <div class="checkbox check-default p-t-20">
                  <input type="checkbox" value="1" id='drop-remove'>
                  <label for="drop-remove">Keep Me Signed in</label>
                </div>
               
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8 tiles white no-padding">
          <div class="tiles-body">
            <div class="full-calender-header">
              <div class="pull-left">
                <div class="btn-group ">
                  <button class="btn btn-success" id="calender-prev"><i class="fa fa-angle-left"></i></button>
                  <button class="btn btn-success" id="calender-next"><i class="fa fa-angle-right"></i></button>
                </div>
              </div>
              <div class="pull-right">
                <div data-toggle="buttons-radio" class="btn-group">
                  <button class="btn btn-primary active" type="button" id="change-view-month">month</button>
                  <button class="btn btn-primary " type="button" id="change-view-week">week</button>
                  <button class="btn btn-primary" type="button" id="change-view-day">day</button>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
            <div id='calendar'></div>
          </div>
        </div>
      </div>
    </div>
    <br>
  </div>
</div>

