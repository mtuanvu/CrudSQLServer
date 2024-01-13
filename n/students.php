<?php
include './StudentManager.php';

$studentManager = new StudentManager();
$students = $studentManager->getAllStudent();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
    <form action="" method="POST">
        <div class="container mt-5">
            <h2>Student List</h2>
            <a href="add_student.php" class="btn btn-success mb-3">Add Student</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($students as $student) : ?>
                        <?php
                        echo "
                                <input type='hidden' value='" . $student['id'] . "' name='".$student['id']."'>
                                "; ?>
                        <tr>
                            <td><?php echo $student['id']; ?></td>
                            <td><?php echo $student['name']; ?></td>
                            <td><?php echo $student['address']; ?></td>
                            <td>
                                <input type="submit" name='btnDelete' value="Delete">
                            </td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </form>
    <?php
    if (isset($_GET['btnDelete'])) {
        $studentManager->deleteStudent($student['id']);
    }
    ?>

</body>

</html>