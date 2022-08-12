<?php

namespace Hafijul233\Form;

use Hafijul233\Form\Builders\FormBuilder;
use Hafijul233\Form\Builders\HtmlBuilder;
use Hafijul233\Form\Providers\GroupFieldServiceProvider;
use Hafijul233\Form\Providers\HorizontalFieldServiceProvider;
use Hafijul233\Form\Providers\InlineFieldServiceProvider;
use Hafijul233\Form\Providers\LabelServiceProvider;
use Hafijul233\Form\Providers\NormalFieldServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\View\Compilers\BladeCompiler;

class FormServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Supported Blade Directives
     *
     * @var array
     */
    protected $directives = ['entities', 'decode', 'script', 'style', 'image', 'favicon', 'link', 'secureLink', 'linkAsset', 'linkSecureAsset', 'linkRoute', 'linkAction', 'mailto', 'email', 'ol', 'ul', 'dl', 'meta', 'tag', 'open', 'model', 'close', 'token', 'label', 'input', 'text', 'password', 'hidden', 'email', 'tel', 'number', 'date', 'datetime', 'datetimeLocal', 'time', 'url', 'file', 'textarea', 'select', 'selectRange', 'selectYear', 'selectMonth', 'getSelectOption', 'checkbox', 'radio', 'reset', 'image', 'color', 'submit', 'button', 'old'];

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->registerPublicAssets();
        $this->registerViews();
        $this->registerRoutes();
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([__DIR__ . '/../../config/form.php' => config_path('form.php')], 'form-config');

        $this->mergeConfigFrom(__DIR__ . '/../../config/form.php', 'form');
    }

    /**
     * Register Asset Publish Exports on public folder
     *
     * @return void
     */
    protected function registerPublicAssets()
    {
        $this->publishes([__DIR__ . '/../../resources/dist/assets' => public_path('vendor/form/assets')], 'form-assets');
    }

    /**
     * Register views.
     *
     * @return void
     */
    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'form');

        $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/form')], 'form-view');
    }

    /**
     * Register Route for testing form Examples
     *
     * @return void
     */
    protected function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(LabelServiceProvider::class);
        $this->app->register(HorizontalFieldServiceProvider::class);
        $this->app->register(GroupFieldServiceProvider::class);
        $this->app->register(InlineFieldServiceProvider::class);
        $this->app->register(NormalFieldServiceProvider::class);

        $this->registerBuilder();

        $this->registerBladeDirectives();
    }

    /**
     * Register the HTML & Form builder instance.
     *
     * @return void
     */
    protected function registerBuilder()
    {
        // Register the HTML builder instance.
        $this->app->singleton('html', function ($app) {
            return new HtmlBuilder($app['url'], $app['view']);
        });
        $this->app->alias('html', HtmlBuilder::class);

        // Register the form builder instance.
        $this->app->singleton('form', function ($app) {
            $form = new FormBuilder($app['html'], $app['url'], $app['view'], $app['session.store']->token(), $app['request']);

            return $form->setSessionStore($app['session.store']);
        });

        $this->app->alias('form', FormBuilder::class);
    }

    /**
     * Register Blade directives.
     *
     * @return void
     */
    protected function registerBladeDirectives()
    {
        $this->app->afterResolving('blade.compiler', function (BladeCompiler $bladeCompiler) {
            $namespaces = [
                'Form' => get_class_methods(FormBuilder::class),
            ];

            foreach ($namespaces as $namespace => $methods) {
                foreach ($methods as $method) {
                    if (in_array($method, $this->directives)) {
                        $snakeMethod = Str::snake($method);
                        $directive = strtolower($namespace) . '_' . $snakeMethod;

                        $bladeCompiler->directive($directive, function ($expression) use ($namespace, $method) {
                            return "<?php echo $namespace::$method($expression); ?>";
                        });
                    }
                }
            }
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['form', FormBuilder::class];
    }
}
