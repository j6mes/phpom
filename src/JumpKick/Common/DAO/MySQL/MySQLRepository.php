<?php

namespace JumpKick\Common\DAO\MySQL;
use JumpKick\Common\DAO\Repository;
use JumpKick\Common\DAO\Identity;
use \PDO;
require_once ("JumpKick/Common/Autoload.php");


abstract class MySQLRepository implements Repository, Identity {
	protected $dbh;
	public function __construct($id=null) {
		$this->dbh = MySQLDatabaseConnection::getActiveConnection();
	}

	private $joins = array();
	
	
	
	function all() {
		$jtext = "";
		if(count($this->joins)>0) {
			foreach($this->joins as $join) {
				$jtext .= "{$join[0]} JOIN {$join[1]} ON {$join[2]} = {$join[3]} ";
			}

		}


		$query = "SELECT * FROM `{$this->getTableName()}` {$jtext};";
		$smt = $this->dbh->prepare($query);
		$smt->execute();
		
		$result = $smt->fetchAll(PDO::FETCH_ASSOC);
		
		$returnArray = array();
		if(count($result)) {
			foreach($result as $row) {
				$returnArray[] = $this->initRow($row);	
			}	
		}
		
		return $returnArray;
	}
	
	function where($qry,$params,$page = 0) {
		$jtext = "";
		if(count($this->joins)>0) {
			foreach($this->joins as $join) {
				$jtext .= "{$join[0]} JOIN {$join[1]} ON {$join[2]} = {$join[3]} ";
			}

		}


        if($page == 0) {
            $query = "SELECT * FROM `{$this->getTableName()}` {$jtext} WHERE {$qry};";
            $smt = $this->dbh->prepare($query);
            $smt->execute($params);

        } else {
            $page -= 1;
            $numberofresults = $GLOBALS['resultsperpage']+1;

            $offsetresult = $page*$numberofresults;

            $query = "SELECT * FROM `{$this->getTableName()}` {$jtext} WHERE {$qry} LIMIT ?, ?;";
            $smt = $this->dbh->prepare($query);
            $smt->execute(array_merge($params,array($offsetresult,$numberofresults)));


        }

		$result = $smt->fetchAll(PDO::FETCH_ASSOC);

		$returnArray = array();
		if(count($result)) {
			foreach($result as $row) {
				$returnArray[] = $this->initRow($row);	
			}	
		}
		
		return $returnArray;
	}

	function count($qry,$params) {
		$jtext = "";
		if(count($this->joins)>0) {
			foreach($this->joins as $join) {
				$jtext .= "{$join[0]} JOIN {$join[1]} ON {$join[2]} = {$join[3]} ";
			}

		}

		$query = "SELECT COUNT(*) FROM `{$this->getTableName()}` {$jtext} WHERE {$qry};";
		$smt = $this->dbh->prepare($query);
		$smt->execute($params);


		$result = $smt->fetchColumn(0);

		return $result;
	}


	function find($id) {
		$jtext = "";
		if(count($this->joins)>0) {
			foreach($this->joins as $join) {
				$jtext .= "{$join[0]} JOIN {$join[1]} ON {$join[2]} = {$join[3]} ";
			}

		}


		$query = "SELECT * FROM `{$this->getTableName()}` {$jtext} WHERE `{$this->getIdentityColumn()}` = ? LIMIT 1";
		$smt = $this->dbh->prepare($query);

        $smt->execute(array($id));

		$result = $smt->fetch(PDO::FETCH_ASSOC);

		$returnResult = $this->initRow($result);

		return $returnResult;
	}


	function join($t,$f,$i) {
		$this->joins[] = array("INNER", $t,$f,$i);
		return $this;
	}

	function join_custom($j, $t,$f,$i) {
		$this->joins[] = array($j,$t,$f,$i);
		return $this;
	}

	protected abstract function initRow($row);
}

