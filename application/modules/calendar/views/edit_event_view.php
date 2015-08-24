<?php include APPPATH . 'views/header_view.php'; ?>
    <div id="content" style="padding: 30px 20px; max-width: 960px;">
        <?php         
        if( isset($errors)) {            
            foreach($errors as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
        }

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
        <form id="editor" name="update_event" method="POST" action="<?php $_SERVER['PHP_SELF'];?>" target="_self" accept-charset="UTF-8">
            <?php 
            foreach($event as $event): ?>
            <div style="display:none;">
                <input type="hidden" name="id" value="<?php echo $event->id; ?>" />
                <input type="hidden" name="save" value="true" />
            </div>
            
            <div class="form-group">
                <div class="col-md-12">
                    <label>Select Recurrence:</label>
                    <input type="radio" name="occurence" value="crop" checked="checked" /> None
                    <input type="radio" name="occurence" value="crop" /> Daily
                    <input type="radio" name="occurence" value="resize" /> Weekly
                    <input type="radio" name="occurence" value="rotate" /> Monthly
                    <input type="radio" name="occurence" value="watermark" /> Yearly
                    <br />
                    <br />
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Event Start Date</label>
                        <div class='input-group' id='datetime-picker-a'>
                            <input type="text" name="start" id="start" class="form-control input-md" placeholder="Event time (required)" value="<?php echo $event->start; ?>" />
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Event End Date</label>
                        <div class='input-group' id='datetime-picker-b'>
                            <input type="text" name="end" id="end" class="form-control input-md" placeholder="Event time (required)" value="<?php echo $event->end; ?>" />
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control input-md" placeholder="Enter title here" value="<?php if(Input::exists('post')) echo Input::get('title'); else echo $event->title;?>" />
                    <span class="help-block"><em>This is what will show up on the calendar.</em></span>  
                    <br />
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-12">
                    <label>Description</label>
                    <textarea name="description" class="form-control mceAdvanced" cols="80" rows="8"><?php if(Input::exists('post')) echo Input::get('description'); else echo $event->description; ?></textarea>
                </div>
            </div>
            
            <?php endforeach; ?>
        </form>

    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file .php */
/* Location: ./application/modules/sliders/views/ .php */