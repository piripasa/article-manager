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
        $this->app->register(\Collective\Html\HtmlServiceProvider::class);
        $this->app->register(\Intervention\Image\ImageServiceProvider::class);

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Form', \Collective\Html\FormFacade::class);
        $loader->alias('Html', \Collective\Html\HtmlFacade::class);
        $loader->alias('Image', \Intervention\Image\Facades\Image::class);

        // Controllers
        $this->app->make(\Piripasa\ArticleManager\Controllers\CategoryController::class);
        $this->app->make(\Piripasa\ArticleManager\Controllers\TagController::class);
        $this->app->make(\Piripasa\ArticleManager\Controllers\ArticleController::class);
        
        // Models
        $this->app->make(\Piripasa\ArticleManager\Models\Category::class);
        $this->app->make(\Piripasa\ArticleManager\Models\Tag::class);
        $this->app->make(\Piripasa\ArticleManager\Models\Article::class);

        // Views
        $this->loadViewsFrom(__DIR__.'/views/article-manager', 'article-manager');
    }
}