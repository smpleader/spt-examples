<?php
/**
 * SPT software - homeController
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

namespace Examples\database\controllers;

defined( 'APP_PATH' ) or die('');

use SPT\Util;
use SPT\Query;
use SPT\Extend\Pdo as PdoWrapper;
use Examples\database\entities\DemoEntity; 
use Examples\database\application;
use Examples\database\models\model; 

class home extends controller 
{
    public function updateDbInfo()
    {
        application::session('dbInfo', [
            'host' => Util::get('host', '', 'post'),
            'username' => Util::get('username', '', 'post'),
            'passwd' => Util::get('passwd', '', 'post'),
            'database' => Util::get('database', '', 'post')
        ], true);
    }

    public function prepareDb()
    {
        $this->prepare();
        if($this->get('ready') === 1)
        {
            // connected, and not setup DB
            $check = $this->DemoEntity->checkAvailability();
            if (!$check === false)
            {
                $data = $this->DemoEntity->autoGenerate(3); 
                foreach ($data as $item) 
                {
                    $try = $this->DemoEntity->add((array) $item);
                    if (!$try)
                    {
                        return false;
                    }
                }
            }
        }
    }

    public function add()
    {
        $this->prepare();
        if($this->get('ready') > 1)
        {
            $data = $this->DemoEntity->autoGenerate(1); 
            $try = $this->DemoEntity->add((array) $data[0]);
            if ($try)
            {
                $this->set('msg', 'We added a record');
            }
            else
            {
                $this->set('msg', 'Add fail');
            }
        }
    }

    public function remove()
    {
        $this->prepare();
        if($this->get('ready') > 1)
        {
            $id = $this->DemoEntity->list(0, 1, [], 'id', 'id');
            $try = $this->DemoEntity->remove($id[0]['id']);
            if ($try)
            {
                $this->set('msg', 'We removed a record');
            }
            else
            {
                $this->set('msg', 'Remove Fail');
            }
        }
    }

    private $query;
    private function prepare()
    {
        $db = application::session('dbInfo', [
            'host' => '',
            'username' => '',
            'passwd' => '',
            'database' => ''
        ]);

        $ready = 0;
        if(empty($db['host']))
        {
            $this->set('msg', 'Let insert Database info to start');
        }
        else
        {
            $pdo = new PdoWrapper($db['host'], $db['username'], $db['passwd'], $db['database']);
            $this->query = new Query($pdo, ['#__'=>'test_']);
            if($this->query->isConnected())
            {
                $this->DemoEntity = new DemoEntity($this->query);
                $ping = $this->DemoEntity->list(0,1);
                $ready = (count($ping)) ? 2 : 1;
                if($ready === 1)
                {
                    $this->set('msg', 'Let click "Set sample data"');
                }
            }
            else
            {
                $this->set('msg', 'Invalid DB');
            }
        }
        
        $this->set('db', $db);
        $this->set('ready', $ready);
    }

    public function display()
    {
        $this->prepare();

        $list = [];

        if($this->get('ready')>1)
        {
           $list = $this->DemoEntity->list(0, 0);
        }

        $this->set('list', $list);

        parent::display();
    }
}
