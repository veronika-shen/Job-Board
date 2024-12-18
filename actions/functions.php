<?php

function sessionOn()
{
    if(!isset($_SESSION['company_id'])){
        header('location: /jobboard2/login.html');
    }
}

function isAdmin()
{
    if(!isset($_SESSION['company_id']) && $_SESSION['isAdmin'] == 1){
        header('location: /jobboard2/login.html');
    }
}

function isNotAdmin()
{
    if(!isset($_SESSION['company_id']) && $_SESSION['isAdmin'] == 0){
        header('location: /jobboard2/login.html');
    }
}

function generateSlug($stroka) {

    $rus=array('А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я','а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',' ');

    $lat=array('a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya','a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya',' ');

    $stroka = str_replace($rus, $lat, $stroka); // перевеодим на английский
    $stroka = str_replace('-', '', $stroka); // удаляем все исходные "-"
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $stroka); // заменяет все символы и пробелы на "-"
    return $slug;
}
