<?php

namespace Logicrays\ChatApp;

use Illuminate\Support\Facades\File;

use Illuminate\Support\ServiceProvider;

class ChatAppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . 'migrations');


        $this->publishes(
            [__DIR__ . '/Events' => app_path('/Events/ChatApp')],
            'chatapp'
        );

        $this->publishes(
            [__DIR__ . '/Listeners' => app_path('/Listeners/ChatApp')],
            'chatapp'
        );

        $this->publishes(
            [__DIR__ . '/Livewire' => app_path('/Livewire/ChatApp')],
            'chatapp'
        );

        $this->publishes(
            [__DIR__ . '/components' => resource_path('/views/vendor/chat-app/components')],
            'chatapp'
        );

        if (File::exists(app_path('Livewire/ChatApp/ChatApp.php'))) {
            $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        }

        if (File::exists(storage_path('views/vendor/chat-app/components/chats'))) {
            $this->loadViewsFrom(__DIR__ . '/views/vendor/chat-app/components/chats', 'chat-app');
        } else {
            $this->loadViewsFrom(__DIR__ . '/components/chats', 'chat-app');
        }

        $this->publishes(
            [__DIR__ . '/views' => resource_path('/views/livewire/chat-app')],
            'chatapp'
        );

        $this->bindEventListeners();
    }

    public function register()
    {


        $this->publishes([
            __DIR__ . '/migrations' => $this->app->databasePath() . '/migrations'
        ], 'migrations');
    }


    protected function bindEventListeners()
    {
        $this->app['events']->listen(
            'App\Events\ChatApp\SendMessagEvent',
            'App\Listeners\ChatApp\SendMessageListener@handle'
        );
    }
}
