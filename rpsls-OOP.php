<?php

class Element {
    private $name;
    private $winsAgainst;

    public function __construct($name, $winsAgainst) {
        $this->name = $name;
        $this->winsAgainst = $winsAgainst;
    }

    public function getName() {
        return $this->name;
    }

    public function winsAgainst(Element $opponent) {
        return in_array($opponent->getName(), $this->winsAgainst);
    }
}

class Game {
    private $elements;

    public function __construct() {
        $this->elements = [
            'rock' => new Element('rock', ['scissors', 'lizard']),
            'paper' => new Element('paper', ['rock', 'spock']),
            'scissors' => new Element('scissors', ['paper', 'lizard']),
            'lizard' => new Element('lizard', ['paper', 'spock']),
            'spock' => new Element('spock', ['rock', 'scissors']),
        ];
    }

    public function play($yourChoice) {
        $yourChoice = strtolower($yourChoice);

        if (!isset($this->elements[$yourChoice])) {
            return "Invalid choice!";
        }

        $yourElement = $this->elements[$yourChoice];
        $opponentElement = $this->getRandomElement();

        echo "You chose " . $yourElement->getName() . "\n";
        echo "Opponent chose " . $opponentElement->getName() . "\n";

        if ($yourElement->getName() === $opponentElement->getName()) {
            return "It's a draw!";
        } elseif ($yourElement->winsAgainst($opponentElement)) {
            return "You win!";
        } else {
            return "You lose!";
        }
    }

    private function getRandomElement() {
        $elementNames = array_keys($this->elements);
        $randomName = $elementNames[array_rand($elementNames)];
        return $this->elements[$randomName];
    }
}

$game = new Game();

$guess = readline("Rock, Paper, Scissors, Lizard or Spock? ");

echo $game->play($guess);