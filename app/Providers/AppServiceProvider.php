<?php

namespace App\Providers;

use App\Config;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Вывод значений конфигурации из БД в любой blade шаблон
        //пример: @get_config(AUCTION_OPEN_DATA)
        Blade::directive('get_config', function ($n) {
            $result = NULL;
            if ($n) $result = Config::where('name', $n)->first()->param;  
            return "<?php echo '$result'; ?>";
        });
    }
}
