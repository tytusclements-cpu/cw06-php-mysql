<?php
require "db.php";

$message = "";
$messageClass = "";
$id = (int)($_GET["id"] ?? $_POST["emp_id"] ?? 0);

if ($id <= 0) {
    die("Invalid employee ID.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $job = trim($_POST["job_name"] ?? "");
    $salary = (float)($_POST["salary"] ?? 0);

    if ($job === "" || $salary <= 0) {
        $message = "Please enter a valid job title and salary.";
        $messageClass = "error";
    } else {
        $stmt = $conn->prepare("UPDATE employees SET job_name = ?, salary = ? WHERE emp_id = ?");
        $stmt->bind_param("sdi", $job, $salary, $id);

        if ($stmt->execute() && $stmt->affected_rows === 1) {
            $message = "Employee updated successfully.";
            $messageClass = "success";
        } else {
            $message = "No record changed. Check the employee ID.";
            $messageClass = "error";
        }

        $stmt->close();
    }
}

$stmt = $conn->prepare("SELECT * FROM employees WHERE emp_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$employee = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$employee) {
    die("Employee not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Employee</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="demo-page">
<main class="demo-wrap">
    <section class="demo-card">
        <h1 class="demo-title">Update Employee</h1>

        <?php if ($message): ?>
            <p class="demo-msg <?= htmlspecialchars($messageClass) ?>">
                <?= htmlspecialchars($message) ?>
            </p>
        <?php endif; ?>

        <form method="post">
            <input type="hidden" name="emp_id" value="<?= htmlspecialchars($employee["emp_id"]) ?>">

            <label class="demo-field">
                <span class="demo-label">Employee Name</span>
                <input class="demo-input" value="<?= htmlspecialchars($employee["emp_name"]) ?>" disabled>
            </label>

            <label class="demo-field">
                <span class="demo-label">Job Title</span>
                <input class="demo-input" name="job_name" value="<?= htmlspecialchars($employee["job_name"]) ?>" required>
            </label>

            <label class="demo-field">
                <span class="demo-label">Salary</span>
                <input class="demo-input" name="salary" type="number" step="0.01" value="<?= htmlspecialchars($employee["salary"]) ?>" required>
            </label>

            <div class="demo-actions">
                <button class="demo-btn" type="submit">Update Employee</button>
                <a class="demo-link" href="read_employees.php">Back to Records</a>
            </div>
        </form>
    </section>
</main>
</body>
</html>

<?php $conn->close(); ?>