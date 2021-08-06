<?php
// enter your database host, name, username, and password
$db_host = '';
$db_name = '';
$db_user = '';
$db_pass = '';

// connect with pdo - comment line 11 to mute errors

	$dbh = new SQLite3( SNIPP_BASE . 'db/snippets.db');
    // Set errormode to exceptions
   