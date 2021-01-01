<?php
namespace Contracts;
abstract class Pager
{
  abstract protected function getTotal();  // Общее количество записей
  abstract protected function getItemCount(); // Количество позиций на странице
  abstract protected function getPageLink();
  // Количество ссылок слева и справа
  // от текущей страницы
  
  abstract protected function getParameters();
  // Дополнительные параметры, которые
  // необходимо передать по ссылке

  // Ссылки на другие страницы
  public function __toString()
  {
    // Строка для возвращаемого результата
    $return_page = "";
    // Через GET-параметр page передается номер
    // текущей страницы
    $page = (empty($_GET['page'])) ? 1 : $_GET['page'];
    // Вычисляем число страниц в системе
    $number = (int)($this->getTotal()/$this->getItemCount());
    if((float)($this->getTotal()/$this->getItemCount()) - $number != 0)
    {
      $number++;
    }
    // Проверяем, есть ли ссылки слева
    if($page - $this->getPageLink() > 1)
    {
      $return_page .= "<a href=$_SERVER[PHP_SELF]".
        "?page=1{$this->getParameters()}>
        [1-{$this->getItemCount()}]
        </a>&nbsp;&nbsp;...&nbsp;&nbsp;";
      // Есть
      for($i = $page - $this->getPageLink(); $i<$page; $i++)
      {
        $return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]".
          "?page=$i{$this->getParameters()}>
          [".(($i - 1)*$this->getItemCount() + 1).
          "-".$i*$this->getItemCount()."]
          </a>&nbsp;";
      }
    }
    else
    {
      // Нет
      for($i = 1; $i<$page; $i++)
      {
        $return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]".
        "?page=$i{$this->getParameters()}>
        [".(($i - 1)*$this->getItemCount() + 1).
        "-".$i*$this->getItemCount()."]
        </a>&nbsp;";
      }
    }
    // Проверяем, есть ли ссылки справа
    if($page + $this->getPageLink() < $number)
    {
      // Есть
      for($i = $page; $i<=$page + $this->getPageLink(); $i++)
      {
      if($page == $i)
        $return_page .= "&nbsp;[".
        (($i - 1) * $this->getItemCount() + 1).
        "-".$i*$this->getItemCount()."]&nbsp;";
      else
        $return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]".
        "?page=$i{$this->getParameters()}>
        [".(($i - 1)*$this->getItemCount() + 1).
        "-".$i*$this->getItemCount()."]
        </a>&nbsp;";
      }
      $return_page .= "&nbsp;...&nbsp;&nbsp;".
      "<a href=$_SERVER[PHP_SELF]".
      "?page=$number{$this->getParameters()}>
      [".(($number - 1)*$this->getItemCount() + 1).
      "-{$this->getTotal()}]
      </a>&nbsp;";
    }
    else
    {
      // Нет
      for($i = $page; $i<=$number; $i++)
      {
        if($number == $i)
        {
          if($page == $i)
          $return_page .= "&nbsp;[".
            (($i - 1) * $this->getItemCount() + 1).
            "-{$this->getTotal()}]&nbsp;";
          else
            $return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]".
            "?page=$i{$this->getParameters()}>
            [".(($i - 1) * $this->getItemCount() + 1).
            "-{$this->getTotal()}]
            </a>&nbsp;";
        }
        else
        {
        if($page == $i)
          $return_page .= "&nbsp;[".
            (($i - 1) * $this->getItemCount() + 1).
            "-".$i*$this->getItemCount()."]&nbsp;";

        else
        $return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]".
        "?page=$i{$this->getParameters()}>
        [".(($i - 1) * $this->getItemCount() + 1).
        "-".$i*$this->getItemCount()."]
        </a>&nbsp;";
        }
      }
    }
    return $return_page;
  }
}

?>