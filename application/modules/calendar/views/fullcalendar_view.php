<?php include APPPATH . 'views/header_view.php'; ?>        
    <div class="row" style="padding:30px 30px;max-width:1260px;">
        <?php 
        if(Session::exists('success')) {
            echo '
            <div style="padding:0 20px">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    ' . Session::flash('success') . '
                </div>
            </div>';
        }
        ?>        
        <div class="col-lg-12">
            
            <div id="eventContent" title="Event Details" style="display:none;">
                Start: <span id="startTime"></span><br>
                End: <span id="endTime"></span><br><br>
                <p id="eventInfo"></p>
                <p><strong><a id="eventLink" href="#" target="_blank">Read More</a></strong></p>
            </div>
            
            <div id="calendar"></div>
        </div><!-- // .col-lg-12 -->
        
    </div>
<?php include_once APPPATH . 'views/pre_footer_view.php' ?>

<!-- Event Edit Modal -->
<div class="fullscreen-modal modal fade" id="fullCalModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <!-- Project Details Go Here -->
                        <h2 id="modalTitle">Edit Upload</h2>
                        <p class="item-intro text-muted"><span id="calEventStart"></span> &dash; <span id="calEventEnd"></span></p>
                        <div style="display:none; visibility:hidden;" id="calEventID"></div>
                        
                        <div id="modalBody" class="modal-body"></div>
                        <br />
                        <a class="btn btn-primary" id="eventUrl" target="_blank">Event Page</a>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                        <button type="button" class="btn btn-primary delCalEvent" data-dismiss="modal"><i class="fa fa-times"></i> Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Edit Modal -->

<!-- Add Event Modal -->
<div class="fullscreen-modal modal fade" id="fullCalModalAddEvent" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl"></div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <!-- Project Details Go Here -->
                        <h2 id="modalTitle"><div id="display"></div></h2>
                        
                        <div id="modalBody" class="modal-body">								
                            <form class="addEvent" id="#addEvent">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Select Recurrence:</label>
                                        <input type="radio" name="mode" value="crop" checked="checked" /> None
                                        <input type="radio" name="mode" value="crop" /> Daily
                                        <input type="radio" name="mode" value="resize" /> Weekly
                                        <input type="radio" name="mode" value="rotate" /> Monthly
                                        <input type="radio" name="mode" value="watermark" /> Yearly
                                        <br />
                                        <br />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class='input-group date' id='datetimepicker6'>
                                                <input type="text" name="event_start" id="event_start" class="form-control input-md" placeholder="Event time (required)" value="" />
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class='input-group date' id='datetimepicker7'>
                                                <input type="text" name="event_end" id="event_end" class="form-control input-md" placeholder="Event time (required)" value="" />
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <br />
                                        <input type="text" name="event_title" id="event_title" class="form-control input-md" placeholder="Event title (required)" />
                                        <span class="help-block text-left"><em>This text will show in place of the image if it doesn't load.</em></span>  
                                        <br />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea name="event_description" id="event_description" class="form-control mceAdvanced" cols="80" rows="4" placeholder="Event details (required)" style="min-height: 300px !important;"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <br />
                                        <button type="button" class="btn btn-success" id="submit">Submit</button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Add Event Modal -->

<?php include APPPATH . 'views/after_footer_view.php'; 

/* End of file fullcalendar_view.php */
/* Location: ./application/modules/calendar/views/fullcalendar_view.php */