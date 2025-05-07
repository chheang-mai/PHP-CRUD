<?php
include('connection.php');

if (isset($_POST['btn-insert'])) {
    if(!empty($_POST['name']) && !empty(($_POST['password'])) && !empty($_POST['gender']) && !empty($_POST['date']) && !empty($_POST['address'])){
    $name    = $_POST['name'];
    $password = $_POST['password'];
    $gender  = $_POST['gender'];
    $date    = $_POST['date'];
    $address = $_POST['address'];

    // Handle file upload
    $file       = $_FILES['profile'];
    $fileName   = rand(1,999) . '-' . basename($file['name']);
    $sourceFile = $file['tmp_name'];
    $path       = 'uploads/' . $fileName;
    }else{
        echo 'please Input all Infomation';
    }
    if (move_uploaded_file($sourceFile, $path)) {
        $sqlStr = "
            INSERT INTO `users`(`name`, `password`,`gender`,`date_of_birth`, `address`, `profile`)
            VALUES ('$name' , '$password', '$gender', '$date', '$address', '$fileName')
        ";

        if ($con->query($sqlStr)) {
            echo '<script>alert("Insert successful!"); window.location.href="list-users.php";</script>';
        } else {
            echo '<script>alert("Error: ' . $con->error . '");</script>';
        }
    } else {
        echo '<script>alert("File upload failed!");</script>';
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix-Style Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background: black;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: rgba(0, 0, 0, 0.8);
            padding: 40px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0px 0px 10px rgba(255, 0, 0, 0.8);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: red;
        }
        .form-control {
            background: #333;
            border: none;
            color: white;
        }
        .form-control:focus {
            background: #444;
            color: white;
        }
        .btn-red {
            background: red;
            border: none;
            width: 100%;
            padding: 10px;
            color: white;
            font-size: 18px;
            border-radius: 5px;
        }
        .btn-red:hover {
            background: darkred;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add Users</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Gender</label><br>
                <input type="radio" name="gender" value="male" required> Male 
                <input type="radio" name="gender" value="female" required> Female 
            </div>
            <div class="mb-3">
                <label>Date of Birth</label>
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Address</label>
                <select name="address" class="form-control" required>
                    <option value="Phnom Penh">Phnom Penh</option>
                    <option value="Kampot">Kampot</option>
                    <option value="Kandal">Kandal</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Profile Picture</label>
                <input type="file" name="profile" class="form-control" required>
            </div>
            <button type="submit" name="btn-insert" class="btn btn-red">Add</button>
        </form>
    </div>
</body>
</html>
