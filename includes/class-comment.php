<?php

class Comment 
{

    public static function getCommentsByPostID( $post_id )
    {

        $database = new DB();

        return $database->fetchAll(
        "SELECT
        comments.*,
        users.name
        FROM comments
        JOIN users
        ON comments.user_id = users.id
        WHERE post_id = :post_id ORDER BY id DESC",
        [
        "post_id" => $post_id
        
        ]);

    }

    public static function add()
    {
        if ( !Auth::isUserLoggedIn() ) {
            header("Location: /");
            exit;
        }
    
        $database = new DB();
        $comments = $_POST['comments'];
        $post_id = $_POST['post_id'];
        $user_id = $_POST['user_id'];
    
        if ( empty( $comments ) || empty( $post_id ) || empty( $user_id ) ) {
            $error = "Please fill out the comment";
        }
        
        if( isset ($error)){
            $_SESSION['error'] = $error;
            header("Location: /post?id=$post_id" ); 
            exit;
        }
    
        $database->insert(
        "INSERT INTO comments (`comments`, `post_id`, `user_id`)
        VALUES(:comments, :post_id, :user_id)",
        [
            'comments' => $comments,
            'post_id' => $post_id,
            'user_id' => $user_id
        ]);
        
        header("Location: /post?id=$post_id" );
        exit;
    }
}