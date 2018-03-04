<?php

$currentURL = "$_SERVER[REQUEST_URI]";
$checkURL = substr($currentURL, 5);

if (!in_array($checkURL, $this->session->userdata('userURL'))) {
    redirect('error/error');
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Dashboard<small>Users &amp; Roles</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Settings</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12" style="margin-bottom: 5px;">
                <span class="pull-right">
                    <?php if (in_array("user/adduser", $this->session->userdata('userURL'))) { ?>
                        <a href="<?php echo base_url(); ?>user/signup" class="btn bg-purple">Add User</a>
                    <?php } ?>
                    <?php if (in_array("user/assignrole", $this->session->userdata('userURL'))) { ?>
                    <button class="btn bg-purple" data-toggle="modal" data-target="#roleModal">Assign Role</button>
                    <?php } ?>
                </span>
            </div>
            <!-- left column -->
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <table class="table table-bordered table-responsive" id="example1">
                            <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Address</th>
                            <th>Reg Date</th>
                            <th>Cell</th>
                            <th>Action</th>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $key) { ?>
                                <tr>
                                <td><?php echo $key->user_id; ?></td>
                                <td><?php echo $key->name; ?></td>
                                <td><?php echo $key->email; ?></td>
                                <td>
                                    <?php
                                    if ($key->user_status == 1)
                                        echo "<span style='color:green; font-weight:bold;'>Active</span>";
                                    else
                                        echo "<span style='color:red; font-weight: bold;'>Inactive</span>";
                                    ?>
                                </td>
                                <td><?php echo $key->address; ?></td>
                                <td><?php echo date_format(date_create($key->created_at), 'd-M-Y'); ?></td>
                                <td><?php echo $key->cell; ?></td>
                                <td>
                                    <?php if (in_array("user/edituser", $this->session->userdata('userURL'))) { ?>
                                    <button class="btn bg-olive form-buttons">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <?php } ?>
                                    <?php if (in_array("user/deleteuser", $this->session->userdata('userURL'))) { ?>
                                    <button class="btn bg-orange form-buttons">
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
            <div class="col-sm-6">
                <div class="box box-primary">
                    <div class="box-body">
                        <table class="table table-bordered table-responsive" id="example2">
                            <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Role</th>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($users_by_role as $key) { ?>
                                <tr>
                                    <td><?php echo $key->name; ?></td>
                                    <td><?php echo $key->email; ?></td>
                                    <td>
                                        <?php
                                        if ($key->user_status == 1) {
                                            echo "<span style='color:green; font-weight:bold;'>Active</span>";
                                        } else
                                            echo "<span style='color:red; font-weight: bold;'>Inactive</span>";
                                        ?>
                                    </td>
                                    <td><span class="label label-primary"><?php echo $key->role_name; ?></span></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="scrollDown">

            </div>
        </div>
    </section>
</div>

<!-- Assign role to User modal starts -->
<div class="modal fade" id="roleModal" role="dialog">
    <div class="modal-dialog" style="width:600px;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="panel-heading">
                    <h3 class="panel-title">Assign Role</h3>
                </div>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Role</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="role-assign">
                                    <option value="">Select Role</option>
                                    <?php foreach ($roles as $key) { ?>
                                        <option value="<?php echo $key->role_id; ?>"><?php echo ucfirst($key->role_name); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">User</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="user"></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" id="rolesForm">Save</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Assing role to User modal ends -->