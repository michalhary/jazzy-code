<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Image;

/**
 * Gnome
 *
 * @ORM\Table(name="gnome")
 * @ORM\Entity
 */
class Gnome
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
     * @ORM\Column(name="name", type="string", length=1000)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="strength", type="smallint")
     */
    private $strength;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="smallint")
     */
    private $age;

    /**
     * @var Image
     *
     * @ORM\ManyToOne(targetEntity="Image", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="avatar_id", referencedColumnName="id", nullable=true)
     */
    private $avatar;

    /**
     * Constructor
     *
     * @param string $name
     * @param int $strength
     * @param int $age
     */
    public function __construct(string $name = null, int $strength = null, int $age = null)
    {
        $this->name = $name;
        $this->strength = $strength;
        $this->age = $age;
    }

    /**
     * Converts object to string
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->name;
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
     * Set name
     *
     * @param string $name
     *
     * @return Gnome
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set strength
     *
     * @param integer $strength
     *
     * @return Gnome
     */
    public function setStrength(int $strength)
    {
        $this->strength = $strength;

        return $this;
    }

    /**
     * Get strength
     *
     * @return int|null
     */
    public function getStrength(): ?int
    {
        return $this->strength;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Gnome
     */
    public function setAge(int $age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int|null
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * Set avatar
     *
     * @param Image $avatar
     *
     * @return Gnome
     */
    public function setAvatar(Image $avatar = null)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return Image|null
     */
    public function getAvatar(): ?Image
    {
        return $this->avatar;
    }
}