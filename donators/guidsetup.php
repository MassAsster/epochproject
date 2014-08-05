<?php
  require_once 'bootstrap.php';
  include ('style.php');
  require('config.php');
  require_once "formvalidator.php";
  require('InputValidator.php');
  $c = core::init();
  secure_page();
  $c = get_data();
  $user="$c->username";
  error_reporting(E_ALL ^ E_DEPRECATED);
  ?>
<center>
<?php
  //include the main validation script
  $show_form=true;
  class MyValidator extends CustomValidator{
    function DoValidate(&$formars,&$error_hash){
      
      if(stristr($formars['who'],'<'))        {
        $error_hash['Reason']="No bullshit code attempts please";
        return false;
      }

      return true;
    }

  }

  
  if(isset($_POST['Submit'])){
    // The form is submitted
    //Setup Validations
    $validator = new FormValidator();
    $validator->addValidation("who","req","Please fill in ID");
    // $validator->addValidation("who","num","ID IS NUMBERS ONLY");
    // $validator->addValidation("reason","req","Required");
    $custom_validator = new MyValidator();
    $validator->AddCustomValidator($custom_validator);
    //Now, validate the form
    
    if($validator->ValidateForm())    {
      //Validation success. 
      //Here we can proceed with processing the form 
      //(like sending email, saving to Database etc)
      // In this example, we just display a message
      echo "<h4>Form Validation Success</h4>";


      $ip=$_SERVER['REMOTE_ADDR'];
      $id=$_POST['who'];
      // get the value of name
      $query = $c->db->prepare("SELECT * FROM `authorize` WHERE guid=:id");
      $query->execute(array(':id' => $id));

      
      if ($query->rowCount() > 0) {
        echo "ERROR: This ID is already registered by another user";
        echo "<P><a href=welcome.php>Home</a>";
        exit;
      } else {
        // no data matched
      }

      //mysql_query("INSERT INTO `thelist2` VALUES ('$id', '$user', '$whyid', 'none.jpg', '$playername', '$ip', '$today', '0', '$video2')") ;
      
      if($logging == 1) {
        $date = date('Y-m-d H:i:s');
        $query = $c->db->prepare("INSERT INTO `donatorlog` (`date`, `user`, `action`) VALUES (:date, :user, :id);");
        $query->execute(array(':date' => $date,':user' => $user, ':id' => 'PID Setup: added'.$id));
      }

      $query = $c->db->prepare("UPDATE `authorize` SET guid=:id WHERE username=:user ");
      $query->execute(array(':user' => $user, ':id' => $id));
      echo "Success ID Entered<P>";
      echo "<P><a href=welcome.php>Home</a>";
      echo "<P><a href=\"#\" onClick=\"history.go(-1)\">Back</a>";
      exit;
      $show_form=false;
    } else {
      echo "<B>Validation Errors:</B>";
      $error_hash = $validator->GetErrors();
      foreach($error_hash as $inpname => $inp_err)        {
        echo "<p>$inpname : $inp_err</p>\n";
      }

    }

    //else
  }

  //if(isset($_POST['Submit']))
  
  if(true == $show_form){
    ?>
<table cellspacing='0' cellpadding='10' border='1' bordercolor='#000000'><tr><td>
<P>
<form name='test' method='POST' action='' accept-charset='UTF-8'>
<table cellspacing='0' cellpadding='10' border='0' bordercolor='#000000'>
   <tr>
      <td>
         <table cellspacing='2' cellpadding='2' border='0'>
            <tr>
            <td align='right'>User:
            <td> <?php 
    $ip=$_SERVER['REMOTE_ADDR'];
    echo " $user at $ip";
    ?>
            <tr>
               <td align='right' class='normal_field'>Profile ID</td>
               <td class='element_label'>
                  <input type='text' name='who' placeholder="NUMBERS ONLY" size='20'><td> 
               </td>
               <tr>How Do I find my Profile ID? <a href="http://www.youtube.com/watch?v=E8bFc3W8RkI" target="_blank">Click here</a></tr>
            </tr>
            <tr>
               <td colspan='2' align='center'>
                  <input type='submit' name='Submit' value='Submit'>
               </td>
            </tr>
         </table>
      </td>
   </tr>
</table>
</form>
<?PHP
 }//true == $show_form
 ?>
</body>
<html>