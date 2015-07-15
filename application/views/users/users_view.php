<?php include APPPATH . 'views/header_view.php'; ?>
    <?php 
    if(Session::exists('success')) {
        echo Session::flash('success') . '<br /><br />';            
    }
    ?>  
    <div class="row" style="padding:30px 0">
        
        <div class="col-lg-12">
            <table id="make-searchable-5" class="table table-bordered table-hover table-striped table-white tablesorter no-side-borders">
                <thead>
                    <tr>
                        <!-- <th width="34" align="center"><input name="fields[]" value="" type="checkbox"></th> -->
                        <th width="90"><b></b></th>
                        <th width="200"><b>Name</b> </th>
                        <th width=""><b>Details</b></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    // var_dump($users);
                foreach ($users as $key => $user) : ?>
                    <tr>
                        <!-- <td class="sorting_1" align="center"><input name="fields[]" value="" type="checkbox"></td> -->
                        <td class="profile-pic">
                            <img src="http://placehold.it/60x60" class="img-circle img-responsive" alt="" />
                        </td>
                        <td class="profile-detail">
                            <div>
                                <a href="<?php echo BASE_URL . 'users/edit/' . $user->id;?>"><?php echo $user->firstname . ' ' . $user->lastname; ?></a>
                            </div>
                            <div class="action">
                                <a class="btn btn-default btn-xs" href="<?php echo BASE_URL . 'users/edit/' . $user->id;?>" title="Edit">Edit</a>
                                <a class="btn btn-default btn-xs" href="<?php echo BASE_URL . 'users/delete/' . $user->id;?>" title="Delete">
                                    Delete</auser
                            </div>
                        </td>
                        <td>
                            Role: <?php echo $user->group_name; ?>
                            <div class="mic-info">
                                 Last logged in on: <?php echo strtotime_date($user->last_login, 'D, M jS, Y'); ?><br />
                                Created on: <?php echo strtotime_date($user->date_created, 'm/d/Y'); ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div><!-- // .col-lg-12 -->    
        
    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file users_view.php */
/* Location: ./application/views/users/users_view.php */