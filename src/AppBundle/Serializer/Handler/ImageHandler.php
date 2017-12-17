<?php

namespace AppBundle\Serializer\Handler;

use AppBundle\Entity\Image;
use AppBundle\Exception\DeserializationException;
use AppBundle\Manager\TmpFilesManagerInterface;
use AppBundle\Uploader\UploaderInterface;
use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\VisitorInterface;

final class ImageHandler implements SubscribingHandlerInterface
{
    /**
     * Image uploader
     *
     * @var UploaderInterface
     */
    private $uploader;

    /**
     * Temporary files manager
     *
     * @var TmpFilesManagerInterface
     */
    private $tmpManager;

    /**
     * Constructor
     *
     * @param UploaderInterface $uploader
     * @param TmpFilesManagerInterface $tmpManager
     */
    public function __construct(
        UploaderInterface $uploader,
        TmpFilesManagerInterface $tmpManager
    ) {
        $this->uploader = $uploader;
        $this->tmpManager = $tmpManager;
    }

    /**
     * Get list of handler methods
     *
     * @return array
     */
    public static function getSubscribingMethods(): array
    {
        $methods = [];
        $methods[] = ['direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
            'format' => 'json',
            'type' => Image::class,
            'method' => 'deserializeFromJson'];
        $methods[] = ['direction' => GraphNavigator::DIRECTION_SERIALIZATION,
            'format' => 'json',
            'type' => Image::class,
            'method' => 'serializeToJson'];
        return $methods;
    }

    /**
     * Deserialize from JSON
     *
     * @param VisitorInterface $visitor
     * @param string $data JSON
     * @param array $type
     * @param Context $context
     *
     * @return Image|null
     *
     * @throws DeserializationException
     */
    public function deserializeFromJson(
        VisitorInterface $visitor,
        $data,
        array $type,
        Context $context
    ) {
        if ($data === null || empty($data)) {
            return null;
        }

        $fileContent = base64_decode($data, true);
        unset($data);

        $uploadedFilename = null;
        $tmpImageFile = null;

        try {
            if ($fileContent === false) {
                throw new DeserializationException("Invalid data format");
            }

            $tmpImageFile = $this->tmpManager->createFile($fileContent);
            unset($fileContent);

            if ($tmpImageFile->getMimeType() !== 'image/png') {
                throw new DeserializationException("Only PNG files are allowed");
            }

            $uploadedFilename = $this->uploader->upload($tmpImageFile);
        } finally {
            if ($tmpImageFile !== null) {
                @unlink($tmpImageFile->getPathname());
            }
        }

        return new Image($uploadedFilename);
    }

    /**
     * Serialize to JSON
     *
     * @param VisitorInterface $visitor
     * @param Image|null $data
     * @param array $type
     * @param Context $context
     *
     * @return string JSON
     */
    public function serializeToJson(
        VisitorInterface $visitor,
        $data,
        array $type,
        Context $context
    ) {
        /* @var $data Image */
        if ($data === null) {
            return null;
        }

        return $this->uploader->fileUrl($data->getFilename());
    }
}
