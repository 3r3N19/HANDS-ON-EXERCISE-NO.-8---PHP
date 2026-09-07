<!DOCTYPE html>
<html>

<head>

    <title>Edit Faculty</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        .container {
            width: 500px;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 9px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .errors {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
        }

    </style>

</head>

<body>

<div class="container">

    <h2>Edit Faculty</h2>

    <?php if (!empty($errors)): ?>

        <div class="errors">

            <ul>

                <?php foreach ($errors as $error): ?>

                    <li><?= htmlspecialchars($error) ?></li>

                <?php endforeach; ?>

            </ul>

        </div>

    <?php endif; ?>


    <form method="POST">

        <label>First Name</label>

        <input
            type="text"
            name="first_name"
            value="<?= htmlspecialchars($_POST['first_name'] ?? $faculty['first_name']) ?>"
            maxlength="50"
            required
        >


        <label>Middle Name</label>

        <input
            type="text"
            name="middle_name"
            value="<?= htmlspecialchars($_POST['middle_name'] ?? $faculty['middle_name']) ?>"
            maxlength="50"
            required
        >


        <label>Last Name</label>

        <input
            type="text"
            name="last_name"
            value="<?= htmlspecialchars($_POST['last_name'] ?? $faculty['last_name']) ?>"
            maxlength="50"
            required
        >


        <label>Age</label>

        <input
            type="number"
            name="age"
            min="18"
            max="100"
            value="<?= htmlspecialchars($_POST['age'] ?? $faculty['age']) ?>"
            required
        >


        <label>Gender</label>

        <select name="gender" required>

            <option value="">Select Gender</option>

            <option value="Male"
                <?= (($_POST['gender'] ?? $faculty['gender']) === 'Male') ? 'selected' : '' ?>>
                Male
            </option>

            <option value="Female"
                <?= (($_POST['gender'] ?? $faculty['gender']) === 'Female') ? 'selected' : '' ?>>
                Female
            </option>

            <option value="Other"
                <?= (($_POST['gender'] ?? $faculty['gender']) === 'Other') ? 'selected' : '' ?>>
                Other
            </option>

        </select>


        <label>Address</label>

        <textarea
            name="address"
            rows="3"
            maxlength="255"
            required
        ><?= htmlspecialchars($_POST['address'] ?? $faculty['address']) ?></textarea>


        <label>Position</label>

        <input
            type="text"
            name="position"
            value="<?= htmlspecialchars($_POST['position'] ?? $faculty['position']) ?>"
            maxlength="100"
            required
        >


        <label>Salary</label>

        <input
            type="number"
            name="salary"
            min="0"
            step="0.01"
            value="<?= htmlspecialchars($_POST['salary'] ?? $faculty['salary']) ?>"
            required
        >


        <button type="submit">
            Update Faculty
        </button>

    </form>

    <br>

    <a href="index.php">
        ← Back to Faculty List
    </a>

</div>

</body>

</html>