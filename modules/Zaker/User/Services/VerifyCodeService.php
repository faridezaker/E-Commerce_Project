<?php

namespace Zaker\User\Services;

class VerifyCodeService
{
    public static function generate()
    {
        return random_int(100000,999999);
    }

    public static function store($id,$code)
    {
        return cache()->set('verify_code_'.$id,$code,now()->addDay());
    }
}
