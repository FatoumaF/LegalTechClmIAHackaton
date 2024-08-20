<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class RegistrationFormTest extends WebTestCase
{
    public function testRegistrationFormSubmission(): void
    {
        $client = static::createClient();

        // Accédez à la page d'inscription
        $crawler = $client->request('GET', '/register');

        // Vérifiez que la page est chargée correctement
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'M\'inscrire'); // Vérifie le titre de la page

        // Soumettez le formulaire avec des données valides
        $form = $crawler->selectButton("M'inscrire")->form([
            'registration_form[username]' => 'testuser',
            'registration_form[email]' => 'test@example.com',
            'registration_form[plainPassword][first]' => 'password123',
            'registration_form[plainPassword][second]' => 'password123',
            'registration_form[agreeTerms]' => true,
        ]);

        $client->submit($form);

        // Vérifiez la réponse pour s'assurer que la soumission a réussi
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND); // HTTP 302 pour une redirection
        $this->assertTrue($client->getResponse()->isRedirect('/login')); // Vérifiez que la redirection se fait vers la page de login

        // Vous pouvez également vérifier si l'utilisateur a été enregistré dans la base de données
        $entityManager = self::getContainer()->get('doctrine')->getManager();
        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => 'test@example.com']);
        $this->assertNotNull($user);
        $this->assertEquals('testuser', $user->getUsername());
    }
}
