<?php

//ENDING SESSIONS AFTER LOGOUT

require 'core.php';
session_destroy();
header('Location: web/index.php ');

?>