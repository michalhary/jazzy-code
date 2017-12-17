<?php

namespace AppBundle\Doctrine\EventListener;

use AppBundle\Entity\Image;
use AppBundle\Uploader\UploaderInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Image entity event listener
 */
final class ImageEntityListener
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
     * PreRemove Event
     * Delete image file
     *
     * @param Image $image
     * @param LifecycleEventArgs $event
     */
    public function preRemove(Image $image, LifecycleEventArgs $event)
    {
        $this->getUploader()->removeFile($image->getFilename());
    }

    /**
     * Get Uploader service
     * Get service from container because injecting Uploader dependency cause circular dependency
     *
     * @return UploaderInterface
     */
    private function getUploader(): UploaderInterface
    {
        return $this->container->get(UploaderInterface::class);
    }
}
