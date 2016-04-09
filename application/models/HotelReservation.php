<?php

class Application_Model_HotelReservation extends Zend_Db_Table_Abstract
{
    protected $_name = 'hotel_reservation';

    function addReservation($data)
    {
        $row = $this->createRow();
        $row->hotel_id=$data['name'];
        $row->from=$data['from'];
        $row->to=$data['to'];
        $row->member=$data['member'];
        $row->user_id=$data['user_id'];
        $row->save();
    }

    function cancelReservation($id)
    {
        $this->delete("id=$id");
    }

    function editReservation($data,$id)
    {
        $custom_data['hotel_id']=$data['name'];
        $custom_data['from']=$data['from'];
        $custom_data['to']=$data['to'];
        $custom_data['member']=$data['member'];
        $custom_data['user_id']=$data['user_id'];
        $this->update($custom_data,"id=$id");
    }

    function getUserReservation($user_id)
    {
        $query=$this->select();
        $query->where("user_id=$user_id");
        return $this->fetchAll($query)->toArray();
    }

    function getAllReservations()
    {
        return $this->fetchAll()->toArray();
    }

    function getOneReservation($id)

    {
        return $this->find($id)->toArray();
    }

}

