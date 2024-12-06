<?php

namespace Controllers;

use Controllers\PrivateController;
use Views\Renderer;

class Menu extends PrivateController
{
    public function run(): void
    {
        Renderer::render('menu',[]);
    }
}