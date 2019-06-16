<?php
include_once "config.php";
function SQLUpdate($sql)
{
	global $BDD_host;
	global $BDD_base;
	global $BDD_user;
	global $BDD_password;

	try {
		$dbh = new PDO("mysql:host=$BDD_host;dbname=$BDD_base", $BDD_user, $BDD_password);
	} catch (PDOException $e) {
		die("<font color=\"red\">SQLUpdate/Delete: Connection Error : " . $e->getMessage() . "</font>");
	}

	$dbh->exec("SET CHARACTER SET utf8");
	$res = $dbh->query($sql);
	if ($res === false) {
		$e = $dbh->errorInfo(); 
		die("<font color=\"red\">SQLUpdate/Delete: Request Error : " . $e[2] . "</font>");
	}

	$dbh = null;
	$nb = $res->rowCount();
	if ($nb != 0) return $nb;
	else return false;
	
}


function SQLDelete($sql) {return SQLUpdate($sql);}


function SQLInsert($sql)
{
	global $BDD_host;
	global $BDD_base;
	global $BDD_user;
	global $BDD_password;
	
	try {
		$dbh = new PDO("mysql:host=$BDD_host;dbname=$BDD_base", $BDD_user, $BDD_password);
	} catch (PDOException $e) {
		die("<font color=\"red\">SQLInsert: Connection Error : " . $e->getMessage() . "</font>");
	}

	$dbh->exec("SET CHARACTER SET utf8");
	$res = $dbh->query($sql);
	if ($res === false) {
		$e = $dbh->errorInfo(); 
		die("<font color=\"red\">SQLInsert: Request Error : " . $e[2] . "</font>");
	}

	$lastInsertId = $dbh->lastInsertId();
	$dbh = null; 
	return $lastInsertId;
}


function SQLGetChamp($sql)
{
	global $BDD_host;
	global $BDD_base;
	global $BDD_user;
	global $BDD_password;

	try {
		$dbh = new PDO("mysql:host=$BDD_host;dbname=$BDD_base", $BDD_user, $BDD_password);
	} catch (PDOException $e) {
		die("<font color=\"red\">SQLGetChamp: Connection Error : " . $e->getMessage() . "</font>");
	}

	$dbh->exec("SET CHARACTER SET utf8");
	$res = $dbh->query($sql);
	if ($res === false) {
		$e = $dbh->errorInfo(); 
		die("<font color=\"red\">SQLGetChamp: Request Error : " . $e[2] . "</font>");
	}

	$num = $res->rowCount();
	$dbh = null;

	if ($num==0) return false;
	
	$res->setFetchMode(PDO::FETCH_NUM);

	$ligne = $res->fetch();
	if ($ligne == false) return false;
	else return $ligne[0];

}


function SQLSelect($sql)
{	
 	global $BDD_host;
	global $BDD_base;
 	global $BDD_user;
 	global $BDD_password;

	try {
		$dbh = new PDO("mysql:host=$BDD_host;dbname=$BDD_base", $BDD_user, $BDD_password);
	} catch (PDOException $e) {
		die("<font color=\"red\">SQLSelect: Connection Error : " . $e->getMessage() . "</font>");
	}

	$dbh->exec("SET CHARACTER SET utf8");
	$res = $dbh->query($sql);
	if ($res === false) {
		$e = $dbh->errorInfo(); 
		die("<font color=\"red\">SQLSelect: Request Error : " . $e[2] . "</font>");
	}
	
	$num = $res->rowCount();
	$dbh = null;

	if ($num==0) return false;
	else return $res;
}


function parcoursRs($result)
{
	if  ($result == false) return array();

	$result->setFetchMode(PDO::FETCH_ASSOC);
	while ($ligne = $result->fetch()) 
		$tab[]= $ligne;

	return $tab;
}






?>
