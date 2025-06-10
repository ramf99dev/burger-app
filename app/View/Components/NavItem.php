<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

class NavItem extends Component
{
    public $titulo;
    public $ruta;
    public $active;
    public $img;

    public function __construct($titulo, $ruta, $img)
    {
        $this->titulo = $titulo;
        $this->ruta = $ruta;
        $this->active = $this->isActiveRoute($ruta);
        $this->img = $img;
    }

    protected function isActiveRoute($routePattern)
    {
        $currentRoute = Route::currentRouteName();
        $currentPath = request()->path();

        if ($currentRoute) {
            if ($currentRoute === $routePattern) return true;
            
            if (strpos($currentRoute, $routePattern . '.') === 0) return true;
        }

        $routePath = trim(parse_url(route($routePattern), PHP_URL_PATH), '/');
        if (strpos($currentPath, $routePath) === 0) {
            return $currentPath === $routePath || 
                   strpos($currentPath, $routePath . '/') === 0;
        }

        return false;
    }

    public function render()
    {
        return view('components.nav-item');
    }
}