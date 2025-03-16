<?php
require_once '../includes/session.php';

session_unset(); // Unset session variables
session_destroy(); // Destroy the session

header("Location: index.php");
exit;
?>