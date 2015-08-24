<?php include APPPATH . 'views/header_view.php'; ?>
    <div class="row" style="padding:30px 0">
        <?php 
        if(Session::exists('success')) {
            echo '
            <div style="padding:0 20px">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    ' . Session::flash('success') . '
                </div>
            </div>';
        }
        ?>     
        <div class="col-lg-12 filemanager_container">
            <iframe id="glu" class="fullheight" src="<?php echo BASE_URL . APPPATH . 'plugins/file_manager/dialog.php'; ?>" width="100%" height="500" frameborder="0" onload="resize_iframe()"></iframe>
        </div><!-- // .col-lg-12 -->
    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file pages_view.php */
/* Location: ./application/views/pages/pages_view.php */