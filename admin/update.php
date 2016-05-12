<?php

include '../function.php';
protect("admin");

  if(isset($_GET["next"]))
  {
    $s_id = $_GET["s_id"];
    $a_id = 1;
    $result = user_update_by_service($s_id,$a_id);
    header("Location: service.php?s_id=".$s_id);
  }

  if(isset($_GET["skip"]))
  {
    $s_id= $_GET["s_id"];
    $a_id = 1;
    user_update_state();
    user_update_by_service($s_id,$a_id);


    $u_numb = get_var("SELECT phone_no FROM user WHERE s_id = $s_id ORDER BY u_id DESC LIMIT 1 ");
    sendSMS(makeSkipSMS($u_numb));


    header("Location: service.php?s_id=".$s_id);
  }
  if (isset($_POST["name"])) {
      if (strlen($_POST["name"])!= 0) {
        $s_id=new_service($_POST["name"]);
        header("Location: service.php?s_id=".$s_id);
      }
      else {
        header("Location: index.php");
      }
    }
    if(isset($_GET["reset"]))
    {
      $s_id= $_GET["s_id"];
      reset_queue($s_id);
      header("Location: service.php?s_id=".$s_id);
    }
    if(isset($_GET["remove"]))
    {
      $s_id= $_GET["s_id"];
      remove_service($s_id);
      header("Location: index.php");
    }

    /*----------------------- Settings page ---------------*/
    //change reminder time
    if (isset($_POST["rem"])) {
      $s_id= $_POST["s_id"]; //this service id
      $r_time=$_POST["content"];// what you changed to in the textfield
      get_result("UPDATE service SET r_time=$r_time WHERE s_id=$s_id");
      header("Location: settings.php");//send you back to the same page
    }
    //change service name
    if (isset($_POST["edit"])) {
      $s_id= $_POST["s_id"];
      $name= $_POST["content"];
      get_result("UPDATE service SET name='$name' WHERE s_id=$s_id");
      header("Location: settings.php");
    }
    if (isset($_POST["a_edit"])) {
      $admin_name=$_POST["a_content"];
      $a_id=$_POST["a_id"];
      get_result("UPDATE admin SET admin_name='$admin_name' WHERE a_id=$a_id");
      header("Location: am.php");
    }
