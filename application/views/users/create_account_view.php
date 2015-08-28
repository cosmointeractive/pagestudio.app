<?php include APPPATH . 'views/header_view.php'; ?>
    <div id="content" class="row" style="padding: 30px;">
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
        
        if( isset($errors)) {            
            foreach($errors as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
        }
        
        ?>  
        
        <form name="update_user" id="editor" method="POST" action="<?php $_SERVER['PHP_SELF'];?>" target="_self" accept-charset="UTF-8">
            
            <div class="col-lg-4">						
                <h2>User Information</h2>
                
                <div class="form-group">
                    <label for="firstname">First Name: <span class="required">*</span></label>
                    <div class="form-group <?php if (isset($pagelevel_errors['noFname'])) { echo 'has-error'; }?>">
                        <input type="text" name="firstname" class="form-control" value="<?php if(Input::get('firstname')) { echo Input::get('firstname'); } ?>" maxlength="250" />
                    </div>
                </div>
                <div class="form-group">							
                    <label for="lastname">Last Name: <span class="required">*</span></label>
                    <div class="form-group <?php if (isset($errors['noLname'])) { echo 'has-error'; }?>">								
                        <input type="text" name="lastname" class="form-control" value="<?php if(Input::get('lastname')) { echo Input::get('lastname'); } ?>" maxlength="250" />
                    </div>
                </div>
                <div class="form-group">														
                    <label for="email">E-mail Address: <span class="required">*</span></label>
                    <div class="form-group input-group <?php if (isset($errors['noEmail'])) { echo 'has-error'; }?>">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text" name="email" class="form-control" value="<?php if(Input::get('email')) { echo Input::get('email'); } ?>" maxlength="250" />
                    </div>							
                </div>							
            
            </div><!-- .end col-lg-4 -->
            
            <!-- 
            ============================================= -->
            <div class="col-lg-4">			
                <h2>Account Access</h2>
                
                <div class="form-group">
                    <label for="username">Username: <span class="required">*</span></label>
                    <div class="form-group input-group <?php if (isset($errors['noUsername'])) { echo 'has-error'; }?>">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" name="username" class="form-control" value="<?php if(Input::get('username')) { echo Input::get('username'); } ?>" maxlength="250" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password: <span class="required">*</span></label>
                    <?php if (isset($_SESSION['passError'])) { echo '<div class="error">'.$_SESSION['passError'].'</div>'; } ?>
                    <div class="form-group input-group <?php if (isset($_SESSION['passError'])) { echo 'has-error'; }?>">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" value="<?php if(Input::get('password')) { echo Input::get('password'); } ?>" maxlength="250" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Verify Password: <span class="required">*</span></label>
                    <?php if (isset($_SESSION['passError'])) { echo '<div class="error">'.$_SESSION['passError'].'</div>'; } ?>
                    <div class="form-group input-group <?php if (isset($_SESSION['passError'])) { echo 'has-error'; }?>">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" name="password2" class="form-control" value="<?php if(Input::get('password2')) { echo Input::get('password2'); } ?>" maxlength="250" />
                    </div>								
                </div>
                <div class="form-group">
                    <label for="role">User Role: <span class="required">*</span></label>
                    <select name="role" class="form-control">
                        <?php if( ! Input::get('role')) { ?>
                        <option SELECTED value="" class="option"></option>
                        <?php } ?>
                        <option <?php if (Input::get('role') === '2') { echo 'SELECTED'; } ?> value="2" class="option">Administrator</option>
                        <option <?php if (Input::get('role') === '3') { echo 'SELECTED'; } ?> value="3" class="option">Content Editor</option>
                    </select>
                </div>
                
            </div><!-- .end col-lg-4 -->
            
            <div class="col-lg-4">			
                <h2>Account Settings</h2>
                
                <div class="form-group">
                    <label for="hints">Helpful Hints: <span class="required">*</span></label>
                    <select name="help_tips" class="form-control">
                        <option <?php if (Input::get('help_tips') === '1') { echo 'SELECTED'; } ?> value="1" class="option">On</option>
                        <option <?php if (Input::get('help_tips') === '0') { echo 'SELECTED'; } ?> value="0" class="option">Off</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="access">Account Status: <span class="required">*</span></label>
                    <select name="access" class="form-control">
                        <option <?php if (Input::get('access') === '1') { echo 'SELECTED'; } ?> value="1" class="option">Enabled</option>
                        <option <?php if (Input::get('access') === '0') { echo 'SELECTED'; } ?> value="0" class="option">Disabled</option>
                    </select>
                </div>
                
                <input type="hidden" name="token" value="<?php echo Token::gen(); ?>" />
                <input type="hidden" name="create" value="true" />
                
            </div><!-- .end col-lg-4 -->

        </form>
        
    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file create_account_view.php */
/* Location: ./application/views/users/create_account_view.php */