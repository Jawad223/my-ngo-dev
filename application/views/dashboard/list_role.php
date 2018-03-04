<?php

$currentURL = "$_SERVER[REQUEST_URI]";
$checkURL = substr($currentURL, 5);

if (!in_array($checkURL, $this->session->userdata('userURL'))) {
    redirect('errors/error');
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Roles</h1>
        <h5>
            <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>
            <?php
            if ($this->session->flashdata('role_fail') != NULL) {
                echo '<div class="alert alert-danger">' . $this->session->flashdata('role_fail') . '</div>';
            }
            if ($this->session->flashdata('role_success') != NULL) {
                echo '<div class="alert alert-success">' . $this->session->flashdata('role_success') . '</div>';
            }
            ?>
        </h5>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Update View Roles</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12" style="margin-bottom: 5px;">
                <span class="pull-right">
                    <?php if (in_array("role/addrole", $this->session->userdata('userURL'))) { ?>
                        <button class="btn bg-purple" id="add-role">Add Role</button>
                    <?php } ?>
                </span>
            </div>

            <div class="col-xs-12" style="margin-top:5px;">
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($role as $key) { ?>
                                <tr>
                                    <td><?php echo ucwords($key->role_name); ?></td>
                                    <?php if (in_array("role/editrole", $this->session->userdata('userURL'))) { ?>
                                    <td>
                                        <button class="btn bg-olive edit-role form-buttons"
                                                onclick="getRole(<?php echo $key->role_id; ?>)">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <?php } ?>
                                        <?php if (in_array("role/deleterole", $this->session->userdata('userURL'))) { ?>
                                        <button class="btn bg-orange form-buttons"
                                                onclick="javascript:confirmDeleteRole(<?php echo $key->role_id; ?>)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                <?php } ?>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- add role form -->
            <div class="col-md-6" style="display: none;">
                <div>
                    <form class="form-horizontal" id="add-role-form"
                          method="POST" action="<?php echo base_url(); ?>role/addrole">
                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">Role</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="description" placeholder="Role Name" name="role_name">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- edit role form -->
            <div class="col-md-6" style="display: none;">
                <div>
                    <form class="form-horizontal" id="edit-role-form"
                          method="POST" action="<?php echo base_url(); ?>role/updaterole">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="role-id" name="role_id">
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Role</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="role-name" name="role_name" placeholder="Role">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

