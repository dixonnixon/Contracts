<?php
namespace Contracts;
class File extends Pager
{
  protected $filename;  // Количество позиций на странице
  private $itemCount;  // Количество ссылок слева и справа  от текущей страницы
  private $pageLink;
  protected $parameters;



  function __construct($filename, $itemCount = 10,
    $pageLink = 3, $parameters = "")
  {
    $this->filename = $filename;
    $this->itemCount = $itemCount;
    $this->pageLink = $pageLink;
    $this->parameters = $parameters;
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
    return $this->pageLink;
  }

  function getPage()
  {
    // var_dump($_GET);
    $page = (empty($_GET['page'])) ? 1 : $_GET['page'];
    
    $total = $this->getTotal();
    $number = (int) ($total/$this->getItemCount());
    $diff = (float)($total/$this->getItemCount()) - $number;
    
    // var_dump("diff = $diff,page = $page, total = $total, number = $number");
    if($diff != 0) 
      $number++;

    // var_dump(($page <= 0 || $page > $number));
    if($page <= 0 || $page > $number) return 0;

    $arr = array();
    $fd = fopen($this->filename, "r");
    
    if(!$fd) return 0;
    
    // Номер, начиная с которого следует
    // выбирать строки файла
    // $first = ($page == 1) 
    //   ? $this->getItemCount()
    //   : ($page - 1) * $this->getItemCount();
    $first = ($page - 1) * $this->getItemCount();
    // var_dump(!$fd);
    // print_r($first . " num = " . $number . ", diff1 = " . ($first + $this->getItemCount() - 1) . "\r\n");

    for($i = 0; $i < $total; $i++)
    {
      $str = fgets($fd, 10000);
      // print_R($str);
      // var_dump(($i < $first));
      if($i < $first) continue;
      if($i > $first + $this->getItemCount() - 1) break;
      $arr[] = $str;
    }
    fclose($fd);
    return $arr;
  }

  function getParameters()
  {
    return $this->parameters;
  }
}
?>