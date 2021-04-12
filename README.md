# Card Game App - API/REST

## About

This is a simple API/Rest test to ACTO. It's a backend API to be consumed 
by [card-game-web](https://github.com/GustavoMagalhaess/card-game-web) 
frontend.

### Install Dependencies 
```
composer install
```
### Create .env file
```
cp .env-example .env
```
### Run docker-compose
```
./vendor/bin/sail up
```

## How it works

This app is using Laravel Framework. It's a very simple app. There is no auth or CSRF 
protection.

There are only two rotes. One for the winner's list ```/winners``` and other to play the 
game ```/play```.

The app will check if the player alerady exists, if not it'll create a new player and 
store the scores to him. Otherwise updates the player's scores. The player checker will 
only check by name (case insensitive). After each play the app will check if the request 
is valid checking the form fields and cards type and size allowed. Any problem on that 
the app will reponse with 500 code and an array of erros. Otherwise will return the game 
results and a new list of winners.
