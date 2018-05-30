<?php
require("candidate.php");
$req_method = $_SERVER['REQUEST_METHOD'];
if($req_method == 'POST' && $_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT')
  $req_method = 'PUT';
if($req_method == 'POST' && $_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE')
  $req_method = 'DELETE';

switch ($req_method) {

  case 'GET':
    $candidate = new Candidate();
    if(isset($_GET['request']) && !is_numeric($_GET['request'])){
      echo $candidate -> getAllCandidates();
    }else{
      echo $candidate -> getCandidate($_GET['request']);
    }
    break;
  case 'POST':
    $candidate = new Candidate();
    $entityBody = file_get_contents('php://input');
    echo $candidate -> insertCandidate($entityBody);
    break;
  case 'PUT':
    $candidate = new Candidate();
    $entityBody = file_get_contents('php://input');
    echo $candidate -> updateCandidate($_GET['request'], $entityBody);
    break;
  case 'DELETE':
    $candidate = new Candidate();
    if(isset($_GET['request']) && is_numeric($_GET['request'])){
      echo $candidate -> deleteCandidate($_GET['request']);
    }else{
      http_response_code(400);
    }
    break;
  default:
    http_response_code(405);
    break;
}

?>
