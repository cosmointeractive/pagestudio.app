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
        if( isset($errors)) {            
            foreach($errors as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
        }
        ?>        
        <div class="col-lg-12">
            <table id="make-searchable-5" class="table table-bordered table-hover table-striped table-white tablesorter no-side-borders">
                <thead>
                    <tr>
                        <th width="34" align="center"><input name="fields[]" value="" type="checkbox"></th>
                        <th width="400"><b>Title</b> </th>
                        <th width="200"><b>Info</b></th>
                        <th width="100"><b>Status</b></th>
                        <th><b>Preview</b></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($posts as $post) : ?>
                    <tr>
                        <td class="sorting_1" align="center"><input name="fields[]" value="" type="checkbox"></td>
                        <td class="profile-detail">
                            <div>
                                <h4><a href="<?php echo BASE_URL . 'entries/edit/' . $post->id;?>"><?php echo $post->post_title; ?></a></h4>
                            </div>
                            <div class="action">
                                <a class="btn btn-default btn-xs" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a class="btn btn-success btn-xs" title="Approved"><span class="glyphicon glyphicon-ok"></span></a>
                                <a class="btn btn-default btn-xs" href="<?php echo BASE_URL . 'entries/delete/' . $post->id;?>" title="Delete">
                                    <span class="glyphicon glyphicon-trash"></span></a>
                            </div>
                        </td>
                        <td>
                            Editor: Cosmo Mathieu
                            <div class="mic-info">
                                Last edited on: <?php echo strtotime_date($post->post_modified, 'D, M jS, Y'); ?><br />
                                Created on: <?php echo strtotime_date($post->post_date, 'm/d/Y'); ?>
                            </div>
                        </td>
                        <td><?php echo ucfirst( $post->post_status );?></td>
                        <td><a href="<?php echo BASE_URL . 'news/' . $post->post_slug;?>" target="_blank">Preview</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div><!-- // .col-lg-12 -->
    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file entry_view.php */
/* Location: ./application/views/entries/entries_view.php */