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

    // Blog post query
    $result = $post->read();

    // Get row count
    $numRows = $result->rowCount();

    // Check that there are posts
    if($numRows > 0) {
        // Post Array
        $posts_array = array();
        $posts_array['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $post_item = array(
                'id' => $id,
                'title' => $title,
                'body' => html_entity_decode($body),
                'author' => $author,
                'category_id' => $category_id,
                'category_name' => $category_name
            );

            // Push Data
            array_push($posts_array['data'], $post_item);
        }

        // Turn into JSON and Output
        echo json_encode($posts_array);
    } else {
        // No Posts
        echo json_encode(
            array('message' => 'No Posts Found')
        );
    }