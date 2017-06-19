<?php
/**
 * Created by PhpStorm.
 * User: Cachu
 * Date: 19/jun/2017
 * Time: 02:10 AM
 */

namespace controller;


class Game
{
    function validateShot()
    {
        $shot = false;
        $ships = array("C3", "C4", "C5", "D6");

        if (in_array($_POST["cell"], $ships)) $shot = true;

        return compact("shot");
    }
}