<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 14/12/2016
 * Time: 21:41
 */

namespace App\Repository\Config;


use Symfony\Component\HttpFoundation\Request;

interface ConfigInformationRepo
{
    public function getConfig();
    public function updateConfig(Request $request);
}