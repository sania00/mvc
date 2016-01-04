<?php

class News{
    /**
     * Returns single news item with specified id
     *
     * Возвращает одну новость с указанным идентификатором
     *
     * @param integer $id
     * @return mixed
     */
    public static function getNewsItemById($id){
        //Запрос к БД
        $id = intval($id);

        if($id){

            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM product WHERE id=' .$id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            $newsItem = $result->fetch();

            return $newsItem;

        }

    }

    /**
     * Returns an array of news items
     *
     * Возвращает массив новостей
     */
    public static function getNewsList(){
        //Запрос к БД
        $db = Db::getConnection();

        $newsList = array();

        $result = $db->query('SELECT id, name, description FROM product');

        $i = 0;

        while($row = $result->fetch()){
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['name'] = $row['name'];
            $newsList[$i]['description'] = $row['description'];
            /*$newsList[$i]['title'] = $row['title'];
            $newsList[$i]['data'] = $row['data'];
            $newsList[$i]['short_content'] = $row['short_content'];*/
            $i++;
        }

        return $newsList;

    }

}