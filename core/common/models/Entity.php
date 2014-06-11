<?php
/*
 *
 * @author Vadims Bucinskis <vadim.buchinsky@gmail.com>
 * @copyright 2014 MaWebSolutions team.
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace common\models;

/**
 * This is the model class for table "{{entity}}".
 *
 * The followings are the available columns in table '{{entity}}':
 * @property integer $entity_id
 * @property integer $parent_id
 * @property integer $type
 * @property string $name
 * @property string $class_name
 * @property string $config_class
 * @property string $vender
 * @property string $vender_data
 * @property string $version
 * @property integer $is_core
 * @property integer $is_installed
 * @property string $install_date
 * @property string $modify_date
 * @property integer $enabled
 */
class Entity extends \CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{entity}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id, type, name, is_core', 'required'),
			array('parent_id, type, is_core, is_installed, enabled', 'numerical', 'integerOnly'=>true),
			array('name, vender, version', 'length', 'max'=>50),
			array('class_name, config_class', 'length', 'max'=>255),
			array('vender_data, install_date, modify_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('entity_id, parent_id, type, name, class_name, config_class, vender, vender_data, version, is_core, is_installed, install_date, modify_date, enabled', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'entity_id' => 'Entity',
			'parent_id' => 'Parent',
			'type' => 'Type',
			'name' => 'Name',
			'class_name' => 'Class Name',
			'config_class' => 'Config Class',
			'vender' => 'Vender',
			'vender_data' => 'Vender Data',
			'version' => 'Version',
			'is_core' => 'Is Core',
			'is_installed' => 'Is Installed',
			'install_date' => 'Install Date',
			'modify_date' => 'Modify Date',
			'enabled' => 'Enabled',
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
		$criteria=new \CDbCriteria;

		$criteria->compare('entity_id',$this->entity_id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('type',$this->type);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('class_name',$this->class_name,true);
		$criteria->compare('config_class',$this->config_class,true);
		$criteria->compare('vender',$this->vender,true);
		$criteria->compare('vender_data',$this->vender_data,true);
		$criteria->compare('version',$this->version,true);
		$criteria->compare('is_core',$this->is_core);
		$criteria->compare('is_installed',$this->is_installed);
		$criteria->compare('install_date',$this->install_date,true);
		$criteria->compare('modify_date',$this->modify_date,true);
		$criteria->compare('enabled',$this->enabled);

		return new \CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    protected function beforeSave()
    {
        if(parent::beforeSave())
        {
            if($this->isNewRecord)
            {
                $this->is_installed = 1;
                $this->install_date = date(\Yii::app()->params['dbDateFormat']);
                $this->modify_date = date(\Yii::app()->params['dbDateFormat']);
                $this->enabled = 1;
            }
            else
                $this->modify_date = date(\Yii::app()->params['dbDateFormat']);
            return true;
        }
        else
            return false;
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Entity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
