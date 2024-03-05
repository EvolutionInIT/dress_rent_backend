>git clone https://github.com/EvolutionInIT/dress_rent_backend.git

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
>>> php artisan jwt:secret
> 
>>> fresh && php artisan db:seed --class=ApoltiSeeder
>>> //or:
>>>
>>> fresh --seed 
> 
> Api Docs
>> {{http(s)://domain_backend}}/request-docs/