// var filename=$('#dataTable').data('filename');
// var cols=$('#dataTable').data('cols');
// if(cols=='-1')
// cols=null;
// else
// cols=[cols];
// var date=new Date().getTime();
// $('#dataTable').tableExport({
//     //type : exportType,			
//     headings: true,  
//     footers: false,   
//     fileName: filename+"_data_"+date, 
//     formats: ["xls", "csv", "txt"], 

//     bootstrap: true,   
//     position: "well" , 
//     escape : 'false',
//     ignoreCols: cols, 
//     ignoreRows: null,
//     trimWhitespace: false    
// });
$('#export-btn').on('click', function(e){
    e.preventDefault();
     var filename=$('#dataTable').data('filename');
     var date=new Date().getTime();
     var cols=$('#dataTable').data('cols');
     if(cols!='-1')
     cols=cols
     else
     cols=[];
     //$("#dataTable thead").prepend('<tr id="heading"><td colspan=8 style="font-weight: bolder; font-size: larger; text-decoration: underline;">Appointment Registered List :  ()</td></tr>');

    $('#dataTable').table2excel({
        name: "Excel Document Name",
        filename: filename+"_data_"+date,
        // exclude_img: true,
        // exclude_links: true,
        // exclude_inputs: true,
        columns : cols
    });
    //$("#dataTable thead #heading").remove();
});


