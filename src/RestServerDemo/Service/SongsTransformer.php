<?php
namespace RestServerDemo\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use RestServerDemo\Entity\Album;
use League\Fractal;
use League\Fractal\Manager;
use League\Fractal\Resource;
use Zend\Debug\Debug;

class SongsTransformer extends Fractal\TransformerAbstract {

	protected $objectManager;
    protected $objectRepository;

    public function __construct(ObjectManager $objectManager){
        $this->objectManager = $objectManager;
        $this->objectRepository = $objectManager->getRepository('RestServerDemo\Entity\Album');
    }

    public function findAll($album_id){

		$songs = $this->objectRepository->getSongsByAlbum($album_id);
		$fractal = new Manager();
		$resource = new Resource\Collection($songs, function(array $songs){
			return [
				'song_id' => $songs['id'],			
				'song_title' => $songs['songTitle'],
				'_links' => [
					'rel' => '/song/' . $songs['id']
				]
			];
		});

		$result = $fractal->createData($resource)->toArray();
		return $result;
	}
	
    public function findOneById($song_id){
		$song = $this->objectRepository->getSongById($song_id);		
		$fractal = new Manager();
		$resource = new Resource\Collection($song, function(array $song){
			return [
				'song_id' => $song['id'],			
				'song_title' => $song['songTitle'],
				'_links' => [
					'rel' => '/song/' . $song['id']
				]
			];
		});

		$result = $fractal->createData($resource)->toArray();
		return $result;				
	}	

}
