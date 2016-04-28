<?php


include '../function.php';


function Login()
{
    if(empty($_POST['company_id'])){
        return false;
    }
    if(empty($_POST['password'])){
        return false;
    }

    $company_id = trim($_POST['company_id']);
    $password = trim($_POST['password']);
    $password = $password;

    if(!CheckLoginInDB($company_id,$password)){
        header("Location: company_login.php?wrong");

    }else{

          header("Location: index.php");
    }

  }
  login();

  function CheckLoginInDB($company_id,$password){

    $result = get_result("SELECT c_id, password FROM company WHERE c_id = '".$company_id."' AND  password = '".$password."'");

    if ($result->num_rows !== 1)
    {
      return false;
    }else{
      return true;
    }


  }
