<?php
/**
 * test_connection.php
 * A quick test page to confirm the DB connection works.
 */

// Include session management (optional here, but good practice)
require_once '../includes/session.php';

// Include config to establish the $pdo connection
require_once '../includes/config.php';

// If no error is displayed, the connection is successful
echo "If you see this message with no errors above, the connection is successful!";
