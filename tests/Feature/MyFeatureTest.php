<?php
namespace EasyAdmin\Tests\Feature;

use PHPUnit\Framework\TestCase;
use PDO;
use Symfony\Component\Dotenv\Dotenv;

class DatabaseConnectionTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        // Charger les variables d'environnement
        $dotenv = new Dotenv();
        $dotenv->load('/Users/macbook/Documents/HACKATON-LegalTech/legalTechClmProject/.env.test');

        // Obtenir la variable DATABASE_URL
        $dbUrl = getenv('DATABASE_URL');
        $parsedUrl = parse_url($dbUrl);

        $dbHost = $parsedUrl['host'];
        $dbName = ltrim($parsedUrl['path'], '/');
        $dbUser = $parsedUrl['user'];
        $dbPass = $parsedUrl['pass'];

        // Configuration du DSN pour PostgreSQL
        $dsn = "pgsql:host=$dbHost;dbname=$dbName";
        
        try {
            // Créer une instance PDO
            $this->pdo = new PDO($dsn, $dbUser, $dbPass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            // Échec de la connexion
            $this->fail('Failed to connect to the database: ' . $e->getMessage());
        }
    }

    public function testConnection()
    {
        // Vérifier que l'instance PDO est créée
        $this->assertInstanceOf(PDO::class, $this->pdo, 'PDO instance should be created');
    }

    public function testDatabaseCanQuery()
    {
        // Exécuter une requête simple pour vérifier la connexion
        $query = $this->pdo->query('SELECT 1');
        $result = $query->fetchColumn();

        // Vérifier que la requête retourne 1
        $this->assertEquals(1, $result, 'Database should return 1 for the query');
    }

    protected function tearDown(): void
    {
        // Fermer la connexion
        $this->pdo = null;
    }
}

