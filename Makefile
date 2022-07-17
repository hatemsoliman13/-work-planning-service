build:
	docker-compose up -d --build

up:
	docker-compose up -d

down:
	docker-compose down

stop:
	docker-compose stop

migrate:
	docker exec webapp php ./app/bin/console doctrine:migrations:migrate 

phpunit:
	docker exec webapp php ./app/bin/phpunit ./app/tests