<?php

include 'function.php';


function Login()
{
    if(empty($_POST['company_id'])){
          header("Location: index.php?wrong");
    }
    if(empty($_POST['password'])){
          header("Location: index.php?wrong");
    }

    $company_id = intval($_POST['company_id']);
    $password = trim($_POST['password']);
    $password = $password;

    if(!CheckLoginInDB($company_id,$password)){
        header("Location: index.php?wrong");

    }else{
          $_SESSION["company_id"] = $company_id;
          header("Location: ia.php");
    }

  }
  login();

  function CheckLoginInDB($company_id,$password){

    $result = get_result("SELECT c_id FROM company WHERE c_id = ".$company_id." AND  password = '".$password."'");

    if ($result->num_rows !== 1)
    {
      return false;
    }else{
      return true;
    }

  }
