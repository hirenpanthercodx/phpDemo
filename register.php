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
        if (isset($_POST['register'])) {

            function validate($data){
                $data = trim($data);
                $data = stripslashes($data);        
                $data = htmlspecialchars($data);
                return $data;
            }
            $email = validate($_POST["email"]);
            $password = validate($_POST["user_password"]);
            $role = validate($_POST["user_role"]);

            $sql = "SELECT * FROM user WHERE email='$email'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo "<script type='text/javascript'>toastr.error('email already registered')</script>";
            } else {     
                $sql = "INSERT INTO user (email, user_password, user_role)
                VALUES ('$email', '$password', '$role')";
    
                if (mysqli_query($conn, $sql)) {
                    echo '<script>alert("New Record Register Successfully !")</script>';
                    if ($role === 'admin') header("Location: index.php");
                    if ($role === 'employee') header("Location: employeeData.html");
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }

        }
    ?>

    <div class="main"> 
        <form method="post">
            <h3>Welcome to ELEOS</h3> 
            <h6>Please sign-up to your account</h6> 
            <div class="my-3">
                <label for="email">Email </label> 
                <input type="text" 
                    class="form-control"
                    name="email" 
                    placeholder="Enter your email" required
                > 
            </div>
            <div>
                <label for="password">Password</label> 
                <input type="password"
                    class="form-control"
                    name="user_password" 
                    placeholder="Enter your Password" required
                > 
            </div>
            <div class='my-3'>
                <label for="role">Role</label>
                <select class="custom-select" name="user_role" required>
                    <option value="">Select</option>
                    <option value="admin">Admin</option>
                    <option value="employee">Employee</option>
                </select>
            </div>
            <div class="mb-2"> 
                <input type="submit" role="button" name="register" class="btn btn-success w-100" value="Register" />
            </div> 
        </form>
    </div> 
</body>
</html>