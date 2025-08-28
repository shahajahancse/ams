<div class="page-content">
   <div class="content">
      <div class="row" style="max-height:600px;">
         <?php //print_r($this->session->all_userdata()); ?>
         <div class="tiles row tiles-container red no-padding">
            <div class="col-md-12 tiles white no-padding">
               <div class="tiles-body">
                  <!-- <input type="text" name="" class="datetimepicker"> -->
                  <div id='calendar'></div>
               </div>
            </div>
         </div>
      </div>
      <br>
   </div>
</div>

<!-- Pop up handler for create appointment -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add Quick Appointment</h4>
         </div>
         <form role="form" id="jsvalidate">
            <div class="modal-body">
               <div class="form-group">
                  <label class="form-label">Name/Title <span class='required'>*</span></label>
                  <input type="text" name="appointment" id="ModalAppointment" class="form-control" placeholder="Appointment">
               </div>
               <div class="form-group">    
                  <label class="form-label">Date and Time <span class='required'>*</span></label>
                  <input type="text" name="app_date" id="ModalDate" class="form-control datetimepicker" value="">
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <!-- <button type="submit" class="btn btn-primary" id="save">Save</button> -->
               <input type="submit" class="btn btn-primary" id="save" value="Save">
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Pop up handler for update/delete appointment-->
<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Update/Delete Appointment</h4>
         </div>
         <div class="modal-body">
            <div class="form-group">
               <label class="form-label">Name/Title <span class='required'>*</span></label>
               <input type="text" class="form-control"  id="ModalAppointmentUpdate" placeholder="Appointment">
            </div>
            <div class="form-group">  
               <label class="form-label">Date and Time <span class='required'>*</span></label>  
               <input type="text" class="form-control"  id="ModalDateUpdate" value="">
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" id="ModalDelete" data-dismiss="modal">Delete</button>
            <button type="button" class="btn btn-primary" id="ModalUpdate" data-dismiss="modal">Update</button>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
   $(document).ready(function() {
      $('#calendar').fullCalendar({
         dayClick: function(date, jsEvent, view) {
            $("#myModal").modal()
            $('#ModalDate').val(date.format('YYYY-MM-DD HH:mm:ss'));

            // ADD Appointment 
            jQuery('#save').click(function () {
               $.ajax({
                  type : 'POST',
                  data : {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', appointment: $('#ModalAppointment').val(), date_appointment: $('#ModalDate').val()},
                  url : "calendar/add/",
                  beforeSend: function( xhr ) {
                     var newEvent = {
                        title: $('#ModalAppointment').val(),
                        start: date.format('YYYY-MM-DD HH:mm:ss')
                     }
                     $('#calendar').fullCalendar('renderEvent', newEvent);
                  },
                  success: function(result){
                     location.reload();  
                  }
               })
            });
         },

         header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaDay,listWeek'
         },

         eventClick: function(calEvent, jsEvent, view) {
            $('#modalUpdate').modal();
            $('#ModalAppointmentUpdate').val(calEvent.title)
            $('#ModalDateUpdate').val($.fullCalendar.formatDate(calEvent._start, 'YYYY-MM-DD HH:mm:ss'))

            // UPDATE Appointment
            jQuery('#ModalUpdate').click(function () {
               $.ajax({ // ajax for delete appointment
                  type : 'POST',
                  data : {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', id: calEvent.id, title: $('#ModalAppointmentUpdate').val(), date: $('#ModalDateUpdate').val() },
                  url : "calendar/ajaxupdate/",
                  beforeSend: function( xhr ) {
                     // before change from server, first change on browser
                     calEvent.title = $('#ModalAppointmentUpdate').val();
                     calEvent.start = $('#ModalDateUpdate').val();
                     $('#calendar').fullCalendar('updateEvent', calEvent);
                  },
                  success: function(result){ // return from PHP server
                     location.reload();  
                  }
               })
            });

            // DELETE Appointment
            $remove_appoinment = $(this).css('display', '');
            jQuery('#ModalDelete').click(function () {
               $remove_appoinment.css('display', 'none'); 
               $.ajax({ // ajax for delete appointment
                  type : 'POST',
                  data : {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', id: calEvent.id},
                  url : "calendar/ajaxdelete/",
                  success: function(result){ // return from PHP server
                  }
               })
            });
         },

         navLinks: true, // can click day/week names to navigate views
         editable: true,
         eventLimit: true, // allow "more" link when too many events
         events: 'calendar/ajaxevent' // get event list from JSON format
      });






   });



   $(function() {
      //Validation
      $('#jsvalidate').validate({
          // focusInvalid: false, 
          ignore: "",
          rules: {
           appointment: { required: true },
           app_date: { required: true }
        },

        messages: {
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

