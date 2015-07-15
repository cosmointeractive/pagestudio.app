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
// $checkbox = '';
// foreach($categories['categories'] as $key => $item) {
    // $category_ID    = $item->category_ID;
    // $checkbox       .= '<input id="ps1" type="checkbox" name="post_categories[]" value="'.$item->category_ID.'"';
    
    // /**
     // * If the post is tied to category, mark it as checked
     // */
    // foreach($categories['matches'] as $key => $cat) {
        // if($category_ID === $cat['category_ID']) {
            // $checkbox .= 'checked';
        // }
    // }
    // $checkbox .= '> ' . $item->category_title . '<br />';
// }

// options_pane_widget_register( array(
    // 'title' => 'Categories',
    // 'body' => $checkbox
// ));

// options_pane_widget_register( array(
    // 'body' => '<input type="button" class="btn btn-default" onclick="document.getElementById(\'editor\').submit();" value="Save Changes">'
// ));

include APPPATH . 'views/header_view.php'; ?>
    <div id="content" style="padding: 30px 10px; height: 91.789%;" class="bg-grey clearfix">   
        <?php 
        if( isset($errors)) {            
            foreach($errors as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
        }
        ?>
        <form id="editor" name="update_entry" method="POST" action="<?php $_SERVER['PHP_SELF'];?>" target="_self" accept-charset="UTF-8">
            <div class="">
                <?php 
                foreach($entry as $entry) { ?>
                <div class="col-md-9">
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
                            <br />
                            <br />
                        </div>
                    </div>
                </div>
      
                <div class="col-md-3">
                    <div class="tabbable-panel bg-white">
                        <div class="tabbable-line">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_default_1" data-toggle="tab">
                                    Publishing </a>
                                </li>
                                <li>
                                    <a href="#tab_default_2" data-toggle="tab">
                                    Categories </a>
                                </li>                                
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_default_1">
                                    <div id="minor-publishing" class="" style="padding-top: 15px;">
                                    
                                        <div id="minor-publishing-actions">
                                            <div id="save-action">
                                                <span class="spinner"></span>
                                            </div>
                                        </div><!-- #minor-publishing-actions -->

                                        <div id="misc-publishing-actions" class="">

                                            <div class="misc-pub-section misc-pub-post-status">
                                                <label for="post_status">Status:</label>

                                                <select name="post_status" id="post_status">
                                                    <option value="published" <?php if($entry->post_status === 'published') echo 'selected="selected"';?>>Published</option>
                                                    <option value="pending" <?php if($entry->post_status === 'pending') echo 'selected="selected"';?>>Pending Review</option>
                                                    <option value="draft" <?php if($entry->post_status === 'draft') echo 'selected="selected"';?>>Draft</option>
                                                </select>
                                            </div><!-- .misc-pub-section -->

                                            <div class="" id="visibility" style="">
                                                Visibility: <span id="post-visibility-display">Public</span>

                                                <div style="padding-left: 10px;">
                                                    <input name="hidden_post_password" id="hidden-post-password" value="" type="hidden">
                                                    <input name="post_visibility" id="visibility-radio-public" value="public" type="radio" <?php if($entry->post_visibility === 'public') echo 'checked="checked"';?>> <label for="visibility-radio-public" class="selectit">Public</label>
                                                    <br />
                                                    <span id="sticky-span">
                                                        <input id="sticky" name="is_sticky" value="1" type="checkbox" <?php if($entry->is_sticky === '1') echo 'checked';?>> <label for="sticky" class="selectit">Stick this post to the front page</label><br>
                                                    </span>
                                                    <input name="post_visibility" id="visibility-radio-password" value="password" type="radio" <?php if($entry->post_visibility === 'password') echo 'checked="checked"';?>> <label for="visibility-radio-password" class="selectit">Password protected</label><br>
                                                    <span style="display: none;" id="password-span">
                                                        <label for="post_password">Password:</label> <input name="post_password" id="post_password" value="" maxlength="20" type="text"><br>
                                                    </span>
                                                    <input name="post_visibility" id="visibility-radio-private" value="private" type="radio"  <?php if($entry->post_visibility === 'private') echo 'checked="checked"';?>> <label for="visibility-radio-private" class="selectit">Private</label>
                                                </div>

                                            </div><!-- .misc-pub-section -->

                                            <div class="misc-pub-section curtime misc-pub-curtime">
                                                <span id="timestamp">
                                                Published on: <b><?php echo strtotime_date($entry->post_date, 'D, M jS, Y &#64; h:m A');?></b></span>
                                            </div>
                                        </div>
                                    <?php 
                                    } 
                                    ?>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_default_2">
                                    <input type="checkbox" name="CheckAll" id="checkAll" /> All <br />
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
                                        $checkbox       = '<input class="autoCheck" type="checkbox" name="post_categories[]" value="'.$item->category_ID.'"';
                                        
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
                        <div class="tabbable-footer">
                            <input type="button" class="btn btn-success" onclick="document.getElementById('editor').submit();" value="Save Changes">
                        </div>
                    </div>
                    <br />
                    <br />
                    
                </div>
            </div>
        </form>
        
    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file entry_edit_view.php */
/* Location: ./application/views/entries/entry_edit_view.php */