<div class="row" style="width: -webkit-fill-available !important;">
    <?php if ($free_course) { ?>
        <div class="col-12">
            <h4>Free Courses</h4>
        </div>
        <?php foreach ($free_course as $lcourse) :
        ?>

            <div class="col-md-3 col-sm-6 mb-4">
                <a href="javascript:void(0)" data-type="f" data-val="<?= $lcourse->level_id; ?>" data-levelname="<?= $lcourse->levelname; ?>" class="getchapter<?= $lcourse->level_id; ?>" onclick="getchapter(<?= $lcourse->level_id; ?>)">
                    <div class="card" >
                        <img class="card-img-top" src="<?= base_url(); ?>assets/frontend/images/book.jpg" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text"><b><?= $lcourse->levelname; ?> </b></p>
                            <small style="float:left">Total Chapters:<?= $lcourse->totalchapter; ?></small>
                        </div>
                    </div>
                </a>
            </div>
    <?php endforeach;
    }
    ?>
    <div class="col-12 mt-4">
        <h4>My Courses</h4>
    </div>
    <?php
    if ($type == 'paid') {
        foreach ($course as $lcourse) :

    ?>

            <div class="col-md-3 col-sm-6 mb-4">
                <a href="javascript:void(0)" data-type="p" data-val="<?= $lcourse->subjectid; ?>" data-subjectname="<?= $lcourse->subject_name; ?>" data-classid="<?= $lcourse->classid; ?>" data-classname="<?= $lcourse->classname; ?>" class="getchapter<?= $lcourse->subjectid; ?>" onclick="getchapter(<?= $lcourse->subjectid; ?>)">
                    <div class="card">
                        <img class="card-img-top" src="<?= base_url(); ?>assets/frontend/images/book.jpg" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text"><b><?= $lcourse->subject_name; ?> </b><small style="float:right">
                                    Level: <?= $lcourse->classname; ?></small><br />
                                <small>
                                    Course: <?= $lcourse->levelname; ?>
                                </small>
                            </p>
                            <small style="float:left">Total Chapters:<?= $lcourse->totalchapter; ?></small><small style="float:right">Total Topics:<?= $lcourse->totaltopic; ?></small>
                        </div>
                    </div>
                </a>
            </div>



        <?php endforeach;
    } else {
        foreach ($course as $lcourse) :

        ?>

            <div class="col-md-3 col-sm-6 mb-4">
                <a href="javascript:void(0)" data-type="f" data-val="<?= $lcourse->level_id; ?>" data-levelname="<?= $lcourse->levelname; ?>" class="getchapter<?= $lcourse->level_id; ?>" onclick="getchapter(<?= $lcourse->level_id; ?>)">
                    <div class="card">
                        <img class="card-img-top" src="<?= base_url(); ?>assets/frontend/images/book.jpg" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text"><b><?= $lcourse->levelname; ?> </b></p>
                            <small style="float:left">Total Chapters:<?= $lcourse->totalchapter; ?></small>
                        </div>
                    </div>
                </a>
            </div>



    <?php endforeach;
    }
    ?>

</div>
