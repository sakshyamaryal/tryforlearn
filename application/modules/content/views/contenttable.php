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
                    <th  style="text-align:center;">S.N.</th>
                    <th  style="text-align:center;">Content</th>
                    <th  style="text-align:center;">Order</th>
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
      var chapter="<?=$post['chapter'];?>";
      var topic="<?=$post['topic'];?>";
      var toshow="<?=$post['toshow'];?>";
      
    var dataurl = "<?php echo base_url("content/getcontentdata/true") ?>";
  $table = $('#dataTable').DataTable({
    "destroy": true,
    "ajax": {
        "type": "POST",
        "url": dataurl,
        "data":{class:classid,subject,chapter,topic,toshow}
        
    },
    "language": {
      "emptyTable": "<p class='no_data_message'>No Content in a List</p>"
    },
    "fnCreatedRow": function (nRow, aData, iDataIndex) {
                $(nRow).attr('id', 'ch'+aData.chid);
            },
    "columns": [
          { "data": "sn" },
      { "data": "content" },
      { "data": "order" },
      { "data": "action" },
    
    
    ]
   
  });
  }
           </script>