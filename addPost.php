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
        $filename = $notes = '';

        $user_id = intval($_GET['id']);
        $post_id = intval($_GET['post_id']);

        if(isset($_POST['create'])) {
            $notes = $_POST["notes"];
            $filename = $_FILES["uploadfile"]["name"];
            $tempname = $_FILES["uploadfile"]["tmp_name"];
            $folder = "./image/" . $filename;
            
            if ($post_id) {
                $sql = "UPDATE user_post SET filename='$filename', notes='$notes' WHERE id=$post_id";
                mysqli_query($conn, $sql);
            } else {
                $sql = "INSERT INTO user_post (filename, notes, user) VALUES ('$filename', '$notes', '$user_id')";
                mysqli_query($conn, $sql);
            }
            
            if (move_uploaded_file($tempname, $folder)) {
                echo "<h3>  Image uploaded successfully!</h3>";
                header("Location: employeeData.php?id=".$user_id);
            } else {
                echo "<h3>  Failed to upload image!</h3>";
            }
        } else if ($post_id) {
            $sql = "SELECT * FROM user_post WHERE id='$post_id'";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);

            $filename = "./image/" . $data["filename"] ;
            $notes = $data["notes"];
        }

        if( isset( $_POST['delete'] ) ) {
            $sql = "DELETE FROM user_post WHERE id=$post_id";
            
            if (mysqli_query($conn, $sql)) {
                echo '<script>alert("Record deleted successfully !")</script>';
                header("Location: employeeData.php?id=".$user_id);
            } else {
              echo "Error deleting record: " . mysqli_error($conn);
            }
        }

        mysqli_close($conn);
    ?>
    <div class="card">
        <div class='d-flex my-3'>
            <div>
                <a class='btn btn-secondary' role="button" href="<?php echo "employeeData.php?id=".$_GET['id']; ?>">Back</a>
            </div>
            <div class='ml-3 d-flex align-items-center'>
                <h4 class='d-flex align-items-center mb-0'><?php echo $post_id ? 'Update Post' : 'Create Post'; ?></h4>
            </div>
        </div>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="inputGroupFile04">Upload Image</label>
                <input type="file" class="form-control" name="uploadfile" id="inputGroupFile04" accept=".jpg, .png, .jpeg">
                <img src="<?php echo $filename; ?>" style="<?php if (!$post_id) echo 'display:none'; ?>" />
                <p><?php echo $filename; ?></p>
            </div>
            <div class="form-group">
                <label for="notes">Description</label>
                <textarea id="w3review" class="form-control" name="notes" rows="4" cols="50" ><?php echo $notes ? $notes : ''; ?></textarea> 
            </div>
            <div class="row d-flex justify-content-end mr-2">
                <input type="submit" role="button" name="delete" class="btn btn-danger mr-3" value="Delete"
                    style="<?php    
                        require 'db.php';
                        $user_id = $_GET['id'];
        
                        $sql = "SELECT * FROM user WHERE user_id=$user_id";
                        $result = mysqli_query($conn, $sql);
                        $data = mysqli_fetch_assoc($result);
                        if (!in_array('delete', json_decode($data['permission'])) || !$post_id) {
                            echo 'display:none';
                        }
                    ?>"
                />
                <!-- <?php 
                    if ($post_id) {
                        echo '<input type="submit" role="button" name="delete" class="btn btn-danger mr-3" value="Delete" />';
                    }
                ?> -->
                <input type="submit" role="button" name="create" class="btn btn-success" value="Create" />
            </div>
        </form>
    </div>
</body>
</html>