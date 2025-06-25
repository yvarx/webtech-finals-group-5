<!DOCTYPE html>
<html>
<head>
    <title>Add Data Result</title>
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
        // Include the database connection file
        require_once("dbConnection.php");

        if (isset($_POST['submit'])) {
            // Escape special characters in string for use in SQL statement    
            $sid = mysqli_real_escape_string($mysqli, $_POST['sid']);
            $name = mysqli_real_escape_string($mysqli, $_POST['name']);
            $age = mysqli_real_escape_string($mysqli, $_POST['age']);
            $email = mysqli_real_escape_string($mysqli, $_POST['email']);
            $gender = mysqli_real_escape_string($mysqli, $_POST['gender']);
            $course = mysqli_real_escape_string($mysqli, $_POST['course']);

            $errors = [];

            // Check for empty fields
            if (empty($sid)) {
                $errors[] = "Student ID field is empty.";
            }
            if (empty($name)) {
                $errors[] = "Name field is empty.";
            }
            if (empty($age)) {
                $errors[] = "Age field is empty.";
            }
            if (empty($email)) {
                $errors[] = "Email field is empty.";
            }
            if (empty($gender)) {
                $errors[] = "Gender field is empty.";
            }
            if (empty($course)) {
                $errors[] = "Course field is empty.";
            }

            if (!empty($errors)) {
                echo '<div class="alert alert-danger"><h5>Please correct the following:</h5><ul>';
                foreach ($errors as $error) {
                    echo "<li>$error</li>";
                }
                echo '</ul></div>';
                echo '<a href="add.php" class="btn btn-secondary mt-3">Go Back</a>';
            } else {
                // Insert data into database
                $result = mysqli_query($mysqli, "
                    INSERT INTO students (`studentID`, `name`, `age`, `gender`, `course`, `email`) 
                    VALUES ('$sid', '$name', '$age', '$gender', '$course', '$email')
                ");

                if ($result) {
                    echo '<div class="alert alert-success">Data added successfully!</div>';
                    echo '<a href="index.php" class="btn btn-primary">View Result</a>';
                } else {
                    echo '<div class="alert alert-danger">Error adding data to the database.</div>';
                    echo '<a href="add.php" class="btn btn-secondary">Try Again</a>';
                }
            }
        }
        ?>
    </div>
</div>

</body>
</html>