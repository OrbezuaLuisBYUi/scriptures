<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 01/02/2020
 * Time: 12:30 PM
 */
class model_scriptures{
    private $db;
    private $scriptures;

    public function __construct(){
        $connection = new Connection();
        $conn = $connection->connection();

        $this->db=$conn;
        $this->scriptures=array();
    }

    public function showScriptures($search)
    {
        $result=pg_query($this->db,"select id, book, chapter, verse, content from public.scriptures where (UPPER(book) LIKE REPLACE(UPPER('%".$search."%'),' ','%') OR '".$search."' IS NULL OR '".$search."' = '' )");

        while($rows=pg_fetch_assoc($result)){
            $this->scriptures[]=$rows;
        }
        return $this->scriptures;
    }
}