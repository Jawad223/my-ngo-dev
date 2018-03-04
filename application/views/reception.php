<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Reception</h1>
        <h5>
            <?php
            if ($this->session->flashdata('reception_fail') != NULL) {
                echo '<div class="alert alert-error">' . $this->session->flashdata('reception_fail') . '</div>';
            }
            if ($this->session->flashdata('reception_success') != NULL) {
                echo '<div class="alert alert-info">' . $this->session->flashdata('reception_success') . '</div>';
            }
            ?>
        </h5>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Reception</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <?php echo validation_errors('<div class="alert alert-error">','</div>'); ?>
                <div class="box box-primary">
                    <div class="box-header">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <p>You can view your previous reception/history, if any and can donate using the donation <a
                                    href="<?php echo base_url(); ?>donation/donatev">section</a></p>

                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#receive">Receive</a></li>
                            <li><a data-toggle="tab" href="#myhistory">My History</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="myhistory" class="tab-pane fade col-md-12">
                                <h3>My History</h3>
                                <p>You are viewing reception records.</p>
                                <table class="table table-bordered table-responsive" id="example2">
                                    <thead>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Measurement</th>
                                    <th>Quantity</th>
                                    <th>Reference</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($reception as $key) { ?>
                                        <tr>
                                            <td><?php echo $key->subject; ?></td>
                                            <td><?php echo $key->description; ?></td>
                                            <td><?php echo $key->category_name; ?></td>
                                            <td><?php echo $key->measurement_unit; ?></td>
                                            <td><?php echo $key->quantity; ?></td>
                                            <td><?php echo $key->reference; ?></td>
                                            <td>
                                                <?php echo date_format(date_create($key->created_at), 'd-M-y'); ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($key->status == strtolower("pending"))
                                                    echo '<span class="label label-default">'.$key->status.'</span>';
                                                else if ($key->status == strtolower("rejected"))
                                                    echo '<span class="label label-danger">'.$key->status.'</span>';
                                                else if ($key->status == strtolower("approved"))
                                                    echo '<span class="label label-primary">'.$key->status.'</span>';
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div id="receive" class="tab-pane fade in active col-md-10">
                                <h3>Receive</h3>
                                <p>Fill the form with required data and apply to our organization for reception.</p>
                                <div>
                                    <form class="form-horizontal" method="POST" role="form"
                                          action="<?php echo base_url(); ?>reception/addreception">
                                        <div>
                                            <input type="hidden" name="id" value="<?php echo $this->session->userdata('user_id'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-3 control-label">Name</label>
                                            <div class="col-sm-5">
                                                <input type="text" value="<?php echo $this->session->userdata('username'); ?>"
                                                       class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="subject" class="col-sm-3 control-label">Subject</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="subject" class="form-control" placeholder="Subject">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="category" class="col-sm-3 control-label">Category</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" name="category" id="parent-category">
                                                    <option>Select Category</option>
                                                    <?php foreach ($category as $key) { ?>
                                                        <option value="<?php echo $key->category_id; ?>"><?php echo $key->category_name; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <small id="no-child-message" style="color: blue;"></small>
                                        </div>
                                        <!-- div for adding child categories, if any -->
                                        <div id="child-category-div">
                                            <div id="child-category-div-1"></div>
                                            <div id="child-category-div-2"></div>
                                            <div id="child-category-div-3"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="measurement_id" class="col-sm-3 control-label">Measurement Unit</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" name="measurement_id" id="measurement-unit">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="quantity" class="col-sm-3 control-label">Quantity
                                                Request</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" name="quantity" placeholder="$">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="reference_id" class="col-sm-3 control-label">Receive as</label>
                                            <div class="col-sm-3">
                                                <select class="form-control" id="receptionReferenceSelect"
                                                        name="reference_id">
                                                    <option value="">Select Option</option>
                                                    <option value="<?php echo $this->session->userdata('user_id'); ?>">Self</option>
                                                    <option value="reference">Reference</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="showReference"></div>
                                        <div class="form-group">
                                            <label for="exampleTextarea" class="col-sm-3 control-label">Description</label>
                                            <div class="col-sm-6">
                                                <textarea class="form-control" name="description" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-3 col-sm-offset-3">
                                                <button type="submit" class="btn bg-purple">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>