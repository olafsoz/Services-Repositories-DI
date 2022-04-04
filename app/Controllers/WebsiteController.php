<?php

namespace App\Controllers;

use App\Redirect;

class WebsiteController
{
    public function main(): Redirect
    {
        return new Redirect('/home');
    }
}