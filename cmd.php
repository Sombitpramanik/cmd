<?php
$username = "phpuser";
$password = "php123";

// Use the exec() function to run the useradd command with sudo
$command = "sudo useradd -m $username";
exec($command, $output, $returnCode);

if ($returnCode === 0) {
    // User added successfully, now set the password
    $passwordCommand = "sudo passwd $username";
    exec("echo '$password\n$password\n' | $passwordCommand", $passwordOutput, $passwordReturnCode);

    if ($passwordReturnCode === 0) {
        echo "User $username created and password set.";
    } else {
        echo "Error setting password for user $username.";
    }
} else {
    echo "Error creating user $username.";
}
?>
