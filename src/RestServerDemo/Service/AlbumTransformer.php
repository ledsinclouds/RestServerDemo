<?php
namespace RestServerDemo\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use RestServerDemo\Entity\Album;
use League\Fractal;
use League\Fractal\Manager;
use League\Fractal\Resource;
use Zend\Debug\Debug;

class AlbumTransformer extends Fractal\TransformerAbstract {

	protected $objectManager;
    protected $objectRepository;

    public function __construct(ObjectManager $objectManager){
        $this->objectManager = $objectManager;
        $this->objectRepository = $objectManager->getRepository('RestServerDemo\Entity\Album');
    }

    public function findAll(){
		$albums = $this->objectRepository->findAll();

		$collection = new \Doctrine\Common\Collections\ArrayCollection($albums);
		$arrays = $collection->map(function($a){
			$a->songs = $a->songs->map(function($p){
				return $p->toArray();
			})->toArray();
			return $a->toArray();
		})->toArray();

		//****************************************************************************************
		$fractal = new Manager();
		$resource = new Resource\Collection($arrays, function(array $array) {

			$songs = array();
			for($i=0; $i<count($array['songs']); $i++)
				$songs[$i]['href'] = '/album/' . $array['id'] . '/' . $array['songs'][$i]['songTitle'];

			return [
				'id'      => (int) $array['id'],
				'title'   => $array['title'],
				'artist'    => $array['artist'],
				'_embedded' => [
					'songs' => $array['songs'],
					'_links' => [
						'rel' => $songs,
					],
				],
				'_links'   => [
					[
						'rel' => 'self',
						'uri' => '/albums/' . $array['id'],
					]
				]
			];

		});
		$result = $fractal->createData($resource)->toArray();
        return $result;

	}

}
