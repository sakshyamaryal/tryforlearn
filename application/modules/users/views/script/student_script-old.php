<script>
	isDirty = 0;
	$(document).ready(function () {
		dataSource = new kendo.data.DataSource({
			transport: {
				read: "<?php echo base_url(); ?>users/get_student",
				update: {
					url: "<?php echo base_url(); ?>user/update_student",
					complete: function (e) {
						toastr.success('User has been updated', {timeOut: 5000})
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
			editable: "true",
			serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
			schema: {
				type: "json",
				data: "resource",
				model: {
					id: "user_id",
					fields: {
						fullname: {type: "string"}, editable: false,
						address: {type: "string", editable: false},
						username: {type: "string", editable: false},
						phone: {type: "string", editable: false},
						// created_by: {type: "string"},
						// created_date: {type: "date"},
						is_active: {type: "string"},
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
			navigatable: true,
			height: 450,
			selectable: true,
			editable: true,
			toolbar: ["save", "cancel"],
			// toolbar: kendo.template($("#template").html()),
			columns: [{
				title: "S.N",
				template: "#= ++record #",
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
				},

				{
					field: "is_active",
					title: "Status",
					width: "100px",
					editor: statusDropDownEditor,
					template: "# if(is_active == '1' )  { # Active # } else  {#  InActive # }   #",
					filterable: {
						ui: statusFilter
					}
				}


			],
			dataBinding: function () {
				record = (this.dataSource.page() - 1) * this.dataSource.pageSize();
			}
		});

		var status_data = [{name: "inactive", value: "0"}, {name: "Active", value: "1"}];

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

		$("#refresh").on("click", function (e) {
			$("#grid").data("kendoGrid").dataSource.filter({});
			e.preventDefault();
			$("#grid").data("kendoGrid").dataSource.read();
		});


		$("#add").on("click", function name(e) {
			$('#addUser').modal('show');
			$('.modal-title').html('Add User');

		})
		$("#status").kendoDropDownList({
			dataTextField: 'name',
			dataValueField: 'value',
			dataSource: status_data,

		});

	});


</script>
