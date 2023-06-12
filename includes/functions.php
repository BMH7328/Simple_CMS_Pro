<?php

function connectToDB() {
    $host = 'mysql';
    $dbname = 'php_docker';
    $dbuser = 'root';
    $dbpassword = 'secret';

    $database = new PDO (
        "mysql:host=$host;dbname=$dbname",
        $dbuser,
        $dbpassword
    );

    return $database;
}

// function to check if the user is currently logged in or not
function isUserLoggedIn() {
    return isset( $_SESSION['user'] ) ? true : false;
}

// function to check if the user is an admin
function isAdmin() {
    if ( isset( $_SESSION['user']['role'] ) && $_SESSION['user']['role'] === 'admin' ) {
        return true;
    } else {
        return false;
    }
}

function isEditor() {
    if ( isset( $_SESSION['user']['role'] ) && $_SESSION['user']['role'] === 'editor' ) {
        return true;
    } else {
        return false;
    }
}

function isUser() {
    if ( isset( $_SESSION['user']['role'] ) && $_SESSION['user']['role'] === 'user' ) {
        return true;
    } else {
        return false;
    }
}

function isAdminOrEditor() {
    return isAdmin() || isEditor() ? true : false;
}

function isEditorOrUser() {
    return isUser() || isEditor() ? true : false;
}