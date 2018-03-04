<style>
    body {
        background-color: #eee;
    }

    button {
        background-color: #009933;
        color: white;
        padding: 12px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        opacity: 0.8;
    }
</style>

<div class="container" style="max-width:575px; margin:12px auto;">
    <div class="well">
        <?php
        $attributes = array('role' => 'form');
        echo form_open(base_url() . 'user/adduser', $attributes)
        ?>
        <h2 align="center">Registration Form</h2>
        <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>
        <div class="form-group">
            <label for="firstName">Full Name</label>
            <input type="text" id="firstName" name="name" placeholder="Full Name" class="form-control"
                   value="<?php echo set_value('name'); ?>" autofocus>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Email" class="form-control"
                   value="<?php echo set_value('email'); ?>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" class="form-control">
        </div>
        <div class="form-group">
            <label for="password_confirm">Confirm Password</label>
            <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirm Password"
                   class="form-control">
        </div>
        <div class="form-group">
            <label for="password">CNIC</label>
            <input type="text" id="cnic" name="cnic" placeholder="CNIC" class="form-control"
                   value="<?php echo set_value('cnic'); ?>">
        </div>
        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="text" id="dob" name="dob" class="form-control" placeholder="<?php echo date("m/d/Y"); ?>">
        </div>
        <div class="form-group">
            <label for="cell">Cell #</label>
            <input type="text" id="cell" name="cell" placeholder="Cell #" class="form-control"
                   value="<?php echo set_value('cell'); ?>">
        </div>
        <div class="form-group">
            <label for="education">Education</label>
            <select class="form-control">
                <option value="">Secondary</option>
                <option value="">Higher Secondary</option>
                <option value="">Graduation</option>
                <option value="">Post Graduation</option>
                <option value="">N/A</option>
            </select>
        </div>
        <div class="form-group">
            <label for="profession">Profession</label>
            <input type="text" class="form-control" id="profession" name="profession" placeholder="Profession"
                   value="<?php echo set_value('profession'); ?>">
        </div>
        <div class="form-group">
            <label for="pin">Pin</label>
            <input type="text" id="pin" name="pin" placeholder="Pin" class="form-control">
        </div>
        <?php if (isset($this->session->userdata['login_user'])) { ?>
            <div class="form-group">
                <label for="admin_option">Admin Option</label>
                <select class="form-control" id="admin_option" name="admin">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status_option">Status Option</label>
                <select class="form-control" id="status_option" name="status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        <?php } ?>
        <div class="form-group">
            <label for="address">Mailing Address <small>(Please provide complete mailing address)</small></label>
            <textarea id="address" name="address" class="form-control"><?php echo set_value('address'); ?></textarea>
        </div>
        <div class="form-group">
            <label>Gender</label>
            <div class="row">
                <div class="col-sm-4">
                    <label class="radio-inline">
                        <input type="radio" id="gender" name="gender" value="Female">Female
                    </label>
                </div>
                <label class="radio-inline">
                    <input type="radio" id="gender" name="gender" value="Male" checked>Male
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file">
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox">I accept <a href="#">terms</a>
                </label>
            </div>
        </div> <!-- /.form-group -->
        <div class="form-group">
            <button type="submit">Register</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
