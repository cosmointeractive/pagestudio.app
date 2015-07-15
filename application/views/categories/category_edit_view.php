<?php include APPPATH . 'views/header_view.php'; ?>
    <div id="content" style="padding: 30px 10px; height: 91.789%;" class="bg-grey clearfix">   
        <?php 
        if( isset($errors)) {            
            foreach($errors as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
        }
        ?>
        <form id="editor" name="update_category" method="POST" action="<?php $_SERVER['PHP_SELF'];?>" target="_self" accept-charset="UTF-8">
            <div class="row">
                <div class="col-md-10">
                    <?php 
                    foreach($entry as $entry) { ?>
                    <div style="display:none;">
                        <input type="hidden" name="ID" value="<?php echo $entry->category_ID; ?>" />
                        <input type="hidden" name="save" value="true" />
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="category_title" class="form-control input-md" placeholder="Enter title here" value="<?php echo remove_slashes( $entry->category_title );?>" />
                            <br />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <textarea name="category_description" class="form-control mceSimple" cols="80" rows="20"><?php echo remove_slashes( $entry->category_description );?></textarea>
                        </div>
                    </div>
                </div>
                <?php 
                } 
                ?>
            </div>
        </form>
        
    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file categories_edit_view.php */
/* Location: ./application/views/categories/categories_edit_view.php */