<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Blog Post Object
    $category = new Category($db);

    // Get Raw Category Data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID of Category to Update
    $category->id = $data->id;

    // Assign Input from User to Update the Specific Category
    $category->name = $data->name;

    // Update Category
    if($category->update()) {
        echo json_encode(
            array('message' => 'Category Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Category Not Updated')
        );
    }