<?php

trait Game
{
    function play(){
        echo "Playing a Game<br/>";
    }
}

trait Music
{
    function play()
    {
        static $x;
        echo ++$x."Playing Music<br/>";
    }
}


class Player // magic bug if u rename class as Play
{
    use Game, Music {
        Game::play as gamePlay;
        Music::play insteadof Game;
    }
}

$player = new Player();
$player->play(); //Playing music
$player->gamePlay(); //Playing a game