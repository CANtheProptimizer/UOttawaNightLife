<?php
/**
 * session.php
 * Ensures that a PHP session is started.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
