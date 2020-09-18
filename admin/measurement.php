<?php 
ob_start();
session_start();
include '../_init.php';

// Redirect, If user is not logged in
if (!is_loggedin()) {
  redirect(root_url() . '/index.php?redirect_to=' . url());
}

// Redirect, If User has not Read Permission
if (user_group_id() != 1 && !has_permission('access', 'read_product')) {
	redirect(root_url() . '/'.ADMINDIRNAME.'/dashboard.php');
}

// Set Document Title
$document->setTitle(trans('title_mesurement'));

// Add Script
$document->addScript('../assets/tinymce/tinymce.min.js');
$document->addScript('../assets/GITLanka/angular/controllers/measurementcontroller.js');

// Include Header and Footer
include("header.php"); 
include ("left_sidebar.php"); 
?>
<div>
	
</div>