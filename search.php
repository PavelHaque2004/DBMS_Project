
<?php

include "db.php";

if (!isset($_GET["student_id"]) || empty(trim($_GET["student_id"]))) {
    die("Student ID is required.");
}

$student_id = trim($_GET["student_id"]);


$stmt = $conn->prepare(
    "SELECT * FROM students WHERE student_id = ?"
);

$stmt->bind_param("s", $student_id);

$stmt->execute();

$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Search Result</title>

    <link rel="stylesheet" href="style.css">

    <style>

        .table-container {
            width: 95%;
            margin: 30px auto;
            overflow-x: auto;
        }

        .table-container h1 {
            text-align: center;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            white-space: nowrap;
        }

        table th {
            background-color: #333;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .student-image {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 5px;
        }

        .no-image {
            color: #777;
        }

        .message {
            text-align: center;
            margin: 20px;
            color: red;
        }

        .add-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .add-btn:hover {
            background-color: #0056b3;
        }

    </style>

</head>

<body>

<div class="table-container">

    <h1>Student Search Result</h1>

    <?php if ($result->num_rows > 0) { ?>

        <?php

        $row = $result->fetch_assoc();

       
        $age = "N/A";

        if (!empty($row["birth_date"]) &&
            $row["birth_date"] != "0000-00-00") {

            try {

                $birthDate = new DateTime($row["birth_date"]);
                $today = new DateTime();

                $age = $today->diff($birthDate)->y;

            } catch (Exception $e) {

                $age = "N/A";

            }
        }

        ?>

        <table>

            <thead>

                <tr>
                    <th>Picture</th>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Batch</th>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Birth Date</th>
                    <th>Age</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>

                        <?php

                        if (!empty($row["image"])) {

                            $imagePath = "uploads/" . $row["image"];

                            if (is_file($imagePath)) {

                                echo '<img
                                    src="' . htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8') . '"
                                    alt="Student Image"
                                    class="student-image">';

                            } else {

                                echo '<span class="no-image">Image Not Found</span>';

                            }

                        } else {

                            echo '<span class="no-image">No Image</span>';

                        }

                        ?>

                    </td>

                
                    <td>
                        <?php
                        echo htmlspecialchars($row["student_id"]);
                        ?>
                    </td>

             
                    <td>
                        <?php

                        $fullName = trim(
                            ($row["first_name"] ?? "") . " " .
                            ($row["middle_name"] ?? "") . " " .
                            ($row["last_name"] ?? "")
                        );

                        echo htmlspecialchars($fullName);

                        ?>
                    </td>

                 
                    <td>
                        <?php
                        echo htmlspecialchars($row["department"] ?? "");
                        ?>
                    </td>

               
                    <td>
                        <?php
                        echo htmlspecialchars($row["batch"] ?? "");
                        ?>
                    </td>

                  
                    <td>
                        <?php
                        echo htmlspecialchars((string)($row["year"] ?? ""));
                        ?>
                    </td>

               
                    <td>
                        <?php
                        echo htmlspecialchars((string)($row["semester"] ?? ""));
                        ?>
                    </td>

                   
                    <td>
                        <?php
                        echo htmlspecialchars($row["email"] ?? "");
                        ?>
                    </td>

                    <td>
                        <?php
                        echo htmlspecialchars($row["phone"] ?? "");
                        ?>
                    </td>

               
                    <td>
                        <?php
                        echo htmlspecialchars($row["gender"] ?? "");
                        ?>
                    </td>

                 
                    <td>
                        <?php
                        echo htmlspecialchars($row["birth_date"] ?? "");
                        ?>
                    </td>

               
                    <td>
                        <?php
                        echo htmlspecialchars((string)$age);
                        ?>
                    </td>

                </tr>

            </tbody>

        </table>

    <?php } else { ?>

        <h2 class="message">No student found!</h2>

    <?php } ?>

    <br>

    <a href="view.php" class="add-btn">
        Back to All Students
    </a>

</div>

</body>

</html>

<?php

$stmt->close();

?>

