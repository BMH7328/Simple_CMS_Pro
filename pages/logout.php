<?php

    // remove user session
    unset( $_SESSION['user'] );

    // redirect the user back to index.php
    header("Location: /");
    exit;
