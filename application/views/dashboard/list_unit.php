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
        <h1>Measurement Units</h1>
        <h5>
            <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>
            <?php
            if ($this->session->flashdata('unit_fail') != NULL) {
                echo '<div class="alert alert-error">' . $this->session->flashdata('unit_fail') . '</div>';
            }
            if ($this->session->flashdata('unit_success') != NULL) {
                echo '<div class="alert alert-info">' . $this->session->flashdata('unit_success') . '</div>';
            }
            ?>
        </h5>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Measurement Units</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12" style="margin-bottom: 5px;">
                <span class="pull-right">
                    <?php if (in_array("measurement/addunit", $this->session->userdata('userURL'))) { ?>
                        <button id="add-unit" class="btn btn-primary">Add Unit</button>
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
                                <th>Measurement Unit</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($unit as $key) { ?>
                                <tr>
                                    <td><?php echo $key->measurement_unit; ?></td>
                                    <td>
                                        <?php if (in_array("measurement/editunit", $this->session->userdata('userURL'))) { ?>
                                            <button class="btn bg-olive edit-unit form-buttons"
                                                    onclick="getUnit(<?php echo $key->measurement_id; ?>)">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        <?php } ?>
                                        <?php if (in_array("measurement/deleteunit", $this->session->userdata('userURL'))) { ?>
                                            <button class="btn delete-unit form-buttons bg-orange"
                                                    onclick="javascript: confirmDeleteUnit(<?php echo $key->measurement_id;?>);">
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
        <!-- add reference form-->
        <div class="row">
            <div class="col-md-6" style="display: none;">
                <div>
                    <form class="form-horizontal" id="add-unit-form" method="POST" action="<?php echo base_url(); ?>measurement/addunit">
                        <div class="form-group">
                            <label for="unit" class="col-sm-3 control-label">Unit</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Measurement Unit" name="measurement_unit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- edit reference form-->
            <div class="col-md-6" style="display: none;">
                <div>
                    <form class="form-horizontal" id = "edit-unit-form" method="POST"
                          action="<?php echo base_url(); ?>measurement/updateunit">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="measurement-id" name="measurement_id">
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Unit</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="measurement-unit" name="measurement_unit" placeholder="Unit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
