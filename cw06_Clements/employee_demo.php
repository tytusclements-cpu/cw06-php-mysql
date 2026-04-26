<?php
require "db.php";

$message = "";
$messageClass = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["emp_name"] ?? "");
    $job = trim($_POST["job_name"] ?? "");
    $salary = (float)($_POST["salary"] ?? 0);
    $hire = $_POST["hire_date"] ?? "";
    $deptId = (int)($_POST["department_id"] ?? 0);
    $deptName = trim($_POST["department_name"] ?? "");

    if ($name === "" || $job === "" || $salary <= 0 || $hire === "" || $deptId <= 0 || $deptName === "") {
        $message = "Please complete all fields correctly.";
        $messageClass = "error";
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO employees 
            (emp_name, job_name, salary, hire_date, department_id, department_name)
            VALUES (?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param("ssdsis", $name, $job, $salary, $hire, $deptId, $deptName);

        if ($stmt->execute()) {
            $message = "Record saved successfully. Inserted ID: " . $stmt->insert_id;
            $messageClass = "success";
        } else {
            $message = "Error saving record.";
            $messageClass = "error";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Demo</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="demo-page">
<main class="demo-wrap">
    <section class="demo-card">
        <h1 class="demo-title">Employee Demo Form</h1>
        <p class="demo-subtitle">Add employee records using PHP, MySQL, and prepared statements.</p>

        <?php if ($message): ?>
            <p class="demo-msg <?= htmlspecialchars($messageClass) ?>">
                <?= htmlspecialchars($message) ?>
            </p>
        <?php endif; ?>

        <form method="post">
            <div class="demo-grid">
                <label class="demo-field">
                    <span class="demo-label">Employee Name</span>
                    <input class="demo-input" name="emp_name" required>
                </label>

                <label class="demo-field">
                    <span class="demo-label">Job Title</span>
                    <input class="demo-input" name="job_name" required>
                </label>

                <label class="demo-field">
                    <span class="demo-label">Salary</span>
                    <input class="demo-input" name="salary" type="number" step="0.01" required>
                </label>

                <label class="demo-field">
                    <span class="demo-label">Hire Date</span>
                    <input class="demo-input" name="hire_date" type="date" required>
                </label>

                <label class="demo-field">
                    <span class="demo-label">Department ID</span>
                    <input class="demo-input" name="department_id" type="number" required>
                </label>

                <label class="demo-field">
                    <span class="demo-label">Department Name</span>
                    <input class="demo-input" name="department_name" required>
                </label>
            </div>

            <div class="demo-actions">
                <button class="demo-btn" type="submit">Save Employee</button>
                <a class="demo-link" href="read_employees.php">View employee records</a>
            </div>
        </form>
    </section>
</main>
</body>
</html>

<?php $conn->close(); ?>