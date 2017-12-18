<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Entity\Gnome;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GnomesControllerTest extends WebTestCase
{

    public function setUp()
    {
        self::bootKernel();
        chdir(self::$kernel->getRootDir().DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'web');
        $container = self::$kernel->getContainer();
    }

    public function testCreateAction()
    {
        $client = static::createClient();

        // Test valid gnomes
        $validGnomes    = [];
        $validGnomes [] = ['name' => 'test', 'age' => 10, 'strength' => 70];
        $validGnomes [] = ['name' => 'test', 'age' => 0, 'strength' => 100];
        $validGnomes [] = ['name' => 'test', 'age' => 100, 'strength' => 0];
        $validGnomes [] = ['name' => 'gnome', 'age' => 3, 'strength' => 3, 'avatar' => ''];
        $validGnomes [] = ['name' => 'gnome', 'age' => 3, 'strength' => 3, 'avatar' => null];
        foreach ($validGnomes as $gnome) {
            $client->request('POST', '/api/v1/gnomes', [], [], [], json_encode($gnome));
            $this->assertTrue($client->getResponse()->isSuccessful(),
                print_r($gnome, true));
            $responseGnome = json_decode($client->getResponse()->getContent(), true);
            $this->assertArrayHasKey('id', $responseGnome);
            $this->assertEquals($responseGnome['name'], $gnome['name']);
            $this->assertEquals($responseGnome['age'], $gnome['age']);
            $this->assertNull($responseGnome['avatar']);
        }

        // Test invalid gnomes
        $invalidGnomes    = [];
        $invalidGnomes [] = ['name' => '', 'age' => 10, 'strength' => 70];
        $invalidGnomes [] = ['name' => 'gnome', 'age' => 110, 'strength' => 70];
        $invalidGnomes [] = ['name' => 'gnome', 'age' => -1, 'strength' => 70];
        $invalidGnomes [] = ['name' => 'gnome', 'age' => 10, 'strength' => 170];
        $invalidGnomes [] = ['name' => 'gnome', 'age' => 10, 'strength' => 101];
        $invalidGnomes [] = ['name' => 'gnome', 'strength' => 101];
        $invalidGnomes [] = ['name' => 'gnome', 'age' => 10];
        $invalidGnomes [] = ['name' => 'gnome', 'age' => null, 'strength' => null];
        $invalidGnomes [] = ['name' => 'gnome', 'age' => 5, 'strength' => 5, 'avatar' => 'a'];
        foreach ($invalidGnomes as $gnome) {
            $client->request('POST', '/api/v1/gnomes', [], [], [], json_encode($gnome));
            $this->assertEquals(400, $client->getResponse()->getStatusCode(),
                print_r($gnome, true));
        }

        // Test gnome with avatar
        $avatar         = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAIAAACQd1PeAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAMSURBVBhXY/j//z8ABf4C/qc1gYQAAAAASUVORK5CYII=';
        $gnome          = ['name' => 'gnome', 'age' => 3, 'strength' => 3, 'avatar' => $avatar];
        $client->request('POST', '/api/v1/gnomes', [], [], [], json_encode($gnome));
        $this->assertTrue($client->getResponse()->isSuccessful(), 'with avatar');
        $responseGnome  = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('id', $responseGnome);
        $this->assertEquals($responseGnome['name'], $gnome['name']);
        $this->assertEquals($responseGnome['age'], $gnome['age']);
        $this->assertNotNull($responseGnome['avatar']);
        $this->assertTrue($client->getResponse()->isSuccessful(), 'avatar file');
        $responseAvatar = file_get_contents(substr($responseGnome['avatar'], 1));
        $this->assertEquals($avatar, base64_encode($responseAvatar));
    }

    public function testReadAction()
    {
        $client = static::createClient();

        // Add gnome with avatar
        $avatar        = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAIAAACQd1PeAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAMSURBVBhXY/j//z8ABf4C/qc1gYQAAAAASUVORK5CYII=';
        $gnome         = ['name' => 'gnome', 'age' => 3, 'strength' => 3, 'avatar' => $avatar];
        $client->request('POST', '/api/v1/gnomes', [], [], [], json_encode($gnome));
        $this->assertTrue($client->getResponse()->isSuccessful());
        $responseGnome = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('id', $responseGnome);
        $id            = $responseGnome['id'];

        // Get added gnome
        $client->request('GET', '/api/v1/gnomes/'.$id, [], [], [], json_encode($gnome));
        $this->assertTrue($client->getResponse()->isSuccessful());
        $responseGnome  = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals($responseGnome['name'], $gnome['name']);
        $this->assertEquals($responseGnome['age'], $gnome['age']);
        $this->assertNotNull($responseGnome['avatar']);
        $this->assertTrue($client->getResponse()->isSuccessful(), 'avatar file');
        $responseAvatar = file_get_contents(substr($responseGnome['avatar'], 1));
        $this->assertEquals($avatar, base64_encode($responseAvatar));
    }

    public function testDeleteAction()
    {
        $client = static::createClient();

        // Add gnome with avatar
        $avatar        = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAIAAACQd1PeAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAMSURBVBhXY/j//z8ABf4C/qc1gYQAAAAASUVORK5CYII=';
        $gnome         = ['name' => 'gnome', 'age' => 3, 'strength' => 3, 'avatar' => $avatar];
        $client->request('POST', '/api/v1/gnomes', [], [], [], json_encode($gnome));
        $this->assertTrue($client->getResponse()->isSuccessful());
        $responseGnome = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('id', $responseGnome);
        $id            = $responseGnome['id'];

        // Delete added gnome
        $client->request('DELETE', '/api/v1/gnomes/'.$id, [], [], [], json_encode($gnome));
        $this->assertTrue($client->getResponse()->isSuccessful());
        $responseGnome  = json_decode($client->getResponse()->getContent(), true);
        $this->assertTrue($responseGnome);
        $this->assertFalse(file_exists(substr($responseGnome['avatar'], 1)));

        // Delete unexisting gnome
        $client->request('GET', '/api/v1/gnomes/'.$id, [], [], [], json_encode($gnome));
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testListAction()
    {
        $exampleGnome = ['name' => 'testGnome', 'age' => 10, 'strength' => 70];

        $client   = static::createClient();
        $client->request('GET', '/api/v1/gnomes');
        $response = $client->getResponse();

        $this->assertTrue($response->isSuccessful());

        $gnomes = json_decode($response->getContent(), true);

        $this->assertTrue(is_array($gnomes));
        $this->assertGreaterThan(0, count($gnomes));
        $this->assertArrayHasKey('id', end($gnomes));
        $this->assertArrayHasKey('name', end($gnomes));
        $this->assertArrayNotHasKey('age', end($gnomes));
        $this->assertArrayNotHasKey('strength', end($gnomes));
    }

    public function testUpdateAction()
    {
        $client = static::createClient();

        // Add gnome without avatar
        $gnome         = ['name' => 'gnome', 'age' => 3, 'strength' => 3];
        $client->request('POST', '/api/v1/gnomes', [], [], [], json_encode($gnome));
        $this->assertTrue($client->getResponse()->isSuccessful());
        $responseGnome = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('id', $responseGnome);
        $id            = $responseGnome['id'];

        // Update gnome
        $avatar        = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAIAAACQd1PeAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAMSURBVBhXY/j//z8ABf4C/qc1gYQAAAAASUVORK5CYII=';
        $gnome         = ['name' => 'gnome', 'age' => 10, 'strength' => 10, 'avatar' => $avatar];
        $client->request('PUT', '/api/v1/gnomes/'.$id, [], [], [], json_encode($gnome));
        $this->assertTrue($client->getResponse()->isSuccessful());
        $responseGnome = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals($responseGnome['name'], $gnome['name']);
        $this->assertEquals($responseGnome['age'], $gnome['age']);
        $this->assertNotNull($responseGnome['avatar']);

        // Get added gnome
        $client->request('GET', '/api/v1/gnomes/'.$id, [], [], [], json_encode($gnome));
        $this->assertTrue($client->getResponse()->isSuccessful());
        $responseGnome  = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals($responseGnome['name'], $gnome['name']);
        $this->assertEquals($responseGnome['age'], $gnome['age']);
        $this->assertNotNull($responseGnome['avatar']);
        $this->assertTrue($client->getResponse()->isSuccessful(), 'avatar file');
        $responseAvatar = file_get_contents(substr($responseGnome['avatar'], 1));
        $this->assertEquals($avatar, base64_encode($responseAvatar));
    }
}