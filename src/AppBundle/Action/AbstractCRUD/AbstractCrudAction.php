<?php

namespace AppBundle\Action\AbstractCRUD;

use AppBundle\Exception\NotFoundApiException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Abstract CRUD Action
 */
abstract class AbstractCrudAction
{
    /**
     * Entity Manager
     *
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * Constructor
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Get entity repository
     *
     * @return EntityRepository
     */
    protected function getRepository(): EntityRepository
    {
        return $this->em->getRepository($this->getDataClass());
    }

    /**
     * Find object by id
     * Throws exception if not found
     *
     * @param int $id object id
     *
     * @return object
     *
     * @throws NotFoundApiException
     */
    protected function findOneById(int $id)
    {
        $repository = $this->getRepository();
        $data       = $repository->findOneBy(['id' => $id]);

        if ($data === null) {
            throw new NotFoundApiException("Object with given id does not exist");
        }

        return $data;
    }

    /**
     * Get entity class
     *
     * @return string
     */
    abstract protected function getDataClass(): string;
}