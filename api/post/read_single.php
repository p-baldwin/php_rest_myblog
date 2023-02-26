<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';
    
    // Instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Blog Post Object
    $post = new Post($db);

    // Get Post ID
    $post->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get Post
    $post->read_single();

    // Create Array
    $post_array = array(
        'id' => $post->id,
        'title' => $post->title,
        'body' => html_entity_decode($post->body),
        'author' => $post->author,
        'category_id' => $post->category_id,
        'category_name' => $post->category_name
    );

    // Turn into JSON and Output
    print_r(json_encode($post_array));
