start-docker:
	clear && docker compose --env-file .env -f ./docker/docker-compose.yml up -d 

stop-docker:
	clear && docker compose --env-file .env -f ./docker/docker-compose.yml down --remove-orphans
