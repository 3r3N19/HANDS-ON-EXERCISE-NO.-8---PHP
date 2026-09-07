<!DOCTYPE html>
<html>

<head>

    <title>Faculty Management</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        h1 {
            text-align: center;
        }

        .add-btn {
            display: inline-block;
            background: #28a745;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background: #007bff;
            color: white;
        }

        .edit {
            background: #ffc107;
            color: black;
            padding: 6px 10px;
            text-decoration: none;
            border-radius: 4px;
        }

        .delete {
            background: #dc3545;
            color: white;
            padding: 6px 10px;
            text-decoration: none;
            border-radius: 4px;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>Faculty Management</h1>

    <a class="add-btn" href="index.php?action=create">
        + Add Faculty
    </a>

    <?php if (count($faculty) > 0): ?>

        <table>

            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Position</th>
                <th>Salary</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($faculty as $row): ?>

                <tr>

                    <td><?= htmlspecialchars($row["id"]) ?></td>

                    <td><?= htmlspecialchars($row["first_name"]) ?></td>

                    <td><?= htmlspecialchars($row["middle_name"]) ?></td>

                    <td><?= htmlspecialchars($row["last_name"]) ?></td>

                    <td><?= htmlspecialchars($row["age"]) ?></td>

                    <td><?= htmlspecialchars($row["gender"]) ?></td>

                    <td><?= htmlspecialchars($row["address"]) ?></td>

                    <td><?= htmlspecialchars($row["position"]) ?></td>

                    <td>
                        ₱<?= number_format($row["salary"], 2) ?>
                    </td>

                    <td>

                        <a
                            class="edit"
                            href="index.php?action=edit&id=<?= $row["id"] ?>"
                        >
                            Edit
                        </a>

                        <a
                            class="delete"
                            href="index.php?action=delete&id=<?= $row["id"] ?>"
                            onclick="return confirm('Are you sure you want to delete this faculty?');"
                        >
                            Delete
                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        </table>

    <?php else: ?>

        <p>No faculty records found.</p>

    <?php endif; ?>

</div>

</body>
</html>