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
                        <th width="34" align="center"><input name="fields[]" value="" type="checkbox"></th>
                        <th width="400"><b>Title</b> </th>
                        <th width="200"><b>Info</b></th>
                        <th><b>Preview</b></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($pages as $page) : ?>
                    <tr>
                        <td class="sorting_1" align="center"><input name="fields[]" value="" type="checkbox"></td>
                        <td class="profile-detail">
                            <div>
                                <a href="<?php echo BASE_URL . 'pages/edit/' . $page->id;?>"><?php echo $page->page_title; ?></a>
                            </div>
                            <div class="action">
                                <a class="btn btn-default btn-xs" href="<?php echo BASE_URL . 'pages/edit/' . $page->id;?>" title="Edit">Edit</a>
                                <a class="btn btn-default btn-xs" href="<?php echo BASE_URL . 'pages/delete/' . $page->id;?>" title="Delete">
                                    Delete</a>
                            </div>
                        </td>
                        <td>
                            Editor: Cosmo Mathieu
                            <div class="mic-info">
                                 Last edited on: <?php echo strtotime_date($page->page_modified, 'D, M jS, Y'); ?><br />
                                Created on: <?php echo strtotime_date($page->page_date, 'm/d/Y'); ?>
                            </div>
                        </td>
                        <td><a href="<?php echo BASE_URL . $page->page_slug;?>" target="_blank">View page</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div><!-- // .col-lg-12 -->
    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file pages_view.php */
/* Location: ./application/views/pages/pages_view.php */