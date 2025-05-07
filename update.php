<?php
include('connection.php');

// --- Fetch user if GET[id] is set ---
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: Missing ID.");
}

$paramId = intval($_GET['id']);
$strQuery = "SELECT * FROM `users` WHERE id = $paramId";
$resultQuery = $con->query($strQuery);

if ($resultQuery->num_rows == 0) {
    die("Error: User not found.");
}

$row = mysqli_fetch_assoc($resultQuery);
$name    = $row['name'];
$gender  = $row['gender'];
$dob     = $row['date_of_birth'];
$address = $row['address'];
$profile = $row['profile'];

?>
<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Form - Netflix Style</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #141414;
            font-family: 'Roboto', sans-serif;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #333;
            padding: 2rem;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        .form-container h2 {
            margin-bottom: 1.5rem;
            color: #e50914;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 0.5rem;
            background-color: #444;
            border: none;
            color: #fff;
            border-radius: 5px;
        }
        .form-group input[type="radio"] {
            width: auto;
            margin-right: 0.5rem;
        }
        .form-group img {
            width: 87px;
            height: 100px;
            
        }
        .form-group .profile {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .form-group .profile input {
            flex-grow: 1;
        }
        .btn-update {
            width: 100%;
            padding: 0.7rem;
            background-color: #e50914;
            border: none;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn-update:hover {
            background-color: #f6121d;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 1rem;
            color: #e50914;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Update Profile</h2>
    <form action="" method="post" enctype="multipart/form-data">
        
    <div class="form-group">
           
    <input type="hidden" name="id" value="<?= $row['id'] ?>">


        </div>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
        </div>

        <div class="form-group">
            <label>Gender</label>
            <input type="radio" name="gender" value="male" <?php echo ($gender == 'male') ? 'checked' : ''; ?>> Male
            <input type="radio" name="gender" value="female" <?php echo ($gender == 'female') ? 'checked' : ''; ?>> Female
        </div>

        <div class="form-group">
            <label for="date">Date Of Birth</label>
            <input type="date" name="date" value="<?php echo $dob; ?>">
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <select name="address">
                <option value="Phnom Penh" <?php echo ($address == 'Phnom Penh') ? 'selected' : ''; ?>>Phnom Penh</option>
                <option value="Kampot" <?php echo ($address == 'Kampot') ? 'selected' : ''; ?>>Kampot</option>
                <option value="Kandal" <?php echo ($address == 'Kandal') ? 'selected' : ''; ?>>Kandal</option>
            </select>
        </div>

        <div class="form-group profile">
            <label>Profile</label>
            <div>
                <img src="uploads/<?php echo $profile; ?>" alt="Profile Picture">
                <input type="file" name="profile">
            </div>
        </div>

        <input type="submit" name="btn-update" value="Update" class="btn-update">
    </form>

    <a href="list-users.php" class="back-link">Back to list</a>
</div>

</body>
</html>


<?php
// --- Handle form submission ---
if (isset($_POST['btn-update'])) {

    // Gather and sanitize inputs
    $name    = $_POST['name'] ?? '';
    $gender  = $_POST['gender'] ?? '';
    $date    = $_POST['date'] ?? '';
    $address = $_POST['address'] ?? '';
    $paramId = $_POST['id'] ?? null;

    if (!$paramId) {
        die("Missing user ID.");
    }

    // Build fields array
    $fields = [
        "`name` = '$name'",
        "`gender` = '$gender'",
        "`date_of_birth` = '$date'",
        "`address` = '$address'"
    ];

    // Handle optional profile upload
    if (!empty($_FILES['profile']['name'])) {
        $file       = $_FILES['profile'];
        $fileName   = rand(1, 999) . '-' . basename($file['name']);
        $sourceFile = $file['tmp_name'];
        $path       = 'uploads/' . $fileName;

        if (move_uploaded_file($sourceFile, $path)) {
            $fields[] = "`profile` = '$fileName'";
        } else {
            die("Error uploading file.");
        }
    }

    // Check for updated_at column
    $hasUpdatedAt = false;
    $result = $con->query("SHOW COLUMNS FROM `users` LIKE 'updated_at'");
    if ($result && $result->num_rows > 0) {
        $hasUpdatedAt = true;
        $fields[] = "`updated_at` = NOW()";
    }

    // Combine all fields safely
    $setClause = implode(", ", $fields);
    $sqlStr = "UPDATE `users` SET $setClause WHERE id = $paramId";

    // Execute
    if ($con->query($sqlStr)) {
        echo "<script>alert('Update successful!'); window.location.href = 'list-users.php';</script>";
    } else {
        echo "<script>alert('Error: " . addslashes($con->error) . "');</script>";
    }
    
}
?>

