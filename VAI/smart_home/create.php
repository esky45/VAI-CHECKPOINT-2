<?php
require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $type = $_POST['type'];
    $status = $_POST['status'];
    $brightness = isset($_POST['brightness']) ? intval($_POST['brightness']) : null;
    $threshold = isset($_POST['threshold']) ? intval($_POST['threshold']) : null;

    $sql = "INSERT INTO devices (name, type, status, brightness, threshold) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $name, $type, $status, $brightness, $threshold);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Device</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h1>Create New Device</h1>
        <form action="" method="POST">
            <!-- Device Name -->
            <label for="name">Device Name:</label>
            <input type="text" name="name" id="name" required minlength="3" maxlength="100">

            <!-- Device Type -->
            <label for="type">Device Type:</label>
            <select name="type" id="type" required>
                <option value="Lightbulb">Lightbulb</option>
                <option value="Sensor">Sensor</option>
                <option value="Other">Other</option>
            </select>

            <!-- Device Status -->
            <label for="status">Device Status:</label>
            <div class="status-container">
                <select name="status" id="status" required>
                    <option value="On">On</option>
                    <option value="Off">Off</option>
                </select>

                <!-- Display status indicator -->
                <div class="status-indicator">
                    <span class="status-light on"></span>
                    On
                </div>
            </div>

            <!-- Brightness -->
            <label for="brightness">Brightness (0-100):</label>
            <input type="number" name="brightness" id="brightness" min="0" max="100">

            <!-- Threshold -->
            <label for="threshold">Threshold (0-100):</label>
            <input type="number" name="threshold" id="threshold" min="0" max="100">

            <button type="submit">Save Device</button>
        </form>
    </div>
</body>
</html>
