<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\ShoppingCart;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrapFive(); // Dùng Bootstrap 5
        View::composer('*', function ($view) {
            $user = Auth::user();
            $cartCount = 0;
    
            if ($user) {
                $shoppingCart = ShoppingCart::where('user_id', $user->user_id)->first();
                if ($shoppingCart) {
                    $cartCount = $shoppingCart->cartItems->sum('qty');
                }
            }
    
            $view->with('cartCount', $cartCount);
        });
    }
}
