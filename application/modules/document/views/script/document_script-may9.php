<script>
	isDirty = 0;
	$(document).ready(function () {
		dataSource = new kendo.data.DataSource({
			transport: {
				read: "<?php echo base_url(); ?>document/get_documents",
				update: {
					url: "<?php echo base_url(); ?>document/update",
					complete: function (e) {

						toastr.success('Document has been updated', {timeOut: 5000})
						$("#grid").data("kendoGrid").dataSource.read();
					}
				},
				create: {
					url: "<?php echo base_url(); ?>document/add",
					complete: function (e) {
						toastr.success('Document has been added', {timeOut: 5000})
						$("#grid").data("kendoGrid").dataSource.read();
					}
				},
				upload: {
					url: 'test'
				},
				destroy: {
					url: "<?php echo base_url(); ?>document/delete",
					complete: function (e) {
						toastr.success('Document has been deleted', {timeOut: 5000})
						$("#grid").data("kendoGrid").dataSource.read();
					}
				},
				parameterMap: function (data, operation) {
					if (data.filter === null) {
						return data;
					}
					if ('filter' in data) {
						for (var i = 0; i < data.filter.filters.length; i++) {
							if (data.filter.filters[i].field == 'exam_date' || data.filter.filters[i].field == 'student_dob') {
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
					id: "document_id",
					fields:{
						document_id:{type: "number"},
						document_no: {type: "string",  validation: { required: true,}},
						student_id: {type: "string",  validation: { required: true }},
						upload_file: {type: "string", validation: { required: true }},
						student_dob: {type: "date",  validation: { required: true }},
						exam_date: {type: "date",  validation: { required: true }},

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
			editable:
				'inline',
			toolbar: kendo.template($("#template").html()),
			save: function(e){  e.model.set("propertyLogo",$("#uploadedFile").val()); },
			// toolbar: ["create"],
			columns: [{
				title: "S.N",
				template: "#= ++record #",
				width: "50px",
				filterable: false
			},
				{
					field: "document_no",
					title: "Document No",
					width: "90px"
				},
				{
					field: "student_id",
					title: "Student Id",
					width: "90px"
				},
				{
					field: "student_dob",
					title: "Validation ID ",
					width: "200px",
					format:"{0:yyyy-MM-dd}",
				},
				{
					field: "exam_date",
					title: "Exam Date ",
					width: "200px",
					format:"{0:yyyy-MM-dd}",
				},
				{
					field: "upload_file",
					title: "Uploaded Document",
					editor: fileUploadEditor,
					template: "<img src='<?php echo base_url(); ?>upload/document/#= upload_file #' target='_blank' height='50' width='50' class='img-responsive'  >",
					width: "130px",
					filterable: false

				},

				
				{command: [ "edit","destroy"], title: "&nbsp;", width: "150px"},


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
						saveUrl: "<?php echo base_url(); ?>/document/image",
						removeUrl:  "<?php echo base_url(); ?>/document/removeImage",
						autoUpload: true,
					},
					validation: {
						allowedExtensions: [".jpg", ".png", ".jpeg",".pdf",".docx",".xls"]
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




	});
</script>