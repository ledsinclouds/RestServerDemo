<?php

namespace RestServerDemo\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Debug\Debug;
use Zend\Session\Container;

class SingleSongController extends AbstractRestfulController{
	
    protected $em;

    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }
    
    public function getList(){
        $albums = $this->getServiceLocator()->get('songTransformerService');        
		$resource = $albums->findAll();
		return new JsonModel($resource);
    }

    public function get($id){
        $song = $this->getServiceLocator()->get('songTransformerService');				
		$resource = $song->findOneById($id);
		return new JsonModel($resource);
	}  
	
    //public function create($data) {		
        //$em = $this->getEntityManager();
        //$album = $em->find('Album\Entity\Album', (int)$data['album_id']);
        //$song = new \Album\Entity\Song();
 
		//$song->setAlbum($album);
        //$song->setSongTitle($data['song_title']);        
        //$em->persist($song);		              
        //$em->flush();
    //}	    
	
    public function update($id, $data){
        $em = $this->getEntityManager();
        $album = $em->find('RestServerDemo\Entity\Album', (int)$data['album_id']);
        $song = $em->find('RestServerDemo\Entity\Song', $id);
 
		$song->setAlbum($album);
        $song->setSongTitle($data['song_title']);        
        $em->persist($song);		              
        $em->flush();
    }  
    
    public function delete($id) {
        $em = $this->getEntityManager();
        $song = $em->find('RestServerDemo\Entity\Song', $id);
        $em->remove($song);
        $em->flush();
    }     	 
}

