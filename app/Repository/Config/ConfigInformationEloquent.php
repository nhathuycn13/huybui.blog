<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 14/12/2016
 * Time: 21:42
 */

namespace App\Repository\Config;


use Symfony\Component\HttpFoundation\Request;
use Config;
class ConfigInformationEloquent implements ConfigInformationRepo
{
    private $config;
    public function __construct(\App\Model\Config $config) {
        $this->config = $config;
    }

    public function getConfig()
    {
        return $this->config->first();
    }

    public function updateConfig(Request $request)
    {
        return $this->getConfig()->update($request->toArray())  ? response('okie'): response('not ok', 300);
    }

}