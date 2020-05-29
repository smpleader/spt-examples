<?php
/**
 * SPT software - Query class, wrap db.class for simpler and more advanced usage
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a query shortcut
 * 
 */

defined( 'APP_PATH' ) or die('');

class query
{
    private $db;
    private $query;

    private $prefix;
    private $qq;
    private $table;
    private $fields;
    private $join;
    private $where;
    private $value;
    private $orderby;
    private $limit;

    public function __construct($host, $username, $password, $database, $prefix, $fquota='`')
    {
        $this->db = new PDOWrapper($host, $username, $password, $database);
        
        if($this->db === false)
        {
            die('Invalid DB connection');
        }
        $this->prefix = $prefix;
        $this->qq = $fquota;
        $this->reset();
    }

    private function reset()
    {
        $this->query = '';
        $this->table = '';
        $this->fields = [];
        $this->join = [];
        $this->where = [];
        $this->value = [];
        $this->orderby = '';
        $this->limit = '';
    }

    private function prefix($q)
    {
        if(fncArray::ifReady($this->prefix))
        {
            foreach($this->prefix as $find=>$replace)
            {
                $q = str_replace($find, $replace, $q);
            }
        }
        return $q;
    }

    private function qq($name)
    {
        if( strpos($name, '.') !== 0 && strpos($name, '`.`') === false)
        {
            $name = str_replace('.', '`.`', $name);
        }

        if( strpos($name, $this->qq) !== 0 && strpos($name, ' as ') !== false)
        {
            $name = $this->qq. $name .$this->qq;
        }

        return $name;
    }

    public function isConnected()
    {
        return $this->db->connected;
    }

    public function table($name)
    {
        $this->table = $this->qq($this->prefix($name));
        return $this;
    }

    public function select($fields){

        if(fncArray::ifReady($fields))
        {
            $this->fields[] = $this->qq. implode($this->qq. ','.$this->qq, $fields).$this->qq;
        }
        elseif(is_string($fields))
        {
            if( strpos($fields, '*') === false && strpos($fields, ',') === false )
            {
                $fields = $this->qq($fields);
            }

            $this->fields[] = $fields;
        }
  
        return $this;
    }


    public function where($conditions){

        if(fncArray::ifReady($conditions))
        {
            foreach($conditions as $key=>$val)
            {
                
                if(is_array($val))
                {
                    $ws = $this->qq($key). ' '. $val[0]. ' ?';
                    $this->value($val[1]);
                }
                else
                {
                    $ws = $this->qq($key).' = ?';
                    $this->value($val);
                }
                $this->where($ws);
            }
        }
        elseif(is_string($conditions))
        {
            $this->where[] = $conditions;
        }
  
        return $this;
    }

    public function value($value, $place="where"){

        if(is_object($value) || is_array($value))
        {
            foreach($value as $val)
            {
                $this->value($val, $place);
            }
        }
        else
        {
            $this->value[$place][] = $value;
        }
  
        return $this;
    }

    public function getValue()
    {
        $arr = [];
        foreach(['update', 'insert', 'where'] as $place)
        {
            if(isset($this->value[$place])){
                foreach($this->value[$place] as $value)
                {
                    $arr[] = $value;
                }
            }
        }
        
        return $arr;
    }

    public function orderby($order){

        if(fncArray::ifReady($order))
        {
            $this->orderby = implode(' ', $order);
        }
        elseif(is_string($order))
        {
            $this->orderby = $order;
        }
  
        return $this;
    }

    public function limit($limit){

        if(fncArray::ifReady($limit))
        {
            $this->limit = implode(', ', $limit);
        }
        elseif(is_string($limit) || is_numeric($limit))
        {
            $this->limit = $limit;
        }
  
        return $this;
    }

    public function join($joins){

        if(fncArray::ifReady($joins))
        {
            foreach($joins as $j)
            {
                if(is_string($j))
                {
                    $this->join[] = $j;
                }
                elseif(fncArray::ifReady($j))
                {
                    if(count($j) == 2)
                    {
                        $this->join[] = $j[0]. ' JOIN '. $j[1];
                    }
                    else
                    {
                        $this->join[] = implode(' ', $j);
                    }
                }
            }
        }
        elseif(is_string($joins))
        {
            $this->join[] = $joins;
        }
  
        return $this;
    }

    private function buildSelect()
    {
        if(empty($this->table)) die('Invalid query table');
        if(empty($this->fields)) die('Invalid query fields');

        $q = 'SELECT '. implode(',', $this->fields). ' FROM '.$this->table;

        if(count($this->join))
        {
            foreach($this->join as $join)
            $q .=  $join."\n ";
        }

        if(count($this->where))
        {
            $q .= ' WHERE '. implode(' AND ', $this->where);
        }

        if(!empty($this->orderby))
        {
            $q .= ' ORDER BY '.$this->orderby;
        }

        if(!empty($this->limit))
        {
            $q .= ' LIMIT '.$this->limit;
        }
        
        $this->query = $this->prefix($q);
    }

    public function row($conditions=array())
    {
        $this->where($conditions);
        $this->buildSelect();
        $data =  $this->db->fetch($this->query, $this->getValue());
        $this->reset();
        return $data;
    }

    public function list($start='0', $limit='20', $order='')
    {
        $this->limit($start.', '.$limit);
        $this->orderby($order);
        $this->buildSelect();
        $data = $this->db->fetchAll($this->query, $this->getValue());
        // debug $this->query here
        $this->reset();
        return $data;
    }

    public function insert($data=array())
    {
        $indexNum = false;
        if(is_array($data) || is_object($data))
        {
            foreach($data as $key=>$value)
            {
                if($key === 0)
                {
                    $indexNum = true;
                    break;
                }
                $this->select($key);
                $this->value($value, 'insert');
            }
        }

        if($indexNum)
        {
            $this->value($data, 'insert');
        }

        $value = array_fill(0, count($this->fields), '?');

        $q = 'INSERT INTO '. $this->table . '( '. implode(',', $this->fields ). ') VALUES ('. implode(',', $value).')';
 
        $this->sql = $this->prefix($q);

        $id = $this->db->insert($this->sql, $this->getValue());
        // Debug $q
        $this->reset();
        return $id;
    }

    public function update($data=array(), $conditions=array())
    {

        $updates = array();
 
        foreach( $data as $key=>$val)
        {
            $updates[] = $this->qq. $key. $this->qq. '= ?';
            $this->value($val, 'update');
        }

        $q = 'UPDATE '. $this->table . ' SET '. implode(',', $updates) ;

        $this->where($conditions);

        if(count($this->where))
        {
           
            $q .= ' WHERE '. implode(' AND ', $this->where);
        }

        $this->sql = $this->prefix($q);
 
        $res = $this->db->update($this->sql, $this->getValue());
        // Debug $q
        $this->reset();
        return $res;
    }

    public function delete($conditions=array())
    { 
        $q = 'DELETE FROM '. $this->table ;

        $this->where($conditions);

        if(count($this->where))
        {
           
            $q .= ' WHERE '. implode(' AND ', $this->where);
        }

        if(!empty($this->orderby))
        {
            $q .= ' ORDER BY '.$this->orderby;
        }

        if(!empty($this->limit))
        {
            $q .= ' LIMIT '.$this->limit;
        }

        $this->sql = $this->prefix($q);
 
        $res = $this->db->delete($this->sql, $this->getValue());
        // Debug $q
        $this->reset();
        return $res;
    }

    public function exec($sql)
    { 
        $this->query = $this->prefix($sql);
        $res = $this->db->exec($this->query);
        // Debug $q
        $this->reset();
        return $res;
    }
}
