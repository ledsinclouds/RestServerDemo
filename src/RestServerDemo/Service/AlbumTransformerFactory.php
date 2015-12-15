<?php
namespace RestServerDemo\Service;

use Doctrine\Common\Persistence\ObjectManager;
use RestServerDemo\Service\AlbumTransformer;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AlbumTransformerFactory implements FactoryInterface{

    public function createService(ServiceLocatorInterface $sl){
        $objectManager = $sl->get('Doctrine\ORM\EntityManager');
        $transformerService = new AlbumTransformer($objectManager);
        return $transformerService;
    }

}
