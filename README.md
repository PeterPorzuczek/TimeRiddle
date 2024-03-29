# TimeRiddle

> TimeRiddle is a web based e-learning platform for programming.
>
> The aim of the project is to publish the code together with the tasks in a way that is clear and accessible to the student. The ability to disable code publication makes it possible for the student to work on the assignments themselves and when the teacher decides to publish the code, they can do so immediately.

# Join Our Community

[![Stargazers repo roster for @PeterPorzuczek/TimeRiddle](https://reporoster.com/stars/PeterPorzuczek/TimeRiddle)](https://github.com/PeterPorzuczek/TimeRiddle/stargazers)

## Preview

### Example course
<div>
	<img src="https://i.imgur.com/qvVdrG3.png" alt="app-preview" width="70%">
</div>

### Admin panel
<div>
	<img src="https://i.imgur.com/mRnIEYU.png" alt="app-preview" width="70%">
</div>

To run application
----
	$ composer install
    $ php artisan key:generate
	$ php artisan serve --host 0.0.0.0 --port 90

To optimize application
----
	$ php artisan route:cache
    $ php artisan config:cache
	$ php artisan optimize
