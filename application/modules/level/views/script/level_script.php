<script>
	isDirty = 0;
	$(document).ready(function () {
		dataSource = new kendo.data.DataSource({
			transport: {
				read: "<?php echo base_url(); ?>level/get_level",
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
			editable: "true",
			serverPaging: true,
			serverFiltering: true,

			serverSorting: true,
			schema: {
				type: "json",
				data: "resource",
				model: {
					id: "level_id",
					name: {type: "string"},
					description: {type: "string"},
				
				
					is_active: {type: "string"},

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
			selectable: true,
			toolbar: kendo.template($("#template").html()),
			columns: [{
				title: "S.N",
				template: "#= ++record #",
				width: "50px",
				filterable: false
			},
				{
					field: "name",
					title: "Name",
					width: "100px"
				},
				{
					field: "description",
					title: "Description ",
					width: "100px"
				},

				{
					field: "is_active",
					title: "Status",
					width: "100px",
					template: "# if(is_active == '1' )  { # Active # } else  {#  InActive # }   #",
					filterable: {
						ui: statusFilter
					}
				}


			],
			editable: {
				mode: "popup",
				confirmation: false
			},

			dataBinding: function () {
				record = (this.dataSource.page() - 1) * this.dataSource.pageSize();
			}
		});

		var status_data = [{name: "inactive", value: "0"}, {name: "Active", value: "active"}];

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
			$('#addLevel').modal('show');
			$('.modal-title').html('Add Level');

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
						minlength:3
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
							$('#addLevel').modal('hide');
							toastr.success(response.messages, {timeOut: 5000})
							clearForm();
							$("#grid").data("kendoGrid").dataSource.filter({});
							$("#grid").data("kendoGrid").dataSource.read();

						} else {
							toastr.warning(response.messages, {timeOut: 5000})
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
				toastr.warning('Please select one row to edit', {timeOut: 5000})
				return false;
			}
			$('#addLevel').modal('show');
			$('.modal-title').html('Edit User');
			$('#level_id').val(dataItem.level_id);
			$('#name').val(dataItem.name);
			$('#description').val(dataItem.description);
			
			$("#addUs").attr('action', '<?php echo base_url(); ?>level/update');
		})



		$("#delete").on("click", function name(e) {
			var grid = $('#grid').data('kendoGrid');
			var dataItem = grid.dataItem(grid.select());
			if (dataItem == null) {
				toastr.warning('Please select one row to delete', {timeOut: 5000})
				return false;
			}

			bootbox.confirm("Are you sure want to delete?", function (result) {

				if (result) {
					$.ajax({
						url: '<?= base_url(); ?>level/delete',
						type: 'POST',
						data: {id: dataItem.level_id},
						success: function (response) {
							var response = jQuery.parseJSON(response);

							console.log(response.success);
							if (response.success == true) {
								toastr.success(response.messages, {timeOut: 5000})
								$("#grid").data("kendoGrid").dataSource.filter({});
								$("#grid").data("kendoGrid").dataSource.read();
							} else {
								toastr.error(response.messages, {timeOut: 5000})
							}
						}

					});
				}
			})


		})


	});
</script>