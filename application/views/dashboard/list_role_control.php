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
        <h1>Roles &amp; Controls</h1>
        <h5>
            <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>
            <?php
            if ($this->session->flashdata('role_control_fail') != NULL) {
                echo '<div class="alert alert-error">' . $this->session->flashdata('role_control_fail') . '</div>';
            }
            if ($this->session->flashdata('role_control_success') != NULL) {
                echo '<div class="alert alert-success">' . $this->session->flashdata('role_control_success') . '</div>';
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
                    <?php if (in_array("rolecontrol/addrolecontrol", $this->session->userdata('userURL'))) { ?>
                        <button class="btn btn-primary" id="add-role-control">Add Role Control</button>
                    <?php } ?>
                </span>
            </div>
            <div class="col-xs-12">
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped dataTable">
                            <thead>
                            <tr>
                                <th>Control Name</th>
                                <th>URL</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($role_control as $key) { ?>
                                <tr>
                                    <td><?php echo ucwords($key->control_name); ?></td>
                                    <td><?php echo ucwords($key->control_name); ?></td>
                                    <td><?php echo ucwords($key->role_name); ?></td>
                                    <td>
                                        <?php if (in_array("rolecontrol/editrolecontrol", $this->session->userdata('userURL'))) { ?>
                                            <button class="btn bg-olive form-buttons"
                                                    onclick="getID(<?php echo $key->rc_id; ?>)">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        <?php } ?>
                                        <?php if (in_array("rolecontrol/deleterolecontrol", $this->session->userdata('userURL'))) { ?>
                                            <button class="btn bg-orange form-buttons"
                                                    onclick="deleteRoleControl(<?php echo $key->rc_id; ?>)">
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
        <!-- Add role control form-->
        <div class="row">
            <div class="col-md-6" style="display: none;">
                <div>
                    <form class="form-horizontal" method="POST" id="add-role-control-form"
                          action="<?php echo base_url(); ?>rolecontrol/addrolecontrol">
                        <div class="form-group">
                            <label for="Role" class="col-sm-2 control-label">Role</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="rc-role-dropdown" name="role_id">
                                    <option value="">Select Role</option>
                                    <?php foreach ($role as $key) { ?>
                                        <option value="<?php echo $key->role_id; ?>"><?php echo ucwords($key->role_name); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="rc-control-dropdown"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>