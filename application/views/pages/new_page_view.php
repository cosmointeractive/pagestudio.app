<?php include APPPATH . 'views/header_view.php'; ?>
    <div id="content" style="padding: 10px 20px; height: 91.789%;" class="bg-grey clearfix">   
        <?php 
        foreach($errors as $error) {
            echo '<div class="alert alert-danger">' . $error . '</div>';
        }
        ?>
        <form id="editor" name="add_entry" method="POST" action="<?php $_SERVER['PHP_SELF'];?>" target="_self" accept-charset="UTF-8">
            <div style="display:none;">
                <input type="hidden" name="save" value="true" />
            </div>
            
            <div class="form-group">
                <div class="col-md-12">
                    <input type="text" name="page_title" class="form-control input-md" placeholder="Enter title here" value="<?php if(Input::get('page_title')) echo Input::get('page_title');?>" />
                    <span class="help-block"><em>Your page title tag shows up in Search Engine Result Pages (SERPs). Search engines such as Google, Yahoo, and Bing use the title tag as the search results' title for that page.</em></span>  
                    <br />
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-12">
                    <textarea name="page_content" class="form-control mceAdvanced" cols="80" rows="20"><?php if(Input::get('page_content')) echo Input::get('page_content');?></textarea>
                </div>
            </div>
            
            <!-- Button -->
            <div class="form-group">
                <div class="col-md-12">
                    <br />
                    <!--<button type="submit" name="submit" class="btn btn-success" value="true">Save Changes</button> -->
                </div>
            </div>
        </form>
        
    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file new_page_view.php */
/* Location: ./application/views/pages/new_page_view.php */