<?php

namespace BeeIT\RESTmodule\Api;

interface CustomApiInterface
{
    /**
     * @param string $name
     * @param int $age
     * @return string
     */
    public function getResponse(string $name, int $age): string;
}
