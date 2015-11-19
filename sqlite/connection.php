<?php
    $database = sqlite_open('database.sql', 0666);

    if ($database) {
        $result = sqlite_query($dbconn,  "SELECT * FROM combo_calcs WHERE options='easy'");
        var_dump(sqlite_fetch_array($result, SQLITE_ASSOC));
    } else {
        print "Connection to database failed!\n";
    }

?>