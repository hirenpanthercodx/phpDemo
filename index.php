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
    
    <div style="width: 60%; margin: auto;">
        <div class="mt-3">
            <h4>PHP CRUD Operations using Stored Procedure</h4>
            <hr>
        </div>
        <div class='d-flex justify-content-end'>
            <button type="button" class='btn btn-primary' onClick="window.location.href='AddRecord.php'">Add Record</button>
        </div>
        <div>
            <table class="table">
                <thead class='thead-light'>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>LastName</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Occuption</th>
                        <th>Hobby</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <!-- <form method="post" action=""> -->
                <tbody>
                    <?php
                        require 'db.php';
                        $sql = "SELECT * FROM employeeData";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo htmlentities($row['id']);?></td>
                            <td><?php echo htmlentities($row['firstname']);?></td>
                            <td><?php echo htmlentities($row['lastname']);?></td>
                            <td><?php echo htmlentities($row['email']);?></td>
                            <td><?php echo htmlentities($row['gender']);?></td>
                            <td><?php echo htmlentities($row['occuption']);?></td>
                            <td>
                                <?php
                                    $arr = json_decode($row['hobby']);
                                    echo implode(", ",$arr);
                                ?>
                            </td>
                            <td>
                                <div>
                                    <button class='btn btn-primary btn-sm' name="update" onClick="<?php echo header("Location: AddRecord.php?id=2"); ?>">Edit</button>
                                    <!-- <button class='btn btn-primary btn-sm' name="update" value="<?php echo $row['id']; ?>" onClick="updateData()">Edit</button> -->
                                    <button class='btn btn-danger btn-sm' name="id" value="<?php echo $row['id']; ?>" onClick="myFunction()">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr id='demo'></tr>
                    <?php
                            }
                        } else {
                            echo "0 results";
                        }
                    ?>
                </tbody>
                <!-- </form> -->
            </table>
        </div>
    </div>
    <script>
        function updateData() {
            <?php
                if (isset($_POST['update'])) {
                    $idddd = $_POST['update'];
                    echo $idddd;
                    // echo "<script>window.location.href=`AddRecord.php?id=$idddd`</script>";
                    return;
                }  
            ?>
        }
        function myFunction() {
            let text = "Press a button!\nEither OK or Cancel.";
            if (confirm(text) == true) {
                console.log('pressed!')

                text = "You pressed OK!";
                <?php
                    if (isset($_POST['id'])) {
                        $idddd = $_POST['id'];
                        $sql = "DELETE FROM employeeData WHERE id=$idddd";
                        mysqli_query($conn, $sql);
                        // if (mysqli_query($conn, $sql)) {
                        //     echo "Record deleted successfully";
                        //   } else {
                        //      "Error deleting record: " . mysqli_error($conn);
                        // }
                    }  
                ?>
            } else {
                text = "You canceled!";
                console.log('canceled!')
            }
        document.getElementById("demo").innerHTML = text;
        }
    </script>
</body>
</html>
