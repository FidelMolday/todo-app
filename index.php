<?php include 'db.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    if (!empty($title)) {
        $stmt = $conn->prepare("INSERT INTO tasks (title) VALUES (?)");
        $stmt->bind_param("s", $title);
        $stmt->execute();
        $stmt->close();
        header("Location: index.php");
        exit;
    }
}

$result = $conn->query("SELECT * FROM tasks ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>To-Do App</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h1> My To-Do List</h1>
    <form method="POST" action="">
        <input type="text" name="title" placeholder="Enter task..." required>
        <button type="submit">Add Task</button>
    </form>

    <ul class="task-list">
        <?php while ($row = $result->fetch_assoc()): ?>
            <li>
                <?php echo htmlspecialchars($row['title']); ?>
                <a href="delete.php?id=<?php echo $row['id']; ?>">❌</a>
            </li>
        <?php endwhile; ?>
    </ul>
</div>
</body>
</html>
