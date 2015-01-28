<?php

/**
 * This is the model class for table "tmp".
 *
 * The followings are the available columns in table 'tmp':
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $file
 * @property integer $size
 * @property integer $width
 * @property integer $height
 * @property integer $category_id
 * @property integer $date
 * @property string $md5
 */
class Tmp extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tmp';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, title, file, size, width, height, category_id, date, md5', 'required'),
            array('size, width, height, category_id, date', 'numerical', 'integerOnly' => true),
            array('name, title', 'length', 'max' => 255),
            array('file', 'length', 'max' => 16),
            array('md5', 'length', 'max' => 32),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, title, file, size, width, height, category_id, date, md5', 'safe', 'on' => 'search'),
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
            'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
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
            'title' => 'Title',
            'file' => 'File',
            'size' => 'Size',
            'width' => 'Width',
            'height' => 'Height',
            'category_id' => 'Category',
            'date' => 'Date',
            'md5' => 'Md5',
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('file', $this->file, true);
        $criteria->compare('size', $this->size);
        $criteria->compare('width', $this->width);
        $criteria->compare('height', $this->height);
        $criteria->compare('category_id', $this->category_id);
        $criteria->compare('date', $this->date);
        $criteria->compare('md5', $this->md5, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Tmp the static model class
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

                    $time = time();

                    $pathThumb = Y::getDir($time, 'thumbs');
                    $newPath = Y::md5Dir($time, $name);

                    if ($file->saveAs($newPath . $name)) {

                        $width = intval($imgInfo[0]);
                        $height = intval($imgInfo[1]);

                        $imageTitle = str_replace('.' . $ext, '', $file->name);
                        preg_match('/\(.*\)/', $file->name, $imageTitle);

                        $imageTitle = str_replace(array('(', ')'), '', $imageTitle[0]);

                        $md5_file = md5_file($newPath . $name);

                        $criteriaImage = new CDbCriteria();
                        $criteriaImage->condition = 'md5=:md5';
                        $criteriaImage->params = array(':md5' => $md5_file);

                        $criteriaTmp = new CDbCriteria();
                        $criteriaTmp->condition = 'md5=:md5';
                        $criteriaTmp->params = array(':md5' => $md5_file);

                        if (Image::model()->exists($criteriaImage) || Tmp::model()->exists($criteriaTmp)) {
                            return '{"files": [
                                {
                                    "name": "' . $name . '",
                                    "size": ' . $file->size . ',
                                    "error": "Файл уже существует!"
                                    }
                                ]}';
                        } else {
                            $image = new Tmp;
                            $image->name = $imageTitle;
                            $image->title = Y::totranslit($imageTitle);
                            $image->file = $name;
                            $image->size = $file->size;
                            $image->width = $width;
                            $image->height = $height;
                            $image->category_id = $category_id;
                            $image->date = $time;
                            $image->md5 = $md5_file;

                            if ($image->save()) {
                                Colors::setColors($newPath . $name, $image->id);

                                $tags = explode(",", trim($imageTitle));
                                Tags::setTags($tags, $image->id);

                                Y::createThumb($newPath, $pathThumb, $name);

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
