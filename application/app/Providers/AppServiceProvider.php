<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->Listen(BuildingMenu::class, function(BuildingMenu $event){

            $role = Auth::user()->role;

            $event->menu->add(
                [
                    'text' => 'Escritorio',
                    'route' => 'home',
                    'icon' => 'dashboard'
                ],
                [
                    'text' => 'Perfil',
                    'route' => 'profile',
                    'icon' => 'user'
                ],
                [
                    'text' => 'Empresas',
                    'route' => 'business.index',
                    'icon' => 'building'
                ],
                [
                    'text' => 'Coordinadores',
                    'route' => 'users.index',
                    'icon' => 'users'
                ],
                [
                    'text' => 'Hoteles',
                    'route' => 'hotels.index',
                    'icon' => 'home'
                ],
                [
                    'text' => 'Cupones',
                    'route' => 'coupons.index',
                    'icon' => 'ticket'
                ],
                [
                    'text' => 'Tipo de Productos',
                    'route' => 'product_types.index',
                    'icon' => 'list'
                ],
                [
                    'text' => 'Productos',
                    'route' => 'products.index',
                    'icon' => 'product-hunt'
                ],
                [
                    'text' => 'Promociones',
                    'route' => 'promotions.index',
                    'icon' => 'archive'
                ]
            );
        });
    }
}