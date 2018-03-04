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
        <h1>Category</h1>
        <h5>
            <?php echo validation_errors('<div class="alert alert-error">','</div>'); ?>
            <?php
            if ($this->session->flashdata('category_fail') != NULL) {
                echo '<div class="alert alert-error">' . $this->session->flashdata('category_fail') . '</div>';
            }
            if ($this->session->flashdata('category_success') != NULL) {
                echo '<div class="alert alert-success">' . $this->session->flashdata('category_success') . '</div>';
            }
            ?>
        </h5>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Update View Categories</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12" style="margin-bottom: 5px;">
                <span class="pull-right">
                    <?php if (in_array("category/addcategory", $this->session->userdata('userURL'))) { ?>
                    <button class="btn bg-purple" id="add-category">Add Category</button>
                    <?php } ?>
                </span>
            </div>

            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Description</th>
                                <th>Parent Category</th>
                                <th>Measurement Unit</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($category as $key) { ?>
                                    <tr>
                                        <td><?php echo $key->category_name; ?></td>
                                        <td><?php echo $key->parent_category ? $key->parent_category : 'N/A'; ?></td>
                                        <td><?php echo $key->measurement_unit; ?></td>
                                        <td>
                                            <?php if (in_array("category/editcategory", $this->session->userdata('userURL'))) { ?>
                                            <button class="btn bg-olive edit-category form-buttons"
                                                    onclick="getCategory(<?php echo $key->category_id; ?>)">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            <?php } ?>
                                            <?php if (in_array("category/deletecategory", $this->session->userdata('userURL'))) { ?>
                                            <button class="btn bg-orange form-buttons"
                                                    onclick="javascript:confirmDeleteCategory(<?php echo $key->category_id; ?>);">
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
        <div class="row">
            <!-- add category form -->
            <div class="col-md-6" style="display: none;">
                <div>
                    <form class="form-horizontal" id="add-category-form"
                          method="POST" action="<?php echo base_url(); ?>category/addcategory">
                        <div class="form-group">
                            <label for="description" class="col-sm-4 control-label">Category</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="category-name-add" placeholder="Category" name="category_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="measurement_unit" class="col-sm-4 control-label">Unit</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="measurement_unit" name="measurement_id">
                                    <option value="">Select Unit</option>
                                    <?php foreach ($unit as $key) { ?>
                                        <option value="<?php echo $key->measurement_id; ?>"><?php echo $key->measurement_unit; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="parent_category" class="col-sm-4 control-label">Parent Category</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="parent_category_id">
                                    <option value="">Self Parent</option>
                                    <?php foreach ($category as $key) { ?>
                                        <option value="<?php echo $key->category_id; ?>"><?php echo $key->category_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- edit category form -->
            <div class="col-md-6" style="display: none;">
                <div>
                    <form class="form-horizontal" id="edit-category-form"
                              action="<?php echo base_url(); ?>category/updatecategory" method="POST">
                        <div>
                            <input type="hidden" class="form-control" id="category-id" name="category_id">
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Category</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="category-name-edit" name="category_name" placeholder="Category">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Parent</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="parent-category-edit" name="parent_category_id">
                                    <option value="">One</option>
                                    <option value="Two">Two</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Unit</label>
                            <div class="col-sm-9">
                                <select id="measurement-unit-edit" class="form-control" name="measurement_id"></select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
