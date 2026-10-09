<?php

include "db.php";

$id = $_GET["id"];

$stmt = $conn->prepare(
    "SELECT * FROM students WHERE student_id = ?"
);

$stmt->bind_param("s", $id);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {

    die("Student not found!");

}

$row = $result->fetch_assoc();

$clubs = explode(", ", $row["clubs"]);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Update Student</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

<h1>Update Student Information</h1>

<form action="update.php" method="POST"
      enctype="multipart/form-data">

<input type="hidden"
       name="student_id"
       value="<?php echo htmlspecialchars($row["student_id"]); ?>">

<label>First Name</label>

<input type="text"
       name="first_name"
       value="<?php echo htmlspecialchars($row["first_name"]); ?>"
       required>


<label>Middle Name</label>

<input type="text"
       name="middle_name"
       value="<?php echo htmlspecialchars($row["middle_name"]); ?>">


<label>Last Name</label>

<input type="text"
       name="last_name"
       value="<?php echo htmlspecialchars($row["last_name"]); ?>"
       required>


<label>Student ID</label>

<input type="text"
       value="<?php echo htmlspecialchars($row["student_id"]); ?>"
       disabled>


<label>Department</label>

<select name="department" required>

<option value="ICT"
<?php if ($row["department"]=="ICT") echo "selected"; ?>>
ICT
</option>

<option value="CSE"
<?php if ($row["department"]=="CSE") echo "selected"; ?>>
CSE
</option>

<option value="EEE"
<?php if ($row["department"]=="EEE") echo "selected"; ?>>
EEE
</option>

<option value="BBA"
<?php if ($row["department"]=="BBA") echo "selected"; ?>>
BBA
</option>

<option value="English"
<?php if ($row["department"]=="English") echo "selected"; ?>>
English
</option>

</select>


<label>Batch</label>

<select name="batch" required>

<?php

$batches = ["1st","2nd","3rd","4th","5th"];

foreach ($batches as $b) {

    $selected =
        ($row["batch"] == $b) ? "selected" : "";

    echo "<option value='$b' $selected>$b</option>";
}

?>

</select>


<label>Year</label>

<select name="year" required>

<?php

$years = [
    "1st Year",
    "2nd Year",
    "3rd Year",
    "4th Year"
];

foreach ($years as $y) {

    $selected =
        ($row["year"] == $y) ? "selected" : "";

    echo "<option value='$y' $selected>$y</option>";
}

?>

</select>


<label>Semester</label>

<select name="semester" required>

<option value="1st Semester"
<?php if ($row["semester"]=="1st Semester") echo "selected"; ?>>
1st Semester
</option>

<option value="2nd Semester"
<?php if ($row["semester"]=="2nd Semester") echo "selected"; ?>>
2nd Semester
</option>

</select>


<label>Address</label>

<textarea name="address"
          rows="4"><?php echo htmlspecialchars($row["address"]); ?></textarea>


<label>Email</label>

<input type="email"
       name="email"
       value="<?php echo htmlspecialchars($row["email"]); ?>"
       required>


<label>Phone</label>

<input type="tel"
       name="phone"
       value="<?php echo htmlspecialchars($row["phone"]); ?>"
       required>


<label>Gender</label>

<div class="radio-group">

<label>
<input type="radio"
       name="gender"
       value="Male"
       <?php if ($row["gender"]=="Male") echo "checked"; ?>>
Male
</label>

<label>
<input type="radio"
       name="gender"
       value="Female"
       <?php if ($row["gender"]=="Female") echo "checked"; ?>>
Female
</label>

<label>
<input type="radio"
       name="gender"
       value="Other"
       <?php if ($row["gender"]=="Other") echo "checked"; ?>>
Other
</label>

</div>


<label>Club Membership</label>

<div class="checkbox-group">

<?php

$clubList = [
    "Programming Club",
    "Debate Club",
    "Sports Club",
    "Cultural Club",
    "Photography Club",
    "Robotics Club"
];

foreach ($clubList as $club) {

    $checked =
        in_array($club, $clubs) ? "checked" : "";

    echo "
    <label>
        <input type='checkbox'
               name='clubs[]'
               value='$club'
               $checked>
        $club
    </label>
    ";
}

?>

</div>


<label>New Image (Optional)</label>

<input type="file"
       name="image"
       accept="image/*">


<label>Birth Date</label>

<input type="date"
       name="birth_date"
       value="<?php echo htmlspecialchars($row["birth_date"]); ?>"
       required>


<button type="submit"
        class="submit-btn">
Update Student
</button>

</form>

<br>

<a href="view.php">
Back to View
</a>

</div>

</body>

</html>