<?php include APPPATH . 'views/header_view.php'; ?>
    <div id="content">
        
        <p><?php echo $bread; ?></p>
        <h1><?php echo $page['title']; ?></h1>
        
        <form name="add_entry" method="POST" action="<?php $_SERVER['PHP_SELF'];?>" target="_self" accept-charset="UTF-8">
            <input type="text" name="category_title" value="" /><br />
            <textarea name="category_description" cols="80" rows="20"></textarea><br />
            <button type="submit" name="submit" value="true">Save</button>
        </form>
        
    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file addnew_view.php */
/* Location: ./application/views/page_sliders/addnew_view.php */