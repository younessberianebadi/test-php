<!DOCTYPE html>
<html>
<head>
        <title>Display</title>
<style type="text/css">
    table{
        width: 360px;
        background: #f1f1f1;
        height: 580px;
        padding: 80px 40px;
        border-radius: 10px;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }
    body{
        min-height: 100vh;
        background-image: linear-gradient(120deg, #3498db, #8e44ad);
        font-size: 18px;
        font-family: montserrat;
    }
    td{
        background-image: background-image: linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%);
    }
</style>
</head>

<?php 

$host = $_ENV["URL"]; 
$user = $_ENV["POSTGRES_USER"]; 
$pass = $_ENV["POSTGRES_PASSWORD"];  
$db = "digiwise"; 

$con = pg_connect("host=$host dbname=$db user=$user password=$pass")
    or die ("Could not connect to server\n"); 

$query = "SELECT * FROM people"; 

$rs = pg_query($con, $query) or die("Cannot execute query: $query\n");


$i = 0;
echo '<body><table><tr>';
while ($i < pg_num_fields($rs))
{
        $fieldName = pg_field_name($rs, $i);
        echo '<td>' . $fieldName . '</td>';
        $i = $i + 1;
}
echo '</tr>';
$i = 0;


while ($row = pg_fetch_row($rs)) 
{
        echo '<tr>';
        $count = count($row);
        $y = 0;
        while ($y < $count)
        {
                $c_row = current($row);
                echo '<td>' . $c_row . '</td>';
                next($row);
                $y = $y + 1;
        }
        echo '</tr>';
        $i = $i + 1;
}
pg_free_result($rs);

echo '</table></body>';
?>
</html>
