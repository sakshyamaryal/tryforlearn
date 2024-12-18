<script>
	isDirty = 0;
	$(document).ready(function () {
		dataSource = new kendo.data.DataSource({
			transport: {
				read: "<?php echo base_url(); ?>users/get_users",
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
			editable: "true",
			serverPaging: true,
			serverFiltering: true,

			serverSorting: true,
			schema: {
				type: "json",
				data: "resource",
				model: {
					id: "customer_id",
					fullname: { type: "string" },
					address: { type: "string" },
					username: { type: "string" },
					phone: { type: "string" },
					// created_by: {type: "string"},
					// created_date: {type: "date"},
					is_active: { type: "string" },

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
			// height: 450,
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
				{
					field: "username",
					title: "Username",
					width: "100px"
				},

				{
					field: "user_type_name",
					title: "User Type",
					width: "100px"
				}
				// ,

				// {
				// 	field: "is_active",
				// 	title: "Status",
				// 	width: "100px",
				// 	template: "# if(is_active == '1' )  { # Active # } else  {#  InActive # }   #",
				// 	filterable: {
				// 		ui: statusFilter
				// 	}
				// }


			],
			editable: {
				mode: "popup",
				confirmation: false
			},

			dataBinding: function () {
				record = (this.dataSource.page() - 1) * this.dataSource.pageSize();
			}
		});

		var status_data = [{ name: "inactive", value: "0" }, { name: "Active", value: "1" }];

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


		$("#refresh").on("click", function (e) {
			$("#grid").data("kendoGrid").dataSource.filter({});
			e.preventDefault();
			$("#grid").data("kendoGrid").dataSource.read();
		});


		$("#add").on("click", function name(e) {
			$('#addUser').modal('show');
			$('.modal-title').html('Add User');
			$('#userpw').show();

		})
		$("#status").kendoDropDownList({
			dataTextField: 'name',
			dataValueField: 'value',
			dataSource: status_data,

		});

		$("#userType").kendoDropDownList({
			dataTextField: "user_type_name",
			dataValueField: "typeid",
			dataSource: {
				type: "json",
				transport: {
					read: {
						url: "<?php echo base_url(); ?>/users/getUserType",
					}
				}
			}
		});

		function clearForm() {
			$('form')
				.find("input,textarea")
				.val('')
				.end()
				.find("input[type=checkbox],input[type=file], input[type=radio]")
				.prop("checked", "")
				.end();
			$(".error").html('');
			$(".k-upload-files.k-reset").find("li").remove();
		}


		$('input,checkbox,textarea,radio,select').change(function () {
			isDirty = 1;
		});


		$('[data-toggle="modal-close"]').on('click', function (e) {

			$this = $(this);
			if (isDirty == 1) {
				bootbox.confirm('Are you sure you want to Close ? ', function (confirmed) {
					if (confirmed == true) {
						clearForm()
						$this.closest('.modal').modal('hide');
					} else {
					}
				});
			} else {
				$('form')
				clearForm()
				$('form').validate().resetForm();
				$this.closest('.modal').modal('hide');
			}
		});



		function validateField() {
			jQuery.validator.addMethod("phoneNep", function (phone_number, element) {
				phone_number = phone_number.replace(/\s+/g, "");
				return this.optional(element) || phone_number.length > 9 && phone_number.match(/^(\+?1-?)?(\([0-9]\d{2}\)|[0-9]\d{2})-?[0-9]\d{2}-?\d{4}$/);
			}, "Please specify a valid phone number");
			$("#addUs").validate({
				rules: {
					"fullName": {
						required: true,
						minlength: 3
					},
					"address": {
						required: true,
					},
					"email": {
						required: true,
						email: true
					},
					"username": {
						required: true,
						minlength: 3
					},
					"phone": {
						required: true,
						phoneNep: true
					}
					// ,
					// "password" : {
					// 	required:true,
					// 	minlength : 5
					// },
					// "cPassword" : {
					// 	minlength : 5,
					// 	equalTo : '[name="password"]'
					// }

				},
				messages: {
					"fullName": {
						required: "Please enter Fullname",
						minlength: "Vendor Name must consist of at least 3 characters"
					},
					"address": {
						required: "Please enter address",
					},
					"email": {
						required: "Please Enter Email Address"
					},
					"username": {
						required: "Please Enter Username ",
						minlength: "Username must be minimum of 3 character"
					}
					,
					"password": {
						required: "Please Enter password ",
						minlength: "Username must be minimum of 5 character"
					},
					// "cPassword": " Enter Confirm Password Same as Password"
				},
			});

		}


		$("#addUs").unbind('submit').bind('submit', function (e) {
			e.preventDefault();
			validateField();
			if ($(this).valid() == true) {

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

						if (response.success == true) {
							$('#addUser').modal('hide');
							toastr.success(response.messages, { timeOut: 5000 })
							clearForm();
							$("#grid").data("kendoGrid").dataSource.filter({});
							$("#grid").data("kendoGrid").dataSource.read();

						} else {
							toastr.warning(response.messages, { timeOut: 5000 })
						}

					}
				});


			} else {
				return false;
			}
		});




		$("#edit").on("click", function name(e) {
			clearForm();
			var grid = $('#grid').data('kendoGrid');
			var dataItem = grid.dataItem(grid.select());
			if (dataItem == null) {
				toastr.warning('Please select one row to edit', { timeOut: 5000 })
				return false;
			}
			$('#addUser').modal('show');
			$('.modal-title').html('Edit User');
			$('#userpw').hide();
			$('#userId').val(dataItem.user_id);
			$('#fullName').val(dataItem.fullname);
			$('#address').val(dataItem.address);
			$('#email').val(dataItem.email);
			$('#userType').data("kendoDropDownList").value(dataItem.user_type);
			//$('#status').data("kendoDropDownList").value(dataItem.is_active);
			$('#phone').val(dataItem.phone);
			$('#username').val(dataItem.username);
			$("#addUs").attr('action', '<?php echo base_url(); ?>users/update');
		})



		$("#delete").on("click", function name(e) {
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

			bootbox.confirm("Are you sure want to delete?", function (result) {
				if (result) {
					$.ajax({
						url: '<?= base_url(); ?>users/delete',
						type: 'POST',
						data: { id: selectedData },
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