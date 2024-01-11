<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "product";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data and insert into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productType = $_POST["productType"];
    $productName = $_POST["productName"];
    $productQuantity = $_POST["productQuantity"];
    $productDescription = $_POST["productDescription"];
    $location = $_POST["Location"];
    $productPhotos = $_POST["productPhotos"];


 // Your existing code for other form fields...

    // Handle file uploads
    $uploadFolder = "productPhotos/"; // Change this to the folder where you want to store uploads
    $uploadedPhotos = array();

    foreach ($_FILES["productPhotos"]["tmp_name"] as $key => $tmp_name) {
        $photoName = $_FILES["productPhotos"]["name"][$key];
        $photoPath = $uploadFolder . $photoName;

        move_uploaded_file($tmp_name, $photoPath);
        $uploadedPhotos[] = $photoPath;
    }

    // Convert the array of photo paths to a string (e.g., "photo1.jpg,photo2.jpg,photo3.jpg")
    $photosString = implode(",", $uploadedPhotos);

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("INSERT INTO product_table (productType, productName, productQuantity, productDescription, location, photos) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $productType, $productName, $productQuantity, $productDescription, $location, $photosString);



    // Prepare and execute SQL statement
   // $stmt = $conn->prepare("INSERT INTO product_table (productType, productName, productQuantity, productDescription, location, productPhotos) VALUES (?, ?, ?, ?, ?, ?)");
   // $stmt->bind_param("ssiss", $productType, $productName, $productQuantity, $productDescription, $location);

    if ($stmt->execute()) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
