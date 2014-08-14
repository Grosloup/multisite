<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 14/08/2014
 * Time: 11:57
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


use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SponsorBasket
{
    private $session;
    private $itemClass;
    private $key = 'zpb_sponsor_basket';
    private $basket;

    function __construct(SessionInterface $session, $itemClass="")
    {
        $this->session = $session;
        $this->itemClass = $itemClass;
        if(!$this->session->has($this->key)){
            $this->session->set($this->key, []);
        }

        $this->basket = $this->session->get($this->key);

    }

    public function isEmpty()
    {
        if(!$this->session->has($this->key)){
            return false;
        }
        return count($this->session->get($this->key)) === 0;
    }

    public function testme()
    {
        var_dump($this->session->get($this->key));
        die();
    }

    public function addItem($pack, $animal)
    {
        $item = new $this->itemClass($pack, $animal);
        $this->basket[$item->getId()] = $item;
        $this->session->set($this->key, $this->basket);
    }

    public function getItems()
    {
        return $this->session->get($this->key, null);
    }


}
