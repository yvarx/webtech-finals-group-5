<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 60px;
        }
        .card {
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <?php
        require_once("dbConnection.php");

        if (isset($_POST['update'])) {
            $id = mysqli_real_escape_string($mysqli, $_POST['id']);
            $sid = mysqli_real_escape_string($mysqli, $_POST['sid']);
            $name = mysqli_real_escape_string($mysqli, $_POST['name']);
            $age = mysqli_real_escape_string($mysqli, $_POST['age']);
            $email = mysqli_real_escape_string($mysqli, $_POST['email']);
            $gender = mysqli_real_escape_string($mysqli, $_POST['gender']);
            $course = mysqli_real_escape_string($mysqli, $_POST['course']);

            if (empty($sid) || empty($name) || empty($age) || empty($email) || empty($gender) || empty($course)) {
                if (empty($sid)) echo "<div class='text-danger mb-2'>Student ID field is empty.</div>";
                if (empty($name)) echo "<div class='text-danger mb-2'>Name field is empty.</div>";
                if (empty($age)) echo "<div class='text-danger mb-2'>Age field is empty.</div>";
                if (empty($email)) echo "<div class='text-danger mb-2'>Email field is empty.</div>";
                if (empty($gender)) echo "<div class='text-danger mb-2'>Gender field is empty.</div>";
                if (empty($course)) echo "<div class='text-danger mb-2'>Course field is empty.</div>";

                echo "<a href='javascript:self.history.back();' class='btn btn-secondary mt-3'>Go Back</a>";
            } else {
                $result = mysqli_query($mysqli, "
                    UPDATE students 
                    SET studentID = '$sid', name = '$name', age = '$age', gender = '$gender', course = '$course', email = '$email' 
                    WHERE id = $id
                ");

                if ($result) {
                    echo "<div class='alert alert-success'>Data updated successfully!</div>";
                    echo "<a href='index.php' class='btn btn-primary'>View Result</a>";
                } else {
                    echo "<div class='alert alert-danger'>Error updating record.</div>";
                }
            }
        }
        ?>
    </div>
</div>

</body>
</html>