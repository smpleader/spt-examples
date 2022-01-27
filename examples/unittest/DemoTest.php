<?php
use PHPUnit\Framework\TestCase;
use Examples\database\controllers\home;

class DemoTest extends TestCase
{
    protected function setUp(): void
    {   
        $this->home = new home();
        $_POST['host'] = '192.168.56.10';
        $_POST['username'] = 'root';
        $_POST['passwd'] = '123123';
        $_POST['database'] = 'demo';
    }

    public function testAdd()
    {
        $this->assertNotFalse(false);
    }
}
