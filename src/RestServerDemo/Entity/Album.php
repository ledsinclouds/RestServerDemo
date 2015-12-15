<?php
namespace RestServerDemo\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @Orm\Entity(repositoryClass="\RestServerDemo\Repository\AlbumRepository")
 * @ORM\Table(name="album")
 */
class Album {
	
	use \RestServerDemo\Traits\ReadOnly;	
	
    /**
    * @ORM\Column(type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
	protected $id;
	
    /**
     * @ORM\Column(type="string")
     */    
    protected $title;
    		
    /**
     * @ORM\Column(type="string")
     */
    protected $artist;	
    
    /**
     * @ORM\OneToMany(targetEntity="Song", mappedBy="album", cascade={"persist", "remove"})
     */
    protected $songs;    
    	
    public function getId(){
    	return $this->id;
	}

    public function setId($value){
    	$this->id = $value;
    }
    	
	public function getTitle(){
		return $this->title;
	}
	
    public function setTitle($value){
    	$this->title = $value;
    }	
    
	public function getArtist(){
		return $this->artist;
	}
	
    public function setArtist($value){
    	$this->artist = $value;
    }
    
    public function setSongs($value) {
        $this->songs = $value;
        return $this;
    }
    
    public function getSongs() {
		if(!isset($this->songs)){
			$this->setSongs();
		}
        return $this->songs;
    }
        
    public function addSong($song) {
        $this->songs[] = $song;
        //return $this->songs;        
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
