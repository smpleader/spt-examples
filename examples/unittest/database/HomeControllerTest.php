<?php
use PHPUnit\Framework\TestCase;
use Examples\database\controllers\home;
require_once __DIR__. '/../../database/index.php';

class HomeControllerTest extends TestCase
{
    private $home;
    protected function setUp(): void
    {   
        $this->home = new home();
        $_POST['host'] = '192.168.56.10';
        $_POST['username'] = 'root';
        $_POST['passwd'] = '123123';
        $_POST['database'] = 'demo';
    }

    public function testUpdateDbInfo()
    {
        $this->home->updateDbInfo();
        $result = $_SESSION['dbInfo']; 
        $this->assertNotFalse(count($result), 0);
    }

    /**
     * @depends testUpdateDbInfo
     */
    public function testPrepareDb()
    {
        $res = $this->home->prepareDb();
        $this->assertNotFalse($res);
    }

    /**
     * @depends testUpdateDbInfo
     */
    public function testAdd()
    {
        $this->home->add();
        $res = $this->home->get('msg');
        $this->assertEquals($res, 'We added a record');
    }

    /**
     * @depends testUpdateDbInfo
     * @depends testAdd
     */
    public function testRemove()
    {
        $this->home->remove();
        $res = $this->home->get('msg');
        $this->assertEquals($res, 'We removed a record');
    }

     /**
     * @depends testUpdateDbInfo
     */
    public function testDisplay()
    {
        $this->home->display();
        $res = $this->home->get('list');
        $this->assertIsArray($res);
    }
}
