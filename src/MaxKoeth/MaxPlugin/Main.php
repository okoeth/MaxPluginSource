<?php
namespace MaxKoeth\MaxPlugin;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\block\Stone;
use pocketmine\utils\TextFormat;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\math\Vector3;

class Main extends PluginBase implements Listener {
  /*
   *  onLoad: Will be called when plugin in loaded
   */
  public function onLoad() {
    $this->getLogger()->info(TextFormat::YELLOW . "Loading MaxPlugin v1.0 by Max Koeth...");
  }

  /*
   *  onEnable: Will be called when plugin in enabled
   */
  public function onEnable() {
    $this->getLogger()->info(TextFormat::YELLOW . "Enabling MaxPlugin...");
    $this->getServer()->getPluginManager()->registerEvents($this,$this);
  }
  
  /*
   *  onDisable: Will be called when plugin is disabled
   */
  public function onDisable() {
    $this->getLogger()->info(TextFormat::YELLOW . "Disabling MaxPlugin...");
  }
  
  /*
   *  onCommand: Will be called when command was entered
   */
  public function onCommand(CommandSender $p, Command $cmd, $label, array $args) {
    if(strtolower($cmd->getName()) == "function1") {
      $this->getLogger()->info(TextFormat::YELLOW . "function1 was called...");
    } else if(strtolower($cmd->getName()) == "function2") {
      $this->getLogger()->info(TextFormat::YELLOW . "function2 was called...");
    } else if(strtolower($cmd->getName()) == "chat") {
      $this->getLogger()->info(TextFormat::YELLOW . "chat was called...");
      $this->onCommandChat($p, $cmd, $label, $args);
    }
    return true;
  }

  /*
   *  onCommandChat: Unsere eigene Chat Funktion
   */
  public function onCommandChat(CommandSender $p, Command $cmd, $label, array $args) {
    if ($p instanceof Player) {
      $p->sendMessage("Chat was called...");

      # Pruefe Anzahl der Parameter
      if (count($args)<2) {
        $p->sendMessage("Parameter missing, read the help");
      }

      # Verbinde hintere Parameter zu einer Message
      $message=$args[1];
      for ($i=2; $i<count($args); $i=$i+1) { 
        $message=$message . " " . $args[$i];
        $this->getLogger()->info($message);
      }

      # Suche den Adressaten der Message
      $playername=$args[0];
      $player=$this->getServer()->getPlayer($playername);

      # Wenn gefunden, schicke die Message
      if ($player==null) {
        $p->sendMessage("Player is offline");
      } else {
        $player->sendMessage($message);
      }      
    }
  }

  /*
   *  onTouch: Will be called when touched by item
   */
  public function onTouch(PlayerInteractEvent $event) {
    $p = $event->getPlayer();
    $i = $event->getItem();
    // $p->sendMessage(TextFormat::RED . $i->getName());
  }
}
?>
