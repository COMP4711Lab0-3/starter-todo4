
<?php

/**
 * XML-persisted collection.
 * 
 * @author		JLP
 * @copyright           Copyright (c) 2010-2017, James L. Parry
 * ------------------------------------------------------------------------
 */
class XML_Model extends Memory_Model
{
//---------------------------------------------------------------------------
//  Housekeeping methods
//---------------------------------------------------------------------------

	/**
	 * Constructor.
	 * @param string $origin Filename of the XML file
	 * @param string $keyfield  Name of the primary key field
	 * @param string $entity	Entity name meaningful to the persistence
	 */
	function __construct($origin = null, $keyfield = 'id', $entity = null)
	{
		parent::__construct();

		// guess at persistent name if not specified
		if ($origin == null)
			$this->_origin = get_class($this);
		else
			$this->_origin = $origin;

		// remember the other constructor fields
		$this->_keyfield = $keyfield;
		$this->_entity = $entity;

		// start with an empty collection
		$this->_data = array(); // an array of objects
		$this->fields = array(); // an array of strings
		// and populate the collection
        $this->load();
        $this->store();
	}

	/**
	 * Load the collection state appropriately, depending on persistence choice.
	 * OVER-RIDE THIS METHOD in persistence choice implementations
	 */
	protected function load()
	{
        //---------------------
		if (($handle = simplexml_load_file($this->_origin)) !== FALSE)
		{
            $this->_fields = array("id","task","priority","size","group","deadline", "status","flag");
            foreach($handle as $item){
                $record = new stdClass();
                for ($i = 0; $i < count($this->_fields); $i ++ )
                    $record->{$this->_fields[$i]} = (string)$item[$this->_fields[$i]];
                $this->_data[$record->id] = $record;
            }
		}
		// --------------------
		// rebuild the keys table
		$this->reindex();
	}

	/**
	 * Store the collection state appropriately, depending on persistence choice.
	 * OVER-RIDE THIS METHOD in persistence choice implementations
	 */
	protected function store()
	{
		// rebuild the keys table
		$this->reindex();
		//---------------------
		if (($handle = fopen($this->_origin, "r")) !== FALSE)
		{
            $tasksTag = new SimpleXMLElement("<tasks></tasks>");
            foreach($this->_data as $key => $record){
                $taskTag = $tasksTag->addChild("task");
                foreach($this -> _fields as $value){
                    $taskTag->addAttribute($value, $record->$value);
                }
            }
            /*
            $newsXML->addAttribute('newsPagePrefix', 'value goes here');
            $newsIntro = $newsXML->addChild('content');
            $newsIntro->addAttribute('type', 'latest');
            Header('Content-type: text/xml');
            echo $newsXML->asXML();*/

            $tasksTag -> asXML ($this -> _origin);
            
		}
		// --------------------
	}

}
