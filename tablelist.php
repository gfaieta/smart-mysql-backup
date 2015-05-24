#!/usr/bin/php -q
<?php

/**
 * Server connection info
 */
$dbHost = 'localhost';
$dbUser = 'backupuser';
$dbPwd  = 'backuppass';

/**
 * DBs to ignore
 */
$dbIgnore = array(
    'information_schema',
    'performance_schema',
    'tmp',
    'DBNAME',
);

/**
 * Tables to ignore
 */
$tblIgnore = array(
    'mysql.column_stats',
    'mysql.general_log',
    'mysql.gtid_slave_pos',
    'mysql.index_stats',
    'mysql.innodb_index_stats',
    'mysql.innodb_table_stats',
    'mysql.ndb_binlog_index',
    'mysql.slow_log',
    'mysql.table_stats',
    'DBNAME.TABLENAME'
);


$db = mysql_connect($dbHost, $dbUser, $dbPwd);
if ($db === FALSE) {
    die("Unable to connect to DB\n");
}

$res = mysql_query('SHOW DATABASES');
while ($row = mysql_fetch_row($res)) {

    // DB Skip
    $dbName = $row[0];
    if (in_array($dbName, $dbIgnore)) {
        continue;
    }

    // Select DB
    if (!mysql_select_db($dbName, $db)) {
        continue;
    }

    // Get tables
    $res2 = mysql_query("SHOW TABLES", $db);
    while ($row2 = mysql_fetch_row($res2)) {

        // Table Skip
        $tableName = trim($row2[0]);
        $fullTblName = $dbName . '.' . $tableName;
        if (in_array($fullTblName, $tblIgnore)) {
            continue;
        }

        printf("%s/%s\n", $dbName, $tableName);
    }
}

mysql_close($db);
