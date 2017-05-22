<?php
include('SQLFunctions.php');

    echo '<br>Display full contents of the _POST: <br>';
    var_dump($_POST);
    
    $link = f_sqlConnect();
    
    if(isset($_POST['formID'])){ $table = $_POST['formID']; }
    echo '<br> Destination table: ' . $table;
    
    $keys = implode(', ', (array_keys($_POST)));
    echo '<br> Parsed Key: '.$keys;
    $values = implode("', '", (array_values($_POST)));
    echo '<br> Parsed Values: '.$values;
    
    $x_fields = "entry_timestamp, source_ip";
    $x_values = date('Y-m-d H:I:s') . "', '" . f_getIP();
    echo '<br> x_values: '.$x_values;
    
    if (!f_tableExists($link, $table, DB_NAME)) {
        die('<br>Destination table does not exist: '.$table);
    }
    
    if(isset($_POST['rejectredirecturl'])){
        $rejectredirecturl = $_POST['rejectredirecturl'];
        echo '<br>rejectredirecturl: '.$rejectredirecturl;
    }
    
    if(isset($_POST['successredirecturl'])){
        $successredirecturl = $_POST['successredirecturl'];
        echo '<br>successredirecturl: '.$successredirecturl;
    }
    
    $sql = "INSERT INTO $table ($keys, $x_fields) VALUES ('$values', '$x_values')";
    echo '<br>sql: '.$sql;
    
    if (!mysqli_query($link, $sql)) {
        echo '<br>Error: '.mysqli_error($link);
        if (!empty ($rejectredirecturl)) {
            /* header("Location: $rejectredirecturl?msg=1"); */ /* comment out for testing */
        }
        
    } elseif (!empty($rejectredirecturl)) {
        /* header("Location: $successredirecturl?msg=1"); */ /* comment out for testing */
    }
    
    mysqli_close($link);
?>