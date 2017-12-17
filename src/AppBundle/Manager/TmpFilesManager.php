<?php

namespace AppBundle\Manager;

use Exception;
use Symfony\Component\HttpFoundation\File\File;

class TmpFilesManager implements TmpFilesManagerInterface
{
    /**
     * Directory to store temporary files
     *
     * @var string
     */
    protected $tmpDir;

    /**
     * Created files
     * Created files paths
     *
     * @var string[]
     */
    protected $files;

    /**
     * Constructor
     *
     * @param string $tmpDir
     */
    public function __construct(string $tmpDir)
    {
        $this->tmpDir = $tmpDir;
        $this->files  = [];
    }

    /**
     * {@inheritdoc}
     *
     * @throws Exception
     */
    public function createFile(string $content = null): File
    {
        $filepath = tempnam($this->tmpDir, 'tmp');

        if ($filepath === false) {
            throw new Exception('Could not create temporary file');
        }

        if ($content !== null) {
            if (file_put_contents($filepath, $content) === false) {
                throw new Exception('Could not write to temporary file');
            }
        }

        $this->files [] = $filepath;

        return new File($filepath);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteAll(): void
    {
        foreach ($this->files as $key => $filepath) {
            if (file_exists($filepath)) {
                unlink($filepath);
            }
            unset($this->files[$key]);
        }
    }
}
