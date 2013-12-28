<?php

/**
 * This is the model class for table "Content".
 *
 * The followings are the available columns in table 'Content':
 * @property string $id
 * @property string $title_az
 * @property string $title_en
 * @property string $title_ru
 * @property string $content_az
 * @property string $content_en
 * @property string $content_ru
 * @property string $catID
 * @property string $albumID
 * @property string $videoID
 *
 * The followings are the available model relations:
 * @property Photoalbum $album
 * @property Hierarchy $cat
 * @property Video $video
 */
class Content extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public $catName;

    public function tableName()
    {
        return 'Content';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title_az, content_az', 'required'),
            array('isBlog', 'numerical', 'integerOnly' => true),
            array('title_az, title_en, title_ru', 'length', 'max' => 255),
            array('catID', 'length', 'max' => 11),
            array('albumID, videoID', 'length', 'max' => 10),
            array('content_en, content_ru', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title_az, title_en, title_ru, content_az, content_en, content_ru, catID, albumID, videoID', 'safe', 'on' => 'search'),
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
            'album' => array(self::BELONGS_TO, 'Photoalbum', 'albumID'),
            'cat' => array(self::BELONGS_TO, 'Hierarchy', 'catID'),
            'video' => array(self::BELONGS_TO, 'Video', 'videoID'),
        );
    }


    public function scopes()
    {
        return array(
            'isBlog' => array(
                'condition' => 'isBlog=1',
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title_az' => 'Başlıq',
            'title_en' => 'Heading',
            'title_ru' => 'Заголовок',
            'content_az' => 'Mətn',
            'content_en' => 'Text',
            'content_ru' => 'Текст',
            'catID' => 'Kateqoriya',
            'albumID' => 'Fotoalbom',
            'videoID' => 'Video',
            "catName" => 'Kateqoriya'
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
        $criteria->with = array('cat');
        $criteria->together = true;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('title_az', $this->title_az, true);
        $criteria->compare('title_en', $this->title_en, true);
        $criteria->compare('title_ru', $this->title_ru, true);
        $criteria->compare('content_az', $this->content_az, true);
        $criteria->compare('content_en', $this->content_en, true);
        $criteria->compare('content_ru', $this->content_ru, true);
        $criteria->compare('catID', $this->catID, true);
        $criteria->compare('albumID', $this->albumID, true);
        $criteria->compare('videoID', $this->videoID, true);
        $criteria->compare('cat.name_az', $this->catName, true);
        $criteria->compare('isBlog', $this->isBlog);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => "t.id DESC"
            ),

        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Content the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}