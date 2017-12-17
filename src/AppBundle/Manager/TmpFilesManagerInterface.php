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

    /**
     * Delete all temporary files
     * Delete all temporary files created in this HTTP request
     */
    public function deleteAll(): void;
}
