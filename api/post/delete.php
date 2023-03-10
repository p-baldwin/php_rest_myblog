<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    // Instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Blog Post Object
    $post = new Post($db);

    // Get Raw Posted Data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID of Post to Delete
    $post->id = $data->id;

    // Delete Post
    if($post->delete()) {
        echo json_encode(
            array('message' => 'Post Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Post Not Deleted')
        );
    }