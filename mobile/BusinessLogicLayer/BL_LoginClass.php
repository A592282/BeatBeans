<?php
@session_start();
/**
 * Description of DA_LoginClass
 *
 * @author Nithin Devang
 */
class BL_LoginClass {
    private $LoginId;
    private $LoginTrue;
    public function BL_LoginClass() {
        $this->LoginTrue=false;
    }
    public function LoginValidate($EmailId_,$Password_,$Md5Pass_=false) {
        require_once(dirname(__FILE__)."/../DataAccessLayer/DA_QueryClass.php");
        if(empty($EmailId_))
            return false;
        if(empty($Password_))
            return false;
        $EmailId_=trim($EmailId_);
        $Password_=trim($Password_);

        if(!isset($_SESSION)) {
            session_start();
        }

        $EmailId_ = $this->SanitizeForSQL($EmailId_);
        if(!$Md5Pass_)
            $Password_ = md5($Password_);
        $QueryClassObject=new DA_QueryClass();
        $QueryClassObject->SetTable("userinfo");
        $QueryClassObject->AddField("PassWord");
        $QueryClassObject->AddField("Status");
        $QueryClassObject->AddCondition("Email", $EmailId_);
        $LoginReturn=json_decode($QueryClassObject->Select());
        if(empty($LoginReturn)) return false;
        if(($LoginReturn[0]->Status)!="Active")
        {
            $_SESSION['LoginFailFlag']="Email";
            return false;
        }
        if($LoginReturn[0]->PassWord==$Password_) {
            $this->LoginId=$EmailId_;
            $this->LoginTrue=true;
            return true;
        }
        else
            return false;
    }
    public function PasswordResetRequest($Email_) {
        require_once(dirname(__FILE__)."/../DataAccessLayer/DA_QueryClass.php");
        require_once(dirname(__FILE__)."/BL_Mail.php");
        if(!empty($Email_))
        {
            $Email_=$this->SanitizeForSQL($Email_);
            $QueryClassObject=new DA_QueryClass();
            $QueryClassObject->SetTable("userinfo");
            $QueryClassObject->AddField("Password Reset","Status");
            $QueryClassObject->AddCondition("Email", $Email_);
            if($QueryClassObject->Update())
            {
                $Token=uniqid(rand(),TRUE);
                unset($QueryClassObject);
                $QueryClassObject=new DA_QueryClass();
                $QueryClassObject->SetTable("userinfo");
                $QueryClassObject->AddField($Token,"Random");
                $QueryClassObject->AddCondition("Email", $Email_);
                if($QueryClassObject->Update())
                {
                    $To=$Email_;
                    $Subject="Validate your E-mail";
                    $Message='<p>We have recieved your Password reset request at BeatBeans.com </br>
                        you can do that by link click :P.<br />
                        Please click the link below or copy paste that to your browser address bar</p>
                        ';
                    $Message=$Message.'<a href="https://beatbeans.com/vchangepassword.php?id='.$Token.'">click Here</a>';
                    return(SendMail($To, $Subject, $Message));
                }
            }
        }
    }
    public function PasswordReset($Token_,$NewPassword_) {
        if(empty($NewPassword_)) return false;
        require_once(dirname(__FILE__)."/../DataAccessLayer/DA_QueryClass.php");
        $NewPassword_ =md5($NewPassword_);
        unset($QueryClassObject);
        $QueryClassObject=new DA_QueryClass();
        $QueryClassObject->SetTable("userinfo");
        $QueryClassObject->AddField($NewPassword_,"PassWord");
        $QueryClassObject->AddCondition("Random", $Token_);
        if($QueryClassObject->Update()){
            return($this->TokenValidate($Token_));
        }
    }
    public function Register($NewUserArray) {
        require_once(dirname(__FILE__)."/../DataAccessLayer/DA_QueryClass.php");
        require_once(dirname(__FILE__)."/BL_Mail.php");
        //if(empty($NewUserArray['UserName'])) return false;
        if(empty($NewUserArray['FullName'])) return false;
        if(empty($NewUserArray['PassWord'])) return false;
        if(empty($NewUserArray['Address'])) return false;
        if(empty($NewUserArray['Phone'])) return false;
        if(empty($NewUserArray['Email'])) return false;
        //$NewUserArray['UserName'] = $this->SanitizeForSQL($NewUserArray['UserName']);
        $NewUserArray['Email'] = $this->SanitizeForSQL($NewUserArray['Email']);
        $NewUserArray['PassWord'] =md5($NewUserArray['PassWord']);

        //Date Start
        date_default_timezone_set('Asia/Kolkata');
        $NewUserArray['CreationDate']=date("F j, Y, g:i a");
        //Date End
        //token start
        $Token=uniqid(rand(),TRUE);
        //token end

        $QueryClassObject=new DA_QueryClass();
        $QueryClassObject->SetTable("userinfo");
        $QueryClassObject->AddField("Email");
        $QueryClassObject->AddCondition("Email", $NewUserArray['Email']);
        $LoginReturn=json_decode($QueryClassObject->Select());
        if(!empty($LoginReturn)) return false;
        
        unset($QueryClassObject);
        $QueryClassObject=new DA_QueryClass();
        $QueryClassObject->SetTable("userinfo");
        $QueryClassObject->AddField("Phone");
        $QueryClassObject->AddCondition("Phone", $NewUserArray['Phone']);
        $LoginReturn=json_decode($QueryClassObject->Select());
        if(!empty($LoginReturn)) return false;

        unset($QueryClassObject);
        $QueryClassObject=new DA_QueryClass();
        $QueryClassObject->SetTable("userinfo");
        $QueryClassObject->AddField($NewUserArray['FullName']);
        $QueryClassObject->AddField($NewUserArray['PassWord']);
        $QueryClassObject->AddField($NewUserArray['Address']);
        $QueryClassObject->AddField($NewUserArray['Phone']);
        $QueryClassObject->AddField($NewUserArray['Email']);
        $QueryClassObject->AddField("");
        $QueryClassObject->AddField("");
        $QueryClassObject->AddField($NewUserArray['CreationDate']);
        $QueryClassObject->AddField($Token);
        $QueryClassObject->AddField("Pending");
        if($QueryClassObject->Insert())
        {
            $To=$NewUserArray['Email'];
            $Subject="Validate your E-mail";
            $Message='<p>We have recieved your registration request at BeatBeans.com </br>
                How ever you need to validate your email ID by link click :P.<br />
                Please click the link below or copy paste that to your browser address bar</p>
                ';
            $Message=$Message.'<a href="https://beatbeans.com/validateusermail.php?id='.$Token.'">click Here</a>';
            return(SendMail($To, $Subject, $Message));
            return true;
        }
        else return false;
    }
    public function TokenValidate($Token_)
    {
        require_once(dirname(__FILE__)."/../DataAccessLayer/DA_QueryClass.php");
        $QueryClassObject=new DA_QueryClass();
        $QueryClassObject->SetTable("userinfo");
        $QueryClassObject->AddField("Random");
        $QueryClassObject->AddCondition("Random", $Token_);
        $Return=json_decode($QueryClassObject->Select());
        if(empty($Return)) return false;
        
        unset($QueryClassObject);
        $QueryClassObject=new DA_QueryClass();
        $QueryClassObject->SetTable("userinfo");
        $QueryClassObject->AddField("Active","Status");
        $QueryClassObject->AddCondition("Random", $Token_);
        if($QueryClassObject->Update())
        {
            unset($QueryClassObject);
            $QueryClassObject=new DA_QueryClass();
            $QueryClassObject->SetTable("userinfo");
            $QueryClassObject->AddField("Email");
            $QueryClassObject->AddField("PassWord");
            $QueryClassObject->AddCondition("Random", $Token_);
            $LoginReturn=json_decode($QueryClassObject->Select());
            return($this->LoginValidate($LoginReturn[0]->Email,$LoginReturn[0]->PassWord,true));
        }
        return false;
    }
    public function LoginCheck() {
        if((isset ($this->LoginId))&&($this->LoginTrue)) {
            return true;
        }
        else
            return false;
    }
    public function GetLoginId() {
        if((isset ($this->LoginId))&&($this->LoginTrue)) {
            return $this->LoginId;
        }
    }
    function SanitizeForSQL($str) {
        require_once(dirname(__FILE__)."/../DataAccessLayer/DA_QueryClass.php");
        $QueryClassObject=new DA_QueryClass();
        if( function_exists( "mysql_real_escape_string" ) ) {
            $ret_str = mysql_real_escape_string( $str );
        }
        else {
            $ret_str = addslashes( $str );
        }
        return $ret_str;
    }
}
//echo "DEBUG LINE BEABEANS.COM<br />";
//$Login=new BL_LoginClass();
//$_SESSION['Login']->LoginValidate("testtest","testtest");
//if($_SESSION['Login']->LoginCheck()) echo "true"; else echo "false";
//echo $a->GetLoginId();
//echo md5("testtest")
//$NewUserVariable=array();
//$NewUserVariable['UserName']="Nithin Devang";
//$NewUserVariable['PassWord']="testpass";
//$NewUserVariable['FullName']="Nithin Devang";
//$NewUserVariable['Address']="Adress";
//$NewUserVariable['Phone']="8892354220";
//$NewUserVariable['Email']="devang@ggg.com";
//$Login->Register($NewUserVariable);
?>
