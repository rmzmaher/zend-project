<?php

class Application_Model_Location extends Zend_Db_Table_Abstract
{
    /*+---------+--------------+------+-----+---------+----------------+
| Field   | Type         | Null | Key | Default | Extra          |
+---------+--------------+------+-----+---------+----------------+
| id      | int(11)      | NO   | PRI | NULL    | auto_increment |
| name    | int(30)      | NO   |     | NULL    |                |
| image   | varchar(100) | NO   |     | NULL    |                |
| city_id | int(11)      | NO   | MUL | NULL    |                |
+---------+--------------+------+-----+---------+----------------+
    //crud admin        //selectbucity_id user
*/
    protected $_name = 'location';
// create new post
    public function add_location($locationData)
    {
        $row = $this->createRow();
        $row->name = $locationData['name'];
        $row->city_id = $locationData['city_id'];
        $row->image = $locationData['image'];
        $row->describtion=$locationData['describtion'];
        $row->save();
    }
// get posts by city id
    public function getlocations_by_city_id($city_id)
    {
        // return zend row object
        $rows = $this->fetchAll("city_id=$city_id")->toArray();
        return $rows;
    }

    public function getlocation_by_locationid($id){
        $rows = $this->fetchAll("id=$id")->toArray();
        return $rows;
    }

//// update post
    public function update_post($location_data)
    {
        var_dump($location_data);
        $my_data['name'] = $location_data['name'];
        $my_data['image'] = $location_data['image'];
        $my_data['city_id'] = $location_data['city_id'];
        $my_data['describtion']=$location_data['describtion'];
        $location_id = $location_data['id'];
        //var_dump($my_data);
        // echo $post_id;die();
        $this->update($my_data, "id=$location_id");
    }

    public function delete_post($id)
    {
        $this->delete("id=$id");
    }



public function updatelocation($locationid,$locationData)
    {

 var_dump($locationData);
    $locationdata['name']=$locationData['name'];
     //$my_data['city_id'] = $location_data['city_id'];
    $locationdata['image']=$locationData['image'];
    $locationdata['describtion']=$locationData['describtion'];

    $this->update($locationdata,"id=$locationid");


    }

    public function get_locations()
    {
        return $this->fetchAll()->toArray();
    }

 


}
