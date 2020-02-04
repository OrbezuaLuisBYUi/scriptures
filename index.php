<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 01/02/2020
 * Time: 12:06 PM
 */
require_once("db/db.php");
require_once("controllers/controllerScriptures.php");

if(isset($_GET['operation']))
{
    if($_GET['operation'] == 'detail')
    {
        $search = $_POST['search'];
        require_once("views/scripturesDetails.phtml");
    }
}
else
{
    require_once("views/scriptures.phtml");
}