<?php
include "conn.php";
$query="INSERT INTO Customers (name, mobile, address, CreatedBy, createdOn)
VALUES ('Cardinal', '23432432', '23423', 'umair', '4006')";

for($i=0;$i<=2000;$i++){
    mysqli_query($conn, $query);

}

?>
<!doctype html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


<div class="container well">



    <br>



</body>
</html>