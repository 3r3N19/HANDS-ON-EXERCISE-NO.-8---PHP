<!DOCTYPE html>
<html>
<head>
    <title>Personal Information</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Personal Information Form</h2>

    <form method="post">

        <label>Age</label>
        <input type="number" name="age" min="1" max="100" required>

        <label>Gender</label>
        <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Female">Bading</option>
        </select>

        <label>Email</label>
        <input type="email" name="email" placeholder="example@email.com" required>

        <label>Address</label>
        <textarea name="address" rows="3" required></textarea>

        <label>Contact Number</label>
        <input type="tel" name="contact" 
               pattern="[0-9]{11}" 
               placeholder="09XXXXXXXXX" 
               maxlength="11" required>

        <button type="submit" name="submit">Submit</button>

    </form>

    <?php
    if (isset($_POST['submit'])) {
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];

        echo "<div class='result'>";
        echo "<h3>Submitted Information</h3>";
        echo "<p><b>Age:</b> $age</p>";
        echo "<p><b>Gender:</b> $gender</p>";
        echo "<p><b>Email:</b> $email</p>";
        echo "<p><b>Address:</b> $address</p>";
        echo "<p><b>Contact Number:</b> $contact</p>";
        echo "</div>";
    }
    ?>

</div>

</body>
</html>