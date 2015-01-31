<?php

class ImageCommand extends CConsoleCommand
{
    public function run($args)
    {
        $criteria = new CDbCriteria();
        $data = Image::model()->findAll($criteria);

        $i = 0;
        foreach ($data as $item) {
            Image::model()->updateByPk($item->id, array('date' => time() - mt_rand(1, 172800)));
            $i++;
        }

        echo $i;
    }


}