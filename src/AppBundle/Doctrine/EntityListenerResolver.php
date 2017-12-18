<?php

namespace AppBundle\Doctrine;

use Doctrine\ORM\Mapping\DefaultEntityListenerResolver;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Entity Listener Resolver
 */
final class EntityListenerResolver extends DefaultEntityListenerResolver
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Constructor
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function resolve($className)
    {
        /*
         * If class is register as service return serive
         */
        if ($this->container->has($className)) {
            return $this->container->get($className);
        }

        return parent::resolve($className);
    }
}
