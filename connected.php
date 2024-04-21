<?php
	header("Access-Control-Allow-Origin: *");
    error_reporting(0);
    error_reporting(E_ERROR | E_PARSE);
    header("content-type:text/javascript;charset=utf-8");
    // $link = mysqli_connect('https://www.androidthai.in.th/phpMyAdmin', 'androidh_edumall', 'Abc12345', "androidh_edumall");
    $link = mysqli_connect('localhost', 'root', '', "androidh_edumall");