<?php
    session_start();

    // require all the functions files
    require "includes/class-db.php";
    require "includes/class-auth.php";
    require "includes/class-user.php";
    require "includes/class-post.php";
    require "includes/class-comment.php";
    
    // require "includes/functions.php";

    // your website path
    // parse_url will remove all the query string starting from the ?
    $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    // remove / using trim()
    $path = trim( $path, '/');

    switch ($path) {
        case 'auth/login':
            Auth::login();
            break;
        case 'auth/signup':
            Auth::signup();
            break;
        case "users/add":
            User::add();
            break;
        case "users/edit":
            User::edit();
            break;
        case "users/changepwd":
            User::changepwd();
            break;
        case "users/delete":
            User::delete();
            break;
        case "posts/add":
            Post::add();
            break;
        case "posts/edit":
            Post::edit();
            break;
        case "posts/delete":
            Post::delete();
            break;
        case "comments/add":
            Comment::add();
            break;
        case 'dashboard': //condition
            require "pages/dashboard.php";
            break;
        case 'login': //condition
            require "pages/login.php";
            break;
        case 'logout': //condition
            Auth::logout();
            break;
        case 'manage-posts': //condition
            require "pages/posts/manage-posts.php";
            break;
        case 'manage-posts-add': //condition
            require "pages/posts/manage-posts-add.php";
            break;
        case 'manage-posts-edit': //condition
            require "pages/posts/manage-posts-edit.php";
            break;
        case 'manage-users': //condition
            require "pages/users/manage-users.php";
            break;
        case 'manage-users-add': //condition
            $_SESSION["title"] = "Add New User";
            require "pages/users/manage-users-add.php";
            break;
        case 'manage-users-changepwd': //condition
            require "pages/users/manage-users-changepwd.php";
            break;
        case 'manage-users-edit': //condition
            require "pages/users/manage-users-edit.php";
            break;
        case 'signup':
            require "pages/signup.php";
            break;
        case 'post':
            require "pages/post.php";
            break;
        default:
            require "pages/home.php";
            break;
    }
?>