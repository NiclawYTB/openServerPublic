<?php

namespace open\niclaw\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;


class open extends Command {

public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
{
    parent::__construct("open", "preparer le serveur pour l'ouverture", "/open",);
}

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player) {
            if (!$sender->hasPermission("open.command")) {
                $sender->sendMessage("Vous n'avez pas la permission d'utiliser cette commande.");
                return true;
            }
            $this->closeServer();
            $this->disableWhitelist();
            $this->setGamemodeSurvival();
            $this->clearPlayerData();
            return true;
        }
        return false;
    }

    private function closeServer(): void {
        $this->getServer()->shutdown();
    }

    private function disableWhitelist(): void {
        $this->getServer()->setWhitelist(false);
    }

    private function setGamemodeSurvival(): void {
        foreach ($this->getServer()->getOnlinePlayers() as $player) {
            $player->setGamemode($this->setGamemodeSurvival(true));
        }
    }

    private function clearPlayerData(): void {
        foreach ($this->getServer()->getOnlinePlayers() as $player) {
            $player->getInventory()->clearAll();
            $player->getEnderChestInventory()->clearAll();
        }
    }
}
