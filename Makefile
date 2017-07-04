migrate:
	bin/cake migrations migrate

server:
	bin/cake server -H 0.0.0.0 -p 8080

clean:
	bin/cake clear -y
