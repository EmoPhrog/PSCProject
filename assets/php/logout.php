<?php
session_start();
session_unset();
session_destroy();

header("Location: /car_rental/assets/php/login.php");
exit;
