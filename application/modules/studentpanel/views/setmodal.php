<div class="modal" tabindex="-1" role="dialog" id="setmodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title ">Select a Datasets</h5>
     
      </div>
      <div class="modal-body">
      </div>
      
    </div>
  </div>
</div>

<div class="modal fade" id="datasetinfomodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Dataset Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
                <p class="text-center"><strong id="dataset_setname"></strong></p>
                <p class="text-center"><strong>Guidelines:</strong></p>
                <ul class="d-flex align-items-center justify-content-center flex-column" id="dataset_guidelines"></ul>
                <div class="d-flex align-items-center justify-content-between">
                  <p><strong>Total Questions:</strong> <span id="dataset_totalquestions"></span></p>
                  <p><strong>Time Period:</strong> <span id="dataset_timeperiod"></span></p>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" id="startquizbtn" class="btn btn-success">Start Quiz</button>
            </div>
        </div>
    </div>
</div>