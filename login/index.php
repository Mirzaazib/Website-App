<?php
session_start();
if ( isset($_SESSION['level_user']) && $_SESSION['level_user'] != '' ) {
  header('location:main');
  exit();
} else {
  header('location:login.php');
  exit();
}