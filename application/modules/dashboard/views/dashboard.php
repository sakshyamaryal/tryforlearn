<div id="content" class="col-lg-10 col-sm-10">

    <div>
    <ul class="breadcrumb">
    <li>
    <a href="<?= $admin_base_url; ?>">Home</a>
    </li>
    <li>
    <a href="#"><?= $title;?></a>
    </li>
    </ul>
    </div>
    <div class=" row">
    <div class="col-md-3 col-sm-3 col-xs-6">
    <a data-toggle="tooltip" title="<?= $total_users->total; ?> Total Users." class="well top-block" href="#">
    <i class="glyphicon glyphicon-user blue"></i>
    <div>Total Users</div>
    <div><?= $total_users->total; ?></div>
    </a>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6">
    <a data-toggle="tooltip" title="<?= $active_users->total; ?> active users" class="well top-block" href="#">
    <i class="glyphicon glyphicon-user green"></i>
    <div>Active Users</div>
    <div><?= $active_users->total; ?></div>
    </a>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6">
    <a data-toggle="tooltip" title="<?= $inactive_users->total; ?> Inactive Users" class="well top-block" href="#">
    <i class="glyphicon glyphicon-user red"></i>
    <div>Inactive Users</div>
    <div><?= $inactive_users->total; ?></div>
    </a>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6">
    <a data-toggle="tooltip" title="<?= $approve_users->total; ?> Approved Users" class="well top-block" href="#">
    <i class="glyphicon glyphicon-user green"></i>
    <div>Approved Users</div>
    <div><?= $approve_users->total; ?></div>
    </a>
    </div>
    </div>
    <div class=" row">
    <div class="col-md-3 col-sm-3 col-xs-6">
    <a data-toggle="tooltip" title="<?= $unapprove_users->total; ?> Unapproved Users" class="well top-block" href="#">
    <i class="glyphicon glyphicon-user red"></i>
    <div>Unapproved Users</div>
    <div><?= $unapprove_users->total; ?></div>
    </a>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6">
    <a data-toggle="tooltip" title="<?= $active_students->total; ?> Active Students" class="well top-block" href="#">
    <i class="fa fa-user-graduate green"></i>
    <div>Active Students</div>
    <div><?= $active_students->total; ?></div>
    </a>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6">
    <a data-toggle="tooltip" title="<?= $inactive_students->total; ?> Inactive Students" class="well top-block" href="#">
    <i class="fa fa-user-graduate red"></i>
    <div>Inactive Students</div>
    <div><?= $inactive_students->total; ?></div>
    </a>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6">
    <a data-toggle="tooltip" title="<?= $approve_students->total; ?> Approved Students" class="well top-block" href="#">
    <i class="fa fa-user-graduate green"></i>
    <div>Approved Students</div>
    <div><?= $approve_students->total; ?></div>
    </a>
    </div>
    </div>
    <div class=" row">
    <div class="col-md-3 col-sm-3 col-xs-6">
    <a data-toggle="tooltip" title="<?= $unapprove_students->total; ?> Unapproved Students" class="well top-block" href="#">
    <i class="fa fa-user-graduate red"></i>
    <div>Unapproved Students</div>
    <div><?= $unapprove_students->total; ?></div>
    </a>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6">
    <a data-toggle="tooltip" title="<?= $total_programs->total; ?> Total Programs" class="well top-block" href="#">
    <i class="fa fa-book green"></i>
    <div>Total Programs</div>
    <div><?= $total_programs->total; ?></div>
    </a>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6">
    <a data-toggle="tooltip" title="<?= $total_category->total; ?> Total Category" class="well top-block" href="#">
    <i class="fa fa-clone green"></i>
    <div>Total Category</div>
    <div><?= $total_category->total; ?></div>
    </a>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6">
    <a data-toggle="tooltip" title="<?= $total_services->total; ?> Total Services" class="well top-block" href="#">
    <i class="fa fa-hockey-puck green"></i>
    <div>Total  Services</div>
    <div><?= $total_services->total; ?></div>
    </a>
    </div>
    </div>
    <div class=" row">
    <div class="col-md-3 col-sm-3 col-xs-6">
    <a data-toggle="tooltip" title="<?= $total_events->total; ?> Total Events" class="well top-block" href="#">
    <i class="fa fa-calendar-day green"></i>
    <div>Total Events</div>
    <div><?= $total_events->total; ?></div>
    </a>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6">
    <a data-toggle="tooltip" title="<?= $today_events->total; ?> Today Events" class="well top-block" href="#">
    <i class="fa fa-calendar-day blue"></i>
    <div>Today Events</div>
    <div><?= $today_events->total; ?></div>
    </a>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6">
    <a data-toggle="tooltip" title="<?= $total_notice->total; ?> Total Notice" class="well top-block" href="#">
    <i class="fa fa-comment-alt green"></i>
    <div>Total Notices</div>
    <div><?= $total_notice->total; ?></div>
    </a>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6">
    <a data-toggle="tooltip" title="<?= $today_notice->total; ?> Today Notice" class="well top-block" href="#">
    <i class="fa fa-comment-alt blue"></i>
    <div>Today Notices</div>
    <div><?= $today_notice->total; ?></div>
    </a>
    </div>
    </div>
    <div class=" row">
    <div class="col-md-3 col-sm-3 col-xs-6">
    <a data-toggle="tooltip" title="<?= $paid_fees->total; ?> Paid Revenue" class="well top-block" href="#">
    <i class="fa fa-rupee-sign blue"></i>
    <div>Paid Fees</div>
    <div><?= $paid_fees->total; ?></div>
    <span class="notification green"><?= $c_paid_fees->total; ?></span>
    </a>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6">
    <a data-toggle="tooltip" title="<?= $unpaid_fees->total; ?> Unpaid Revenue" class="well top-block" href="#">
    <i class="fa fa-rupee-sign red"></i>
    <div>Unpaid Fees</div>
    <div><?= $unpaid_fees->total; ?></div>
    <span class="notification red"><?= $c_unpaid_fees->total; ?></span>
    </a>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6">
    <a data-toggle="tooltip" title="<?= $total_fees->total; ?> Total Revenue" class="well top-block" href="#">
    <i class="fa fa-rupee-sign green"></i>
    <div>Total Fees</div>
    <div><?= $total_fees->total; ?></div>
    </a>
    </div>
    <!-- <div class="col-md-3 col-sm-3 col-xs-6">
    <a data-toggle="tooltip" title="12 new messages." class="well top-block" href="#">
    <i class="glyphicon glyphicon-envelope red"></i>
    <div>Approved Users</div>
    <div><?= $total_users->total; ?></div>
    </a>
    </div> -->
    </div>
   
   