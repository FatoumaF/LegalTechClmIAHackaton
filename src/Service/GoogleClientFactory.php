<?php
// src/Service/GoogleCalendarService.php
namespace App\Service;

use Google_Client;
use Google_Service_Calendar;

class GoogleClientFactory
{
    public function createClient(): Google_Client
    {
        $client = new Google_Client();
        
        // Chemin vers ton fichier client_secret.json
        $clientSecretPath = __DIR__.'/../../config/secrets/client_secret.json';
        
        // Charger le fichier JSON
        $client->setAuthConfig($clientSecretPath);
        
        // Définir les scopes requis
        $client->setScopes(['https://www.googleapis.com/auth/calendar.readonly']);
        $client->setRedirectUri('http://localhost/oauth2callback'); // Assure-toi que cette URI correspond à celle configurée dans Google Cloud

        return $client;
    }
}
