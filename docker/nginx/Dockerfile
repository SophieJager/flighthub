# use this self-generated certificate only in dev, IT IS NOT SECURE!


# https://docs.docker.com/engine/reference/builder/#understand-how-arg-and-from-interact
ARG NGINX_VERSION=1.17

FROM nginx:${NGINX_VERSION}-alpine

# persistent / runtime deps
RUN apk add --no-cache \
		nss-tools \
	;

ARG MKCERT_VERSION=1.4.3
RUN set -eux; \
	wget -O /usr/local/bin/mkcert https://github.com/FiloSottile/mkcert/releases/download/v$MKCERT_VERSION/mkcert-v$MKCERT_VERSION-linux-amd64; \
	chmod +x /usr/local/bin/mkcert; \
	mkcert --cert-file /etc/ssl/server.crt --key-file /etc/ssl/server.key localhost 127.0.0.1 ::1;