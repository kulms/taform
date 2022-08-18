<?php

$ldap_error = array(	"ERR-000: OK",
						"ERR-001: Bind error",
						"ERR-002: Anonymous search failed",
						"ERR-003: User unknown",
						"ERR-004: More than one such user",
						"ERR-005: bind failed. user not authenticated.");

$ldap_uid			= "";
$ldap_engname		= "";
$ldap_thainame		= "";
$ldap_email			= "";
$ldap_gender		= "";
$ldap_Job			= "";
$ldap_position		= "";
$ldap_department	= "";
$ldap_faculty		= "";
$ldap_campus		= "";		//รหัสวิทยาเขต ดังนี้ บางเขน=B , กำแพงแสน=K , ศรีราชา=S , สกลนคร=C
$ldap_idcode		= "";		//รหัสประจำตัวนิสิต


function user_authen($userid, $ldappass) {
     $host1   = "ldap2.ku.ac.th";
     $host2   = "ldap.ku.ac.th";
     $host3   = "ldap3.ku.ac.th";
     $base_dn = "dc=ku,dc=ac,dc=th";

     $ldapserver = ldap_connect($host1);
	 if(!$ldapserver)
        {
                $ldapserver = ldap_connect($host2);
                if(!$ldapserver){
                $ldapserver = ldap_connect($host3);
                }
        }

		$bind = ldap_bind($ldapserver);
//        if(!bind)
        if(!$bind)
        {
               return(1);
        }

	$filter = "uid=" . $userid;
        $inforequired = array("employeeType","department","thainame","mail","givenName",
                        "sn","uid","entrydn","gender","jobdescription","position","faculty","campus","idcode");
        $result = ldap_search($ldapserver,$base_dn,$filter,$inforequired);
        $info = ldap_get_entries($ldapserver,$result);
        if(!$result)
        {
                return(2);
        }
        if($info["count"] == 0)
        {
                return(3);
        }
        if($info["count"] > 1)
        {
                return(4);
        }
		$user_dn = $info[0]["dn"];
        $bind = @ldap_bind($ldapserver,$user_dn,$ldappass);
        if(!$bind)
        {
                return(5);
        }

        $GLOBALS["ldap_uid"]		= $info[0]["uid"][0];
        $GLOBALS["ldap_engname"]	= $info[0]["givenname"][0] . " " . $info[0]["sn"][0];
        $GLOBALS["ldap_thainame"]	= $info[0]["thainame"][0];
        $GLOBALS["ldap_email"]		= $info[0]["mail"][0];
        $GLOBALS["ldap_gender"]		= $info[0]["gender"][0];
        $GLOBALS["ldap_Job"]		= $info[0]["jobdescription"][0];
        $GLOBALS["ldap_position"]	= $info[0]["position"][0];
        $GLOBALS["ldap_department"] = $info[0]["department"][0];
        $GLOBALS["ldap_faculty"]	= $info[0]["faculty"][0];
        $GLOBALS["ldap_campus"]		= $info[0]["campus"][0];
	$GLOBALS["ldap_idcode"]		= $info[0]["idcode"][0];

		ldap_close($ldapserver);

        return(0);

}

?>
