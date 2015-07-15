<?php include APPPATH . 'views/header_view.php'; ?>
    <div id="content" style="padding: 30px 20px;">
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
        <form id="editor" name="add_entry" method="POST" action="<?php $_SERVER['PHP_SELF'];?>" target="_self" accept-charset="UTF-8">
            <?php 
            foreach($slideshow as $entry): ?>
            <div style="display:none;">
                <input type="hidden" name="slider_id" value="<?php echo $entry->id; ?>" />
                <input type="hidden" name="slideshow_edit" value="true" />
            </div>
            
            <div class="form-group">
                <div class="col-md-12">
                    <input type="text" name="slider_title" class="form-control input-md" placeholder="Enter title here" value="<?php if(Input::get('slider_title')) echo Input::get('slider_title'); else echo $entry->slider_title;?>" />
                    <span class="help-block"><em>This is a descriptive name only. It will not show up on the site.</em></span>  
                    <br />
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-12">
                    <textarea name="slider_description" class="form-control mceAdvanced" cols="80" rows="8"><?php if(Input::get('slider_description')) echo Input::get('slider_description'); else echo $entry->slider_description; ?></textarea>
                </div>
            </div>
            
            <!-- Button -->
            <div class="form-group">
                <div class="col-md-12">
                    <br />
                    <button type="submit" name="submit" class="btn btn-success" value="true">Save Changes</button>
                </div>
            </div>
            <?php endforeach; ?>
        </form>

    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file .php */
/* Location: ./application/modules/sliders/views/ .php */