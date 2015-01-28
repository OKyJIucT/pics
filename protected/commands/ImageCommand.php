<?php

class ImageCommand extends CConsoleCommand
{
    public function run($args)
    {
        $criteria = new CDbCriteria();
        $criteria->limit = 1;
        $criteria->order = 'RAND()';
        $data = Tmp::model()->findAll($criteria);

        foreach ($data as $item) {
            $image = new Image;

            $image->id = $item->id;
            $image->name = $item->name;
            $image->title = $item->title;
            $image->file = $item->file;
            $image->size = $item->size;
            $image->width = $item->width;
            $image->height = $item->height;
            $image->category_id = $item->category_id;
            $image->date = $item->date;
            $image->md5 = $item->md5;

            if ($image->save()) {
                //Tmp::model()->deleteByPk($item->id);
            }
        }
    }


}