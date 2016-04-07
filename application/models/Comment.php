<?php

class Application_Model_Comment extends Zend_Db_Table_Abstract
{
    protected $_name = 'comment';
    protected $_referenceMap = array('post'=>array(
        'columns'=>array('post_id'),
        'refTableClass'=>'Application_Model_Post',
        'refColumns'=>array('id'),
        'onDelete'=>'cascade'

    ));
//create comment
    public function create_comment($commentData)
    {
        $row = $this->createRow();
        $row->user_id = $commentData['user_id'];
        $row->post_id=$commentData['post_id'];
        $row->content = $commentData['content'];
        $row->save();
        return $row['id'];
    }

// get comment by post id
    public function getcomments_by_post_id($post_id)
    {
        $rows = $this->fetchAll("post_id=$post_id")->toArray();
        return $rows;
    }
    /// get all comments
    public function get_comments(){
        return $rows=$this->fetchAll()->toArray();
    }
    public function update_post($comment_data)
    {
        $my_data['content'] = $comment_data['content'];
        $my_data['id'] = $comment_data['id'];
        $my_data['post_id'] = $comment_data['post_id'];
        $my_data['user_id'] = $comment_data['user_id'];
        $post_id = $comment_data['id'];
        $this->update($my_data, "id=$post_id");
    }
// delete a comment
    public function delete_comment($id)
    {
        $this->delete("id=$id");
    }


}