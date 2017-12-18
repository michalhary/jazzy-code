<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;

/**
 * Gnome
 *
 * @ORM\Table(name="gnome")
 * @ORM\Entity
 *
 * @JMS\AccessType("public_method")
 */
class Gnome
{

    /**
     * Gnome's id
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @JMS\ReadOnly
     * @JMS\Groups({"basic", "full"})
     */
    private $id;

    /**
     * Gnome's name
     *
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=1000)
     *
     * @JMS\Groups({"basic", "full"})
     *
     * @Assert\Type("string")
     * @Assert\NotNull
     * @Assert\Length(min=1, max=1000)
     */
    private $name;

    /**
     * Gnome's strength
     *
     * @var int|null
     *
     * @ORM\Column(name="strength", type="smallint")
     *
     * @JMS\Groups({"full"})
     *
     * @Assert\NotNull
     * @Assert\Type("int")
     * @Assert\Range(min=0, max=100)
     */
    private $strength;

    /**
     * Gnome's age
     *
     * @var int|null
     *
     * @ORM\Column(name="age", type="smallint")
     *
     * @JMS\Groups({"full"})
     *
     * @Assert\NotNull
     * @Assert\Type("int")
     * @Assert\Range(min=0, max=100)
     */
    private $age;

    /**
     * Gnome's avatar (image URL)
     *
     * @var Image|null
     *
     * @ORM\ManyToOne(targetEntity="Image", cascade={"persist", "remove"}, fetch="LAZY")
     * @ORM\JoinColumn(name="avatar_id", referencedColumnName="id", nullable=true)
     *
     * @JMS\Groups({"full"})
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
        return (string)$this->name;
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
     * Set id
     *
     * @param int $id
     *
     * @return Gnome
     */
    public function setId(int $id): Gnome
    {
        $this->id = $id;

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
     * Set name
     *
     * @param string $name
     *
     * @return Gnome
     */
    public function setName(string $name): Gnome
    {
        $this->name = $name;

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
     * Set strength
     *
     * @param integer $strength
     *
     * @return Gnome
     */
    public function setStrength(int $strength): Gnome
    {
        $this->strength = $strength;

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
     * Set age
     *
     * @param integer $age
     *
     * @return Gnome
     */
    public function setAge(int $age): Gnome
    {
        $this->age = $age;

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

    /**
     * Set avatar
     *
     * @param Image $avatar
     *
     * @return Gnome
     */
    public function setAvatar(Image $avatar = null): Gnome
    {
        $this->avatar = $avatar;

        return $this;
    }
}
