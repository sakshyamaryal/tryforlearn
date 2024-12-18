<script>
	isDirty = 0;
	$(document).ready(function () {
		$('#package').select2({
			placeholder: "Select packages",
			allowClear: true
		});
		$('#subjectid').select2({
			placeholder: "Select Subjects",
			allowClear: true
		});
		dataSource = new kendo.data.DataSource({
			transport: {
				read: "<?php echo base_url(); ?>coupon/get_coupon",
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
					id: "vouchercodeid",
					levelid: "levelid",
					classid: "classid",
					subjectid: "subjectid",
					vouchercode: { type: "string" },
					class: { type: "string" },
					subject_name: { type: "string" },
					discountamount: { type: "string" },
					packagetype: { type: "string" },
					discounttype: { type: "string" },
					maxlimit: { type: "string" },
					validtill: { type: "string" },

					isactive: { type: "string" },

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
			height: 1350,
			selectable: 'multiple',
			toolbar: kendo.template($("#template").html()),
			columns: [
				{
					title: "<input type='checkbox' id='selectAllRows' /> S.N",
					template: function (dataItem) {
						return `<input type='checkbox' class='rowCheckbox' data-id='${dataItem.id}' /> ${++record}`;
					},
					width: "50px",
					filterable: false
				},
				{
					field: "name",
					title: "Class",
					width: "100px"
				},

				{
					field: "subject_name",
					title: "Subject",
					width: "100px"
				},
				{
					field: "packagetype",
					title: "Package Type",
					width: "100px"
				},

				{
					field: "vouchercode",
					title: "coupon",
					width: "100px"
				},
				{
					field: "maxlimit",
					title: "User Limit",
					width: "100px"
				},
				{
					field: "discountamount",
					title: "Amount",
					width: "100px"
				},



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

		var status_data = [{ name: "inactive", value: "0" }, { name: "Active", value: "active" }];

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

		// $("#university_id").kendoDropDownList({
		// 	dataTextField: "name",
		// 	dataValueField: "university_id",
		// 	dataSource: {
		// 		type: "json",
		// 		serverFiltering: true,
		// 		transport: {
		// 			read: {
		// 				url: "<?php echo base_url(); ?>/coupon/getUniversity",
		// 			}
		// 		}
		// 	}
		// });


		$("#refresh").on("click", function (e) {
			$("#grid").data("kendoGrid").dataSource.filter({});
			e.preventDefault();
			$("#grid").data("kendoGrid").dataSource.read();
		});


		$("#add").on("click", function name(e) {
			$('#addUniversity').modal('show');
			$('.modal-title').html('Add coupon');

		})
		$("#status").kendoDropDownList({
			dataTextField: 'name',
			dataValueField: 'value',
			dataSource: status_data,

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

			$("#addUs").validate({
				rules: {
					"name": {
						required: true,
						minlength: 3
					},
					"description": {
						required: true,
					}


				},
				messages: {
					"name": {
						required: "Please enter Name",
						minlength: "Vendor Name must consist of at least 3 characters"
					},
					"description": {
						required: "Please enter Description",
					}


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
							$('#addUniversity').modal('hide');
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
			console.log(dataItem);
			if (dataItem == null) {
				toastr.warning('Please select one row to edit', { timeOut: 5000 })
				return false;
			}
			$('#addUniversity').modal('show');
			$('.modal-title').html('Edit coupon');
			$('#vouchercodeid').val(dataItem.vouchercodeid);
			$('#levelid').val(dataItem.levelid);
			getclass(dataItem.levelid, dataItem.classid);


			$('#discountamount').val(dataItem.discountamount);
			$('#vouchercode').val(dataItem.vouchercode);
			$('#package').val(dataItem.packagetype);
			$('#limit').val(dataItem.maxlimit);
			$('#discounttype').val(dataItem.discounttype);
			$('#validity').val(dataItem.validtill);
			$('#forGender').val(dataItem.for_gender);
			$('#forDisabled').val(dataItem.for_disabled);
			getsubject(dataItem.classid, dataItem.subjectid);


			$("#addUs").attr('action', '<?php echo base_url(); ?>coupon/update');
		})





		$("#delete").on("click", function name(e) {
			var grid = $('#grid').data('kendoGrid');

			var selectedRows = grid.select();

			var selectedData = [];
			selectedRows.each(function () {
				var dataItem = grid.dataItem(this);
				selectedData.push(dataItem.vouchercodeid);
			});

			if (selectedData.length < 1) {
				toastr.warning('Please select one row to delete', { timeOut: 5000 })
				return false;
			}

			bootbox.confirm("Are you sure want to delete?", function (result) {

				if (result) {
					$.ajax({
						url: '<?= base_url(); ?>coupon/delete',
						type: 'POST',
						data: { id: selectedData },
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


	});


	$(document).on('change', '#levelid', function (e) {
		let coursetype = $('#levelid').val();
		if (coursetype == '-1') {

		}
		else if (coursetype == '4' || coursetype == '5') {


		}
		else {

			getclass(coursetype);

		}
	})

	function getclass(coursetype, classselected = false) {
		$.ajax({
			url: '<?= base_url(); ?>exercise/getclassdropdown',
			type: 'POST',
			data: { coursetype },
			beforeSend: function () {
				$('#loader').show();
			},
			success: function (res) {
				$('#loader').hide();
				let response = jQuery.parseJSON(res);
				if (response.type == 'success') {
					$('#classid').empty();
					$('#classid').html(response.html);

					if (classselected !== false) {
						$('#classid').val(classselected);
					}



				} else {
					//toastr.error(response.message, {timeOut: 5000})

				}
			}

		});
	}



	$(document).on('change', '#classid', function (e) {
		let classid = $(this).val();
		getsubject(classid);

	})

	function getsubject(classid, subjectselected = false) {
		$.ajax({
			url: '<?= base_url(); ?>chapter/getsubject/',
			type: 'POST',
			data: { classid: classid },
			beforeSend: function () {
				$('#loader').show();
			},
			success: function (res) {
				$('#loader').hide();
				let response = jQuery.parseJSON(res);
				if (response.type == 'success') {
					$('#subjectid').empty();
					$('#subjectid').html(response.html);
					if (subjectselected !== false) {
						$('#subjectid').val(subjectselected);
					}


				} else {
					$('#subjectid').empty();
					//toastr.error(response.message, {timeOut: 5000})
				}
			}

		});

	}

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

</script>