<?php
/**
 * SPT software - homeController
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

defined( 'APP_PATH' ) or die('');

require 'controller.php';
require APP_PATH. 'models/model.php';

class homeController extends controller 
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
            $this->query->exec(
                'DROP TABLE IF EXISTS `#__demo`;
                CREATE TABLE `#__demo` (
                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT, 
                  `title` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
                  `desc` text COLLATE utf8mb4_unicode_520_ci,
                  PRIMARY KEY (`id`)
                )'
            );
            $this->query->table('#__demo')->insert([
                'title' => 'Title '. rand(1, 999),
                'desc' => 'Bla bla bla.. '. rand(1, 999),
            ]);
            $this->query->table('#__demo')->insert([
                'title' => 'Title '. rand(1, 999),
                'desc' => 'Bla bla bla.. '. rand(1, 999),
            ]);
            $this->query->table('#__demo')->insert([
                'title' => 'Title '. rand(1, 999),
                'desc' => 'Bla bla bla.. '. rand(1, 999),
            ]);
        }
    }

    public function add()
    {
        $this->prepare();
        if($this->get('ready') > 1)
        {
            $this->query->table('#__demo')->insert([
                'title' => 'Title '. rand(1, 999),
                'desc' => 'Bla bla bla.. '. rand(1, 999),
            ]);
            $this->set('msg', 'We added a record');
        }
    }

    public function remove()
    {
        $this->prepare();
        if($this->get('ready') > 1)
        {
            $this->query->table('#__demo')->orderby('id')->limit(1)->delete();
            $this->set('msg', 'We removed a record');
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
            $this->query = new query($db['host'], $db['username'], $db['passwd'], $db['database'], ['#__'=>'test_']);
            //
            if($this->query->isConnected())
            {
                $ping = $this->query->select('id')->table('#__demo')->row();
                $ready = (isset($ping['id']) && $ping['id']) ? 2 : 1;
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
           $list = $this->query->select('*')->table('#__demo')->list();
        }

        $this->set('list', $list);

        parent::display();
    }
}
