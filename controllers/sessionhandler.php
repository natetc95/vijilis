<?php
  session_start();
  if(!isset($_SESSION['name'])) {
    header('Location: ./index.php');
    die();
  } else {
    $acct = $_SESSION['acct'];
  }
  ?>
