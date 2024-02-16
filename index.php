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
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php 
        require 'db.php'; 
        if( isset( $_POST['insert'] ) ) {
            $did = $_POST['id'];
            $sql = "DELETE FROM employeeData WHERE id=$did";
            
            if (mysqli_query($conn, $sql)) {
              echo '<script>alert("Record deleted successfully !")</script>';
              echo '<script>window.location.reload();)</script>';
            } else {
              echo "Error deleting record: " . mysqli_error($conn);
            }
        }
    ?>
    
    <div class='card'>
        <div class='d-flex justify-content-between my-3'>
            <h4 class='d-flex align-items-center mb-0'>PHP CRUD Operations</h4>
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
                                <div class='d-flex'>
                                    <div class='mr-2'>
                                        <a class='btn btn-primary btn-sm' role="button" name="update" href="<?php echo "AddRecord.php?id=".$row['id'] ?>">Edit</a>  
                                    </div>
                                    <div>
                                        <form method='POST'>
                                            <input type=hidden name=id value="<?php echo $row['id'] ?>" >
                                            <input type="submit" class='btn btn-danger btn-sm' role="button" name="insert" value="Delete" />
                                        </form>                               
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td>No Record found</td></tr>";
                        }
                        ?>
                </tbody>
            </table>
        </div>  
    </div> 
</body>
</html>
