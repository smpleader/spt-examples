<?php
use PHPUnit\Framework\TestCase;
use Examples\database\entities\DemoEntity; 
use SPT\Query;
use SPT\Extend\Pdo as PdoWrapper;

class DemoEntityTest extends TestCase
{
    private $DemoEntity;
    protected function setUp(): void
    {   
        $db = [
            'host' => '192.168.56.10',
            'username' => 'root',
            'passwd' => '123123',
            'database' => 'demo'
        ];
        $pdo = new PdoWrapper($db['host'], $db['username'], $db['passwd'], $db['database']);
        $query = new Query($pdo, ['#__'=>'test_']);  
        $this->DemoEntity = new DemoEntity($query);
    }

    public function testGetFields()
    {
        $res = $this->DemoEntity->getFields();
        $this->assertIsArray($res);
    }

    /**
     * @depends testGetFields
     */
    public function testAutoGenerate()
    {
        $res = $this->DemoEntity->autoGenerate();
        $this->assertEquals(1, count($res));
    }

    /**
     * @depends testGetFields
     */
    public function testCheckAvailability()
    {
        $res = $this->DemoEntity->checkAvailability();
        $this->assertNotFalse($res);
    }
}
