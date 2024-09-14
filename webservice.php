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
    while($row = $result->fetch_assoc()){
        $doctorid = $row["ID"];
        $doctorname = $row["DoctorName"];
        $doctorcat = $row["DoctorCategory"];
        $doctorimage = $row["DoctorImage"];

        $doctor_data["DocName"] = $doctorname;
        $doctor_data["DocCat"] = $doctorcat;
        $doctor_data["DocImage"] = $doctorimage;
        $data[$doctorid] = $doctor_data;
    }

    $data["Result"] = "True";
    $data["Message"] = "Doctors fetched successfully";
}else{
    $data["Result"] = "False";
    $data["Message"] = "No Doctors found";
}

//echo json_encode($data);
}else{
    $data["Result"] = "False";
    $data["Message"] = "bad query";
}
echo json_encode($data, JSON_UNESCAPED_SLASHES);
?>