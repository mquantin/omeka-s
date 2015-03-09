<?php
namespace Omeka\Db\Event\Listener;

use Doctrine\Common\Persistence\Event\LoadClassMetadataEventArgs;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Load the resource discriminator map dynamically.
 */
class ResourceDiscriminatorMap
{
    /**
     * @var array
     */
    protected $discriminatorMap;

    /**
     * Set the resource discriminator map.
     */
    public function __construct(array $discriminatorMap)
    {
        $this->discriminatorMap = $discriminatorMap;
    }

    /**
     * Attach the discriminator map to the Resource entity.
     *
     * @param LoadClassMetadataEventArgs $event
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $event)
    {
        $classMetadata = $event->getClassMetadata();
        if ('Omeka\Model\Entity\Resource' == $classMetadata->name) {
            $classMetadata->discriminatorMap = $this->discriminatorMap;
        }
    }
}
