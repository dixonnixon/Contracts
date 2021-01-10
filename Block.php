<?php
namespace Calcs;
interface Command
{
  function execute();
}

interface Undoable extends Command
{
  function undo();
}

class Idle implements Command
{
  private $reciever;
  function __construct(Reciever $reciever)
  {
    $this->reciever = $reciever;
  }

  function execute()
  {
    $this->reciever->write(".");
  }
}

class AddDate implements Undoable
{
  private $reciever;
  function __construct(Reciever $reciever)
  {
    $this->reciever = $reciever;
    $this->reciever->enableDate();
  }

  function execute()
  {
    $this->reciever->write(".");
  }

  function undo()
  {
    $this->reciever->disableDate();
  }
}

class Invoker 
{
  private Command $command;
  function run()
  {
    $this->command->execute();
  }

  function setCommand(Command $cmd)
  {
    $this->command = $cmd;
  }
}

class Reciever 
{
  private bool $date = false;
  private $output = [];

  function write(string $message)
  {
    $str = "$message";
    if($this->date == true)
    {
      $str .= "[" . date("Y-m-d") . "]";
    }
    $this->output[] = $str;
  }

  function output()
  {
    return join("\n", $this->output);
  }

  function enableDate() { $this->date = true; }
  function disableDate() { $this->date = false; }
}



$i = new Invoker();

$r = new Reciever();

$i->setCommand(new Idle($r));
$i->run();
print_R($r->output());





?>