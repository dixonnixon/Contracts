<?php
namespace Contracts;
class File extends Pager
{
  protected $filename;  // Количество позиций на странице
  private $itemCount;  // Количество ссылок слева и справа  от текущей страницы
  private $pageLink;


  function __construct($itemCount, $filename)
  {
    $this->itemCount = $itemCount;
    $this->filename = $filename;
    var_dump("itemCount = " .$this->itemCount);
  }

  function getTotal()
  {
    $count = 0;

    $fd = fopen($this->filename, "r");
    // var_dump($fd);
    if($fd)
    {
    // Подсчитываем количество записей
    // в файле
    while(!feof($fd))
    {
      fgets($fd, 10000);
      $count++;
    }
    // Закрываем файл
    fclose($fd);
  }
    return $count;
  }

  function getItemCount()
  {
    return $this->itemCount;
  }

  function getPageLink()
  {

  }

  function getPage()
  {
    // var_dump($_GET);
    $page = (empty($_GET['page'])) ? 1 : $_GET['page'];
    
    $total = $this->getTotal();
    $number = (int) ($total/$this->getItemCount());
    var_dump("total = $total, number = $number");
    if((float)($total/$this->getItemCount()) - $number != 0) 
      $number++;

    if($page <= 0 || $page > $number) return 0;

    


    $arr = array();
    $fd = fopen($this->filename, "r");
    if(!$fd) return 0;
    // Номер, начиная с которого следует
    // выбирать строки файла
    $first = ($page - 1) * $this->getItemCount();
    print_r($first);

  }

  function getParameters()
  {
    return $this->parameters;
  }
}
?>