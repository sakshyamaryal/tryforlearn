<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="<?= $admin_base_url; ?>">Home</a></li>
			<li><a href="#">Social Media</a></li>
		</ul>
	</div>
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="fa fa-list"></i> Social Media</h2>
				</div>
				<div class="box-content">
					<div id="grid"></div>
					<input type="hidden" id='uploadedFile' data-bind="value: files" />
				</div>
			</div>
		</div>
	</div>

	<script type="text/x-kendo-template" id="template">
		<a class="btn btn-primary btn-sm k-grid-add" href="<?= base_url(); ?>socialmedia/add"><span class="fa fa-plus" title="Add"></span>Add</a>
		<a id="edit" class="btn btn-primary btn-sm k-grid-edit"><span class="fa fa-edit" title="Edit"></span>Edit</a>
		<a id="delete" class="btn btn-primary btn-sm k-grid-delete"><span class="fa fa-times" title="Delete"></span>Delete</a>
		<a id="refresh" class="btn btn-primary btn-sm k-grid-refresh"><span class="fa fa-refresh" title="Refresh"></span>Refresh</a>
	</script>

<script>
$(document).ready(function () {
	let record = 1;
	const dataSource = new kendo.data.DataSource({
		transport: {
			read: "<?= base_url(); ?>socialmedia/get_social_medias",
			update: {
				url: "<?= base_url(); ?>socialmedia/update",
				complete: function () {
					toastr.success('Social Media updated successfully');
					$("#grid").data("kendoGrid").dataSource.read();
				}
			},
			create: {
				url: "<?= base_url(); ?>socialmedia/add",
				complete: function () {
					toastr.success('Social Media added successfully');
					$("#grid").data("kendoGrid").dataSource.read();
				}
			},
			destroy: {
				url: "<?= base_url(); ?>socialmedia/delete",
				complete: function () {
					toastr.success('Social Media deleted successfully');
					$("#grid").data("kendoGrid").dataSource.read();
				}
			}
		},
		batch: true,
		pageSize: 20,
		schema: {
			type: "json",
			data: "resource",
			model: {
				id: "id",
				fields: {
					id: { type: "number" },
					name: { type: "string", validation: { required: true } },
					link: { type: "string", validation: { required: true } },
					icon: { type: "string", validation: { required: true } },
					// is_active: { type: "string", validation: { required: true } },
				}
			},
			total: function (data) { return data.total; }
		},
		change: function(){record=1;},
	});

	$("#grid").kendoGrid({
		filterable: true,
		sortable: true,
		pageable: {
			refresh: true,
			pageSizes: true,
			buttonCount: 10
		},
		selectable: 'multiple',
		editable: 'inline',
		toolbar: kendo.template($("#template").html()),
		// save: function (e) { e.model.set("icon", $("#uploadedFile").val()); },
		dataSource: dataSource,
		columns: [
			{
				title: "<input type='checkbox' id='selectAllRows' /> S.N",
				template: function (dataItem) {
					return `<input type='checkbox' class='rowCheckbox' data-id='${dataItem.id}' /> ${record++}`;
				},
				width: "50px",
				filterable: false
			},
			{ field: "name", title: "Name", width: "120px" },
			{ field: "link", title: "Link", width: "200px" },
			{ field: "icon", title: "Icon", width: "100px" },
      { field: "order", title: "Order", width: "100px", editor: numberEditor },

			// {
			// 	field: "is_active",
			// 	title: "Status",
			// 	editor: sDropDownEditor,
			// 	template: "# if(is_active == '1'){ # Active # } else { # Inactive # } #",
			// 	width: "100px",
			// 	filterable: {
			// 		ui: statusFilter
			// 	}
			// },
			{ command: ["edit", "destroy"], title: "&nbsp;", width: "150px" }
		],
		databinding: function () {
			record = (this.dataSource.page() - 1) * this.dataSource.pageSize();
		}
	});

	var status_data = [{ name: "Inactive", value: "0" }, { name: "Active", value: "1" }];

	function sDropDownEditor(container, options) {
		$('<input required name="' + options.field + '"/>')
			.appendTo(container)
			.kendoDropDownList({
				dataTextField: "name",
				dataValueField: "value",
				dataSource: status_data
			});
	}
	function statusFilter(element) {
		element.kendoDropDownList({
			dataTextField: "name",
			dataValueField: "value",
			dataSource: status_data,
			optionLabel: "--Select Status--"
		});
	}
  function numberEditor(container, options) {
    $('<input required type="number" name="' + options.field + '" class="k-input k-textbox" />')
        .appendTo(container);
  } 


	// select all and delete logic same as before
	$(document).on("change", "#selectAllRows", function () {
		const isChecked = $(this).is(":checked");
		const grid = $("#grid").data("kendoGrid");
		if (isChecked) {
			const dataSource = grid.dataSource;
			const totalRows = dataSource.total();
			dataSource.pageSize(totalRows);
			setTimeout(() => {
				const rows = grid.tbody.find("tr");
				$(".rowCheckbox").prop("checked", true);
				grid.select(rows);
			}, 100);
		} else {
			grid.dataSource.pageSize(10);
			$(".rowCheckbox").prop("checked", false);
			grid.clearSelection();
		}
	});

	$(document).on("change", ".rowCheckbox", function () {
		const grid = $("#grid").data("kendoGrid");
		const dataId = $(this).attr("data-id");
		const input = grid.table.find(`input[data-id='${dataId}']`);
		const row = input.closest("tr");
		if ($(this).is(":checked")) {
			grid.select(row);
		} else {
			const selectedRows = grid.select().toArray();
			const remainingRows = selectedRows.filter(selectedRow => selectedRow !== row[0]);
			grid.clearSelection();
			remainingRows.forEach(remainingRow => grid.select($(remainingRow)));
		}
		const allChecked = $(".rowCheckbox:checked").length === $(".rowCheckbox").length;
		$("#selectAllRows").prop("checked", allChecked);
	});

	// Delete action
	$("#delete").on("click", function () {
		var grid = $('#grid').data('kendoGrid');
		var selectedRows = grid.select();
		var selectedData = [];
		selectedRows.each(function () {
			var dataItem = grid.dataItem(this);
			selectedData.push(dataItem.id);
		});
		if (selectedData.length < 1) {
			toastr.warning('Please select at least one record to delete.');
			return;
		}
		bootbox.confirm("Are you sure want to delete?", function (result) {
			if (result) {
				$.ajax({
					url: '<?= base_url(); ?>socialmedia/delete',
					type: 'POST',
					data: { id: selectedData },
					success: function (response) {
						const res = JSON.parse(response);
						if (res.success) {
							toastr.success('Deleted successfully');
							$("#grid").data("kendoGrid").dataSource.read();
						} else {
							toastr.error(res.messages);
						}
					}
				});
			}
		});
	});
});
</script>
