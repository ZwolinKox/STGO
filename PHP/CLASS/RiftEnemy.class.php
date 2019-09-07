<?php
class RiftEnemy {
    private $hp = 100;
    private $armor = 100;
    private $level = 1;
    private $attackDamage = 50;

    function __construct($level) {
        if($level > 1)
        {
            for($i=0; $i<$level-1; $i++)
            {
                $this->levelUp();
            }
        }
    }

    public function levelUp() {
        $this->hp = $this->hp + 100;
        $this->armor = $this->armor + 50;
        $this->level++;
        $this->attackDamage = $this->attackDamage + 30;
    }

    public function getStat() {
        $enemyStats = array(
            "hp" => $this->hp,
            "armor" => $this->armor,
            "level" => $this->level,
            "damage" => $this->attackDamage
        );
        return $enemyStats;
    }
}
?>