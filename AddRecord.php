
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
</head>
<body>

<?php
    require 'db.php';

var_dump($_POST);

    $firstName = $lastName = $email = $gender = $occuption = $hobby = '';
    $firstNameErr = $lastNameErr = $emailErr = $genderErr = $occuptionErr = $hobbyErr = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo 'dgjffggdsg';
        if (empty($_POST(["firstName"]))) {
            $firstNameErr = 'First name is empty';
        } else {
            $firstName = empty($_POST(["firstName"]));
        }
    
        if (empty($_POST(["lastName"]))) {
            $lastNameErr = 'Last name is empty';
        } else {
            $lastName = empty($_POST(["lastName"]));
        }
    
        if (empty($_POST(["email"]))) {
            $emailErr = 'email is empty';
        } else {
            $email = empty($_POST(["email"]));
        }
    
        if (empty($_POST(["gender"]))) {
            $genderErr = 'email is empty';
        } else {
            $gender = empty($_POST(["gender"]));
        }
    
        if (empty($_POST(["occuption"]))) {
            $occuptionErr = 'email is empty';
        } else {
            $occuption = empty($_POST(["email"]));
        }
    
        if (empty($_POST(["hobby"]))) {
            $hobbyErr = 'email is empty';
        } else {
            $hobby = empty($_POST(["email"]));
        }
    }    
?>

    <div style="width: 60%; margin: auto;">
        <div class="mt-3">
            <h4>Insert Record | PHP CRUD Operations using Stored Procedure</h4>
            <hr>
        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div>
                <div class="d-flex">
                    <div class="col-6 form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="name" class="form-control" placeholder="Enter First name" />
                    </div>
                    <div class="col-6 form-group">
                        <label for="lasttName">Last Name</label>
                        <input type="text" id="lasttName" class="form-control" name="lasttName" placeholder="Enter Last name" />
                    </div>
                </div>
                <div  class="d-flex">
                    <div class="col-6 form-group">
                        <label for="lasttName">Email</label>
                        <input type="email" id="email" class="form-control" name="email" placeholder="Enter Email" />
                    </div>
                    <div class="col-6 form-group">
                        <label for="lasttName">Gender</label>
                        <div class="d-flex">
                            <div class="mr-3 form-check">
                                <input type="radio" id="male" class="form-check-input" name="gender" value="male" />
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="female" class="form-check-input" name="gender" value="female" />
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col-6 form-group">
                        <label for="occuption">Occuption</label>
                        <select class="custom-select" id="occuption" name="occuption">
                            <option value="1">Job</option>
                            <option value="2">Business</option>
                            <option value="3">Other</option>
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="occuption">Hobby</label>
                        <div class="d-flex">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="reading" name="hobby" id="hobby">
                                <label class="form-check-label" for="reading">Reading</label>
                            </div>
                            <div class="form-check mx-3">
                                <input class="form-check-input" type="checkbox" value="music" name="hobby" id="hobby">
                                <label class="form-check-label" for="music">Music</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="movie" name="hobby" id="hobby">
                                <label class="form-check-label" for="movie">Movie</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mr-4">
                <button class="btn btn-primary" type="submit" value="Submit">Submit</button>
            </div>
        </form>
    </div>
<?php
echo "<h2>Your Input:</h2>";
echo $firstName;
echo "<br>";
echo $lastName;
echo "<br>";
echo $email;
echo "<br>";
echo $gender;
echo "<br>";
echo $occuption;
echo "<br>";
echo $hobby;
?>
</body>
</html>
