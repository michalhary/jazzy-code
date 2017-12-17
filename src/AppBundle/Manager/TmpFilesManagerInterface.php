<?php

namespace AppBundle\Manager;

use Symfony\Component\HttpFoundation\File\File;

interface TmpFilesManagerInterface
{

    /**
     * Create temporary file
     *
     * @param string $content File content
     *
     * @return File
     */
    public function createFile(string $content = null): File;
}
