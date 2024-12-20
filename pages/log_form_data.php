<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the data from the form
    $username = isset($_POST['username']) ? $_POST['username'] : 'N/A';
    $email = isset($_POST['email']) ? $_POST['email'] : 'N/A';
    $password = isset($_POST['password']) ? $_POST['password'] : 'N/A';  // Make sure to hash the password in production

    // Create a log entry
    $logData = "Username: $username, Email: $email, Password: $password\n";
    
    // Define the log file path (ensure the server has write permissions to this file)
    $logFile = 'user_data_log.txt';

    // Write the log data to the file
    file_put_contents($logFile, $logData, FILE_APPEND);

    // Return a response
    echo 'Form data successfully logged.';
} else {
    echo 'Invalid request.';
}
?>
