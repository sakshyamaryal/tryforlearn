<style>
    .panel-info {
    border-color: #bce8f1!important;
}
.panel {
    margin-bottom: 20px;
    background-color: #fff;
    border: 1px solid transparent;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}

.panel-info>.panel-heading {
    color: #31708f;
    background-color: #d9edf7;
    border-color: #bce8f1;
}

.panel-heading {
    padding: 10px 15px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
}
.panel-body {
    padding: 15px;
}
    </style>
<div class="col-md-8 rightcontainer" style="margin-top:10px;">
<?php foreach($notice as $data): ?>
 <div class="row">
         <div class="col-md-12">
            <div class="panel panel-info">
            <div class="panel-heading"><?= $data['title']; ?><span class="float-right"><small><?= $data['cdate']; ?></small></span></div>
            <div class="panel-body"><?= $data['body']; ?></div>
            </div>

          
          </div>
  </div>
<?php endforeach; ?>
 



</div>

</div>
</div>
</section>




