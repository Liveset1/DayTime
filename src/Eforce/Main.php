<?php

/**
 * Copyright 2019 Eforce
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

declare(strict_types = 1);

namespace Eforce;

use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {

     public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info(C::GREEN."Activated by Eforce");
    }

    public function onDisable() {
$this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->getLogger()->info(TextFormat::RED . "Shutting Down");
    }
    
    /*@var command*/
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool {
      if (strtlower($cmd->getName()) == "dayt"){
          $this->sendEforce();
      }
}

	public function sendEforce($player){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $player, int $data = null){
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
                    $player->sendMessage(TextFormat::GREEN . "§aSuccessfully changed the time to day");
                    $player->getLevel()->setTime(0);
                    $player->addTitle("§l§eTIME CHANGED", "§r§7You have changed the time!");
                break;
                    
                case 1:
                    $player->sendMessage(TextFormat::GREEN . "§aYou have cancel the command");
                break;
            }
            
            
            });
            $form->setTitle("§l§eDAY CHANGER");
            $form->setContent("§l§aARE YOU SURE?\n\n§l§7 -§r§7 Please choose an option to continue!\n\n§l§7 -§r§7 A day can not be undo");
            $form->addButton("§l§eDAY TIME\n§r§bTap to change day", 0, "textures/items/book_written");
            $form->addButton("§l§cExit\n§r§bTap to exit", 0, "textures/blocks/barrier");            
            $form->sendToPlayer($player);
            return $form;                                            
    }
}
 