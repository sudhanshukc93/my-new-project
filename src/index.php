<?php
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_task'])) {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $status = $_POST['status'] ?? 'Pending';

    if ($title !== '') {
        $stmt = $conn->prepare("INSERT INTO tasks (title, description, status) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $description, $status);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: index.php");
    exit;
}

if (isset($_GET['complete'])) {
    $id = (int) $_GET['complete'];
    $stmt = $conn->prepare("UPDATE tasks SET status='Completed' WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit;
}

$result = $conn->query("SELECT * FROM tasks ORDER BY id DESC");
$tasks = [];
while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;
}

$total = count($tasks);
$completed = count(array_filter($tasks, fn($t) => $t['status'] === 'Completed'));
$progress = $total ? round(($completed / $total) * 100) : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevOps TaskFlow</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="orb orb-one"></div>
<div class="orb orb-two"></div>

<header class="topbar">
    <div class="brand">
        <div class="logo">D</div>
        <div>
            <strong>DevOps TaskFlow</strong>
            <span>AWS • Docker • PHP • MySQL</span>
        </div>
    </div>
    <div class="status"><i></i> System Online</div>
</header>

<main class="container">
    <section class="hero">
        <div>
            <p class="eyebrow">DEPLOYMENT PROJECT</p>
            <h1>Build. Ship. <span>Deploy.</span></h1>
            <p class="subtitle">A beginner-friendly PHP & MySQL application containerized with Docker and ready for AWS deployment.</p>
        </div>
        <div class="hero-card">
            <div class="ring"><b><?= $progress ?>%</b></div>
            <span>Project progress</span>
        </div>
    </section>

    <section class="stats">
        <div class="stat"><span>Total Tasks</span><b><?= $total ?></b></div>
        <div class="stat"><span>Completed</span><b><?= $completed ?></b></div>
        <div class="stat"><span>Pending</span><b><?= $total - $completed ?></b></div>
    </section>

    <section class="grid">
        <div class="panel">
            <div class="panel-head">
                <div><p class="eyebrow">WORKFLOW</p><h2>Deployment Tasks</h2></div>
                <span class="pill">Live Database</span>
            </div>

            <div class="task-list">
            <?php foreach ($tasks as $task): ?>
                <article class="task">
                    <div class="task-icon <?= strtolower(str_replace(' ', '-', $task['status'])) ?>">
                        <?= $task['status'] === 'Completed' ? '✓' : ($task['status'] === 'In Progress' ? '↻' : '○') ?>
                    </div>
                    <div class="task-info">
                        <h3><?= htmlspecialchars($task['title']) ?></h3>
                        <p><?= htmlspecialchars($task['description']) ?></p>
                        <small><?= htmlspecialchars($task['status']) ?> • <?= htmlspecialchars($task['created_at']) ?></small>
                    </div>
                    <?php if ($task['status'] !== 'Completed'): ?>
                        <a class="complete" href="?complete=<?= $task['id'] ?>">Complete</a>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
            </div>
        </div>

        <aside class="panel add-panel">
            <p class="eyebrow">QUICK ACTION</p>
            <h2>Add Task</h2>
            <p class="muted">Create a new deployment task. Data is stored in MySQL.</p>
            <form method="POST">
                <label>Task title</label>
                <input name="title" placeholder="e.g. Push image to Docker Hub" required>

                <label>Description</label>
                <textarea name="description" placeholder="What needs to be done?"></textarea>

                <label>Status</label>
                <select name="status">
                    <option>Pending</option>
                    <option>In Progress</option>
                    <option>Completed</option>
                </select>

                <button name="add_task" type="submit">+ Add Task</button>
            </form>
        </aside>
    </section>

    <footer>
        <span>DevOps learning project</span>
        <span>PHP 8.2 + Apache • MySQL 8 • Docker</span>
    </footer>
</main>
</body>
</html>
