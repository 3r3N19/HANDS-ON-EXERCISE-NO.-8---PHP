<?php

$host = "localhost";
$dbname = "personal_information";
$username = "root";
$password = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


if (isset($_POST['submit'])) {

    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $sql = "INSERT INTO persons (age, gender, email, address, contact)
            VALUES (:age, :gender, :email, :address, :contact)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':age' => $age,
        ':gender' => $gender,
        ':email' => $email,
        ':address' => $address,
        ':contact' => $contact
    ]);

    header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
    exit();
}



if (isset($_GET['delete'])) {

    $id = $_GET['delete'];

    $stmt = $pdo->prepare("DELETE FROM persons WHERE id = :id");
    $stmt->execute([':id' => $id]);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}


$stmt = $pdo->query("SELECT * FROM persons ORDER BY id DESC");
$persons = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>

    <title>Personal Information</title>

    <link rel="stylesheet" href="style.css">

    <style>

        .container {
            width: 80%;
            max-width: 900px;
            margin: 40px auto;
        }

        form {
            background: #f5f5f5;
            padding: 25px;
            border-radius: 10px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
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
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .success {
            margin: 20px 0;
            padding: 15px;
            background: #d4edda;
            color: #155724;
            border-radius: 5px;
        }

        .registered {
            margin-top: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        .delete {
            background: #dc3545;
            color: white;
            padding: 6px 10px;
            text-decoration: none;
            border-radius: 4px;
        }

        .delete:hover {
            background: #a71d2a;
        }

    </style>

</head>

<body>

<div class="container">

    <h2>Personal Information Form</h2>


    <?php if (isset($_GET['success'])): ?>

        <div class="success">
            Record successfully registered!
        </div>

    <?php endif; ?>


    <!-- ===============================
         PERSONAL INFORMATION FORM
         =============================== -->

    <form method="post">

        <label>Age</label>

        <input
            type="number"
            name="age"
            min="1"
            max="100"
            required
        >


        <label>Gender</label>

        <select name="gender" required>

            <option value="">Select Gender</option>

            <option value="Male">
                Male
            </option>

            <option value="Female">
                Female
            </option>

            <option value="Bading">
                Bading
            </option>

        </select>


        <label>Email</label>

        <input
            type="email"
            name="email"
            placeholder="example@email.com"
            required
        >


        <label>Address</label>

        <textarea
            name="address"
            rows="3"
            required
        ></textarea>


        <label>Contact Number</label>

        <input
            type="tel"
            name="contact"
            pattern="[0-9]{11}"
            placeholder="09XXXXXXXXX"
            maxlength="11"
            required
        >


        <button type="submit" name="submit">
            Submit
        </button>

    </form>


    <!-- ===============================
         REGISTERED PERSONS
         =============================== -->

    <div class="registered">

        <h2>List of Registered Person</h2>

        <?php if (count($persons) > 0): ?>

            <table>

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($persons as $person): ?>

                        <tr>

                            <td>
                                <?= htmlspecialchars($person['id']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($person['age']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($person['gender']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($person['email']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($person['address']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($person['contact']) ?>
                            </td>

                            <td>

                                <a
                                    class="delete"
                                    href="?delete=<?= $person['id'] ?>"
                                    onclick="return confirm('Are you sure you want to delete this record?');"
                                >
                                    Delete
                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        <?php else: ?>

            <p>No registered persons yet.</p>

        <?php endif; ?>

    </div>

</div>

</body>
</html>
