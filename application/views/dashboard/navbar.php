<?php
if (!isset($this->session->userdata['login_user'])) {
    $this->session->set_flashdata('login_error', ' Please Login first');
    $redir = base_url() . 'home';
    redirect($redir, 'refresh');
} else {
    $username = $this->session->userdata['username'];
}
?>
<div class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="<?php echo base_url(); ?>home" class="logo">
                <span class="logo-mini"><b>A</b>LT</span>
                <span class="logo-lg"><b>NGO</b> Application</span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning count"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have <span class="count"></span> notifications</li>
                                <li>
                                    <ul class="drop-menu"></ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="hidden-xs"><i
                                            class="fa fa-user-o"></i> <?php echo ucwords($username); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <p>
                                        <?php echo $username; ?> - Web Developer
                                        <small>
                                            Member
                                            since <?php echo date_format(date_create($this->session->userdata('created_at')), "d/m/Y"); ?>
                                        </small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo base_url(); ?>dashboard/myprofile"
                                           class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url(); ?>authorization/logout"
                                           class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>