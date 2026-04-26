<?php
require "db.php";

$message = "";
$messageClass = "";
$id = (int)($_GET["id"] ?? $_POST["emp_id"] ?? 0);

if ($id <= 0) {
    die("Invalid employee ID.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $conn->prepare("DELETE FROM employees WHERE emp_id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute() && $stmt->affected_rows === 1) {
        $message = "Employee deleted successfully.";
        $messageClass = "success";
    } else {
        $message = "No record deleted. Check the employee ID.";
        $messageClass = "error";
    }

    $stmt->close();
}

$stmt = $conn->prepare("SELECT * FROM employees WHERE emp_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$employee = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Employee</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="demo-page">
<main class="demo-wrap">
    <section class="demo-card">
        <h1 class="demo-title">Delete Employee</h1>

        <?php if ($message): ?>
            <p class="demo-msg <?= htmlspecialchars($messageClass) ?>">
                <?= htmlspecialchars($message) ?>
            </p>
            <a class="demo-link" href="read_employees.php">Back to Records</a>
        <?php elseif ($employee): ?>
            <p>Are you sure you want to delete this employee?</p>
            <p><strong><?= htmlspecialchars($employee["emp_name"]) ?></strong></p>

            <form method="post">
                <input type="hidden" name="emp_id" value="<?= htmlspecialchars($employee["emp_id"]) ?>">
                <div class="demo-actions">
                    <button class="demo-btn danger-btn" type="submit">Yes, Delete</button>
                    <a class="demo-link" href="read_employees.php">Cancel</a>
                </div>
            </form>
        <?php else: ?>
            <p class="demo-msg error">Employee not found.</p>
            <a class="demo-link" href="read_employees.php">Back to Records</a>
        <?php endif; ?>
    </section>
</main>
</body>
</html>

<?php $conn->close(); ?>