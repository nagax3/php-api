<?php
require '../inc/dbcon.php';

function error422($message) {
  $data = [
    'status' => 200,
    'message' => $message
  ];
  header('HTTP/1.0 422 Unprocessable Entity');
  echo json_encode($data);
  exit();
}


function storeDevice($deviceInput) {
  global $conn;
  
  $serialnumber = mysqli_real_escape_string($conn, $deviceInput['was_serialnumber']);
  $describe = mysqli_real_escape_string($conn, $deviceInput['description']);

  if(empty(trim($serialnumber))) {
    return error422('Enter Serial Number');

  }else if(empty(trim($describe))) {
    return error422('Enter Serial Number');
  }
  else {
    $query = "INSERT INTO was_device (was_serialnumber, description) VALUES('$serialnumber', '$describe')";
    $result = mysqli_query($conn, $query);

    if($result) {
      $data = [
        'status' => 201,
        'message' => 'Device Created Successfully'
      ];
      header('HTTP/1.0 201 Created');
      return json_encode($data);

    }else {
      $data = [
        'status' => 500,
        'message' => 'Internal Server Error'
      ];
      header('HTTP/1.0 500 Internal Server Error');
      return json_encode($data);
    }
  }
}

function getDeviceList() {
  global $conn;

  $query = "SELECT * FROM was_device";
  $query_run = mysqli_query($conn, $query);

  if($query_run) {

    if(mysqli_num_rows($query_run) > 0) {

      $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

      $data = [
        'status' => 200,
        'message' => 'Device List Fetched Successfully',
        'data' => $res
      ];
      header('HTTP/1.0 200 OK');
      return json_encode($data);
    }
     else {
      $data = [
        'status' => 404,
        'message' => 'No Device Found'
      ];
      header('HTTP/1.0 404 No Device Found');
      return json_encode($data);
    }

  }else {
    $data = [
      'status' => 500,
      'message' => 'Internal Server Error'
    ];
    header('HTTP/1.0 500 Internal Server Error');
    return json_encode($data);
  }
}

function getDevice($deviceParams) {
  global $conn;

  if($deviceParams['id'] == null) {
    return error422('Enter Device Id');
  }

  $deviceId = mysqli_real_escape_string($conn, $deviceParams['id']);
  $query = "SELECT * FROM was_device WHERE was_serialnumber = '$deviceId' LIMIT 1";

  $result = mysqli_query($conn, $query);

  if($result) {
    if(mysqli_num_rows($result) == 1) {
      $res = mysqli_fetch_assoc($result);
      $data = [
        'status' => 200,
        'message' => 'Device Fetched Successfully',
        'data' => $res
      ];
      header('HTTP/1.0 200 OK');
      return json_encode($data);

    }else {
      $data = [
        'status' => 404,
        'message' => 'No Device Found'
      ];
      header('HTTP/1.0 404 No Device Found');
      return json_encode($data);
    }

  } else {
    $data = [
      'status' => 500,
      'message' => 'Internal Server Error'
    ];
    header('HTTP/1.0 500 Internal Server Error');
    return json_encode($data);
  }
}

function updateDevice($deviceInput, $deviceParams) {
  global $conn;

  if(!isset($deviceParams['id'])){
    return error422('Device serial number not found in URL');
  }else if ($deviceParams['id'] == null) {
    return error422('Enter the device serial number');
  }
  
  $serialnumber = mysqli_real_escape_string($conn, $deviceParams['id']);
  $describe = mysqli_real_escape_string($conn, $deviceInput['description']);

  if(empty(trim($serialnumber))) {
    return error422('Enter Serial Number');

  }else if(empty(trim($describe))) {
    return error422('Enter Serial Number');
  }
  else {
    $query = "UPDATE was_device SET description='$describe' WHERE was_serialnumber = '$serialnumber'";
    $result = mysqli_query($conn, $query);

    if($result) {
      $data = [
        'status' => 200,
        'message' => 'Device Updated Successfully'
      ];
      header('HTTP/1.0 200 Success');
      return json_encode($data);

    }else {
      $data = [
        'status' => 500,
        'message' => 'Internal Server Error'
      ];
      header('HTTP/1.0 500 Internal Server Error');
      return json_encode($data);
    }
  }
}


function deleteDevice($deviceParams) {
  global $conn;

  if(!isset($deviceParams['id'])){
    return error422('Device serial number not found in URL');
  }else if($deviceParams['id'] == null) {
    return error422('Enter the device serial number');
  }

  $serialnumber = mysqli_real_escape_string($conn, $deviceParams['id']);
  $query = "DELETE FROM was_device WHERE was_serialnumber='$serialnumber' LIMIT 1";
  $result = mysqli_query($conn, $query);

  if ($result) {
    $data = [
        'status' => 200,
        'message' => 'Device Deleted Successfully'
      ];
      header('HTTP/1.0 200 Deleted');
      return json_encode($data);
  }
  else {
    $data = [
          'status' => 404,
          'message' => 'Device Not Found'
        ];
        header('HTTP/1.0 404 Device Not Found');
        return json_encode($data);
  }
}
?>