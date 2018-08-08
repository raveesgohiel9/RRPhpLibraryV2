<?php
namespace RRPhpLibraryV2\Helpers;

use RRPhpLibraryV2\Helpers\TableList as TableList;
use RRPhpLibraryV2\Helpers\Connection as Connection;

class PhpCrud
{
        
	private static $pCrud;
        protected $tbList;
        protected $connection;
	public function __construct()
	{
           echo "Calling PhpCRUD";
           //$this->tbList = $tbList;
           //$this->connection = $connection;
           $this->tbList = TableList::getInstance();
           $this->connection = Connection::getInstance();
           
           //print_r($tbList->getFieldList("customers_add"));
	}
        public function getTableListInstance()
        {
            $this->tbList = TableList::getInstance();
            return $this->tbList;
        }
        public function getFieldList($tbname)
        {
           
           echo " Getting for table:".$tbname;
           
           print_r($this->tbList->getFieldList($tbname));
           return $this->tbList->getFieldList($tbname);
           
        }
        public function connection()
	{
            $this->connection = Connection::getInstance();
            echo "Connection function";
            return $this->connection;
	}
	
        private function __clone() {
        // Stopping Clonning of Object
        }
        
        private function __wakeup() {
            // Stopping unserialize of object
        }
        static function getInstance()
        {
            if(self::$pCrud  == null)
            {
                $pCrud = new PhpCrud();
            }
            return $pCrud;
        }
	
	
	function disconnection($dbLink)
	{
		
		//mysql_close($dbLink);
		mysql_close();
		//$this->display("Disconnected");
	}
	function display($str)
	{
		echo "\n".$str;
	}
	function getColumns($dbname,$tbname)
	{
		$result = array();
		$q = "Show COLUMNS from ".$tbname." from ".$dbname;
		$r = mysql_query($q);
		//print_r($r);
		if (mysql_num_rows($r)>0) 
		{
			$i = 0;
			
			while ($row = mysql_fetch_assoc($r)) 
			{
				//print_r($row);
				
				if(isset($row['Default']))
				{
					$this->display("Not assigning");
				}
				else
				{
					
					$result[$i] = $row['Field'];
					//$this->display($result[$i]);
					$i++;
				}
			}
			
		}
		return $result;
	}
	function getColumnsPrint($tbname)
	{
		$result = array();
		$q = "Show COLUMNS from ".$tbname." from ".$dbname;
		$r = mysql_query($q);
		//print_r($r);
		if (mysql_num_rows($r)>0) 
		{
			$i = 0;
			
			while ($row = mysql_fetch_assoc($r)) 
			{
				echo $row['Field']."','";
				
				if(isset($row['Default']))
				{
					//$this->display("Not assigning");
				}
				else
				{
					
					$result[$i] = $row['Field'];
					//$this->display($result[$i]);
					$i++;
				}
			}
			
		}
		return $result;
	}
	function getColumnsAll($tbname)
	{
		$result = array();
		$q = "Show COLUMNS from ".$tbname." from ".$dbname;
		$r = mysql_query($q);
		//print_r($r);
		if (mysql_num_rows($r)>0) 
		{
			$i = 0;
			
			while ($row = mysql_fetch_assoc($r)) 
			{
				//print_r($row);
				$result[$i] = $row['Field'];
				//$this->display($result[$i]);
				$i++;
				
			}
			
		}
		return $result;
	}
	function SimpleInsert($tbname,$fields,$values)
	{
		/*
		 * Generating a dynamic query for insert
		*/
		$q = "Insert into ".$tbname." SET ";
		for($i = 0;$i < count($fields);$i++)
		{
			if($i < count($fields)-1)
			{
				$q .="".$fields[$i]."='".$values[$i]."',";
			}
			else
			{
				$q .="".$fields[$i]."='".$values[$i]."'";
			}
			
		}	
		//$this->display("Query-".$q);	
		$r = mysql_query($q);
			
		if($r)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function SimpleInsertPrint($tbname,$fields,$values)
	{
		/*
		 * Generating a dynamic query for insert
		*/
		$q = "Insert into ".$tbname." SET ";
		for($i = 0;$i < count($fields);$i++)
		{
			if($i < count($fields)-1)
			{
				$q .="".$fields[$i]."='".$values[$i]."',";
			}
			else
			{
				$q .="".$fields[$i]."='".$values[$i]."'";
			}
			
		}	
		$this->display("Query-".$q);	
		$r = mysql_query($q);
			
		if($r)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	/*
	* This function gives the result in a raw format
	*/	
	function SimpleSelect($tbname,$fields)
	{
		$q = "SELECT * from ".$tbname;
		$r = mysql_query($q);
		//print_r($r);
		
		if (mysql_num_rows($r)>0) 
		{
			return $r;	
		}
		else
		{
			return 0;
		}
		
	}
	/*
	* This function gives the result in a raw format with only selected column names
	*/	
	function SimpleSelectColumns($tbname,$fields)
	{
		
		$q = "SELECT ";
		for($i = 0;$i < count($fields);$i++)
		{
			if($i < count($fields)-1)
			{
				$q .= "".$fields[$i].",";
			}
			else
			{
				$q .= "".$fields[$i];
			}
		}
		$q .= " from ".$tbname;
		//echo "Query-".$q;
		$r = mysql_query($q);
		//print_r($r);
		
		//if (mysql_num_rows($r)>0) 
		//{
		//	return $r;	
		//}
		//else
		//{
			return $r;
		//}
		
	}
	/*
	* This function gives the result in a raw format with only selected column names
	*/	
	function SimpleSelectColumnsPrint($tbname,$fields)
	{
		
		$q = "SELECT ";
		for($i = 0;$i < count($fields);$i++)
		{
			if($i < count($fields)-1)
			{
				$q .= "".$fields[$i].",";
			}
			else
			{
				$q .= "".$fields[$i];
			}
		}
		$q .= " from ".$tbname;
		echo "Query-".$q;
		$r = mysql_query($q);
		print_r($r);
		
		//if (mysql_num_rows($r)>0) 
		//{
		//	return $r;	
		//}
		//else
		//{
			return $r;
		//}
		
	}
	
	
	/*
	* This function gives the result in a raw format with only selected column names using the where clause
	*/	
	function SimpleSelectColumnsWhere($tbname,$fields,$where)
	{
		
		$q = "SELECT ";
		for($i = 0;$i < count($fields);$i++)
		{
			if($i < count($fields)-1)
			{
				$q .= "".$fields[$i].",";
			}
			else
			{
				$q .= "".$fields[$i];
			}
		}
		$q .= " from ".$tbname.$where;
		//echo "Query-".$q;
		$r = mysql_query($q);
		//print_r($r);
		
		//if (mysql_num_rows($r)>0) 
		//{
		//	return $r;	
		//}
		//else
		//{
			return $r;
		//}
		
	}
	function SimpleSelectColumnsWherePrint($tbname,$fields,$where)
	{
		
		$q = "SELECT ";
		for($i = 0;$i < count($fields);$i++)
		{
			if($i < count($fields)-1)
			{
				$q .= "".$fields[$i].",";
			}
			else
			{
				$q .= "".$fields[$i];
			}
		}
		$q .= " from ".$tbname.$where;
		echo "Query-".$q;
		$r = mysql_query($q);
		print_r($r);
		
		//if (mysql_num_rows($r)>0) 
		//{
		//	return $r;	
		//}
		//else
		//{
			return $r;
		//}
		
	}
	/*
	* This function gives the result in a raw format. 
	* The result is selected by where clause
	*/	
	function SimpleSelectWhere($tbname,$where)
	{
		$q = "SELECT * from ".$tbname." ".$where;
		//echo "Query-".$q;
		$r = mysql_query($q);
		//print_r($r);
		
		if (mysql_num_rows($r)>0) 
		{
			return $r;	
		}
		else
		{
			return 0;
		}
		
	}
	
	/*
	* This function gives the result in a raw format. 
	* The result is selected by where clause. This function prints the query and result
	*/	
	function SimpleSelectWherePrint($tbname,$where)
	{
		$q = "SELECT * from ".$tbname." ".$where;
		echo "Query-".$q;
		$r = mysql_query($q);
		print_r($r);
		
		if (mysql_num_rows($r)>0) 
		{
			return $r;	
		}
		else
		{
			return 0;
		}
		
	}
	
	/*
	* This function gives the result in a sorted array
	*/
	function SimpleSelectSorted($tbname,$fields)
	{
		$result = array();
		$q = "SELECT * from ".$tbname;
		$r = mysql_query($q);
		//print_r($r);
		
		if (mysql_num_rows($r)>0) 
		{
			$i = 0;
			
			while ($row = mysql_fetch_assoc($r)) 
			{
				//print_r($row);
				$subresult = array();
				for($j = 0;$j < count($fields);$j++)
				{
					
					$subresult[$j] = $row[$fields[$j]];
					//$this->display($subresult[$j]);
				}
				
				$result[$i] = $subresult;
				$i++;
			}
			
		}
		return $result;
	}
	
	/*
	* This function gives the result in a sorted array but using where clause
	*/
	function SimpleSelectSortedWhere($tbname,$fields,$where)
	{
		$result = array();
		$q = "SELECT * from ".$tbname." ".$where;
		$r = mysql_query($q);
		//print_r($r);
		
		if (mysql_num_rows($r)>0) 
		{
			$i = 0;
			
			while ($row = mysql_fetch_assoc($r)) 
			{
				//print_r($row);
				$subresult = array();
				for($j = 0;$j < count($fields);$j++)
				{
					
					$subresult[$j] = $row[$fields[$j]];
					//$this->display($subresult[$j]);
				}
				
				$result[$i] = $subresult;
				$i++;
			}
			
		}
		return $result;
	}
	
	/*
	* This function gives the result in a sorted array that can just be encoded to JSON
	*/
	
	function SimpleSelectJSON($tbname,$fields)
	{
		
		$result = array();
		$q = "SELECT * from ".$tbname;
		$r = mysql_query($q);
		//print_r($r);
		
		if (mysql_num_rows($r)>0) 
		{
			$i = 0;
			
			while ($row = mysql_fetch_assoc($r)) 
			{
				//print_r($row);
				$subresult = array();
				
				for($j = 0;$j < count($fields);$j++)
				{
					
					$subresult[$fields[$j]] = $row[$fields[$j]];
					//$this->display($subresult[$j]);
				}
				
				$result[$i] = $subresult;
				$i++;
			}
			
		}
		//$result['result'] = $subresult;
		return $result;
	}
	
	/*
	* This function gives the result in a sorted array that can just be encoded to JSON.
	* The results are returned based on where condition
	*/
	
	function SimpleSelectJSONWhere($tbname,$fields,$where)
	{
		
		$result = array();
		$q = "SELECT * from ".$tbname." ".$where;
		$r = mysql_query($q) or die("Cannot execute query");
		//print_r($r);
		
		if (mysql_num_rows($r)>0) 
		{
			$i = 0;
			
			while ($row = mysql_fetch_assoc($r)) 
			{
				//print_r($row);
				$subresult = array();
				
				for($j = 0;$j < count($fields);$j++)
				{
					
					$subresult[$fields[$j]] = $row[$fields[$j]];
					//$this->display($subresult[$j]);
				}
				
				$result[$i] = $subresult;
				$i++;
			}
			
		}
		else
		{
			//echo "No rows";
			//$result="0";
		}
		//$result['result'] = $subresult;
		return $result;
	}
	/*
	* This function gives the result in a sorted array that can just be encoded to JSON.
	* The results are returned based on where condition
	*/
	
	function SimpleSelectJSONWherePrint($tbname,$fields,$where)
	{
		
		$result = array();
		$q = "SELECT * from ".$tbname." ".$where;
		$r = mysql_query($q);
		echo "Query-".$q;
		//print_r($r);
		
		if (mysql_num_rows($r)>0) 
		{
			$i = 0;
			
			while ($row = mysql_fetch_assoc($r)) 
			{
				//print_r($row);
				$subresult = array();
				
				for($j = 0;$j < count($fields);$j++)
				{
					
					$subresult[$fields[$j]] = $row[$fields[$j]];
					$this->display($subresult[$j]);
				}
				
				$result[$i] = $subresult;
				$i++;
			}
			
		}
		else
		{
			echo "No rows";
		}
		//$result['result'] = $subresult;
		return $result;
	}
	function UpdateWhere($tbname,$where)
	{
		$q = "UPDATE ".$tbname." SET ".$where;
		//$this->display("Query-".$q);	
		$r = mysql_query($q);
			
		if($r)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function UpdateWherePrint($tbname,$where)
	{
		$q = "UPDATE ".$tbname." SET ".$where;
		$this->display("Query-".$q);	
		$r = mysql_query($q);
			
		if($r)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function UpdateAllWhere($tbname,$fields,$values,$where)
	{
		//var_dump($fields);
		$q = "UPDATE ".$tbname." SET ";
		for($i = 0;$i < count($fields);$i++)
		{
			if($i < count($fields)-1)
			{
				$q .= " ".$fields[$i]."='".$values[$i]."',";
			}
			else
			{
				$q .= " ".$fields[$i]."='".$values[$i]."'";
			}
			
		}
		$q .= $where;
		
		//$this->display("Query-".$q);	
		$r = mysql_query($q);
		
		if($r)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function UpdateAllWherePrint($tbname,$fields,$values,$where)
	{
		//var_dump($fields);
		$q = "UPDATE ".$tbname." SET ";
		for($i = 0;$i < count($fields);$i++)
		{
			if($i < count($fields)-1)
			{
				$q .= " ".$fields[$i]."='".$values[$i]."',";
			}
			else
			{
				$q .= " ".$fields[$i]."='".$values[$i]."'";
			}
			
		}
		$q .= $where;
		
		$this->display("Query-".$q);	
		
		$r = mysql_query($q);
		
		print_r($r);
		if($r)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function DeleteRowWhere($tbname,$where)
	{
		$q = "DELETE FROM ".$tbname." ".$where;
		//$this->display("Query-".$q);	
		$r = mysql_query($q);
			
		if($r)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function DeleteRowWherePrint($tbname,$where)
	{
		$q = "DELETE FROM ".$tbname." ".$where;
		$this->display("Query-".$q);	
		$r = mysql_query($q);
			
		if($r)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}


?>