<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.html");
    exit();
}

// Connect to database
$conn = new mysqli("localhost", "root", "", "portfolio_db");

if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM messages ORDER BY submitted_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            padding: 20px;
            background: #f0f4f8;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            margin-bottom: 20px;
        }

        .header h2 {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            margin: 0;
            color: #003366;
        }

        .logout {
            text-decoration: none;
            background-color: #333;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .logout:hover {
            background-color: #0077FF;
        }

        table {
            color: white;
            margin: 1rem auto;
            width: 90%;
            max-width: 800px;
            background: rgba(0, 119, 255, 0.9);
            animation: fadeInUp 1s ease forwards;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid #000000;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        th {
            padding: 1rem;
            font-size: 1.1rem;
            background-color: #005ecb;
            border-bottom: 2px solid #000000;
        }

        td {
            padding: 0.85rem;
            font-size: 1rem;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Admin Dashboard - Messages</h2>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Message</th>
            <th>Submitted At</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td><?= htmlspecialchars($row['message']) ?></td>
            <td><?= $row['submitted_at'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>




<?php $conn->close(); ?>
