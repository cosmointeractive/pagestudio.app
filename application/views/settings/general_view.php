<?php include APPPATH . 'views/header_view.php'; ?>
<br >
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
    if(Session::exists('error')) {
        echo '
        <div style="padding:0 20px">
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                ' . Session::flash('error') . '
            </div>
        </div>';
    }
    if( isset($errors)) {            
        foreach($errors as $error) {
            echo '<div class="alert alert-danger">' . $error . '</div>';
        }
    }
    ?>  
    <div style="padding:30px 20px 0">		
        
        <form name="settings" id="editor" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" target="_self" accept-charset="UTF-8">
            <?php foreach($options as $option) { 
                $site_name = (Input::get('site_name')) ? Input::get('site_name') : (isset($option->site_name) ? $option->site_name : '');
                $site_meta_description = (Input::get('site_meta_description')) ? Input::get('site_meta_description') : (isset($option->site_meta_description) ? $option->site_meta_description : '');
                $site_url = (Input::get('site_url')) ? Input::get('site_url') : (isset($option->site_url) ? $option->site_url : '');
                $blog_url = (Input::get('blog_url')) ? Input::get('blog_url') : (isset($option->blog_url) ? $option->blog_url : '');
                $blog_landing_page = (Input::get('blog_landing_page')) ? Input::get('blog_landing_page') : (isset($option->blog_landing_page) ? $option->blog_landing_page : '');
                $default_date_format = (Input::get('default_date_format')) ? Input::get('default_date_format') : (isset($option->default_date_format) ? $option->default_date_format : '');
                $default_time_format = (Input::get('default_time_format')) ? Input::get('default_time_format') : (isset($option->default_time_format) ? $option->default_time_format : '');
                $tracking_code = $option->tracking_code;
                if(isset($_POST)) {
                    $tracking_code = (empty(Input::get('tracking_code'))) ? '&nbsp;' : $option->tracking_code;
                }
            ?>            
            <div class="row">		
                <!-- General Settings
                ============================================== -->
                <div class="col-lg-6">			
                    
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Site Title</label>
                            <div class="col-lg-9">
                                <input name="site_name" type="text" id="" value="<?php echo $site_name; ?>" class="form-control" maxlength="250" />
                                <span class="help-block"><em>Make this 4 - 5 words. This is listed in search engines' results.</em></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Site Description</label>
                            <div class="col-lg-9">
                                <textarea name="site_meta_description" id="" class="form-control" rows="5"><?php echo $site_meta_description; ?></textarea>
                                <span class="help-block"><em>In a few words, explain what this site is about to visitors.</em></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Website Address (url)</label>
                            <div class="col-lg-9">
                                <input name="site_url" type="text" id="" value="<?php echo $site_url; ?>" class="form-control" maxlength="250" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Blog Address (url)</label>
                            <div class="col-lg-9">
                                <input name="blog_url" type="text" id="" value="<?php echo $blog_url; ?>" class="form-control" maxlength="250" />
                                <span class="help-block"><em>Enter the address here if your <a href="#nogo">site home page</a> is not your blog landing page.</em></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Blog Landing Page</label>
                            <div class="col-lg-9">
                                <input name="blog_landing_page" type="text" id="" value="<?php echo $blog_landing_page; ?>" class="form-control" maxlength="250" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><span>Date Format</span></label>
                            <div class="col-lg-2">
                                <input name="default_date_format" type="text" id="" value="<?php echo $default_date_format; ?>" class="form-control" maxlength="250" />
                            </div>
                            <div class="col-lg-6">
                                <p class="description">
                                    Exaples of date formatting <br />
                                    <span class="example">F jS, Y = <b><?php echo date('F jS, Y')?></b></span> <br />
                                    <span class="example">F j, Y = <b><?php echo date('F j, Y')?></b></span> <br />
                                    <span class="example">Y/m/d = <b><?php echo date('Y/m/d')?></b></span> <br />
                                    <span class="example">m/d/Y = <b><?php echo date('m/d/Y')?></b></span> <br />
                                    <span class="example">d/m/Y = <b><?php echo date('d/m/Y')?></b></span> <br />
                                    <a href="http://kb.cimwebdesigns.com/Formatting_Date_and_Time" target="_blank">Documentation on date and time formatting</a>.
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Time Format</label>
                            <div class="col-lg-2">
                                <input name="default_time_format" type="text" id="" value="<?php echo $default_time_format; ?>" class="form-control" maxlength="250" />
                            </div>
                            <div class="col-lg-6">
                                <p class="description">
                                    Exaples of time formatting <br />
                                    <span class="example">h:ia = <b><?php echo date('h:ia')?></b></span> <br />
                                    <span class="example">g:i a = <b><?php echo date('g:i a')?></b></span> <br />
                                    <span class="example">g:i A = <b><?php echo date('g:i A')?></b></span> <br />
                                    <span class="example">H:i = <b><?php echo date('H:i')?></b></span><br />
                                    <a href="http://kb.cimwebdesigns.com/Formatting_Date_and_Time" target="_blank">Documentation on date and time formatting</a>.
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Tracking Code</label>
                            <div class="col-lg-9">
                                <textarea name="tracking_code" class="form-control" spellcheck='false' rows="15" style="
                                    font-family: 'Source Code Pro', 'Arial,sans-serif';
                                    font-size:75%;
                                    color: #FFFFFF;
                                    background-color: #262A2C; 
                                    border: none;
                                    "
                                    ><?php echo $tracking_code; ?></textarea>
                                <span class="help-block"><em>Search Engine Analytic JavaScript tracking code.</em></span>
                            </div>
                        </div>
                    </div>				

                </div><!--/ .col-lg-6 -->
                
                <!-- Portal Settings
                ============================================== -->            
                <div class="col-lg-2">					
                
                    <div class="form-group">
                        <label for="" class="">Portal online?: <span class="required">*</span></label>
                        <select name="portal_online" class="form-control">
                            <option value=""></option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="" class="">Allow user login?: <span class="required">*</span></label>
                        <select name="portal_login_on" class="form-control">
                            <option value=""></option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="" class="">Allow password reset?: </label>
                        <select name="portal_forgot_pass" class="form-control">
                            <option value=""></option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                </div><!--/ .well -->
            </div><!--/ .col-lg -->

            <!-- .row -->			
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="hidden" name="update" value="true" />
                        <input type="hidden" name="token" value="<?php echo Token::gen(); ?>" />
                    </div>
                </div>
            </div><!--/ .row -->			
            <?php } ?>
        </form><!-- end -->
    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file general_view.php */
/* Location: ./application/views/settings/general_view.php */