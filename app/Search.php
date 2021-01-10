<?php
namespace Contracts;
class  Search extends File
{
    private $search;
    
    public function __construct($search,
        $filename,
        $itemCount = 10,
        $pageLink = 3
    ) 
    {
        parent::__construct($filename, $itemCount = 10, $pageLink = 3,
            "&search=". urlencode($search)
        );
        $this->search = $search;
    }

    function getTotal()
    {
        $countline = 0;
        // Открываем файл
        $fd = fopen($this->filename, "r");
        if($fd)
        {
            // Подсчитываем количество записей
            // в файле
            while(!feof($fd))
            {
                $str = fgets($fd, 10000);
                if(preg_match("|^".preg_quote($this->search)."|i", $str))
                {
                    $countline++;
                }
            }
            // Закрываем файл
            fclose($fd);
        }
        return $countline;
    }

    public function getPage()
    {
        // Текущая страница
        $page = (empty($_GET['page'])) ? 1 : $_GET['page'];
        if(empty($page)) $page = 1;
        // Количество записей в файле
        $total = $this->getTotal();
        // Вычисляем число страниц в системе
        $number = (int)($total/$this->getItemCount());
        if((float)($total/$this->getItemCount()) - $number != 0) $number++;
        // Проверяем, попадает ли запрашиваемый номер
        // страницы в интервал от 1 до get_total()
        if($page <= 0 || $page > $number) return 0;
        // Извлекаем позиции текущей страницы
        $arr = array();
        
        $fd = fopen($this->filename, "r");
        if(!$fd) return 0;
        // Номер, начиная с которого следует
        // выбирать строки файла
        $first = ($page - 1) * $this->getItemCount();
        $countline = 0;
        while(!feof($fd))
        {
            $str = fgets($fd, 10000);
            if(preg_match("|^".preg_quote($this->search)."|i", $str))
            {
                $countline++;
                // Пока не достигнут номер $first,
                // досрочно заканчиваем итерацию
                if($countline < $first) continue;
                // Если достигнут конец выборки,
                // досрочно покидаем цикл
                if($countline > $first + $this->getItemCount() - 1) break;
                // Помещаем строки файла в массив,
                // который будет возвращен методом
                $arr[] = $str;
            }
        }
        // Закрываем файл
        fclose($fd);
        return $arr;
    }
}
?>