<?php
/**
 * CDbAuthManager class file.
 *
 * @author Vadim Buchinsky <vadim.buchinsky@gmail.com>
 * @copyright 2014 MaWebSolutions team.
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace common\components;

use \CAuthItem;

/**
 * CDbAuthManager represents an authorization manager that stores authorization information in database.
 *
 * The database connection is specified by {@link connectionID}. And the database schema
 * should be as described in "framework/web/auth/*.sql". You may change the names of
 * the three tables used to store the authorization data by setting {@link itemTable},
 * {@link itemChildTable} and {@link assignmentTable}.
 *
 * @property array $authItems The authorization items of the specific type.
 *
 * @author Vadim Buchinsky <vadim.buchinsky@gmail.com>
 * @since 0.1
 */
class CDbAuthManager extends \CDbAuthManager {

    /*
     * @inheritdoc
     */
    public $connectionID='db';

    /**
     * @inheritdoc
     */
    public $itemTable='{{rbac_item}}';

    /*
     * @inheritdoc
     */
    public $itemChildTable='{{rbac_item_child}}';

    /**
     * @inheritdoc
     */
    public $assignmentTable='{{rbac_assignment}}';

    /**
     * @inheritdoc
     */
    public $defaultRoles=array('guest');

    /**
     * @var int ID of view.
     */
    protected $_view;

    /**
     * @var int ID of entity.
     */
    protected $_entity;

    /**
     * @param int $id of view
     * @return \common\components\CDbAuthManager
     */
    public function setView($id){
        $this->_view = $id;
        return $this;
    }
    /**
     * @param int $id of entity
     * @return \common\components\CDbAuthManager
     */
    public function setEntity($id){
        $this->_entity = $id;
        return $this;
    }
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        /*
         * @TODO: Замерить на Entity компонент
         */
        $sql = 'show tables like "jim_rbac_item"';
        $return = $this->db->createCommand($sql)->queryAll();
        if (empty($return)){
            $this->deployRbacItem();
            $this->deployRbacItemChild();
            $this->deployRbacAssignment();

            $this->_view = 1;
            $this->_entity = 1;

            $this->createAuthItem('backend.access',0);
            $this->createAuthItem('backend.index',0);
            $this->createAuthItem('supervisor',2);
            $this->addItemChild('supervisor','backend.access');
            $this->addItemChild('supervisor','backend.index');
        }
    }

    /**
     * @inheritdoc
     */
    public function createAuthItem($name,$type,$description='',$bizRule=null,$data=null)
    {
        $this->db->createCommand()
            ->insert($this->itemTable, array(
                'name'=>$name,
                'view_id' => $this->_view,
                'entity_id' => $this->_entity,
                'type'=>$type,
                'description'=>$description,
                'bizrule'=>$bizRule,
                'data'=>serialize($data)
            ));
        return new CAuthItem($this,$name,$type,$description,$bizRule,$data);
    }

    private function deployRbacItem()
    {
        $this->db->createCommand()->createTable(
            '{{rbac_item}}',
            array(
                'name' => 'varchar(64) NOT NULL',
                'view_id' => 'int(11) NOT NULL',
                'entity_id' => 'int(11) NOT NULL',
                'type' => 'int(11) NOT NULL COMMENT \'0 - OPERATION; 1 - TASK; 2 - ROLE;\'',
                'description' => 'text DEFAULT NULL',
                'bizrule' => 'text DEFAULT NULL',
                'data' => 'text DEFAULT NULL',
            ),
            'ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;'
        );

        $this->db->createCommand()->addPrimaryKey('PK','{{rbac_item}}','name');

        $this->db->createCommand()->createIndex('IDX_{{rbac_item}}_type','{{entity}}','type');

        $this->db->createCommand()->addForeignKey("FK_{{rbac_item}}_view_id", '{{rbac_item}}', 'view_id', '{{view}}', 'view_id', 'NO ACTION', 'NO ACTION');
        $this->db->createCommand()->addForeignKey("FK_{{rbac_item}}_entity_id", '{{rbac_item}}', 'entity_id', '{{entity}}', 'entity_id', 'NO ACTION', 'NO ACTION');
    }

    private function deployRbacItemChild()
    {
        $this->db->createCommand()->createTable(
            '{{rbac_item_child}}',
            array(
                'parent' => 'varchar(64) NOT NULL',
                'child' => 'varchar(64) NOT NULL',
            ),
            'ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;'
        );

        $this->db->createCommand()->addPrimaryKey('PK','{{rbac_item_child}}','parent, child');

        $this->db->createCommand()->createIndex('IDX_{{rbac_item_child}}_child','{{rbac_item_child}}','child');

        $this->db->createCommand()->addForeignKey("FK_{{rbac_item_child}}_parent", '{{rbac_item_child}}', 'parent', '{{rbac_item}}', 'name', 'CASCADE', 'CASCADE');
        $this->db->createCommand()->addForeignKey("FK_{{rbac_item_child}}_child", '{{rbac_item_child}}', 'child', '{{rbac_item}}', 'name', 'CASCADE', 'CASCADE');
    }

    private function deployRbacAssignment()
    {
        $this->db->createCommand()->createTable(
            '{{rbac_assignment}}',
            array(
                'itemname' => 'varchar(64) NOT NULL',
                'userid' => 'int(11) NOT NULL',
                'bizrule' => 'text DEFAULT NULL',
                'data' => 'text DEFAULT NULL',
            ),
            'ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;'
        );

        $this->db->createCommand()->addPrimaryKey('PK','{{rbac_assignment}}','itemname, userid');

        $this->db->createCommand()->createIndex('IDX_{{rbac_assignment}}_itemname','{{rbac_assignment}}','itemname');
        $this->db->createCommand()->createIndex('IDX_{{rbac_assignment}}_userid','{{rbac_assignment}}','userid');

        $this->db->createCommand()->addForeignKey("FK_{{rbac_assignment}}_itemname", '{{rbac_assignment}}', 'itemname', '{{rbac_item}}', 'name', 'CASCADE', 'CASCADE');
    }
}