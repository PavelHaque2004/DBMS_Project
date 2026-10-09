<?php

include "db.php";

if (!isset($_GET["id"])) {

    die("Student ID is required.");

}

$id = $_GET["id"];

$stmt = $conn->prepare(
    "DELETE FROM students WHERE student_id = ?"
);

$stmt->bind_param("s", $id);

if ($stmt->execute()) {

    echo "<script>

        alert('Student deleted successfully!');

        window.location='view.php';

    </script>";

} else {

    echo "Delete failed!";

}

?>