<script>
isDirty = 0;
$(document).ready(function () {
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
						toastr.success('Banner has been added', { timeOut: 5000 })
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
            },
            parameterMap: function (data, operation) {
                if (data.filter === null) {
                    return data;
                }
                if ('filter' in data) {
                    for (var i = 0; i < data.filter.filters.length; i++) {
                        if (data.filter.filters[i].field == 'created_date' || data.filter.filters[i].field == 'modified_date') {
                            var date = new Date(data.filter.filters[i].value);
                            var dateString = new Date(date.getTime() - date.getTimezoneOffset() * 60000)
                                .toISOString()
                                .split('T')[0];
                            data.filter.filters[i].value = dateString;
                        }
                    }
                }

                return data;
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
                    image: { type: "string", validation: { required: true } },
                    is_active: { type: "string", validation: { required: true } },
                }
            },
            total: function (data) {
                return data.total;
            }
        }
    });

    $("#grid").kendoGrid({
        filterable: {
            extra: false,
            operators: {
                string: {
                    startswith: "Starts with",
                    contains: "Contains",
                    isnull: "Null",
                    doesnotcontain: "Doesnot Contain"
                },

                number: {
                    startswith: "Starts with",
                    contains: "Contains",
                    eq: "Is equal to",
                    isnull: "Null",
                },
                date: {
                    gte: "From Date",
                    lte: "To Date",
                    eq: "Equal To"
                },

            }
        },
        sortable: true,
        dataSource: dataSource,
        pageable: {
            refresh: true,
            pageSizes: true,
            buttonCount: 10
        },
        selectable: 'multiple',
        editable: 'inline',
        toolbar: kendo.template($("#template").html()),
			save: function (e) { e.model.set("propertyLogo", $("#uploadedFile").val()); },
			columns: [
				{
					title: "<input type='checkbox' id='selectAllRows' /> S.N",
					template: function (dataItem) {
						return `<input type='checkbox' class='rowCheckbox' data-id='${dataItem.blog_id}' /> ${++record}`;
					},
					width: "50px",
					filterable: false
				},
				{
					field: "title",
					title: "Title",
					width: "90px"
				},
				{
					field: "content",
					title: "Content",
					width: "200px"
				},
				{
					field: "image",
					title: "Image",
					editor: fileUploadEditor,
					template: "<img src='<?php echo base_url(); ?>upload/blogs/#= image #' target='_blank' height='50' width='50' class='img-responsive'  >",
					width: "130px",
					filterable: false

				},

				{
					field: "is_active",
					title: "Status",
					editor: sDropDownEditor,
					width: "80px",
					template: "# if(is_active == '1' )  { # Active # } else  {#  InActive # }   #",
					filterable: {
						ui: statusFilter
					}
				},
				{ command: ["edit", "destroy"], title: "&nbsp;", width: "150px" },


			],

            dataBinding: function () {
				record = (this.dataSource.page() - 1) * this.dataSource.pageSize();
			}
    });
    function fileUploadEditor(container, options) {
			$('<input type="file" id="fileUpload" name="fileUpload" /> ')
				.appendTo(container)
				.kendoUpload({
					multiple: true,
					async: {
						saveUrl: "<?php echo base_url(); ?>/blogs/image",
						removeUrl: "<?php echo base_url(); ?>/blogs/removeImage",
						autoUpload: true,
					},
					validation: {
						allowedExtensions: [".jpg", ".png", ".jpeg", ".gif"]
					},
					success: onSuccess
				});

		}

        function onSuccess(e) {
			$("#uploadedFile").val(e.response.name);
		}


		var status_data = [{ name: "inactive", value: "0" }, { name: "Active", value: "1" }];
		function sDropDownEditor(container, options) {
			$('<input required name="' + options.field + '"/>')
				.appendTo(container)
				.kendoDropDownList({
					autoBind: true,
					dataTextField: "name",
					dataValueField: "value",
					dataSource: status_data
				});
		}

		function statusFilter(element) {
			element.kendoDropDownList({
				dataTextField: 'name',
				dataValueField: 'value',
				dataSource: status_data,
				optionLabel: "--Select Status--"
			});
		}
		var grid = $("#grid").data("kendoGrid");
		grid.thead.kendoTooltip({
			filter: "th",
			content: function (e) {
				var target = e.target;
				return $(target).text();
			}
		});

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

    //modal start herer

    // Handle Edit button click
    // $(document).on("click", "#edit", function () {
    //     var grid = $("#grid").data("kendoGrid");
    //     var selectedRows = grid.select();
    //     if (selectedRows.length === 0) {
    //         toastr.warning("Please select a blog post to edit.");
    //         return;
    //     }

    //     var selectedData = grid.dataItem(selectedRows[0]);
    //     openEditModal(selectedData); // Open modal with data for editing
    // });

    // function openEditModal(dataItem) {
    //     $('#blogTitle').val(dataItem.title);
    //     $('#blogContent').val(dataItem.content);
    //     $('#isActive').val(dataItem.is_active);
    //     $('#blogId').val(dataItem.blog_id);  // Store the blog ID in the hidden input
    //     $('#editBlogModal').modal('show');
    // }

    // // Save changes when the Save button is clicked
    // $('#saveBlogBtn').on('click', function () {
    //     var updatedBlog = {
    //         blog_id: $('#blogId').val(),
    //         title: $('#blogTitle').val(),
    //         content: $('#blogContent').val(),
    //         image: $('#blogImage').val(),  // Handle image if required
    //         is_active: $('#isActive').val(),
    //         updated_by: '<?php echo $this->session->adminuserid; ?>'
    //     };

    //     $.ajax({
    //         url: "<?php echo base_url(); ?>blogs/update",
    //         type: "POST",
    //         data: updatedBlog,
    //         success: function (response) {
    //             response = jQuery.parseJSON(response);
    //             if (response.success) {
    //                 toastr.success('Blog post has been updated', { timeOut: 5000 });
    //                 $('#editBlogModal').modal('hide');
    //                 $("#grid").data("kendoGrid").dataSource.read({ timestamp: new Date().getTime() });
    //             } else {
    //                 toastr.error(response.messages, { timeOut: 5000 });
    //             }
    //         }
    //     });
    // });

    // till here

    // Add functionality for 'Select All' checkbox
    $(document).on("change", "#selectAllRows", function () {
        const isChecked = $(this).is(":checked");
        const grid = $("#grid").data("kendoGrid");

        if (isChecked) {
            // Show all data by setting the page size to the total number of rows
            const dataSource = grid.dataSource;
            const totalRows = dataSource.total();
            dataSource.pageSize(totalRows);

            // Use a timeout to ensure the grid refreshes before selection
            setTimeout(() => {
                const rows = grid.tbody.find("tr");
                $(".rowCheckbox").prop("checked", true);
                grid.select(rows);
            }, 100);
        } else {
            grid.dataSource.pageSize(20);
            $(".rowCheckbox").prop("checked", false);
            grid.clearSelection();
        }
    });

    // Update individual row selection when a row checkbox is clicked
    $(document).on("change", ".rowCheckbox", function () {
        const grid = $("#grid").data("kendoGrid");
        const dataId = $(this).attr("data-id"); // Get the data-id of the checkbox
        const input = grid.table.find(`input[data-id='${dataId}']`);
        const row = input.closest("tr");// Locate the corresponding row

        if ($(this).is(":checked")) {
            grid.select(row); // Select the row
        } else {
            const selectedRows = grid.select().toArray();
            const remainingRows = selectedRows.filter((selectedRow) => selectedRow !== row[0]);
            grid.clearSelection();
            remainingRows.forEach((remainingRow) => grid.select($(remainingRow)));
        }

        // Update 'Select All' checkbox state
        const allChecked = $(".rowCheckbox:checked").length === $(".rowCheckbox").length;
        $("#selectAllRows").prop("checked", allChecked);
    });
});
</script>
