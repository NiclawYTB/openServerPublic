<?php

namespace niclaw\EffectForm;

use open\niclaw\command\open;
use open\niclaw\command\OpenPlugin;
use pocketmine\plugin\PluginBase;
use raklib\protocol\OpenConnectionReply1;

class Main extends PluginBase
{

    public function onEnable(): void
    {
        $this->getServer()->getLogger()->info("§2Le Plugin open est activé");

        $this->getServer()->getCommandMap()->registerAll('commands', [
            new open()
        ]);
    }

    public function onDisable(): void
    {
        $this->getServer()->getLogger()->info("§2Le Plugin open est desactivé");
    }


}