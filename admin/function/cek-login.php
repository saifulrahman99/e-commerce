<?php
if ($_SESSION['status_login'] == false) {
header('location: login');   
}
