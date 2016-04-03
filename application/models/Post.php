<?php

class Application_Model_Post extends Zend_Db_Table_Abstract
{
    protected $_name = 'post';
    protected $_dependentTables = array('Application_Model_Comment');
// create new post
    public function create_post($postData)
    {
        $row = $this->createRow();
        $row->title = $postData['title'];
        $row->city_id = $postData['city_id'];
        $row->user_id = $postData['user_id'];
        $row->content = $postData['content'];
        $row->image = $postData['image'];
        $row->save();
    }
// get posts by city id
    public function getposts_by_city_id($city_id)
    {
        // return zend row object
        $rows = $this->fetchAll("city_id=$city_id")->toArray();
        return $rows;
    }
//get comments for one post by post id
    public function getcomments_on_post($post_id){
        $post=$this->find($post_id)->current();
        return $post->findDependentRowset('Application_Model_Comment');
    }

    public function getpost_by_postid($id){
        $rows = $this->fetchAll("id=$id")->toArray();
        return $rows;
    }
//// update post
    public function update_post($post_data)
    {
        var_dump($post_data);
        $my_data['content'] = $post_data['content'];
        $my_data['image'] = $post_data['image'];
        $my_data['title'] = $post_data['title'];
        $my_data['city_id'] = $post_data['city_id'];
        $my_data['user_id'] = $post_data['user_id'];
        $post_id = $post_data['id'];
        //var_dump($my_data);
       // echo $post_id;die();
        $this->update($my_data, "id=$post_id");
    }

    public function delete_post($id)
    {
        $this->delete("id=$id");
    }

}