<?php
$currentURL = "$_SERVER[REQUEST_URI]";
$checkURL = substr($currentURL, 5);

if (!in_array($checkURL, $this->session->userdata('userURL'))) {
    redirect('errors/error');
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Approval</h1>
        <h5>
            <?php
            if ($this->session->flashdata('approve_success') != NULL) {
                echo '<div class="alert alert-success">' . $this->session->flashdata('approve_success') . '</div>';
            }
            if ($this->session->flashdata('approve_fail') != NULL) {
                echo '<div class="alert alert-error">' . $this->session->flashdata('approve_fail') . '</div>';
            }
            ?>
        </h5>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Approvals</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box box-primary">
                    <div class="box-header">
                    </div>
                    <div class="box-body">
                        <li class="inline">
                            <i class="fa fa-check" style="color: green;"></i>: Approve -
                        </li>
                        <li class="inline">
                            <i class="fa fa-warning" style="color: orange;"></i>: Invalid -
                        </li>
                        <li class="inline">
                            <i class="fa fa-close" style="color: red;"></i>: Reject -
                        </li>
                        <li class="inline">
                            <i class="fa fa-eye" style="color: blue;"></i>: Verify
                        </li>

                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#approve_donation">Approve Donations</a></li>
                            <li><a data-toggle="tab" href="#approve_reception">Approve Receptions</a></li>
                            <li><a data-toggle="tab" href="#approve_history">Approval History</a></li>
                        </ul>
                        <!-- donation tab started -->
                        <div class="tab-content">
                            <div id="approve_donation" class="tab-pane fade in active">
                                <p>You are viewing donation records, needs to be approved.</p>
                                <table id="donation-table" class="table table-bordered table-responsive">
                                    <thead>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Date</th>
                                    <th>File</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($donation as $key) { ?>
                                        <tr>
                                            <td><?php echo $key->subject; ?></td>
                                            <td><?php echo $key->description; ?></td>
                                            <td><?php echo $key->category_name; ?></td>
                                            <td><?php echo $key->quantity; ?></td>
                                            <td>
                                                <?php echo date_format(date_create($key->created_at), 'd-M-Y'); ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>uploads/<?php echo $key->file; ?>">
                                                    View
                                                </a>
                                            </td>
                                            <td>
                                                <span class="label label-default"><?php echo $key->status; ?></span>
                                            </td>
                                            <td>
                                            <span>
                                                <i class="btn btn-default fa fa-warning"
                                                   style="color: orange;" onclick="approveDonation(<?php echo $key->request_id; ?>,2)"
                                                   title="Invalid"></i> |
                                                <i class="btn btn-default fa fa-eye"
                                                   style="color: blue;" onclick="approveDonation(<?php echo $key->request_id; ?>,5)"
                                                   title="Verify"></i>
                                            </span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- reception tab started -->
                            <div id="approve_reception" class="tab-pane fade">
                                <p>You are viewing reception records, needs to be approved.</p>
                                <table id="" class="table table-bordered table-responsive">
                                    <thead>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Date</th>
                                    <th>Receive As</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($reception as $key) { ?>
                                        <tr>
                                            <td><?php echo $key->subject; ?></td>
                                            <td><?php echo $key->description; ?></td>
                                            <td><?php echo $key->category_name; ?></td>
                                            <td><?php echo $key->quantity; ?></td>
                                            <td>
                                                <?php echo date_format(date_create($key->created_at), 'd-M-Y'); ?>
                                            </td>
                                            <td><?php echo $key->reference; ?></td>
                                            <td>
                                                <span class="label label-default"><?php echo $key->status; ?></span>
                                            </td>
                                            <td>
                                            <span>
                                                <i class="btn btn-default fa fa-check"
                                                   style="color: green;" onclick="approveReception(<?php echo $key->request_id; ?>,1)"
                                                   title="Approve"></i> |
                                                <i class="btn btn-default fa fa-close"
                                                   style="color: red;" onclick="approveReception(<?php echo $key->request_id; ?>,4)"
                                                   title="Reject"></i>
                                            </span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- history tab started -->
                            <div id="approve_history" class="tab-pane fade">
                                <p>You are viewing approval history.</p>
                                <table id="example1" class="table table-bordered table-responsive">
                                    <thead>
                                    <th>Date</th>
                                    <th>Request ID</th>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Approved By</th>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($approval_history as $key) { ?>
                                        <tr>
                                            <td>
                                                <?php echo date_format(date_create($key->approval_date), 'd-M-Y'); ?>
                                            </td>
                                            <td><?php echo $key->request_id; ?></td>
                                            <td><?php echo $key->subject; ?></td>
                                            <td><?php echo $key->description; ?></td>
                                            <td><?php echo $key->type; ?></td>
                                            <td>
                                                <?php
                                                if ($key->status == 'pending')
                                                    echo '<span class="label label-default">'.$key->status.'</span>';
                                                else if ($key->status == 'verified')
                                                    echo '<span class="label label-info">'.$key->status.'</span>';
                                                else if ($key->status == 'invalid')
                                                    echo '<span class="label label-warning">'.$key->status.'</span>';
                                                else if ($key->status == 'rejected')
                                                    echo '<span class="label label-danger">'.$key->status.'</span>';
                                                else if ($key->status == 'approved')
                                                    echo '<span class="label label-success">'.$key->status.'</span>';
                                                ?>
                                            </td>
                                            <td><?php echo $key->name; ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
