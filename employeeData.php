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
    <div class="card">
        <div class='d-flex justify-content-between my-3'>
            <h4 class='d-flex align-items-center mb-0'>Employee Post</h4>
            <a class='btn btn-primary' role="button" href="<?php echo "addPost.php?id=".intval($_GET['id']); ?>" 
                style="<?php    
                    require 'db.php';
                    $user_id = $_GET['id'];
    
                    $sql = "SELECT * FROM user WHERE user_id=$user_id";
                    $result = mysqli_query($conn, $sql);
                    $data = mysqli_fetch_assoc($result);
                    if (!in_array('create', json_decode($data['permission']))) {
                        echo 'display:none';
                    }
                ?>"
            >
                Add Post
            </a>
        </div>
        <div>
            <?php
                require 'db.php';
                $user_id = intval($_GET['id']);
                
                $sql = "SELECT * FROM user_post WHERE user=$user_id";
                $result = mysqli_query($conn, $sql);
        
                while ($data = mysqli_fetch_assoc($result)) {
            ?>
                <div class='card'
                    style="<?php    
                        require 'db.php';
                        $user_id = $_GET['id'];
        
                        $peremiSql = "SELECT * FROM user WHERE user_id=$user_id";
                        $permiResult = mysqli_query($conn, $peremiSql);
                        $permi = mysqli_fetch_assoc($permiResult);
                        if (!in_array('view', json_decode($permi['permission']))) {
                            echo 'display:none';
                        }
                    ?>" 
                >
                    <a href="<?php
                        require 'db.php';
                        $user_id = $_GET['id'];
        
                        $peremiSql = "SELECT * FROM user WHERE user_id=$user_id";
                        $permiResult = mysqli_query($conn, $peremiSql);
                        $permi = mysqli_fetch_assoc($permiResult);
                        if (in_array('update', json_decode($permi['permission']))) {
                            echo "addPost.php?id=".intval($_GET['id'])."&post_id=".$data['id']; 
                        }

                    ?>">
                        <img src="./image/<?php echo $data['filename']; ?>">
                        <p><?php echo $data['notes']; ?></p>
                    </a>
                </div>
            <?php
                }
            ?>
        </div>
    </div>
</body>
</html>