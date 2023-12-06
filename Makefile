up:
	symfony server:stop
	docker compose up -d --wait
	symfony server:start -d
	symfony console messenger:setup-transports
	symfony run -d --watch=config,src,templates,vendor symfony console messenger:consume async
	symfony run -d npx encore dev-server

down:
	docker compose down
	symfony server:stop

tail:
	symfony server:log

open:
	symfony open:local
