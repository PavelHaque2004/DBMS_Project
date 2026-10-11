<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Information Form</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>CSTU Student Information Form</h1>

    <form action="save.php" method="POST"
          enctype="multipart/form-data"
          onsubmit="return validateForm()">

       
        <label>First Name</label>
        <input type="text" name="first_name" required>

      
        <label>Middle Name (Optional)</label>
        <input type="text" name="middle_name">

       
        <label>Last Name</label>
        <input type="text" name="last_name" required>

       
        <label>Student ID</label>
        <input type="text" name="student_id" required>

        
        <label>Department</label>
        <select name="department" required>
            <option value="">Select Department</option>
            <option value="ICT">ICT</option>
            <option value="CSE">CSE</option>
           <option value="BBA">BBA</option>
        </select>

        
        <label>Batch</label>
        <select name="batch" required>
            <option value="">Select Batch</option>
            <option value="1st">1st</option>
            <option value="2nd">2nd</option>
            <option value="3rd">3rd</option>
            <option value="4th">4th</option>
            <option value="5th">5th</option>
        </select>

       
        <label>Year</label>
        <select name="year" required>
            <option value="">Select Year</option>
            <option value="1st Year">1st Year</option>
            <option value="2nd Year">2nd Year</option>
            <option value="3rd Year">3rd Year</option>
            <option value="4th Year">4th Year</option>
        </select>

        
        <label>Semester</label>
        <select name="semester" required>
            <option value="">Select Semester</option>
            <option value="1st Semester">1st Semester</option>
            <option value="2nd Semester">2nd Semester</option>
        </select>

        
        <label>Address</label>
        <textarea name="address" rows="4"></textarea>

        
        <label>Email</label>
        <input type="email" name="email" required>

        
        <label>Phone Number</label>
        <input type="tel" name="phone" required>

        
        <label>Gender</label>

        <div class="radio-group">

            <label>
                <input type="radio" name="gender" value="Male" required>
                Male
            </label>

            <label>
                <input type="radio" name="gender" value="Female">
                Female
            </label>

            <label>
                <input type="radio" name="gender" value="Other">
                Other
            </label>

        </div>

       
        <label>Club Membership</label>

        <div class="checkbox-group">

            <label>
                <input type="checkbox" name="clubs[]" value="Programming Club">
                Programming Club
            </label>

            <label>
                <input type="checkbox" name="clubs[]" value="Debate Club">
                Debate Club
            </label>

            <label>
                <input type="checkbox" name="clubs[]" value="Sports Club">
                Sports Club
            </label>

            <label>
                <input type="checkbox" name="clubs[]" value="Cultural Club">
                Cultural Club
            </label>

            <label>
                <input type="checkbox" name="clubs[]" value="Photography Club">
                Photography Club
            </label>

            <label>
                <input type="checkbox" name="clubs[]" value="Robotics Club">
                Robotics Club
            </label>

        </div>

        
        <label>Student Image</label>
        <input type="file" name="image" accept="image/*" required>

       
        <label>Birth Date</label>
        <input type="date" name="birth_date" required>

        
        <label>Captcha</label>

        <div class="captcha-box">
            <span id="captcha"></span>
            <button type="button" onclick="generateCaptcha()">↻</button>
        </div>

        <input type="text" id="captchaInput"
               placeholder="Enter Captcha"
               required>

       
        <div class="terms">

            <label>
                <input type="checkbox" id="terms" required>
                I agree to the Terms and Conditions
            </label>

        </div>

        
        <button type="submit" class="submit-btn">
            Submit
        </button>

    </form>

    <div class="links">

        <a href="view.php">View All Students</a>

    </div>

</div>

<script src="script.js"></script>

</body>
</html>