<?php
error_reporting(0);
session_start();
ob_start();
if (!isset($_SESSION['userID'])) {
    header("location:form.html");
} else { //nothing
}
