<?php
// test_connection.php

// Start the session
require_once '../includes/session.php';

// Include the config file that sets up the PDO connection
require_once '../includes/config.php';

// If the connection is established without errors, this message will be shown.
echo "If you see this message with no errors, the connection is successful!";
