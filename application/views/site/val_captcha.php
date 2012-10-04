<?php
/**
 * Validate captcha during form submission: ajax
 *
 */
session_start();

$t = $_GET['_t'];
$v = $_GET['captcha'];
if(!isset($_SESSION[$t.'_captcha']) || $_SESSION[$t.'_captcha'] !== $v) echo 'false';
else echo 'true';