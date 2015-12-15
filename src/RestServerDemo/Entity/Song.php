<?php

namespace RestServerDemo\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="song")
 */
class Song {

    use \RestServerDemo\Traits\ReadOnly;

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="string")
     */    
    protected $songTitle;
    
    /**
     * @ORM\ManyToOne(targetEntity="Album", inversedBy="songs")
     */
    protected $album;    

    public function setId($id = 0){
        $this->id = $id;
        return $this;
    }

    public function getId(){
        if (!isset($this->id)){
            $this->setId();
        }
        return $this->id;
    }
    
	public function getSongTitle(){
		return $this->songTitle;
	}
	
    public function setSongTitle($songTitle){
    	$this->songTitle = $songTitle;
    }
    
    public function setAlbum(Album $album = null){
        $this->album = $album;
        return $this;
    }

    public function getAlbum(){

        if (!isset($this->album)){
            $this->setAlbum();
        }
        return $this->album;
    }
    
    public function objToArray(){
        $var = get_object_vars($this);
        foreach($var as &$value){
           if(is_object($value) && method_exists($value,'objToArray')){
              $value = $value->getJsonData();
           }
        }
        return $var;
    }  
}
