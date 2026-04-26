<?php
require "db.php";

$result = $conn->query("SELECT * FROM employees ORDER BY emp_id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Records</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="demo-page">
<main class="demo-wrap wide">
    <section class="demo-card">
        <h1 class="demo-title">Employee Records</h1>
        <p class="demo-subtitle">All employee records from the database.</p>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Job</th>
                <th>Salary</th>
                <th>Hire Date</th>
                <th>Department ID</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row["emp_id"]) ?></td>
                    <td><?= htmlspecialchars($row["emp_name"]) ?></td>
                    <td><?= htmlspecialchars($row["job_name"]) ?></td>
                    <td>$<?= htmlspecialchars($row["salary"]) ?></td>
                    <td><?= htmlspecialchars($row["hire_date"]) ?></td>
                    <td><?= htmlspecialchars($row["department_id"]) ?></td>
                    <td><?= htmlspecialchars($row["department_name"]) ?></td>
                    <td>
                        <a class="demo-link" href="update_employee.php?id=<?= htmlspecialchars($row["emp_id"]) ?>">Edit</a>
                        |
                        <a class="demo-link danger" href="delete_employee.php?id=<?= htmlspecialchars($row["emp_id"]) ?>">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <div class="demo-actions">
            <a class="demo-link" href="employee_demo.php">Back to Form</a>
        </div>
    </section>
</main>
</body>
</html>

<?php $conn->close(); ?>