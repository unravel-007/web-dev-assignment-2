<?php

$dataFile = 'users.json';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    
   
    if (file_exists($dataFile)) {
        $jsonData = file_get_contents($dataFile);
        $users = json_decode($jsonData, true);
    } else {
        $users = [];
    }
    
    
    $users[] = ['name' => $name, 'email' => $email];
    
    
    file_put_contents($dataFile, json_encode($users));
}


$usersData = '';
if (file_exists($dataFile)) {
    $jsonData = file_get_contents($dataFile);
    $users = json_decode($jsonData, true);

    $usersData .= "<h3>Users List:</h3><div class='users-list'>";
    foreach ($users as $user) {
        $usersData .= "<div class='user'><strong>Name:</strong> " . $user['name'] . "<br>";
        $usersData .= "<strong>Email:</strong> " . $user['email'] . "<br><br></div>";
    }
    $usersData .= "</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled PHP Form</title>
    <link rel="stylesheet" href="styles.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .form-container {
        background-color: #fff;
        padding: 60px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        max-width: 400px;
        width: 100%;
    }

    input[type="text"], input[type="email"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="submit"] {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #218838;
    }

    #toggleButton {
        margin-top: 20px;
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    #toggleButton:hover {
        background-color: #0056b3;
    }

    .users-list {
        margin-top: 20px;
    }

    .user {
        background-color: #f1f1f1;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
    }
</style>
</head>
<body>

<div class="form-container">
    
    <form method="POST">
        Name: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <input type="submit" value="Submit">
    </form>
    
    
    <button id="toggleButton">Display Data</button>

   
    <div id="userData">
        <?php echo $usersData; ?>
    </div>
</div>

<script>
    
    document.getElementById("toggleButton").addEventListener("click", function() {
        var userDataDiv = document.getElementById("userData");
        if (userDataDiv.style.display === "none" || userDataDiv.style.display === "") {
            userDataDiv.style.display = "block";  
            this.textContent = "Hide Data";  
        } else {
            userDataDiv.style.display = "none";  
            this.textContent = "Display Data";  
        }
    });
</script>

</body>
</html>