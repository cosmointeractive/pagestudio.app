<?php include APPPATH . 'views/header_view.php'; ?>
    <div class="row" style="padding:20px 15px;">
        <div class="col-md-12">
            <?php 
                if(Session::exists('success')) {
                    echo Session::flash('success');
                }
            ?>            
        </div>
    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file main_view.php */
/* Location: ./application/views/main_view.php */