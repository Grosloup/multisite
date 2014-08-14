<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 14/08/2014
 * Time: 12:28
 */
 /*
           ____________________
  __      /     ______         \
 {  \ ___/___ /       }         \
  {  /       / #      }          |
   {/ ô ô  ;       __}           |
   /          \__}    /  \       /\
<=(_    __<==/  |    /\___\     |  \
   (_ _(    |   |   |  |   |   /    #
    (_ (_   |   |   |  |   |   |
      (__<  |mm_|mm_|  |mm_|mm_|
*/

namespace ZPB\Sites\ZooBundle\Service;


use ZPB\Admin\SponsorshipBundle\Entity\Animal;
use ZPB\Admin\SponsorshipBundle\Entity\SponsorshipDesc;

class SponsorBasketItem implements \Serializable
{
    private $id;

    private $animal;

    private $pack;

    function __construct(SponsorshipDesc $pack = null, Animal $animal = null)
    {
        $this->id = $pack->getId() . "-" . $animal->getId();
        $this->pack = $pack;
        $this->animal = $animal;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAnimal()
    {
        return $this->animal;
    }

    /**
     * @param mixed $animal
     * @return $this
     */
    public function setAnimal($animal)
    {
        $this->animal = $animal;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPack()
    {
        return $this->pack;
    }

    /**
     * @param mixed $pack
     * @return $this
     */
    public function setPack($pack)
    {
        $this->pack = $pack;
        return $this;
    }


    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     */
    public function serialize()
    {
        return serialize([
            'id'=>$this->id,
            'pack'=>$this->pack,
            'animal'=>$this->animal
        ]);
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     */
    public function unserialize($serialized)
    {
        $datas = unserialize($serialized);
        foreach($datas as $k=>$v){
            $method = "set".ucfirst($k);
            if(method_exists($this, $method)){
                $this->$method($v);
            }
        }
    }
}
