<?php

include "db.php";

if (!isset($_GET["student_id"])) {

    die("Student ID is required.");

}

$student_id = $_GET["student_id"];

$stmt = $conn->prepare(
    "SELECT * FROM students WHERE student_id = ?"
);

$stmt->bind_param("s", $student_id);

$stmt->execute();

$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html>

<head>

    <title>Search Result</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="table-container">

<h1>Search Result</h1>

<?php if ($result->num_rows > 0) { ?>

<table>

<tr>

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

<?php

$row = $result->fetch_assoc();

$birthDate = new DateTime($row["birth_date"]);
$today = new DateTime();

$age = $today->diff($birthDate)->y;

?>

<tr>

<td><?php echo htmlspecialchars($row["student_id"]); ?></td>

<td>
<?php
echo htmlspecialchars(
    $row["first_name"] . " " .
    $row["middle_name"] . " " .
    $row["last_name"]
);
?>
</td>

<td><?php echo htmlspecialchars($row["department"]); ?></td>

<td><?php echo htmlspecialchars($row["batch"]); ?></td>

<td><?php echo htmlspecialchars($row["year"]); ?></td>

<td><?php echo htmlspecialchars($row["semester"]); ?></td>

<td><?php echo htmlspecialchars($row["email"]); ?></td>

<td><?php echo htmlspecialchars($row["phone"]); ?></td>

<td><?php echo htmlspecialchars($row["gender"]); ?></td>

<td><?php echo htmlspecialchars($row["birth_date"]); ?></td>

<td><?php echo $age; ?></td>

</tr>

</table>

<?php } else { ?>

<h2>No student found!</h2>

<?php } ?>

<br>

<a href="view.php" class="add-btn">
    Back to All Students
</a>

</div>

</body>

</html>