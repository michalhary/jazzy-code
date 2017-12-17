<?php

namespace AppBundle\Uploader;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Asset\PackageInterface;
use Symfony\Component\Asset\PathPackage;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\HttpFoundation\File\File;

/**
 * File uploader.
 * Use local path to store files
 *
 * Upload file to local directory
 */
final class LocalUploader extends AbstractLocalUploader
{
    /**
     * @var PackageInterface
     */
    private $package;

    /**
     * {@inheritdoc}
     */
    public function __construct(string $targetDir)
    {
        parent::__construct($targetDir);
        $this->package = new PathPackage($targetDir, new EmptyVersionStrategy());
    }

    /**
     * {@inheritdoc}
     */
    public function fileUrl(string $fileName): string
    {
        return $this->package->getUrl($fileName);
    }

    /**
     * {@inheritdoc}
     */
    protected function generateFilename(File $file): string
    {
        return Uuid::uuid4()->toString() . '.' . $file->guessExtension();
    }
}
