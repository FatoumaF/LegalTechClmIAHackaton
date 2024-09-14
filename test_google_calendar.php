<?php
require 'vendor/autoload.php';

use Google_Client;
use Google_Service_Calendar;

$client = new Google_Client();
$service = new Google_Service_Calendar($client);

echo "La classe Google_Service_Calendar est instanciée avec succès.";
