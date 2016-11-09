<?php

/**
 * Created by PhpStorm.
 * User: Stephane
 * Date: 20-09-16
 * Time: 11:11
 */
class Personnage
{
    private $_id, $_degats, $_nom;
    const ITSME = 1;
    const DEAD_CH = 2;
    const HIT_CH = 3;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hit(Personnage $perso)
    {
        if ($perso->id() == $this->_id) {
            return self::ITSME;
        }
        return $perso->receiveDamage();
    }

    public function receiveDamage()
    {
        $this->_degats += 5;
        if ($this->_degats >= 100) {
            return self::DEAD_CH;
        }
        return self::HIT_CH;
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($method)) {
                $this->$method($value);
            }
        }


    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        if(gmp_sign($id)>=0)
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getDegats()
    {
        return $this->_degats;
    }

    /**
     * @param mixed $degats
     */
    public function setDegats($degats)
    {
        if ($degats >= 0 && $degats <= 100) {
            $this->_degats = $degats;
        }
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->_nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->_nom = $nom;
    }


}