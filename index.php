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
    else
    if($_GET['operation'] == 'addscripture')
    {
        $book = $_POST['book'];
        $chapter = $_POST['chapter'];
        $verse = $_POST['verse'];
        $content = $_POST['content'];
        $topics = "";
        if(isset($_POST['topics']))
        {
            $topics = $_POST['topics'];
        }
        $other = $_POST['other'];
        $othertopic = $_POST['othertopic'];

        if(isset($other))
        {
            if($othertopic=="")
            {
                echo "<script>alert('Enter your topic')</script>";
                require_once("views/scriptures.phtml");
                return false;
            }
        }

        $result = $script->saveScripture($book,$chapter,$verse,$content,$topics,$other,$othertopic);

        if($result > 0)
        {
            echo "<script>alert('Succesfull input')</script>";
        }
        else
        {
            echo "<script>alert('Try again')</script>";
        }

        require_once("views/scriptures.phtml");
    }
}
else
{
    require_once("views/scriptures.phtml");
}