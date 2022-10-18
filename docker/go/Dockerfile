FROM golang:1.18-alpine

RUN mkdir /app

WORKDIR /app

COPY ../logger-service/go.mod ./

RUN go mod download

COPY ../logger-service /app

RUN env GOOS=linux CGO_ENABLED=0 go build -o loggerServiceApp ./cmd/api

CMD ["/app/loggerServiceApp"]