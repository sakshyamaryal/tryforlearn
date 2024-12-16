
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
 include_once APPPATH.'/third_party/mpdf/mpdf.php';
 
class M_pdf {
 
    public $param;
    public $pdf;
 
    public function __construct($param = '"en-GB","A4-L","","",20,20,20,20,6,3,"L"')
    {
        $this->param =$param;
        $this->pdf = new mPDF($this->param);
    }
}