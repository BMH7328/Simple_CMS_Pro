<?php

  $posts = Post::getPublishPosts();
  
  require "parts/header.php";
?>
    <div class="container mx-auto my-5" style="max-width: 500px;">
      <h1 class="h1 mb-4 text-center">My Blog</h1>
      <?php foreach ($posts as $post) : ?>
      <div class="card mb-2">
        <div class="card-body">
          <h5 class="card-title"><?= $post['title']; ?></h5>
          <p class="card-text"><?php 
            $excerpt = str_split( $post['content'], 100 );
            echo $excerpt[0] . "... read more"; 
          ?></p>
          <div class="text-end">
            <a href="/post?id=<?= $post['id']; ?>" class="btn btn-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>

      <div class="mt-4 d-flex justify-content-center gap-3">
      <?php if ( Auth::isUserLoggedIn() ) { ?>
            <a href="/dashboard" class='m-2 text-decoration-none'>Dashboard</a>
            <a href="/logout" class='m-2  text-decoration-none'>Logout</a>
          <?php } else { ?>
            <a href="/login" class='m-2 text-decoration-none'>Login</a>
            <a href="/signup" class='m-2 text-decoration-none'>Sign Up</a>
          <?php } ?>
      </div>
    </div>

<?php
    require 'parts/footer.php';
