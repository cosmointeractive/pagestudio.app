<?php include APPPATH . 'views/header_view.php'; ?>
    <div id="content">
        
        <p><?php echo $bread; ?></p>
        <h1><?php echo $page['title']; ?></h1> 

        <?php 
        if(Session::exists('success')) {
            echo Session::flash('success') . '<br /><br />';            
        }
        
        if(Input::exists('post') && !Input::get('thumbnail')) {
        ?>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Original Image
                        </div>
                        <div class="panel-body">
                            <img src="<?php echo $large_image; ?>" id="thumbnail" alt="Create Thumbnail" width="1024" class="scale-with-grid"/>
                        </div>		
                    </div><!--/.panel --> 
                </div><!--/.col-lg-12 --> 

                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Crop
                        </div>
                        <div class="panel-body preview-pane" style="border:1px #e5e5e5 solid; position:relative; overflow:hidden; width:1900px; height:600px;">
                            <img src="<?php echo $large_image; ?>" alt="Thumbnail Preview" width="" class="scale-with-grid" />
                        </div>	
                        <div class="panel-footer">
                            <form name="thumbnail" action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="thumbnail" value="true" />
                                <input type="hidden" name="source" value="<?php echo $large_image_path; ?>" />
                                <input type="hidden" name="x1" value="" id="x1" />
                                <input type="hidden" name="y1" value="" id="y1" />
                                <input type="hidden" name="x2" value="" id="x2" />
                                <input type="hidden" name="y2" value="" id="y2" />
                                <input type="hidden" name="w" value="" id="w" />
                                <input type="hidden" name="h" value="" id="h" />
                                
                                <button type="submit" id="save_thumb" name="upload_thumbnail" class="btn btn-primary">Save Crop Image</button>
                            </form>
                        </div>
                    </div><!--/.panel --> 
                </div><!--/.col-lg-12 --> 
            </div>
        <?php 
        } else {
        ?>
        <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data" >
            Select File To Upload:<br />
            <input type="file" name="userfile" multiple="multiple" />
            <br /><br />
            <div class="bubble-msg"><span><span>IMAGES 5MB max in size.</span></span></div>
            <br />
            <label>Select Mode:</label>
            <input type="radio" name="mode" value="crop" checked="checked" />   Crop
            <input type="radio" name="mode" value="resize" />   Resize
            <input type="radio" name="mode" value="rotate" />   Rotate
            <input type="radio" name="mode" value="watermark" />   Water Mark
            <br /><br />
            <input type="submit" name="submit" value="Upload" class="btn btn-success" />
        </form>
        <?php 
        }
        ?>

    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file .php */
/* Location: ./application/modules/sliders/views/ .php */