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
      foreach ($this->getServer()->getLevels() as &$level) {
        $this->getLogger()->info($level->getName());
      }
      if ($p instanceof Player) {
        $pos = $p->getPosition();
        $p->getLevel()->setBlock($pos, new Stone());
        $p->sendMessage("function1 was called...".$p->getLevel()->getName());
      }
    } else if(strtolower($cmd->getName()) == "function2") {
      $this->getLogger()->info(TextFormat::YELLOW . "function2 was called...");
      if ($p instanceof Player) {
        $p->sendMessage("function2 was called...");
      }
    }
    return true;
  }

  /**
  * @param PlayerInteractEvent $event
  *
  * @priority HIGHEST
  * @ignoreCancelled true
  */
  public function onTouch(PlayerInteractEvent $event) {
    $p = $event->getPlayer();
    $i = $event->getItem();
    $p->sendMessage(TextFormat::RED . $i->getName());
  }
}
?>
