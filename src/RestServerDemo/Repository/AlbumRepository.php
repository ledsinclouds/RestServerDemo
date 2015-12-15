<?php
namespace RestServerDemo\Repository;

use Doctrine\ORM\EntityRepository;
use RestServerDemo\Entity\Album;
use Zend\Debug\Debug;

class AlbumRepository extends EntityRepository{
	
	//public function getSongsByAlbum(){		
		//$qb = $this->_em->createQueryBuilder();
		//$qb->add('select', 'u')
			//->add('from', 'Album\Entity\Song u');
			
		//$users = $qb->getQuery()->getArrayResult();
		//Debug::dump($users);		
	//}	
	
	public function getSongsByAlbum($id){
		$em = $this->getEntityManager();
		$conn = $em->getConnection();
		//$stmt = $conn->query("SELECT * FROM song s, album a WHERE s.album_id=".$id)->fetchAll();
		$stmt = $conn->query("SELECT * FROM song p WHERE p.album_id=".$id)->fetchAll();		
		return $stmt;
		//var_dump($stmt);		
	}	
	
	public function getSongById($id){
		$em = $this->getEntityManager();
		$conn = $em->getConnection();
		//$stmt = $conn->query("SELECT * FROM song s, album a WHERE s.album_id=".$id)->fetchAll();
		$stmt = $conn->query("SELECT * FROM song p WHERE p.id=".$id)->fetchAll();		
		return $stmt;
		//var_dump($stmt);		
	}	
	
}
