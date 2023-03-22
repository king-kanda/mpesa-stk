<?php

// check if is logged in 

// start session 
$servername = "localhost";
$username = "root";
$password = "@Gtazw2b";
$database = "mpesa";

$conn = new mysqli($servername, $username, $password, $database);

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<title>
	    Transaction Records .
	</title>

    <style>

    </style>

    <body>
        <!-- nav -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container p-3">
                <a class="navbar-brand fw-bold" href="#">
                    Shop Yetu
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Sign Up</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link disabled">Mark Assigment</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-dark" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- records section -->
        <section class="container">
            <div >
                <h1 class="text-start p-4 ">Transaction Records</h1>
            </div>
            <div class="records-table py-4 ">
                <table class="table table-striped ">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Phone No.</th>
                        <th scope="col">Ref Code. </th>
                        <th scope="col">Date </th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php

                    $sql = "SELECT * FROM transactions";
                    $result = mysqli_query($conn, $sql);
                        
                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            while($row = $result->fetch_array()){

                                echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['amount'] . "</td>";
                                    echo "<td>" . $row['phoneNumber'] . "</td>";
                                    echo "<td>" . $row['mpesaReceiptNumber'] . "</td>";
                                    echo "<td>" . $row['transactionDate'] . "</td>";
                                echo "</tr>";
                            }

                        } else {
                            echo "0 results";
                        }

                        // Close connection
                        mysqli_close($conn);

                    ?>
                        
                    </tbody>
                </table>
            </div>
        </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
		crossorigin="anonymous">
    </script>
	
    </body>


</head>

