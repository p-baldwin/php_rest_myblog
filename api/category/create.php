<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Category Object
    $category = new Category($db);

    // Get Raw User Input Data
    $data = json_decode(file_get_contents("php://input"));

    // Assign Input from User to the New Category
    $category->id = $data->id;
    $category->name = $data->name;

    // Create Category
    if($category->create()) {
        echo json_encode(
            array('message' => 'Category Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Category Not Created')
        );
    }