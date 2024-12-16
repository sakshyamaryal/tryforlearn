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
                    <th  style="text-align:center;">Question</th>
                    <th  style="text-align:center;">Explanation</th>
                    <th  style="text-align:center;">IS Subj/Obj</th>
                    <th  style="text-align:center;">Is For All Date</th>
                    <th  style="text-align:center;">Is Timer</th>
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
      var classid="<?=@$post['class'];?>";
      var subject="<?=@$post['subject'];?>";
      var chapter="<?=@$post['chapter'];?>";
      var group="<?=$post['group'];?>";
      var toshow="<?=$post['toshow'];?>";
      var qtype="<?=$post['qtype'];?>";
      var examtypeid="<?=$post['examtypeid'];?>";
    var dataurl = "<?php echo base_url("exercise/getexercisedata/true") ?>";
  $table = $('#dataTable').DataTable({
    "destroy": true,
    "ajax": {
        "type": "POST",
        "url": dataurl,
        "data":{class:classid,subject,chapter,group,toshow,qtype,examtypeid}
        
    },
    "language": {
      "emptyTable": "<p class='no_data_message'>No Content in a List</p>"
    },
    "fnCreatedRow": function (nRow, aData, iDataIndex) {
                $(nRow).attr('id', 'ch'+aData.chid);
            },
    "columns": [
          { "data": "sn" },
      { "data": "question" },
      { "data": "explanation" },
      { "data": "is_subj_obj" },
      { "data": "is_common" },
      { "data": "is_timer" },
      
      { "data": "action" },
    
    
    ]
   
  });
  }
           </script>