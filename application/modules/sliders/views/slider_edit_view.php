<?php include APPPATH . 'views/header_view.php'; ?>
    <div id="content">
        
        <p><?php echo $bread; ?> > Slideshow name</p>
        <h1><?php echo $page['title']; ?></h1> 
        
        <?php 
        if(Session::exists('success')) {
            echo Session::flash('success') . '<br /><br />';            
        }?>
        <p><a href="<?php echo BASE_URL . 'sliders/add/' ?>">Add New</a></p>
        
        <?php 
        $exclude = array();        
        foreach ($slideshow as $image) {
        ?>
            <?php echo $image->id; ?>
            <?php echo $image->file_name; ?>
            <a href="<?php echo BASE_URL . 'sliders/edit/' . $image->id;?>">Edit</a> |
            <a href="<?php echo BASE_URL . 'sliders/delete/' . $image->id;?>">Delete</a> <br />
        <?php 
            $exclude[] = $image->page_slug;
        } 
        ?>
        
    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file .php */
/* Location: ./application/modules/sliders/views/ .php */