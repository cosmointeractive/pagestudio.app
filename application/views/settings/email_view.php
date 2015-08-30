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
                $mail_server        = (Input::get('mail_server')) ? Input::get('mail_server') : (isset($option->mail_server) ? $option->mail_server : '');
                $mail_login         = (Input::get('mail_login')) ? Input::get('mail_login') : (isset($option->mail_login) ? $option->mail_login : '');
                $mail_password      = (Input::get('mail_password')) ? Input::get('mail_password') : (isset($option->mail_password) ? $option->mail_password : '');
                $mail_incoming_srv  = (Input::get('mail_incoming_srv')) ? Input::get('mail_incoming_srv') : (isset($option->mail_incoming_srv) ? $option->mail_incoming_srv : '');
                $mail_outgoing_srv  = (Input::get('mail_outgoing_srv')) ? Input::get('mail_outgoing_srv') : (isset($option->mail_outgoing_srv) ? $option->mail_outgoing_srv : '');
                $mail_ssl_on        = (Input::get('mail_ssl_on')) ? Input::get('mail_ssl_on') : (isset($option->mail_ssl_on) ? $option->mail_ssl_on : '');
                $mail_authen_srvc   = (Input::get('mail_authen_srvc')) ? Input::get('mail_authen_srvc') : (isset($option->mail_authen_srvc) ? $option->mail_authen_srvc : '');
                $mail_incoming_port = (Input::get('mail_incoming_port')) ? Input::get('mail_incoming_port') : (isset($option->mail_incoming_port) ? $option->mail_incoming_port : '');
                $mail_outgoing_port = (Input::get('mail_outgoing_port')) ? Input::get('mail_outgoing_port') : (isset($option->mail_outgoing_port) ? $option->mail_outgoing_port : '');
                $mail_send_as_html  = (Input::get('mail_send_as_html')) ? Input::get('mail_send_as_html') : (isset($option->mail_send_as_html) ? $option->mail_send_as_html : '');
            ?>
            <div class="row">		
                <!-- General Settings
                ============================================== -->
                <div class="col-lg-6">			
                    
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Mail Server</label>
                            <div class="col-lg-9">
                                <input name="mail_server" type="text" id="" value="<?php echo $mail_server; ?>" class="form-control" maxlength="250" />
                                <span class="help-block"><em>The address to the mail server, not an IP address.</em></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Mail Login</label>
                            <div class="col-lg-9">
                                <input name="mail_login" type="text" id="" value="<?php echo $mail_login; ?>" class="form-control" maxlength="250" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Mail Password</label>
                            <div class="col-lg-9">
                                <input name="mail_password" type="password" id="" value="<?php echo $mail_password; ?>" class="form-control" maxlength="250" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Mail Incoming Server</label>
                            <div class="col-lg-9">
                                <input name="mail_incoming_srv" type="text" id="" value="<?php echo $mail_incoming_srv; ?>" class="form-control" maxlength="250" />
                                <span class="help-block"><em>If different from the <b>Mail Server</b> in field one.</em></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Mail Outgoing Server</label>
                            <div class="col-lg-9">
                                <input name="mail_outgoing_srv" type="text" id="" value="<?php echo $mail_outgoing_srv; ?>" class="form-control" maxlength="250" />
                                <span class="help-block"><em>If different from the <b>Mail Server</b> in field one.</em></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Mail Incoming Port</label>
                            <div class="col-lg-9">
                                <input name="mail_incoming_port" type="text" id="" value="<?php echo $mail_incoming_port; ?>" class="form-control" maxlength="250" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Mail Outgoing Port</label>
                            <div class="col-lg-9">
                                <input name="mail_outgoing_port" type="text" id="" value="<?php echo $mail_outgoing_port; ?>" class="form-control" maxlength="250" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-lg-3 text-right">Send Mail As HTML?</label>
                            <div class="col-lg-9">
                                <select name="mail_send_as_html" class="form-control">
                                    <option value=""></option>
                                    <option value="1" <?php if($mail_send_as_html === '1') echo 'SELECTED'; ?>>Yes</option>
                                    <option value="0" <?php if($mail_send_as_html === '0') echo 'SELECTED'; ?>>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-lg-3 text-right">Send As Secure Email?</label>
                            <div class="col-lg-9">
                                <select name="mail_ssl_on" class="form-control">
                                    <option value=""></option>
                                    <option value="1" <?php if($mail_ssl_on === '1') echo 'SELECTED'; ?>>Yes</option>
                                    <option value="0" <?php if($mail_ssl_on === '0') echo 'SELECTED'; ?>>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-lg-3 text-right">Authentication Service</label>
                            <div class="col-lg-9">
                                <select name="mail_authen_srvc" class="form-control">
                                    <option value=""></option>
                                    <option value="ssl" <?php if($mail_authen_srvc === 'ssl') echo 'SELECTED'; ?>>SSL</option>
                                    <option value="tls" <?php if($mail_authen_srvc === 'tls') echo 'SELECTED'; ?>>TLS</option>
                                </select>
                            </div>
                        </div>
                    </div>				

                </div><!--/ .col-lg-6 -->

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

/* End of file email_view.php */
/* Location: ./application/views/settings/email_view.php */