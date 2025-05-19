<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "livestock_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tag_number = $_POST['tag_number'];
    $livestock_type = $_POST['livestock_type'];
    $breed = $_POST['breed'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];

    // Handle file upload if needed
    $photo = "";
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photo = 'uploads/' . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
    }

    // Insert data into the database
    $sql = "INSERT INTO livestock (tag_number, livestock_type, breed, date_of_birth, gender, photo) VALUES ('$tag_number', '$livestock_type', '$breed', '$date_of_birth', '$gender', '$photo')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>