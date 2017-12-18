<?php

namespace AppBundle\Action\AbstractCRUD;

use AppBundle\Exception\NotFoundApiException;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

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
     * Find object by id
     * Throws exception if not found
     *
     * @param int $id object id
     *
     * @return mixed
     *
     * @throws NotFoundApiException
     */
    protected function findOneById(int $id)
    {
        $repository = $this->getRepository();
        $data = $repository->findOneBy(['id' => $id]);

        if ($data === null) {
            throw new NotFoundApiException("Object with given id does not exist");
        }

        return $data;
    }

    /**
     * Get entity repository
     *
     * @return ObjectRepository
     */
    protected function getRepository(): ObjectRepository
    {
        return $this->em->getRepository($this->getDataClass());
    }

    /**
     * Get entity class
     *
     * @return string
     */
    abstract protected function getDataClass(): string;
}
