<div id="content" class="col-lg-10 col-sm-10">

    <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?= $admin_base_url; ?>">Home</a>
            </li>
            <li>
                <a href="#"><?= $title;?></a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="fa fa-list"></i> <?= $title;?></h2>
                </div>
                <div class="box-content">
                    <div id="grid"></div>
                    <input type="hidden" id='uploadedFile' data-bind="value: files" />
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Blog Modal -->
    <div id="editBlogModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editBlogModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: 80%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBlogModalLabel">Edit Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editBlogForm">
                        <div class="form-group">
                            <label for="blogContent">Content</label>
                            <textarea class="form-control" id="blogContent" rows="20" required></textarea>
                        </div>
                        <input type="hidden" id="blogId">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveBlogBtn">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toolbar Template -->
    <script type="text/x-kendo-template" id="template">
        <a class="btn btn-primary btn-sm k-grid-add" href="<?= base_url(); ?>blogs/add">
            <span class="fa fa-plus" data-toggle="tooltip" title="Add"></span> Add
        </a>
        <a id="edit" class="btn btn-primary btn-sm k-grid-edit">
            <span class="fa fa-edit" data-toggle="tooltip" title="Edit"></span> Edit
        </a>
        <a id="delete" class="btn btn-primary btn-sm k-grid-delete" data-toggle="tooltip" title="Delete">
            <span class="fa fa-times"></span> Delete
        </a>
        <a id="refresh" class="btn btn-primary btn-sm k-grid-refresh" data-toggle="tooltip" title="Refresh">
            <span class="fa fa-refresh"></span> Refresh
        </a>
    </script>

    <?php $this->load->view('script/blogs_script.php'); ?>

</div>
