<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once("dbConnection.php");

// Pagination settings
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // prevent negative pages
$start = ($page - 1) * $limit;

// Fetch paginated students
$result = mysqli_query($mysqli, "SELECT * FROM students LIMIT $start, $limit");

// Count total students for pagination links
$countResult = mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM students");
$total = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($total / $limit);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard {
            margin: 10px auto;
            max-width: 1320px;
        }
        .table th {
            background-color: #343a40;
            color: white;
        }
        .btn-custom {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<div class="container mt-3 mb-3 d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h5>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>

<div class="container dashboard">
    <h2 class="mb-4 text-center">Student Dashboard</h2>

    <div class="mb-3 text-end">
        <a href="add.php" class="btn btn-success">+ Add New Student</a>
    </div>

    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-success">Student deleted successfully.</div>
    <?php endif; ?>

    <form method="post" action="bulkDelete.php" onsubmit="return confirm('Are you sure you want to delete selected students?')">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll"></th>
                    <th>#</th>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Course</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = $start + 1; while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><input type="checkbox" name="selected[]" value="<?= $row['id'] ?>"></td>
                    <td><?= $i++ ?></td>
                    <td><?= $row['studentID'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['age'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['gender'] ?></td>
                    <td><?= $row['course'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm btn-custom">Edit</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm btn-custom" onclick="return confirm('Delete this student?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <button type="submit" id="deleteSelectedBtn" class="btn btn-danger mb-3 d-none">Delete Selected</button>
    </form>

    <!-- Pagination -->
    <?php if ($totalPages > 1): ?>
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?= max(1, $page - 1) ?>">Previous</a>
                </li>

                <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                    <li class="page-item <?php if ($p == $page) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?= $p ?>"><?= $p ?></a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?= min($totalPages, $page + 1) ?>">Next</a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>
</div>

<!-- JavaScript to select all checkboxes -->
<script>
document.getElementById("selectAll").addEventListener("click", function() {
    const checkboxes = document.querySelectorAll("input[name='selected[]']");
    for (let cb of checkboxes) {
        cb.checked = this.checked;
    }
});
</script>
<script>
const selectAll = document.getElementById("selectAll");
const checkboxes = document.querySelectorAll("input[name='selected[]']");
const deleteBtn = document.getElementById("deleteSelectedBtn");

// Toggle all checkboxes when "Select All" is clicked
selectAll.addEventListener("click", function () {
    checkboxes.forEach(cb => cb.checked = this.checked);
    toggleDeleteButton();
});

// Toggle button visibility based on any checkbox selection
checkboxes.forEach(cb => {
    cb.addEventListener("change", toggleDeleteButton);
});

function toggleDeleteButton() {
    const anyChecked = [...checkboxes].some(cb => cb.checked);
    deleteBtn.classList.toggle("d-none", !anyChecked);
}
</script>

</body>
</html>