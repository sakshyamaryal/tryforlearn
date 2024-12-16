function loaddatatable()
{
    var filename=$('#dataTable').data('filename');
var cols=$('#dataTable').data('cols');
var date=new Date().getTime();
$('#dataTable').tableExport({
    //type : exportType,			
    headings: true,  
    footers: false,   
    fileName: filename+"_data_"+date, 
    formats: ["xls", "csv", "txt"], 
                   
    bootstrap: true,   
    position: "well" , 
    escape : 'false',
    ignoreCols: [cols], 
    ignoreRows: null,
});
}