<?php
$server = "localhost";
$user = "root";
$pssd = "";
$dbname = "product";

$conn = new mysqli($server, $user, $pssd, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select data from the database
$sql = "SELECT * FROM product_table";
$result = $conn->query($sql);

if ($result === false) {
    die("Error in query: " . $conn->error);
}

// Check if there are any rows in the result set
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "Product ID: " . $row["product_id"] . "<br>";
        echo "Product Type: " . $row["productType"] . "<br>";
        echo "Product Name: " . $row["productName"] . "<br>";
        echo "Product Quantity: " . $row["productQuantity"] . "<br>";
        echo "Product Description: " . $row["productDescription"] . "<br>";
        echo "Location: " . $row["Location"] . "<br>";
        // Assuming productPhotos is a file path; adjust accordingly
        echo "Product Photos: <img src='" . $row["productPhotos"] . "' alt='Product Photo'><br>";
        echo "----------------------------------------<br>";
    }
} else {
    echo "No records found in the database.";
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .top-right-button {
            position: fixed;
            top: 10px;
            right: 10px;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .top-right-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <button class="top-right-button" type="button" onclick="location.href='Products.html'">Add</button>

</body>
</html>
