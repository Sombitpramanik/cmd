<?php
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create the user
    $createUserCommand = "sudo useradd -m -s /bin/bash $username 2>&1";
    $createUserOutput = shell_exec($createUserCommand);

    // Change the password
    $passwordChangeCommand = "echo '$username:$password' | sudo chpasswd 2>&1";
    $passwordChangeOutput = shell_exec($passwordChangeCommand);

    // Check if the user was created and password changed successfully
    $userExistsCommand = "id $username";
    $userExistsOutput = shell_exec($userExistsCommand);

    if (!empty($userExistsOutput)) {
        echo "User $username created and password set.";
    } else {
        echo "Error creating user $username or setting password: $createUserOutput $passwordChangeOutput";
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
    <form method="post" action="create_user.php">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="Create User">
    </form>
</body>
</html>
