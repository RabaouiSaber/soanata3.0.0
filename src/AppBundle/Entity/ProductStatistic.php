<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductStatistic
 *
 * @ORM\Table(name="ProductStatistic")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductStatisticRepository")
 */
class ProductStatistic {
    //put your code here
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
}
