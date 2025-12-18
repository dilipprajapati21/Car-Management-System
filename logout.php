<?php
session_start();
session_destroy();
header("Location: loginChoice.html");
exit();
?>