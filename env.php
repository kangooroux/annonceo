<?php
# Copy this file at the same place (root of the project) and rename it into env.php
# This is your configuration parameters for your local environnement : mainly bd.
# this file is required in index.php and feed Services. 

# Database credentials for PDO
$db = [
    'db_dsn' => 'mysql:host=localhost;dbname=annonceo',
    'db_user' => 'root',
    'db_pass' => '',
    ];

# Other ?
# $blabla = 'foo';