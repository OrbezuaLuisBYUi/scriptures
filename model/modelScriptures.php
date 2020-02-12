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
    private $topics;

    public function __construct(){
        $connection = new Connection();
        $conn = $connection->connection();

        $this->db=$conn;
        $this->scriptures=array();
        $this->topics=array();
    }

    public function showScriptures($search)
    {
        $result=pg_query($this->db,"select id, book, chapter, verse, content from public.scriptures where (UPPER(book) LIKE REPLACE(UPPER('%".$search."%'),' ','%') OR '".$search."' IS NULL OR '".$search."' = '' )");

        while($rows=pg_fetch_assoc($result)){
            $this->scriptures[]=$rows;
        }
        return $this->scriptures;
    }

    public function returnTopics()
    {
        $result=pg_query($this->db,"select id, name from public.topic");

        while($rows=pg_fetch_assoc($result)){
            $this->topics[]=$rows;
        }
        return $this->topics;
    }

    public function saveScripture($book,$chapter,$verse,$content,$topics,$other,$othertopic)
    {
        $result=pg_query($this->db,"insert into public.scriptures(book,chapter,verse,content) values('".$book."',".$chapter.",".$verse.",'".$content."');");
        $result_lastid = pg_fetch_row(pg_query($this->db,"SELECT setval('scriptures_id_seq',nextval('scriptures_id_seq')-1) as id;"));
        $lastid = $result_lastid[0];

        if(isset($other))
        {
            pg_query($this->db,"insert into public.topic(name) values('".$othertopic."')");
            $result_lastid_topic = pg_fetch_row(pg_query($this->db,"SELECT setval('topic_id_seq',nextval('topic_id_seq')-1) as id;"));
            $lastid_topic = $result_lastid_topic[0];
            pg_query($this->db,"insert into public.topic_scriptures(topic_id,scripture_id) values(".$lastid_topic.",".$lastid.")");
        }
        else
        {
            foreach($topics as $value)
            {
                pg_query($this->db,"insert into public.topic_scriptures(topic_id,scripture_id) values(".$value.",".$lastid.")");
            }
        }

        return $lastid;
    }

    public function showTopics($id)
    {
        $this->topics=array();
        $result=pg_query($this->db,"select name from public.topic as t inner join public.topic_scriptures as ts ON(ts.topic_id = t.id) where scripture_id = ".$id);

        while($rows=pg_fetch_assoc($result)){
            $this->topics[]=$rows;
        }
        return $this->topics;
    }
}