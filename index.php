<?php
session_start();
	include 'conn.php';
$query="select * from customers";
$result=mysqli_query($conn,$query);

//pagination

$total="select * from customers";
$count=mysqli_query($conn,$total);
$nr=mysqli_num_rows($count);

//if we get data from the post then save it in a session variable
if(isset($_POST['limit-records'])) {
    $_SESSION['item_per_page'] = $_POST['limit-records'];
}

//if the session variable is empty then assign item_per_page a value of 500 else assgin it the session variable
if(empty($_SESSION['item_per_page'])){
    $_SESSION['item_per_page']=500;
}
else{
    $item_per_page=$_SESSION['item_per_page'];
}

$item_per_page=$_SESSION['item_per_page'];

$totalpages=ceil($nr/$item_per_page);

if(isset($_GET['page'])&& !empty($_GET['page'])){
$page=$_GET['page'];
}
else{
    $page=1;
}

$offset=($page-1)*$item_per_page;
$q="select * from customers limit $item_per_page OFFSET $offset";
$result1=mysqli_query($conn,$q);
$row_count=mysqli_num_rows($result1);



//this is for the number of records per page...




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
<body id="mytable">


<div class="container-fluid">
<div class="row">

    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 text-center justify-content-center">

        <h1 class="">Umair's Pagination System</h1>
    </div>
</div>


    <div class="row acc-to-the-search">

        <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12">


                <form method="post" action="#">
                    <select name="limit-records" id="limit-records">
                        <option disabled="disabled" selected="selected">
                          <?php
                                echo "--LIMIT-RECORD--";

                            ?>

                        </option>
                        <?php foreach([10,100,500,1000,5000] as $limit): ?>
                            <option <?php if( isset($_POST["limit-records"]) && $_POST["limit-records"] == $limit) echo "selected" ?> value="<?= $limit; ?>"><?= $limit; ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
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
                   <?php while($customer=mysqli_fetch_assoc($result1)){  ?>
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
    </div> <!--- row of table ends here !-->

    <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12">
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-sm justify-content-end">
                    <li class="page-item">
                        <a class="page-link" href="index.php?page=<?php echo $page-1; ?>">Previous</a>
                    </li>

                    <?php
                    for($i=1;$i<=$totalpages;$i++){//actual link

                        if($i==$page){
                            echo "<li class='page-item'><a  class='page-link active' href='index.php?page=$i' >$i</a></li>";
                        }
                        else{
                            if($i>10){
                                $lastpage=$totalpages-1;
                                echo "<li  class='page-item'><a href='index.php?page=$lastpage' class='page-link' >..</a></li>";
                            break;
                            }else{
                            echo "<li  class='page-item'><a href='index.php?page=$i' class='page-link' >$i</a></li>";
                            }
                        }

                    } ?>


                    <li class="page-item">
                        <a class="page-link" href="index.php?page=<?php echo $page+1; ?>">Next</a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>

</div>






<script>
    function loadDoc() {
        var i=0;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("mytable").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "index.php?page=7", true);
        xhttp.send();
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('table').dataTable({
            searching: true,
            paging: false,
            info: false,
            bPaginate: false,
            bLengthChange: false,
        });
    })
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $("#limit-records").change(function(){
            $('form').submit();
        })
    })
</script>




</body>
</html>
