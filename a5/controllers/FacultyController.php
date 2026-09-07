<?php

require_once "config/database.php";
require_once "models/Faculty.php";

class FacultyController
{
    private $faculty;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();

        $this->faculty = new Faculty($db);
    }

    // Display all faculty
    public function index()
    {
        $faculty = $this->faculty->getAll();

        require "views/faculty/index.php";
    }

    // CREATE
    public function create()
    {
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $data = $this->validate($_POST);

            $errors = $data["errors"];

            if (empty($errors)) {

                $this->faculty->create(
                    $data["first_name"],
                    $data["middle_name"],
                    $data["last_name"],
                    $data["age"],
                    $data["gender"],
                    $data["address"],
                    $data["position"],
                    $data["salary"]
                );

                header("Location: index.php");
                exit();
            }
        }

        require "views/faculty/create.php";
    }

    // UPDATE
    public function edit($id)
    {
        $faculty = $this->faculty->getById($id);

        if (!$faculty) {
            die("Faculty not found.");
        }

        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $data = $this->validate($_POST);

            $errors = $data["errors"];

            if (empty($errors)) {

                $this->faculty->update(
                    $id,
                    $data["first_name"],
                    $data["middle_name"],
                    $data["last_name"],
                    $data["age"],
                    $data["gender"],
                    $data["address"],
                    $data["position"],
                    $data["salary"]
                );

                header("Location: index.php");
                exit();
            }
        }

        require "views/faculty/edit.php";
    }

    // DELETE
    public function delete($id)
    {
        $this->faculty->delete($id);

        header("Location: index.php");
        exit();
    }

    // VALIDATION
    private function validate($post)
    {
        $errors = [];

        $first_name = trim($post["first_name"] ?? "");
        $middle_name = trim($post["middle_name"] ?? "");
        $last_name = trim($post["last_name"] ?? "");
        $age = trim($post["age"] ?? "");
        $gender = trim($post["gender"] ?? "");
        $address = trim($post["address"] ?? "");
        $position = trim($post["position"] ?? "");
        $salary = trim($post["salary"] ?? "");


        // First Name
        if ($first_name === "") {
            $errors[] = "First Name is required.";
        } elseif (!preg_match("/^[a-zA-Z\s'-]+$/", $first_name)) {
            $errors[] = "First Name contains invalid characters.";
        }


        // Middle Name
        if ($middle_name === "") {
            $errors[] = "Middle Name is required.";
        } elseif (!preg_match("/^[a-zA-Z\s'-]+$/", $middle_name)) {
            $errors[] = "Middle Name contains invalid characters.";
        }


        // Last Name
        if ($last_name === "") {
            $errors[] = "Last Name is required.";
        } elseif (!preg_match("/^[a-zA-Z\s'-]+$/", $last_name)) {
            $errors[] = "Last Name contains invalid characters.";
        }


        // Age
        if ($age === "") {
            $errors[] = "Age is required.";
        } elseif (!filter_var($age, FILTER_VALIDATE_INT)) {
            $errors[] = "Age must be a whole number.";
        } elseif ($age < 18 || $age > 100) {
            $errors[] = "Age must be between 18 and 100.";
        }


        // Gender
        if (!in_array($gender, ["Male", "Female", "Other"])) {
            $errors[] = "Please select a valid gender.";
        }


        // Address
        if ($address === "") {
            $errors[] = "Address is required.";
        }


        // Position
        if ($position === "") {
            $errors[] = "Position is required.";
        }


        // Salary
        if ($salary === "") {
            $errors[] = "Salary is required.";
        } elseif (!is_numeric($salary)) {
            $errors[] = "Salary must be a valid number.";
        } elseif ($salary < 0) {
            $errors[] = "Salary cannot be negative.";
        }


        return [
            "errors" => $errors,
            "first_name" => htmlspecialchars($first_name),
            "middle_name" => htmlspecialchars($middle_name),
            "last_name" => htmlspecialchars($last_name),
            "age" => htmlspecialchars($age),
            "gender" => htmlspecialchars($gender),
            "address" => htmlspecialchars($address),
            "position" => htmlspecialchars($position),
            "salary" => htmlspecialchars($salary)
        ];
    }
}
?>
