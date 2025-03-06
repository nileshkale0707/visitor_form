<?php
// Database connection parameters
$host = 'localhost';  // Database host
$dbname = 'visitor_form';  // Database name
$username = 'root';  // Database username (default for XAMPP is 'root')
$password = '';  // Database password (default for XAMPP is empty)

// Create a connection to MySQL
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and sanitize it
    $fullName = $conn->real_escape_string($_POST['fullName']);
    $city = $conn->real_escape_string($_POST['city']);
    $email = $conn->real_escape_string($_POST['email']);
    $age = intval($_POST['age']);  // Make sure it's an integer
    $gender = $conn->real_escape_string($_POST['gender']);
    $mobile = $conn->real_escape_string($_POST['mobile']);
    $suggestion = $conn->real_escape_string($_POST['suggestion']);

    // Prepare the SQL query to insert the data into the visitors table
    $sql = "INSERT INTO visitors (full_name, city, email, age, gender, mobile, suggestion)
            VALUES ('$fullName', '$city', '$email', $age, '$gender', '$mobile', '$suggestion')";

    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {
        // Redirect to a "Thank You" page after successful submission
        header("Location: thank_you.html");
        exit();
    } else {
        // Display an error message if the query fails
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
