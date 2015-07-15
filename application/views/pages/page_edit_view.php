<?php include APPPATH . 'views/header_view.php'; ?>
    <div id="content" style="padding: 10px 20px; height: 91.789%;" class="bg-grey clearfix">        
        <form id="editor" name="update_page" method="POST" action="<?php $_SERVER['PHP_SELF'];?>" target="_self">
        <?php 
        foreach($pages as $page) { ?>
            <div style="display:none;">
                <input type="hidden" name="ID" value="<?php echo $page->id; ?>" />
                <input type="hidden" name="save" value="true" />
            </div>
            
            <div class="form-group">
                <div class="col-md-12">
                    <input type="text" name="page_title" class="form-control input-md" placeholder="Page Title" value="<?php echo remove_slashes( $page->page_title );?>" />
                    <span class="help-block"><em>Your page title tag shows up in Search Engine Result Pages (SERPs). Search engines such as Google, Yahoo, and Bing use the title tag as the search results' title for that page.</em></span>  
                    <br />
                </div>
            </div>
            
            <div class="form-group">
              <div class="col-md-12">
                <textarea name="page_content" class="form-control mceAdvanced" cols="80" rows="20"><?php echo remove_slashes( $page->page_content );?></textarea>
              </div>
            </div>
        <?php 
        } 
        ?>
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

/* End of file page_edit_view.php */
/* Location: ./application/views/pages/page_dit_view.php */