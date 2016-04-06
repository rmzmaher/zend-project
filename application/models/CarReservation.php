<?php

class Application_Model_CarReservation extends Zend_Db_Table_Abstract
{

    protected $_name = 'car_reservation';

    function reserveCar($data)
    {
        $row = $this->createRow();
        $row->location=$data['location'];
        $row->from=$data['from'];
        $row->to=$data['to'];
        $row->user_id=$data['user_id'];
        $row->save();
    }

    function cancelReservation($id)
    {
        $this->delete("id=$id");
    }

    function editReservation($data,$id)
    {
        $custom_data['location']=$data['location'];
        $custom_data['from']=$data['from'];
        $custom_data['to']=$data['to'];
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

    function updateRent($rent_data,$rent_id)
    {
        $custom_data['location']=$rent_data['location'];
        $custom_data['from']=$rent_data['from'];
        $custom_data['to']=$rent_data['to'];
        $custom_data['id']=$rent_id;
        $custom_data['user_id']=$rent_data['user_id'];
        $this->update($custom_data,"id=$rent_id");
    }
    function getOneRent($id)
    {
        return $this->find($id)->toArray();
    }
}

