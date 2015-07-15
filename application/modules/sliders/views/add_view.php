<?php include APPPATH . 'views/header_view.php'; ?>
    <div id="content" style="padding: 30px 20px;">
        <?php 
        if( isset($errors)) {            
            foreach($errors as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
        }
        ?>
        <form id="editor" name="add_entry" method="POST" action="<?php $_SERVER['PHP_SELF'];?>" target="_self" accept-charset="UTF-8">
            <div style="display:none;">
                <input type="hidden" name="save" value="true" />
            </div>
            
            <div class="form-group">
                <div class="col-md-12">
                    <input type="text" name="slider_title" class="form-control input-md" placeholder="Enter title here" value="<?php if(Input::get('slider_title')) echo Input::get('slider_title');?>" />
                    <span class="help-block"><em>This is a descriptive name only. It will not show up on the site.</em></span>  
                    <br />
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-12">
                    <textarea name="slider_description" class="form-control mceAdvanced" cols="80" rows="8"><?php if(Input::get('slider_description')) echo Input::get('slider_description');?></textarea>
                </div>
            </div>
            
            <!-- Button -->
            <div class="form-group">
                <div class="col-md-12">
                    <br />
                    <button type="submit" name="submit" class="btn btn-success" value="true">Save Changes</button>
                </div>
            </div>
        </form>

    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file .php */
/* Location: ./application/modules/sliders/views/ .php */