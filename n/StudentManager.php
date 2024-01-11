<?php
class StudentManager
{
    private $conn;

    public function __construct()
    {
        $host = "localhost:3306";
        $username = "root";
        $password = "";
        $dbname = "testdbcrud";

        $this->conn = new mysqli($host, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connect failed: " . $this->conn->connect_error);
        }
    }
    public function getAllStudent()
    {
        $students = [];
        $sql = "SELECT * FROM students";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $students[] = $row;
            }
        }
        return $students;
    }

    public function addStudents($id, $name, $address)
    {
        $sql = "INSERT INTO students (id, name , address) VALUES ('$id', '$name', '$address')";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute()) {
            echo "Students with ID $id added successfully.\n";
        } else {
            echo "Error adding student: " . $stmt->error . "\n";
        }
        $stmt->close();
    }

    public function getStudentById($id)
    {
        $sql = "SELECT * from studetns where id ='$id'";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        }

        return null;
    }

    public function updateStudents($id, $name, $address)
    {
        $sql = "UPDATE students SET name ='$name', address = '$address' Where id ='$id";
        $this->conn->query($sql);
    }
    public function deleteStudent($id)
    {
        $sql = "DELETE FROM students WHERE id = '$id'";
        $result = $this->conn->prepare($sql);
        $result->execute();
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}
