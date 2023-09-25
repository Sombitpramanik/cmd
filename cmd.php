<?php
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create the user and change the password using sudo -S to provide the password
    $createUserCommand = "echo '$password' | sudo -S useradd -m -s /bin/bash $username 2>&1";
    $createUserOutput = shell_exec($createUserCommand);

    // Check if the user was created successfully
    if (strpos($createUserOutput, 'already exists') !== false) {
        echo "User $username already exists.";
    } elseif (strpos($createUserOutput, 'Permission denied') !== false) {
        echo "Permission denied. You may not have the necessary privileges to create a user.";
    } elseif (!empty(trim($createUserOutput))) {
        echo "Error creating user $username: $createUserOutput";
    } else {
        // Change the password using sudo -S
        $passwordChangeCommand = "echo '$password' | sudo -S chpasswd 2>&1";
        $passwordChangeOutput = shell_exec($passwordChangeCommand);

        if (empty(trim($passwordChangeOutput))) {
            echo "User $username created and password set.";
        } else {
            echo "Error setting password for user $username: $passwordChangeOutput";
        }
    }
} else {
    echo "Please fill out both username and password fields.";
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px #888;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Create User</h2>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="Create User">
    </form>
</body>
</html>
