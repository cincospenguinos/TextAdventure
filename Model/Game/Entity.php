<?php
/**
 * Created by PhpStorm.
 * User: tsvetok
 * Date: 6/9/16
 * Time: 1:13 PM
 */

namespace LinkedWorldsCore;


abstract class Entity
{
    protected $strength, $constitution, $dexterity, $intelligence;

    // TODO: This

    public abstract function toHit($target);
    public abstract function takeDamage($amount);
}