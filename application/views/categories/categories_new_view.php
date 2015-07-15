<?php include APPPATH . 'views/header_view.php'; ?>
    <div id="content" style="padding: 30px 10px; height: 91.789%;" class="bg-grey clearfix">   
        <?php 
        if( isset($errors)) {            
            foreach($errors as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
        }
        ?>
        <form id="editor" name="add_entry" method="POST" action="<?php $_SERVER['PHP_SELF'];?>" target="_self" accept-charset="UTF-8">
            <div class="row">
                <div class="col-md-10">
                    <div style="display:none;">
                        <input type="hidden" name="save" value="true" />
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="category_title" class="form-control input-md" placeholder="Enter title here" value="" />
                            <br />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <textarea name="category_description" class="form-control mceSimple" cols="80" rows="20"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file categories_new_view.php */
/* Location: ./application/views/entries/categories_new_view.php */