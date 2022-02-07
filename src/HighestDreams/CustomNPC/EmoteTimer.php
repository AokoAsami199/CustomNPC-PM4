<?php
declare(strict_types=1);

namespace HighestDreams\CustomNPC;

use HighestDreams\CustomNPC\Entity\CustomNPC;
use pocketmine\network\mcpe\protocol\EmotePacket;
use pocketmine\scheduler\Task;
use pocketmine\Server;
use pocketmine\world\World;
use pocketmine\world\WorldManager;

class EmoteTimer extends Task {

    public function onRun(): void
{
    $level = Server::getInstance()->getWorldManager()->getWorlds();
    $NPC = Server::getInstance()->getOnlinePlayers();
        if ($NPC instanceof CustomNPC) {
            foreach (NPC::get($NPC, 'Settings') as $setting) {
                foreach (NPC::$emotes as $emote => $id) {
                    if ($setting === $emote) {
                        Server::getInstance()->broadcastPacket($NPC->getViewers(), EmotePacket::create($NPC->getId(), $id, 1 << 0));
                    }
                }
            }
        }
    }
}