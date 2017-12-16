<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gnome
 *
 * @ORM\Table(name="image")
 * @ORM\Entity
 */
class Image
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=512, nullable=false)
     */
    protected $filename;

    /**
     * Constructor
     *
     * @param string $filename Filename (with extension)
     */
    public function __construct(string $filename = null)
    {
        $this->filename = $filename;
    }

    /**
     * Converts object to string
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->filename;
    }

    /**
     * Get id
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get filename
     *
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return self
     */
    public function setFilename(string $filename)
    {
        $this->filename = $filename;

        return $this;
    }
}