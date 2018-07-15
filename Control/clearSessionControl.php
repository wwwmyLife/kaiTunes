<?php
include "../model.php";
include "../config.php";
if(!isset($_SESSION['userID'])){
    session_start();
    unset($_SESSION['userID']);
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

