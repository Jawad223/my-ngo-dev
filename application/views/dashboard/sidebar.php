<?php
if (isset($this->session->userdata['login_user'])) {
    $username = $this->session->userdata['username'];
}
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <p style="color:white;"><?php echo $username; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="<?php echo base_url(); ?>dashboard/userdashboard">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>dashboard/myprofile">
                    <i class="fa fa-user"></i> <span>My Profile</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>Settings</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <?php if (isset($this->session->userdata['role']) && $this->session->userdata('role') == 'admin') { ?>
                        <li><a href="<?php echo base_url(); ?>approval/manageapproval">
                                <i class="fa fa-check-square-o"></i> Approvals
                            </a>
                        </li>
                    <?php } ?>
                    <li><a href="<?php echo base_url(); ?>donation/donatev"><i class="fa fa-money"></i> Donations</a>
                    </li>
                    <li><a href="<?php echo base_url(); ?>reception/receivev"><i class="fa fa-arrow-circle-up"></i>
                            Receptions
                        </a></li>
                </ul>
            </li>
            <?php
            if (isset($this->session->userdata['role']) && $this->session->userdata('role') == 'admin') {
                ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-cogs"></i><span>Control Panel</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo base_url(); ?>category/listcategoryv">
                                <i class="fa fa-th"></i> <span>Category</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>role/listrolev">
                                <i class="fa fa-unlock"></i> <span>Roles</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>control/listcontrolv">
                                <i class="fa fa-lock"></i> <span>Controls</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>rolecontrol/listrolecontrolv">
                                <i class="fa fa-unlock-alt"></i> <span>Roles Controls</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>dashboard/userroles">
                        <i class="fa fa-users"></i> <span>Users</span>
                    </a>
                </li>
            <?php } ?>
            <li>
                <a href="<?php echo base_url(); ?>invoice/createinvoice">
                    <i class="fa fa-credit-card"></i> <span>Invoice</span>
                </a>
            </li>
            <li class="">
                <a href="<?php echo base_url(); ?>reference/listuserreferencev">
                    <i class="fa fa-user-plus"></i> <span>User References</span>
                </a>
            </li>
            <?php
            if (isset($this->session->userdata['role']) && $this->session->userdata('role') == 'admin') {
                ?>
                <li class="">
                    <a href="<?php echo base_url(); ?>measurement/listunitv">
                        <i class="fa fa-cubes"></i> <span>Measurement Units</span>
                    </a>
                </li>
            <?php } ?>
            <li>
                <a href="<?php echo base_url();?>dashboard/mycalendar">
                    <i class="fa fa-calendar"></i>
                    <span>My Calendar</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>