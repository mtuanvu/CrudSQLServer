<?php

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'StudentManager.php';
    $studentManager = new StudentManager();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM account WHERE username = ? AND password = ?";
    $stmt = $studentManager->conn->prepare($sql);
    $stmtt->bind_param('ss', $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows  == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];

        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Đăng nhập không thành công vui lòng kiểm tra lại tên đăng nhập";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Login</h2>
        <?php
        if (isset($error_message)) {
            echo '<div class="alert alert-danger">' . $error_message . '</div>';
        }
        ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
        </form>
        <form method="post" action="">
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>

</html>