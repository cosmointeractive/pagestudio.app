<?php include APPPATH . 'views/header_view.php'; ?>
    <div id="content" class="row" style="padding:30px 0">
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
        <div class="col-md-12">
            <table id="make-searchable-10" class="table table-bordered table-hover table-striped table-white tablesorter no-side-borders">
                <thead>
                    <tr>
                        <th width="34" align="center"><input name="fields[]" value="" type="checkbox"></th>
                        <th width="300"><b>Name</b> </th>
                        <th width=""><b>Action</b> </th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($categories as $cat) : ?>
                    <tr>
                        <td class="sorting_1" align="center"><input name="fields[]" value="" type="checkbox"></td>
                        <td class="profile-detail">
                            <div>
                                <a href="<?php echo BASE_URL . 'categories/edit/' . $cat->category_ID;?>"><?php echo $cat->category_title; ?></a>
                            </div>
                        </td>
                        <td>
                            <div class="action">
                                <a class="btn btn-default btn-xs" href="<?php echo BASE_URL . 'categories/edit/' . $cat->category_ID;?>" title="Edit">Edit</a>
                                <a class="btn btn-default btn-xs" href="<?php echo BASE_URL . 'categories/delete/' . $cat->category_ID;?>" title="Delete">
                                    Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div><!-- // .col-lg-12 -->
    </div>
<?php include APPPATH . 'views/footer_view.php'; 

/* End of file categories_view.php */
/* Location: ./application/views/categories/categories_view.php */