<?php

require_once "controllers/FacultyController.php";

$controller = new FacultyController();

$action = $_GET["action"] ?? "index";

switch ($action) {

    case "create":
        $controller->create();
        break;

    case "edit":
        $id = $_GET["id"] ?? 0;
        $controller->edit($id);
        break;

    case "delete":
        $id = $_GET["id"] ?? 0;
        $controller->delete($id);
        break;

    default:
        $controller->index();
        break;
}
?>
