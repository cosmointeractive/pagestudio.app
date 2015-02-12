<?php include APPPATH . 'views/header_view.php'; ?>
    <div id="content">
        
        <p><?php echo $bread; ?></p>
        <h1><?php echo $page['title']; ?></h1>
        
        <?php 
        foreach($entries as $entry){
            echo '<a href="'.BASE_URL.'entries/edit/'.$entry->id.'">' . $entry->post_title . '</a><br />';
        } 
        ?>
        
    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file entry_view.php */
/* Location: ./application/views/entries/entries_view.php */