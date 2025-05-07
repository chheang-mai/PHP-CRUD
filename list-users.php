<?php
include('connection.php');
include('sidebar.php');

// Get value from table users
$sqlStr = 'SELECT * FROM `users`';
$result = $con->query($sqlStr);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background: black;
            color: white;
            font-family: Arial, sans-serif;
            padding: 20px;
            text-align: center; /* Center align all text */
        }
        
        .table-container {
            max-width: 90%;
            margin: auto;
            border-radius: 10px;
            padding: 20px;
            background: rgba(0, 0, 0, 0.8);
            box-shadow: 0px 0px 10px rgba(255, 0, 0, 0.8);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            background: black;
            color: white;
            text-align: center;
            margin: auto;
        }
        
        th, td {
            padding: 12px;
            border-bottom: 1px solid red;
            vertical-align: middle;
        }
        
        th {
            background: red;
            color: white;
        }
        
        tr:hover {
            background: rgba(255, 0, 0, 0.2);
        }
        
        img {
            border-radius: 10px;
            display: block;
            margin: auto; /* Center images */
        }
        
        .btn-container {
            display: flex;
            justify-content: center;
            gap: 10px; /* Space between buttons */
        }
        
        .btn-delete, .btn-update {
            padding: 8px 12px;
            border: none;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            width: 80px; /* Ensure buttons have equal width */
        }
        
        .btn-delete {
            background: darkred;
        }
        
        .btn-update {
            background: red;
        }
        
        .btn-delete:hover {
            background: black;
            border: 1px solid red;
        }
        
        .btn-update:hover {
            background: black;
            border: 1px solid red;
        }
        
        .content {
            margin-left: 250px;
            padding: 20px;
            
        }
    </style>
</head>
<body>

    <div class="content">
        <div class="table-container">
            <h2 class="text-center text-danger">User List</h2>
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Password</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                        <th>Address</th>
                        <th>Profile</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['password']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['date_of_birth']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td>
                                <img src="uploads/<?php echo $row['profile']; ?>" width="80px">
                            </td>
                            <td>
                                <div class="btn-container">
                                    <a href="update.php?id=<?php echo $row['id']; ?>" class="btn-update">Update</a>
                                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
