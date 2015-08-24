<?php 
/**
 * PageStudio
 *
 * A web application for managing website content. For use with PHP 5.4+
 * 
 * This application is based on the PHP framework, 
 * PIP http://gilbitron.github.io/PIP/. PIP has been greatly altered to 
 * work for the purposes of our development team. Additional resources 
 * and concepts have been borrowed from CodeIgniter,
 * http://codeigniter.com for further improvement and reliability. 
 *
 * @package     PageStudio
 * @author      Cosmo Mathieu <cosmo@cosmointeractive.co>   
 */
 
// ------------------------------------------------------------------------

/**
 * This file is the init file for the calendar module
 */ ?>
<script type="text/javascript">
	$(document).ready(function() {
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();		
		var calendar = $('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek'
			}, 
			selectable: true,
			selectHelper: true,
			editable: true,
			eventLimit: true,           // allow "more" link when too many events
			events: base_url + "<?php echo APPPATH . 'modules/calendar/libraries/events.php';?>",
			select: function(start, end, allDay) {
				var modal 	= $("#fullCalModalAddEvent");
				
				// Set default date value for date input fields
				$('input[name="event_start"]').val( moment(start).format('YYYY/MM/DD HH:mm:ss'));
				$('input[name="event_end"]').val( moment(end).format('YYYY/MM/DD HH:mm:ss'));

				// Set default date for time picker after they are clicked
				$('#datetimepicker6').datetimepicker({
					'format' : 'YYYY/MM/DD HH:mm A',
				}).on('dp.change', function(e){
					// https://github.com/eternicode/bootstrap-datepicker/issues/57
					$('#datetimepicker7').data("DateTimePicker").minDate(e.date);
				});

				// Set default date for time picker after they are clicked
				$('#datetimepicker7').datetimepicker({
					'format' : 'YYYY/MM/DD HH:mm A'
				}).on("dp.change", function (e) {
					$('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
				});
                
				modal.modal();
                
                $('button#submit').click(function(e){
					e.preventDefault();
					// tinyMCE.get("addEvent").save();
					 tinyMCE.triggerSave();  // Save the content of the textarea before serializing 
					$.ajax({
						type: "POST",
						url: base_url + '<?php echo APPPATH . 'modules/calendar/libraries/add_events.php';?>',
						data: $('form.addEvent').serialize(),
						success: function(data) {
							// $("#thanks").html(msg);
							modal.modal('hide'); 
							// alert(data);
                            $('#calendar').fullCalendar('refetchEvents');
						}
						// error: function() {
							// alert("failure");
						// }
					});				
                });
                
                calendar.fullCalendar('unselect');                
			},
            eventClick: function(event, jsEvent, view) {
				var start = moment(event.start).format('MMMM Do YYYY, h:mm a');
				var end = moment(event.end).format('MMMM Do YYYY, h:mm a');
                $('#calEventID').html(event.id);
                $('#modalTitle').html(event.title);
                $('#modalBody').html(event.description);
                $('#calEventStart').html(start);
                $('#calEventEnd').html(end);
                $('#eventUrl').attr('href',event.url);
                $('#fullCalModal').modal();
            },
			eventDrop: function(event, delta) {
				var start = moment(event.start).format('YYYY/MM/DD HH:mm:ss');
				var end   = moment(event.end).format('YYYY-MM-DD HH:mm:ss');
				$.ajax({
				   url: base_url + '<?php echo APPPATH . 'modules/calendar/libraries/update_events.php';?>',
				   data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id,
				   type: "POST",
				   success: function(json) {
						// alert("Updated Successfully " + end);
				   }
				});
			},
			eventResize: function(event) {
                var start = moment(event.start).format('YYYY/MM/DD HH:mm:ss');
				var end = moment(event.end).format('YYYY-MM-DD HH:mm:ss');
				$.ajax({
                    url: base_url + '<?php echo APPPATH . 'modules/calendar/libraries/update_events.php';?>',
					data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
					type: "POST",
					success: function(json) {
						//alert("Updated Successfully");
					}
				});
			}	   
		}); // .fullCalendar( 'gotoDate', '6/10/2015' );  
        
        /**
         * Delete Event
         * 
         * On-click delete the event from the calendar. 
         * 
         * @author     Cosmo Mathieu <cosmo@cosmointeractive.co>
         */
        $("button.delCalEvent").click(function(){
            var decision = confirm("Do you really want to do that?"); 
            var ID = $('#calEventID').text(); 
            
            if (decision) {
                $.ajax({
                    type: "POST",
                    url: base_url + '<?php echo APPPATH . 'modules/calendar/libraries/delete_event.php';?>',
                    data: "&id=" + ID,
                    success: function(json) {
                        $('#calendar').fullCalendar('removeEvents', ID);
                        // alert("Deleted Successfully");
                    }
                });
            }
        })
		
	});
    
    /**
	 * Show event title real time as user types
     * 
	 * @author     Cosmo Mathieu <cosmo@cosmointeractive.co>
	 * @source     http://stackoverflow.com/questions/25182850/realtime-input-field-value-change-as-user-types		
	 */   
    $(function(){ // this will be called when the DOM is ready
        $('#event_title').keyup(function() {
            $('#display').text($(this).val());
        });
    });
</script>