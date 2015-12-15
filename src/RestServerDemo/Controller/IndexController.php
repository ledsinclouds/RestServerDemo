<?php
namespace RestServerDemo\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Mvc\MvcEvent;
use RestServerDemo\Entity\Album;

class IndexController extends AbstractRestfulController{
	
    protected $em;

    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }
      
    public function getList(){
        $albums = $this->getServiceLocator()->get('albumTransformerService');
		$resource = $albums->findAll();
		return new JsonModel($resource);
    }
	
    public function get($id){
        $result = $this->getEntityManager()->find('RestServerDemo\Entity\Album', $id);
        $decoded = $result->objToArray();
        return new JsonModel(array(
            'data' => $decoded
        ));
    }
    	
    public function update($id, $data){
        $em = $this->getEntityManager();
        $album = $em->find('RestServerDemo\Entity\Album', $id);
        $album->setTitle($data['title']); 
        $album->setArtist($data['artist']);   
        
        $updated = $em->merge($album);      
        $em->flush();

        return new JsonModel(array(
            'data' => $updated->getId()
        ));
    }
    
    public function create($data) {
        $em = $this->getEntityManager();
        $album = new Album();       
        $album->setArtist($data['artist']);
        $album->setTitle($data['title']);
        $em->persist($album);
        $em->flush();

        return new JsonModel(array(
            'data' => $album->getId(),
        )); 
    }   
    
    public function delete($id) {
        $em = $this->getEntityManager();
        $album = $em->find('RestServerDemo\Entity\Album', $id);
        $em->remove($album);
        $em->flush();
    }    
       
}
















