
# Hello There

I Used Lumen For The Task

 ### Setup Application By make this steps open terminal and:-
 
 - ```$   composer install  ```
 - ``` $ cp .env.example .env ``` 
 - set your configration for database and queue driver (PS: You Can Use mysql and Redis )
 - ```$ php artisan migrate```

###  Start the operation of the Application 

 ```$ php artisan db:seed JsonAccountSeeder ``` 

this will add the head of the operation then

```$ php artisan queue:work ```

this will do all the magic 



You can compelete the operation after you cut off by 

```$ php artisan queue:work ```


## Running Tests

To run tests, run the following command

```bash
./vendor/bin/phpunit
```
