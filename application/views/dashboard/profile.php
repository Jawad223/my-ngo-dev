<?php
foreach ($user as $key) {
    $name = $key->name;
    $email = $key->email;
    $password = $key->password;
    $address = $key->address;
    $pin = $key->pin;
    $cell = $key->cell;
    $cnic = $key->cnic;
    $dob = $key->dob;
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>User Profile</h1>
        <h5>
            <?php
            if ($this->session->flashdata('profile_fail') != NULL) {
                echo '<div class="alert alert-error">' . $this->session->flashdata('profile_fail') . '</div>';
            }
            if ($this->session->flashdata('profile_success') != NULL) {
                echo '<div class="alert alert-info">' . $this->session->flashdata('profile_success') . '</div>';
            }
            ?>
        </h5>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User profile</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <h3 class="profile-username text-center"><?php echo $name; ?></h3>
                        <p class="text-muted text-center">Software Engineer</p>
                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">About Me</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
                        <p class="text-muted">B.S. in Computer Science from the University of Tennessee at Knoxville</p>
                        <hr>
                        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                        <p class="text-muted">Malibu, California</p>
                        <hr>
                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
                        <li><a href="#timeline" data-toggle="tab">My Roles</a></li>
                        <li><a href="#settings" data-toggle="tab">Update Profile</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <!-- Post -->
                            <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm"
                                         src="<?php echo base_url(); ?>assets/dist/img/user1-128x128.jpg"
                                         alt="user image">
                                    <span class="username">
                                        <a href="#"><?php echo ucwords($name); ?></a>
                                        <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                                    </span>
                                    <span class="description">Shared publicly - 7:30 PM today</span>
                                </div>
                                <p>
                                    Lorem ipsum represents a long-held tradition for designers,
                                    typographers and the like. Some people hate it and argue for
                                    its demise, but others ignore the hate as they create awesome
                                    tools to help create filler text for everyone from bacon lovers
                                    to Charlie Sheen fans.
                                </p>
                                <ul class="list-inline">
                                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i>
                                            Share</a></li>
                                    <li><a href="#" class="link-black text-sm"><i
                                                    class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                                    </li>
                                    <li class="pull-right">
                                        <a href="#" class="link-black text-sm"><i
                                                    class="fa fa-comments-o margin-r-5"></i> Comments
                                            (5)</a></li>
                                </ul>

                                <input class="form-control input-sm" type="text" placeholder="Type a comment">
                            </div>
                        </div>
                        <div class="tab-pane" id="timeline">
                            <table id="example2" class="table table-horizontal table-responsive">
                                <thead>
                                <th>Control Name</th>
                                <th>Role Name</th>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($myroles as $key) {
                                    ?>
                                    <tr>
                                        <td><?php echo ucwords($key->ControlName); ?></td>
                                        <td><?php echo ucwords($key->RoleName); ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="settings">
                            <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>user/updateuser">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                                               value="<?php echo ucwords($name); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="<?php echo $email; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" placeholder="Password"
                                               name="password" value="<?php echo $password; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirm" class="col-sm-2 control-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password_confirm"
                                               placeholder="Confirm Password" name="password_confirm"
                                               value="<?php echo $password; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Mail Address</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="address" placeholder="Address" name="address"
                                                  required><?php echo $address; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cell" class="col-sm-2 control-label">Cell #</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="cell" placeholder="Phone"
                                               name="cell" value="<?php echo $cell; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="dob" class="col-sm-2 control-label">Date of Birth</label>
                                    <div class="col-sm-2">
                                        <input type="text" id="dob" name="dob" class="form-control"
                                               value="<?php echo date_format(date_create($dob), 'm/d/Y'); ?>">
                                        <small>MM/DD/YYYY</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cnic" class="col-sm-2 control-label">CNIC</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="cnic" name="cnic" placeholder="CNIC" class="form-control"
                                               value="<?php echo $cnic; ?>">
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group">
                                        <label for="pin" class="col-sm-2 control-label">Pin</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="pin" name="pin" placeholder="Pin" class="form-control"
                                                   value="<?php echo $pin; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-3">
                                        <input type="submit" value="Save" class="btn btn-block bg-purple btn-flat"></input>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
