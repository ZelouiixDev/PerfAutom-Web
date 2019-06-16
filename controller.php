<?php
session_start();
include_once "libs/secureLib.php";
include_once "libs/model.php";

$addArgs = "";

if ($action = validate("action")) {
    ob_start();

    switch ($action) {

        case "user_id":
            $result2 = get_user_id($_SESSION["login"], $_SESSION["lastname"], $_SESSION["firstname"]);
            echo json_encode($result2);
            die();
            break;


        case "login":
            $pseudo = validate("login");
            $password = validate("password");
            $page = validate("page");
            if ($pseudo && $password) {
                if ($userTab = validateLogin($pseudo, $password)) {
                    foreach ($userTab as $user) ;
                    $_SESSION["connected"] = true;
                    $_SESSION["login"] = $pseudo;
                    $_SESSION["lastname"] = $user['lastname'];
                    $_SESSION["firstname"] = $user['firstname'];
                    $_SESSION["profession"] = $user['profession'];
                    $_SESSION["id"] = $user['id'];
                    $_SESSION["service_id"] = $user["service_id"];
                    if ($page){
                        header("Location: index.php?view=".$page);
                        die();
                    }
                } else {
                    if ($page)
                        header("Location: index.php?view=login&fail=true&page=".$page);
                    else
                        header("Location: index.php?view=login&fail=true");
                    die("");
                }
            }
            break;

        case "disconnect":
            session_destroy();
            break;

        case "list_patients" :
            if (validate("connected", "SESSION")){
                $result['data'] = listPatients($_SESSION["service_id"]);
                echo json_encode($result);
            }
            else
                header("location: login");
            die(); // pour ne pas faire la redirection
            break;

        case "list_syringes":
            if (validate("connected", "SESSION")){
                $result['data'] = listSyringes($_SESSION["service_id"]);
                echo json_encode($result);
            }
            else
                header("location: login");
            die(); // pour ne pas faire la redirection
            break;

        case "list_services":
            if (validate("connected", "SESSION")){
                $result['data'] = listServices();
                echo json_encode($result);
            }
            else
                header("location: login");
            die(); // pour ne pas faire la redirection
            break;


        case "add_patient":
            $lastname = ucfirst(validate("lastname"));
            $firstname = ucfirst(validate("firstname"));
            $birth_date = validate("birth_date");
            $reason_hospitalisation = validate("reason_hospitalisation");
            $room_number = validate("room_number");
            $doctor = ucfirst(validate("doctor"));
            $number_day_hospitalisation = validate("number_day_hospitalisation");
            $service_id = validate("service_id");

            if (validate("connected","SESSION") && $lastname && $firstname && $birth_date && $reason_hospitalisation && $room_number && $doctor && $number_day_hospitalisation && $service_id) {
                echo(addPatient($lastname, $firstname, $birth_date, $reason_hospitalisation, $room_number, $doctor, $number_day_hospitalisation, $service_id));
                header("location: addPatient&success=true");
            }
            else
                header("Location: login");
            die();
            break;

        case "change_syringe_dose":
            $syringe_id = validate("syringe_id");
            $ip_address = validate("ip_address");
            $old_dose = validate("old_dose");
            $user_id = $_SESSION["id"];
            $date_time = new DateTime();
            $patient_id= validate("patient_id");
            $new_dose = validate("new_dose");
            $max_dose = getMaxDose($syringe_id);
            if (validate("connected", "SESSION")){
                if ($new_dose > $max_dose ) $new_dose = $max_dose;
                $id = changeSyringeDose($syringe_id,$patient_id,$date_time->format('Y-m-d H:i:s'),$new_dose,$user_id);
                $diff_dose = $new_dose - $old_dose;
                if ($id != 0){
                    if ($diff_dose > 0) {
                        $diff_dose_str = number_format((float)$diff_dose, 2, '.', '');
                        if ($diff_dose < 10) $diff_dose_str = '0'.$diff_dose_str;
                        exec("./programmeC/seringue $ip_address $syringe_id 100 $diff_dose_str", $out);
                    }
                    else if ($diff_dose<0){
                        $diff_dose = -$diff_dose;
                        $diff_dose_str = number_format((float)$diff_dose, 2, '.', '');
                        if ($diff_dose < 10) $diff_dose_str = '0'.$diff_dose_str;
                        exec("./programmeC/seringue $ip_address $syringe_id 200 $diff_dose_str", $out);
                    }
                }
                echo $new_dose;
            }
            else
                header("location: login");
            die("");
            break;

	case "stop_syringe":
		$syringe_id = validate("syringe_id");
        $ip_address = validate("ip_address");
        if (validate("connected", "SESSION")){
            exec("./programmeC/seringue $ip_address $syringe_id 300 00.00", $out);
            stopSyringe($syringe_id);
        }
        else
            header("Location: login");
        die();
	break;

	case "reload_syringe":
		$syringe_id = validate("syringe_id");
        $ip_address = validate("ip_address");
		$dose = validate("dose");
		 $dose_str = number_format((float)$dose, 2, '.', '');
		if ($dose < 10) $dose_str = '0'.$dose_str;
		if (validate("connected", "SESSION")){
            exec("./programmeC/seringue $ip_address $syringe_id 100 $dose_str", $out);
            reloadSyringe($syringe_id);
        }
		else
            header("Location: login");
		die();
	break;

	case "remove_treatment":
		$syringe_id = validate("syringe_id");
		$patient_id = validate("patient_id");
		if (validate("connected", "SESSION")){
            resetSyringe($syringe_id);
            header("Location: patient/".$patient_id);
        }
		else {
		    header("Location: login");
		}
		die();
	break;

    case "add_syringe":
        $syringe_id = validate("syringe_id");
        $patient_id = validate("patient_id");
        $substance = ucfirst(validate("substance"));
        $prescribed_dose = validate("prescribed_dose");
        $max_dose = validate("max_dose");
        $prescriber = ucfirst(validate("prescriber"));
        $date_time = new DateTime();
        $user_id = $_SESSION["id"];

        if (validate("connected", "SESSION") && $syringe_id && $patient_id && $substance && $prescribed_dose && $max_dose && $prescriber) {
            addSyringe($syringe_id, $patient_id, $substance, $prescribed_dose, $max_dose, $prescriber);
            addFirstTreatment($syringe_id, $patient_id, $date_time->format('Y-m-d H:i:s'), $user_id, $prescribed_dose);
            header("Location: index.php?view=add_syringe&syringe=".$syringe_id);
        }
        else
            header("Location: login");
        die();
    break;

    case "get_treatments":
        $syringe_id = validate("syringe_id");
        $patient_id = validate("patient_id");
        if (validate("connected", "SESSION") && $syringe_id && $patient_id){
            echo json_encode(getTreatments($syringe_id, $patient_id));
        }
        die();
    break;

    }
}
header("Location: /PerfAutom");
ob_end_flush();
?>
