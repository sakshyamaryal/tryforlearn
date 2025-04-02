<script>

$(document).ready(function () {
    isDirty = 0;
    dataSource = new kendo.data.DataSource({
        transport: {
            read: "<?php echo base_url(); ?>blogs/get_blogs",
            update: {
                url: "<?php echo base_url(); ?>blogs/update",
                complete: function (e) {
                    toastr.success('Blog post has been updated', { timeOut: 5000 });
                    $("#grid").data("kendoGrid").dataSource.read();
                }
            },
            create: {
                url: "<?php echo base_url(); ?>blogs/add",
                complete: function (e) {
                    toastr.success('Blog post has been added', { timeOut: 5000 });
                    $("#grid").data("kendoGrid").dataSource.read();
                }
            },
            upload:{
                url: 'test'
            },
            destroy: {
                url: "<?php echo base_url(); ?>blogs/delete",
                complete: function (e) {
                    toastr.success('Blog post has been deleted', { timeOut: 5000 });
                    $("#grid").data("kendoGrid").dataSource.read();
                }
            }
        },
        batch: true,
        pageSize: 10,
        serverPaging: true,
        serverFiltering: true,
        serverSorting: true,
        schema: {
            type: "json",
            data: "resource",
            model: {
                id: "blog_id",
                fields: {
                    editor: fileUploadEditor,
                    blog_id: { type: "number" },
                    title: { type: "string", validation: { required: true } },
                    content: { type: "string", validation: { required: true } },
                    author: { type: "string", validation: { required: true } },
                    created_at: { type: "date" },
                    is_published: { type: "boolean" }
                }
            },
            total: function (data) {
                return data.total;
            }
        }
    });

    $("#grid").kendoGrid({
        filterable: true,
        sortable: true,
        dataSource: dataSource,
        pageable: {
            refresh: true,
            pageSizes: true,
            buttonCount: 10
        },
        selectable: 'multiple',
        editable: 'inline',
        toolbar: ["create"],
        columns: [
            { field: "title", title: "Title", width: "150px" },
            { field: "content", title: "Content", width: "200px" },
            { field: "image", title: "Image", width: "100px", template: "<img src='#= image #' alt='Image' style='width: 50px; height: 50px;' />" },
            { field: "created_at", title: "Created On", format: "{0:MM/dd/yyyy}", width: "100px" },
            { field: "is_published", title: "Published", width: "80px", template: "#= is_published ? 'Yes' : 'No' #" },
            { command: ["edit", "destroy"], title: "Actions", width: "150px" }
        ]
    });
    function fileUploadEditor(container, options) {
			$('<input type="file" id="fileUpload" name="fileUpload" /> ')
				.appendTo(container)
				.kendoUpload({
					multiple: true,
					async: {
						saveUrl: "<?php echo base_url(); ?>/banner/image",
						removeUrl: "<?php echo base_url(); ?>/banner/removeImage",
						autoUpload: true,
					},
					validation: {
						allowedExtensions: [".jpg", ".png", ".jpeg", ".gif"]
					},
					success: onSuccess
				});

		}

    // Handle delete action
    $("#delete").on("click", function () {
        var grid = $('#grid').data('kendoGrid');
        var selectedRows = grid.select();
        var selectedData = [];

        // Collect selected rows data
        selectedRows.each(function () {
            var dataItem = grid.dataItem(this);
            selectedData.push(dataItem.blog_id);
        });

        // If no blog is selected, show a warning
        if (selectedData.length < 1) {
            toastr.warning('Please select a blog post to delete', { timeOut: 5000 });
            return false;
        }

        // Ask for confirmation before deletion
        bootbox.confirm("Are you sure you want to delete?", function (result) {
            if (result) {
                $.ajax({
                    url: '<?= base_url(); ?>blogs/delete',
                    type: 'POST',
                    data: { id: selectedData || 0 },
                    success: function (response) {
                        response = jQuery.parseJSON(response);
                        if (response.success) {
                            toastr.success('Blog post has been deleted', { timeOut: 5000 });
                            $("#grid").data("kendoGrid").dataSource.read();
                        } else {
                            toastr.error(response.messages, { timeOut: 5000 });
                        }
                    }
                });
            }
        });
    });
});
</script>
