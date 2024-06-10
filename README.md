# ChatApp

ChatApp is a simple and flexible chat application package built using LiveWire and Beyond WebSocket. It provides real-time chat functionality for web applications, making it easy to integrate and customize according to your project requirements.

---

## Features

- Real-time chat functionality.
- Built with LiveWire for seamless server-side rendering.
- Beyond WebSocket for efficient WebSocket communication.
- Easy integration and customization.

## Installation

You can install the package via composer if this command give error add
`:dev-main` at last as a version:

```bash
composer require mevadakalpesh/chatapp
```

Add This Provider in `Providers` in `config/app.php` after installing the
package

```bash
Mevadakalpesh\ChatApp\ChatAppServiceProviders
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Mevadakalpesh\ChatApp\ChatAppServiceProvider" --tag=chatapp
```

Add this code in your package.json

```bash
"dependencies": {
		.......

        "emojionearea": "^3.4.2",
        "laravel-echo": "^1.15.3",
        "pusher-js": "^8.4.0-rc2"

        .......
}
```

after adding this,run this command

```bash
npm install
```

after that make a model by run this command

```bash
php artisan make:model Message
```

and replace this code in the Message model

```bash
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $guarded = [];
}
```

Add or replace this code in the `resources/js/bootstrap.js`

```bash
import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});
```

change or add this some ENV variables

```bash
BROADCAST_DRIVER=pusher


PUSHER_APP_ID=LOGICID
PUSHER_APP_KEY=LOGICWI828
PUSHER_APP_SECRET=KSK8372U
PUSHER_HOST=127.0.0.1
PUSHER_PORT=6001
PUSHER_SCHEME=http
PUSHER_APP_CLUSTER=mt1
```

run this command for start websockets

```bash

php artian route:clear
php artisan route:clear
php artisan websockets:ser

```

now test the chat app by entering this url `http://127.0.0.1:8001/chat-app/`

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
