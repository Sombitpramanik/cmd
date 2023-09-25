<?php
$username = "phpuser";
$password = "php123";

// Use the exec() function to run the useradd command
$command = "sudo useradd -m $username";
exec($command, $output, $returnCode);

// Check the return code to see if the user was added successfully
if ($returnCode === 0) {
    // User added successfully, now set the password
    $passwordCommand = "sudo passwd $username";
    exec("$passwordCommand <<< '$password\n$password\n'", $passwordOutput, $passwordReturnCode);

    if ($passwordReturnCode === 0) {
        echo "User $username created and password set.";
    } else {
        echo "Error setting password for user $username.";
    }
} else {
    echo "Error creating user $username.";
}
?>
