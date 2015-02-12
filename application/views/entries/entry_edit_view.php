<?php include APPPATH . 'views/header_view.php'; ?>
    <div id="content">
        
        <p><?php echo $bread; ?></p>
        <h1><?php echo $page['title']; ?></h1>
        
        <form name="update_entry" method="POST" action="<?php $_SERVER['PHP_SELF'];?>" target="_self" accept-charset="UTF-8">
        <?php 
        foreach($entry as $entry) { ?>
            <input type="hidden" name="ID" value="<?php echo $entry->id; ?>" />
            <input type="text" name="post_title" value="<?php echo $entry->post_title;?>" /><br />
            <textarea name="post_content" cols="80" rows="20"><?php echo $entry->post_content;?></textarea><br />
        <?php 
        } 
        ?>
            <button type="submit" name="submit" value="true">Update</button>
        </form>
        
    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file entry_edit_view.php */
/* Location: ./application/views/entries/entry_edit_view.php */