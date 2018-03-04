<?php
if (isset($this->session->userdata['login_user'])) {
    $username = $this->session->userdata['username'];

    // if user is logged in, show the logout option and hide the login modal
    $log_option = '<span class="glyphicon glyphicon-log-out"></span>';
    $log_option .= ' Logout';
    $log_href = base_url() . 'authorization/logout';

    // if user is logged in, don't show the sign up option but user's name
    $signup = '<span class="user-avatar pull-left" style="margin-right:6px; margin-top:-5px;">';
    $signup .= '<img src="' . base_url() . '/assets/dist/img/profile.png" 
                class="img-responsive img-circle" width="25px" height="25px" /></span>' . $username;
    $signup_href = base_url() . 'dashboard/userdashboard';

}
else {
    // if user is not logged in, show the login option and login modal
    $log_option = '<span class="glyphicon glyphicon-log-in"></span>';
    $log_option .= ' Login';
    $log_href = base_url().'user/login';

    // if user is not logged in, show the sign up option
    $signup = '<span class="glyphicon glyphicon-user"></span>Sign Up';
    $signup_href = base_url().'user/signup';
}
?>

<nav class="navbar navbar-default navbar-custom"> <!--navbar-fixed-top"> -->
    <div class="container-fluid">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>home">NGO Application</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#" data-toggle="modal" data-target="">About</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?php echo $signup_href; ?>">
                        <?php echo $signup; ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $log_href; ?>" style="width:auto;">
                        <?php echo $log_option; ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>