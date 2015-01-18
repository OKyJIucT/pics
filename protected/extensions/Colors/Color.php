<?php

/**
 * Created by PhpStorm.
 * User: Kohone
 * Date: 18.01.2015
 * Time: 17:14
 */

/**
 * Выводим список популярных цветов изображения
 * Class Color
 */
class Color extends CWidget
{
    public $colors;

    public function run()
    {
        $this->render('color', array('colors' => $this->colors));
    }
}