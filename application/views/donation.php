<div class="content-wrapper">
    <section class="content-header">
        <h1>Donations</h1>
        <h5>
            <?php
            if ($this->session->flashdata('donation_fail') != NULL) {
                echo '<div class="alert alert-error">' . $this->session->flashdata('donation_fail') . '</div>';
            }
            if ($this->session->flashdata('donation_success') != NULL) {
                echo '<div class="alert alert-info">' . $this->session->flashdata('donation_success') . '</div>';
            }
            ?>
        </h5>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Donations</li>
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
                        <p>You can view your previous donations/history, if any and can donate using the section below</p>
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#donate">Donate</a></li>
                            <li><a data-toggle="tab" href="#myhistory">My History</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="myhistory" class="tab-pane fade">
                                <h3>My History</h3>
                                <p>You are viewing your donation records.</p>
                                <table id="example2" class="table table-bordered table-responsive">
                                    <thead>
                                    <th>Sr #</th>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <!--<th>Request</th>-->
                                    <th>Category</th>
                                    <th>Unit</th>
                                    <th>Quantity</th>
                                    <th>Date</th>
                                    <th>File</th>
                                    <th>Status</th>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; foreach ($donation as $key) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $key->subject; ?></td>
                                            <td><?php echo $key->description; ?></td>
                                            <!--<td><?php echo $key->type; ?></td>-->
                                            <td><?php echo $key->category_name; ?></td>
                                            <td><?php echo $key->measurement_unit; ?></td>
                                            <td><?php echo $key->quantity; ?></td>
                                            <td>
                                                <?php echo date_format(date_create($key->created_at), 'd-M-Y'); ?>
                                            </td>
                                            <td>
                                                <?php if (!is_null($key->file)) { ?>
                                                    <a href="<?php echo base_url(); ?>uploads/<?php echo $key->file; ?>" >
                                                        View
                                                    </a>
                                                <?php } else { ?>
                                                    <a disabled>View</a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($key->status == 'pending')
                                                    echo '<span class="label label-default">'. $key->status .'</span>';
                                                else if ($key->status == 'verified')
                                                    echo '<span class="label label-info">'. $key->status .'</span>';
                                                else if ($key->status == 'invalid')
                                                    echo '<span class="label label-warning">'. $key->status .'</span>';
                                                else if ($key->status == 'approved')
                                                    echo '<span class="label label-success">'. $key->status .'</span>';
                                                ?>
                                            </td>
                                        </tr>
                                    <?php $i++; } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div id="donate" class="tab-pane fade in active col-md-10">
                                <div style="margin-top: 5px;">
                                    <p>Fill the form with required data and donate to our Organization.</p>
                                </div>
                                <div>
                                    <form class="form-horizontal" action="<?php echo base_url(); ?>donation/adddonation"
                                          method="POST" enctype="multipart/form-data">
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
                                            <label for="quantity" class="col-sm-3 control-label">Subject</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="subject" class="form-control" placeholder="Subject">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Category</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" name="category" id="parent-category">
                                                    <option value="0">Select Category</option>
                                                    <?php foreach ($category as $key) { ?>
                                                        <option value="<?php echo $key->category_id; ?>">
                                                            <?php echo $key->category_name; ?>
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
                                            <label class="col-sm-3 control-label">Measurement Unit</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" name="measurement_id" id="measurement-unit"></select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="quantity" class="col-sm-3 control-label">Quantity /
                                                Amount</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="quantity" class="form-control" placeholder="$">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Donate as</label>
                                            <label class="radio-inline">
                                                <input type="radio" class="minimal" value="1" name="donate_as" checked> Self
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" class="minimal" value="0" name="donate_as"> Anonymous
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="description" class="col-sm-3 control-label">Description</label>
                                            <div class="col-sm-6">
                                                <textarea class="form-control" name="description" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="file" class="col-sm-3 control-label">File input</label>
                                            <div class="col-sm-1">
                                                <input type="file" class="form-control-file" name="file">
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