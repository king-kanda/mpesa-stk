<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<title>
	    Admin Login .
	</title>
<body>
	<div class="container">
		<div class="w-25 ">
            <div class="d-flex align-items-center justify-content-center" > 
                <div>
                    <h2>Login </h2>
                    <?php
                        // Start session
                        session_start();
                        
                        // Check if user is already logged in
                        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                            header("location: records.php");
                            exit;
                        }
                        
                        // Include config file
                        require_once "config.php";
                        
                        // Define variables and initialize with empty values
                        $username = $password = "";
                        $username_err = $password_err = "";
                        
                        // Processing form data when form is submitted
                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                        
                            // Check if username is empty
                            if(empty(trim($_POST["username"]))){
                                $username_err = "Please enter username.";
                            } else{
                                $username = trim($_POST["username"]);
                            }
                            
                            // Check if password is empty
                            if(empty(trim($_POST["password"]))){
                                $password_err = "Please enter your password.";
                            } else{
                                $password = trim($_POST["password"]);
                            }
                            
                            // Validate credentials
                            if(empty($username_err) && empty($password_err)){
                                // Prepare a select statement
                                $sql = "SELECT id, username, password FROM users WHERE username = ?";
                                
                                if($stmt = $mysqli->prepare($sql)){
                                    // Bind variables to the prepared statement as parameters
                                    $stmt->bind_param("s", $param_username);
                                    
                                    // Set parameters
                                    $param_username = $username;
                                    
                                    // Attempt to execute the prepared statement
                                    if($stmt->execute()){
                                        // Store result
                                        $stmt->store_result();
                                        
                                        // Check if username exists, if yes then verify password
                                        if($stmt->num_rows == 1){                    
                                            // Bind result variables
                                            $stmt->bind_result($id, $username, $hashed_password);
                                            if($stmt->fetch()){
                                                if(password_verify($password, $hashed_password)){
                                                    // Password is correct, so start a new session
                                                    session_start();
                                                    
                                                    // Store data in session variables
                                                    $_SESSION["loggedin"] = true;
                                                    $_SESSION["id"] = $id;
                                                    $_SESSION["username"] = $username;                            
                                                    
                                                    // Redirect user to records page
                                                    header("location: records.php");
                                                } else{
                                                    // Display an error message if password is not valid
                                                    $password_err = "The password you entered was not valid.";
                                                }
                                            }
                                        } else{
                                            // Display an error message if username doesn't exist
                                            $username_err = "No account found with that username.";
                                        }
                                    } else{
                                        echo "Oops! Something went wrong. Please try again later.";
                                    }
                                }
                                
                                // Close statement
                                $stmt->close();
                            }
                            
                            // Close connection
                            $mysqli->close();
                        }
                        ?>
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
	</div>
</body>
</html>
