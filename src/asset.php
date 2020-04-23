<?php
/**
 * SPT software - Asset
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A way to log some information for admin
 * 
 */

defined( 'SPT_PATH' ) or die('');

class Asset extends baseObj
{
    public function __construct(string $link, array $dependencies = array())
    {
        $this->set('url', $link);

        $x = parse_url($link);
        $y = explode('/', $x['path']);
        $x = array_pop($y);

        $this->set('isMin', strpos($x, '.min.'));

        $y = explode('.', $x);

        $this->set('type', array_pop($y));
        $this->set('id', implode('.', $y));
        $this->set('parents', $dependencies);
    }

    public function getType()
    {
        return in_array($this->get('type'), ['css', 'js', 'jsx', 'xcss']) ? $this->get('type') : 'unknown';
    }
}
