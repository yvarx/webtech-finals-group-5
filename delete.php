<?php
// Include the database connection file
require_once("dbConnection.php");

// Get id parameter value from URL
$id = $_GET['id']; //44

// Delete row from the database table
$result = mysqli_query($mysqli, "DELETE FROM students WHERE id = $id");

// Redirect to the main display page (index.php in our case)
echo "<script>Data deleted successfully!</script>";
header("Location:index.php");