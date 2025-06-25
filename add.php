<!DOCTYPE html>
<html>
<head>
    <title>Add Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard {
            margin: 40px auto;
            max-width: 600px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container dashboard">
    <div class="card p-4">
        <h3 class="text-center mb-4">Add Student Data</h3>

        <form action="addAction.php" method="post" name="add">
            <div class="mb-3">
                <label for="sid" class="form-label">Student ID</label>
                <input type="text" class="form-control" name="sid" id="sid" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" name="age" id="age" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" name="gender" id="gender" required>
                    <option value="" disabled selected>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <input type="text" class="form-control" name="course" id="course" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="d-flex justify-content-between">
                <a href="index.php" class="btn btn-secondary">Back to Home</a>
                <button type="submit" name="submit" class="btn btn-primary">Add Student</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
