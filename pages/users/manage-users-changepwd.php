<?php

  // check if the current user is an admin or not
  if ( !Auth::isAdmin() ) {
    // if current user is not an admin, redirect to dashboard
    header("Location: /dashboard");
    exit;
  }

  // make sure the id parameter in the url is belongs to a valid user in the database
  if ( isset( $_GET['id'] ) ) {

    $database = connectToDB();

    $sql = "SELECT * FROM users WHERE id = :id";
    $query = $database->prepare( $sql );
    $query->execute([
        'id' => $_GET['id']
    ]);

    $user = $query->fetch();

    // if is not a valid user, redirect back to /manage-users
    if (!$user) {
      header("Location:/manage-users");
      exit;
    }

  } else {
    header("Location: /manage-users");
    exit;
  }

  require "parts/header.php";
?>
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Change Password</h1>
      </div>
      <div class="card mb-2 p-4">
        <!--
          Setup the form
          1. add method
          2. add action
          3. add name for the input fields
          4. pass in id as input hidden field
          5. add the error message
        -->
        <form method="POST" action="users/changepwd">
          <?php require "parts/message_error.php";?>
          <div class="mb-3">
            <div class="row">
              <div class="col">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" />
              </div>
              <div class="col">
                <label for="confirm-password" class="form-label"
                  >Confirm Password</label
                >
                <input
                  type="password"
                  class="form-control"
                  id="confirm-password"
                  name="confirm_password"
                />
              </div>
            </div>
          </div>
          <div class="d-grid">
            <input type="hidden" name="id" value="<?= $user['id']; ?>"/>
            <button type="submit" class="btn btn-primary">
              Change Password
            </button>
          </div>
        </form>
      </div>
      <div class="text-center">
        <a href="/manage-users" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Users</a
        >
      </div>
    </div>

<?php
  require "parts/footer.php";
