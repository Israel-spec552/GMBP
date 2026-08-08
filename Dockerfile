FROM alpine:3.18
RUN apk add --no-cache bash
WORKDIR /app
COPY . /app
CMD ["sh","-c","echo 'App image placeholder' && sleep 3600"]
