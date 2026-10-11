<?php

include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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



    $imageName = "";

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {

        $imageName = time() . "_" . basename($_FILES["image"]["name"]);

        $target = "uploads/" . $imageName;

        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target)) {

            die("Image upload failed!");

        }
    }


    

    $check = $conn->prepare(
        "SELECT student_id FROM students WHERE student_id = ?"
    );

    $check->bind_param("s", $student_id);

    $check->execute();

    $result = $check->get_result();

    if ($result->num_rows > 0) {

        die("Student ID already exists!");

    }


   

    $sql = "INSERT INTO students
            (
                student_id,
                first_name,
                middle_name,
                last_name,
                department,
                batch,
                year,
                semester,
                address,
                email,
                phone,
                gender,
                clubs,
                image,
                birth_date
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sssssssssssssss",
        $student_id,
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
        $birth_date
    );


    if ($stmt->execute()) {

        echo "<script>
                alert('Student information inserted successfully!');
                window.location='view.php';
              </script>";

    } else {

        echo "Error: " . $stmt->error;

    }

}

?>