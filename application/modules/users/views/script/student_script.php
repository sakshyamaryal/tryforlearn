<script>
	var save_method = "Add";
	isDirty = 0;

	$(document).ready(function () {
		dataSource = new kendo.data.DataSource({
			transport: {

				read: "<?php echo base_url(); ?>users/get_student",
				update: {
					url: '<?php echo base_url(); ?>users/update_student',
					complete: function (e) {
						toastr.success('User status has been updated', { timeOut: 5000 })
						$("#grid").data("kendoGrid").dataSource.filter({});
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
			pageSize: 20,
			serverPaging: true,
			serverFiltering: true,
			editable: true,
			serverSorting: true,
			schema: {
				type: "json",
				data: "resource",
				model: {
					id: "user_id",
					// id: {type: "number"},
					fields: {
						fullname: { type: "string", editable: false },
						address: { type: "string", editable: false },
						username: { type: "string", editable: false },
						email: { type: "string", editable: false },
						phone: { type: "string", editable: false },
						user_type_name: { type: "string", editable: false },
						// created_date: {type: "date"},
						is_active: { type: "string" },
						is_approved: { type: "string" },
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
				pageSizes: [20, 30, 50, 100, "all"],
				refresh: true,
				numeric: false,
				// pageSizes: true,
				buttonCount: 10
			},
			// height: 550,
			selectable: 'multiple',
			toolbar: kendo.template($("#template").html()),
			columns: [
				{
					title: "<input type='checkbox' id='selectAllRows' /> S.N",
					template: function (dataItem) {
						return `<input type='checkbox' class='rowCheckbox' data-id='${dataItem.user_id}' /> ${++record}`;
					},
					width: "50px",
					filterable: false
				},
				{
					field: "fullname",
					title: "Name",
					width: "100px"
				},
				{
					field: "address",
					title: "Address ",
					width: "100px"
				},
				{
					field: "email",
					title: "Email",
					width: "100px"
				},
				{
					field: "phone",
					title: "Phone",
					width: "100px"
				},
				// {
				// 	field: "username",
				// 	title: "Username",
				// 	width: "100px"
				// },

				// {
				// 	field: "user_type_name",
				// 	title: "User Type",
				// 	width: "100px"
				// },
				{
					field: "is_approved",
					title: "Approval",
					width: "100px",
					//editor: approveDropDownEditor,
					//template: "# if(is_approved == '1' )  { # Approved # } else  {#  Not approve # }   #",
					// filterable: {
					// 	ui: approveFilter
					// }
				},
				{
					field: "is_differently_abled",
					title: "Differently Abled",
					width: "100px",
				},
				{
					field: "is_disability_approved",
					title: "Is Differently Abled Approved",
					width: "100px",
				},

				// {
				// 	field: "is_active",
				// 	title: "Status",
				// 	width: "100px",
				// 	editor: statusDropDownEditor,
				// 	template: "# if(is_active == '1' )  { # Active # } else  {#  InActive # }   #",
				// 	filterable: {
				// 		ui: statusFilter
				// 	}
				// }

			],


			editable: false,

			dataBinding: function () {
				record = (this.dataSource.page() - 1) * this.dataSource.pageSize();
			}
		});

		var grid = $("#grid").data("kendoGrid");
		grid.thead.kendoTooltip({
			filter: "th",
			content: function (e) {
				var target = e.target;
				return $(target).text();
			}
		});
		var status_data = [{ name: "Inactive", value: "0" }, { name: "Active", value: "1" }];

		function statusFilter(element) {
			element.kendoDropDownList({
				dataTextField: 'name',
				dataValueField: 'value',
				dataSource: status_data,
				optionLabel: "--Select Status--"
			});
		}
		var approve_data = [{ name: "Not approve", value: "0" }, { name: "approved", value: "1" }];

		function approveFilter(element) {
			element.kendoDropDownList({
				dataTextField: 'name',
				dataValueField: 'value',
				dataSource: approve_data,
				optionLabel: "--Select Status--"
			});
		}

		function statusDropDownEditor(container, options) {
			$('<input required name="' + options.field + '"/>')
				.appendTo(container)
				.kendoDropDownList({
					autoBind: true,
					dataTextField: "name",
					dataValueField: "value",
					dataSource: status_data,

				});
		}

		function approveDropDownEditor(container, options) {
			$('<input required name="' + options.field + '"/>')
				.appendTo(container)
				.kendoDropDownList({
					autoBind: true,
					dataTextField: "name",
					dataValueField: "value",
					dataSource: approve_data,

				});
		}

		$("#refresh").on("click", function (e) {
			$("#grid").data("kendoGrid").dataSource.filter({});
			e.preventDefault();
			$("#grid").data("kendoGrid").dataSource.read();
		});
		$('.close').on("click", function (e) {
			$('#addUser').modal('hide');
			$('#detailmodal').modal('hide');
		});
		$("#subscribe").on("click", function (e) {
			var grid = $('#grid').data('kendoGrid');
			var selectedRows = grid.select();

			var selectedData = [];
			selectedRows.each(function () {
				var dataItem = grid.dataItem(this);
				selectedData.push(dataItem.user_id);
			});

			if (selectedData.length < 1) {
				toastr.warning('Please select one row to delete', { timeOut: 5000 })
				return false;
			}
			$('#userId').val(selectedData);
			$('#addUser').modal('show');
		});
		$("#class").on("change", function (e) {

			$.ajax({
				url: '<?= base_url(); ?>users/getclass',
				type: 'POST',
				data: { levelid: $(this).val() },
				success: function (response) {
					var response = jQuery.parseJSON(response);
					if (response.success == true) {
						$('#classid').empty();
						$('#classid').html(response.html);
					} else {
						$('#classid').empty();
						$('#classid').html(response.html);

						toastr.error(response.messages, { timeOut: 5000 })
					}
				}

			});

		});
		$("#classid").on("change", function (e) {

			$.ajax({
				url: '<?= base_url(); ?>chapter/getsubject',
				type: 'POST',
				data: { classid: $(this).val() },
				success: function (response) {
					var response = jQuery.parseJSON(response);
					$('#subjectid').empty();
					$('#subjectid').html(response.html);
				}

			});

		});
		$("#subjectid").on("change", function (e) {

			$.ajax({
				url: '<?= base_url(); ?>users/getpackagerate',
				type: 'POST',
				data: { subjectid: $(this).val() },
				success: function (response) {
					var response = jQuery.parseJSON(response);
					$('#package').empty();
					$('#package').html(response.html);
				}

			});

		});
		$("#approve").on("click", function (e) {
			var grid = $('#grid').data('kendoGrid');
			var selectedRows = grid.select();

			var selectedData = [];
			selectedRows.each(function () {
				var dataItem = grid.dataItem(this);
				selectedData.push(dataItem.user_id);
			});

			if (selectedData.length < 1) {
				toastr.warning('Please select one row to approve', { timeOut: 5000 })
				return false;
			}

			$.ajax({
				url: '<?= base_url(); ?>users/approve_student',
				type: 'POST',
				data: { id: selectedData || 0 },
				success: function (response) {
					var response = jQuery.parseJSON(response);
					if (response.success == true) {
						toastr.success(response.messages, { timeOut: 5000 })
						$("#grid").data("kendoGrid").dataSource.filter({});
						$("#grid").data("kendoGrid").dataSource.read();
					} else {
						toastr.error(response.messages, { timeOut: 5000 })
					}
				}

			});
		});
		$('#viewdetail').on("click", function (e) {
			var grid = $('#grid').data('kendoGrid');
			var dataItem = grid.dataItem(grid.select());
			if (dataItem == null) {
				toastr.warning('Please select one row to View Detail', { timeOut: 5000 })
				return false;
			}
			const document_file_path = '<?= base_url(); ?>upload/student/' + dataItem.user_verification_file;
			if (dataItem.user_verification_file) {
				$('#document').text('preview');
			}else {
				$('#document').text(
					'No Document available'
				);
			}
			$('#viewname').html(dataItem.fullname);
			$('#viewaddress').html(dataItem.address);
			$('#viewphone').html(dataItem.phone);
			$('#viewemail').html(dataItem.email);
			$('#viewusername').html(dataItem.username);
			$('#viewlanguage').html(dataItem.preffered_language);
			$('#viewguardian').html(dataItem.parents_detail);
			$('#viewguardiannumber').html(dataItem.parents_number);
			$('#viewinstitution').html(dataItem.guardian_detail);
			$('#viewinstitutionnumber').html(dataItem.guardian_number);
			$('#viewimage').attr('src', '<?= base_url(); ?>upload/student/' + dataItem.image);
			$('#is_differently_abled').html(dataItem.is_differently_abled);
			$('#document').attr('href', document_file_path).attr('target', '_blank');
			$('#detailmodal').modal('show');

		});
		$("#delete").on("click", function (e) {
			var grid = $('#grid').data('kendoGrid');
			var selectedRows = grid.select();

			var selectedData = [];
			selectedRows.each(function () {
				var dataItem = grid.dataItem(this);
				selectedData.push(dataItem.user_id);
			});

			if (selectedData.length < 1) {
				toastr.warning('Please select one row to delete', { timeOut: 5000 })
				return false;
			}

			$.ajax({
				url: '<?= base_url(); ?>users/deletestudent',
				type: 'POST',
				data: { id: selectedData || 0 },
				success: function (response) {
					var response = jQuery.parseJSON(response);
					if (response.success == true) {
						toastr.success(response.messages, { timeOut: 5000 })
						$("#grid").data("kendoGrid").dataSource.filter({});
						$("#grid").data("kendoGrid").dataSource.read();
					} else {
						toastr.error(response.messages, { timeOut: 5000 })
					}
				}

			});
		});

		$("#addUs").unbind('submit').bind('submit', function (e) {
			e.preventDefault();


			var form = $(this);
			var url = form.attr('action');
			var type = form.attr('method');
			var formData = new FormData($(this)[0]);
			$.ajax({
				url: url,
				type: type,
				data: formData,
				dataType: 'json',
				cache: false,
				contentType: false,
				processData: false,
				async: false,
				success: function (response) {

					if (response.type == 'success') {
						$('#addUser').modal('hide');
						toastr.success(response.message, { timeOut: 5000 })
						clearForm();


					} else {
						toastr.warning(response.message, { timeOut: 5000 })
					}

				}
			});



		});

		// Add functionality for 'Select All' checkbox
		$(document).on("change", "#selectAllRows", function () {
			// const isChecked = $(this).is(":checked");
			// const grid = $("#grid").data("kendoGrid");

			// if (isChecked) {
			// 	// Show all data by setting the page size to the total number of rows
			// 	const dataSource = grid.dataSource;
			// 	const totalRows = dataSource.total();
			// 	dataSource.pageSize(totalRows);

			// 	// Use a timeout to ensure the grid refreshes before selection
			// 	setTimeout(() => {
			// 		const rows = grid.tbody.find("tr");
			// 		$(".rowCheckbox").prop("checked", true);
			// 		grid.select(rows);
			// 	}, 100);
			// } else {
			// 	grid.dataSource.pageSize(20);
			// 	$(".rowCheckbox").prop("checked", false);
			// 	grid.clearSelection();
			// }
			const isChecked = $(this).is(":checked");
			const grid = $("#grid").data("kendoGrid");
			const rows = grid.tbody.find("tr");

			// Check/uncheck all row checkboxes
			$(".rowCheckbox").prop("checked", isChecked);

			if (isChecked) {
				// Select all rows
				grid.select(rows);
			} else {
				// Deselect all rows
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

		$(document).off("click", "#verify");
		$(document).on("click", "#verify", function (e) {
			var grid = $('#grid').data('kendoGrid');
			var selectedRows = grid.select();

			var selectedData = [];
			selectedRows.each(function () {
				var dataItem = grid.dataItem(this);
				selectedData.push(dataItem.user_id);
			});

			if (selectedData.length < 1) {
				toastr.warning('Please select one row to delete', { timeOut: 5000 })
				return false;
			}

			$.ajax({
				url: '<?= base_url(); ?>users/verifyDisable',
				type: 'POST',
				data: { id: selectedData || 0 },
				success: function (response) {
					var response = jQuery.parseJSON(response);
					if (response.success == true) {
						toastr.success(response.messages, { timeOut: 5000 })
						$("#grid").data("kendoGrid").dataSource.filter({});
						$("#grid").data("kendoGrid").dataSource.read();
					} else {
						toastr.error(response.messages, { timeOut: 5000 })
					}
				}

			});
		});

	});


</script>