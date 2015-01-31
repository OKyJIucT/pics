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
class Tag extends CWidget
{
    public $tags;

    public function run()
    {
        $this->render('tags', array('tags' => $this->tags));
    }
}