<?php

/**
 * This is the model class for table "image".
 *
 * The followings are the available columns in table 'image':
 * @property integer $id
 * @property integer $name
 * @property integer $file
 * @property integer $size
 * @property integer $width
 * @property integer $height
 * @property integer $category_id
 * @property integer $date
 *
 * The followings are the available model relations:
 * @property Colors[] $colors
 */
class Image extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'image';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, file, size, width, height, category_id, date', 'required'),
            array('size, width, height, category_id, date', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            array('file', 'length', 'max' => 16),
            array('md5', 'length', 'max' => 32),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, file, size, width, height, category_id, date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'colors' => array(self::HAS_MANY, 'Colors', 'image_id'),
            'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
            'tags' => array(self::HAS_MANY, 'Tags', 'image_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'file' => 'File',
            'size' => 'Size',
            'width' => 'Width',
            'height' => 'Height',
            'category_id' => 'Category',
            'date' => 'Date',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name);
        $criteria->compare('file', $this->file);
        $criteria->compare('size', $this->size);
        $criteria->compare('width', $this->width);
        $criteria->compare('height', $this->height);
        $criteria->compare('category_id', $this->category_id);
        $criteria->compare('date', $this->date);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Image the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    /**
     * Сохранение загруженной картинки и миниатюры
     * @param $thumbs
     * @param $category_id
     * @return string
     */
    public static function saveImage($thumbs, $category_id)
    {
        if (isset($thumbs) && count($thumbs) > 0) {

            foreach ($thumbs as $thumb => $file) {
                $allow = array('image/jpeg', 'image/png', 'image/gif');
                $imgInfo = getimagesize($file->tempName);


                if (!in_array($file->type, $allow) || !$imgInfo) {
                    return '{"files": [
                        {
                            "name": "' . $name . '",
                            "size": ' . $file->size . ',
                            "error": "Загружаемый файл не является изображением!"
                            }
                        ]}';
                } else {
                    $ext = strtolower(array_pop(explode('.', $file->name)));
                    $name = Y::getHash() . '.' . $ext;

                    $path = Y::getDir(time(), 'walpappers');
                    $pathThumb = Y::getDir(time(), 'thumbs');

                    if ($file->saveAs($path . $name)) {

                        $width = intval($imgInfo[0]);
                        $height = intval($imgInfo[1]);

                        $imageTitle = str_replace('.' . $imgInfo['extension'], '', $file->name);
                        preg_match('/\(.*\)/', $file->name, $imageTitle);

                        $imageTitle = str_replace(array('(', ')'), '', $imageTitle[0]);

                        $md5_file = md5_file($path . $name);

                        $criteria = new CDbCriteria();
                        $criteria->condition = 'md5=:md5';
                        $criteria->params = array(':md5' => $md5_file);

                        if (Image::model()->exists($criteria)) {
                            return '{"files": [
                                {
                                    "name": "' . $name . '",
                                    "size": ' . $file->size . ',
                                    "error": "Файл уже существует!"
                                    }
                                ]}';
                        } else {
                            $image = new Image;
                            $image->name = $imageTitle;
                            $image->file = $name;
                            $image->size = $file->size;
                            $image->width = $width;
                            $image->height = $height;
                            $image->category_id = 1;
                            $image->date = time();
                            $image->md5 = $md5_file;

                            if ($image->save()) {
                                Colors::setColors($path . $name, $image->id);

                                $tags = explode(",", trim($imageTitle));
                                Tags::setTags($tags, $image->id);

                                Y::createThumb($path, $pathThumb, $name);

                                $thumbnail = str_replace("/", "\/", $pathThumb) . $name;

                                return '{"files": [
                            {
                                "name": "' . $imageTitle . '",
                                "size": ' . $file->size . ',
                                "thumbnailUrl": "\/' . $thumbnail . '"
                                }
                            ]}';
                            } else {
                                return '{"files": [
                                {
                                    "name": "' . $name . '",
                                    "size": ' . $file->size . ',
                                    "error": "Ошибка сохранения!"
                                    }
                                ]}';
                            }
                        }
                    } else {
                        return '{"files": [
                        {
                            "name": "' . $name . '",
                            "size": ' . $file->size . ',
                            "error": "Ошибка сохранения!"
                            }
                        ]}';
                    }
                }


            }
        } else {
            return '{"files": [
            {
                "name": "",
                "size": 0,
                "error": "Файл не выбран!"
                }
            ]}';
        }
    }
}
