<?php 
/**
 * This file is the init file for the calendar module
 *
 * @author     Cosmo Mathieu <cosmo@cosmointeractive.co>
 */ ?>
<script>
	$(document).ready(function() {
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();		

		var calendar = $('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				// right: 'month,agendaWeek,agendaDay'
				right: 'month,agendaWeek'
			}, 
			selectable: true,
			selectHelper: true,
			editable: true,
			eventLimit: true,           // allow "more" link when too many events
			// events: "events.php",
			events: base_url + "<?php echo APPPATH . 'modules/calendar/libraries/events.php';?>",
			// events: [
            // events:    <?php include_once APPPATH . 'modules/calendar/libraries/events.php'; ?>
			// ],		   
			// Convert the allDay from string to boolean
			// eventRender: function(event, element, view) {
				// if (event.allDay === 'true') {
					// event.allDay = true;
				// } else {
					// event.allDay = false;
				// }
			// },
			// eventRender: function (event, element) {
				// element.attr('href', 'javascript:void(0);');
				// element.click(function() {
					// $("#startTime").html(moment(event.start).format('MMM Do h:mm A'));
					// $("#endTime").html(moment(event.end).format('MMM Do h:mm A'));
					// $("#eventInfo").html(event.description);
					// $("#eventLink").attr('href', event.url);
					// $("#eventContent").dialog({ modal: true, title: event.title, width:350});
				// });
			// },
			select: function(start, end, allDay) {
                var start   = moment(start).format('YYYY/MM/DD HH:mm:ss');
                var end     = moment(end).format('YYYY/MM/DD ');
                
                $addEvent = $("#addEventModal").dialog({ 
                    modal: true, 
                    title: 'Add Event', 
                    width: 350, 
                    buttons: {
                        "ok": function() {
                            var title   = $('#event_title').val();
                            var description = $('#event_description').val();
                            var endtime    = $('#event_endtime').val();
                            
                            $.ajax({
                                url: base_url + '<?php echo APPPATH . 'modules/calendar/libraries/add_events.php';?>',
                                data: {
                                    'title': title, 
                                    'description': description,
                                    'start': start, 
                                    'end': end + endtime
                                },
                                type: "POST",
                                success: function(json) {
                                    // alert('Added Successfully ' + title + ' ' + description + ' ' + start);
                                }
                            });                            
                            // Persist in showing the results on the calendar after submission
                            calendar.fullCalendar('renderEvent',
                                {
                                    title: title,
                                    start: start,
                                    end: end,
                                    allDay: allDay
                                },
                                true // make the event "stick"
                            );
                            // Reset form fields and variables
                            $('#event_title').val('');
                            $('#event_description').val('');
                            $(this).dialog("close");
                        },
                        "cancel": function() {
                            $('#event_title').val('');
                            $('#event_description').val('');
                            $(this).dialog("close");                            
                        }
                    }
                });

                $addEvent.dialog("open");
                
                calendar.fullCalendar('unselect');                
			},
            eventClick:  function(event, jsEvent, view) {
                $('#modalTitle').html(event.title);
                $('#modalBody').html(event.description);
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
			// eventClick: function(event) {
				// var decision = confirm("Do you really want to do that?"); 
				// if (decision) {
					// $.ajax({
						// // type: "POST",
						// // url: "delete_event.php",
						// // data: "&id=" + event.id,
						// // success: function(json) {
							// // $('#calendar').fullCalendar('removeEvents', event.id);
							// // alert("Deleted Successfully");
						// // }
					// });
				// }
			// },
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
	});
	
	/* 
	 * START JQUERY UI MODAL DEMO CODE
	 */
	// $(document).ready(function() {     
		// $.getScript( "http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" )
		// .done(function( script, textStatus ) {
			// /* Just for fun. Get the event source via AJAX. Not necessary in this case. Just 'cause. */
			// $.ajax({
				// type: "GET",
				// contentType: "application/json",
				// url: "",
				// dataType: "json",
				// success: function(data) {
				   // $('#eventContent').fullCalendar({
						// events: data,
						// header: {
							// left: '',
							// center: 'prev title next',
							// right: ''
						// },
						// theme:true,
						// eventRender: function (event, element) {
							// element.attr('href', 'javascript:void(0);');
							// element.click(function() {
								// $("#startTime").html(moment(event.start).format('MMM Do h:mm A'));
								// $("#endTime").html(moment(event.end).format('MMM Do h:mm A'));
								// $("#eventInfo").html(event.description);
								// $("#eventLink").attr('href', event.url);
								// $("#eventContent").dialog({ modal: true, title: event.title, width:350 });
							// });
						// }
					// });
				// }
			// });
		// });

	// });
</script>