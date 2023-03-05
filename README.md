>git clone repository https://github.com/EvolutionInIT/dress_rent_backend.git

>
> cp _install/laravel/.env src/.env
> 
>git submodule update --init --recursive
> 
> cd laradock
> 
> git checkout v12.1
> 
>cp -R ../_install/laradock ../.
>

> _start docker (laradock) containers:
>> docker compose up -d workspace nginx php-fpm mariadb
> 
>> docker-compose exec workspace bash
>>
>> in workspace container exec:
>>> php artisan key:generate
>>>
>>> composer install
>>>
>>> fresh --seed
>>>
>>> _or better:
>>>
>>> fresh && php artisan db:seed --class=ApoltiSeeder
