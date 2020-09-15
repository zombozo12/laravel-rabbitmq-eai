<p align="center">
<a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a>
<a href="https://rabbitmq.com" target="_blank"><img src="https://www.rabbitmq.com/img/logo-rabbitmq.svg" width="400"></a>
</p>

## Prerequisites
- PHP >= 5
- Laravel 7
- RabbitMQ Server

## Usage
1. Run Laravel Application and let it running
    ```
    php artisan serve
    ```
2. Open a new Terminal to Execute Tinker
    ```
   php artisan tinker
   ```
3. Insert this line of codes into Tinker Terminal and let it running
    ```php
   app()->call('App\Http\Controllers\BrokerController@receive');
   ```
4. Open your browser and go to `http://localhost/send` and send a Message.
5. Check your Tinker Terminal to see a new message received.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
