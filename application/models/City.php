<?php

class Application_Model_City extends Zend_Db_Table_Abstract
{
	protected $_name = 'city';

	protected $_referenceMap = array('post'=>array(
        'columns'=>array('country_id'),
        'refTableClass'=>'Application_Model_Country',
        'refColumns'=>array('id'),
        'onDelete'=>'cascade'

    ));
	function listcity()
	{
		return $this->fetchAll()->toArray();
	}

	function all_city($country_id)
	{
		return $this->find($country_id)->toArray();
	}

	function one_city($id)
	{
		return $this->find($id)->toArray();
	}

	function remove_city($id)
	{
		return $this->delete("id=$id");
	}

	function add_city($countrydata)
	{
		$row = $this->createRow();
		$row->name=$countrydata['name'];
		$row->image=$countrydata['image'];
		$row->Longitude  = $countrydata['Longitude'];
		$row->latitude = $countrydata['latitude'];
		$row->rating=$countrydata['rating'];
		$row->description=$countrydata['description'];
		$row->country_id=$countrydata['country_id'];
		$row->save();

	}

	function edit_city($id,$countrydata)
	{
		$custom_country['name'] = $countrydata['name'];
		$custom_country['image']  = $countrydata['image'];
		$custom_country['Longitude']  = $countrydata['Longitude'];
		$custom_country['latitude']  = $countrydata['latitude'];
		$custom_country['rating']  = $countrydata['rating'];
		$custom_country['description']  = $countrydata['description'];
		$this->update($custom_country,"id = $id");
	}

// 	function get_city_obj_by_country_id ($id)
//     {
//         // return zend row object
//         $row = $this->find($id)->current();
// var_dump($row);

//         $user = $row->findParentRow('Application_Model_Country');
//         return $user;


//     }

}

