<?php include APPPATH . 'views/header_view.php'; ?>        
    <div class="row" style="padding:30px 0">
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
        ?>        
        <div class="col-lg-12">
            <table id="make-searchable-5" class="table table-bordered table-hover table-striped table-white tablesorter no-side-borders">
                <thead>
                    <tr>
                        <th width="360"><b>Slider Title</b> </th>
                        <th width="160"><b>Embedding Code</b></th>
                        <th width=""><b>Info</b></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($slideshows as $slideshow) : ?>
                    <tr>
                        <td class="profile-detail">
                            <div>
                                <a href="<?php echo BASE_URL . 'addons/load/sliders/edit/' . $slideshow->id;?>"><?php echo $slideshow->slider_title . ' (' . $slideshow->photo_count. ')'; ?></a>
                            </div>
                            <div class="action">
                                <a class="btn btn-default btn-xs nav-main-tooltip-bottom" href="<?php echo BASE_URL . 'addons/load/sliders/manage/' . $slideshow->id;?>" title="Manage files">Manage Files</a>
                                <a class="btn btn-default btn-xs nav-main-tooltip-bottom" href="<?php echo BASE_URL . 'addons/load/sliders/purge/' . $slideshow->id;?>" title="Delete all files ">Purge Files</a>
                                <a class="btn btn-default btn-xs nav-main-tooltip-bottom" href="<?php echo BASE_URL . 'addons/load/sliders/edit/' . $slideshow->id;?>" title="Edit slider details">Edit Details</a>
                                <a class="btn btn-default btn-xs nav-main-tooltip-bottom" href="<?php echo BASE_URL . 'addons/load/sliders/delete/' . $slideshow->id;?>" title="Delete everything">Delete Slider</a>
                            </div>
                        </td>
                        <td class="profile-detail"><div class="dummy-input-field"><?php echo '[slideshow id="'. $slideshow->id .'"]'; ?></div></td>
                        <td>
                            Editor: <?php echo $slideshow->firstname . ' ' . $slideshow->lastname; ?>
                            <div class="mic-info">
                                 Last edited on: <?php echo strtotime_date($slideshow->slider_modified, 'D, M jS, Y', 'N/A'); ?><br />
                                Created on: <?php echo strtotime_date($slideshow->slider_date, 'm/d/Y'); ?>
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