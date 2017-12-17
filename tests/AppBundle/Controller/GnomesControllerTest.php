<?php

namespace ReportBundle\Tests\Controller;

use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class GnomesControllerTest extends TestCase
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function setUp()
    {
        self::bootKernel();
        chdir(self::$kernel->getRootDir().DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'web');
        $container = self::$kernel->getContainer();
        $this->em  = $container->get(EntityManagerInterface::class);
    }
}
