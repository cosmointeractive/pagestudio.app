<?php include APPPATH . 'views/header_view.php'; ?>
	
    <div id="content">
        
        <h1><?php echo $page['heading']; ?></h1>
        <?php 
            foreach($errors as $error) {
                echo $error;
            }
        ?>
        
        <!-- Login Form
		================================================ -->
		<form name="admin_login" method="POST" action="<?php $_SERVER['PHP_SELF'];?>" target="_self" accept-charset="UTF-8">
			<div class="form-block-body">
			
				<div class="form-group-shaded">
					<div class="form-group <?php if (isset($_SESSION['no_username'])) { echo 'has-error'; } ?>">
						<input type="text" name="username" class="form-control" value="<?php echo Input::get('username'); ?>" placeholder="User ID" tabindex="1" />
					</div>
				</div>
				<div class="form-group-normal">
					<div class="form-group <?php if (isset($_SESSION['no_password'])) { echo 'has-error'; } ?>">
						<input type="password" name="password" class="form-control" value="<?php echo Input::get('password'); ?>" placeholder="Password" tabindex="2" />
					</div>
                    
                    <input type="checkbox" name="remember" id="remember" /> Remember me

					<input type="hidden" name="token" value="<?php echo Token::gen(); ?>" />
			
					<button type="submit" id="submit" name="login" value="submit" tabindex="3" class="btn btn-primary btn-block">Log in</button>
				</div>
				
			</div><!--/ .form-block-body -->
		</form>
        
    </div>

<?php include APPPATH . 'views/footer_view.php'; 

/* End of file login_view.php */
/* Location: ./application/views/login/login_view.php */