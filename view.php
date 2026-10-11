<?php

include "db.php";

$sql = "SELECT * FROM students ORDER BY student_id";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>All Students</title>

    <link rel="stylesheet"
          href="style.css">

</head>

<body>

<div class="table-container">

    <h1>All Student Information</h1>


    

    <form action="search.php"
          method="GET"
          class="search-box">

        <input
            type="text"
            name="student_id"
            placeholder="Search by Student ID"
            required
        >

        <button type="submit">
            Search
        </button>

    </form>


   

    <a href="index.php"
       class="add-btn">

        + Add New Student

    </a>

    <br><br>


    <table>

        <tr>

            <th>Image</th>

            <th>Student ID</th>

            <th>Name</th>

            <th>Department</th>

            <th>Batch</th>

            <th>Year</th>

            <th>Semester</th>

            <th>Email</th>

            <th>Phone</th>

            <th>Gender</th>

            <th>Clubs</th>

            <th>Birth Date</th>

            <th>Age</th>

            <th>Action</th>

        </tr>


        <?php if ($result && $result->num_rows > 0) { ?>


            <?php while ($row = $result->fetch_assoc()) { ?>

                <tr>


                    

                    <td>

                        <?php

                        $imagePath =
                            "uploads/" . $row["image"];

                        ?>

                        <?php if (
                            !empty($row["image"]) &&
                            file_exists($imagePath)
                        ) { ?>

                            <img
                                src="<?php echo htmlspecialchars($imagePath); ?>"
                                width="70"
                                height="70"
                                alt="Student Image"
                                style="
                                    object-fit: cover;
                                    border-radius: 8px;
                                "
                            >

                        <?php } else { ?>

                            No Image

                        <?php } ?>

                    </td>


                    

                    <td>

                        <?php

                        echo htmlspecialchars(
                            $row["student_id"]
                        );

                        ?>

                    </td>


                    

                    <td>

                        <?php

                        $fullName =
                            trim(
                                $row["first_name"] . " " .
                                $row["middle_name"] . " " .
                                $row["last_name"]
                            );

                        echo htmlspecialchars($fullName);

                        ?>

                    </td>


                    

                    <td>

                        <?php

                        echo htmlspecialchars(
                            $row["department"]
                        );

                        ?>

                    </td>


                    

                    <td>

                        <?php

                        echo htmlspecialchars(
                            $row["batch"]
                        );

                        ?>

                    </td>


                    

                    <td>

                        <?php

                        echo htmlspecialchars(
                            $row["year"]
                        );

                        ?>

                    </td>


                    

                    <td>

                        <?php

                        echo htmlspecialchars(
                            $row["semester"]
                        );

                        ?>

                    </td>


                   

                    <td>

                        <?php

                        echo htmlspecialchars(
                            $row["email"]
                        );

                        ?>

                    </td>


                    

                    <td>

                        <?php

                        echo htmlspecialchars(
                            $row["phone"]
                        );

                        ?>

                    </td>


                   

                    <td>

                        <?php

                        echo htmlspecialchars(
                            $row["gender"]
                        );

                        ?>

                    </td>


                   

                    <td>

                        <?php

                        echo htmlspecialchars(
                            $row["clubs"]
                        );

                        ?>

                    </td>


                  

                    <td>

                        <?php

                        echo htmlspecialchars(
                            $row["birth_date"]
                        );

                        ?>

                    </td>


                 

                    <td>

                        <?php

                        if (!empty($row["birth_date"])) {

                            try {

                                $birthDate =
                                    new DateTime(
                                        $row["birth_date"]
                                    );

                                $today =
                                    new DateTime();

                                echo $today
                                    ->diff($birthDate)
                                    ->y;

                            } catch (Exception $e) {

                                echo "N/A";

                            }

                        } else {

                            echo "N/A";

                        }

                        ?>

                    </td>



<td class="action-buttons">

    <a
        href="edit.php?id=<?php echo urlencode($row['student_id']); ?>"
        class="edit"
    >Edit</a>

    <a
        href="delete.php?id=<?php echo urlencode($row['student_id']); ?>"
        class="delete"
        onclick="return confirm('Are you sure you want to delete this student?');"
    >Delete</a>

</td>





                </tr>

            <?php } ?>


        <?php } else { ?>


            <tr>

                <td colspan="14">

                    No student information found.

                </td>

            </tr>


        <?php } ?>


    </table>

</div>

</body>

</html>