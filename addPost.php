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
        print_r($_POST);
    ?>
    <div class="card">
        <form method="post">
            <div class='d-flex justify-content-between my-3'>
                <h4 class='d-flex align-items-center mb-0'>Create Post</h4>
            </div>
            <div class="form-group">
                <label for="inputGroupFile04">Upload Image</label>
                <input type="file" class="form-control" name="image" id="inputGroupFile04" accept='.jpg, .png, .jpeg'>
            </div>
            <div class="form-group">
                <label for="notes">Description</label>
                <textarea id="w3review" class="form-control" name="notes" rows="4" cols="50"></textarea> 
            </div>
            <div class="row d-flex justify-content-end mr-2">
                <input type="submit" role="button" name="create" class="btn btn-success" value="Create" />
            </div>
        </form>
    </div>
</body>
</html>