<?php

class Faculty
{
    private $conn;
    private $table = "faculty";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // READ - Get all faculty
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ - Get one faculty
    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // CREATE
    public function create(
        $first_name,
        $middle_name,
        $last_name,
        $age,
        $gender,
        $address,
        $position,
        $salary
    ) {
        $query = "INSERT INTO faculty
                  (first_name, middle_name, last_name, age, gender,
                   address, position, salary)
                  VALUES
                  (:first_name, :middle_name, :last_name, :age, :gender,
                   :address, :position, :salary)";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ":first_name" => $first_name,
            ":middle_name" => $middle_name,
            ":last_name" => $last_name,
            ":age" => $age,
            ":gender" => $gender,
            ":address" => $address,
            ":position" => $position,
            ":salary" => $salary
        ]);
    }

    // UPDATE
    public function update(
        $id,
        $first_name,
        $middle_name,
        $last_name,
        $age,
        $gender,
        $address,
        $position,
        $salary
    ) {
        $query = "UPDATE faculty SET
                    first_name = :first_name,
                    middle_name = :middle_name,
                    last_name = :last_name,
                    age = :age,
                    gender = :gender,
                    address = :address,
                    position = :position,
                    salary = :salary
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ":id" => $id,
            ":first_name" => $first_name,
            ":middle_name" => $middle_name,
            ":last_name" => $last_name,
            ":age" => $age,
            ":gender" => $gender,
            ":address" => $address,
            ":position" => $position,
            ":salary" => $salary
        ]);
    }

    // DELETE
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ":id" => $id
        ]);
    }
}
?>