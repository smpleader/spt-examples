<?php
use PHPUnit\Framework\TestCase;
use Examples\database\controllers\home;
require_once __DIR__. '/../database/index.php';

class DemoTest extends TestCase
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
    public function testPrepare()
    {
        $this->home->prepare();
        var_dump($this->home); die;
    }
}
