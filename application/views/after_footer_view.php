<!-- jQuery
================================================== -->
    
    <!-- Base_url -->
    <script type="text/javascript">
        var base_url = '<?php echo $GLOBALS['config']['base_url']; ?>';
    </script>

	<!-- jQuery 2.0.2 -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script> 
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    
    <!-- Plugin - SlimScroll -->
    <script src="<?php echo admin_theme_uri(); ?>public_html/themes/_system/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo admin_theme_uri(); ?>public_html/themes/_system/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo admin_theme_uri(); ?>public_html/themes/_system/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    
    <!-- Plugin - Datepicker and Moment -->
    <script src="<?php echo admin_theme_uri(); ?>public_html/themes/_system/js/lib/moment.min.js"></script>
    <script src="<?php echo admin_theme_uri(); ?>public_html/themes/_system/js/plugins/datetime-picker/bootstrap-datetimepicker.min.js"></script>
    
    <!-- Module level scripts -->
    <?php 
    if($this->pageJS()){
        foreach($this->pageJS() as $script => $source){
            if($script === 'function') {
                echo '<script type="text/javascript">'. $source . '</script>';
            } else {
                echo '<script type="text/javascript" src="' . $source . '"></script>' . "\n";
            }
        }
    }
    
    // Include custom script from plugins and modules 
    if (class_exists('MY_View') && method_exists($this, 'pageScript')) {
        if($this->pageScript()) {
            foreach($this->pageScript() as $script => $source) {
                if(file_exists($source)) {
                    include_once $source;
                }
            }
        }
    }
    ?>
    
    <!-- Core Scripts - Include with every page -->
    <script src="<?php echo admin_theme_uri(); ?>public_html/themes/_system/js/app.js"></script>

</body>
</html>
<?php
/* End of file after_footer_view.php */
/* Location: ./application/views/after_footer_view.php */