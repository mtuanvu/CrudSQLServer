<?php
global $conn;
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_student'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];

    $sql = "INSERT INTO students (id, name, address) VALUES ('$id', '$name', '$address')";
    $conn->query($sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_subject'])) {
    $subject_name = $_POST['subject_name'];

    $sql = "INSERT INTO subjects (name) VALUES ('$subject_name')";
    $conn->query($sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_mark'])) {
    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];
    $mark = $_POST['marks'];

    $sql = "INSERT INTO marks (student_id, subject_id, mark) VALUES ('$student_id', '$subject_id', '$mark')";
    $conn->query($sql);
}

$sql_students = "SELECT * FROM students";
$result_students = $conn->query($sql_students);

$sql_subjects = "SELECT * FROM subjects";
$result_subjects = $conn->query($sql_subjects);


$sql_marks = "SELECT marks.id, students.name as student_name, subjects.name as subject_name, mark FROM marks
            JOIN students ON marks.student_id = students.id
            JOIN subjects ON marks.subject_id = subjects.id";

$result_marks = $conn->query($sql_marks);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Mananger</title>
</head>

<body>
    <h2>Add Student</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        ID: <input type="text" name="id" required />
        Name: <input type="text" name="name" required />
        Address: <input type="text" name="address" required />
        <input type="submit" name="add_student" value="Add">
    </form>

    <h2>Add Subject</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        Name Subject: <input type="text" name="name" required />
        <input type="submit" name="add_subject" value="Add">
    </form>

    <h2>Add Mark</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" />
    Student:
    <select name="student_id">
        <?php while ($row = $result_students->fetch_assoc()) : ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
        <?php endwhile; ?>
    </select>
    Subject:
    <select name="subject_id">
        <?php while ($row = $result_subjects->fetch_assoc()) : ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
        <?php endwhile; ?>
    </select>
    Mark: <input type="text" name="marks" required>
    <input type="submit" name="add_mark" value="Add">
    </form>
    <h2>List of student marks</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Student</th>
            <th>Subject</th>
            <th>Mark</th>
        </tr>
        <?php while ($row = $result_marks->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['student_name']; ?></td>
                <td><?php echo $row['subject_name']; ?></td>
                <td><?php echo $row['mark']; ?></td>
            </tr>
        <?php endwhile; ?>
</body>

</html>