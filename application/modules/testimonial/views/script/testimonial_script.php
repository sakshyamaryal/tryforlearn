<script>
	isDirty = 0;
	$(document).ready(function () {
		dataSource = new kendo.data.DataSource({
			transport: {
				read: "<?php echo base_url(); ?>testimonial/get_testimonials",
				update: {
					url: "<?php echo base_url(); ?>testimonial/update",
					complete: function (e) {

						toastr.success('testimonial has been updated', {timeOut: 5000})
						$("#grid").data("kendoGrid").dataSource.read();
					}
				},
				create: {
					url: "<?php echo base_url(); ?>testimonial/add",
					complete: function (e) {
						toastr.success('testimonial has been added', {timeOut: 5000})
						$("#grid").data("kendoGrid").dataSource.read();
					}
				},
				upload: {
					url: 'test'
				},
				destroy: {
					url: "<?php echo base_url(); ?>testimonial/delete",
					complete: function (e) {
						toastr.success('testimonial has been deleted', {timeOut: 5000})
						$("#grid").data("kendoGrid").dataSource.read();
					}
				},update: {
					url: "<?php echo base_url(); ?>testimonial/update",
					complete: function (e) {

						toastr.success('testimonial has been updated', {timeOut: 5000})
						$("#grid").data("kendoGrid").dataSource.read();
					}
				},
				create: {
					url: "<?php echo base_url(); ?>testimonial/add",
					complete: function (e) {
						toastr.success('testimonial has been added', {timeOut: 5000})
						$("#grid").data("kendoGrid").dataSource.read();
					}
				},
				upload: {
					url: 'test'
				},
				destroy: {
					url: "<?php echo base_url(); ?>testimonial/delete",
					complete: function (e) {
						toastr.success('testimonial has been deleted', {timeOut: 5000})
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
					id: "testomonial_id",
					fields:{
						editor: fileUploadEditor,
						testomonial_id:{type: "number"},
						fullname: {type: "string",  validation: { required: true}},
						desc: {type: "string",  validation: { required: true }},
						image: {type: "string", validation: { required: true }},
						is_active: {type: "string",  validation: { required: true }},
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
			// height: 450,
			selectable: 'multiple',
			editable:
				'inline',
			// toolbar: kendo.template($("#template").html()),
			save: function(e){  e.model.set("propertyLogo",$("#uploadedFile").val()); },
			toolbar: ["create"],
			columns: [
				{
					title: "<input type='checkbox' id='selectAllRows' /> S.N",
					template: function (dataItem) {
						return `<input type='checkbox' class='rowCheckbox' data-id='${dataItem.testomonial_id}' /> ${++record}`;
					},
					width: "50px",
					filterable: false
				},
				{
					field: "fullname",
					title: "Full Name",
					width: "90px"
				},
				{
					field: "desc",
					title: "Description ",
					width: "200px"
				},
				{
					field: "image",
					title: "Image",
					editor: fileUploadEditor,
					template: "<img src='<?php echo base_url(); ?>upload/testimonial/#= image #' target='_blank' height='50' width='50' class='img-responsive'  >",
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
				{command: ["edit", "destroy"], title: "&nbsp;", width: "150px"},


			],

			dataBinding: function () {
				record = (this.dataSource.page() - 1) * this.dataSource.pageSize();
			}
		});

		function fileUploadEditor(container, options) {
			$('<input type="file" id="fileUpload" name="fileUpload" /> ')
				.appendTo(container)
				.kendoUpload({
					multiple: false,
					async: {
						saveUrl: "<?php echo base_url(); ?>/testimonial/image",
						removeUrl:  "<?php echo base_url(); ?>/testimonial/removeImage",
						autoUpload: true,
					},
					validation: {
						allowedExtensions: [".jpg", ".png", ".jpeg"]
					},
					success: onSuccess
				});

		}
		function onSuccess(e) {
			$("#uploadedFile").val(e.response.name);
		}


		var status_data = [{name: "inactive", value: "0"}, {name: "Active", value: "1"}];
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

		$("#delete").on("click", function name(e) {
			var grid = $('#grid').data('kendoGrid');
			var selectedRows = grid.select();

			var selectedData = [];
			selectedRows.each(function () {
				var dataItem = grid.dataItem(this);
				selectedData.push(dataItem.testomonial_id);
			});

			if (selectedData.length < 1) {
				toastr.warning('Please select one row to delete', { timeOut: 5000 })
				return false;
			}

			bootbox.confirm("Are you sure want to delete?", function (result) {

				if (result) {
					$.ajax({
						url: '<?= base_url(); ?>testimonial/delete',
						type: 'POST',
						data: { id: selectedData || 0 },
						success: function (response) {
							var response = jQuery.parseJSON(response);

							console.log(response.success);
							if (response.success == true) {
								toastr.success(response.messages, { timeOut: 5000 })
								$("#grid").data("kendoGrid").dataSource.filter({});
								$("#grid").data("kendoGrid").dataSource.read();
							} else {
								toastr.error(response.messages, { timeOut: 5000 })
							}
						}

					});
				}
			})
		})

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