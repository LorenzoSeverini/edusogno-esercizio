<?php
// logout controller
session_start();

session_unset();
session_destroy();

header("Location: ../public/index.php");
exit();
