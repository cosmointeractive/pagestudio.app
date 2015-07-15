<?php include APPPATH . 'views/header_view.php'; ?>
    <div id="content" style="padding: 30px 10px; height: 91.789%;" class="bg-grey clearfix">   
        <?php 
        if( isset($errors)) {            
            foreach($errors as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
        }
        ?>
        <form id="editor" name="update_entry" method="POST" action="<?php $_SERVER['PHP_SELF'];?>" target="_self" accept-charset="UTF-8">
            <div class="row">
                <div class="col-md-10">
                    <?php 
                    foreach($entry as $entry) { ?>
                    <div style="display:none;">
                        <input type="hidden" name="ID" value="<?php echo $entry->id; ?>" />
                        <input type="hidden" name="save" value="true" />
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="post_title" class="form-control input-md" placeholder="Enter title here" value="<?php echo $entry->post_title;?>" />
                            <span class="help-block"><em>The title tag shows up in Search Engine Result Pages (SERPs).</em></span>  
                            <br />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <textarea name="post_content" class="form-control mceAdvanced" cols="80" rows="20"><?php echo remove_slashes( $entry->post_content );?></textarea>
                        </div>
                    </div>
                </div>
                <?php 
                } 
                ?>
                <div class="col-md-2">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h3 class="panel-title">Categories</h3></div>
                        <div class="panel-body">
                            <?php 
                            /**
                             * Build the categories checkbox list
                             * 
                             * Display a list of categories and check the ones that 
                             * applies to this post.
                             *
                             * @param      array $categories['categories'] Array of all categories
                             * @param      array $categories['matches'] Array of all matching the post ID
                             */ 
                            foreach($categories['categories'] as $key => $item) {
                                $category_ID    = $item->category_ID;
                                $checkbox       = '<input type="checkbox" name="post_categories[]" value="'.$item->category_ID.'"';
                                
                                /**
                                 * If the post is tied to category, mark it as checked
                                 */
                                foreach($categories['matches'] as $key => $cat) {
                                    if($category_ID === $cat['category_ID']) {
                                        $checkbox .= 'checked';
                                    }
                                }
                                echo $checkbox . '> ' . $item->category_title . '<br />';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file entry_edit_view.php */
/* Location: ./application/views/entries/entry_edit_view.php */