<?php
/**
 * Created by PhpStorm.
 * User: sherbieny
 * Date: 9/6/17
 * Time: 4:59 PM
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="item")
 */
class Item
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */private $id;


    /**
     * @ORM\Column(type="string")
     */
    private $itemDetail1;


    /**
     * @ORM\Column(type="string")
     */
    private $itemDetail2;


    /**
     * @ORM\Column(type="string")
     */
    private $itemDetail3;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getItemDetail1()
    {
        return $this->itemDetail1;
    }

    /**
     * @return mixed
     */
    public function getItemDetail2()
    {
        return $this->itemDetail2;
    }

    /**
     * @return mixed
     */
    public function getItemDetail3()
    {
        return $this->itemDetail3;
    }

    /**
     * @param mixed $itemDetail1
     */
    public function setItemDetail1($itemDetail1)
    {
        $this->itemDetail1 = $itemDetail1;
    }

    /**
     * @param mixed $itemDetail2
     */
    public function setItemDetail2($itemDetail2)
    {
        $this->itemDetail2 = $itemDetail2;
    }

    /**
     * @param mixed $itemDetail3
     */
    public function setItemDetail3($itemDetail3)
    {
        $this->itemDetail3 = $itemDetail3;
    }



}