<?php

class Post
{

    public static function getPublishPosts()
    {
        $db = new DB();

        return $db->fetchAll(
            "SELECT * FROM posts 
            WHERE status = 'publish'
            ORDER BY id DESC"
        );
    }

    public static function getPostsByUserRole()
    {
        $db = new DB();

        if ( Auth::isAdmin()){
            $sql = "SELECT 
                posts.*, 
                users.name AS user_name,
                users.email AS user_email 
                FROM posts 
                JOIN users 
                ON posts.user_id = users.id";

            $posts = $db->fetchAll($sql);

        } else {
            $sql = "SELECT 
            posts.id, 
            posts.title, 
            posts.status, 
            users.name AS user_name,
            users.email AS user_email  
            FROM posts 
            JOIN users 
            ON posts.user_id = users.id 
            where posts.user_id = :user_id";

            $posts = $db->fetchAll(
                $sql,
                ['user_id' => $_SESSION["user"]["id"]]
            );
        }
    
        return $posts;
    }

    public static function getPostByID()
    {
        if ( isset( $_GET['id'] ) ) {

            $db = new DB();
    
            // make sure the post is published
            $post = $db->fetch(
                "SELECT * FROM posts WHERE id = :id",
                [
                    'id' => $_GET['id']
                ]
            );
    
            if ( !$post ) {
                // if post don't exists, then we redirect back to home
                header("Location: /");
                exit;
            }
            return $post;
    
        } else {
            // if $_GET['id'] is not available, then redirect the user back to home
            header("Location: /");
            exit;
        }
    }

    public static function add()
    {
        $db = new DB();

        $title = $_POST['title'];
        $content = $_POST['content'];
                
            
            if ( empty( $title ) || empty($content) ) {
                $error = 'All fields are required';
            }
        
            if( isset ($error)){
                $_SESSION['error'] = $error;
                header("Location: /manage-posts-add");    
            }

            
                $sql = "INSERT INTO posts (`title`, `content`, `user_id`)
                VALUES(:title, :content, :user_id)";
               $db->insert($sql , [
                    'title' => $title,
                    'content' => $content,
                    'user_id' => $_SESSION["user"]["id"]
                ]);

                $_SESSION["success"] = "New posts has been created.";
        
                header("Location: /manage-posts");
                exit;
        
    }

    public static function edit()
    {
        $db = new DB();

        $title = $_POST['title'];
        $content = $_POST['content'];
        $status = $_POST['status'];
        $id = $_POST['id'];
    
    
        if(empty($title) || empty($content) || empty($status) || empty($id) ){
            $error = "All fields is required";
        }
    
        if ( isset( $error ) ) {
            $_SESSION['error'] = $error;
            header("Location: /manage-posts-edit?id=$id");
            exit;
        }
    
        $db->update
        ("UPDATE posts SET title = :title, content = :content, status = :status WHERE id = :id",
        [
            'title' => $title,
            'content' => $content,
            'status' => $status,
            'id' => $id
        ]);
    
        // set success message
        $_SESSION["success"] = "Post has been edited success.";
    
        // redirect
        header("Location: /manage-posts");
        exit;   
    }

    public static function delete()
    {
        $db = new DB();

        $id = $_POST["id"];

        if (empty($id)){
            $error = "Error!";
        }
    
        // if error found, set error message & redirect back to the manage-users page
        if ( isset( $error ) ) {
            $_SESSION['error'] = $error;
            header("Location: /manage-posts");
            exit;
        }

        $db->delete(
            "DELETE FROM posts WHERE id = :id",
            [
                'id' => $id
            ]
        );
        
        $_SESSION["success"] = "Post has been deleted.";

        header("Location: /manage-posts");
        exit;
    }
}