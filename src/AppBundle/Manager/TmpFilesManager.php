<?php

namespace AppBundle\Manager;

use Exception;
use Symfony\Component\HttpFoundation\File\File;

class TmpFilesManager implements TmpFilesManagerInterface
{
    protected $tmpDir;

    public function __construct(string $tmpDir)
    {
        $this->tmpDir = $tmpDir;
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

        return new File($filepath);
    }
}
