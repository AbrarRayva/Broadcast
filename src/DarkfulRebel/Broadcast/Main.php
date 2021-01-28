<?php

namespace DarkfulRebel\Broadcast;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener{

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->getResource("config.yml");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        if($command->getName() === "broadcast") {
            if(isset($args[0])) {
                $message = implode(" ", $args);
                $sender->getServer()->broadcastMessage($this->getConfig()->get("broadcast-prefix") . $message);
            } else {
                $sender->sendMessage($this->getConfig()->get("plugin-prefix") . "Usage: /broadcast <message>");
            }
        }
        return true;
    }
}