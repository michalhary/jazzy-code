<?php

namespace AppBundle\Action;

use JMS\Serializer\Context;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\Exception\ObjectConstructionException;
use JMS\Serializer\Exception\ValidationFailedException;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\Required;

/**
 * Serializer Trait
 */
trait SerializerTrait
{
    /**
     * Serializer
     *
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * Set dependency
     *
     * @Required
     *
     * @ignore
     * @param SerializerInterface $serializer
     */
    final public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
    }

    /**
     * Serialize to JSON
     *
     * @param object $data
     * @param string[] $groups
     *
     * @return string
     */
    protected function serialize($data, array $groups = ["full"]): string
    {
        $context = $this->createSerializationContext($groups);

        $json = $this->serializer->serialize($data, 'json', $context);

        return $json;
    }

    /**
     * Deserialize JSON data
     *
     * @param string $json
     * @param string[] $groups
     *
     * @return object
     *
     * @throws BadRequesApiHttpException
     */
    protected function deserialize(string $json, array $groups = ["full"])
    {
        $context = $this->createDeserializationContext($groups);

        $data = null;
        try {
            $data = $this->serializer->deserialize(
                $json,
                $this->getDataClass(),
                'json',
                $context
            );
        } catch (JmsRuntimeException $e) {
            throw new BadRequesApiHttpException($e->getMessage());
        } catch (ObjectConstructionException $e) {
            throw new BadRequesApiHttpException($e->getMessage());
        } catch (ValidationFailedException $e) {
            throw new BadRequesApiHttpException($e->getMessage());
        } catch (\Exception $e) {
            throw new BadRequesApiHttpException('Could not deserialize data');
        }

        return $data;
    }

    /**
     * Create deserialization context
     *
     * @param string[] $groups
     *
     * @return Context
     */
    protected function createDeserializationContext(array $groups = []): Context
    {
        $context = DeserializationContext::create();
        $context->setGroups($groups);
        return $context;
    }

    /**
     * Create serialization context
     *
     * @param string[] $groups
     *
     * @return Context
     */
    protected function createSerializationContext(array $groups = []): Context
    {
        $context = SerializationContext::create();
        $context->setGroups($groups);
        return $context;
    }
}
