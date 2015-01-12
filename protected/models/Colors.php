<?php

require_once 'protected/vendor/autoload.php';
use ColorThief\ColorThief;

/**
 * This is the model class for table "colors".
 *
 * The followings are the available columns in table 'colors':
 * @property integer $id
 * @property integer $image_id
 * @property string $color
 *
 * The followings are the available model relations:
 * @property Image $image
 */
class Colors extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'colors';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('image_id, color', 'required'),
            array('image_id', 'numerical', 'integerOnly' => true),
            array('color', 'length', 'max' => 6),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, image_id, color', 'safe', 'on' => 'search'),
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
            'image' => array(self::BELONGS_TO, 'Image', 'image_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'image_id' => 'Image',
            'color' => 'Color',
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
        $criteria->compare('image_id', $this->image_id);
        $criteria->compare('color', $this->color, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Colors the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function setColors($img, $image_id)
    {
        $colors = ColorThief::getPalette($img);

        foreach ($colors as $color) {
            $result = Y::rgb2hexRound($color);

            $colorData = new Colors;
            $colorData->image_id = $image_id;
            $colorData->color = (string)$result;
            $colorData->save();
        }
    }
}
