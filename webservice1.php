<?php

$search_param = $_POST["search"];
$search_area = $_POST["area"];

if(isset($_POST["search"]) && isset($_POST["area"])){

$dbhost = "localhost";
$dbname = "if0_37307142_doctor";
$dbuser = "if0_37307142";
$dbpassword = "infiniti126";

$conn = new mysqli($dbhost,$dbuser,$dbpassword,$dbname);

$sql = "SELECT ID,DoctorName,DoctorCategory,DoctorImage FROM doctors WHERE DoctorArea like '%".$search_area."%' and DoctorCategory like '%".$search_param."%'";

$result = $conn->query($sql);

if($result->num_rows > 0){

    $data = '<div class="easy-steps-and">DOCTORS FOUND:</div>';
    $doctor_data = "";

    while($row = $result->fetch_assoc()){
        $doctorid = $row["ID"];
        $doctorname = $row["DoctorName"];
        $doctorcat = $row["DoctorCategory"];
        $doctorimage = $row["DoctorImage"];

        $doctor_data = $doctor_data.'<div class="frame-group">
        <div class="vector-wrapper">
          <img class="vector-icon3" alt="" src="'.$doctorimage.'" />
        </div>
        <div class="find-best-doctors-parent">
          <div class="find-best-doctors">'.$doctorname.'</div>
          <div class="find-your-doctor-container1">'.$doctorcat.'</div>
        </div>
      </div>';
    }
}else{
    $data = '<div class="easy-steps-and">NO DOCTORS FOUND:</div>';
}

//echo json_encode($data);
}else{
    $data = '<div class="easy-steps-and">BAD QUERY</div>';
}
$data = $data.$doctor_data;
echo $data;
?>