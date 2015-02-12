<?php include APPPATH . 'views/header_view.php'; ?>
    <div id="content">
        
        <p><?php echo $bread; ?></p>
        <h1>Welcome to PIP</h1>
        <?php 
            if(Session::exists('success')) {
                echo Session::flash('success');
            }
        ?>
        <p>To get started please read the documentation at <a href="http://pip.dev7studios.com/">http://pip.dev7studios.com</a>.</p>
        <p><a href="<?php echo BASE_URL . 'entries';?>">Entries</a></p>
        <p>To log out click <a href="<?php echo BASE_URL . 'login/logout';?>">logout</a></p>
        
    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file main_view.php */
/* Location: ./application/views/main_view.php */