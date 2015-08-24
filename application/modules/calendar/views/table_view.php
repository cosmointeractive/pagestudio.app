<?php include APPPATH . 'views/header_view.php'; ?> 
       
    <div class="row" style="padding:35px 0px">
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
                echo '
                <div style="padding:0 20px">
                    <div class="alert alert-danger">' . $error . '</div>
                </div>';
            }
        }
        ?>
        <div class="col-lg-12">
            <table id="make-searchable-5" class="table table-bordered table-hover table-striped table-white tablesorter no-side-borders">
                <thead>
                    <tr>
                        <th width="360"><b>Event Title</b> </th>
                        <th width="160"><b>Date</b></th>
                        <th width=""><b>Info</b></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($events as $event) : ?>
                    <tr>
                        <td class="profile-detail">
                            <div>
                                <a href="<?php echo BASE_URL . 'addons/load/calendar/edit/' . $event->id;?>"><h4><?php echo $event->title; ?></h4></a>
                            </div>
                            <div class="action">
                                <a class="btn btn-default btn-xs nav-main-tooltip-bottom" href="<?php echo BASE_URL . 'addons/load/calendar/edit/' . $event->id;?>" title="Edit details">Edit Event</a>
                                <a class="btn btn-default btn-xs nav-main-tooltip-bottom" href="<?php echo BASE_URL . 'addons/load/calendar/delete/' . $event->id;?>" title="Delete everything">Delete Event</a>
                            </div>
                        </td>
                        <td class="profile-detail"><div class="dummy-input-field"><?php echo strtotime_date($event->start, 'D, M d, Y', 'Never'); ?></div></td>
                        <td>
                            Author: <?php echo $event->event_author; ?>
                            <div class="mic-info">
                                <strong>Last edited on:</strong> <?php echo strtotime_date($event->modified, 'm/d/Y', 'Never'); ?> | 
                                <strong>Created on:</strong> <?php echo strtotime_date($event->created, 'm/d/Y'); ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div><!-- // .col-lg-12 -->
    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file .php */
/* Location: ./application/modules/sliders/views/ .php */