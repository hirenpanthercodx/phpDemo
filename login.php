<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <link rel="stylesheet" href="style.css"> 
</head>
<body class="bodyMain">
     <?php 
        require 'db.php';
        if (isset($_POST['login'])) {

            function validate($data){
                $data = trim($data);
                $data = stripslashes($data);        
                $data = htmlspecialchars($data);
                return $data;
            }
            $email = validate($_POST["email"]);
            $password = validate($_POST["user_password"]);

            $sql = "SELECT * FROM user WHERE email='$email' AND user_password='$password'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                if ($row['email'] === $email && $row['user_password'] === $password) {
                    echo "<script type='text/javascript'>toastr.success('Login successfully')</script>";
                    if ($row['user_role'] === 'admin') header("Location: index.php");
                    if ($row['user_role'] === 'employee') header("Location: employeeData.html");
                } else {
                    echo "<script type='text/javascript'>toastr.error('Invalid email or password, please try again')</script>";
                }
            } else echo "<script type='text/javascript'>toastr.error('Invalid email or password, please try again')</script>";
        }
    ?>

    <div class="main"> 
        <form method="post">
            <h3>Welcome to ELEOS</h3> 
            <h6>Please log-in to your account</h6> 
            <div class="mt-3">
                <label for="email">Email </label> 
                <input type="text" 
                    class="form-control"
                    name="email" 
                    placeholder="Enter your email" required
                > 
            </div>
            <div class="my-3">
                <label for="password">Password:</label> 
                <input type="password"
                    class="form-control"
                    name="user_password" 
                    placeholder="Enter your Password" required
                > 
            </div>
            <div class="mb-2"> 
                <input type="submit" role="button" name="login" class="btn btn-success w-100" value="Login" />
            </div> 
            <p>Not registered?  
                <a href="register.php" style="text-decoration: none;">Create an account</a> 
        </p> 
        </form>
    </div>  
</body>
</html>