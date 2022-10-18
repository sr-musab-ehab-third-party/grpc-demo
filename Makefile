up_build:
	@echo "Stopping docker images (if running...)"
	docker-compose down
	@echo "Building (when required) and starting docker images..."
	docker-compose up --build -d
	@echo "Docker images built and started!"
	@echo "Composer install . . ."
	docker-compose exec php_service rm -rf vendor composer.lock
	docker-compose exec php_service composer install --no-interaction