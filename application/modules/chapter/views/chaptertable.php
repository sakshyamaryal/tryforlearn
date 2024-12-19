<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css">
<link rel="stylesheet" href="<?=base_url();?>assets/admin/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url();?>assets/admin/css/theme-style2.css">


<script type="text/javascript" src="<?=base_url();?>dataTables/js/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="<?=base_url();?>dataTables/js/dataTables.buttons.min.js" ></script>
<script type="text/javascript" src="<?=base_url();?>dataTables/js/jquery.dataTables.columnFilter.js" ></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js" ></script>

<table class="table table-bordered table-hover table-striped pad-fixed-tbl mar-10-top dataTable no-footer" id="dataTable" data-filename="chapterlist" data-cols="[0,1]" style="width:90%">
                <thead id="tbl_data_thead">
                    <tr>
                    <th  style="text-align:center;"><input type="checkbox" id="selectAllCheckbox" />S.N.</th>
                    <th  style="text-align:center;">Chapter</th>
                                       

                    <th  style="text-align:center;">Action</th>
                    </tr>
                </thead> 
                <tbody>
                </tbody>
            </table>

            <script>
                getnewdata();
                function getnewdata()
  {
      var classid="<?=$post['class'];?>";
      var subject="<?=$post['subject'];?>";
      var levelid="<?=@$post['levelid'];?>";

      var toshow="<?=$post['toshow'];?>";
      
    var dataurl = "<?php echo base_url("chapter/getchapterdata/true") ?>";
  $table = $('#dataTable').DataTable({
    "destroy": true,
    "ajax": {
        "type": "POST",
        "url": dataurl,
        "data":{class:classid,subject,levelid,toshow}
        
    },
    "language": {
      "emptyTable": "<p class='no_data_message'>No Chapter in a List</p>"
    },
    "fnCreatedRow": function (nRow, aData, iDataIndex) {
                $(nRow).attr('id', 'ch'+aData.chid);
            },
    "columnDefs": [
      { orderable: false, targets: 0 }
    ],
    "columns": [
          { "data": "sn" },
      { "data": "chapter" },
      { "data": "action" },
    
    
    ]
   
  });
  }
           </script>