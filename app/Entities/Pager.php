<?php
namespace Contracts\Entities;
interface Pager
{
    function getTotal();
    function getItemCount();
    function getPageLink();
    function getParameters();
}




?>