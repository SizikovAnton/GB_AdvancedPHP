<?php

class Player {
    protected $name;
    protected $hitPoint;
    protected $class;

    static $count = 0;

    public function getStatus() {
        echo "<p>Name: {$this->name}</br>HP: {$this->hitPoint}</br>class: {$this->class}</p>";
    }

    protected function __construct($name, $hitPoint = 100, $class = 'none') {
        $this->name = $name;
        $this->hitPoint = $hitPoint;
        $this->class = $class;

        static::$count++;

        echo "Появился новый игрок:";
        $this->getStatus();
        echo "<p>Сейчас игроков:" . static::$count . "</p>";
    }
}

class Warrior extends Player {
    public $damage;

    public function fight(Player $enemy) {
        $enemy->hitPoint -= $this->damage;
        echo "<p>Игрок {$this->name} наносит {$this->damage} урона игроку {$enemy->name}.</br> У игрока {$enemy->name} осталось {$enemy->hitPoint} здоровья.</p>";
    }

    public function __construct($name, $damage = 10, $hitPoint = 100, $class = 'warrior') {
        parent::__construct($name, $hitPoint, $class);
        $this->damage = $damage;
    }
}

class Priest extends Player {
    public $power;

    public function heal(Player $player) {
        $player->hitPoint += $this->power;
        echo "<p>Игрок {$this->name} восстанавливает {$this->power} HP игроку {$player->name}.</br> У игрока {$player->name} теперь {$player->hitPoint} здоровья.</p>";
    }

    public function __construct($name, $power = 15, $hitPoint = 50, $class = 'priest') {
        parent::__construct($name, $hitPoint, $class);
        $this->power = $power;
    }
}


echo "<p>Сейчас игроков:" . Player::$count . "</p>";

$player1 = new Warrior("Вася");
$player2 = new Warrior("Гена");
$player3 = new Priest("Петя");

$player1->fight($player2);
$player3->heal($player2);

echo "<p><b>Задание 5</b></p>";

//Данный код веведет "1234". При каждом вызове метода foo() ствтическое свойство $x будет увеличиваться на единицу. 
//Свойство $x принадлежит классу A, а не его экземплярам, поэтому для всех экземпляров класса эта переменная общая.

/*class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo();*/

echo "<p><b>Задание 5.2</b></p>";

//У дочернего класса B создается своя статическая переменная $x, которая не связана со статической переменной $x из его родительского класса A

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A();
$b1 = new B();
$a1->foo(); 
$b1->foo(); 
$a1->foo(); 
$b1->foo();