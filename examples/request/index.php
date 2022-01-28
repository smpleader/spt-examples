<?php
/**
 * SPT software - Demo application
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: How we setup a website
 * 
 */

define( 'APP_PATH', __DIR__ . '/');

require APP_PATH.'/../../vendor/autoload.php';
use SPT\Log;

$request = new SPT\Request\Base();

Log::add(
    '<h2>How Request filter SERVER["HOSTNAME"] with integer</h2>',
    $request->server->get('HOSTNAME', '', 'int'),
    '<h2>GET variables</h2>',
    '<pre>',
    $request->get->getAll(),
    '</pre>',
    '<h2>POST variables</h2>',
    '<pre>',
    $request->post->getAll(),
    '</pre>',
    '<h2>ENV variables</h2>',
    '<pre>',
    $request->env->getAll(),
    '</pre>',
    '<h2>FILE variables</h2>',
    '<pre>',
    $request->file->getAll(),
    '</pre>',
    '<h2>Header variables</h2>',
    '<pre>',
    $request->header->getAll(),
    '</pre>',
    '<h2>Server variables</h2>',
    '<pre>',
    $request->server->getAll(),
    '</pre>',
    '<h2>CLI parameters</h2>',
    '<pre>',
    $request->cli->getAll(),
    '</pre>',
);

Log::show();
