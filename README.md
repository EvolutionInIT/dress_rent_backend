>git clone repository https://github.com/EvolutionInIT/dress_rent_backend.git

>
> cp _install/laravel/.env src/.env
> 
>git submodule update --init --recursive
>
>cp -R _install/laradock .
>
> cd laradock
> 
> git checkout v12.1
>
> _start docker (laradock) containers:
>> docker compose up -d workspace nginx php-fpm mariadb
>> 
>> docker-compose exec workspace bash
>>
>> _in workspace container exec:
>>> composer install
>>>
>>> php artisan key:generate
>>>
>>> fresh --seed
>>>
>>> _or better:
>>>
>>> fresh && php artisan db:seed --class=ApoltiSeeder
> 
> >> Когда хрень какая-то выходит там, при переносе папок и с путями, это может помочь нам
composer du
