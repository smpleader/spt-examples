<?php
/**
 * SPT software - Application
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Base abstract implement Container
 * 
 */

namespace Examples\dicontainer\libraries\Core; 

use Joomla\DI\Container;
use Joomla\DI\ContainerAwareTrait;
use Joomla\DI\ContainerAwareInterface;

abstract class Base implements ContainerAwareInterface
{ 
    use ContainerAwareTrait;

    public function __construct(Container $container)
    {
        $this->setContainer($container);
    }

    /**
     * Load automatically dependencies
     */
    public function __get($name)
    { 
        if( 'container' == $name ) return $this->container;
        
        if( $this->container->has($name) )
        {
            return $this->container->get($name);
        }

        throw new \RuntimeException('Invalid Supplier '.$name, 500);
    }
}