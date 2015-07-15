                    </div>
                </div>
                
                <div class="options-pane">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <?php options_pane_widgets(true); ?>
                        </div>
                        <!-- Tabs underlined -->
                        <div class="col-xs-12 col-sm-12">
                            <!-- 
                            <div class="tabbable-panel bg-white">
                                <div class="tabbable-line">
                                    <ul class="nav nav-tabs ">
                                        <li class="active">
                                            <a href="#tab_default_1" data-toggle="tab">
                                            Tab 1 </a>
                                        </li>
                                        <li>
                                            <a href="#tab_default_2" data-toggle="tab">
                                            Tab 2 </a>
                                        </li>
                                        <li>
                                            <a href="#tab_default_3" data-toggle="tab">
                                            Tab 3 </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_default_1">
                                            <p>
                                                I'm in Tab 1.
                                            </p>
                                            <p>
                                                Duis autem eum iriure dolor in hendrerit in vulputate velit esse molestie consequat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat.
                                            </p>
                                            <p>
                                                <a class="btn btn-success" href="http://j.mp/metronictheme" target="_blank">
                                                    Learn more...
                                                </a>
                                            </p>
                                        </div>
                                        <div class="tab-pane" id="tab_default_2">
                                            <p>
                                                Howdy, I'm in Tab 2.
                                            </p>
                                            <p>
                                                Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat. Ut wisi enim ad minim veniam, quis nostrud exerci tation.
                                            </p>
                                            <p>
                                                <a class="btn btn-warning" href="http://j.mp/metronictheme" target="_blank">
                                                    Click for more features...
                                                </a>
                                            </p>
                                        </div>
                                        <div class="tab-pane" id="tab_default_3">
                                            <p>
                                                Howdy, I'm in Tab 3.
                                            </p>
                                            <p>
                                                Duis autem vel eum iriure dolor in hendrerit in vulputate. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
                                            </p>
                                            <p>
                                                <a class="btn btn-info" href="http://j.mp/metronictheme" target="_blank">
                                                    Learn more...
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            -->
                        </div>
                    </div>                    
                </div><!-- // Options pane -->                
            </section>
            
            <footer class="footer">  
                <ul>
                    <li><a class="nav-main-tooltip-top" href="#" title="Edit profile"><span id="user"><font>Welcome, Admin</font></span></a></li>
                    <li><a class="nav-main-tooltip-left" href="#" title="Manage preferences"><span id="setting"></span></a></li>
                    <!-- <li><a class="nav-main-tooltip-top" href="#"><span id="exit"></span></a></li> -->
                </ul>
            </footer>
        </div>
    </div>
	
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
    ?>
    
    <!-- Core Scripts - Include with every page -->
    <script src="<?php echo admin_theme_uri(); ?>public_html/themes/_system/js/app.js"></script>
    
	
</body>
</html>