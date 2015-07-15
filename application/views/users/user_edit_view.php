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
        <form name="update_category" method="POST" action="<?php $_SERVER['PHP_SELF'];?>" target="_self" accept-charset="UTF-8">
        <?php foreach($entry as $entry) { ?>
            
            <div class="col-lg-4">						
                <h2>User Information</h2>
                
                <div class="form-group">
                    <label for="firstname">First Name: <span class="required">*</span></label>
                    <div class="form-group <?php if (isset($_SESSION['noFname'])) { echo 'has-error'; }?>">
                        <input type="text" name="firstname" class="form-control" value="<?php if(isset($entry->firstname)) { echo remove_slashes( $entry->firstname ); } ?>" maxlength="250" />
                    </div>
                </div>
                <div class="form-group">							
                    <label for="lastname">Last Name: <span class="required">*</span></label>
                    <div class="form-group <?php if (isset($_SESSION['noLname'])) { echo 'has-error'; }?>">								
                        <input type="text" name="lastname" class="form-control" value="<?php if(isset($entry->lastname)) { echo remove_slashes( $entry->lastname ); } ?>" maxlength="250" />
                    </div>
                </div>
                <div class="form-group">														
                    <label for="email">E-mail Address: <span class="required">*</span></label>
                    <div class="form-group input-group <?php if (isset($_SESSION['noEmail'])) { echo 'has-error'; }?>">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text" name="email" class="form-control" value="<?php if(isset($entry->email)) { echo remove_slashes( $entry->email ); } ?>" maxlength="250" />
                    </div>							
                </div>							
            
            </div><!-- .end col-lg-4 -->
            
            <!-- 
            ============================================= -->
            <div class="col-lg-4">			
                <h2>Account Access</h2>
                
                <div class="form-group">
                    <label for="username">Username: <span class="required">*</span></label>
                    <div class="form-group input-group <?php if (isset($_SESSION['noUsername'])) { echo 'has-error'; }?>">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" name="username" class="form-control" value="<?php if(isset($entry->username)) { echo $entry->username; } else { echo $entry->username; }?>" maxlength="250" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password: <span class="required">*</span></label>
                    <?php if (isset($_SESSION['passError'])) { echo '<div class="error">'.$_SESSION['passError'].'</div>'; } ?>
                    <div class="form-group input-group <?php if (isset($_SESSION['passError'])) { echo 'has-error'; }?>">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" value="" maxlength="250" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Verify Password: <span class="required">*</span></label>
                    <?php if (isset($_SESSION['passError'])) { echo '<div class="error">'.$_SESSION['passError'].'</div>'; } ?>
                    <div class="form-group input-group <?php if (isset($_SESSION['passError'])) { echo 'has-error'; }?>">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" name="password2" class="form-control" value="" maxlength="250" />
                    </div>								
                </div>
                
            </div><!-- .end col-lg-4 -->
            
            <div class="col-lg-4">			
                <h2>Account Settings</h2>
                
                <div class="form-group">
                    <label for="hints">Helpful Hints: <span class="required">*</span></label>
                    <select name="help_tips" class="form-control">
                        <option <?php if ($entry->help_tips == 1) { echo 'SELECTED'; } ?> value="1" class="option">On</option>
                        <option <?php if ($entry->help_tips == 0) { echo 'SELECTED'; } ?> value="0" class="option">Off</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="access">Account Status: <span class="required">*</span></label>
                    <select name="access" class="form-control">
                        <option <?php if ($entry->access == 1) { echo 'SELECTED'; } ?> value="1" class="option">Enabled</option>
                        <option <?php if ($entry->access == 0) { echo 'SELECTED'; } ?> value="0" class="option">Disabled</option>
                    </select>
                </div>
                
                <input type="hidden" name="token" value="<?php echo Token::gen(); ?>" />
                <input type="hidden" name="uid" value="<?php echo $entry->id; ?>" />
                
            </div><!-- .end col-lg-4 -->
        <?php 
        } 
        ?>
            <button type="submit" name="submit" value="true" class="btn btn-primary">Update User Account</button>	
        </form>
        
    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file user_edit_view.php */
/* Location: ./application/views/users/user_edit_view.php */