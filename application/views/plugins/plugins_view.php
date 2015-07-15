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
        <div class="col-lg-12">
            
        </div><!-- // .col-lg-12 -->
    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file entry_view.php */
/* Location: ./application/views/entries/entries_view.php */