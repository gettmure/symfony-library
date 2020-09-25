<?php

namespace App\Entity;

use Sonata\UserBundle\Entity\BaseGroup as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_group")
 */
class Group extends BaseGroup {
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @return string
     */
    public function getId() {
        return $this->id;
    }
}