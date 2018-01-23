<?php
namespace Piripasa\ArticleManager;

use Illuminate\Support\ServiceProvider;

class ArticleManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/routes.php';

        // To publish views & migrations
        $this->publishes([
            __DIR__.'/views' => base_path('resources/views'),
            __DIR__.'/migrations' => base_path('database/migrations'),
        ]);
    }
    
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Cviebrock\EloquentSluggable\ServiceProvider::class);
        
        // Controllers
        $this->app->make('Piripasa\ArticleManager\Controllers\CategoryController');
        $this->app->make('Piripasa\ArticleManager\Controllers\TagController');
        $this->app->make('Piripasa\ArticleManager\Controllers\ArticleController');
        
        // Models
        $this->app->make('Piripasa\ArticleManager\Models\Category');
        $this->app->make('Piripasa\ArticleManager\Models\Tag');
        $this->app->make('Piripasa\ArticleManager\Models\Article');

        // Views
        $this->loadViewsFrom(__DIR__.'/views/article-manager', 'artiman');
    }
}