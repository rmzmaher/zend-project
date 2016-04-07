<?php

class Application_Model_Country extends Zend_Db_Table_Abstract
{
	protected $_name = 'country';
	//protected $_dependentTables= array('Application_Model_City');

	function country_rate()
	{return $this->fetchAll(null,"rating DESC",6)->toArray();}
	function all_country()
	{
		return $this->fetchAll()->toArray();
	}
	function one_country($id)
	{
		return $this->find($id)->toArray();
	}
	function remove_country($id)
	{
		return $this->delete("id=$id");
	}
	function add_country($countrydata)
	{
		$row = $this->createRow();
		$row->name=$countrydata['name'];
		$row->image=$countrydata['image'];
		$row->rating=$countrydata['rating'];
		$row->description=$countrydata['description'];
		$row->save();

	}
	function edit_country($id,$countrydata)
	{
		$custom_country['name'] = $countrydata['name'];
		$custom_country['image']  = $countrydata['image'];
		$custom_country['rating']  = $countrydata['rating'];
		$custom_country['description']  = $countrydata['description'];
		$this->update($custom_country,"id = $id");
	}
	function find_all_country_city ($country_id){
         $row_object =$this->find($country_id)->current();

                                     //return a row set of objects
         return $row_object->findDependentRowset('Application_Model_City');

         
    }


}

