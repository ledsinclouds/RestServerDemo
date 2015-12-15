<?php 
namespace RestServerDemo\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use RestServerDemo\Service\SongsTransformer;

class SongsTransformerFactory implements FactoryInterface{
	
	public function createService(ServiceLocatorInterface $sl){
		$objectManager = $sl->get('Doctrine\ORM\EntityManager');
		$songsManager = new SongsTransformer($objectManager);
		return $songsManager;
	}
	
}
