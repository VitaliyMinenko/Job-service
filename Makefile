stop:
	./vendor/bin/sail stop
up:
	./vendor/bin/sail up -d
	@$(MAKE) job-start
job-start:
	php artisan queue:work


