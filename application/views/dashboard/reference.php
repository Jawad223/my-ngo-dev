<?php

$currentURL = "$_SERVER[REQUEST_URI]";
$checkURL = substr($currentURL, 5);

if (!in_array($checkURL, $this->session->userdata('userURL'))) {
    redirect('errors/error');
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>User References
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User References</li>
        </ol>
    </section>
    <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <?php
                if ($this->session->flashdata('reference_success') != NULL) {
                    echo '<div class="alert alert-info">' . $this->session->flashdata('reference_success') . '</div>';
                }
                if ($this->session->flashdata('reference_fail') != NULL) {
                    echo '<div class="alert alert-info">' . $this->session->flashdata('reference_fail') . '</div>';
                } ?>
            </div>
            <div class="col-sm-12" style="margin-bottom: 5px;">
                <span class="pull-right">
                    <?php if (in_array("reference/addreference", $this->session->userdata('userURL'))) { ?>
                        <button class="btn btn-primary" id="add-reference">Add Reference</button>
                    <?php } ?>
                </span>
            </div>
            <div class="col-xs-12">
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Cell</th>
                                <th>Referenced By</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($references as $key) { ?>
                                <tr>
                                    <td><?php echo $key->name; ?></td>
                                    <td><?php echo $key->email; ?></td>
                                    <td><?php echo $key->cell; ?></td>
                                    <td><?php echo $key->user_id; ?></td>
                                    <td>
                                        <?php if (in_array("reference/editreference", $this->session->userdata('userURL'))) { ?>
                                            <button class="btn bg-olive form-buttons" id="btnEditUnit" data-toggle="modal"
                                                    data-target="#myModalEdit"
                                                    onclick="getID(<?php echo $key->reference_id; ?>)">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        <?php } ?>
                                        <?php if (in_array("reference/updatereference", $this->session->userdata('userURL'))) { ?>
                                            <button class="btn bg-orange form-buttons"
                                                    onclick="confirmDeleteReference(<?php echo $key->reference_id; ?>)">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add reference form -->
        <div class="row">
            <div class="col-md-6" id="add-reference-form">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title">Add Reference</h3></div>
                    <div class="panel-body">
                        <form class="form-horizontal" id="unitform" method="POST"
                              action="<?php echo base_url(); ?>reference/addreference">
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="email" placeholder="Email"
                                           name="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cell" class="col-sm-3 control-label">Cell</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="cell" placeholder="Cell" name="cell">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Edit measurement unit modal starts -->
<div class="modal fade" id="myModalEdit" role="dialog">
    <div class="modal-dialog" style="width:510px;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="panel-heading">
                    <h3 class="panel-title">Edit Reference</h3>
                </div>
            </div>
            <div class="modal-body" style="width:430px; margin: 0 auto;">
                <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>reference/updatereference">
                    <div class="box-body">
                        <div>
                            <input type="hidden" class="form-control" id="id" name="id">
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Cell</label>
                            <div class="col-sm-9">
                                <input type="text" name="cell" placeholder="Cell #" id="cell" class="form-control">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-block btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-block btn-primary pull-right">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- Modal ends edit measurement unit -->