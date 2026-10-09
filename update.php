<?php

include "db.php";

if (!isset($_POST["student_id"])) {

    die("Student ID is required.");

}

$student_id = $_POST["student_id"];

$first_name = $_POST["first_name"];
$middle_name = $_POST["middle_name"];
$last_name = $_POST["last_name"];

$department = $_POST["department"];
$batch = $_POST["batch"];
$year = $_POST["year"];
$semester = $_POST["semester"];

$address = $_POST["address"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$gender = $_POST["gender"];

$birth_date = $_POST["birth_date"];


if (isset($_POST["clubs"])) {

    $clubs = implode(", ", $_POST["clubs"]);

} else {

    $clubs = "No Club";

}


/* Get old image */

$stmt = $conn->prepare(
    "SELECT image FROM students WHERE student_id = ?"
);

$stmt->bind_param("s", $student_id);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {

    die("Student not found!");

}

$oldData = $result->fetch_assoc();

$imageName = $oldData["image"];


/* New image */

if (isset($_FILES["image"]) &&
    $_FILES["image"]["error"] == 0) {

    $newImageName =
        time() . "_" .
        basename($_FILES["image"]["name"]);

    $target = "uploads/" . $newImageName;


    if (move_uploaded_file(
        $_FILES["image"]["tmp_name"],
        $target
    )) {

        /* Delete old image */

        if (!empty($imageName) &&
            file_exists("uploads/" . $imageName)) {

            unlink("uploads/" . $imageName);

        }

        $imageName = $newImageName;

    }

}


/* Update student */

$sql = "UPDATE students SET

        first_name = ?,
        middle_name = ?,
        last_name = ?,
        department = ?,
        batch = ?,
        year = ?,
        semester = ?,
        address = ?,
        email = ?,
        phone = ?,
        gender = ?,
        clubs = ?,
        image = ?,
        birth_date = ?

        WHERE student_id = ?";


$stmt = $conn->prepare($sql);


$stmt->bind_param(
    "sssssssssssssss",
    $first_name,
    $middle_name,
    $last_name,
    $department,
    $batch,
    $year,
    $semester,
    $address,
    $email,
    $phone,
    $gender,
    $clubs,
    $imageName,
    $birth_date,
    $student_id
);


if ($stmt->execute()) {

    echo "<script>

        alert('Student information updated successfully!');

        window.location='view.php';

    </script>";

} else {

    echo "Update Failed: " . $stmt->error;

}

?>