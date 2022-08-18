<?php
include 'includes/conn.php';
// include ('includes/extra_mysqli.php');
// include ('includes/functions.php');

include_once 'gpConfig.php';
include_once 'User.php';

if(isset($_GET['code'])){
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
	$gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
	//Get user profile data from google
	$gpUserProfile = $google_oauthV2->userinfo->get();
	
	//Initialize User class
	$user = new User();
	
	//Insert or update user data to the database
    $gpUserData = array(
        'oauth_provider'=> 'google',
        'oauth_uid'     => $gpUserProfile['id'],
        'first_name'    => $gpUserProfile['given_name'],
        'last_name'     => $gpUserProfile['family_name'],
        'email'         => $gpUserProfile['email'],
        'gender'        => $gpUserProfile['gender'],
        'locale'        => $gpUserProfile['locale'],
        'picture'       => $gpUserProfile['picture'],
        'link'          => $gpUserProfile['link']
    );
    $userData = $user->checkUser($gpUserData);
	
	//Storing user data into session
	$_SESSION['userData'] = $userData;
	
	//Render facebook profile data
    if(!empty($userData)){
        
        // $output = '<h1>Google+ Profile Details </h1>';
        // $output .= '<img src="'.$userData['picture'].'" width="300" height="220">';
        // $output .= '<br/>DB User ID : ' . $userData['id'];
        // $output .= '<br/>Google ID : ' . $userData['oauth_uid'];
        // $output .= '<br/>Name : ' . $userData['first_name'].' '.$userData['last_name'];
        // $output .= '<br/>Email : ' . $userData['email'];
        // $output .= '<br/>Gender : ' . $userData['gender'];
        // $output .= '<br/>Locale : ' . $userData['locale'];
        // $output .= '<br/>Logged in with : Google';
        // $output .= '<br/><a href="'.$userData['link'].'" target="_blank">Click to Visit Google+ Page</a>';
        // $output .= '<br/>Logout from <a href="logout.php">Google</a>'; 

        $user_login = substr($userData['email'], 0, strpos($userData['email'], '@'));
        $user_email = $userData['email'];
        $user_fname = $userData['first_name'];
        $user_lname = $userData['last_name'];
        $user_picture = $userData['picture'];

        $prevQuery = "SELECT * FROM member WHERE username='$user_login';";
        $query = mysqli_query($conn,$prevQuery);
        $rowcount=mysqli_num_rows($query);

        if($rowcount>0){
            $updateQuery = "UPDATE member set lupdate_date=now() WHERE username='$user_login';";
            
            // echo $updateQuery."<br>";
            
            mysqli_query($conn,$updateQuery); 
            
            $result=mysqli_fetch_array($query);
            $user_id=$result["id"];
            //$utype=$result["user_type"];
            $udept=$result["dept_id"];

            session_start();

            //$_SESSION["person_id"]=$user_id;
			//$_SESSION["slogin"]=$user_login;
			//$_SESSION["utype"]=$utype;
            //$_SESSION["udept"]=$udept;
            $_SESSION['member'] = $user_id;
			$_SESSION['deptid'] = $udept;   
            
        }else{
            $today = date("Y-m-d");
            $insertQuery = "insert into member 
                            (username,password,firstname,lastname,photo,dept_id,created_on) 
                            values 
                            ('$user_login','google','$user_fname','$user_lname','$user_picture','42','$today');";

            // echo $insertQuery."<br>";                
            mysqli_query($conn,$insertQuery);
            
            session_start();

            $newid=mysqli_insert_id($conn);
            // $_SESSION["person_id"]=$newid;
			// $_SESSION["slogin"]=$user_login;
            // $_SESSION["utype"]=2;
            // $_SESSION["udept"]=42;
            $_SESSION['member'] = $newid;
			$_SESSION['deptid'] = 42;   
        }

        header("Location: home.php");

    }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
} else {
	//$authUrl = $gClient->createAuthUrl();
    //$output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="images/glogin.png" alt=""/></a>';
    header("Location: index.php?fail=1");
}
?>

<!-- <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login with Google using PHP by CodexWorld</title>
<style type="text/css">
h1{font-family:Arial, Helvetica, sans-serif;color:#999999;}
</style>
</head>
<body>
<div><?php echo $output; ?></div>
</body>
</html> -->
