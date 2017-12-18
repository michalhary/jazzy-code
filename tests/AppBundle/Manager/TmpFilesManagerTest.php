<?php

namespace Tests\AppBundle\Manager;

use AppBundle\Manager\TmpFilesManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TmpFilesManagerTest extends WebTestCase
{
    /**
     * @var TmpFilesManagerInterface
     */
    protected $tmpManager;

    public function setUp()
    {
        self::bootKernel();
        chdir(self::$kernel->getRootDir() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'web');
        $container = self::$kernel->getContainer();
        $this->tmpManager = $container->get(TmpFilesManagerInterface::class);
    }

    public function testCreateFile()
    {
        $file1 = $this->tmpManager->createFile('test1');
        $this->assertEquals('test1', file_get_contents($file1->getPathname()));

        $file2 = $this->tmpManager->createFile();
        file_put_contents($file2->getPathname(), 'test2');
        $this->assertEquals('test2', file_get_contents($file2->getPathname()));
    }

    public function testCeleteAll()
    {
        $file = $this->tmpManager->createFile();

        $this->tmpManager->deleteAll();
        $this->assertFalse(file_exists($file->getPathname()));
    }
}
