<?php 
	include 'conn.php';
$query="select * from customers";
$result=mysqli_query($conn,$query);



//this query is for the pagination
$query="select * from customers";
$result1=mysqli_query($conn,$query);
 ?>
<!DOCTYPE html>
<html lang="en">
<html>
<head>


        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"/>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>


    <!-- My own css CSS -->
    <link rel="stylesheet" href="styles.css">
	<title>Umair's Pagination System</title>


</head>
<body>


<div class="container-fluid">
<div class="row">

    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 text-center justify-content-center">

        <h1 class="">Umair's Pagination System</h1>
    </div>
</div>




    <div class="row">
        <div class="col-sm-12">


            <div style="height: 600px; overflow-y: auto;">
                <table id="" class="table table-hover table-striped table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                   <?php while($customer=mysqli_fetch_assoc($result)){  ?>
                        <tr>
                            <td><?= $customer['id']; ?></td>
                            <td><?= $customer['name']; ?></td>
                            <td><?= $customer['mobile']; ?></td>
                            <td><?= $customer['address']; ?></td>
                            <td><?= $customer['createdOn']; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>


</div>


<script type="text/javascript">
$(document).ready(function () {
    $('table').DataTable();
});
</script>


</body>
</html>
