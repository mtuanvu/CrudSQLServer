<?php
include './StudentManager.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Add Student</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="id">ID</label>
                <input type="text" class="form-control" id="id" name="id" required>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <input type="submit" class="btn btn-primary" value="add student" name="btn" />
        </form>
        <?php
        $studentManager = new StudentManager();
        if (isset($_POST['btn'])) {
            if (isset($_POST['id'])) {
                $id = $_POST['$id'];
            }
            $name = $_POST['name'];
            $address = $_POST['address'];
            $studentManager->addStudents($id, $name, $address);
            header('Location: students.php');
            exit();
        }
        ?>
    </div>
</body>

</html>