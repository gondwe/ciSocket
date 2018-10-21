<?php


$good = "50";
$bad = "50`";


$res =  preg_replace("/\D/","", $good);