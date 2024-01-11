<?php
$server = "localhost";
$user = "root";
$pssd = "";
$dbname = "product";

$conn = new mysqli($server, $user, $pssd, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];
    $productType = $_POST['productType'];
    $productName = $_POST['productName'];
    $productQuantity = $_POST['productQuantity'];
    $productDescription = $_POST['productDescription'];
    $location = $_POST['Location'];

    // Handling file upload (productPhotos)
    $product_photos = $_POST['productPhotos'];  // Assuming it's a single file

    // Perform any additional validation or sanitization here

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO product_table (product_id, productType, productName, productQuantity, productDescription, location, productPhotos) VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Check if the prepare statement succeeded
    if ($stmt === false) {
        die("Error in prepare statement: " . $conn->error);
    }

    // Assuming product_id is an integer; adjust the type accordingly if needed
    $result = $stmt->bind_param("ississs", $productId, $productType, $productName, $productQuantity, $productDescription, $location, $product_photos);

    // Check if the bind_param succeeded
    if ($result === false) {
        die("Error in bind_param: " . $stmt->error);
    }

    $stmt->execute();
    $stmt->close();

    echo "Data has been successfully submitted!";
} else {
    echo "Invalid request.";
}

$conn->close();
?>
