<?php
/**
 * SPT software - homeController
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

namespace Examples\database\entities;

defined( 'APP_PATH' ) or die('');

use SPT\Storage\Entity;

class DemoEntity extends Entity
{
    protected $table = '#__demo';
    protected $pk = 'id';

    public function getFields()
    {
        return [
                'id' => [
                    'type' => 'int',
                    'pk' => 1,
                    'option' => 'unsigned',
                    'extra' => 'auto_increment',
                ],
                'title' => [
                    'type' => 'varchar',
                    'limit' => 255,
                    'null' => "YES",
                ],
                'desc' => [
                    'type' => 'text',
                ],
            ];
    }
}