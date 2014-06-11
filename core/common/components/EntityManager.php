<?php
/*
 *
 *
 * @author Vadims Bucinskis <vadim.buchinsky@gmail.com>
 * @copyright 2014 MaWebSolutions team.
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace common\components;

class EntityManager extends \CComponent {
    const TYPE_COMPONENT = 1;
    const TYPE_MODULE = 2;
    const TYPE_CONTROLLER = 3;
    const TYPE_ACTION = 4;

    public $modelClass = '\\common\\models\\Entity';

    public $entity_id;
    public $parent_id;
    public $type;
    public $name;
    public $class_name;
    public $config_class;
    public $vender;
    public $vender_data;
    public $version;
    public $is_core;
    public $enabled;

    public function init(){
        $sql = 'show tables like "{{entity}}"';
        $return = \Yii::app()->db->createCommand($sql)->queryAll();
        if (empty($return)){
            $this->deployEntity();

            $model = new $this->modelClass;
            $model->attributes = array(
                'parent_id' => '0',
                'type' => '0',
                'name' => 'backend',
                'vender' => 'MA Web Solutions',
                'is_core' => '1',
            );
            $model->save();
            $model = new $this->modelClass;
            $model->attributes = array(
                'parent_id' => '0',
                'type' => '0',
                'name' => 'frontend',
                'vender' => 'MA Web Solutions',
                'is_core' => '1',
            );
            $model->save();
            unset($model);
        }
    }

    private function deployEntity(){
        \Yii::app()->db->createCommand()->createTable(
            '{{entity}}',
            array(
                'entity_id' => 'pk',
                'parent_id' => 'int(11) NOT NULL COMMENT \'Is obligated for types:  Controller, Action\'',
                'type' => 'int(11) NOT NULL COMMENT \'1 - Component; 2 - Module; 3 - Controller; 4 - Action;\'',
                'name' => 'varchar(50) NOT NULL',
                'class_name' => 'varchar(255) DEFAULT NULL COMMENT \'full name of PHP class with namespace\'',
                'config_class' => 'varchar(255) DEFAULT NULL COMMENT \'full name of PHP class with namespace\'',
                'vender' => 'varchar(50) DEFAULT NULL',
                'vender_data' => 'text DEFAULT NULL COMMENT \'json data for render info of vender\'',
                'version' => 'varchar(50) DEFAULT NULL',
                'is_core' => 'tinyint(1) NOT NULL',
                'is_installed' => 'tinyint(1) NOT NULL',
                'install_date' => 'datetime DEFAULT NULL',
                'modify_date' => 'datetime DEFAULT NULL',
                'enabled' => 'tinyint(1) NOT NULL',
            ),
            'ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;'
        );

        \Yii::app()->db->createCommand()->createIndex('IDX_{{entity}}_vender','{{entity}}','vender');
        \Yii::app()->db->createCommand()->createIndex('IDX_{{entity}}_type','{{entity}}','type');
        \Yii::app()->db->createCommand()->createIndex('IDX_{{entity}}_parent_id','{{entity}}','parent_id');
        \Yii::app()->db->createCommand()->createIndex('IDX_{{entity}}_is_installed','{{entity}}','is_installed');
        \Yii::app()->db->createCommand()->createIndex('IDX_{{entity}}_is_core','{{entity}}','is_core');
        \Yii::app()->db->createCommand()->createIndex('IDX_{{entity}}_enabled','{{entity}}','enabled');
    }

    public function createComponent($name, $options = array())
    {
        return $this->createEntity(self::TYPE_COMPONENT, $name, $options);
    }

    public function createModule($name, $options = array())
    {
        return $this->createEntity(self::TYPE_MODULE, $name, $options);
    }

    public function createController($name, $options = array())
    {
        return $this->createEntity(self::TYPE_CONTROLLER, $name, $options);
    }

    public function createAction($name, $options = array())
    {
        return $this->createEntity(self::TYPE_ACTION, $name, $options);
    }

    public function createEntity($type, $name, $options = array())
    {
        $entity = clone $this;
        $entity->type = $type;
        $entity->name = $name;
        foreach ($options as $key => $value){
            $entity->$key = $value;
        }
        if (!empty($this->entity_id))
            $entity->parent_id = $this->entity_id;

        $entity->entity_id = null;
        $entity->save();

        return $entity;
    }

    public function getPKbyName($name)
    {
        $model = new $this->modelClass("update");
        $model = $model->find('name=:name',
            array(
                ':name'=>$name,
            ));
        return $model->primaryKey;
    }

    public function save()
    {
        if (isset($this->entity_id)){
            $model = new $this->modelClass;
            $model->findByPk($this->entity_id);
        }
        if (!isset($model) || empty($model))
            $model = new $this->modelClass;

        $this->parent_id !== null ? $attributes['parent_id'] = $this->parent_id : $attributes['parent_id'] = '0';
        $this->type ? $attributes['type'] = $this->type : '';
        $this->name ? $attributes['name'] = $this->name : '';
        $this->class_name ? $attributes['class_name'] = $this->class_name : '';
        $this->config_class ? $attributes['config_class'] = $this->config_class : '';
        $this->vender ? $attributes['vender'] = $this->vender : '';
        $this->vender_data ? $attributes['vender_data'] = $this->vender_data : '';
        $this->version ? $attributes['version'] = $this->version : '';
        $this->is_core !== null ? $attributes['is_core'] = $this->is_core : '';

        $model->attributes = $attributes;
        $model->save();
        $this->entity_id = $model->primaryKey;
        return $this->entity_id;
    }
}