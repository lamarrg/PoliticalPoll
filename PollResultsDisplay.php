<?php
include('SQLFunctions.php');
    
    $link = f_sqlConnect();
    
    $table = political_poll;
        echo '<br> Source Table: '.$table;
    if(!f_tableExists($link, $table, DB_NAME)) {
        die('<br>Destination table does not exist: '.$table);
    }
    
    $sql = "SELECT * from $table";
    echo '<br>sql: '.$sql;
    
    if ($result = mysqli_query($link, $sql)) {
        echo "<table border=''1'' style=''width:100%''>";
        echo "<tr>";
          echo "<td>pollID</td>";
          echo "<td>formID</td>";
          echo "<td>gender</td>";
          echo "<td>age</td>";
          echo "<td>vote_freq</td>";
          echo "<td>political_party</td>";
          echo "<td>vote_for</td>";
          echo "<td>Source IP</td>";
          echo "<td>SuccessUrl</td>";
          echo "<td>RejectUrl</td>";          
        echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
          echo "<td>{$row[0]}</td>";
          echo "<td>{$row[1]}</td>";
          echo "<td>{$row[2]}</td>";
          echo "<td>{$row[3]}</td>";
          echo "<td>{$row[4]}</td>";
          echo "<td>{$row[5]}</td>";
          echo "<td>{$row[6]}</td>";
          echo "<td>{$row[7]}</td>";
          echo "<td>{$row[8]}</td>"; 
          echo "<td>{$row[9]}</td>"; 
        echo "</tr>";
        }
        echo "</table>";
    }
    
    mysqli_free_result($result);
    
    if (mysqli_error($link)) {
        echo'<br>Error: '.mysqli_error($link);
    } else echo '<br>Success';
    
    mysqli_close($link);

?>