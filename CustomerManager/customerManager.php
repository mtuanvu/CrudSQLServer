<?php
global $conn;
include 'config.php';

// Add student
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["add_student"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $address = $_POST["address"];

    $sql = "INSERT INTO Students (id, name, address) VALUES ('$id', '$name', '$address')";
    $conn->query($sql);
}

// Add subject
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["add_subject"])) {
    $subject_name = $_POST["subject_name"];

    $sql = "INSERT INTO Subjects (name) VALUES ('$subject_name')";
    $conn->query($sql);
}

// Add mark
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["add_mark"])) {
    $student_id = $_POST["student_id"];
    $subject_id = $_POST["subject_id"];
    $marks = $_POST["marks"];

    $sql = "INSERT INTO Marks (student_id, subject_id, mark) VALUES ('$student_id', '$subject_id', '$marks')";
    $conn->query($sql);
}

// Get list of students
$sql_students = "SELECT * FROM Students";
$result_students = $conn->query($sql_students);

// Get list of subjects
$sql_subjects = "SELECT * FROM Subjects";
$result_subjects = $conn->query($sql_subjects);

// Get list of marks
$sql_marks = "SELECT Marks.id, Students.name as student_name, Subjects.name as subject_name FROM Marks 
              JOIN Students ON Marks.student_id = Students.id 
              JOIN Subjects ON Marks.subject_id = Subjects.id";
$result_marks = $conn->query($sql_marks);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
</head>

<body>
    <h2>Add student</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        ID: <input type="text" name="id" required>
        Name: <input type="text" name="name" required>
        Address: <input type="text" name="address" required>
        <input type="submit" name="add_student" value="Add">
    </form>

    <h2>Add subject</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        Subject name: <input type="text" name="subject_name" required>
        <input type="submit" name="add_subject" value="Add">
    </form>

    <h2>Add mark</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        Student name:
        <select name="student_id">
            <?php while ($row = $result_students->fetch_assoc()) : ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select>
        Subject name:
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
    </table>
</body>

</html>