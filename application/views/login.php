<style>
    body {
        background-color: #eee;
    }

    input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
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

    .imgcontainer {
        text-align: center;
        margin: 16px 0 12px 0;
    }

    img.avatar {
        width: 30%;
        border-radius: 50%;
    }

    .container_f {
        padding: 12px;
    }

    span.psw {
        float: right;
        padding-top: 16px;
    }
</style>
<body>

<div class="container" style="max-width:575px; margin:10px auto;">
    <div class="well">
        <?php
        if ($this->session->flashdata('signup_fail')) {
            echo '<div class="alert alert-danger message">'. $this->session->flashdata('signup_fail') .'</div>';
        }
        ?>
        <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>authorization/checkuser">
            <div class="imgcontainer">
                <img src="<?php echo base_url(); ?>/assets/dist/img/img_avatar2.png" alt="Avatar" class="avatar">
            </div>

            <div class="container_f">
                <label><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>

                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <button type="submit">Login</button>
                <input type="checkbox" checked="checked"> Remember me
            </div>
        </form>
    </div>
</div>
