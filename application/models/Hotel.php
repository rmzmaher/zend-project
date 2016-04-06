<?php

class Application_Model_Hotel extends Zend_Db_Table_Abstract
{
    protected $_name = 'hotel';

    function listAllHotels()
    {
        return $this->fetchAll()->toArray();
    }

    function addHotel($hotel_data)
    {
        $row = $this->createRow();
        $row->name=$hotel_data['name'];
        $row->address=$hotel_data['address'];
        $row->email=$hotel_data['email'];
        $row->phone=$hotel_data['phone'];
        $row->rate=$hotel_data['rate'];
        $row->city_id=$hotel_data['city_id'];
        $row->save();
    }

    function removeHotel($hotel_id)
    {
        $this->delete("id=$hotel_id");
    }

    function updateHotel($hotel_data,$id)
    {
        $custom_hotel_data['name']=$hotel_data['name'];
        $custom_hotel_data['address']=$hotel_data['address'];
        $custom_hotel_data['email']=$hotel_data['email'];
        $custom_hotel_data['phone']=$hotel_data['phone'];
        $custom_hotel_data['rate']=$hotel_data['rate'];
        $custom_hotel_data['city_id']=$hotel_data['city_id'];
        $this->update($custom_hotel_data,"id=$id");
    }

    function getId($name)
    {
        $data=$this->fetchRow("name=$name")->toArray();
        return $data['id'];
    }

    function getOneHotel($id)
    {
        return $this->find($id)->toArray();
    }

    function get_hotels_by_city_id($city_id){
        return $this->fetchAll("city_id=$city_id");
    }

}

