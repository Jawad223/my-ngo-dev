<!DOCTYPE html>
<html>
<head>
    <?php
    foreach ($title as $key) {
        $title = $key;
    }
    ?>
    <title><?php echo $title; ?></title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/cleanblog/clean-blog.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css">

    <link rel="icon" href="<?php echo base_url(); ?>assets/dist/img/favicon.ico">
</head>

<body>