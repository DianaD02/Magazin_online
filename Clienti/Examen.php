<?php
        include("Conectare.php");
            if ($result = $mysqli->query("SELECT AVG (price), name FROM tbl_product WHERE name LIKE '%C'  ORDER BY id")) { 
                if ($result->num_rows > 0) {     
                   while ($row = $result->fetch_object()) {    
                        echo "<td>" . $row->name  . "</td>";    
                    }
                    echo "</table>";
                }
                else {
                    echo "Nu sunt inregistrari in tabela!";
                }
            }
            else {
                echo "Error: " . $mysqli->error;
            }
            $mysqli->close();
?>