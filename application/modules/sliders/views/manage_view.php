<?php include APPPATH . 'views/header_view.php'; ?> 
       
    <div class="row" style="padding:35px 15px">
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

        if( isset($errors)) {            
            foreach($errors as $error) {
                echo '
                <div style="padding:0 20px">
                    <div class="alert alert-danger">' . $error . '</div>
                </div>';
            }
        }
        // var_dump($slider_photos);
        ?>
        <div id="page_slider_list" class="col-lg-12">
        
            <?php 
            if( ! empty($slider_photos)) {
                foreach($slider_photos as $photo): 
                    $photo_ext = mime_file_type($photo->mime_type);
                    $photo_filename = substr($photo->photo_filename, 0, -4) . '-380x290.' . $photo_ext;
            ?>
            <div id="page_slider_item_<?php echo $photo->photo_id; ?>" style="max-width: 250px;" class="col-md-3">
                <div class="gal-img-container handle">
                  <div class="gal-img-option">
                    <ul class="list-options">
                      <li><a href="<?php echo BASE_URL . 'addons/load/sliders/manage/'.$slider_id.'/edit/' . $photo->photo_id . '#photoEditModal'; ?>" data-toggle="modal">
                            <i class="fa fa-pencil"></i> <span>Edit</span></a></li>
                      <li><a href="<?php echo BASE_URL . $photo->photo_filename; ?>"><i class="fa fa-eye"></i> <span>View</span></a></li>
                      <li><a href="#"><i class="fa fa-cloud-download"></i> <span>Download</span></a></li>
                      <li><a href="<?php echo BASE_URL . 'addons/load/sliders/manage/'.$slider_id.'/delete/' . $photo->photo_id; ?>">
                            <i class="fa fa-trash-o"></i> <span>Delete</span></a></li>
                    </ul>
                  </div>
                  <div class="gal-image">
                    <a href="<?php echo BASE_URL . $photo->photo_filename; ?>" class="img-group-gallery cboxElement" title="<?php $photo->photo_title; ?>">
                        <img src="<?php echo BASE_URL . $photo_filename; ?>" class="img-responsive" title="<?php $photo->photo_title; ?>" alt="<?php $photo->photo_alt; ?>">
                    </a>
                  </div>
                <!--
                <div class="post-meta">
                    <ul class="list-meta list-inline">
                      <li><i class="fa fa-eye"></i> 117</li>
                      <li><i class="fa fa-comment"></i> 7</li>
                      <li><i class="fa fa-cloud-download"></i> 8</li>
                      <li><i class="fa fa-heart"></i> 9</li>
                    </ul>
                </div> 
                -->
                  <div class="gal-img-desc">
                    <i class="fa fa-tags"></i> Tags : <a href="#">Tower</a>, <a href="#">City</a>, <a href="#">Building</a>
                  </div>
                </div>
            </div><!--/ image -->
            <?php endforeach; 
            }
            ?>            
            <div style="max-width: 250px;" class="col-md-3 col-sm-6 col-xs-12">
                <div class="upload-modal-toggle">
                    <a href="#photoUploadModal" data-toggle="modal">
                        <div class="upload-modal-toggle-link">
                            <i class="fa fa-plus fa-3x"></i><br />
                            <span>Upload Image</span>
                        </div>
                    </a>
                </div>                 
            </div><!--/ image -->
        </div><!-- // .col-lg-12 -->
    </div>
    
    <!-- Upload modal -->
    <div class="fullscreen-modal modal fade" id="photoUploadModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <h2>Photo Upload</h2>
                            <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                            
                            
                            <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data" >
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="text-left">
                                            Select File To Upload:<br />
                                            <input type="file" name="userfile" multiple="multiple" />
                                            <br />
                                            <div class="badge">IMAGES 5MB max in size.</div>
                                        </div>
                                
                                        <br />
                                        <label>Select Mode:</label>
                                        <input type="radio" name="mode" value="crop" checked="checked" />   Crop
                                        <input type="radio" name="mode" value="resize" />   Resize
                                        <input type="radio" name="mode" value="rotate" />   Rotate
                                        <input type="radio" name="mode" value="watermark" />   Water Mark
                                        <br />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" name="image_title" class="form-control input-md" placeholder="Image title (optional)" value="<?php if(Input::get('image_title')) echo Input::get('image_title');?>" />
                                        <span class="help-block text-left"><em>This text will show in place of the image if it doesn't load.</em></span>  
                                        <br />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea name="image_caption" class="form-control mceAdvanced" cols="80" rows="4" placeholder="Image caption (optional)"><?php if(Input::get('image_caption')) echo Input::get('image_caption');?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <br />
                                        <!-- <input type="submit" name="submit" value="Upload" class="btn btn-success" /> -->
                                        <button type="submit" name="submit" value="Upload" class="btn btn-success"><i class="fa fa-upload"></i> Upload</button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                                    </div>
                                </div>
                            </form>
                            <?php
                            if(isset($image_info)) {
                                foreach($image_info as $info) {
                                    echo $info . '<br />';
                                }
                            }
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Photo Edit Modal -->
    <div class="fullscreen-modal modal fade" id="photoEditModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <h2>Edit Upload</h2>
                            <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                            
                            
                            <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data" >
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="text-left">
                                            Select File To Upload:<br />
                                            <input type="file" name="userfile" multiple="multiple" />
                                            <br />
                                            <div class="badge">IMAGES 5MB max in size.</div>
                                        </div>
                                
                                        <br />
                                        <label>Select Mode:</label>
                                        <input type="radio" name="mode" value="crop" checked="checked" />   Crop
                                        <input type="radio" name="mode" value="resize" />   Resize
                                        <input type="radio" name="mode" value="rotate" />   Rotate
                                        <input type="radio" name="mode" value="watermark" />   Water Mark
                                        <br />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" name="image_title" class="form-control input-md" placeholder="Image title (optional)" value="<?php if(Input::get('image_title')) echo Input::get('image_title');?>" />
                                        <span class="help-block text-left"><em>This text will show in place of the image if it doesn't load.</em></span>  
                                        <br />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea name="image_caption" class="form-control mceAdvanced" cols="80" rows="4" placeholder="Image caption (optional)"><?php if(Input::get('image_caption')) echo Input::get('image_caption');?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <br />
                                        <!-- <input type="submit" name="submit" value="Upload" class="btn btn-success" /> -->
                                        <button type="submit" name="submit" value="Upload" class="btn btn-success"><i class="fa fa-upload"></i> Upload</button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                                    </div>
                                </div>
                            </form>
                            <?php
                            if(isset($image_info)) {
                                foreach($image_info as $info) {
                                    echo $info . '<br />';
                                }
                            }
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file .php */
/* Location: ./application/modules/sliders/views/ .php */