<script>
	isDirty = 0;
	$(document).ready(function () {
		dataSource = new kendo.data.DataSource({
			transport: {
				read: "<?php echo base_url(); ?>qngroup/get_group",
				update: {
					url: "<?php echo base_url(); ?>qngroup/update",
					complete: function (e) {

						toastr.success('group has been updated', {timeOut: 5000})
						$("#grid").data("kendoGrid").dataSource.read();
					}
				},
				create: {
					url: "<?php echo base_url(); ?>qngroup/add",
					complete: function (e) {
						toastr.success('group has been added', {timeOut: 5000})
						$("#grid").data("kendoGrid").dataSource.read();
					}
				},
				upload: {
					url: 'test'
				},
				destroy: {
					url: "<?php echo base_url(); ?>qngroup/delete",
					complete: function (e) {
						toastr.success('group has been deleted', {timeOut: 5000})
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
					id: "groupid",
					fields:{
					groupid:{type: "number"},
					groupname: {type: "string", validation: { required: true}},
					perqnmark: {type: "string", validation: { required: true}},
					fullmark: {type: "string", validation: { required: true}},
					passmark: {type: "string", validation: { required: true}},
					
					is_active: {type: "string", validation: { required: true}},
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
			selectable: true,
			toolbar: ["create"],
			editable: "inline",
			// toolbar: kendo.template($("#template").html()),
			columns: [{
				title: "S.N",
				template: "#= ++record #",
				width: "50px",
				filterable: false
			},
				{
					field: "groupname",
					title: "Name",
					width: "100px"
				},
				{
					field: "perqnmark",
					title: "Per Q/N Mark",
					width: "100px"
				}
				// ,{
				// 	field: "fullmark",
				// 	title: "Fullmark",
				// 	width: "100px"
				// },
				// {
				// 	field: "passmark",
				// 	title: "Passmark",
				// 	width: "100px"
				// }
				,
				
				// {
				// 	field: "is_active",
				// 	title: "Status",
				// 	width: "120px",
				// 	editor: statusDropDownEditor,
				// 	template: "# if(is_active == '1' )  { # Active # } else  {#  InActive # }   #",
				// 	filterable: {
				// 		ui: statusFilter
				// 	}
				// },
				{ command: ["edit", "destroy"], title: "&nbsp;", width: "250px" },

			],
			
			dataBinding: function () {
				record = (this.dataSource.page() - 1) * this.dataSource.pageSize();
			}
		});



		var status_data = [{name: "inactive", value: "0"}, {name: "Active", value: "1"}];


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

		})

		$("#userType").kendoDropDownList({
			dataTextField: "user_type_name",
			dataValueField: "typeid",
			dataSource: {
				type: "json",
				serverFiltering: true,
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






		$("#edit").on("click", function name(e) {
			clearForm();
			var grid = $('#grid').data('kendoGrid');
			var dataItem = grid.dataItem(grid.select());
			if (dataItem == null) {
				toastr.warning('Please select one row to edit', {timeOut: 5000})
				return false;
			}
			window.location = "<?php echo base_url(); ?>/pages/edit/" + dataItem.page_id;

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
						url: '<?= base_url(); ?>qngroup/delete',
						type: 'POST',
						data: {id: dataItem.groupid},
						success: function (response) {
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