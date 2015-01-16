<?php

/**
 * This is the model class for table "tags".
 *
 * The followings are the available columns in table 'tags':
 * @property integer $id
 * @property string $name
 * @property integer $image_id
 *
 * The followings are the available model relations:
 * @property Image $image
 */
class Tags extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tags';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, image_id, slug', 'required'),
            array('image_id', 'numerical', 'integerOnly' => true),
            array('name, slug', 'length', 'max' => 32),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, image_id', 'safe', 'on' => 'search'),
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
            'slug' => 'Slug',
            'name' => 'Name',
            'image_id' => 'Image',
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
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('image_id', $this->image_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Tags the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function setTags($tags = array(), $image_id)
    {
        foreach ($tags as $tag) {
            $tagData = new Tags;
            $tagData->image_id = $image_id;
            $tagData->name = mb_convert_case(trim($tag), MB_CASE_LOWER, "UTF-8");
            $tagData->slug = Y::totranslit($tagData->name);
            $tagData->save();
        }
    }
}
