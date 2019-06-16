<?php

include_once("SQLlib.pdo.php");

function get_user_id($login, $lastname, $firstname){
    $sql = "SELECT id FROM user WHERE lastname='$lastname'AND firstname='$firstname' AND login='$login'";
    return parcoursRs(SQLSelect($sql));
}

function validateLogin($pseudo, $password){
    $sql = "SELECT id, login, lastname, firstname,profession, service_id FROM user WHERE login='$pseudo' AND password='$password'";
    return parcoursRs(SQLSelect($sql));
}

function listPatients($service_id){
    $sql = "SELECT patient.id,lastname,firstname,birth_date, reason_hospitalisation,room_number,doctor, number_day_hospitalisation,service.specialty as service from patient INNER JOIN service ON service.id = patient.service_id WHERE patient.service_id = $service_id";
    return parcoursRs(SQLSelect($sql));
}

function listSyringes($service_id){
    $sql = "SELECT syringe.id,patient_id, lastname, firstname, room_number, substance,prescribed_dose, max_dose, prescriber, ip_address, state from syringe LEFT JOIN patient ON patient.id = syringe.patient_id WHERE patient.service_id = $service_id OR syringe.patient_id IS NULL";
    return parcoursRs(SQLSelect($sql));
}

function listServices(){
    $sql = "SELECT id,manager_name,specialty,rooms_number from service";
    return parcoursRs(SQLSelect($sql));
}
function listPatientSyringes($patient_id){
    $sql = "SELECT treatment.syringe_id as id, substance, prescribed_dose, max_dose, ip_address, new_dose, state, date_time FROM treatment, syringe WHERE syringe.id = treatment.syringe_id AND treatment.patient_id = $patient_id AND treatment.date_time = (SELECT MAX(date_time) from treatment WHERE syringe_id = syringe.id AND state != 0) ORDER BY treatment.syringe_id ASC";
    return parcoursRs(SQLSelect($sql));
}

function addPatient($lastname, $firstname, $birth_date, $reason_hospitalisation, $room_number, $doctor, $number_day_hospitalisation, $service_id){
    $sql = "INSERT INTO patient(lastname,firstname,birth_date,reason_hospitalisation, room_number, doctor, number_day_hospitalisation, service_id) VALUES ('$lastname','$firstname','$birth_date','$reason_hospitalisation','$room_number','$doctor','$number_day_hospitalisation','$service_id')";
    return SQLInsert($sql);
}

function changeSyringeDose($syringe_id, $patient_id, $date_time, $new_dose, $user_id){
    $sql="INSERT INTO treatment(syringe_id,patient_id,date_time,new_dose,user_id) VALUES ($syringe_id,$patient_id,'$date_time',$new_dose,$user_id)";
    return SQLInsert($sql);
}

function getPatient($id){
	$sql = "SELECT CONCAT(firstname, ' ', lastname) FROM patient WHERE id=$id";
	return SQLGetChamp($sql);
}

function addSyringe($syringe_id, $patient_id, $substance, $prescribed_dose, $max_dose, $prescriber){
    $sql="UPDATE syringe SET patient_id = $patient_id, substance = '$substance', prescribed_dose = $prescribed_dose, max_dose = $max_dose, prescriber = '$prescriber', state=3 WHERE id=$syringe_id";
    return SQLUpdate($sql);
}

function addFirstTreatment($syringe_id, $patient_id, $date_time, $user_id, $prescribed_dose){
	$sql="INSERT INTO treatment(syringe_id,patient_id,date_time,new_dose,user_id) VALUES ($syringe_id,$patient_id,'$date_time', $prescribed_dose,$user_id)";
	return SQLInsert($sql);
}

function stopSyringe($id){
	$sql = "UPDATE syringe SET state = 3 WHERE id = $id";
	return SQLUpdate($sql);
}

function reloadSyringe($id){
	$sql = "UPDATE syringe SET state = 1 WHERE id = $id";
	return SQLUpdate($sql);
}

function deleteTreatment($patient_id, $syringe_id){
	$sql = "DELETE FROM treatment WHERE patient_id = $patient_id AND syringe_id = $syringe_id";
	return SQLDelete($sql);
}

function resetSyringe($syringe_id){
	$sql = "UPDATE syringe SET state=0, patient_id=NULL, substance=NULL, prescribed_dose=NULL, max_dose=NULL, prescriber=NULL WHERE id=$syringe_id";
	return SQLUpdate($sql);
}

function listAvailableSyringes(){
	$sql = "SELECT id from syringe WHERE state=0";
	return parcoursRs(SQLSelect($sql));
}

function getMaxDose($syringe_id){
	$sql = "SELECT max_dose FROM syringe WHERE id = $syringe_id";
	return SQLGetChamp($sql);
}
function getSyringeInfo($syringe_id){
    $sql = "SELECT patient_id, substance, prescriber, prescribed_dose, max_dose, prescriber, ip_address, state, lastname, firstname, birth_date, reason_hospitalisation, room_number, doctor, number_day_hospitalisation, service_id, manager_name, specialty FROM syringe INNER JOIN patient ON patient_id = patient.id INNER JOIN service ON service.id = patient.service_id WHERE syringe.id = $syringe_id";
    return parcoursRs(SQLSelect($sql));
}
function getTreatments($syringe_id, $patient_id){
    $sql = "SELECT * FROM treatment WHERE syringe_id = $syringe_id AND patient_id = $patient_id";
    return parcoursRs(SQLSelect($sql));
}
function getServiceName($service_id){
    $sql = "SELECT specialty FROM service WHERE id = $service_id";
    return SQLGetChamp($sql);
}
function getServices(){
    $sql = "SELECT * FROM service";
    return parcoursRs(SQLSelect($sql));
}
?>
