<?php
// Include the database connection file
require_once("dbConnection.php");

// Get id from URL parameter
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Select data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM students WHERE id = $id");
$resultData = mysqli_fetch_assoc($result);

$sid = $resultData['studentID'];
$name = $resultData['name'];
$age = $resultData['age'];
$email = $resultData['email'];
$gender = $resultData['gender'];
$course = $resultData['course'];
?>
<!DOCTYPE html>
<html>
<head>    
    <title>Edit Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
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
        .form-label {
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="card">
        <h3 class="text-center mb-4">Edit Student Data</h3>
        <form name="edit" method="post" action="editAction.php">
            <div class="mb-3">
                <label class="form-label" for="sid">Student ID</label>
                <input type="text" class="form-control" name="sid" id="sid" value="<?php echo $sid; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="age">Age</label>
                <input type="text" class="form-control" name="age" id="age" value="<?php echo $age; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>" required>
            </div>
			<div class="mb-3">
    			<label class="form-label" for="gender">Gender</label>
    		<select class="form-select" name="gender" id="gender" required>
        		<option value="" disabled>Select Gender</option>
        		<option value="Male" <?php if ($gender == 'Male') echo 'selected'; ?>>Male</option>
        		<option value="Female" <?php if ($gender == 'Female') echo 'selected'; ?>>Female</option>
        		<option value="Other" <?php if ($gender == 'Other') echo 'selected'; ?>>Other</option>
    			</select>
				</div>
			<div class="mb-3">
    			<label class="form-label" for="course">Course</label>
    			<input type="text" class="form-control" name="course" id="course" value="<?php echo $course; ?>" required>
			</div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="d-flex justify-content-between">
                <a href="index.php" class="btn btn-secondary">Back to Home</a>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>