<?php
    require "parts/header.php";
?>

    <div class="card rounded shadow-sm mx-auto my-4" style="max-width: 500px;">
        <div class="card-body">
            <h3 class="card-title mb-3">Login to your account</h3>
            <?php require "parts/message_error.php";?>
              
            <form action="auth/login" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-fu">Login</button>
                </div>
            </form>
        </div>
    </div>
  <?php

  require "parts/footer.php";