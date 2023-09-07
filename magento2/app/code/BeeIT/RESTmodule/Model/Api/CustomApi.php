<?php

namespace BeeIT\RESTmodule\Model\Api;

use BeeIT\RESTmodule\Api\CustomApiInterface;

class CustomApi implements CustomApiInterface
{
    /**
     * @param string $name
     * @param int $age
     * @return string
     */
    public function getResponse(string $name, int $age): string
    {

        $message = '';

        if ($name && $age >= 0) {
            $message = "Hello, my name is $name, I am $age years old.";
            http_response_code(200);
        } else {
            $message = "Custom message explaining what went wrong with processing the request.";
            http_response_code(400);
        }

        return json_encode($message);
    }
}
