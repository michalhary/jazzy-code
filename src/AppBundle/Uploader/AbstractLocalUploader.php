<?php

namespace AppBundle\Uploader;

use Symfony\Component\HttpFoundation\File\File;

/**
 * Abstract local file uploader.
 * Use local path to store files
 */
abstract class AbstractLocalUploader implements UploaderInterface
{
    /**
     * Upload directory
     *
     * @var string
     */
    protected $targetDir;

    /**
     * Constructor
     *
     * @param string $targetDir Upload directory
     */
    public function __construct(string $targetDir)
    {
        $this->targetDir = $targetDir;
    }

    /**
     * Move file to upload directory
     *
     * {@inheritdoc}
     */
    public function upload(File $file, string $fileName = null): string
    {
        if ($fileName === null) {
            $fileName = $this->generateFilename($file);
        }

        $file->move($this->targetDir, $fileName);

        return $fileName;
    }

    /**
     * Generate filename
     *
     * @param File $file
     *
     * @return string
     */
    abstract protected function generateFilename(File $file): string;
}
