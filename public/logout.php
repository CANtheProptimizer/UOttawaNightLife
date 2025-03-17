<?php
require_once '../includes/session.php';
session_unset();
session_destroy();
header("Location: auth.php"); // or index.php
exit;
?>
