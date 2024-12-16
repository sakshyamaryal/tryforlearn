<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Progress Report Card</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="css/progress.css">
    <style>
    .container{
        /*border:5px solid black;*/
    }
        .title h1{
                /*margin-bottom: 3rem;*/
                text-transform: uppercase;
                font-weight: 700;
            }
            .title h5{
                margin-bottom: 1rem;
                /*text-transform: uppercase;*/
                /*font-weight: 700;*/
            }
    }
        
    </style>
</head>
<body>
    <div class="container" style="padding:2rem;background-color: #f0f1e9b8;
    justify-content: center;text-align:center;border-radius:15px;margin-top:2rem;margin-bottom:2rem;">
        <div class="row justify-content-center" style="bdisplay: flex;
        justify-content: center;text-align:center;border-radius:15px;">
            <div class="col-md-12" style="display: block;">
                 <div class="company">
                    <img style="width:20%;" src="http://www.softcherry.com.np/assets/frontend/images/soft-cherry-nepal.png" alt="" class="logo">
                    <div class="title" style="margin-bottom: 1rem;">
                        <h1>Try For Learn Pvt. Ltd.</h1>
                        <h5>Kritipur -09, Kathmandu</h5>
                        <h2>Progress Report Card</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">   
                    <div class="detail" style="padding:2rem;">
                            <p style="display: table;width:100%;">
                                <span style="display: table-cell;width:25%;text-align:left;"> 
                                    <b>Name of the student </b>
                                </span>
                                <span style="display: table-cell;  border-bottom: 1px dotted #8c8b8b;text-align:left;">
                                        <?= @$main->fullname;?> 
                                        
                                </span>
                                <span style="display: table-cell;width:10%;">
                                        <b>Phone </b>
                                    </span>
                                    <span style="display: table-cell;  border-bottom: 1px dotted #8c8b8b;text-align:left;">
                                    <?= @$main->phone;?> 

                                            
                                    </span>
                            </p>
                            <p style="display: table;width:100%;">
                                    <span style="display: table-cell;width:15%;text-align:left;"><b>Address </b></span>
                                    <span style="display: table-cell;  border-bottom: 1px dotted #8c8b8b;text-align:left;width:50%;">
                                    <?= @$main->address;?> 

                                    </span>
                                    <span style="display: table-cell;width:15%;">
                                        <b>Course </b>
                                    </span>
                                    <span style="display: table-cell;  border-bottom: 1px dotted #8c8b8b;text-align:left;">
                                    <?= @$main->levelname;?> 
                                            
                                    </span>
                                    

                                </p>
                                <p style="display: table;width:100%;">
                                    <span style="display: table-cell;width:15%;text-align:left;"><b>Exam Date </b></span>
                                    <span style="display: table-cell;  border-bottom: 1px dotted #8c8b8b;text-align:left;width:30%;">
                                    <?= @$main->examdate;?> 
                                            
                                        </span>
                                    <span style="display: table-cell;width:15%;"><b>Exam Type </b></span>
                                    <span style="display: table-cell;  border-bottom: 1px dotted #8c8b8b;text-align:left;">
                                    <?= @$main->examtypename;?> 
                                            
                                        </span>
                                </p>
                                     
                    </div>
            
            <div class="marksheet" style="text-align:center; justify-content:center;">
                <table class="table " style="background-color: beige">
                    <tr style="background-color: #0d0dab;color:#fff;">
                        <th>SN</th>
                        <th>Level/Subject</th>
                        <th>Full Mark</th>
                        <th>Pass Mark</th>
                        <th>Obtained Mark</th>
                        <!-- <th>Position</th> -->
                    </tr>
                    
                    <?php $i=0;
                    foreach($report as $val): $i++;?>
                    <tr>
                        <td><?= $i ; ?></td>
                        <td><?php if($val->classname!=''){echo $val->classname.' / '.$val->subject_name;}else { echo $main->levelname;} ?></td>
                        <td><?= $main->fullmarks ; ?></td>
                        <td><?= $main->passmarks ; ?></td>
                        <td><?= $val->obtainedmark ; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    
                    <tr>
                            <td colspan="4"><b>Total</b></td>
                            <td><?= $main->obtainedmark;?></td>
                        </tr>
                    <tr>
                            <td colspan="4"><b>Percentage</b></td>
                            <td><?=  $main->percent ?> %</td>
                        </tr>
                        
                </table>   
            </div>
            <div class="remarks">
                <br>
                <p style="display: table;width:100%;">
                    <span style="display: table-cell;width:7%;text-align:left;"><b>Teacher's Comment: </b></span>
                    <span style="display: table-cell;  border-bottom: 1px dotted #8c8b8b;text-align:left;width:30%;"><?= $data[0]['exam_date'];?></span>
                <!-- <p style="text-align: left;"><b>Comments</b></p> -->
                <p class="answer" style="border-bottom: 1px dotted #8c8b8b;text-align:left;line-height: 3rem; padding: 1.6rem;"></p>
                <!-- <p class="answer" style="border-bottom: 1px dotted #8c8b8b;text-align:left;line-height: 3rem;padding: 1.6rem; "></p> -->
                
                <br><br>
                <div class="pull-left" style="float:left;" >
                <p class="right" style="text-align: left;"><b>Prepared By:</b></p>
                <p class="answer" style="border-bottom: 1px dotted #8c8b8b;text-align:left;line-height: 3rem; width:300px;">TRY FOR LEARN Pvt. Ltd.</p>     
            </div>
           
 
            </div>
        </div>
      
       

    </div>
    </div>
</body>
</html>