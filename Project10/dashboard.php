<?php
global $conn;
include './config.php';

//Thêm Sinh Viên
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_student'])) {
    $id = $_POST['id'];
    $name = $_POST["name"];
    $address = $_POST["address"];

    $sql = "INSERT INTO students (name, address) VALUES ('$id', '$name', '$address')";
    $conn->query($sql);
}
//Hiện Thị Danh Sách Sinh Viên
$sql_student = "SELECT * FROM students";
$result_student = $conn->query($sql_student);

//Hiện Thị Danh Sách Môn H
$sql = "SELECT * FROM students";
$result_subject = $conn->query($sql_subject);
//Thêm Môn Học
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_subject'])) {
}

//Thêm Điểm Cho Sinh Viên
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['add_mark'])) {
    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];
    $marks = $_POST['marks'];
    $sql = "INSERT INTO marks (student_id, subject_id, marks) VALUES('$student_id', '$subject_id', '$marks')";

    $conn->query($sql);
}


//Hiện Thị Thông Tin Sinh Viên


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Add Student</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        ID: <input type="text" name="id" required /><br>

        Name: <input type="text" name="name" required /><br>
        Address: <input type="text" name="address" required /><br>
        <input type="submit" name="add_student" value="Add">
    </form>

    <h2>Add Subject</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        Name Subject: <input type="text" name="name" required /><br>
        <input type="submit" name="add_subject" value="Add">
    </form>

    <h2>Add Mark</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" />
    Student:
    <select name="student_id">
        <?php while ($row = $result_student->fetch_assoc()) : ?>
            <option value="<?php echo $row['id']; ?><?php echo $row['name']; ?>"></option>
        <?php endwhile; ?>
    </select>
    Subject:
    <select name="subject_id">
        <?php while ($row = $result_student->fetch_assoc()) : ?>
            <option value="<?php echo $row['id']; ?><?php echo $row['name']; ?>"></option>
        <?php endwhile; ?>
    </select>
    Mark: <input type="text" name="marks" required>
    <input type="submit" name="add_mark" value="Add">
    </form>
</body>

</html>