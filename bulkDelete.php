<?php
require_once("dbConnection.php");

if (isset($_POST['selected']) && is_array($_POST['selected'])) {
    foreach ($_POST['selected'] as $id) {
        $id = (int)$id;
        mysqli_query($mysqli, "DELETE FROM students WHERE id = $id");
    }
}

header("Location: index.php?deleted=1");
exit();