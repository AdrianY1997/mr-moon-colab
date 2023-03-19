<?php

namespace App\Site\Controllers;

use Lib\Foxy\Core\Base\Controller;

class ErrorController extends Controller
{
    public function code($msg)
    {
        $codes = [
            "page-not-found" => [
                "404",
                "The page you're looking for no longer exits <br> return to the home page and remember: you haven't seen anything."
            ],

            "missing-permissions" => [
                "405",
                "the page you are trying to access needs additional user permissions, please contact the administrator to solve the problem."
            ],
            "service-unavailable" => [
                "503",
                "Sorry, this page is currently under construction or undergoing maintenance. Please check back later."
            ]
        ];

        [$code, $subtitle] = $codes[$msg];

        render("default/error", [
            "code" => $code,
            "subtitle" => $subtitle
        ]);
    }
}
