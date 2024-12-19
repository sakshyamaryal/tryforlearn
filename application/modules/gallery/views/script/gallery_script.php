<script>
	isDirty = 0;
	function myImage(model) {
		var str_array = model.image.split(',');
		var str = ''
		for(var i = 0; i < str_array.length; i++) {
			str += '<img src="./upload/gallery/'+str_array[i]+'" height="50" width="50" >';
		}
		return str;
	}
	$(document).ready(function () {
		dataSource = new kendo.data.DataSource({
			transport: {
				read: "<?php echo base_url(); ?>gallery/get_gallery",
				update: {
					url: "<?php echo base_url(); ?>gallery/update",
					complete: function (e) {
					$("#uploadedFile").val('');			
						toastr.success('gallery has been updated', {timeOut: 5000})
						$("#grid").data("kendoGrid").dataSource.read();
					}
				},
				create: {
					url: "<?php echo base_url(); ?>gallery/add",
					complete: function (e) {
						$("#uploadedFile").val('');
						toastr.success('gallery has been added', {timeOut: 5000})
						$("#grid").data("kendoGrid").dataSource.read();
					}
				},
				upload: {
					url: 'test'
				},
				destroy: {
					url: "<?php echo base_url(); ?>gallery/delete",
					complete: function (e) {
						toastr.success('gallery has been deleted', {timeOut: 5000})
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

			serverSorting: true,
			schema: {
				type: "json",
				data: "resource",
				model: {
					id: "gallery_id",
					fields:{
						editor: fileUploadEditor,
						gallery_id:{type: "number"},
						title: {type: "string",  validation: { required: true}},
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
				pageSizes: [20,30,50,100,"all"],
				refresh: true,
				numeric:false,
				// pageSizes: true,
				buttonCount: 10
			},
			// height: 450,
			selectable: 'multiple',
			editable:
				'inline',
			// toolbar: kendo.template($("#template").html()),
			save: function(e){  e.model.set("gallerImages",$("#uploadedFile").val()); },
			toolbar: ["create"],
			columns: [
				{
					title: "<input type='checkbox' id='selectAllRows' /> S.N",
					template: function (dataItem) {
						console.log(dataItem)
						return `<input type='checkbox' class='rowCheckbox' data-id='${dataItem.gallery_id}' /> ${++record}`;
					},
					width: "50px",
					filterable: false
				},
				{
					field: "title",
					title: "Name",
					width: "90px"
				},

				{
					field: "image",
					title: "Image",
					editor: fileUploadEditor,
					template: "#= myImage(data) #",
					//template: "<img src='<?php //echo base_url(); ?>//upload/gallery/#= image #' target='_blank' height='50' width='50' class='img-responsive'  >",
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

		//function fileUploadEditor(container, options) {
		//	$('<input type="file" id="fileUpload" name="fileUpload" /> ')
		//		.appendTo(container)
		//		.kendoUpload({
		//			multiple: false,
		//			async: {
		//				saveUrl: "<?php //echo base_url(); ?>///gallery/image",
		//				removeUrl:  "<?php //echo base_url(); ?>///gallery/removeImage",
		//				autoUpload: true,
		//			},
		//			validation: {
		//				allowedExtensions: [".jpg", ".png", ".jpeg"]
		//			},
		//			success: onSuccess
		//		});
		//
		//}
		

		function fileUploadEditor(container, options) {
			files = options.model.image;
			var images = [];
			if(files!=''){
				$('#uploadedFile').val(files);
				var files_arr = files.split(',');
				for (var i = 0; i < files_arr.length; i++) {

					files_arr[i] = files_arr[i].replace(/^\s*/, "").replace(/\s*$/, "");

					var fileName = files_arr[i].substring(files_arr[i].lastIndexOf('/') + 1);
					var extension = fileName.split('.').pop();
					images.push({
						name: fileName,
						extension: extension,
						size: "1000kb"
					});
				}
			}

			$('<input type="file" id="files" name="files" />')
				.appendTo(container)
				.kendoUpload({
					async: {
						saveUrl: "<?php echo base_url(); ?>/gallery/updloadImage",
						removeUrl: "<?php echo base_url(); ?>/gallery/removeImage",
					},
					files: images,
					upload: function (e) {
						e.data = {fileId: options.model.gallery_id};
					},
					remove: function (e) {
						e.data = {fileId: options.model.gallery_id};

					},
					success: function (e) {
						if (e.operation == 'upload') {
							var uploadData = $("#uploadedFile").val();
							if (uploadData != '') {
								$("#uploadedFile").val(uploadData + ',' + e.response);
							}
							else {
								$("#uploadedFile").val(e.response);
							}

						}
						else{
							var uploadData = $("#uploadedFile").val();
							var response = e.response;
							var newFile = removeValue(uploadData, response);
							$("#uploadedFile").val(newFile);
							var filesData = $("#uploadedFile").val();
						}
					},



				});

		}
		function removeValue(list, value) {
			return list.replace(new RegExp(",?" + value + ",?"), function (match) {
				var first_comma = match.charAt(0) === ',',
					second_comma;

				if (first_comma &&
					(second_comma = match.charAt(match.length - 1) === ',')) {
					return ',';
				}
				return '';
			});
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
				selectedData.push(dataItem.gallery_id);
			});

			if (selectedData.length < 1) {
				toastr.warning('Please select one row to delete', { timeOut: 5000 })
				return false;
			}

			bootbox.confirm("Are you sure want to delete?", function (result) {

				if (result) {
					$.ajax({
						url: '<?= base_url(); ?>gallery/delete',
						type: 'POST',
						data: {id: selectedData || 0},
						success: function (response) {
							response = JSON.parse(response);
							if (response.success == true) {
								toastr.success(response.messages, {timeOut: 5000})
								$("#grid").data("kendoGrid").dataSource.filter({});
								$("#grid").data("kendoGrid").dataSource.read();
							}
							else {
								toastr.error(response.messages, {timeOut: 5000})
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