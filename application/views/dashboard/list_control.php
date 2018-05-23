<?php
$currentURL = "$_SERVER[REQUEST_URI]";
$checkURL = substr($currentURL, 5);

if (!in_array($checkURL, $this->session->userdata('userURL'))) {
    redirect('errors/error');
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Controls</h1>
        <h5>
            <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>
            <?php
            if ($this->session->flashdata('control_fail') != NULL) {
                echo '<div class="alert alert-error">' . $this->session->flashdata('control_fail') . '</div>';
            }
            if ($this->session->flashdata('control_success') != NULL) {
                echo '<div class="alert alert-success">' . $this->session->flashdata('control_success') . '</div>';
            }
            ?>
        </h5>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Update View Controls</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12" style="margin-bottom: 5px;">
                <span class="pull-right">
                    <?php if (in_array("control/addcontrol", $this->session->userdata('userURL'))) { ?>
                        <button class="btn btn-primary" id="add-control">Add Control</button>
                    <?php } ?>
                </span>
            </div>
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-heading"></div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>URL</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($control as $key) { ?>
                                <tr>
                                    <td><?php echo ucwords($key->control_name); ?></td>
                                    <td><?php echo $key->control_url; ?></td>
                                    <td>
                                        <?php if (in_array("control/editcontrol", $this->session->userdata('userURL'))) { ?>
                                        <button class="btn bg-olive edit-control form-buttons"
                                                onclick="getControl(<?php echo $key->control_id; ?>)">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <?php } ?>

                                        <?php if (in_array("control/deletecontrol", $this->session->userdata('userURL'))) { ?>
                                        <button class="btn bg-orange form-buttons"
                                                onclick="javascript:confirmDeleteControl(<?php echo $key->control_id; ?>)">
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
        <!-- add control form -->
        <div class="row">
            <div class="col-md-6" style="display: none;">
                <div>
                    <form class="form-horizontal" method="POST" id="add-control-form"
                          action="<?php echo base_url(); ?>control/addcontrol">
                        <div class="form-group">
                            <label for="control_name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="control-name" placeholder="Control Name" name="control_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="control_url" class="col-sm-2 control-label">URL</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="control-url" placeholder="URL" name="control_url">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- edit control dialog -->
            <div class="col-md-6" style="display: none;">
                <div>
                    <form class="form-horizontal" method="POST" id="edit-control-form"
                          action="<?php echo base_url(); ?>control/updatecontrol">
                        <div class="box-body">
                            <div>
                                <input type="hidden" class="form-control" id="id" name="control_id">
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" name="control_name" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">URL</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="url" name="control_url" placeholder="URL">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
