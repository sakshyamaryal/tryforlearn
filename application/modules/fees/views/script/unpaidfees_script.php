<script>
	isDirty = 0;
	$(document).ready(function () {
		dataSource = new kendo.data.DataSource({
			transport: {
				read: "<?php echo base_url(); ?>fees/get_unpaidfees",
				update: {
					url: "<?php echo base_url(); ?>fees/update",
					complete: function (e) {

						toastr.success('Fees has been updated', {timeOut: 5000})
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
					id: "student_fee_id",
					fields:{
					student_fee_id:{type: "number"},
					paid_amount: {type: "string", validation: { required: true}},
					
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
			height: 450,
			selectable: true,
			// toolbar: ["create"],
			editable: "inline",
			// toolbar: kendo.template($("#template").html()),
			columns: [{
				title: "S.N",
				template: "#= ++record #",
				width: "50px",
				filterable: false
			},
				{
					field: "fullname",
					title: "Student Name",
					width: "200px"
				},
				{
					field: "address",
					title: "Address",
					width: "200px"
				},
				{
					field: "phone",
					title: "Phone",
					width: "200px"
				},
				{
					field: "email",
					title: "Email",
					width: "200px"
				},
				{
					field: "subject_name",
					title: "Subject Name ",
					width: "200px"
				},
				{
					field: "pay_amount",
					title: "Pay Amount",
					width: "200px"
				},
				{
					field: "paid_amount",
					title: "Paid Amount",
					width: "200px"
				},
				{
					field: "pay_date",
					title: "Pay Date",
					width: "200px"
				},
				{
					field: "paid_date",
					title: "Paid Date",
					width: "200px"
				},
				
				{
					field: "is_paid",
					title: "Pay Status",
					width: "120px",
					editor: statusDropDownEditor,
					template: "# if(is_paid == '1' )  { # PAID # } else  {#  UNPAID # }   #",
					filterable: {
						ui: statusFilter
					}
				},
			
				
				{ command: ["edit"], title: "&nbsp;", width: "250px" },

			],
			
			dataBinding: function () {
				record = (this.dataSource.page() - 1) * this.dataSource.pageSize();
			}
		});
		var status_data = [{name: "UNPAID", value: "0"}, {name: "PAID", value: "1"}];


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

		$("#activate").on("click", function name(e) {
			
			var grid = $('#grid').data('kendoGrid');
			var dataItem = grid.dataItem(grid.select());
		
					$.ajax({
						url: '<?= base_url(); ?>fees/activate_course',
						type: 'POST',
						data: {se:dataItem.student_enroll_id},
						success: function (response) {
							console.log(response);
							let res = jQuery.parseJSON(response);
							if (res.success === true) {
								toastr.success('Course Has been Activated', {timeOut: 5000})
								$("#grid").data("kendoGrid").dataSource.filter({});
								$("#grid").data("kendoGrid").dataSource.read();
							} else {
								toastr.error(response.messages, {timeOut: 5000})
							}
						}

					});
				

		})






	});
</script>