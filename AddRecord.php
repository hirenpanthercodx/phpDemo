
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
    $id = intval($_GET['id']);

    $firstName = $lastName = $email = $gender = $occuption = $hobby = '';
    $editHobby = [];
    $firstNameErr = $lastNameErr = $emailErr = $genderErr = $occuptionErr = $hobbyErr = ''; 
  
    if (isset($_POST['insert'])) {
        if ($_POST["firstName"] == NULL) $firstNameErr = 'First name is empty';
        else $firstName = $_POST["firstName"];
    
        if (empty($_POST["lastName"])) $lastNameErr = 'Last name is empty';
        else $lastName = $_POST["lastName"];
    
        if (empty($_POST["email"])) $emailErr = 'email is empty';
        else $email = $_POST["email"];
    
        if (empty($_POST["gender"])) $genderErr = 'gender is empty';
        else $gender = $_POST["gender"];
    
        if (empty($_POST["occuption"])) $occuptionErr = 'occuption is empty';
        else $occuption = $_POST["occuption"];

        if ($_POST["hobby"] == NULL) $hobbyErr = 'hobby is empty';
        else $hobby = json_encode($_POST["hobby"]);

        if (!($firstNameErr || $lastNameErr || $emailErr || $genderErr || $occuptionErr || $hobbyErr)) {
            if ($id) {
                $sql = "UPDATE employeeData SET firstname='$firstName', lastname='$lastName', email='$email', gender='$gender',
                        occuption='$occuption', hobby='$hobby' WHERE id=$id";
            } else {
                $sql = "INSERT INTO employeeData (firstname, lastname, email, gender, occuption, hobby)
                VALUES ('$firstName', '$lastName', '$email', '$gender', '$occuption', '$hobby')";
            }
            
            if (mysqli_query($conn, $sql)) {
              echo "New record created successfully";
              echo "<script>window.location.href='index.php'</script";
            } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    } else {
        echo $id;
        $sql = "SELECT * FROM employeeData WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $firstName = $row["firstname"];
                $lastName = $row["lastname"];
                $email = $row["email"];
                $gender = $row["gender"];
                $occuption = $row["occuption"];
                $editHobby = json_decode($row["hobby"]);
            }
        } else {
            echo "no rocord found";
        }
    }
    mysqli_close($conn);
?>

    <div style="width: 60%; margin: auto;">
        <div class="my-3 d-flex">
            <button class='btn btn-outline-secondary mr-4' onClick="window.location.href='index.php'">Back</button>
            <h4>Insert Record | PHP CRUD Operations</h4>
        </div>
        <hr>
        <form method="post">
            <div>
                <div class="d-flex">
                    <div class="col-6 form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" class="form-control" placeholder="Enter First name" value="<?php echo $firstName;?>"/>
                        <span class="text-danger"><?php echo $firstNameErr;?></span>
                    </div>
                    <div class="col-6 form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" class="form-control" name="lastName" placeholder="Enter Last name" value="<?php echo $lastName;?>"/>
                        <span class="text-danger"><?php echo $lastNameErr;?></span>
                    </div>
                </div>
                <div  class="d-flex">
                    <div class="col-6 form-group">
                        <label for="lasttName">Email</label>
                        <input type="text" id="email" class="form-control" name="email" placeholder="Enter Email" value="<?php echo $email;?>"/>
                        <span class="text-danger"><?php echo $emailErr;?></span>
                    </div>
                    <div class="col-6 form-group">
                        <label for="lasttName">Gender</label>
                        <div class="d-flex">
                            <div class="mr-3 form-check">
                                <input type="radio" id="male" class="form-check-input" name="gender" value="male" <?php if (isset($gender) && $gender=="male") echo "checked";?>/>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="female" class="form-check-input" name="gender" value="female" <?php if (isset($gender) && $gender=="female") echo "checked";?>/>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>
                        <span class="text-danger"><?php echo $genderErr;?></span>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col-6 form-group">
                        <label for="occuption">Occuption</label>
                        <select class="custom-select" id="occuption" name="occuption">
                            <option value="" <?= $occuption == '' ? ' selected="selected"' : ''; ?>>Select</option>
                            <option value="job" <?= $occuption == 'job' ? ' selected="selected"' : ''; ?>>Job</option>
                            <option value="business" <?= $occuption == 'business' ? ' selected="selected"' : ''; ?>>Business</option>
                            <option value="other" <?= $occuption == 'other' ? ' selected="selected"' : ''; ?>>Other</option>
                        </select>
                        <span class="text-danger"><?php echo $occuptionErr;?></span>
                    </div>
                    <div class="col-6 form-group">
                        <label for="occuption">Hobby</label>
                        <div class="d-flex">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="reading" name="hobby[]" id="hobby" <?php if (in_array("reading", $editHobby)) echo "checked";?>>
                                <label class="form-check-label" for="reading">Reading</label>
                            </div>
                            <div class="form-check mx-3">
                                <input class="form-check-input" type="checkbox" value="music" name="hobby[]" id="hobby" <?php if (in_array("music", $editHobby)) echo "checked";?>>
                                <label class="form-check-label" for="music">Music</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="movie" name="hobby[]" id="hobby" <?php if (in_array("movie", $editHobby)) echo "checked";?>>
                                <label class="form-check-label" for="movie">Movie</label>
                            </div>
                        </div>
                        <span class="text-danger"><?php echo $hobbyErr;?></span>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mr-4">
                <input type="submit" name="insert" value="Submit" />
            </div>
        </form>
    </div>
</body>
</html>
