<?php
function addSaasInfoTables($con) {
	$sql = 'SELECT count(1)FROM information_schema.tables WHERE table_schema = ' . '\'' . 'dacamsys_apps' . '\'' . ' AND table_name = ' . '\'' . 'saasinfo' . '\';';
	$resultrows = getResultArray($con, $sql);
	$count = $resultrows[0][0];
	if ($count == 0) {
		$sql = ' CREATE TABLE `dacamsys_apps`.`saasinfo` (
  `username` varchar(30) DEFAULT NULL,
  `appid` varchar(30) DEFAULT NULL
   ) ENGINE=InnoDB DEFAULT CHARSET=latin1;';
		$result = execSQL($con, $sql);
	}
	$sql = 'SELECT count(1)FROM information_schema.tables WHERE table_schema = ' . '\'' . 'dacamsys_apps' . '\'' . 'AND table_name = ' . '\'' . 'saasmetrictable' . '\';';
	$resultrow = getResultArray($con, $sql);
	$macount = $resultrow[0][0];
	if ($macount == 0) {
		$sql = 'CREATE TABLE `dacamsys_apps`.`saasmetrictable` (
  `appid` varchar(30) DEFAULT NULL,
  `profilelimit` varchar(30) DEFAULT NULL,
  `isfieldlevelsecurity` tinyint(30) DEFAULT NULL,
  `isdatasharingrule` tinyint(30) DEFAULT NULL,
  `isdatatransfer` tinyint(30) DEFAULT NULL,
  `memory` varchar(30) DEFAULT NULL,
  `ram` varchar(30) DEFAULT NULL,
  `bandwidth` varchar(30) DEFAULT NULL,
  `numberofuser` varchar(30) DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `duration` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;';
		$result = execSQL($con, $sql);
	}
}

function addFeatureInfoTables($con) {
	$sql = 'SELECT count(1)FROM information_schema.tables WHERE table_schema = ' . '\'' . 'dacamsys_apps' . '\'' . ' AND table_name = ' . '\'' . 'featurereltable' . '\';';
	$resultrows = getResultArray($con, $sql);
	$count = $resultrows[0][0];
	if ($count == 0) {
		$sql = 'CREATE TABLE `dacamsys_apps`.`featurereltable`(
  `featureindex` int(11) NOT NULL DEFAULT ' . '\'' . '0' . '\'' . ',
    `parentindex` int(11) NOT NULL DEFAULT ' . '\'' . '0' . '\'' . ',
    `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`featureindex`),
  UNIQUE KEY `Index_2` (`name`)
) ENGINE=InnoDB';
		$result = execSQL($con, $sql);
		$sql = 'INSERT INTO `dacamsys_apps`.`featurereltable` VALUES (1,0,' . '\'' . 'No of Profile' . '\'' . '),(2,0,' . '\'' . 'No of Users' . '\'' . '),(3,0,' . '\'' . 'Duration of Days' . '\'' . '),(4,0,' . '\'' . 'Total Record Count' . '\'' . '),(5,0,' . '\'' . 'Total Storage Size(MB)' . '\'' . ');';
		$result = execSQL($con, $sql);
	}
	$sql = 'SELECT count(1)FROM information_schema.tables WHERE table_schema = ' . '\'' . 'dacamsys_apps' . '\'' . ' AND table_name = ' . '\'' . featuretable . '\'' . ';';
	$resultrows = getResultArray($con, $sql);
	$count = $resultrows[0][0];
	if ($count == 0) {
		$sql = 'CREATE TABLE `dacamsys_apps`.`featuretable` (   `appid` varchar(30) DEFAULT NULL,   `features` int(30) NOT NULL DEFAULT ' . '\'' . '0' . '\'' . ',   PRIMARY KEY (`appid`) ) ENGINE=InnoDB;';
		$result = execSQL($con, $sql);
	}
	$sql = 'SELECT count(1)FROM information_schema.tables WHERE table_schema = ' . '\'' . 'dacamsys_apps' . '\'' . ' AND table_name = ' . '\'' . 'featurevaluetable' . '\'' . ';';
	$resultrows = getResultArray($con, $sql);
	$count = $resultrows[0][0];
	if ($count == 0) {
		$sql = 'CREATE TABLE `dacamsys_apps`.`featurevaluetable` (   `appid` varchar(30) DEFAULT NULL,   `featureindex` int(30) NOT NULL DEFAULT ' . '\'' . '0' . '\'' . ', `value` varchar(30) DEFAULT NULL,`lastupdatedtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,   PRIMARY KEY (`appid`,`featureindex`) ) ENGINE=InnoDB;';
		$result = execSQL($con, $sql);
	}
	$sql = 'SELECT count(1)FROM information_schema.tables WHERE table_schema = ' . '\'' . 'dacamsys_apps' . '\'' . ' AND table_name = ' . '\'' . 'featureavaillist' . '\';';
	$resultrows = getResultArray($con, $sql);
	$count = $resultrows[0][0];
	if ($count == 0) {
		$sql = 'CREATE TABLE `dacamsys_apps`.`featureavaillist` ( `name` varchar(30) DEFAULT NULL,`featureset` int(30) NOT NULL DEFAULT ' . '\'' . '0' . '\'' . ',`isdefault` tinyint(1) NOT NULL DEFAULT ' . '\'' . '0' . '\'' . ', PRIMARY KEY (`name`)) ENGINE=InnoDB;';
		$result = execSQL($con, $sql);
	}
}

function addUserActivityForms($con) {
	$sql = "select max(cast(relationid as signed)) from formrelationtable";
	$resultrows = getResultArray($con, $sql);
	$mrel = $resultrows[0][0] + 1;
	$sql = "select fieldorder from formfieldtable where formname = 'table_6' and name = 'table_6_0_createdusername'";
	$result = getResultArray($con, $sql);
	$ufieldorder = $result[0][0];
	$sql = "select name,fieldorder from formfieldtable where formname = 'table_6_group' order by fieldorder";
	$result = getResultArray($con, $sql);
	$sql = "select fieldorder from formfieldtable where formname = 'table_6_group' and name = 'createdon'";
	$result = getResultArray($con, $sql);
	$ugfieldorder = $result[0][0];
	$sql = "INSERT INTO formtable VALUES ('Setup','table_45','User Activity','',0,'',0,0,0,1,0,'ficon.png','g_root,g_root,0,1,0,0,0,0$" . "true,g_root,f_1,0,0,0,0,0,0$" . "true,g_root,f_2,1,0,0,0,0,0$" . "true,g_root,f_4,2,0,0,0,0,0$" . "true,g_root,f_5,3,0,0,0,0,0$" . "true,g_root,f_8,4,0,0,0,0,0$" . "true,g_root,f_9,5,0,0,0,0,0$" . "true,g_root,f_10,6,0,0,0,0,0$" . "true,g_root,f_11,7,0,0,0,0,0$" . "true',0,0,0,0,0,0,0,0,0,'','',0,0,0,1,0),('Setup','table_46','Daily Activity Calc','',0,'',0,0,0,1,0,'ficon.png','g_root,g_root,0,1,0,0,0,0$" . "true,g_root,f_1,0,0,0,0,0,0$" . "true,g_root,f_2,1,0,0,0,0,0$" . "true,g_root,f_3,2,0,0,0,0,0$" . "true,g_root,f_5,3,0,0,0,0,0$" . "true,g_root,f_6,4,0,0,0,0,0$" . "true',0,0,0,0,0,0,0,0,0,'','',0,0,0,1,0)";
	$result = execSQL($con, $sql);
	$sql = "INSERT INTO `formfieldtable` VALUES
        ('Setup','table_45','Activity_Name','Activity Name','Text','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,1,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
        ('Setup','table_45','Activity_Status','Activity Status','Text','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,4,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
        ('Setup','table_45','Activity_Time','Activity Time','Date_Time','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,2,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
        ('Setup','table_45','Base_Table_Id','Base Table Id','Text','40','','','','',1,1,100,200,150,0,0,'Normal','Advanced','',1,0,3,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
        ('Setup','table_45','createdon','Created Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,14,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
        ('Setup','table_45','Distance','Distance','Float','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,8,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
        ('Setup','table_45','Latitude','Latitude','Text','40','','','','',1,1,100,200,150,0,0,'Normal','Advanced','',1,0,6,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
        ('Setup','table_45','Location','Location','Text Area','500','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,5,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
        ('Setup','table_45','Longitude','Longitude','Text','40','','','','',1,1,100,200,150,0,0,'Normal','Advanced','',1,0,7,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
        ('Setup','table_45','table_45_id','table_45_id','form_entityid','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,0,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
        ('Setup','table_45','table_6_0_createdusername','Created Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,13,0,0,0,0,0,'',1,0,0,0,'ALL',$mrel),
        ('Setup','table_45','table_6_1_updatedusername','Updated Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,15,0,0,0,0,0,'',1,0,0,0,'ALL',$mrel+1),
        ('Setup','table_45','table_6_2_viewedusername','Viewed Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,17,0,0,0,0,0,'',1,0,0,0,'ALL',$mrel +2),
        ('Setup','table_45','table_6_3_table_6_group_id','Assigned to group','reference_group','40','','','','',1,1,100,200,150,0,0,'Normal','Advanced','current',1,0,12,0,0,0,0,0,'',1,0,0,0,'ALL',$mrel+4),
        ('Setup','table_45','table_6_3_table_6_id','User Name','entity_group','40','','','','',0,0,100,200,150,0,1,'Normal','Advanced','current',1,0,11,0,0,0,0,0,'',1,0,0,0,'ALL',$mrel+3),
        ('Setup','table_45','Travel_Hrs','Travel Hrs','Text','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,9,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
        ('Setup','table_45','updatedon','Updated Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,16,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
        ('Setup','table_45','viewedon','Viewed Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,18,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
        ('Setup','table_45','Work_Hrs','Work Hrs','Text','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,10,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
        ('Setup','table_46','Activity_Date','Activity Date','date','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,2,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
        ('Setup','table_46','createdon','Created Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,8,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
        ('Setup','table_46','Distance','Distance','Int','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,1,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
        ('Setup','table_46','table_46_id','table_46_id','form_entityid','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,0,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
        ('Setup','table_46','table_6_0_createdusername','Created Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,7,0,0,0,0,0,'',1,0,0,0,'ALL',$mrel+5),
        ('Setup','table_46','table_6_1_updatedusername','Updated Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,9,0,0,0,0,0,'',1,0,0,0,'ALL',$mrel+6),
        ('Setup','table_46','table_6_2_viewedusername','Viewed Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,11,0,0,0,0,0,'',1,0,0,0,'ALL',$mrel+7),
        ('Setup','table_46','table_6_3_table_6_group_id','Assigned to group','reference_group','40','','','','',1,1,100,200,150,0,0,'Normal','Advanced','current',1,0,4,0,0,0,0,0,'',1,0,0,0,'ALL',$mrel+9),
        ('Setup','table_46','table_6_3_table_6_id','User Name','entity_group','40','','','','',0,0,100,200,150,0,1,'Normal','Advanced','current',1,0,3,0,0,0,0,0,'',1,0,0,0,'ALL',$mrel+8),
        ('Setup','table_46','Travel_Hrs','Travel Hrs','Float','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,5,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
        ('Setup','table_46','updatedon','Updated Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,10,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
        ('Setup','table_46','viewedon','Viewed Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,12,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
        ('Setup','table_46','Work_Hrs','Work Hrs','Float','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,6,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
        ('Setup','table_6','table_45_3_table_45','User Name','subtable','40','','','','',1,0,100,200,150,0,1,'Normal','Advanced','current',1,0,$ufieldorder,0,0,0,0,0,'',1,0,0,0,'ALL',$mrel+9),
        ('Setup','table_6_group','table_45_0_table_45','Assigned to group','subtable','40','','','','',1,1,100,200,150,0,0,'Normal','Advanced','current',1,0,$ugfieldorder,0,0,0,0,0,'',1,0,0,0,'ALL',$mrel+10),
        ('Setup','table_6','table_46_3_table_46','User Name','subtable','40','','','','',1,0,100,200,150,0,1,'Normal','Advanced','current',1,0,$ufieldorder+1,0,0,0,0,0,'',1,0,0,0,'ALL',$mrel+11),
        ('Setup','table_6_group','table_46_0_table_46','Assigned to group','subtable','40','','','','',1,1,100,200,150,0,0,'Normal','Advanced','current',1,0,$ugfieldorder+1,0,0,0,0,0,'',1,0,0,0,'ALL',$mrel+12)";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder=fieldorder+2 where formname='table_6' and type in
('form_history')";
	execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder=fieldorder+2 where formname='table_6_group' and type in
('form_history')";
	execSQL($con, $sql);
	$sql = "INSERT INTO `formactiontable` VALUES ('Setup','table_45','Add','Add',1,'',0),('Setup','table_45','Calendar','Calendar',1,'',5),('Setup','table_45','Delete','Delete',1,'',2),('Setup','table_45','Edit','Edit',1,'',1),('Setup','table_45','Export','Export',1,'',7),('Setup','table_45','Import','Import',1,'',6),('Setup','table_45','Print','Print',1,'',8),('Setup','table_45','Search','Search',1,'',4),('Setup','table_45','View','View',1,'',3),('Setup','table_46','Add','Add',1,'',0),('Setup','table_46','Calendar','Calendar',1,'',5),('Setup','table_46','Delete','Delete',1,'',2),('Setup','table_46','Edit','Edit',1,'',1),('Setup','table_46','Export','Export',1,'',7),('Setup','table_46','Import','Import',1,'',6),('Setup','table_46','Print','Print',1,'',8),('Setup','table_46','Search','Search',1,'',4),('Setup','table_46','View','View',1,'',3)";
	$result = execSQL($con, $sql);

	$sql = "INSERT INTO `formfieldreference` VALUES
('Setup','table_45','table_6_0_createdusername','Setup','table_6','Name',$mrel),
('Setup','table_45','table_6_1_updatedusername','Setup','table_6','Name',$mrel+1),
('Setup','table_45','table_6_2_viewedusername','Setup','table_6','Name',$mrel+2),
('Setup','table_45','table_6_3_table_6_group_id','Setup','table_6_group','groupname',$mrel+4),
('Setup','table_45','table_6_3_table_6_id','Setup','table_6','Name',$mrel+3),
('Setup','table_46','table_6_0_createdusername','Setup','table_6','Name',$mrel+5),
('Setup','table_46','table_6_1_updatedusername','Setup','table_6','Name',$mrel+6),
('Setup','table_46','table_6_2_viewedusername','Setup','table_6','Name',$mrel+7),
('Setup','table_46','table_6_3_table_6_group_id','Setup','table_6_group','groupname',$mrel+9),
('Setup','table_46','table_6_3_table_6_id','Setup','table_6','Name',$mrel+8),
('Setup','table_6','table_45_3_table_45','Setup','table_45','',$mrel+10),
('Setup','table_6_group','table_45_0_table_45','Setup','table_45','',$mrel+11),
('Setup','table_6','table_46_3_table_46','Setup','table_46','',$mrel+12),
('Setup','table_6_group','table_46_0_table_46','Setup','table_46','',$mrel+13)";
	$result = execSQL($con, $sql);

	$sql = "INSERT INTO `formrelationtable` VALUES ($mrel,$mrel,0,'table_45','table_6','n-1','',0,''),($mrel+1,$mrel+1,1,'table_45','table_6','n-1','',0,''),($mrel+2,$mrel+2,2,'table_45','table_6','n-1','',0,''),($mrel+3,$mrel+10,3,'table_45','table_6','n-1','',0,''),($mrel+10,$mrel+3,3,'table_6','table_45','1-n','',0,''),($mrel+4,$mrel+11,0,'table_45','table_6_group','n-1','',0,''),($mrel+11,$mrel+4,0,'table_6_group','table_45','1-n','',0,''),($mrel+5,$mrel+5,0,'table_46','table_6','n-1','',0,''),($mrel+6,$mrel+6,1,'table_46','table_6','n-1','',0,''),($mrel+7,$mrel+7,2,'table_46','table_6','n-1','',0,''),($mrel+8,$mrel+12,3,'table_46','table_6','n-1','',0,''),($mrel+12,$mrel+8,3,'table_6','table_46','1-n','',0,''),($mrel+9,$mrel+13,0,'table_46','table_6_group','n-1','',0,''),($mrel+13,$mrel+9,0,'table_6_group','table_46','1-n','',0,'')";
	$result = execSQL($con, $sql);

	$sql = "INSERT INTO `idgenerator` VALUES ('table_45_frm','0'),('table_46_frm','0')";
	$result = execSQL($con, $sql);
	$sql = "INSERT INTO `table_2_frmscreen` VALUES ('super admin profile','Setup','table_45,table_45'),('super admin profile','Setup','table_46,table_46')";
	$result = execSQL($con, $sql);

	$sql = "INSERT INTO `table_2_frmfields` VALUES ('super admin profile','Setup','table_45','#table_45_id,table_45_id#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$#Activity_Name,Activity_Name#1,1$#Activity_Time,Activity_Time#1,1$#Base_Table_Id,Base_Table_Id#1,1$#Activity_Status,Activity_Status#1,1$#Location,Location#1,1$#Latitude,Latitude#1,1$#Longitude,Longitude#1,1$#Distance,Distance#1,1$#Travel_Hrs,Travel_Hrs#1,1$#Work_Hrs,Work_Hrs#1,1$#table_6_3_table_6_id,table_6_3_table_6_id#1,1$#table_6_3_table_6_id,table_6_3_table_6_id#1,1$#table_6_3_table_6_group_id,table_6_3_table_6_group_id#1,1$'),('super admin profile','Setup','table_46','#table_46_id,table_46_id#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$#Distance,Distance#1,1$#Activity_Date,Activity_Date#1,1$#table_6_3_table_6_id,table_6_3_table_6_id#1,1$#table_6_3_table_6_id,table_6_3_table_6_id#1,1$#table_6_3_table_6_group_id,table_6_3_table_6_group_id#1,1$#Travel_Hrs,Travel_Hrs#1,1$#Work_Hrs,Work_Hrs#1,1$')";
	$result = execSQL($con, $sql);

	$sql = "INSERT INTO `table_2_frmaction` VALUES ('super admin profile','Setup','table_45','ScreenAccess,ScreenAccess#ScreenAccess,ScreenAccess#Add,Add#Edit,Edit#Delete,Delete#View,View#Search,Search#Calendar,Calendar#Import,Import#Export,Export#Print,Print#'),('super admin profile','Setup','table_46','ScreenAccess,ScreenAccess#ScreenAccess,ScreenAccess#Add,Add#Edit,Edit#Delete,Delete#View,View#Search,Search#Calendar,Calendar#Import,Import#Export,Export#Print,Print#')";
	$result = execSQL($con, $sql);

	$sql = "CREATE TABLE `table_45_frm` (
  `table_45_id` varchar(40) NOT NULL,
  `table_6_0_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `createdon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Activity_Name` varchar(40) DEFAULT NULL,
  `Activity_Time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Base_Table_Id` varchar(40) DEFAULT NULL,
  `Activity_Status` varchar(40) DEFAULT NULL,
  `Location` varchar(500) DEFAULT NULL,
  `Latitude` varchar(40) DEFAULT NULL,
  `Longitude` varchar(40) DEFAULT NULL,
  `Distance` float(40,2) DEFAULT NULL,
  `Travel_Hrs` varchar(40) DEFAULT NULL,
  `Work_Hrs` varchar(40) DEFAULT NULL,
  `table_6_3_table_6_id` varchar(30) DEFAULT NULL,
  `table_6_3_table_6_group_id` varchar(30) DEFAULT NULL,
  `table_6_1_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `updatedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `table_6_2_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `viewedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`table_45_id`),
  KEY `table_45_frmtable_6_3_table_6_id` (`table_6_3_table_6_id`),
  KEY `table_45_frmtable_6_3_table_6_group_id` (`table_6_3_table_6_group_id`),
  CONSTRAINT `table_45_frmtable_6_3_table_6_group_id` FOREIGN KEY (`table_6_3_table_6_group_id`) REFERENCES `table_6_group_frm` (`table_6_group_id`),
  CONSTRAINT `table_45_frmtable_6_3_table_6_id` FOREIGN KEY (`table_6_3_table_6_id`) REFERENCES `table_6_frm` (`table_6_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$result = execSQL($con, $sql);
	$sql = "CREATE TABLE `table_46_frm` (
  `table_46_id` varchar(40) NOT NULL,
  `table_6_0_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `createdon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Distance` float(40,2) DEFAULT NULL,
  `Activity_Date` date DEFAULT NULL,
  `table_6_3_table_6_id` varchar(30) DEFAULT NULL,
  `table_6_3_table_6_group_id` varchar(30) DEFAULT NULL,
  `Travel_Hrs` float(40,2) DEFAULT NULL,
  `Work_Hrs` float(40,2) DEFAULT NULL,
  `table_6_1_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `updatedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `table_6_2_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `viewedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`table_46_id`),
  KEY `table_46_frmtable_6_3_table_6_id` (`table_6_3_table_6_id`),
  KEY `table_46_frmtable_6_3_table_6_group_id` (`table_6_3_table_6_group_id`),
  CONSTRAINT `table_46_frmtable_6_3_table_6_group_id` FOREIGN KEY (`table_6_3_table_6_group_id`) REFERENCES `table_6_group_frm` (`table_6_group_id`),
  CONSTRAINT `table_46_frmtable_6_3_table_6_id` FOREIGN KEY (`table_6_3_table_6_id`) REFERENCES `table_6_frm` (`table_6_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$result = execSQL($con, $sql);

	$sql = "CREATE TABLE `3table_6_table_45_frm` (
  `table_6_id` varchar(30) DEFAULT NULL,
  `table_45_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$result = execSQL($con, $sql);

	$sql = "CREATE TABLE `3table_6_table_46_frm` (
  `table_6_id` varchar(30) DEFAULT NULL,
  `table_46_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$result = execSQL($con, $sql);
}

function addMobileSyncReport($con) {
	$sql="select reportid from reportform where reportname = 'Daily Mobile User Data Status'";
	$resultrows = getResultArray($con, $sql);
	if(sizeof($resultrows) > 0){
	$oldreportid=$resultrows[0][0];
	$sql = "delete from reportfilterfieldtable where reportid = '$oldreportid'";
	execSQL($con, $sql);
	$sql = "delete from reportfilterfieldvaluetable where reportid = '$oldreportid'";
	execSQL($con, $sql);
	$sql = "delete from reportfieldtable where reportid = '$oldreportid'";
	execSQL($con, $sql);
	$sql = "delete from reportmodule where reportid='$oldreportid';";
	$result = execSQL($con, $sql);
	$sql = "delete from reportsubmodule where reportid='$oldreportid';";
	$result = execSQL($con, $sql);
	$sql = "delete from reportaccesstable where reportid='$oldreportid';";
	$result = execSQL($con, $sql);
	$sql="select groupid from reportgrouptable where reportid='$oldreportid';";
	$resultrows = getResultArray($con, $sql);
	if(sizeof($resultrows) > 0){
	$groupid=$resultrows[0][0];
	$sql=" delete from reportgroupdetailtable where groupid='$groupid';";
	$result = execSQL($con, $sql);	
	$sql = "delete from reportgrouptable where reportid='$oldreportid';";
	$result = execSQL($con, $sql);	
	}
	$sql = "delete from reportform where reportid = '$oldreportid'";
	execSQL($con, $sql);
	}
	$sql = "select max(cast(reportid as signed)) from reportform FOR UPDATE ;";
	$resultrows = getResultArray($con, $sql);
	$reportid = $resultrows[0][0];
	$reportid = $reportid + 1;	
	$sql = "insert into reportform values($reportid, '',  \"Daily Mobile User Data Status\",'',\"\",\"\",\"\",\"\", \"Summary Column\", 0,\"BELLS AQUA BELL.png\",1, 1, 0, '','1','2014-05-14 19:22:11','0','Setup','table_47');";
	$result = execSQL($con, $sql);
	$sql = "select max(cast(groupid as signed)) from reportgrouptable FOR UPDATE ; ";
	$resultrows = getResultArray($con, $sql);
	$reportgroupid = $resultrows[0][0];
	$reportgroupid = $reportgroupid + 1;
	$sql = "insert into reportgrouptable values($reportid,\"New Group\", $reportgroupid, 0);";
	$result = execSQL($con, $sql);
	$sql = "insert into reportgroupdetailtable
    values ($reportgroupid,'Setup','table_47', 'table_6_3_table_6_id','1','0','0','','');";
	$result = execSQL($con, $sql);
	$sql = "insert into reportfieldtable values($reportid,\"Setup\", \"table_47\", \"Formname\", \"\", \"\",'0','0','100','','','','','0');";
	$result = execSQL($con, $sql);
	$sql = "insert into reportfieldtable values($reportid,\"Setup\", \"table_47\", \"Total_Records\", \"\", \"\",'0','0','100','1','','','','1');";
	$result = execSQL($con, $sql);
	$sql = "insert into reportfieldtable values($reportid,\"Setup\", \"table_47\", \"Date\", \"\", \"\",'0','0','100','','','','','2');";
	$result = execSQL($con, $sql);
	$sql = "insert into reportfieldtable values($reportid,\"Setup\", \"table_47\", \"Delivered_to_Mobile\", \"Downloaded to Mobile\", \"\",'0','0','100','1','','','','3');";
	$result = execSQL($con, $sql);
	$sql = "insert into reportfieldtable values($reportid,\"Setup\", \"table_47\", \"Pending_to_Delivered\", \"Pending to Download\", \"\",'0','0','100','1','','','','4');";
	$result = execSQL($con, $sql);
	$sql = "insert into reportfieldtable values($reportid,\"Setup\", \"table_47\", \"Mobile_Inserted\", \"\", \"\",'0','0','100','1','','','','5');";
	$result = execSQL($con, $sql);
	$sql = "insert into reportfieldtable values($reportid,\"Setup\", \"table_47\", \"Mobile_Updated\", \"\", \"\",'0','0','100','1','','','','6');";
	$result = execSQL($con, $sql);
	$sql = "insert into reportfilterfieldtable values($reportid,\"Setup\", \"table_47\", \"table_6_3_table_6_id\",'0');";
	$result = execSQL($con, $sql);
	$sql = "insert into reportfilterfieldtable values($reportid,\"Setup\", \"table_47\", \"Date\",'1');";
	$result = execSQL($con, $sql);
	$sql = "insert into reportfilterfieldtable values($reportid,\"Setup\", \"table_47\", \"Formname\",'2');";
	$result = execSQL($con, $sql);
	$sql = "insert into reportfilterfieldvaluetable values($reportid,\"Setup\", \"table_47\", \"Date\",\"Today\", \"2014-05-14#2014-05-14\",\"\",0);";
	$result = execSQL($con, $sql);
	$sql = "delete from reportmodule where reportid=$reportid;";
	$result = execSQL($con, $sql);
	$sql = "delete from reportmodule where name = 'System Reports';";
	execSQL($con, $sql);
	$sql = "insert into reportmodule values( \"System Reports\", $reportid,'1','1');";
	$result = execSQL($con, $sql);
	$sql = "delete from reportsubmodule where reportid=$reportid;";
	$result = execSQL($con, $sql);
	$sql = "insert into reportsubmodule values( \"\", $reportid);";
	$result = execSQL($con, $sql);
	$sql = "delete from reportaccesstable where reportid=$reportid;";
	$result = execSQL($con, $sql);
	$sql = " insert into table_2_frmscreen values('super admin profile','Setup','table_47,');";
	execSQL($con, $sql);
	$sql = "update table_2_frmaction set actions = 'ScreenAccess,#Add,#Edit,#Delete,#View,#Search,#Calendar,#Import,#Export,#Print,#Customize,#' where rolename = 'super admin profile' and modulename = 'Setup' and formname = 'table_47'";
	execSQL($con, $sql);
	$sql = "update table_2_frmfields set fields = '#table_47_id,#1,$#Formname,#1,$#table_6_3_table_6_id,#1,$#Total_Records,#1,$#Date,#1,$#Delivered_to_Mobile,#1,$#Pending_to_Delivered,#1,$#Mobile_Inserted,#1,$#Mobile_Updated,#1,$#table_6_0_createdusername,#1,$#createdon,#1,$#table_6_1_updatedusername,#1,$#updatedon,#1,$#table_6_2_viewedusername,#1,$#viewedon,#1,$' where rolename = 'super admin profile' and modulename = 'Setup' and formname = 'table_47'";
	execSQL($con, $sql);
}

function addMobileHistoryForm($con) {
	$sql = "select max(cast(relationid as signed)) from formrelationtable";
	$resultrows = getResultArray($con, $sql);
	$mrel = $resultrows[0][0] + 1;
	$sql = "select fieldorder from formfieldtable where formname = 'table_6' and name = 'table_6_0_createdusername'";
	$result = getResultArray($con, $sql);
	$ufieldorder = $result[0][0];
	$sql = "select fieldorder from formfieldtable where formname = 'table_6_group' and name = 'createdon'";
	$result = getResultArray($con, $sql);
	$ugfieldorder = $result[0][0];
	$sql = "INSERT INTO formtable VALUES ('Setup','table_47','Userwise Sync History','',0,'',0,0,0,1,0,'arrow1.png','g_root,g_root,0,1,0,0,0,0$true,g_root,g_History Details,0,2,0,0,0,0$true,g_History Details,f_1,0,0,0,0,0,0$true,g_History Details,f_5,1,0,0,0,0,0$true,g_History Details,f_2,2,0,0,0,0,0$true,g_History Details,f_4,3,0,0,0,0,0$true,g_History Details,f_6,4,0,0,0,0,0$true,g_History Details,f_7,5,0,0,0,0,0$true,g_History Details,f_8,6,0,0,0,0,0$true,g_History Details,f_9,7,0,0,0,0,0$true',0,0,0,0,0,0,0,0,0,'','',0,0,0,1,0);";
	$result = execSQL($con, $sql);
	$sql = "INSERT INTO `formfieldtable` VALUES
    ('Setup','table_47','createdon','Created Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,11,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
    ('Setup','table_47','Date','Date','date','40','','','','',0,0,100,200,150,0,0,'Normal','ALL','',1,0,5,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
    ('Setup','table_47','Delivered_to_Mobile','Delivered to Mobile','Int','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,6,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
    ('Setup','table_47','Formname','Formname','Text','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,1,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
    ('Setup','table_47','Mobile_Inserted','Mobile Inserted','Int','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,8,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
    ('Setup','table_47','Mobile_Updated','Mobile Updated','Int','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,9,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
    ('Setup','table_47','Pending_to_Delivered','Pending to Delivery','Int','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,7,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
    ('Setup','table_47','table_47_id','table_47_id','form_entityid','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,0,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
    ('Setup','table_47','table_6_0_createdusername','Created Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,10,0,0,0,0,0,'',1,0,0,0,'ALL',$mrel),
    ('Setup','table_47','table_6_1_updatedusername','Updated Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,12,0,0,0,0,0,'',1,0,0,0,'ALL',$mrel+1),
    ('Setup','table_47','table_6_2_viewedusername','Viewed Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,14,0,0,0,0,0,'',1,0,0,0,'ALL',$mrel+2),
    ('Setup','table_47','table_6_3_table_6_id','User','reference','40','','','','',0,0,100,200,150,0,1,'Normal','ALL','',1,0,2,0,0,0,0,0,'',1,0,0,0,'ALL',$mrel+3),
    ('Setup','table_47','Total_Records','Total Records','Int','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,4,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
    ('Setup','table_47','updatedon','Updated Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,13,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
    ('Setup','table_47','viewedon','Viewed Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,15,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
('Setup','table_6','table_47_3_table_47','User','subtable','40','','','','',1,0,100,200,150,0,1,'Normal','Advanced','current',1,0,$ufieldorder,0,0,0,0,0,'',1,0,0,0,'ALL',$mrel+6),
('Setup','table_6_group','table_47_0_table_47','Assigned to group','subtable','40','','','','',1,1,100,200,150,0,0,'Normal','Advanced','current',1,0,$ugfieldorder,0,0,0,0,0,'',1,0,0,0,'ALL',$mrel+7);";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder=fieldorder+1 where formname='table_6' and type in
('form_history')";
	execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder=fieldorder+1 where formname='table_6_group' and type in
('form_history')";
	execSQL($con, $sql);
	$sql = "INSERT INTO `formactiontable` VALUES ('Setup','table_47','Add','Add',1,'',0),('Setup','table_47','Calendar','Calendar',1,'',5),('Setup','table_47','Delete','Delete',1,'',2),('Setup','table_47','Edit','Edit',1,'',1),('Setup','table_47','Export','Export',1,'',7),('Setup','table_47','Import','Import',1,'',6),('Setup','table_47','Print','Print',1,'',8),('Setup','table_47','Search','Search',1,'',4),('Setup','table_47','View','View',1,'',3);";
	$result = execSQL($con, $sql);

	$sql = "INSERT INTO `formfieldreference` VALUES ('Setup','table_6','table_47_3_table_47','Setup','table_47','',$mrel+6),('Setup','table_6_group','table_47_0_table_47','Setup','table_47','',$mrel+7),('Setup','table_47','table_6_0_createdusername','Setup','table_6','Name',$mrel),('Setup','table_47','table_6_1_updatedusername','Setup','table_6','Name',$mrel+1),('Setup','table_47','table_6_2_viewedusername','Setup','table_6','Name',$mrel+2),('Setup','table_47','table_6_3_table_6_id','Setup','table_6','Name',$mrel+3)";
	$result = execSQL($con, $sql);

	$sql = "INSERT INTO `formrelationtable` VALUES ($mrel,$mrel,0,'table_47','table_6','n-1','',0,''),($mrel+1,$mrel+1,1,'table_47','table_6','n-1','',0,''),($mrel+2,$mrel+2,2,'table_47','table_6','n-1','',0,''),($mrel+3,$mrel+6,3,'table_47','table_6','n-1','',0,''),($mrel+6,$mrel+3,3,'table_6','table_47','1-n','',0,''),($mrel+5,$mrel+7,0,'table_47','table_6_group','n-1','',0,''),($mrel+7,$mrel+5,0,'table_6_group','table_47','1-n','',0,'');";
	$result = execSQL($con, $sql);

	$sql = "INSERT INTO `idgenerator` VALUES ('table_47_frm','0')";
	$result = execSQL($con, $sql);
	$sql = "INSERT INTO `table_2_frmscreen` VALUES ('super admin profile','Setup','table_47,table_47');";
	$result = execSQL($con, $sql);

	$sql = "INSERT INTO `table_2_frmfields` VALUES ('super admin profile','Setup','table_47','#table_47_id,table_47_id#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$#Formname,Formname#1,1$#table_6_3_table_6_id,table_6_3_table_6_id#1,1$#table_6_3_table_6_id,table_6_3_table_6_id#1,1$#Total_Records,Total_Records#1,1$#Date,Date#1,1$#Delivered_to_Mobile,Delivered_to_Mobile#1,1$#Pending_to_Delivered,Pending_to_Delivered#1,1$#Mobile_Inserted,Mobile_Inserted#1,1$#Mobile_Updated,Mobile_Updated#1,1$');";
	$result = execSQL($con, $sql);

	$sql = "INSERT INTO `table_2_frmaction` VALUES ('super admin profile','Setup','table_47','ScreenAccess,ScreenAccess#ScreenAccess,ScreenAccess#Add,Add#Edit,Edit#Delete,Delete#View,View#Search,Search#Calendar,Calendar#Import,Import#Export,Export#Print,Print#');";
	$result = execSQL($con, $sql);

	$sql = "CREATE TABLE `table_47_frm` (
  `table_47_id` varchar(40) NOT NULL,
  `table_6_0_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `createdon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Formname` varchar(40) DEFAULT NULL,
  `table_6_3_table_6_id` varchar(30) DEFAULT NULL,
  `Total_Records` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Delivered_to_Mobile` int(11) DEFAULT NULL,
  `Pending_to_Delivered` int(11) DEFAULT NULL,
  `Mobile_Inserted` int(11) DEFAULT NULL,
  `Mobile_Updated` int(11) DEFAULT NULL,
  `table_6_1_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `updatedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `table_6_2_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `viewedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`table_47_id`),
  KEY `table_47_frmtable_6_3_table_6_id` (`table_6_3_table_6_id`),
   CONSTRAINT `table_47_frmtable_6_3_table_6_id` FOREIGN KEY (`table_6_3_table_6_id`) REFERENCES `table_6_frm` (`table_6_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$result = execSQL($con, $sql);

	$sql = "CREATE TABLE `3table_6_table_47_frm` (
  `table_6_id` varchar(30) DEFAULT NULL,
  `table_47_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$result = execSQL($con, $sql);
    $sql = "SELECT max(cast(templateid as unsigned)) FROM searchtemplate ";
	$result = getResultArray($con, $sql);
	$maxtempid = $result[0][0];
	$sql = "INSERT INTO `searchtemplate` VALUES ('','table_47','sadmin','@','Setup',1,'',$maxtempid+1,1,1,0,NULL),('All records','table_47','sadmin','@','Setup',1,'',$maxtempid+2,1,1,0,NULL),('My records','table_47','sadmin','@','Setup',1,'',$maxtempid+3,1,1,0,NULL),('Todays records','table_47','sadmin','@','Setup',1,'',$maxtempid+4,1,1,0,NULL),('Recently created records','table_47','sadmin','@','Setup',1,'',$maxtempid+5,1,1,0,NULL),('Recently updated records','table_47','sadmin','@','Setup',1,'',$maxtempid+6,1,1,0,NULL),('Recently viewed records','table_47','sadmin','@','Setup',1,'',$maxtempid+7,1,1,0,NULL);";
	$result = execSQL($con, $sql);
}

function migratePredefinedSearchTempaltes($con) {
	$sql = "select templateid,formname,modulename,username FROM searchtemplate where templatename=\"\" and username='sadmin'";
	$resultarr = getResultArray($con, $sql);
	$length = sizeof($resultarr);
	for ($i = 0; $i < $length; $i++) {
		$isNewEntry = true;
		$modulename = $resultarr[$i][2];
		$formname = $resultarr[$i][1];
		$emptytemplateid = $resultarr[$i][0];
		$allrectemplatid = "";
		$sql = "select templateid FROM searchtemplate where templatename = \"All records\" and formname='$formname' and username='sadmin'";
		$result = getResultArray($con, $sql);
		if (sizeof($result) > 0) {
			$isNewEntry = false;
			$allrectemplatid = $result1[0][0];
		}
		if ($isNewEntry) {
			$nextid = getNextIdValue($con, 'searchtemplate', 'templateid');
			$allrectemplatid = $nextid;
			$sql = 'insert into searchtemplate (templateid, templatename, formname, username, searchfields, modulename, access_rights, viewfields, issystem)
                    values(' . $nextid . ', ' . '\'All records\'' . ', ' . '\'' . $formname . '\'' . ', ' . '\'' . 'sadmin' . '\'' . ', ' . '\'' . '@' . '\'' . ', ' . '\'' . $modulename . '\'' . ', ' . '\'' . '1' . '\'' . ', ' . '\'' . '' . '\'' . ', \'1\');';
			$result1 = execSQL($con, $sql);
			if ($formname != 'table_41') {
				//insertSyncQueryDetails($con, "searchtemplate", "", SYNC_ACTION::$STRUC_INSERT, $sql, "", "", $formname . "/" . $nextid);
			}
			if ($result1) {
				updateFormMaxId($con, 'searchtemplate', $nextid);
			}
			if ($result1) {
				$sql = "update user_preference set value='$allrectemplatid' where property='$formname' and value='$emptytemplateid';";
				$result2 = execSQL($con, $sql);
			}
		} else {
			$sql = "update user_preference set value='$allrectemplatid' where property='$formname' and value='$emptytemplateid';";
			$result3 = execSQL($con, $sql);
		}
	}
}

function createShiftAutoPuchAndAutoSyncTable($con) {
	$sql = "select max(cast(relationid as signed)) from formrelationtable";
	$resultrows = getResultArray($con, $sql);
	$mrel = $resultrows[0][0] + 1;
	$sql = "select fieldorder from formfieldtable where formname = 'table_6' and name = 'table_6_0_createdusername'";
	$result = getResultArray($con, $sql);
	$ufieldorder = $result[0][0];
	$sql = "insert into formtable values('Setup', 'table_39', 'Shift Timing', '', '0', '', '0', 0, '0', '1', '0', 'ficon.png', 'g_root,g_root,0,1,0,0,0,0$" . "true,g_root,g_Shift Timing Details,0,2,0,0,0,0$" . "true,g_Shift Timing Details,f_1,0,0,0,0,0,0$" . "true,g_Shift Timing Details,f_2,1,0,0,0,0,0$" . "true,g_Shift Timing Details,f_3,2,0,0,0,0,0$" . "true,g_Shift Timing Details,f_4,3,0,0,0,0,0$" . "true,g_Shift Timing Details,f_5,4,0,0,0,0,0$" . "true,g_root,f_6,1,0,0,0,0,0$" . "true', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '', '','0','0','1');";
	$result = execSQL($con, $sql);
	$sql = "insert into table_2_frmscreen values('super admin profile','Setup','table_39,table_39');";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder = fieldorder + 1 where formname = 'table_6' and fieldorder >= $ufieldorder";
	$result = execSQL($con, $sql);
	$sql = "update formtable set style = 'g_root,g_root,0,1,0,0,0,0$" . "true,g_root,g_Basic Information,0,2,0,0,0,0$" . "true,g_Basic Information,f_1,0,0,0,0,0,0$" . "true,g_Basic Information,f_3,1,0,0,0,0,0$" . "true,g_Basic Information,f_8,2,0,0,0,0,0$" . "true,g_Basic Information,f_5,3,0,0,0,0,0$" . "true,g_Basic Information,f_6,4,0,0,0,0,0$" . "true,g_Basic Information,f_7,5,0,0,0,0,0$" . "true,g_root,g_Additional Information,1,2,0,0,0,0$" . "false,g_Additional Information,f_10,0,0,0,0,0,0$" . "false,g_Additional Information,f_9,1,0,0,0,0,0$" . "false,g_Additional Information,f_11,2,0,0,0,0,0$" . "false,g_Additional Information,f_12,3,0,0,0,0,0$" . "false,g_Additional Information,f_16,4,0,0,0,0,0$" . "false,g_Additional Information,f_23,5,0,0,0,0,0$" . "false,g_Additional Information,f_14,6,0,0,0,0,0$" . "false,g_Additional Information,f_18,7,0,0,0,0,0$" . "false,g_Additional Information,f_17,8,0,0,0,0,0$" . "false,g_Additional Information,f_" . $ufieldorder . ",9,0,0,0,0,0$" . "false' where formname = 'table_6'";
	$result = execSQL($con, $sql);
	$sql = "insert into formfieldtable values
        ('Setup', 'table_39', 'table_39_id', 'table_39_id', 'form_entityid', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0', 'Auto', 'Advanced', '', '1', '1', '0', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_39', 'Shift_Name', 'Shift Name', 'Text', '40', '', '', '', '', '0', '0', 100, 100, 100, '0', '0', 'Normal', 'Advanced', '', '1', '1', '1', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_39', 'Start_Time', 'Start Time', 'Time', '40', '', '', '', '', '0', '0', 100, 100, 100, '0', '0', 'Normal', 'Advanced', '', '1', '1', '2', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_39', 'End_Time', 'End Time', 'Time', '40', '', '', '', '', '0', '0', 100, 100, 100, '0', '0', 'Normal', 'Advanced', '', '1', '1', '3', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_39', 'Time_Interval', 'Time Interval', 'Int', '40', '', '', '', '', '0', '0', 100, 100, 100, '0', '0', 'Normal', 'Advanced', '', '1', '1', '4', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_39', 'Settings_Mode', 'Settings Mode', 'ComboBox', '40', '', '', '', '', '0', '0', 100, 100, 100, '0', '0', 'Normal', 'Advanced', 'Settings Mode,Basic', '1', '1', '5', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_39', 'table_6_0_createdusername', 'Created Username', 'form_history', '40', '', '', '', '', '1', '1',100, 100, 100, '0', '0', 'Auto', 'Advanced', '', '1', '1', '7', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', $mrel),
        ('Setup', 'table_39', 'createdon', 'Created Time', 'form_history', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0','Auto', 'Advanced', '', '1', '1', '8', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_39', 'table_6_1_updatedusername', 'Updated Username', 'form_history', '40', '', '', '', '', '1', '1',100, 100, 100, '0', '0', 'Auto', 'Advanced', '', '1', '1', '9', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', $mrel+1),
        ('Setup', 'table_39', 'updatedon', 'Updated Time', 'form_history', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0','Auto', 'Advanced', '', '1', '1', '10', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_39', 'table_6_2_viewedusername', 'Viewed Username', 'form_history', '40', '', '', '', '', '1', '1',100, 100, 100, '0', '0', 'Auto', 'Advanced', '', '1', '1', '11', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', $mrel+2),
        ('Setup', 'table_39', 'viewedon', 'Viewed Time', 'form_history', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0','Auto', 'Advanced', '', '1', '1', '12', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_39', 'table_6_3_table_6', 'Shift Timing', 'subtable', '40', '', '', '', '', '0', '0', '100', '200', '150', '0','0', 'Normal', 'Advanced', '', '1', '0', '6', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', $mrel+4),
        ('Setup', 'table_6', 'table_39_0_table_39_id', 'Shift Timing', 'reference', '40', '', '', '', '', '0', '0', '100', '200','150', '0', '0', 'Normal', 'Advanced', '', '1', '0', '$ufieldorder', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', $mrel+3);";
	$result = execSQL($con, $sql);

	$sql = "insert into table_2_frmfields values
    ('super admin profile', 'Setup', 'table_39', 'table_39_id,table_39_id', '1,1'),
    ('super admin profile', 'Setup', 'table_39', 'Shift_Name,Shift_Name', '1,1'),
    ('super admin profile', 'Setup', 'table_39', 'table_6_3_table_6,table_6_3_table_6', '1,1'),
    ('super admin profile', 'Setup', 'table_39', 'Start_Time,Start_Time', '1,1'),
    ('super admin profile', 'Setup', 'table_39', 'End_Time,End_Time', '1,1'),
    ('super admin profile', 'Setup', 'table_39', 'Time_Interval,Time_Interval', '1,1'),
    ('super admin profile', 'Setup', 'table_39', 'Settings_Mode,Settings_Mode', '1,1'),
    ('super admin profile', 'Setup', 'table_39', 'table_6_0_createdusername,table_6_0_createdusername', '1,1'),
    ('super admin profile', 'Setup', 'table_39', 'createdon,createdon', '1,1'),
    ('super admin profile', 'Setup', 'table_39', 'table_6_1_updatedusername,table_6_1_updatedusername', '1,1'),
    ('super admin profile', 'Setup', 'table_39', 'updatedon,updatedon', '1,1'),
    ('super admin profile', 'Setup', 'table_39', 'table_6_2_viewedusername,table_6_2_viewedusername', '1,1'),
    ('super admin profile', 'Setup', 'table_39', 'viewedon,viewedon', '1,1'),
    ('super admin profile', 'Setup', 'table_6', 'table_39_0_table_39_id,table_39_0_table_39_id', '1,1');";
	$result = execSQL($con, $sql);
	$sql = "insert into formrelationtable values
        ($mrel, $mrel, 0, 'table_39', 'table_6', 'n-1', '', 0, ''),
        ($mrel+1, $mrel+1, 1, 'table_39', 'table_6', 'n-1', '', 0, ''),
        ($mrel+2, $mrel+2, 2, 'table_39', 'table_6', 'n-1', '', 0, ''),
        ($mrel+3,$mrel+4,0, 'table_6', 'table_39', 'n-1', '', 0, ''),
        ($mrel+4,$mrel+3,3, 'table_39', 'table_6', '1-n', '', 0, '');";
	$result = execSQL($con, $sql);
	$sql = "insert into formfieldreference values
        ('Setup', 'table_39', 'table_6_0_createdusername', 'Setup', 'table_6', 'Name', $mrel),
        ('Setup', 'table_39', 'table_6_1_updatedusername', 'Setup', 'table_6', 'Name', $mrel+1),
        ('Setup', 'table_39', 'table_6_2_viewedusername', 'Setup', 'table_6', 'Name', $mrel+2),
        ('Setup','table_6','table_39_0_table_39_id','Setup','table_39','Start_Time', $mrel+3),
        ('Setup','table_39','table_6_3_table_6','Setup','table_6','', $mrel+4);";
	$result = execSQL($con, $sql);
	$sql = "insert into fetchallfilterreference values('table_6', 'table_39_0_table_39_id', '', '0', '');";
	$result = execSQL($con, $sql);
	$sql = "insert into table_2_frmaction values
        ('super admin profile','Setup','table_39','ScreenAccess,ScreenAccess'),
        ('super admin profile','Setup','table_39','Add,Add'),
        ('super admin profile','Setup','table_39','Edit,Edit'),
        ('super admin profile','Setup','table_39','Delete,Delete'),
        ('super admin profile','Setup','table_39','View,View'),
        ('super admin profile','Setup','table_39','Search,Search'),
        ('super admin profile','Setup','table_39','Calendar,Calendar'),
        ('super admin profile','Setup','table_39','Import,Import'),
        ('super admin profile','Setup','table_39','Export,Export');";
	$result = execSQL($con, $sql);
	$sql = "insert into formactiontable values
        ('Setup','table_39','Add','Add','1','','0'),
        ('Setup','table_39','Edit','Edit','1','','1'),
        ('Setup','table_39','Delete','Delete','1','','2'),
        ('Setup','table_39','View','View','1','','3'),
        ('Setup','table_39','Search','Search','1','','4'),
        ('Setup','table_39','Calendar','Calendar','1','','5'),
        ('Setup','table_39','Import','Import','1','','6'),
        ('Setup','table_39','Export','Export','1','','7');";
	$result = execSQL($con, $sql);
	$sql = "create table table_39_frm (table_39_id varchar(40) primary key,`Shift_Name` varchar(40)  NULL, `Start_Time` Time  NULL,`End_Time` Time  NULL,`Time_Interval` int(30)  NULL,`Settings_Mode` varchar(40)  NULL,  `0table_6_id` varchar(30) NULL,`table_6_0_table_6_id` varchar(30) NOT NULL DEFAULT '', `createdon` TIMESTAMP  NOT NULL DEFAULT '0000-00-00 00:00:00', `table_6_1_table_6_id` varchar(30) NOT NULL DEFAULT '', `updatedon` TIMESTAMP  NOT NULL, `table_6_2_table_6_id` varchar(30) NOT NULL DEFAULT '', `viewedon` TIMESTAMP  NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$result = execSQL($con, $sql);
	$sql = "alter table table_39_frm add CONSTRAINT `table_39_frm0table_6_id` foreign key(0table_6_id) references table_6_frm(table_6_id);";
	$result = execSQL($con, $sql);
	$sql = "alter table table_6_frm add table_39_0_table_39_id varchar(30) after `table_26_0_table_26_id`;";
	$result = execSQL($con, $sql);
	$sql = "alter table table_6_frm add CONSTRAINT `table_6_frmtable_39_0_table_39_id` foreign key(table_39_0_table_39_id) references table_39_frm(table_39_id);";
	$result = execSQL($con, $sql);
	$sql = "create table `0table_39_table_6_frm` (table_39_id varchar(30), table_6_id varchar(30)) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$result = execSQL($con, $sql);
	$sql = "insert into idgenerator values('table_39_frm','0');";
	$result = execSQL($con, $sql);

	$sql = "select max(cast(relationid as signed)) from formrelationtable";
	$resultrows = getResultArray($con, $sql);
	$mrel = $resultrows[0][0] + 1;
	$sql = "insert into formtable values('Setup', 'table_40', 'Auto Sync', '', '0', '', '0', 0, '0', '1', '0', 'ficon.png', 'g_root,g_root,0,1,0,0,0,0$" . "true,g_root,g_Auto Sync,0,2,0,0,0,0$" . "true,g_Auto Sync,f_5,0,0,0,0,0,0$" . "true,g_Auto Sync,f_8,1,0,0,0,0,0$" . "true,g_Auto Sync,f_10,2,0,0,0,0,0$" . "true,g_Auto Sync,f_11,3,0,0,0,0,0$" . "true,g_Auto Sync,f_2,4,0,0,0,0,0$" . "true', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '', '','0','0','1');";
	$result = execSQL($con, $sql);
	$sql = "insert into table_2_frmscreen values('super admin profile','Setup','table_40,table_40');";
	$result = execSQL($con, $sql);
	$sql = "insert into formfieldtable values
        ('Setup', 'table_40', 'table_40_id', 'table_40_id', 'form_entityid', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0', 'Auto', 'Advanced', '', '1', '1', '0', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_40', 'Auto_Sync_id', 'Auto Sync id', 'Int', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0', 'Normal', 'Advanced', '', '1', '1', '1', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_40', 'Start_date', 'Start Date', 'Date_Time', '40', '', '', '', '', '0', '0', 100, 100, 100, '0', '0', 'Normal', 'Advanced', '', '1', '1', '2', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_40', 'Sync_id', 'Sync id', 'Int', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0', 'Normal', 'Advanced', '', '1', '1', '3', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_40', 'Transaction_id', 'Transaction id', 'Int', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0', 'Normal', 'Advanced', '', '1', '1', '4', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_40', 'Formname', 'Formname', 'Text', '40', '', '', '', '', '0', '0', 100, 100, 100, '0', '0', 'Normal', 'Advanced', '', '1', '1', '5', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_40', 'Query', 'Query', 'Text', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0', 'Normal', 'Advanced', '', '1', '1', '6', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_40', 'tableid', 'tableid', 'Int', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0', 'Normal', 'Advanced', '', '1', '1', '7', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_40', 'Action', 'Action', 'Text', '40', '', '', '', '', '0', '0', 100, 100, 100, '0', '0', 'Normal', 'Advanced', '', '1', '1', '8', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_40', 'Created_Time', 'Created Time', 'Date_Time', '40', '', '', '', '', '0', '0', 100, 100, 100, '0', '0', 'Normal', 'Advanced', '', '1', '1', '9', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_40', 'Type', 'Type', 'Text', '40', '', '', '', '', '0', '0', 100, 100, 100, '0', '0', 'Normal', 'Advanced', '', '1', '1', '10', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_40', 'Status', 'Status', 'Text', '40', '', '', '', '', '0', '0', 100, 100, 100, '0', '0', 'Normal', 'Advanced', '', '1', '1', '11', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_40', 'table_6_0_createdusername', 'Created Username', 'form_history', '40', '', '', '', '', '1', '1',100, 100, 100, '0', '0', 'Auto', 'Advanced', '', '1', '1', '12', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', $mrel+1),
        ('Setup', 'table_40', 'createdon', 'Created Time', 'form_history', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0','Auto', 'Advanced', '', '1', '1', '13', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_40', 'table_6_1_updatedusername', 'Updated Username', 'form_history', '40', '', '', '', '', '1', '1',100, 100, 100, '0', '0', 'Auto', 'Advanced', '', '1', '1', '14', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', $mrel+2),
        ('Setup', 'table_40', 'updatedon', 'Updated Time', 'form_history', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0','Auto', 'Advanced', '', '1', '1', '15', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_40', 'table_6_2_viewedusername', 'Viewed Username', 'form_history', '40', '', '', '', '', '1', '1',100, 100, 100, '0', '0', 'Auto', 'Advanced', '', '1', '1', '16', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', $mrel+3),
        ('Setup', 'table_40', 'viewedon', 'Viewed Time', 'form_history', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0','Auto', 'Advanced', '', '1', '1', '17', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL);";
	$result = execSQL($con, $sql);
	$sql = "insert into table_2_frmfields values
        ('super admin profile', 'Setup', 'table_40', 'table_40_id,table_40_id', '1,1'),
        ('super admin profile', 'Setup', 'table_40', 'Auto_Sync_id,Auto_Sync_id', '1,1'),
        ('super admin profile', 'Setup', 'table_40', 'Start_date,Start_date', '1,1'),
        ('super admin profile', 'Setup', 'table_40', 'Sync_id,Sync_id', '1,1'),
        ('super admin profile', 'Setup', 'table_40', 'Transaction_id,Transaction_id', '1,1'),
        ('super admin profile', 'Setup', 'table_40', 'Formname,Formname', '1,1'),
        ('super admin profile', 'Setup', 'table_40', 'Query,Query', '1,1'),
        ('super admin profile', 'Setup', 'table_40', 'tableid,tableid', '1,1'),
        ('super admin profile', 'Setup', 'table_40', 'Action,Action', '1,1'),
        ('super admin profile', 'Setup', 'table_40', 'Created_Time,Created_Time', '1,1'),
        ('super admin profile', 'Setup', 'table_40', 'Type,Type', '1,1'),
        ('super admin profile', 'Setup', 'table_40', 'Status,Status', '1,1'),
        ('super admin profile', 'Setup', 'table_40', 'table_6_0_createdusername,table_6_0_createdusername', '1,1'),
        ('super admin profile', 'Setup', 'table_40', 'createdon,createdon', '1,1'),
        ('super admin profile', 'Setup', 'table_40', 'table_6_1_updatedusername,table_6_1_updatedusername', '1,1'),
        ('super admin profile', 'Setup', 'table_40', 'updatedon,updatedon', '1,1'),
        ('super admin profile', 'Setup', 'table_40', 'table_6_2_viewedusername,table_6_2_viewedusername', '1,1'),
        ('super admin profile', 'Setup', 'table_40', 'viewedon,viewedon', '1,1');";
	$result = execSQL($con, $sql);
	$sql = "insert into formrelationtable values
        ($mrel+1, $mrel+1, 0, 'table_40', 'table_6', 'n-1', '', 0, ''),
        ($mrel+2, $mrel+2, 1, 'table_40', 'table_6', 'n-1', '', 0, ''),
        ($mrel+3, $mrel+3, 2, 'table_40', 'table_6', 'n-1', '', 0, '');";
	$result = execSQL($con, $sql);
	$sql = "insert into formfieldreference values
        ('Setup', 'table_40', 'table_6_0_createdusername', 'Setup', 'table_6', 'Name', $mrel+1),
        ('Setup', 'table_40', 'table_6_1_updatedusername', 'Setup', 'table_6', 'Name', $mrel+2),
        ('Setup', 'table_40', 'table_6_2_viewedusername', 'Setup', 'table_6', 'Name', $mrel+3);";
	$result = execSQL($con, $sql);
	$sql = "insert into table_2_frmaction values
        ('super admin profile','Setup','table_40','ScreenAccess,ScreenAccess'),
        ('super admin profile','Setup','table_40','Add,Add'),
        ('super admin profile','Setup','table_40','Edit,Edit'),
        ('super admin profile','Setup','table_40','Delete,Delete'),
        ('super admin profile','Setup','table_40','View,View'),
        ('super admin profile','Setup','table_40','Search,Search'),
        ('super admin profile','Setup','table_40','Calendar,Calendar'),
        ('super admin profile','Setup','table_40','Import,Import'),
        ('super admin profile','Setup','table_40','Export,Export');";
	$result = execSQL($con, $sql);
	$sql = "insert into formactiontable values
        ('Setup','table_40','Add','Add','1','','0'),
        ('Setup','table_40','Edit','Edit','1','','1'),
        ('Setup','table_40','Delete','Delete','1','','2'),
        ('Setup','table_40','View','View','1','','3'),
        ('Setup','table_40','Search','Search','1','','4'),
        ('Setup','table_40','Calendar','Calendar','1','','5'),
        ('Setup','table_40','Import','Import','1','','6'),
        ('Setup','table_40','Export','Export','1','','7');";
	$result = execSQL($con, $sql);
	$sql = "create table table_40_frm (table_40_id varchar(40) primary key, `Auto_Sync_id` int(10) NULL,`Start_date` TIMESTAMP  NOT NULL DEFAULT '0000-00-00 00:00:00',`Sync_id` int(10) NULL,`Transaction_id` int(10) NULL,`Formname` VARCHAR(30)  NOT NULL,`Query` VARCHAR(1000)  NOT NULL,`tableid` VARCHAR(30),`Action` VARCHAR(30),`Created_Time` TIMESTAMP  NOT NULL,`Type` VARCHAR(30),`Status` VARCHAR(30),`table_6_0_table_6_id` varchar(30) NOT NULL DEFAULT '', `createdon` TIMESTAMP  NOT NULL DEFAULT '0000-00-00 00:00:00', `table_6_1_table_6_id` varchar(30) NOT NULL DEFAULT '', `updatedon` TIMESTAMP  NOT NULL, `table_6_2_table_6_id` varchar(30) NOT NULL DEFAULT '', `viewedon` TIMESTAMP  NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$result = execSQL($con, $sql);
	$sql = "insert into idgenerator values('table_40_frm','0');";
	$result = execSQL($con, $sql);

	$sql = "select max(cast(relationid as signed)) from formrelationtable";
	$resultrows = getResultArray($con, $sql);
	$mrel = $resultrows[0][0] + 1;
	$sql = "select fieldorder from formfieldtable where formname = 'table_6' and name = 'table_6_0_createdusername'";
	$result = getResultArray($con, $sql);
	$ufieldorder = $result[0][0];
	$sql = "select fieldorder from formfieldtable where formname = 'table_6_group' and name = 'createdon'";
	$result = getResultArray($con, $sql);
	$ugfieldorder = $result[0][0];
	$sql = "update formfieldtable set fieldorder = fieldorder + 1 where formname = 'table_6' and fieldorder >= $ufieldorder";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder = fieldorder + 1 where formname = 'table_6_group' and fieldorder >= $ugfieldorder";
	$result = execSQL($con, $sql);
	$sql = "insert into formtable values('Setup', 'table_41', 'Auto Tracking', '', '0', '', '0', 0, '0', '0', '0', 'ficon.png', 'g_root,g_root,0,1,0,0,0,0$" . "true,g_root,g_Auto Punch,0,2,0,0,0,0$" . "true,g_Auto Punch,f_1,0,0,0,0,0,0$" . "true,g_Auto Punch,f_2,1,0,0,0,0,0$" . "true,g_Auto Punch,f_5,2,0,0,0,0,0$" . "true', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '', '','0','0','1');";
	$result = execSQL($con, $sql);
	$sql = "insert into table_2_frmscreen values('super admin profile','Setup','table_41,table_41');";
	$result = execSQL($con, $sql);
	$sql = "insert into formfieldtable values
        ('Setup', 'table_41', 'table_41_id', 'table_41_id', 'form_entityid', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0', 'Auto', 'Advanced', '', '1', '1', '0', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_41', 'In_Time', 'In Time', 'Date_Time', '40', '', '', '', '', '0', '0', 100, 100, 100, '0', '0', 'Normal', 'Advanced', '', '1', '1', '1', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_41', 'In_Location', 'In Location', 'Location', '500', '', '', '', '', '0', '0', '100', '200', '150', '0', '0', 'Normal','Advanced', '', '1', '0', '2', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_41', 'In_Location_latitude', 'In Location Latitude', 'Text', '500', '', '', '', '', '1', '1', '100', '200', '150', '0', '0', 'Normal', 'NO', '', '1', '0', '3', '0','0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_41', 'In_Location_longitude', 'In_Location Longitude', 'Text', '500', '', '', '', '', '1', '1', '100', '200', '150', '0', '0', 'Normal', 'NO', '', '1', '0', '4', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_41', 'table_6_3_table_6_id', 'Assigned to', 'entity_group', '40', '', '', '', '', '0', '0', '100', '200', '150', '0', '1', 'Normal', 'Advanced', 'current', '1', '0', '5', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', $mrel+4),
        ('Setup', 'table_41', 'table_6_3_table_6_group_id', 'Assigned to group', 'reference_group', '40', '', '', '', '', '1', '1', '100', '200', '150', '0', '0','Normal', 'Advanced', 'current', '1', '0', '6', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', $mrel+6),
        ('Setup', 'table_41', 'table_6_0_createdusername', 'Created Username', 'form_history', '40', '', '', '', '', '1', '1',100, 100, 100, '0', '0', 'Auto', 'Advanced', '', '1', '1', '7', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', $mrel+1),
        ('Setup', 'table_41', 'createdon', 'Created Time', 'form_history', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0','Auto', 'Advanced', '', '1', '1', '8', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_41', 'table_6_1_updatedusername', 'Updated Username', 'form_history', '40', '', '', '', '', '1', '1',100, 100, 100, '0', '0', 'Auto', 'Advanced', '', '1', '1', '9', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', $mrel+2),
        ('Setup', 'table_41', 'updatedon', 'Updated Time', 'form_history', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0','Auto', 'Advanced', '', '1', '1', '10', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_41', 'table_6_2_viewedusername', 'Viewed Username', 'form_history', '40', '', '', '', '', '1', '1',100, 100, 100, '0', '0', 'Auto', 'Advanced', '', '1', '1', '11', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', $mrel+3),
        ('Setup', 'table_41', 'viewedon', 'Viewed Time', 'form_history', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0','Auto', 'Advanced', '', '1', '1', '12', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
        ('Setup', 'table_6', 'table_41_3_table_41', 'Assigned to', 'subtable', '40', '', '', '', '', '1', '0', '100', '200', '150', '0', '1', 'Normal', 'Advanced', 'current', '1', '0', '$ufieldorder', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', $mrel+5),
        ('Setup', 'table_6_group', 'table_41_0_table_41', 'Assigned to group', 'subtable', '40', '', '', '', '', '1', '1', '100', '200', '150', '0', '0', 'Normal','Advanced', 'current', '1', '0', '$ugfieldorder', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', $mrel+7);";
	$result = execSQL($con, $sql);
	$sql = "insert into table_2_frmfields values
        ('super admin profile', 'Setup', 'table_41', 'table_41_id,table_41_id', '1,1'),
        ('super admin profile', 'Setup', 'table_41', 'In_Time,In_Time', '1,1'),
        ('super admin profile', 'Setup', 'table_41', 'In_Location,In_Location', '1,1'),
        ('super admin profile', 'Setup', 'table_41', 'In_Location_longitude,In_Location_longitude', '1,1'),
        ('super admin profile', 'Setup', 'table_41', 'In_Location Longitude,In_Location Longitude', '1,1'),
        ('super admin profile', 'Setup', 'table_6', 'table_41_3_table_41,table_41_3_table_41', '1,1'),
        ('super admin profile', 'Setup', 'table_41', 'table_6_3_table_6_id,table_6_3_table_6_id', '1,1'),
        ('super admin profile', 'Setup', 'table_41', 'table_6_0_createdusername,table_6_0_createdusername', '1,1'),
        ('super admin profile', 'Setup', 'table_41', 'createdon,createdon', '1,1'),
        ('super admin profile', 'Setup', 'table_41', 'table_6_1_updatedusername,table_6_1_updatedusername', '1,1'),
        ('super admin profile', 'Setup', 'table_41', 'updatedon,updatedon', '1,1'),
        ('super admin profile', 'Setup', 'table_41', 'table_6_2_viewedusername,table_6_2_viewedusername', '1,1'),
        ('super admin profile', 'Setup', 'table_41', 'viewedon,viewedon', '1,1'),
        ('super admin profile', 'Setup', 'table_6_group', 'table_41_0_table_41,table_41_0_table_41', '1,1'),
        ('super admin profile', 'Setup', 'table_41', 'table_6_3_table_6_group_id,table_6_3_table_6_group_id', '1,1')";
	$result = execSQL($con, $sql);
	$sql = "insert into formrelationtable values
        ($mrel+1, $mrel+1, 0, 'table_41', 'table_6', 'n-1', '', 0, ''),
        ($mrel+2, $mrel+2, 1, 'table_41', 'table_6', 'n-1', '', 0, ''),
        ($mrel+3, $mrel+3, 2, 'table_41', 'table_6', 'n-1', '', 0, ''),
        ($mrel+4,$mrel+5,3, 'table_41', 'table_6', 'n-1', '', 0, ''),
        ($mrel+5,$mrel+4,3, 'table_6', 'table_41', '1-n', '', 0, ''),
        ($mrel+6,$mrel+7,0, 'table_41', 'table_6_group', 'n-1', '', 0, ''),
        ($mrel+7,$mrel+6,0, 'table_6_group', 'table_41', '1-n', '', 0, '')";
	$result = execSQL($con, $sql);
	$sql = "insert into formfieldreference values
        ('Setup', 'table_41', 'table_6_0_createdusername', 'Setup', 'table_6', 'Name', $mrel+1),
        ('Setup', 'table_41', 'table_6_1_updatedusername', 'Setup', 'table_6', 'Name', $mrel+2),
        ('Setup', 'table_41', 'table_6_2_viewedusername', 'Setup', 'table_6', 'Name', $mrel+3),
        ('Setup','table_41','table_6_3_table_6_id','Setup','table_6','Name', $mrel+4),
        ('Setup','table_6','table_41_3_table_41','Setup','table_41','', $mrel+5),
        ('Setup','table_41','table_6_3_table_6_group_id','Setup','table_6_group','groupname', $mrel+6),
        ('Setup','table_6_group','table_41_0_table_41','Setup','table_41','', $mrel+7);";
	$result = execSQL($con, $sql);
	$sql = " insert into fetchallfilterreference values('table_41', 'table_6_3_table_6_id', '', '0', ''),('table_41', 'table_6_3_table_6_group_id', '', '0', '');";
	$result = execSQL($con, $sql);
	$sql = "insert into table_2_frmaction values
        ('super admin profile','Setup','table_41','ScreenAccess,ScreenAccess'),
        ('super admin profile','Setup','table_41','Add,Add'),
        ('super admin profile','Setup','table_41','Edit,Edit'),
        ('super admin profile','Setup','table_41','Delete,Delete'),
        ('super admin profile','Setup','table_41','View,View'),
        ('super admin profile','Setup','table_41','Search,Search'),
        ('super admin profile','Setup','table_41','Calendar,Calendar'),
        ('super admin profile','Setup','table_41','Import,Import'),
        ('super admin profile','Setup','table_41','Export,Export');";
	$result = execSQL($con, $sql);
	$sql = "insert into formactiontable values
        ('Setup','table_41','Add','Add','1','','0'),
        ('Setup','table_41','Edit','Edit','1','','1'),
        ('Setup','table_41','Delete','Delete','1','','2'),
        ('Setup','table_41','View','View','1','','3'),
        ('Setup','table_41','Search','Search','1','','4'),
        ('Setup','table_41','Calendar','Calendar','1','','5'),
        ('Setup','table_41','Import','Import','1','','6'),
        ('Setup','table_41','Export','Export','1','','7');";
	$result = execSQL($con, $sql);
	$sql = "create table table_41_frm (table_41_id varchar(40) primary key,
        `In_Time` TIMESTAMP  NOT NULL DEFAULT '0000-00-00 00:00:00',
        `In_Location` varchar(500),`In_Location_latitude` varchar(500),
        `In_Location_longitude` varchar(500) ,table_6_3_table_6_id varchar(30) NULL,
        table_6_3_table_6_group_id varchar(30),
        `table_6_0_table_6_id` varchar(30) NOT NULL DEFAULT '',
        `createdon` TIMESTAMP  NOT NULL DEFAULT '0000-00-00 00:00:00',
        `table_6_1_table_6_id` varchar(30) NOT NULL DEFAULT '',
        `updatedon` TIMESTAMP  NOT NULL, `table_6_2_table_6_id` varchar(30) NOT NULL DEFAULT '',
        `viewedon` TIMESTAMP  NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$result = execSQL($con, $sql);
	$sql = "alter table table_41_frm add CONSTRAINT `table_41_frmtable_6_3_table_6_id` foreign key(table_6_3_table_6_id) references table_6_frm(table_6_id);";
	$result = execSQL($con, $sql);
	$sql = "alter table table_41_frm add CONSTRAINT `table_41_frmtable_6_3_table_6_group_id` foreign key(table_6_3_table_6_group_id) references table_6_group_frm(table_6_group_id);";
	$result = execSQL($con, $sql);
	$sql = "create table `3table_6_table_41_frm` (table_6_id varchar(30), table_41_id varchar(30)) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$result = execSQL($con, $sql);
	$sql = "alter table table_6_frm add 3table_41_id varchar(30) after `table_39_0_table_39_id`;";
	$result = execSQL($con, $sql);
	$sql = "insert into idgenerator values('table_41_frm','0');";
	$result = execSQL($con, $sql);
}

function updatefeaturetablevalue($con) {
	$sql = "SELECT min(featureindex) FROM `dacamsys_apps`.featuretable;";
	$resultrows = getResultArray($con, $sql);
	$result = $resultrows[0][0];
	if ($result < 3) {
		$sql = "update  dacamsys_apps.featuretable set featureindex=featureindex+2;";
		$result = execSQL($con, $sql);
		$sql = "update  dacamsys_apps.featuretable set parentfeatureindex=1 where featureindex in(9,10,11,12,13,14);";
		$result = execSQL($con, $sql);
		$sql = "update  dacamsys_apps.featuretable set parentfeatureindex=2 where featureindex in(3,15,16,17);";
		$result = execSQL($con, $sql);
	}
}

function alterfeatureinfotable($con) {
	$sql = 'SELECT count(1)FROM information_schema.tables WHERE table_schema = ' . '\'' . 'dacamsys_apps' . '\'' . ' AND table_name = ' . '\'' . 'featurereltable' . '\'' . ';';
	$resultrows = getResultArray($con, $sql);
	$count = $resultrows[0][0];
	if ($count == 1) {
		$sql = 'drop table `dacamsys_apps`.`featurereltable`;';
		$result = execSQL($con, $sql);
		$sql = 'drop table `dacamsys_apps`.`featureavaillist`;';
		$result = execSQL($con, $sql);
		$sql = 'drop table `dacamsys_apps`.`featurevaluetable`;';
		$result = execSQL($con, $sql);
	}
	$sql = 'SELECT count(1) FROM information_schema.columns WHERE table_schema = ' . '\'' . 'dacamsys_apps' . '\'' . ' AND table_name = ' . '\'' . 'featuretable' . '\'' . ' and column_name=' . '\'' . 'featureindex' . '\'' . ';';
	$resultrows = getResultArray($con, $sql);
	$count = $resultrows[0][0];
	if ($count == 0) {
		$sql = 'drop table `dacamsys_apps`.`featuretable`;';
		$result = execSQL($con, $sql);
	}
	$sql = 'SELECT count(1)FROM information_schema.tables WHERE table_schema = ' . '\'' . 'dacamsys_apps' . '\'' . ' AND table_name = ' . '\'' . 'editiontable' . '\';';
	$resultrows = getResultArray($con, $sql);
	$count = $resultrows[0][0];
	if ($count == 0) {
		$sql = 'create table `dacamsys_apps`.`featuretable` (`featureindex` int NOT NULL,`parentfeatureindex` int NOT NULL,`name` varchar(45) NOT NULL,INDEX `feature_index_1`(featureindex))ENGINE=InnoDB DEFAULT CHARSET=latin1;';
		$result = execSQL($con, $sql);
		$sql = 'create table `dacamsys_apps`.`editiontable` (`editionindex` int NOT NULL,`name` varchar(45) NOT NULL,`featureset` int NOT NULL,`isdefault` tinyint(1) NOT NULL DEFAULT ' . '\'' . '0' . '\'' . ',INDEX `edition_index_1`(editionindex),UNIQUE KEY(name))ENGINE=InnoDB DEFAULT CHARSET=latin1;';
		$result = execSQL($con, $sql);
		$sql = 'create table `dacamsys_apps`.`editionvaluetable` (`editionindex` int NOT NULL,`featureindex` int NOT NULL,`value` varchar(45) NOT NULL,`lastupdatedtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, INDEX `feature_index_2`(featureindex),CONSTRAINT `edition_value_fk` FOREIGN KEY (`editionindex`) REFERENCES `editiontable` (`editionindex`))ENGINE=InnoDB DEFAULT CHARSET=latin1;';
		$result = execSQL($con, $sql);
		$sql = 'create table `dacamsys_apps`.`appeditiontable` (`appid` varchar(10) NOT NULL,`editionindex` int NOT NULL,CONSTRAINT `app_edition_fk2` FOREIGN KEY (`editionindex`) REFERENCES `editiontable` (`editionindex`))ENGINE=InnoDB DEFAULT CHARSET=latin1;';
		$result = execSQL($con, $sql);
		$sql = 'create table `dacamsys_apps`.`customfeaturetable` (`appid` varchar(10) NOT NULL,`featureindex` int NOT NULL,`value` varchar(45) NOT NULL,`lastupdatedtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, INDEX `feature_index_3`(featureindex))ENGINE=InnoDB DEFAULT CHARSET=latin1;';
		$result = execSQL($con, $sql);
		$sql = 'CREATE TABLE `dacamsys_apps`.`entityhistory` (
  `organization` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `modulename` varchar(40) DEFAULT NULL,
  `entityname` varchar(30) DEFAULT NULL,
  `action` varchar(30) DEFAULT NULL,
  `updatedtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;';
		$result = execSQL($con, $sql);
		$sql = 'ALTER TABLE `dacamsys_apps`.`uservsapptable` MODIFY COLUMN `lastlogindate` TIMESTAMP  NOT NULL DEFAULT ' . '\'' . '0000-00-00 00:00:00' . '\'' . ';';
		$result = execSQL($con, $sql);
		$sql = 'ALTER TABLE `dacamsys_apps`.`uservsapptable` ADD COLUMN `duration` TIME NOT NULL DEFAULT ' . '\'' . '00:00:00' . '\'' . ';';
		$result = execSQL($con, $sql);
		$sql = 'INSERT INTO  `dacamsys_apps`.`featuretable` VALUES (1,0,' . '\'' . 'No of Profile' . '\'' . '),(2,0,' . '\'' . 'No of Users' . '\'' . '),(3,0,' . '\'' . 'Duration of Days' . '\'' . '),(4,0,' . '\'' . 'Total Record Count' . '\'' . '),(5,0,' . '\'' . 'Total Storage Size(MB)' . '\'' . '),(6,0,' . '\'' . 'Grace Period' . '\'' . ');';
		$result = execSQL($con, $sql);
		$sql = 'insert into `dacamsys_apps`.`editiontable` values(1,' . '\'' . 'Free Edition' . '\'' . ',31,1);';
		$result = execSQL($con, $sql);
		$sql = 'insert into `dacamsys_apps`.`editionvaluetable` values (1,1,5,CURRENT_TIMESTAMP),(1,2,5,CURRENT_TIMESTAMP),(1,3,30,CURRENT_TIMESTAMP),(1,4,20000,CURRENT_TIMESTAMP),(1,5,20,CURRENT_TIMESTAMP),(1,6,15,CURRENT_TIMESTAMP);';
		$result = execSQL($con, $sql);
	}
}

function updateOrginfoTables($con) {
	$sql = 'select table_name from information_schema.tables where table_schema=\'dacamsys_apps\' and table_name like \'%_orginfo\';';
	$resultrows = getResultArray($con, $sql);
	$count = sizeof($resultrows);
	if ($count > 0) {
		for ($i = 0; $i < $count; $i++) {
			$tablename = $resultrows[$i][0];
			$sql = 'select table_name from information_schema.columns where table_schema=\'dacamsys_apps\' and table_name = \'' . $tablename . '\' and column_name = \'industry\';';
			$columnrows = getResultArray($con, $sql);
			$rowcount = sizeof($columnrows);
			if ($rowcount == 0) {
				$sql = 'ALTER TABLE `dacamsys_apps`.`' . $tablename . '` ADD COLUMN `industry` VARCHAR(150)  NOT NULL AFTER `mobileno`,
 ADD COLUMN `noofuser` VARCHAR(30)  NOT NULL AFTER `industry`;';
				$result = execSQL($con, $sql);
				$sql = 'ALTER TABLE `dacamsys_apps`.`' . $tablename . '` DROP COLUMN `address`;';
				$result = execSQL($con, $sql);
			}
		}
	}
}

function migrateLicenseTables($con) {
	$sql = 'SELECT count(1) FROM information_schema.columns WHERE table_schema = ' . '\'' . 'dacamsys_apps' . '\'' . ' AND table_name = ' . '\'' . 'featuretable' . '\'' . ' and column_name=' . '\'' . 'isvalueneeded' . '\';';
	$resultrows = getResultArray($con, $sql);
	$count = $resultrows[0][0];
	if ($count == 0) {
		$sql = 'ALTER TABLE `dacamsys_apps`.`featuretable` ADD COLUMN `isvalueneeded` TINYINT  NOT NULL DEFAULT 0 AFTER `name`';
		$result = execSQL($con, $sql);
		$sql = 'insert into `dacamsys_apps`.`featuretable` values (7,0,\'Sales Forecasting\',0),(8,0,\'Click to Send Email\',0),(9,0,\'Reminder\',0),(10,0,\'Form Customization\',0),(11,0,\'WorkFlow Trigger\',0)';
		$result = execSQL($con, $sql);
	}
}

function migrateCpanelHistory($con) {
	$sql = 'SELECT count(1) FROM information_schema.columns WHERE table_schema = ' . '\'' . DBINFO::$APPDBNAME . '\'' . ' AND table_name = ' . '\'' . 'cpanelhistory' . '\'';
	$resultrows = getResultArray($con, $sql);
	$count = $resultrows[0][0];
	if ($count == 0) {
		$sql = 'CREATE TABLE `' . DBINFO::$APPDBNAME . '`.`cpanelhistory` (
  `table_id` VARCHAR(30)  NOT NULL,
  `username` VARCHAR(50)  NOT NULL,
  `operation` VARCHAR(50)  NOT NULL,
  `appid` VARCHAR(30)  NOT NULL,
  `createdtime` TIMESTAMP  DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`table_id`)
)
ENGINE = InnoDB;';
		$result = execSQL($con, $sql);
	}
}

function migrateGeneralSettingsTables($con) {
	$sql = 'SELECT count(1) FROM information_schema.columns WHERE table_schema = ' . '\'' . 'dacamsys_apps' . '\'' . ' AND table_name = ' . '\'' . 'emailconfig' . '\'' . ' and column_name=' . '\'' . 'isdefault' . '\';';
	$resultrows = getResultArray($con, $sql);
	$count = $resultrows[0][0];
	if ($count == 0) {
		$sql = "ALTER TABLE `dacamsys_apps`.`emailconfig` ADD COLUMN `isdefault` TINYINT  NOT NULL DEFAULT 0 AFTER `name`;";
		$result = execSQL($con, $sql);
		$sql = "ALTER TABLE `dacamsys_apps`.`smsconfig` ADD COLUMN `isdefault` TINYINT  NOT NULL DEFAULT 0 AFTER `name`;";
		$result = execSQL($con, $sql);
		$sql = "ALTER TABLE `dacamsys_apps`.`emailconfig` MODIFY COLUMN `servername` VARCHAR(100)  CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL;";
		$result = execSQL($con, $sql);
		$sql = "ALTER TABLE `dacamsys_apps`.`applicationlist` ADD COLUMN `f11` VARCHAR(200)  NOT NULL AFTER `f10`,
ADD COLUMN `f12` VARCHAR(200)  NOT NULL AFTER `f11`;";
		$result = execSQL($con, $sql);
		$sql = "insert into `dacamsys_apps`.`featuretable` values(14,0,'SMS Count',1);";
		$result = execSQL($con, $sql);
		$sql = "insert into `dacamsys_apps`.`featuretable` values(13,0,'Email Count',1);";
		$result = execSQL($con, $sql);
	}
}

function migrateReportSchedulerInLicenseTables($con) {
	$sql = "select * from `dacamsys_apps`.`featuretable` where name = 'Report Scheduler' ";
	$result = getResultArray($con, $sql);
	if (sizeof($result) == 0) {
		$sql = 'insert into `dacamsys_apps`.`featuretable` values (12,0,\'Report Scheduler\',0)';
		$result = execSQL($con, $sql);
	}
}

function updateStandardEdition($con) {
	$sql = 'update `dacamsys_apps`.`editiontable` set name = \'Standard Edition\' where editionindex = \'1\'';
	$result = execSQL($con, $sql);
	$sql = 'update `dacamsys_apps`.`editionvaluetable` set value = \'10\' where editionindex = \'1\' and featureindex = \'2\'';
	$result = execSQL($con, $sql);
	$sql = 'update `dacamsys_apps`.`editionvaluetable` set value = \'100000\' where editionindex = \'1\' and featureindex = \'4\'';
	$result = execSQL($con, $sql);
	$sql = 'update `dacamsys_apps`.`editionvaluetable` set value = \'50\' where editionindex = \'1\' and featureindex = \'5\'';
	$result = execSQL($con, $sql);
	$sql = 'update `dacamsys_apps`.`editionvaluetable` set value = \'3\' where editionindex = \'1\' and featureindex = \'6\'';
	$result = execSQL($con, $sql);
}

function alterfeatureinfotable1($con) {
	$sql = 'SELECT count(1) FROM information_schema.columns WHERE table_schema = ' . '\'' . 'dacamsys_apps' . '\'' . ' AND table_name = ' . '\'' . 'uservsapptable' . '\'' . ' and column_name=' . '\'' . 'lastlogout' . '\';';
	$resultrows = getResultArray($con, $sql);
	$count = $resultrows[0][0];
	if ($count == 0) {
		$sql = 'ALTER TABLE `dacamsys_apps`.`uservsapptable` ADD COLUMN `lastlogout` TIMESTAMP  NOT NULL DEFAULT ' . '\'' . '0000-00-00 00:00:00' . '\'' . ' after lastlogindate;';
		$result = execSQL($con, $sql);
	}
}

function alterfeatureinfotable2($con) {
	$sql = 'SELECT count(1) FROM information_schema.columns WHERE table_schema = ' . '\'' . 'dacamsys_apps' . '\'' . ' AND table_name = ' . '\'' . 'orginfo' . '\'' . ' and column_name=' . '\'' . 'createdtime' . '\'' . ';';
	$resultrows = getResultArray($con, $sql);
	$count = $resultrows[0][0];
	if ($count == 0) {
		$sql = 'ALTER TABLE `dacamsys_apps`.`orginfo` ADD COLUMN `createdtime` TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `isopenid`;';
		$result = execSQL($con, $sql);
	}
}

function setRelationtoFormHistory($con) {
	$sql = 'select max(relationid) from formrelationtable';
	$resultrows = getResultArray($con, $sql);
	$nextid = $resultrows[0][0] + 1;
	$formnames = array('table_21', 'table_4', 'table_18', 'table_19', 'table_20');
	$fieldnames = array('table_6_0_createdusername', 'table_6_1_updatedusername', 'table_6_2_viewedusername');
	for ($i = 0; $i < sizeof($formnames); $i++) {
		$formname = $formnames[$i];
		for ($j = 0; $j < sizeof($fieldnames); $j++) {
			$fieldname = $fieldnames[$j];
			$sql = 'insert into formrelationtable values(' . '\'' . $nextid . '\'' . ',' . '\'' . '0' . '\'' . ',' . '\'' . $j . '\'' . ',' . '\'' . $formname . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . '1-1' . '\'' . ',' . '\'' . '1' . '\'' . ');';
			$result = execSQL($con, $sql);
			$sql = 'update formfieldtable set relationid =' . '\'' . $nextid . '\'' . ' where formname=' . '\'' . $formname . '\'' . ' and name=' . '\'' . $fieldname . '\'' . ';';
			$result = execSQL($con, $sql);
			$sql = 'update formfieldreference set relationid =' . '\'' . $nextid . '\'' . ' where formname=' . '\'' . $formname . '\'' . ' and fieldname=' . '\'' . $fieldname . '\'' . ';';
			$result = execSQL($con, $sql);
			$nextid = $nextid + 1;
		}
	}
}

function setRelationtoAccountFormHistory($con) {
	$sql = 'select max(relationid) from formrelationtable';
	$resultrows = getResultArray($con, $sql);
	$nextid = $resultrows[0][0] + 1;
	$formnames = array('table_26');
	$fieldnames = array('table_6_0_createdusername', 'table_6_1_updatedusername', 'table_6_2_viewedusername');
	for ($i = 0; $i < sizeof($formnames); $i++) {
		$formname = $formnames[$i];
		for ($j = 0; $j < sizeof($fieldnames); $j++) {
			$fieldname = $fieldnames[$j];
			$sql = 'insert into formrelationtable values(' . '\'' . $nextid . '\'' . ',' . '\'' . '0' . '\'' . ',' . '\'' . $j . '\'' . ',' . '\'' . $formname . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . '1-1' . '\'' . ',' . '\'' . '1' . '\'' . ');';
			$result = execSQL($con, $sql);
			$sql = 'update formfieldtable set relationid =' . '\'' . $nextid . '\'' . ' where formname=' . '\'' . $formname . '\'' . ' and name=' . '\'' . $fieldname . '\'' . ';';
			$result = execSQL($con, $sql);
			$sql = 'update formfieldreference set relationid =' . '\'' . $nextid . '\'' . ' where formname=' . '\'' . $formname . '\'' . ' and fieldname=' . '\'' . $fieldname . '\'' . ';';
			$result = execSQL($con, $sql);
			$nextid = $nextid + 1;
		}
	}
}

function setRelationtoAccountNewFormHistory($con) {
	$sql = 'select max(relationid) from formrelationtable';
	$resultrows = getResultArray($con, $sql);
	$nextid = $resultrows[0][0] + 1;
	$formnames = array('table_26');
	$fieldnames = array('table_6_0_createdusername', 'table_6_1_updatedusername', 'table_6_2_viewedusername', 'table_26_0_table_26_id');
	$sql = 'INSERT INTO `formfieldreference` VALUES (' . '\'' . 'Setup' . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . 'table_26_0_table_26_id' . '\'' . ',' . '\'' . 'Setup' . '\'' . ',' . '\'' . 'table_26' . '\'' . ',' . '\'' . 'Account_Type' . '\'' . ',' . '\'' . $nextid . '\'' . ');';
	$result = execSQL($con, $sql);
	for ($i = 0; $i < sizeof($formnames); $i++) {
		$formname = $formnames[$i];
		for ($j = 0; $j < sizeof($fieldnames); $j++) {
			$fieldname = $fieldnames[$j];
			$sql = 'insert into formrelationtable values(' . '\'' . $nextid . '\'' . ',' . '\'' . '0' . '\'' . ',' . '\'' . $j . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . $formname . '\'' . ',' . '\'' . '1-1' . '\'' . ',' . '\'' . '1' . '\'' . ');';
			$result = execSQL($con, $sql);
			$sql = 'update formfieldtable set relationid =' . '\'' . $nextid . '\'' . ' where formname=' . '\'' . $formname . '\'' . ' and name=' . '\'' . $fieldname . '\'' . ';';
			$result = execSQL($con, $sql);
			$sql = 'update formfieldreference set relationid =' . '\'' . $nextid . '\'' . ' where formname=' . '\'' . $formname . '\'' . ' and fieldname=' . '\'' . $fieldname . '\'' . ';';
			$result = execSQL($con, $sql);
			$nextid = $nextid + 1;
		}
	}
}

function setCurrencyRelationtoFormHistory($con) {
	$sql = 'select max(relationid) from formrelationtable';
	$resultrows = getResultArray($con, $sql);
	$nextid = $resultrows[0][0] + 1;
	$formnames = array('table_25');
	$fieldnames = array('table_6_0_createdusername', 'table_6_1_updatedusername', 'table_6_2_viewedusername');
	for ($i = 0; $i < sizeof($formnames); $i++) {
		$formname = $formnames[$i];
		for ($j = 0; $j < sizeof($fieldnames); $j++) {
			$fieldname = $fieldnames[$j];

			$sql = 'insert into formrelationtable values(' . '\'' . $nextid . '\'' . ',' . '\'' . '0' . '\'' . ',' . '\'' . $j . '\'' . ',' . '\'' . $formname . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . '1-1' . '\'' . ',' . '\'' . '1' . '\'' . ');';
			$result = execSQL($con, $sql);
			$sql = 'update formfieldtable set relationid =' . '\'' . $nextid . '\'' . ' where formname=' . '\'' . $formname . '\'' . ' and name=' . '\'' . $fieldname . '\'' . ';';
			$result = execSQL($con, $sql);
			$sql = 'insert into formfieldreference values(' . '\'' . 'Setup' . '\'' . ',' . '\'' . $formname . '\'' . ',' . '\'' . $fieldname . '\'' . ',' . '\'' . 'Setup' . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . 'Name' . '\'' . ',' . '\'' . $nextid . '\'' . ');';
			$result = execSQL($con, $sql);
			$nextid = $nextid + 1;
		}
	}
}

function updateEmailandSMSRelationIds($con) {
	$sql = 'select max(relationid) from formrelationtable';
	$resultrows = getResultArray($con, $sql);
	$nextid = $resultrows[0][0] + 1;
	$formnames = array('table_27', 'table_28', 'table_29');
	$fieldnames = array('table_6_0_createdusername', 'table_6_1_updatedusername', 'table_6_2_viewedusername');
	for ($i = 0; $i < sizeof($formnames); $i++) {
		$formname = $formnames[$i];
		for ($j = 0; $j < sizeof($fieldnames); $j++) {
			$fieldname = $fieldnames[$j];
			$sql = 'insert into formrelationtable values(' . '\'' . $nextid . '\'' . ',' . '\'' . '0' . '\'' . ',' . '\'' . $j . '\'' . ',' . '\'' . $formname . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . '1-1' . '\'' . ',' . '\'' . '1' . '\'' . ');';
			$result = execSQL($con, $sql);
			$sql = 'update formfieldtable set relationid =' . '\'' . $nextid . '\'' . ' where formname=' . '\'' . $formname . '\'' . ' and name=' . '\'' . $fieldname . '\'' . ';';
			$result = execSQL($con, $sql);
			$sql = 'insert into formfieldreference values(' . '\'' . 'Setup' . '\'' . ',' . '\'' . $formname . '\'' . ',' . '\'' . $fieldname . '\'' . ',' . '\'' . 'Setup' . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . 'Name' . '\'' . ',' . '\'' . $nextid . '\'' . ');';
			$result = execSQL($con, $sql);
			$nextid = $nextid + 1;
		}
	}
}

function setUserFormRelation($con) {
	$sql = 'select max(relationid) from formrelationtable';
	$resultrows = getResultArray($con, $sql);
	$nextid = $resultrows[0][0] + 1;
	$formnames = array('table_6');
	$fieldnames = array('table_6_1_createdusername', 'table_6_2_updatedusername', 'table_6_3_viewedusername');
	for ($i = 0; $i < sizeof($formnames); $i++) {
		$formname = $formnames[$i];
		for ($j = 0; $j < sizeof($fieldnames); $j++) {
			$fieldname = $fieldnames[$j];
			$sql = 'insert into formrelationtable values(' . '\'' . $nextid . '\'' . ',' . '\'' . '0' . '\'' . ',' . '\'' . $j . '\'' . ',' . '\'' . $formname . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . '1-1' . '\'' . ',' . '\'' . '1' . '\'' . ');';
			$result = execSQL($con, $sql);
			$sql = 'update formfieldtable set relationid =' . '\'' . $nextid . '\'' . ' where formname=' . '\'' . $formname . '\'' . ' and name=' . '\'' . $fieldname . '\'' . ';';
			$result = execSQL($con, $sql);
			$sql = 'update formfieldreference set relationid =' . '\'' . $nextid . '\'' . ' where formname=' . '\'' . $formname . '\'' . ' and fieldname=' . '\'' . $fieldname . '\'' . ';';
			$result = execSQL($con, $sql);
			$nextid = $nextid + 1;
		}
	}
}

function changeReportintoInstance($con) {
	$fieldnames = array('table_6_0_createdusername', 'table_6_1_updatedusername', 'table_6_2_viewedusername', 'table_6_3_table_6_id');
	for ($fi = 0; $fi < sizeof($fieldnames); $fi++) {
		$fieldname = $fieldnames[$fi];
		$sql = 'select relationid  from formfieldtable where name=' . '\'' . $fieldname . '\'' . ' and formname=' . '\'' . 'table_6' . '\'' . '';
		$resultrows = getResultArray($con, $sql);
		$relid = $resultrows[0][0];
		$sql = 'insert into formfieldreference values(' . '\'' . 'Setup' . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . $fieldname . '\'' . ',' . '\'' . 'Setup' . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . 'Name' . '\'' . ',' . '\'' . $relid . '\'' . ');';
		$result = execSQL($con, $sql);
		$sql = 'update formrelationtable set nthinstance =' . '\'' . $fi . '\'' . ' where relationid=' . '\'' . $relid . '\'' . ';';
		$result = execSQL($con, $sql);
	}
	$sql = 'ALTER TABLE  `table_6_frm` CHANGE COLUMN `table_6_3_table_6_id` `table_6_2_table_6_id` VARCHAR(30) NULL DEFAULT NULL  , CHANGE COLUMN `table_6_0_table_6_id` `table_6_3_table_6_id` VARCHAR(30)  NULL DEFAULT NULL  , CHANGE COLUMN `table_6_1_table_6_id` `table_6_0_table_6_id` VARCHAR(30) NOT NULL  , CHANGE COLUMN `table_6_2_table_6_id` `table_6_1_table_6_id` VARCHAR(30) NULL DEFAULT NULL  ;';
	$result = execSQL($con, $sql);
}

function removeIndexAllAttachmentForms($con) {
	$sql = 'SELECT formname FROM formtable where modulename=' . '\'' . 'Attachments' . '\'' . ';';
	$resultrows = getResultArray($con, $sql);
	for ($fi = 0; $fi < sizeof($resultrows); $fi++) {
		$formname = $resultrows[$fi][0];
		$formtablename = $formname . '_frm';
		$sql = 'ALTER TABLE ' . $formtablename . ' DROP INDEX `New_Text_2`;';
		$result = execSQL($con, $sql);
		$sql = 'ALTER TABLE ' . $formtablename . ' MODIFY COLUMN `New_Text_1` VARCHAR(300)  CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
 MODIFY COLUMN `New_Text_2` VARCHAR(400)  CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL;';
		$result = execSQL($con, $sql);
	}
}

function addSaasAlterTables($con) {
	$sql = 'SELECT count(1) FROM INFORMATION_SCHEMA.COLUMNS  WHERE  table_schema = ' . '\'' . 'dacamsys_apps' . '\'' . ' AND table_name = ' . '\'' . 'saasinfo' . '\'' . ';';
	$resultrows = getResultArray($con, $sql);
	$count = $resultrows[0][0];
	if ($count == 2) {
		$sql = 'ALTER TABLE `dacamsys_apps`.`saasinfo` ADD COLUMN `companyname` varchar(30)  AFTER `appid`;';
		$result = execSQL($con, $sql);
	}
}

function deleteConfirmPasswordinUserTable($con) {
	$sql = 'delete from formfieldtable where formname=' . '\'' . 'table_6' . '\'' . ' and name=' . '\'' . 'Confirm_Password' . '\'';
	$result = execSQL($con, $sql);
	reorderFieldOredr($con, 'table_6');
}

function reorderFieldOredr($con, $formname) {
	$sql = 'SELECT name FROM formfieldtable where formname=' . '\'' . 'table_6' . '\'' . ' order by fieldorder';
	$resultarr = getResultArray($con, $sql);
	for ($fi = 0; $fi < sizeof($resultarr); $fi++) {
		$fieldname = $resultarr[$fi][0];
		$sql = ' update formfieldtable set fieldorder = ' . '\'' . $fi . '\'' . ' where formname=' . '\'' . 'table_6' . '\'' . ' and name=' . '\'' . $fieldname . '\'';
		$result = execSQL($con, $sql);
	}
}

function insertEmailSendmoduleInModuleTable($con) {
	$sql = 'SELECT max(moduleorder) FROM moduletable;';
	$resultrows = getResultArray($con, $sql);
	$count = $resultrows[0][0];
	$sql = 'INSERT INTO `moduletable` VALUES (' . '\'' . 'EmailSend' . '\'' . ',' . '\'' . 'micon.png' . '\'' . ',' . ($count + 1) . ');';
	$result = execSQL($con, $sql);
}

function addsaascompanyinfo($con) {
	$sql = 'SELECT count(1)FROM information_schema.tables WHERE table_schema = ' . '\'' . 'dacamsys_apps' . '\'' . ' AND table_name = ' . '\'' . 'saascompanyinfo' . '\'' . ';';
	$resultrows = getResultArray($con, $sql);
	$count = $resultrows[0][0];
	if ($count == 0) {
		$sql = 'CREATE TABLE `dacamsys_apps`.`saascompanyinfo` (
                  `companyid` varchar(30) DEFAULT NULL,
                  `companyname` varchar(30) DEFAULT NULL,
                  `username` varchar(30) DEFAULT NULL,
                  `emailid` varchar(30) DEFAULT NULL,
                  `mobilenumber` varchar(30) DEFAULT NULL,
                  `address` varchar(200) DEFAULT NULL,
                  `state` varchar(30) DEFAULT NULL,
                  `city` varchar(30) DEFAULT NULL,
                  `status` varchar(30) DEFAULT NULL,
                   PRIMARY KEY (`companyid`) 
                   ) ENGINE=InnoDB DEFAULT CHARSET=latin1; ';
		$result = execSQL($con, $sql);
	}
	$sql = 'SELECT count(1) FROM INFORMATION_SCHEMA.COLUMNS  WHERE  table_schema = ' . '\'' . 'dacamsys_apps' . '\'' . ' AND table_name = ' . '\'' . 'saasmetrictable' . '\'' . ';';
	$resultrows = getResultArray($con, $sql);
	$count = $resultrows[0][0];
	if ($count == 11) {
		$sql = 'ALTER TABLE `dacamsys_apps`.`saasmetrictable` ADD COLUMN `totrecordcount` varchar(30)  AFTER `duration`;';
		$result = execSQL($con, $sql);
		$sql = 'ALTER TABLE `dacamsys_apps`.`saasmetrictable` ADD COLUMN `totstoragesize` varchar(30)  AFTER `totrecordcount`;';
		$result = execSQL($con, $sql);
	}
}

function addAttachementFieldinEmailTable($con) {
	$sql = 'SELECT formname FROM formtable where modulename=' . '\'' . 'Emailsend' . '\'' . '';
	$dbrows = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($dbrows); $i++) {
		$formname = $dbrows[$i][0];
		if ($formname != '') {
			$formtablename = $formname . '_frm';
			$sql = ' update formtable set style=' . '\'' . 'g_root,g_root,0,1,0,0,0,0,g_root,f_2,0,0,0,0,0,0,g_root,f_3,1,0,0,0,0,0,g_root,f_4,2,0,0,0,0,0,g_root,f_5,3,0,0,0,0,0,g_root,f_6,4,0,0,0,0,0,g_root,f_7,5,0,0,0,0,0' . '\'' . ' where formname=' . '\'' . $formname . '\'';
			$result = execSQL($con, $sql);
			$sql = 'insert into formfieldtable values (' . '\'' . 'EmailSend' . '\'' . ', ' . '\'' . $formname . '\'' . ', ' . '\'' . 'Attachment' . '\'' . ', ' . '\'' . 'Attachment' . '\'' . ', ' . '\'' . 'Document' . '\'' . ', ' . '\'' . '40' . '\'' . ', ' . '\'' . '' . '\'' . ', ' . '\'' . '' . '\'' . ', ' . '\'' . '' . '\'' . ', ' . '\'' . '' . '\'' . ', 0, 0, 100, 100, 100, 0, 0, ' . '\'' . 'Normal' . '\'' . ', ' . '\'' . 'Advanced' . '\'' . ', ' . '\'' . '' . '\'' . ', 1, 1, 6, 0, 0, 0, 30, 0, 0, ' . '\'' . '' . '\'' . ', 1, 0, NULL)';
			$result = execSQL($con, $sql);
			$sql = 'update formfieldtable set fieldorder= fieldorder+1 where fieldorder > 6 and formname =' . '\'' . $formname . '\'';
			$result = execSQL($con, $sql);
			$sql = 'ALTER TABLE `' . $formtablename . '` ADD COLUMN `Attachment` Varchar(50)  AFTER `Subject`;';
			$result = execSQL($con, $sql);
		}
	}
}

function addSaasRegisterInfoTables($con) {
	$sql = 'SELECT count(1)FROM information_schema.tables WHERE table_schema = ' . '\'' . 'dacamsys_apps' . '\'' . ' AND table_name = ' . '\'' . 'uservsapptable' . '\'' . ';';
	$resultrows = getResultArray($con, $sql);
	$count = $resultrows[0][0];
	if ($count == 0) {
		$sql = 'CREATE TABLE `dacamsys_apps`.`uservsapptable` (
    `saasuserid` VARCHAR (50)  NOT NULL,
    `crmuserid` VARCHAR (50)  NOT NULL,
    `appid` INT  NOT NULL,
    `lastlogindate` DATE  NOT NULL,
    UNIQUE KEY `Index_2` (`saasuserid`)
    )ENGINE = InnoDB;';
		$result = execSQL($con, $sql);
	}
	$sql = 'SELECT count(1)FROM information_schema.tables WHERE table_schema = ' . '\'' . 'dacamsys_apps' . '\'' . ' AND table_name = ' . '\'' . 'orginfo' . '\'' . ';';
	$resultrow = getResultArray($con, $sql);
	$macount = $resultrow[0][0];
	if ($macount == 0) {
		$sql = 'CREATE TABLE `dacamsys_apps`.`orginfo` (
    `appid` INT  NOT NULL,
    `userid` VARCHAR(50)  NOT NULL,
    `companyname` VARCHAR(80)  NOT NULL,
    `emailid` VARCHAR(30)  NOT NULL,
    `mobileno` VARCHAR(15)  NOT NULL,
    `phoneno` VARCHAR(15)  NOT NULL,
    `address` VARCHAR(500)  NOT NULL,
    `state` VARCHAR(50)  NOT NULL,
    `city` VARCHAR(50)  NOT NULL,
    `applicationstatus` INT  NOT NULL,
    `isopenid` BOOLEAN  NOT NULL
    )ENGINE = InnoDB;';
		$result = execSQL($con, $sql);
	}
	$sql = 'SELECT count(1)FROM information_schema.tables WHERE table_schema = ' . '\'' . 'dacamsys_apps' . '\'' . ' AND table_name = ' . '\'' . 'freeappidtable' . '\'' . ';';
	$resultrows = getResultArray($con, $sql);
	$count = $resultrows[0][0];
	if ($count == 0) {
		$sql = 'CREATE TABLE `dacamsys_apps`.`freeappidtable` (
    `appid` INT  NOT NULL,
    `schemastatus` VARCHAR(15)  NOT NULL
    )ENGINE = InnoDB';
		$result = execSQL($con, $sql);
	}
}

function addRollingUpdateTableinCurrencyField($con) {
	$appid = getAppId();
	$sql = 'SELECT formname FROM formtable';
	$resultrows = getResultArray($con, $sql);
	$size = sizeof($resultrows);
	for ($i = 0; $i < $size; $i++) {
		$formname = $resultrows[$i][0];
		$sql = 'select name from formfieldtable where formname=' . '\'' . $formname . '\'' . ' and type =' . '\'' . 'currency' . '\'';
		$resultfieldarr = getResultArray($con, $sql);
		$curfisize = sizeof($resultfieldarr);
		for ($fi = 0; $fi < $curfisize; $fi++) {
			$fieldname = $resultfieldarr[$fi][0];
			$tablename = $formname . '_' . $fieldname . '_rollingupdate_frm';
			$sql = 'SELECT count(1)FROM information_schema.tables WHERE table_schema = ' . '\'' . 'dacamsys_apps' . $appid . '\'' . ' AND table_name = ' . '\'' . $tablename . '\'' . ';';
			$result = getResultArray($con, $sql);
			$count = $result[0][0];
			if ($count == 0) {
				createRollingUpdateExternalForm($con, $formname, $fieldname);
			}
		}
	}
}

function addAdditionalFieldsInEmailsend($con) {
	$appid = getAppId();
	$sql = 'SELECT formname FROM formtable where modulename = ' . '\'' . 'EmailSend' . '\'';
	$resultrows = getResultArray($con, $sql);
	$size = sizeof($resultrows);
	for ($i = 0; $i < $size; $i++) {
		$formname = $resultrows[$i][0];
		$formtablename = $formname . '_frm';
		$sql = 'alter table ' . $formtablename . ' ADD COLUMN `SentCc` varchar(500) DEFAULT NULL AFTER `SentTo`,
            ADD COLUMN `SentBcc` varchar(500) DEFAULT NULL AFTER `SentCc`,
            ADD COLUMN `Body` varchar(4000) DEFAULT NULL AFTER `SentBcc`, MODIFY COLUMN   `SentTo` varchar(500) DEFAULT NULL';
		$result = execSQL($con, $sql);
		$sql = 'update formfieldtable set fieldorder = fieldorder+3 where formname = ' . '\'' . $formname . '\'' . ' and fieldorder >= 3';
		$result = execSQL($con, $sql);
		$sql = 'insert into formfieldtable values
        (' . '\'' . 'EmailSend' . '\'' . ', ' . '\'' . $formname . '\'' . ', ' . '\'' . 'SentCc' . '\'' . ', ' . '\'' . 'Sent Cc' . '\'' . ', ' . '\'' . 'Text' . '\'' . ', ' . '\'' . '400' . '\'' . ', ' . '\'' . '' . '\'' . ', ' . '\'' . '' . '\'' . ', ' . '\'' . '' . '\'' . ', ' . '\'' . '' . '\'' . ', 0, 0, 100, 100, 100, 0, 0, ' . '\'' . 'Normal' . '\'' . ', ' . '\'' . 'Advanced' . '\'' . ', ' . '\'' . '' . '\'' . ', 1, 1, 3, 0, 0, 0, 30, 0, 0, ' . '\'' . '' . '\'' . ', 1, 0,0, NULL),
        (' . '\'' . 'EmailSend' . '\'' . ', ' . '\'' . $formname . '\'' . ', ' . '\'' . 'SentBcc' . '\'' . ', ' . '\'' . 'Sent Bcc' . '\'' . ', ' . '\'' . 'Text' . '\'' . ', ' . '\'' . '400' . '\'' . ', ' . '\'' . '' . '\'' . ', ' . '\'' . '' . '\'' . ', ' . '\'' . '' . '\'' . ', ' . '\'' . '' . '\'' . ', 0, 0, 100, 100, 100, 0, 0, ' . '\'' . 'Normal' . '\'' . ', ' . '\'' . 'Advanced' . '\'' . ', ' . '\'' . '' . '\'' . ', 1, 1, 4, 0, 0, 0, 30, 0, 0, ' . '\'' . '' . '\'' . ', 1, 0,0, NULL),
        (' . '\'' . 'EmailSend' . '\'' . ', ' . '\'' . $formname . '\'' . ', ' . '\'' . 'Body' . '\'' . ', ' . '\'' . 'Body' . '\'' . ', ' . '\'' . 'Html Text' . '\'' . ', ' . '\'' . '4000' . '\'' . ', ' . '\'' . '' . '\'' . ', ' . '\'' . '' . '\'' . ', ' . '\'' . '' . '\'' . ', ' . '\'' . '' . '\'' . ', 0, 0, 100, 100, 100, 0, 0, ' . '\'' . 'Normal' . '\'' . ', ' . '\'' . 'Advanced' . '\'' . ', ' . '\'' . '' . '\'' . ', 1, 1, 5, 0, 0, 0, 30, 0, 0, ' . '\'' . '' . '\'' . ', 1, 0,0, NULL)';
		$result = execSQL($con, $sql);
		$sql = 'INSERT INTO `table_2_frmfields` VALUES (' . '\'' . 'super admin profile' . '\'' . ', ' . '\'' . 'EmailSend' . '\'' . ', ' . '\'' . $formname . '\'' . ', ' . '\'' . 'SentCc' . '\'' . ', ' . '\'' . '1' . '\'' . '), (' . '\'' . 'super admin profile' . '\'' . ', ' . '\'' . 'EmailSend' . '\'' . ', ' . '\'' . $formname . '\'' . ', ' . '\'' . 'SentBcc' . '\'' . ', ' . '\'' . '1' . '\'' . '), (' . '\'' . 'super admin profile' . '\'' . ', ' . '\'' . 'EmailSend' . '\'' . ', ' . '\'' . $formname . '\'' . ', ' . '\'' . 'Body' . '\'' . ', ' . '\'' . '1' . '\'' . ');';
		$result = execSQL($con, $sql);
		$sql = 'update formfieldtable set type = ' . '\'' . 'Document_multi' . '\'' . ' where name = ' . '\'' . 'Attachment' . '\'' . ' and formname = ' . '\'' . $formname . '\'';
		$result = execSQL($con, $sql);
		$sql = 'update formtable set style = ' . '\'' . 'g_root,g_root,0,1,0,0,0,0,g_root,g_Send Email Details,0,2,0,0,0,0,g_Send Email Details,f_7,0,0,0,0,0,0,g_Send Email Details,f_2,1,0,0,0,0,0,g_Send Email Details,f_3,2,0,0,0,0,0,g_Send Email Details,f_4,3,0,0,0,0,0,g_Send Email Details,f_9,4,0,0,0,0,0,g_Send Email Details,f_8,5,0,0,0,0,0,g_Send Email Details,f_5,6,0,0,0,0,0,g_Send Email Details,f_10,7,0,0,0,0,0,g_Send Email Details,f_6,8,0,0,0,0,0' . '\'' . ' where formname = ' . '\'' . $formname . '\'';
		$result = execSQL($con, $sql);
	}
}

function updateFieldsInEmailsend($con) {
	$sql = 'SELECT formname FROM formtable where modulename = ' . '\'' . 'EmailSend' . '\'';
	$resultrows = getResultArray($con, $sql);
	$size = sizeof($resultrows);
	if ($size > 0) {
		$sql = 'update formfieldtable set label=' . '\'' . 'From' . '\'' . ' where modulename=' . '\'' . 'EmailSend' . '\'' . ' and name=' . '\'' . 'SentBy' . '\'';
		$result = execSQL($con, $sql);
		$sql = 'update formfieldtable set label=' . '\'' . 'To' . '\'' . ' where modulename=' . '\'' . 'EmailSend' . '\'' . ' and name=' . '\'' . 'SentTo' . '\'';
		$result = execSQL($con, $sql);
		$sql = 'update formfieldtable set label=' . '\'' . 'CC' . '\'' . ' where modulename=' . '\'' . 'EmailSend' . '\'' . ' and name=' . '\'' . 'SentCc' . '\'';
		$result = execSQL($con, $sql);
		$sql = 'update formfieldtable set label=' . '\'' . 'BCC' . '\'' . ' where modulename=' . '\'' . 'EmailSend' . '\'' . ' and name=' . '\'' . 'SentBcc' . '\'';
		$result = execSQL($con, $sql);
		$sql = 'update formfieldtable set label=' . '\'' . 'Status' . '\'' . ' where modulename=' . '\'' . 'EmailSend' . '\'' . ' and name=' . '\'' . 'Send_or_Received' . '\'';
		$result = execSQL($con, $sql);
	}
}

function updateRemainderForm($con) {
	$appid = getAppId();
	$sql = 'SELECT formname FROM formtable where modulename = ' . '\'' . 'Remainder' . '\'';
	$resultrows = getResultArray($con, $sql);
	$size = sizeof($resultrows);
	for ($i = 0; $i < $size; $i++) {
		$formname = $resultrows[$i][0];
		$sql = 'update formfieldtable set isviewhide = ' . '\'' . '1' . '\'' . ' where formname = ' . '\'' . $formname . '\'' . ' and name = ' . '\'' . 'Message' . '\'' . '';
		$result = execSQL($con, $sql);
	}
}

function updateEmailFormEntityType($con) {
	$appid = getAppId();
	$sql = 'SELECT formname FROM formtable where modulename in (' . '\'' . 'Remainder' . '\'' . ',' . '\'' . 'EmailSend' . '\'' . ',' . '\'' . 'History' . '\'' . ')';
	$resultrows = getResultArray($con, $sql);
	$size = sizeof($resultrows);
	for ($i = 0; $i < $size; $i++) {
		$formname = $resultrows[$i][0];
		$sql = 'update formfieldtable set type  = ' . '\'' . 'form_entityid' . '\'' . ' where formname = ' . '\'' . $formname . '\'' . ' and name = ' . '\'' . $formname . '_id' . '\'';
		$result = execSQL($con, $sql);
	}
	$sql = 'select formname,labelname from formtable where modulename = ' . '\'' . 'EmailSend' . '\'';
	$resultrows = getResultArray($con, $sql);
	$size = sizeof($resultrows);
	for ($i = 0; $i < $size; $i++) {
		$formname = $resultrows[$i][0];
		$labelname = $resultrows[$i][1];
		$labelname = substr($labelname, 0, strlen($labelname) - 9) . 'Mailing History';
		$sql = 'update formtable set labelname  = ' . '\'' . $labelname . '\'' . ',style = \'' . 'g_root,g_root,0,1,0,0,0,0$true,g_root,g_Send Email Details,0,2,0,0,0,0$true,g_Send Email Details,f_2,0,0,0,0,0,0$true,g_Send Email Details,f_3,1,0,0,0,0,0$true,g_Send Email Details,f_4,2,0,0,0,0,0$true,g_Send Email Details,f_7,3,0,0,0,0,0$true,g_Send Email Details,f_9,4,0,0,0,0,0$true,g_Send Email Details,f_8,5,0,0,0,0,0$true,g_root,g_History Details,1,2,0,0,0,0$true,g_History Details,f_1,0,0,0,0,0,0$true,g_History Details,f_6,1,0,0,0,0,0$true,g_root,g_Body content,2,1,0,0,0,0$true,g_Body content,f_5,0,0,0,0,0,0$true\' where formname = ' . '\'' . $formname . '\'';
		$result = execSQL($con, $sql);
		$sql = 'update formfieldtable set islabeldisplay = ' . '\'' . '0' . '\'' . ' where name = ' . '\'' . 'Body' . '\'' . ' and formname = ' . '\'' . $formname . '\'';
		$result = execSQL($con, $sql);
	}
}

function updateSendEmailBodyType($con) {
	$sql = 'select formname,labelname from formtable where modulename = ' . '\'' . 'EmailSend' . '\'';
	$resultrows = getResultArray($con, $sql);
	$size = sizeof($resultrows);
	for ($i = 0; $i < $size; $i++) {
		$formname = $resultrows[$i][0];
		$sql = 'ALTER TABLE ' . $formname . '_frm MODIFY COLUMN Body LONGTEXT';
		$result = execSQL($con, $sql);
	}
}

function updateSendEmailBodyHide($con) {
	$sql = 'select formname,labelname from formtable where modulename = ' . '\'' . 'EmailSend' . '\'';
	$resultrows = getResultArray($con, $sql);
	$size = sizeof($resultrows);
	for ($i = 0; $i < $size; $i++) {
		$formname = $resultrows[$i][0];
		$sql = 'update formfieldtable set isviewhide = ' . '\'' . '1' . '\'' . ' where formname = ' . '\'' . $formname . '\'' . ' and name = ' . '\'' . 'Body' . '\'';
		$result = execSQL($con, $sql);
	}
}

function fieldCustomizeNoteForm($con) {
	$sql = 'SELECT formname,refformname FROM formfieldreference where refmodulename=' . '\'' . 'Notes' . '\'' . ';';
	$resultrows = getResultArray($con, $sql);
	$size = sizeof($resultrows);
	for ($i = 0; $i < $size; $i++) {
		$formname = $resultrows[$i][0];
		$refformname = $resultrows[$i][1];
		$sql = 'select * from subtable_searchtemplate where formname =' . '\'' . $formname . '\'' . ' and sformname =' . '\'' . $refformname . '\'';
		$resultarr = getResultArray($con, $sql);
		if (sizeof($resultarr) == 0) {
			$nextid = getNextIdValue($con, 'subtable_searchtemplate', 'templateid');
			$viewfields = 'Notes,Modifield User,Modifield Time';
			$viewsize = '150,100,200';
			$username = '';
			$sql = 'insert into subtable_searchtemplate values(' . '\'' . $nextid . '\'' . ',' . '\'' . 'temp' . '\'' . ',' . '\'' . $formname . '\'' . ',' . '\'' . $refformname . '\'' . ',' . '\'' . $viewfields . '\'' . ',' . '\'' . $viewsize . '\'' . ',' . '\'' . $username . '\'' . ');';

			$result = execSQL($con, $sql);
		}
	}
}

function setFormOrderForUserForm($con) {
	$formlabels = 'Organization Master,User,Profile,Role,Location,Department,Designation,Trigger,Builder,Request Builder,API Key,User group,Profile group,Data Sharing,List Editor,Live Records,Email Scanner,Print Template,Email Template,Sms Template,Color Formating,Currency Conversion,SMS Count,Email Log,SMS Log,Account Type,DB Backup,Settings,Genenal Settings';
	$formnamearr = explode(',', $formlabels);
	for ($i = 0; $i < sizeof($formnamearr); $i++) {
		$formlbl = $formnamearr[$i];
		$sql = 'update formtable set formorder=' . $i . ' where modulename=' . '\'' . 'Setup' . '\'' . ' and labelname=' . '\'' . $formlbl . '\'';
		$result = execSQL($con, $sql);
	}
}

function updateImageFieldSize($con) {
	$sql = 'select formname,name from formfieldtable where type = ' . '\'' . 'Image' . '\'' . ' ';
	$resultrows = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($resultrows); $i++) {
		$formname = $resultrows[$i][0];
		$fieldname = $resultrows[$i][1];
		if ($formname != '' && $fieldname != '') {
			$sql = 'alter table ' . $formname . '_frm MODIFY COLUMN `' . $fieldname . '` varchar(50);';
			$result = execSQL($con, $sql);
		}
	}
}

function editDefaultTemplateOperation($con) {
	$sql = 'select modulename,formname from formtable where formtype=' . '\'' . '' . '\'';
	$resultrows = getResultArray($con, $sql);
	$size = sizeof($resultrows);
	for ($i = 0; $i < $size; $i++) {
		$modulename = $resultrows[$i][0];
		$formname = $resultrows[$i][1];
		$nextid = getNextIdValue($con, 'searchtemplate', 'templateid');
		$sql = 'insert into searchtemplate (templateid,templatename,formname,username,searchfields,modulename,access_rights,viewfields, issystem)
        values (' . '\'' . $nextid . '\'' . ',' . '\'' . '' . '\'' . ',' . '\'' . $formname . '\'' . ',' . '\'' . 'sadmin' . '\'' . ',' . '\'' . '@' . '\'' . ',' . '\'' . $modulename . '\'' . ',' . '\'' . '1' . '\'' . ', ' . '\'' . '' . '\'' . ', ' . '\'' . 'true' . '\'' . ');';
		$result = execSQL($con, $sql);
		if ($result) {
			updateFormMaxId($con, 'searchtemplate', $nextid);
		}
	}
}

function updateCheckBoxValues($con) {
	$sql = 'select formname,name from formfieldtable where type = ' . '\'' . 'CheckBox' . '\'' . ' ';
	$resultrows = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($resultrows); $i++) {
		$formname = $resultrows[$i][0];
		$fieldname = $resultrows[$i][1];
		if ($formname != '' && $fieldname != '') {
			$sql = 'update ' . $formname . '_frm set ' . $fieldname . ' = ' . '\'' . 'Yes' . '\'' . ' where ' . $fieldname . ' = ' . '\'' . 'true' . '\'' . '';
			$result = execSQL($con, $sql);
			$sql = 'update ' . $formname . '_frm set ' . $fieldname . ' = ' . '\'' . 'No' . '\'' . ' where ' . $fieldname . ' = ' . '\'' . 'false' . '\'';
			$result = execSQL($con, $sql);
		}
	}
}

function updateResetPasswordInProfile($con) {
	$sql = 'select Profile_Name from table_2_frm';
	$resultrows = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($resultrows); $i++) {
		$rolename = $resultrows[$i][0];
		$sql = 'insert into table_2_frmaction values (\'' . $rolename . '\',\'Setup\',\'table_6\',\'Reset Password\')';
		$result = execSQL($con, $sql);
	}
}

function updateEmailLogInProfile($con) {
	$sql = 'select Profile_Name from table_2_frm';
	$resultrows = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($resultrows); $i++) {
		$rolename = $resultrows[$i][0];
		$sql = "select * from table_2_frmaction where rolename = '$rolename' and formname = 'table_27' and action = 'Search'";
		$dbrows = getResultArray($con, $sql);
		if (sizeof($dbrows) == 0) {
			$sql = 'insert into table_2_frmaction values (\'' . $rolename . '\',\'Setup\',\'table_27\',\'Search\')';
			$result = execSQL($con, $sql);
		}
	}
}

function alterSaasConfigTables($con) {
}

function alterServerConfigTables($con) {
	$sql = 'select table_name from information_schema.columns where table_schema=\'' . DBINFO::$APPDBNAME . '\' and table_name = \'saasconfig\' and column_name = \'termspage\';';
	$columnrows1 = getResultArray($con, $sql);
	$rowcount1 = sizeof($columnrows1);
	if ($rowcount1 == 0) {
		$sql = "ALTER TABLE " . DBINFO::$APPDBNAME . ".`saasconfig` ADD COLUMN `termspage` VARCHAR(150)  AFTER `filename`,
 ADD COLUMN `privacypage` VARCHAR(100)  AFTER `termspage`,
 ADD COLUMN `userguidepage` VARCHAR(100)  AFTER `privacypage`,
 ADD COLUMN `loginpage` VARCHAR(100)  AFTER `userguidepage`;";
		$result1 = execSQL($con, $sql);
	}
	$sql = 'select table_name from information_schema.columns where table_schema=\'' . DBINFO::$APPDBNAME . '\' and table_name = \'serverconfig\' ;';
	$columnrows2 = getResultArray($con, $sql);
	$rowcount2 = sizeof($columnrows2);
	if ($rowcount2 == 0) {
		$sql = "CREATE TABLE " . DBINFO::$APPDBNAME . ".`serverconfig` (
  `table_id` VARCHAR(30) ,
  `basepath` VARCHAR(150) ,
  `subdirname` VARCHAR(150) ,
  `issaas` TINYINT ,
  PRIMARY KEY (`table_id`)
) ENGINE=InnoDB
";
		$result2 = execSQL($con, $sql);
		$sql = "insert into  " . DBINFO::$APPDBNAME . ".serverconfig values ('1','/var/www','',1);";
		$result3 = execSQL($con, $sql);
	}
	$sql = 'select table_name from information_schema.columns where table_schema=\'' . DBINFO::$APPDBNAME . '\' and table_name = \'saasconfig\' and column_name = \'isbuilderapp\';';
	$columnrows3 = getResultArray($con, $sql);
	$rowcount3 = sizeof($columnrows3);
	if ($rowcount3 == 0) {
		$sql = 'ALTER TABLE  ' . DBINFO::$APPDBNAME . '.`saasconfig` ADD COLUMN `isbuilderapp` TINYINT  DEFAULT 0 AFTER `loginpage`;';
		$result4 = execSQL($con, $sql);
	}
}

function addaddtionalFieldsInAppTable($con) {
	$sql = 'select table_name from information_schema.columns where table_schema=\'' . DBINFO::$APPDBNAME . '\' and table_name = \'applicationlist\' and column_name = \'f13\';';
	$columnrows = getResultArray($con, $sql);
	$rowcount = sizeof($columnrows);
	if ($rowcount == 0) {
		$sql = 'ALTER TABLE  ' . DBINFO::$APPDBNAME . '.`applicationlist` ADD COLUMN `f13` VARCHAR(20)  NOT NULL AFTER `f12`,
 ADD COLUMN `f14` VARCHAR(200)  AFTER `f13`,
 ADD COLUMN `f15` VARCHAR(200)  AFTER `f14`,
 ADD COLUMN `f16` VARCHAR(200)  AFTER `f15`,
 ADD COLUMN `f17` VARCHAR(200)  AFTER `f16`,
 ADD COLUMN `f18` VARCHAR(200)  AFTER `f17`,
 ADD COLUMN `f19` VARCHAR(200)  AFTER `f18`,
 ADD COLUMN `f20` VARCHAR(200)  AFTER `f19`;';
		$result = execSQL($con, $sql);
	}
}

function isTableAlreadyAdded($con, $tablename) {
	$isadded = false;
	$sql = "select table_name from information_schema.columns where table_schema='" . DBINFO::$APPDBNAME . "' and table_name = '$tablename'";
	$columnrows = getResultArray($con, $sql);
	$rowcount = sizeof($columnrows);
	if ($rowcount > 0) {
		$isadded = true;
	}
	return $isadded;
}

function addCloudTeleponeyTable($con) {
	$isadded = isTableAlreadyAdded($con, "ctintegration");
	if (!$isadded) {
		$sql = "CREATE TABLE " . DBINFO::$APPDBNAME . ".`ctintegration` (
  `id` VARCHAR(30)  NOT NULL,
  `appid` VARCHAR(30)  NOT NULL,
  `providername` VARCHAR(30) ,
  `apikey` VARCHAR(200) ,
  `phoneno` VARCHAR(30)) ENGINE=InnoDB";
		$result = execSQL($con, $sql);
	}
}

function updateProfileActionAndFieldDetails($con) {
	$sql = "ALTER TABLE `table_2_frmaction` CHANGE COLUMN `action` `actions` LONGTEXT  NOT NULL;";
	$result = execSQL($con, $sql);
	$sql = "ALTER TABLE `table_2_frmfields` MODIFY COLUMN `fields` LONGTEXT  NOT NULL;";
	$result = execSQL($con, $sql);
	$sql = "select Profile_name from table_2_frm";
	$pnameres = getResultArray($con, $sql);
	for ($pi = 0; $pi < sizeof($pnameres); $pi++) {
		$rolename = $pnameres[$pi][0];
		$sql = "select formname,modulename from table_2_frmaction where rolename = '$rolename' group by formname;";
		$fnameres = getResultArray($con, $sql);
		for ($fi = 0; $fi < sizeof($fnameres); $fi++) {
			$formnname = $fnameres[$fi][0];
			$modulename = $fnameres[$fi][1];
			$sql = "select actions from table_2_frmaction where formname = '$formnname' and rolename = '$rolename' and modulename = '$modulename';";
			$anameres = getResultArray($con, $sql);
			$actionstr = "";
			for ($ai = 0; $ai < sizeof($anameres); $ai++) {
				$actionname = $anameres[$ai][0];
				if ($actionname != "")
					$actionstr = $actionstr . $actionname . "#";
			}
			if ($actionstr != "") {
				$sql = "delete from table_2_frmaction where formname = '$formnname' and rolename = '$rolename' and modulename = '$modulename'";
				$result = execSQL($con, $sql);
				$sql = "insert into table_2_frmaction values ('$rolename','$modulename','$formnname','$actionstr')";
				$result = execSQL($con, $sql);
			}
		}
		$sql = "select formname,modulename from table_2_frmfields where rolename = '$rolename' group by formname;";
		$fnameres = getResultArray($con, $sql);
		for ($fi = 0; $fi < sizeof($fnameres); $fi++) {
			$formnname = $fnameres[$fi][0];
			$modulename = $fnameres[$fi][1];
			$sql = "select fields,access from table_2_frmfields where formname = '$formnname' and rolename = '$rolename' and modulename = '$modulename';";
			$fanameres = getResultArray($con, $sql);
			$fieldstr = "";
			for ($ai = 0; $ai < sizeof($fanameres); $ai++) {
				$fieldname = $fanameres[$ai][0];
				$access = $fanameres[$ai][1];
				if (!strpos($access, ',')) {
					$access = $access . "," . $access;
				}
				if ($fieldname != "" && $access != "")
					$fieldstr = $fieldstr . "#" . $fieldname . "#" . $access . "$";
			}
			if ($fieldstr != "") {
				$sql = "delete from table_2_frmfields where formname = '$formnname' and rolename = '$rolename' and modulename = '$modulename'";
				$result = execSQL($con, $sql);
				$sql = "insert into table_2_frmfields values ('$rolename','$modulename','$formnname','$fieldstr','')";
				$result = execSQL($con, $sql);
			}
		}
	}
	$sql = "ALTER TABLE `table_2_frmfields` DROP COLUMN `access`;";
	$result = execSQL($con, $sql);
}

function updateOrgMailIdLabel($con) {
	$sql = "select * from printtemplate";
	$resultrows = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($resultrows); $i++) {
		$formname = $resultrows[$i][0];
		$name = $resultrows[$i][1];
		$content = $resultrows[$i][2];
		$content = str_replace('@org@Email Id@', '@org@Product Incharge Mail Id@', $content);
		$sql = "update printtemplate set content = '$content' where formname = '$formname' and name = '$name'";
		$result = execSQL($con, $sql);
	}
}

function updatePrintActionInProfile($con) {
	$sql = "select formname,modulename from formtable where modulename not in ('EmailSend','Reports','Remainder','Settings','Setup','Scheduler','Attachments','History','Notes')";
	$resultrows = getResultArray($con, $sql);
	$sql = 'select Profile_Name from table_2_frm';
	$prorows = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($resultrows); $i++) {
		$formname = $resultrows[$i][0];
		$modulename = $resultrows[$i][1];
		$sql = "select * from formactiontable where formname = '$formname' and name = 'Print'";
		$res = getResultArray($con, $sql);
		if (sizeof($res) == 0) {
			$sql = "insert into formactiontable values ('$modulename','$formname','Print','Print','1','','8')";
			$result = execSQL($con, $sql);
			for ($pi = 0; $pi < sizeof($prorows); $pi++) {
				$rolename = $prorows[$pi][0];
				$sql = "select * from table_2_frmaction where rolename = '$rolename' and formname = '$formname' and action = 'Print'";
				$dbrows = getResultArray($con, $sql);
				if (sizeof($dbrows) == 0) {
					$sql = 'insert into table_2_frmaction values (\'' . $rolename . '\',\'' . $modulename . '\',\'' . $formname . '\',\'Print\')';
					$result = execSQL($con, $sql);
				}
			}
		}
	}
}

function updateCustomizeAction($con) {
	$sql = "select formname,modulename from formtable where modulename not in ('EmailSend','Reports','Remainder','Settings','Setup','Scheduler','Attachments','History','Notes')";
	$resultrows = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($resultrows); $i++) {
		$formname = $resultrows[$i][0];
		$modulename = $resultrows[$i][1];
		$sql = "select * from formactiontable where formname = '$formname' and name = 'Customize'";
		$res = getResultArray($con, $sql);
		if (sizeof($res) == 0) {
			$sql = "insert into formactiontable values ('$modulename','$formname','Customize','Customize','1','','9')";
			$result = execSQL($con, $sql);
		}
	}
}

function updateNoteModuleUpdatedOnDefaultValue($con) {
	$sql = "select formname from formtable where modulename = 'Notes'";
	$res = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($res); $i++) {
		$formname = $res[$i][0];
		$sql = "ALTER TABLE $formname" . "_frm CHANGE `updatedon` `updatedon` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00'";
		$result = execSQL($con, $sql);
	}
}

function migrateLicenseHistoryTable($con) {
	$sql = 'select table_name from information_schema.columns where table_schema=\'' . DBINFO::$APPDBNAME . '\' and table_name = \'licensehistory\' and column_name = \'newaddition\';';
	$columnrows = getResultArray($con, $sql);
	$rowcount = sizeof($columnrows);
	if ($rowcount == 0) {
		$sql = "ALTER TABLE " . DBINFO::$APPDBNAME . ".`licensehistory` ADD COLUMN `index` VARCHAR(30)  NOT NULL AFTER `editionindex`,
 ADD COLUMN `type` VARCHAR(30)  NOT NULL AFTER `index`,
 ADD COLUMN `date_time` TIMESTAMP  NOT NULL AFTER `type`,
 ADD COLUMN `closingbalance` VARCHAR(30)  NOT NULL AFTER `date_time`,
 ADD COLUMN `newaddition` VARCHAR(30)  NOT NULL AFTER `closingbalance`,
 ADD COLUMN `current_available` VARCHAR(30)  NOT NULL AFTER `newaddition`,
 ADD COLUMN `remarks` VARCHAR(30)  NOT NULL AFTER `current_available`;";
		$result = execSQL($con, $sql);
	}
}

function migrateCloudTelephoneyInLicenseTable($con) {
	$sql = "select * from " . DBINFO::$APPDBNAME . ".featuretable where name = 'Cloud Telephony' ";
	$result = getResultArray($con, $sql);
	if (sizeof($result) == 0) {
		$sql = "insert into " . DBINFO::$APPDBNAME . ".featuretable values('18','2','Cloud Telephony','0','Addon')";
		$result = execSQL($con, $sql);
	} else {
		$sql = "update " . DBINFO::$APPDBNAME . ".featuretable set featureindex=18,parentfeatureindex=2 where name='Cloud Telephony'";
		$result = execSQL($con, $sql);
	}
}

function migrateAttachmentInLicenseTable($con) {
	$sql = "select * from " . DBINFO::$APPDBNAME . ".featuretable where name = 'Total Attachment Size' ";
	$result = getResultArray($con, $sql);
	if (sizeof($result) == 0) {
		$sql = "insert into " . DBINFO::$APPDBNAME . ".featuretable values('17','2','Total Attachment Size','0','')";
		$result = execSQL($con, $sql);
	} else {
		$sql = "update " . DBINFO::$APPDBNAME . ".featuretable set featureindex=17,parentfeatureindex=2 where name='Total Attachment Size'";
		$result = execSQL($con, $sql);
	}
}

function migrateAddOnConfigTable($con) {
	$sql = 'select table_name from information_schema.columns where table_schema=\'' . DBINFO::$APPDBNAME . '\' and table_name = \'addonconfig\';';
	$columnrows = getResultArray($con, $sql);
	$rowcount = sizeof($columnrows);
	if ($rowcount == 0) {
		$sql = "CREATE TABLE if not exist " . DBINFO::$APPDBNAME . ".`addonconfig` (
  `id` VARCHAR(30) ,
  `name` VARCHAR(100) ,
  `featureindex` VARCHAR(30) ,
 `count` VARCHAR(30) ,
  `validity` VARCHAR(30) ,
  `duration_value` VARCHAR(30) ,
  `status` VARCHAR(30) ,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB;";
		$result = execSQL($con, $sql);
	} else {
		$sql = 'select table_name from information_schema.columns where table_schema=\'' . DBINFO::$APPDBNAME . '\' and table_name = \'addonconfig\' and column_name = \'featureindex\';';
		$columnrows = getResultArray($con, $sql);
		$rowcount = sizeof($columnrows);
		if ($rowcount == 0) {
			$sql = "ALTER TABLE " . DBINFO::$APPDBNAME . ".`addonconfig` CHANGE COLUMN `category` `featureindex` VARCHAR(30)  CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL;";
			$result = execSQL($con, $sql);
		}
	}
	$sql = 'select table_name from information_schema.columns where table_schema=\'' . DBINFO::$APPDBNAME . '\' and table_name = \'appeditiontable\' and column_name = \'featureset\';';
	$columnrows = getResultArray($con, $sql);
	$rowcount = sizeof($columnrows);
	if ($rowcount == 0) {
		$sql = "ALTER TABLE " . DBINFO::$APPDBNAME . ".`appeditiontable` ADD COLUMN `featureset` INTEGER  NOT NULL AFTER `editionindex`;";
		$result = execSQL($con, $sql);
	}
}

function migrateSaasConfigTable($con) {
	$sql = 'select table_name from information_schema.columns where table_schema=\'' . DBINFO::$APPDBNAME . '\' and table_name = \'saasconfig\' and column_name = \'issubdomain\';';
	$columnrows = getResultArray($con, $sql);
	$rowcount = sizeof($columnrows);
	if ($rowcount == 0) {
		$sql = "ALTER TABLE " . DBINFO::$APPDBNAME . ".`saasconfig` ADD COLUMN `issubdomain` TINYINT(4)  AFTER `isbuilderapp`;";
		$result = execSQL($con, $sql);
	}
}

function migrateSAASConfigTableForEdition($con) {
	$sql = 'select table_name from information_schema.columns where table_schema=\'' . DBINFO::$APPDBNAME . '\' and table_name = \'saasconfig\' and column_name = \'editionindex\';';
	$columnrows = getResultArray($con, $sql);
	$rowcount = sizeof($columnrows);
	if ($rowcount == 0) {
		$sql = "alter table " . DBINFO::$APPDBNAME . ".saasconfig add column editionindex varchar(10);";
		$result = execSQL($con, $sql);
	}
}

function migrateEntityHistoryTable($con) {
	$sql = 'select table_name from information_schema.columns where table_schema=\'' . DBINFO::$APPDBNAME . '\' and table_name = \'entityhistory\' and column_name = \'appid\';';
	$columnrows = getResultArray($con, $sql);
	$rowcount = sizeof($columnrows);
	if ($rowcount == 0) {
		$sql = "ALTER TABLE " . DBINFO::$APPDBNAME . ".`entityhistory` ADD COLUMN `appid` VARCHAR(30)  NOT NULL AFTER `organization`;";
		$result = execSQL($con, $sql);
	}
}

function migrateEntityHistoryTable_1($con) {
	$sql = 'select table_name from information_schema.columns where table_schema=\'' . DBINFO::$APPDBNAME . '\' and table_name = \'entityhistory\';';
	$columnrows = getResultArray($con, $sql);
	$rowcount = sizeof($columnrows);
	if ($rowcount > 0) {
		$sql = "alter table  " . DBINFO::$APPDBNAME . ".entityhistory modify column organization varchar(60)";
		$result = execSQL($con, $sql);
	}
}

function changeLocationFieldLength($con) {
	$sql = "update formfieldtable set flength='500' where type = 'Location';";
	$result = execSQL($con, $sql);
	$sql = "select formname,name from formfieldtable where type = 'Location'; ";
	$resultrows = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($resultrows); $i++) {
		$formname = $resultrows[$i][0];
		$fieldname = $resultrows[$i][1];
		$formtablename = $formname . "_frm";
		$sql = "ALTER TABLE $formtablename MODIFY COLUMN $fieldname VARCHAR(500)";
		$result = execSQL($con, $sql);
	}
}

function changeVievHideforImageFields($con) {
	$sql = "update formfieldtable set isviewhide=1 where type in ('Signature Capture','Photo Capture','Image');";
	$result = execSQL($con, $sql);
}

function updateEnableTemplateforCheckinFormType($con) {
	$sql = "update searchtemplate set ismobile=1 where templatename ='Recently created records' and formname in (select formname from formtable where formtype='checkin/checkout');";
	$result = execSQL($con, $sql);
}

function updateExistingCustomMapping($con) {
	$sql = "select * from importcustommapping";
	$resultrows = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($resultrows); $i++) {
		$formname = $resultrows[$i][0];
		$name = $resultrows[$i][1];
		$mappinglist = $resultrows[$i][2];
		$updatedlist = "";
		$mapparr = explode(',', $mappinglist);
		for ($mi = 0; $mi < sizeof($mapparr); $mi++) {
			$updatedlist .= $mapparr[$mi] . "," . $mapparr[++$mi] . ",1,";
		}
		if ($updatedlist != "") {
			$sql = "update importcustommapping set mappings = '$updatedlist' where formname = '$formname' and name = '$name'";
			$result = execSQL($con, $sql);
		}
	}
}

function updateRemider($con) {
	$sql = 'select * from formactiontable where actionitems like \'%Add Remainder%\'';
	$resultrows = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($resultrows); $i++) {
		$actionstr = $resultrows[$i][5];
		$formname = $resultrows[$i][1];
		$aname = $resultrows[$i][2];
		$actionstr = str_replace('Add Remainder', 'Add Reminder', $actionstr);
		$sql = 'update formactiontable set actionitems = \'' . $actionstr . '\' where formname = \'' . $formname . '\' and name = \'' . $aname . '\'';
		$result = execSQL($con, $sql);
	}
	$sql = 'select * from formtable where modulename = \'Remainder\'';
	$resultrows = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($resultrows); $i++) {
		$formname = $resultrows[$i][1];
		$formlabelname = $resultrows[$i][2];
		$style = $resultrows[$i][12];
		$formlabelname = str_replace('Remainder', 'Reminder', $formlabelname);
		$style = str_replace('Remainder', 'Reminder', $style);
		$sql = 'update formtable set labelname = \'' . $formlabelname . '\',style = \'' . $style . '\' where modulename = \'Remainder\' and formname = \'' . $formname . '\'';
		$result = execSQL($con, $sql);
		$sql = 'update formfieldtable set name = \'Reminder\', label = \'Reminder\' where formname = \'' . $formname . '\' and name = \'Remainder\'';
		$result = execSQL($con, $sql);
		$sql = 'update formfieldtable set name = \'Reminder_Field\', label = \'Reminder Field\' where formname = \'' . $formname . '\' and name = \'Remainder_Field\'';
		$result = execSQL($con, $sql);
		$sql = 'update table_2_frmfields set fields = \'Reminder\' where formname = \'' . $formname . '\' and fields = \'Remainder\'';
		$result = execSQL($con, $sql);
		$sql = 'update table_2_frmfields set fields = \'Reminder_Field\' where formname = \'' . $formname . '\' and fields = \'Remainder_Field\'';
		$result = execSQL($con, $sql);
		$sql = 'ALTER TABLE `' . $formname . '_frm` CHANGE COLUMN `Remainder` `Reminder` VARCHAR(500) NOT NULL, CHANGE COLUMN `Remainder_Field` `Reminder_Field` VARCHAR(30) DEFAULT NULL';
		$result = execSQL($con, $sql);
	}
}

function createDefaultShiftRecord($con) {
	$sql = "SELECT * FROM table_39_frm where table_39_id ='0'";
	$resultrows = getResultArray($con, $sql);
	if (sizeof($resultrows) < 1) {
		$sql = "insert into table_39_frm (table_39_id,Shift_Name,Start_Time,End_Time,Time_Interval,Settings_Mode) values('0','Default Shift Time','09:00:00','18:00:00',30,'Basic')";
		$result = execSQL($con, $sql);
	}
	$sql = "SELECT table_6_id FROM table_6_frm where table_39_0_table_39_id is NULL";
	$resultrows = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($resultrows); $i++) {
		$tableid = $resultrows[$i][0];
		$sql = "update table_6_frm set table_39_0_table_39_id = '0' where table_6_id='$tableid'";
		$result = execSQL($con, $sql);
		$sql = "insert into 0table_39_table_6_frm values('0','$tableid')";
		$result = execSQL($con, $sql);
	}
}

function updateFileHistoryWithUserid($con) {
	$sql = "select table_6_id,Account_Status from table_6_frm ";
	$resultrows = getResultArray($con, $sql);
	$currentdatetime = date("Y-m-d H:i:s");
	for ($i = 0; $i < sizeof($resultrows); $i++) {
		$userid = $resultrows[$i][0];
		$status = $resultrows[$i][1];
		$fstatus = "Inactive";
		if ($status == "Active") {
			$fstatus = "New";
		}
		$sql = "select * from filehistory where userid = '$userid'";
		$dbrows = getResultArray($con, $sql);
		if (sizeof($dbrows) == 0) {
			$sql = "insert into filehistory values ('$userid','$currentdatetime','$fstatus','0')";
			$result = execSQL($con, $sql);
		}
	}
}

function createAttendanceForm($con) {
	// $sql = "select max(cast(relationid as signed)) from formrelationtable";
	// $resultrows = getResultArray($con, $sql);
	// $mrel = $resultrows[0][0] + 1;
	// $sql = "select fieldorder from formfieldtable where formname = 'table_6' and name = 'table_6_0_createdusername'";
	// $result = getResultArray($con, $sql);
	// $ufieldorder = $result[0][0];
	// $sql = "select fieldorder from formfieldtable where formname = 'table_6_group' and name = 'createdon'";
	// $result = getResultArray($con, $sql);
	// $ugfieldorder = $result[0][0];
	// $sql = "update formfieldtable set fieldorder = fieldorder + 1 where formname = 'table_6' and fieldorder >= $ufieldorder";
	// $result = execSQL($con, $sql);
	// $sql = "update formfieldtable set fieldorder = fieldorder + 1 where formname = 'table_6_group' and fieldorder >= $ugfieldorder";
	// $result = execSQL($con, $sql);
	// $sql = "insert into formtable values('Activity', 'table_43', 'Attendance', 'checkin/checkout', '0', '', '0', 0, '1', '1', '0', 'atten.png', 'g_root,g_root,0,1,0,0,0,0$" . "true,g_root,g_Attendance,0,2,0,0,0,0$" . "true,g_Attendance,f_1,0,0,0,0,0,0$" . "true,g_Attendance,f_2,1,0,0,0,0,0$" . "true,g_Attendance,f_5,2,0,0,0,0,0$" . "true,g_Attendance,f_6,3,0,0,0,0,0$" . "true,g_Attendance,f_9,4,0,0,0,0,0$" . "true', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '', '','1','1','1');";
	// $result = execSQL($con, $sql);
	// $sql = "insert into table_2_frmscreen values('super admin profile','Activity','table_43,table_43');";
	// $result = execSQL($con, $sql);
	// $sql = "insert into formfieldtable values
	// ('Activity', 'table_43', 'table_43_id', 'table_43_id', 'form_entityid', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0', 'Auto', 'Advanced', '', '1', '1', '0', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
	// ('Activity', 'table_43', 'In_Time', 'In Time', 'Date_Time', '40', '', '', '', '', '0', '0', 100, 100, 100, '0', '0', 'Normal', 'Advanced', '', '1', '1', '1', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'Checkin', NULL),
	// ('Activity', 'table_43', 'In_Location', 'In Location', 'Location', '500', '', '', '', '', '0', '0', '100', '200', '150', '0', '0', 'Normal','Advanced', '', '1', '0', '2', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'Checkin', NULL),
	// ('Activity', 'table_43', 'In_Location_latitude', 'In Location Latitude', 'Text', '500', '', '', '', '', '1', '1', '100', '200', '150', '0', '0', 'Normal', 'NO', '', '1', '0', '3', '0','0', '0', '0', '0', '', '1', 0, 0, 0, 'Checkin', NULL),
	// ('Activity', 'table_43', 'In_Location_longitude', 'In_Location Longitude', 'Text', '500', '', '', '', '', '1', '1', '100', '200', '150', '0', '0', 'Normal', 'NO', '', '1', '0', '4', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'Checkin', NULL),
	// ('Activity', 'table_43', 'Out_Time', 'Out Time', 'Date_Time', '40', '', '', '', '', '0', '0', 100, 100, 100, '0', '0', 'Normal', 'Advanced', '', '1', '1', '5', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'Checkout', NULL),
	// ('Activity', 'table_43', 'Out_Location', 'Out Location', 'Location', '500', '', '', '', '', '0', '0', '100', '200', '150', '0', '0', 'Normal','Advanced', '', '1', '0', '6', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'Checkout', NULL),
	// ('Activity', 'table_43', 'Out_Location_latitude', 'Out Location Latitude', 'Text', '500', '', '', '', '', '1', '1', '100', '200', '150', '0', '0', 'Normal', 'NO', '', '1', '0', '7', '0','0', '0', '0', '0', '', '1', 0, 0, 0, 'Checkout', NULL),
	// ('Activity', 'table_43', 'Out_Location_longitude', 'Out_Location Longitude', 'Text', '500', '', '', '', '', '1', '1', '100', '200', '150', '0', '0', 'Normal', 'NO', '', '1', '0', '8', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'Checkout', NULL),
	// ('Activity', 'table_43', 'table_6_3_table_6_id', 'Assigned to', 'entity_group', '40', '', '', '', '', '0', '0', '100', '200', '150', '0', '1', 'Normal', 'Advanced', 'current', '1', '0', '9', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', $mrel+4),
	// ('Activity', 'table_43', 'table_6_3_table_6_group_id', 'Assigned to group', 'reference_group', '40', '', '', '', '', '1', '1', '100', '200', '150', '0', '0','Normal', 'Advanced', 'current', '1', '0', '10', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', $mrel+6),
	// ('Activity', 'table_43', 'table_6_0_createdusername', 'Created Username', 'form_history', '40', '', '', '', '', '1', '1',100, 100, 100, '0', '0', 'Auto', 'Advanced', '', '1', '1', '11', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', $mrel+1),
	// ('Activity', 'table_43', 'createdon', 'Created Time', 'form_history', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0','Auto', 'Advanced', '', '1', '1', '12', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
	// ('Activity', 'table_43', 'table_6_1_updatedusername', 'Updated Username', 'form_history', '40', '', '', '', '', '1', '1',100, 100, 100, '0', '0', 'Auto', 'Advanced', '', '1', '1', '13', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', $mrel+2),
	// ('Activity', 'table_43', 'updatedon', 'Updated Time', 'form_history', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0','Auto', 'Advanced', '', '1', '1', '14', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
	// ('Activity', 'table_43', 'table_6_2_viewedusername', 'Viewed Username', 'form_history', '40', '', '', '', '', '1', '1',100, 100, 100, '0', '0', 'Auto', 'Advanced', '', '1', '1', '15', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', $mrel+3),
	// ('Activity', 'table_43', 'viewedon', 'Viewed Time', 'form_history', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0','Auto', 'Advanced', '', '1', '1', '16', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
	// ('Setup', 'table_6', 'table_43_0_table_43', 'Assigned to', 'subtable', '40', '', '', '', '', '1', '0', '100', '200', '150', '0', '1', 'Normal', 'Advanced', 'current', '1', '0', '$ufieldorder', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', $mrel+5),
	// ('Setup', 'table_6_group', 'table_43_0_table_43', 'Assigned to group', 'subtable', '40', '', '', '', '', '1', '1', '100', '200', '150', '0', '0', 'Normal','Advanced', 'current', '1', '0', '$ugfieldorder', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', $mrel+7);";
	// $result = execSQL($con, $sql);
	// $fieldstr = "#table_43_id,table_43_id#1,1$
	// #In_Time,In_Time#1,1$
	// #In_Location,In_Location#1,1$
	// #In_Location_longitude,In_Location_longitude#1,1$
	// #In_Location_longitude,In_Location_longitude#1,1$
	// #Out_Time,Out_Time#1,1$
	// #Out_Location,Out_Location#1,1$
	// #Out_Location_longitude,Out_Location_longitude#1,1$
	// #Out_Location_longitude,Out_Location_longitude#1,1$
	// #table_6_3_table_6_id,table_6_3_table_6_id#1,1$
	// #table_6_0_createdusername,table_6_0_createdusername#1,1$
	// #createdon,createdon#1,1$
	// #table_6_1_updatedusername,table_6_1_updatedusername#1,1$
	// #updatedon,updatedon#1,1$
	// #table_6_2_viewedusername,table_6_2_viewedusername#1,1$
	// #viewedon,viewedon#1,1$
	// #table_6_3_table_6_group_id,table_6_3_table_6_group_id#1,1$";
	// $sql = "select fields from table_2_frmfields where formname = 'table_6' and modulename = 'Setup' and rolename = 'super admin profile'";
	// $retArr = getResultArray($con, $sql);
	// $fstr = $retArr[0][0] . "#table_43_0_table_43,table_43_0_table_43#1,1,$";
	// $sql = " update table_2_frmfields set fields = '$fstr' where rolename = 'super Admin Profile' and modulename = 'Setup' and formname = 'table_6';";
	// $result = execSQL($con, $sql);
	// $sql = "insert into table_2_frmfields values
	// ('super admin profile', 'Activity', 'table_43', '$fieldstr')";
	// $result = execSQL($con, $sql);
	// $sql = "insert into formrelationtable values
	// ($mrel+1, $mrel+1, 0, 'table_43', 'table_6', 'n-1', '', 0, ''),
	// ($mrel+2, $mrel+2, 1, 'table_43', 'table_6', 'n-1', '', 0, ''),
	// ($mrel+3, $mrel+3, 2, 'table_43', 'table_6', 'n-1', '', 0, ''),
	// ($mrel+4,$mrel+5,3, 'table_43', 'table_6', 'n-1', '', 0, ''),
	// ($mrel+5,$mrel+4,0, 'table_6', 'table_43', '1-n', '', 0, ''),
	// ($mrel+6,$mrel+7,0, 'table_43', 'table_6_group', 'n-1', '', 0, ''),
	// ($mrel+7,$mrel+6,0, 'table_6_group', 'table_43', '1-n', '', 0, '')";
	// $result = execSQL($con, $sql);
	// $sql = "insert into formfieldreference values
	// ('Activity', 'table_43', 'table_6_0_createdusername', 'Setup', 'table_6', 'Name', $mrel+1),
	// ('Activity', 'table_43', 'table_6_1_updatedusername', 'Setup', 'table_6', 'Name', $mrel+2),
	// ('Activity', 'table_43', 'table_6_2_viewedusername', 'Setup', 'table_6', 'Name', $mrel+3),
	// ('Activity','table_43','table_6_3_table_6_id','Setup','table_6','Name', $mrel+4),
	// ('Setup','table_6','table_43_0_table_43','Activity','table_43','', $mrel+5),
	// ('Activity','table_43','table_6_3_table_6_group_id','Setup','table_6_group','groupname', $mrel+6),
	// ('Setup','table_6_group','table_43_0_table_43','Activity','table_43','', $mrel+7);";
	// $result = execSQL($con, $sql);
	// $sql = " insert into fetchallfilterreference values('table_43', 'table_6_3_table_6_id', '', '0', ''),('table_43', 'table_6_3_table_6_group_id', '', '0', '');";
	// $result = execSQL($con, $sql);
	// $actionstr = "ScreenAccess,ScreenAccess#Add,Add#Edit,Edit#Delete,Delete#View,View#Search,Search#Calendar,Calendar#Import,Import#Export,Export#";
	// $sql = "insert into table_2_frmaction values
	// ('super admin profile','Activity','table_43','$actionstr');";
	// $result = execSQL($con, $sql);
	// $sql = "insert into formactiontable values
	// ('Activity','table_43','Add','Add','1','','0'),
	// ('Activity','table_43','Edit','Edit','1','','1'),
	// ('Activity','table_43','Delete','Delete','1','','2'),
	// ('Activity','table_43','View','View','1','','3'),
	// ('Activity','table_43','Search','Search','1','','4'),
	// ('Activity','table_43','Calendar','Calendar','1','','5'),
	// ('Activity','table_43','Import','Import','1','','6'),
	// ('Activity','table_43','Export','Export','1','','7');";
	// $result = execSQL($con, $sql);
	// $sql = "create table table_43_frm (table_43_id varchar(40) primary key,
	// `In_Time` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
	// `In_Location` varchar(500),`In_Location_latitude` varchar(50),
	// `In_Location_longitude` varchar(50) ,
	// `Out_Time` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
	// `Out_Location` varchar(500),`Out_Location_latitude` varchar(50),
	// `Out_Location_longitude` varchar(500) ,table_6_3_table_6_id varchar(30) NULL,
	// table_6_3_table_6_group_id varchar(30),
	// `table_6_0_table_6_id` varchar(30) NOT NULL DEFAULT '',
	// `createdon` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
	// `table_6_1_table_6_id` varchar(30) NOT NULL DEFAULT '',
	// `updatedon` TIMESTAMP NOT NULL, `table_6_2_table_6_id` varchar(30) NOT NULL DEFAULT '',
	// `viewedon` TIMESTAMP NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	// $result = execSQL($con, $sql);
	// $sql = "alter table table_43_frm add CONSTRAINT `table_43_frmtable_6_3_table_6_id` foreign key(table_6_3_table_6_id) references table_6_frm(table_6_id);";
	// $result = execSQL($con, $sql);
	// $sql = "alter table table_43_frm add CONSTRAINT `table_43_frmtable_6_3_table_6_group_id` foreign key(table_6_3_table_6_group_id) references table_6_group_frm(table_6_group_id);";
	// $result = execSQL($con, $sql);
	// $sql = "create table `3table_6_table_43_frm` (table_6_id varchar(30), table_43_id varchar(30)) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	// $result = execSQL($con, $sql);
	// $sql = "alter table table_6_frm add 3table_43_id varchar(30) after `table_39_0_table_39_id`;";
	// $result = execSQL($con, $sql);
	// $sql = "insert into idgenerator values('table_43_frm','0');";
	// $result = execSQL($con, $sql);
	// $sql = "select * from moduletable where name='Activity'";
	// $resultrows = getResultArray($con, $sql);
	// if (sizeof($resultrows) < 1) {
	// $sql = "select moduleorder from moduletable order by moduleorder desc";
	// $resultrows = getResultArray($con, $sql);
	// $order = $resultrows[0][0] + 1;
	// $sql = "insert into moduletable values('Activity','micon.png',$order);";
	// $result = execSQL($con, $sql);
	// }
	// $obj->{TableProperties::$SCREEN_PROPERTY_MODULENAME } = 'Activity';
	// $obj->{TableProperties::$SCREEN_PROPERTY_FORMNAME } = 'table_43';
	// createPredefinedSearchTempaltes($con, $obj);
	$sql = "update formtable set ismapviewneeded = '1' where formname = 'table_41'";
	$result = execSQL($con, $sql);
}

function updateUserformLayout($con) {
	$sql = "update formtable set style = 'g_root,g_root,0,1,0,0,0,0$" . "true,g_root,g_Basic Information,0,2,0,0,0,0$" . "true,g_Basic Information,f_2,0,0,0,0,0,0$" . "true,g_Basic Information,f_1,1,0,0,0,0,0$" . "true,g_Basic Information,f_3,2,0,0,0,0,0$" . "true,g_Basic Information,f_8,3,0,0,0,0,0$" . "true,g_Basic Information,f_5,4,0,0,0,0,0$" . "true,g_Basic Information,f_6,5,0,0,0,0,0$" . "true,g_Basic Information,f_7,6,0,0,0,0,0$" . "true,g_root,g_Additional Information,1,2,0,0,0,0$" . "false,g_Additional Information,f_10,0,0,0,0,0,0$" . "false,g_Additional Information,f_9,1,0,0,0,0,0$" . "false,g_Additional Information,f_11,2,0,0,0,0,0$" . "false,g_Additional Information,f_12,3,0,0,0,0,0$" . "false,g_Additional Information,f_16,4,0,0,0,0,0$" . "false,g_Additional Information,f_23,5,0,0,0,0,0$" . "false,g_Additional Information,f_14,6,0,0,0,0,0$" . "false,g_Additional Information,f_18,7,0,0,0,0,0$" . "false,g_Additional Information,f_17,8,0,0,0,0,0$" . "false,g_Additional Information,f_24,9,0,0,0,0,0$" . "false' where formname = 'table_6'";
	$result = execSQL($con, $sql);
	$sql = "select name,type,fieldorder from formfieldtable where formname = 'table_6' and fieldorder = '24'";
	$resultrows = getResultArray($con, $sql);
	$name = $resultrows[0][0];
	$type = $resultrows[0][1];
	$sql = "select fieldorder from formfieldtable where formname = 'table_6' and name = 'table_39_0_table_39_id'";
	$resultrows = getResultArray($con, $sql);
	$forder = $resultrows[0][0];
	if ($type != FieldType::$FORM_HISTORY && $name != "table_39_0_table_39_id") {
		$sql = "update formfieldtable set fieldorder = '24' where formname = 'table_6' and name = 'table_39_0_table_39_id'";
		$result = execSQL($con, $sql);
		$sql = "update formfieldtable set fieldorder = '$forder' where formname = 'table_6' and name = '$name'";
		$result = execSQL($con, $sql);
	}
}

function migratePartnertable($con) {
	$sql = "SELECT * FROM information_schema.`COLUMNS` where table_schema='" . DBINFO::$APPDBNAME . "' and table_name='partnerdetails'";
	$resultrows = getResultArray($con, $sql);
	$size = sizeof($resultrows);
	if ($size == 0) {
		$sql = "CREATE TABLE " . DBINFO::$APPDBNAME . ".`partnerdetails` (
  `table_id` VARCHAR(30)  NOT NULL,
  `firstname` VARCHAR(100) ,
  `lastname` VARCHAR(100) ,
  `cname` VARCHAR(100)  NOT NULL,
  `email` VARCHAR(50)  NOT NULL,
  `phno` VARCHAR(30)  NOT NULL,
  `address` VARCHAR(300)  NOT NULL,
  `loginid` VARCHAR(30)  NOT NULL,
  `password` VARCHAR(500)  NOT NULL,
  `accstatus` VARCHAR(30)  NOT NULL,
`needotherreports` tinyint(1) not null default 0 ,
`needmailalert` tinyint(1) not null default 0,
`needdailyusagereport` tinyint(1) not null default 0,
`needlicensereport` tinyint(1) not null default 0,
  PRIMARY KEY (`table_id`, `cname`)
)
ENGINE = InnoDB;";
		$result = execSQL($con, $sql);
	}
}

function migrateCleanupHistoryTable($con) {
	$sql = "SELECT * FROM information_schema.`COLUMNS` where table_schema='" . DBINFO::$APPDBNAME . "' and table_name='cleanuphistory'";
	$resultrows = getResultArray($con, $sql);
	$size = sizeof($resultrows);
	if ($size == 0) {
		$sql = "ALTER TABLE `" . DBINFO::$APPDBNAME . "`.applicationlist ENGINE = INNODB;";
		$result = execSQL($con, $sql);
		$sql = "CREATE TABLE `" . DBINFO::$APPDBNAME . "`.`cleanuphistory` (
  `appid` VARCHAR(100)  NOT NULL,
  `isenabled` TINYINT  NOT NULL DEFAULT 0,
  `duration` VARCHAR(100)  NOT NULL,
  CONSTRAINT `cleanup_fk_constraint` FOREIGN KEY `cleanup_fk_constraint` (`appid`)
    REFERENCES `applicationlist` (`appid`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT
)
ENGINE = InnoDB;";
		$result = execSQL($con, $sql);
	}
}

function migrateCTIntegrationtable($con) {
	$sql = "SELECT * FROM information_schema.`COLUMNS` where table_schema='" . DBINFO::$APPDBNAME . "' and table_name='ctintegration' and COLUMN_NAME = 'username'";
	$resultrows = getResultArray($con, $sql);
	$size = sizeof($resultrows);
	if ($size == 0) {
		$sql = "ALTER TABLE " . DBINFO::$APPDBNAME . ".`ctintegration` ADD COLUMN `username` VARCHAR(30)  AFTER `phoneno`;";
		$result = execSQL($con, $sql);
	}
}

function migrateLogSettings($con) {
	$sql = "SELECT * FROM information_schema.`COLUMNS` where table_schema='" . DBINFO::$APPDBNAME . "' and table_name='serverconfig' and COLUMN_NAME = 'iscpanellogneed'";
	$resultrows = getResultArray($con, $sql);
	$size = sizeof($resultrows);
	if ($size == 0) {
		$sql = "ALTER TABLE " . DBINFO::$APPDBNAME . ".serverconfig ADD iscpanellogneed varchar(10) AFTER issaas;";
		$result = execSQL($con, $sql);
		$appid = getAppid();
		$sql = "update " . DBINFO::$APPDBNAME . ".applicationlist set f14=0,f15=0,f16=0 where f14 is NULL or f14=''";
		$result = execSQL($con, $sql);
	}
}

function migrateApplicationListTable($con) {
	$sql = "SELECT * FROM information_schema.`COLUMNS` where table_schema='" . DBINFO::$APPDBNAME . "' and table_name='applicationlist' and COLUMN_NAME = 'f29'";
	$resultrows = getResultArray($con, $sql);
	$size = sizeof($resultrows);
	if ($size == 0) {
		$sql = "ALTER TABLE `" . DBINFO::$APPDBNAME . "`.`applicationlist` ADD COLUMN `f21` VARCHAR(200)  AFTER `f20`,
 ADD COLUMN `f22` VARCHAR(200)  AFTER `f21`,
 ADD COLUMN `f23` VARCHAR(200)  AFTER `f22`,
 ADD COLUMN `f24` VARCHAR(200)  AFTER `f23`,
 ADD COLUMN `f25` VARCHAR(200)  AFTER `f24`,
 ADD COLUMN `f26` VARCHAR(200)  AFTER `f25`,
 ADD COLUMN `f27` VARCHAR(200)  AFTER `f26`,
 ADD COLUMN `f28` VARCHAR(200)  AFTER `f27`,
 ADD COLUMN `f29` VARCHAR(200)  AFTER `f28`,
 ADD COLUMN `f30` VARCHAR(200)  AFTER `f29`;";
		$result = execSQL($con, $sql);
	}
}

function migratesaastables($con) {
	$sql = "SELECT product_id FROM " . DBINFO::$APPDBNAME . ".productdetails order by product_id";
	$resultrows = getResultArray($con, $sql);
	$size = sizeof($resultrows);
	for ($i = 0; $i < $size; $i++) {
		$productid = $resultrows[$i][0];
		for ($j = 0; $j < 3; $j++) {
			$sql = "ALTER TABLE " . DBINFO::$APPDBNAME . "." . $productid . "_" . $j . "_orginfo MODIFY COLUMN `userid` VARCHAR(100)  NOT NULL,
 MODIFY COLUMN `emailid` VARCHAR(100)  NOT NULL;";
			$result = execSQL($con, $sql);
			$sql = "ALTER TABLE " . DBINFO::$APPDBNAME . "." . $productid . "_" . $j . "_uservsapptable MODIFY COLUMN `saasuserid` VARCHAR(100)   NOT NULL,
 MODIFY COLUMN `crmuserid` VARCHAR(100)  NOT NULL;";
			$result = execSQL($con, $sql);
			$schemaname = DBINFO::$APPDBNAME . $productid . "_" . $j;
			$sql = "SELECT * FROM information_schema.SCHEMATA where schema_name='$schemaname';";
			$resultrows1 = getResultArray($con, $sql);
			$count = sizeof($resultrows1);
			if ($count > 0) {
				$sql = "ALTER TABLE `$schemaname`.`table_6_frm` MODIFY COLUMN `Emailid` VARCHAR(100) DEFAULT NULL;";
				$result = execSQL($con, $sql);
				//$action = SYNC_ACTION::$STRUC_UPDATE;
				//insertSyncQueryDetails($con, "", "", $action, $sql);
			}
		}
		$sql = "ALTER TABLE " . DBINFO::$APPDBNAME . "." . $productid . "_editionreg MODIFY COLUMN `userid` VARCHAR(100)  NOT NULL;";
		$result = execSQL($con, $sql);
	}
}

function changeAutoPunchModuleName($con) {
	$sql = "select * from moduletable where name = 'Calendar'";
	$modulerows = getResultArray($con, $sql);
	if (sizeof($modulerows) == 0) {
		$sql = "select Max(Moduleorder)+1 from moduletable";
		$modulerow = getResultArray($con, $sql);
		$max = $modulerow[0][0];
		$sql = "insert into moduletable values('Calendar','micon.png','$max')";
		$result = execSQL($con, $sql);
	}
	$sql = "SET FOREIGN_KEY_CHECKS=0;";
	$result = execSQL($con, $sql);
	$sql = "update formtable set modulename = 'Calendar' where formname = 'table_41'";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set modulename = 'Calendar' where formname = 'table_41'";
	$result = execSQL($con, $sql);
	$sql = "update table_2_frmfields set modulename = 'Calendar' where formname = 'table_41'";
	$result = execSQL($con, $sql);
	$sql = "update formfieldreference set modulename = 'Calendar' where formname = 'table_41'";
	$result = execSQL($con, $sql);
	$sql = "update formfieldreference set refmodulename = 'Calendar' where refformname = 'table_41'";
	$result = execSQL($con, $sql);
	$sql = "update table_2_frmaction set modulename = 'Calendar' where formname = 'table_41'";
	$result = execSQL($con, $sql);
	$sql = "update table_2_frmscreen set modulename = 'Calendar' where formname like '%table_41%'";
	$result = execSQL($con, $sql);
	$sql = "update formactiontable set modulename = 'Calendar' where formname = 'table_41'";
	$result = execSQL($con, $sql);
	$sql = "SET FOREIGN_KEY_CHECKS=1;";
	$result = execSQL($con, $sql);
}

function changeAutoPunchModuleName_1($con) {
	$sql = "select * from moduletable where name = 'Calendar'";
	$modulerows = getResultArray($con, $sql);
	if (sizeof($modulerows) > 0) {
		$sql = "update searchtemplate set modulename='Calendar' where formname='table_41';";
		$result = execSQL($con, $sql);
	}
}

function updateAllowSadminLogin($con) {
	$sql = "update " . DBINFO::$APPDBNAME . ".applicationlist set f24='0' where f24 is NULL";
	$result = execSQL($con, $sql);
}

function systemTemplatesforAutoPunch($con) {
	$obj -> {TableProperties::$SCREEN_PROPERTY_MODULENAME } = 'Calendar';
	$obj -> {TableProperties::$SCREEN_PROPERTY_FORMNAME } = 'table_41';
	createPredefinedSearchTempaltes($con, $obj);
}

function addSeesionColoumn($con) {
	$sql = "show columns from " . DBINFO::$APPDBNAME . ".serverconfig where field='sessiontime';";
		$collist = getResultArray($con, $sql);
		if (sizeof($collist) == 0) {
		$sql = "ALTER TABLE " . DBINFO::$APPDBNAME . ".serverconfig ADD sessiontime varchar(50) NOT NULL DEFAULT 6000 AFTER iscpanellogneed;";
	$result = execSQL($con, $sql);
		}
	
}

function migrateSyncTableForDesc($con) {
	$sql = "select maxsynctableid from syncdetailtable ";
	$syncdetails = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($syncdetails); $i++) {
		$id = $syncdetails[$i][0];
		if ($id == "0") {
			$id = "";
		} else {
			$id = $id . "_";
		}
		$sql = "show columns from $id" . "datasyncquerydetails where field='userid';";
		$collist = getResultArray($con, $sql);
		if (sizeof($collist) == 0) {
			$sql = "ALTER TABLE `$id" . "datasyncquerydetails` ADD COLUMN `userid` VARCHAR(30)  AFTER `status`;";
			$result = execSQL($con, $sql);
		}
		$sql = "show columns from $id" . "datasyncquerydetails where field='desc';";
		$collist = getResultArray($con, $sql);
		if (sizeof($collist) == 0) {
			$sql = "ALTER TABLE `$id" . "datasyncquerydetails` ADD COLUMN `desc` VARCHAR(100)  NOT NULL AFTER `userid`;";
			$result = execSQL($con, $sql);
		}
	}
}

function removeImportAction($con) {
	$sql = "SELECT rolename,actions FROM table_2_frmaction where formname = 'table_4'";
	$results = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($results); $i++) {
		$values = "";
		$role = $results[$i][0];
		$actions = $results[$i][1];
		if (strpos($actions, 'Import') !== false) {
			$actionsarray = explode('#', $actions);
			for ($j = 0; $j < sizeof($actionsarray) - 1; $j++) {
				if (strpos($actionsarray[$j], 'Import') !== false) {
					// do nothing
				} else {
					$values .= $actionsarray[$j] . '#';
				}
			}
			$query = "update table_2_frmaction set actions = '" . $values . "' where formname = 'table_4' and rolename = '" . $role . "'";
			execSQL($con, $query);
		} else {
			continue;
		}
	}

	$sql = "update formfieldtable set label = 'User Status' where formname = 'table_6' and name = 'Account_Status';";
	execSQL($con, $sql);

	$sql = "update formfieldtable set isconfighide = '1',isviewhide = '1' where formname = 'table_6' and name in('Account_Type','Date_of_Birth');";
	execSQL($con, $sql);
}

function updateNewSyncDesignStruture($con) {
	$sql = "show tables like 'structuresyncquerydetail'";
	$result = getResultArray($con, $sql);
	if (sizeof($result) == 0) {
		$sql = "select frel.mtable,frel.stable,frel.nthinstance from formfieldtable f left join formrelationtable frel on f.formname = frel.mtable and f.relationid = frel.relationid where f.type = 'subtable' and frel.mtable is not null and frel.stable is not null";
		$dbrows = getResultArray($con, $sql);
		for ($i = 0; $i < sizeof($dbrows); $i++) {
			$mtable = $dbrows[$i][0];
			$stable = $dbrows[$i][1];
			$nth = $dbrows[$i][2];
			try {
				$keyname = $mtable . "_frm" . $nth . $stable . "_id";
				$tablename = $mtable . "_frm";
				$sql = "SELECT DATABASE();";
				$databaseset = getResultArray($con, $sql);
				$dbname = $databaseset[0][0];
				if (isFKEYExists($con, $dbname, $tablename, $keyname)) {
					$sql = "ALTER TABLE $tablename DROP FOREIGN KEY $keyname;";
					execSQL($con, $sql);
				}
			} catch ( Exception $ex ) {
				debug("EXCEPTION : " . $ex);
			}
		}
		$sql = "CREATE TABLE `datasynchistory` (
    `formname` varchar(30) NOT NULL,
    `web_sync_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    `mobile_sync_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY (`formname`)) ENGINE=InnoDB;";
		execSQL($con, $sql);

		$sql = "CREATE TABLE `structuresynchistory` (
  `laststructureid` varchar(30) NOT NULL) ENGINE=InnoDB;";
		execSQL($con, $sql);

		$sql = "CREATE TABLE `formwisemodifiedddetails` (
    `formname` varchar(30) NOT NULL,
    `updated_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY (`formname`)) ENGINE=InnoDB;";
		execSQL($con, $sql);

		$sql = "CREATE TABLE `formwisedeleteddetails` (
    `formname` varchar(30) NOT NULL,
    `deleted_id` varchar(300) NOT NULL,
    `deleted_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00') ENGINE=InnoDB;";
		execSQL($con, $sql);

		$sql = "CREATE TABLE `userwisesyncdetails` (
  `userid` varchar(30) NOT NULL,
  `mobileid` varchar(30) NOT NULL,
  `formname` varchar(30) NOT NULL,
  `web_sync_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mobile_sync_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00') ENGINE=InnoDB;";
		execSQL($con, $sql);

		$sql = "CREATE TABLE `structuresyncquerydetail` (
    `id` varchar(30) NOT NULL,
    `transactionid` int(11) NOT NULL,
    `formname` varchar(30) NOT NULL,
    `query` longtext NOT NULL,
    `action` varchar(30) DEFAULT NULL,
    `createdtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `status` varchar(30) DEFAULT NULL,
    `userid` varchar(30) DEFAULT NULL,
    `desc` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)) ENGINE=InnoDB";
		execSQL($con, $sql);

		$sql = "insert into structuresynchistory values (0)";
		execSQL($con, $sql);

		$sql = "insert into formwisemodifiedddetails (formname) select formname from formtable where formtype = '' and modulename not in ('Attachments','EmailSend','History','Notes','Remainder','Reports','Scheduler','Settings','Setup') and formname not in ('table_37','table_41')";
		execSQL($con, $sql);
		$currenttime = date("Y-m-d H:i:s");
		$sql = "update formwisemodifiedddetails set updated_time = '" . $currenttime . "'";
		$result = execSQL($con, $sql);
		$sql = "ALTER TABLE `structuresyncquerydetail` ADD COLUMN `tableid` VARCHAR(30)  DEFAULT NULL AFTER `query`;";
		$result = execSQL($con, $sql);
	}
}

function updateIdForSearchTemplate($con) {
	$sql = "select max(templateid) from  searchtemplate;";
	$resultrow = getResultArray($con, $sql);
	$id = $resultrow[0][0];
	$sql = "update idgenerator set id = '$id' where tablename = 'searchtemplate'";
	$result = execSQL($con, $sql);
}

function updateUserGroupStructure($con) {
	$sql = "ALTER TABLE `table_6_group_frm` CHANGE COLUMN `userid` `table_6_0_table_6_id` VARCHAR(30)   DEFAULT NULL,
    ADD COLUMN `viewedon` TIMESTAMP  NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `table_6_0_table_6_id`,
    ADD COLUMN `table_6_1_table_6_id` VARCHAR(30)  DEFAULT NULL AFTER `viewedon`,
    ADD COLUMN `table_6_2_table_6_id` VARCHAR(30)  DEFAULT NULL AFTER `table_6_1_table_6_id`;";
	$result = execSQL($con, $sql);

	$sql = "update formfieldtable set label = 'Created Time' where name = 'createdon' and formname = 'table_6_group';";
	execSQL($con, $sql);

	$sql = "update formfieldtable set label = 'Updated Time' where name = 'updatedon' and formname = 'table_6_group';";
	execSQL($con, $sql);

	$sql = "update formfieldtable set label = 'Created Username',name = 'table_6_0_createdusername' where name = 'userid' and formname = 'table_6_group';";
	execSQL($con, $sql);

	$sql = "insert into formfieldtable values ('Setup','table_6_group','viewedon','Viewed Time','form_history','40','','','','','1','1','100','100','100','0','0','Auto','Advanced','','1','1','11','0','0','0','0','0','','1','0','0','0','ALL',null),
    ('Setup','table_6_group','table_6_1_updatedusername','Updated Username','form_history','40','','','','','1','1','100','100','100','0','0','Auto','Advanced','','1','1','11','0','0','0','0','0','','1','0','0','0','ALL',null),
    ('Setup','table_6_group','table_6_2_viewedusername','Viewed Username','form_history','40','','','','','1','1','100','100','100','0','0','Auto','Advanced','','1','1','11','0','0','0','0','0','','1','0','0','0','ALL',null)";
	execSQL($con, $sql);
	$relationid_0 = getNextIdValue($con, 'formrelationtable', 'relationid');
	$relationid_1 = $relationid_0 + 1;
	$relationid_2 = $relationid_1 + 1;

	$sql = 'insert into formrelationtable values ( ' . $relationid_0 . ', ' . $relationid_0 . ', 0, ' . '\'table_6_group\'' . ', ' . '\'' . 'table_6' . '\'' . ', ' . '\'' . 'n-1' . '\'' . ', ' . '\'' . '' . '\'' . ', 0, ' . '\'' . '' . '\'' . ');';
	$result = execSQL($con, $sql);
	$sql = 'insert into formrelationtable values ( ' . $relationid_1 . ', ' . $relationid_1 . ', 1, ' . '\'table_6_group\'' . ', ' . '\'' . 'table_6' . '\'' . ', ' . '\'' . 'n-1' . '\'' . ', ' . '\'' . '' . '\'' . ', 0, ' . '\'' . '' . '\'' . ');';
	$result = execSQL($con, $sql);
	$sql = 'insert into formrelationtable values ( ' . $relationid_2 . ', ' . $relationid_2 . ', 2, ' . '\'table_6_group\'' . ', ' . '\'' . 'table_6' . '\'' . ', ' . '\'' . 'n-1' . '\'' . ', ' . '\'' . '' . '\'' . ', 0, ' . '\'' . '' . '\'' . ');';
	$result = execSQL($con, $sql);

	$createduseridref = 'insert into formfieldreference values(
    ' . '\'Setup\'' . ',
    ' . '\'table_6_group\'' . ',
    ' . '\'' . 'table_6_0_createdusername' . '\'' . ',
    ' . '\'Setup\'' . ',
    ' . '\'' . 'table_6' . '\'' . ',
    ' . '\'' . 'Name' . '\'' . ', ' . $relationid_0 . ');';
	$result = execSQL($con, $createduseridref);
	$updateduseridref = 'insert into formfieldreference values(
    ' . '\'Setup\'' . ',
    ' . '\'table_6_group\'' . ',
    ' . '\'' . 'table_6_1_updatedusername' . '\'' . ',
    ' . '\'Setup\'' . ',
    ' . '\'' . 'table_6' . '\'' . ',
    ' . '\'' . 'Name' . '\'' . ', ' . $relationid_1 . ');
    ';
	$result = execSQL($con, $updateduseridref);
	$vieweduseridref = 'insert into formfieldreference values(
    ' . '\'Setup\'' . ',
    ' . '\'table_6_group\'' . ',
    ' . '\'' . 'table_6_2_viewedusername' . '\'' . ',
    ' . '\'Setup\'' . ',
    ' . '\'' . 'table_6' . '\'' . ',
    ' . '\'' . 'Name' . '\'' . ', ' . $relationid_2 . ');
    ';
	$result = execSQL($con, $vieweduseridref);

	$sql = "SELECT name,type FROM formfieldtable where formname = 'table_6_group' order by fieldorder ";
	$dbrows = getResultArray($con, $sql);
	$fieldorder = sizeof($dbrows) - 1;
	$sql = "update formfieldtable set fieldorder = $fieldorder where formname = 'table_6_group' and name = 'viewedon'";
	execSQL($con, $sql);
	$fieldorder--;
	$sql = "update formfieldtable set fieldorder = $fieldorder where formname = 'table_6_group' and name = 'table_6_2_viewedusername'";
	execSQL($con, $sql);
	$fieldorder--;
	$sql = "update formfieldtable set fieldorder = $fieldorder where formname = 'table_6_group' and name = 'updatedon'";
	execSQL($con, $sql);
	$fieldorder--;
	$sql = "update formfieldtable set fieldorder = $fieldorder where formname = 'table_6_group' and name = 'table_6_1_updatedusername'";
	execSQL($con, $sql);
	$fieldorder--;
	$sql = "update formfieldtable set fieldorder = $fieldorder where formname = 'table_6_group' and name = 'createdon'";
	execSQL($con, $sql);
	$fieldorder--;
	$sql = "update formfieldtable set fieldorder = $fieldorder where formname = 'table_6_group' and name = 'table_6_0_createdusername'";
	execSQL($con, $sql);
	$fieldorder--;

	for ($i = 0; $i < sizeof($dbrows); $i++) {
		$fieldname = $dbrows[$i][0];
		$ftype = $dbrows[$i][1];
		if ($ftype == "subtable") {
			$sql = "update formfieldtable set fieldorder = $fieldorder where formname = 'table_6_group' and name = '$fieldname'";
			execSQL($con, $sql);
			$fieldorder--;
		}
	}

	$sql = "update formfieldtable set fieldorder = 0,type = 'form_entityid' where formname = 'table_6_group' and name = 'table_6_group_id'";
	execSQL($con, $sql);
	$fieldorder--;
	$sql = "update formfieldtable set fieldorder = 1 where formname = 'table_6_group' and name = 'groupname'";
	execSQL($con, $sql);
	$fieldorder--;
	$sql = "update formfieldtable set fieldorder = 2 where formname = 'table_6_group' and name = 'description'";
	execSQL($con, $sql);
	$fieldorder--;
	$sql = "update formfieldtable set fieldorder = 3 where formname = 'table_6_group' and name = 'sellist'";
	execSQL($con, $sql);
	$fieldorder--;

	$nextid = getNextIdValue($con, 'searchtemplate', 'templateid');
	$sql = 'insert into searchtemplate (templateid,templatename,formname,username,searchfields,modulename,access_rights,viewfields, issystem)
        values (' . '\'' . $nextid . '\'' . ',' . '\'' . '' . '\'' . ',' . '\'table_6_group\'' . ',' . '\'' . 'sadmin' . '\'' . ',' . '\'' . '@' . '\'' . ',' . '\'Setup\'' . ',' . '\'' . '1' . '\'' . ', ' . '\'' . '' . '\'' . ', ' . '\'' . '1' . '\'' . ');';
	$result = execSQL($con, $sql);
	if ($result) {
		updateFormMaxId($con, 'searchtemplate', $nextid);
	}

	$sql = "update table_2_frmfields set fields = concat(fields,'#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$') where formname = 'table_6_group' and fields != ''";
	$result = execSQL($con, $sql);
}

function removeHistoryForms($con) {
	$sql = "select formname FROM formtable where modulename not in('History','Notes','Attachements','Reports','Settings','Setup','Scheduler','Reminder') and formtype in('','request') and ishistoryneeded=0;";
	$resultrow = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($resultrow); $i++) {
		try {
			deleteHistoryFormtable($con, $resultrow[$i][0], "History");
		} catch ( Exception $ex ) {
			debug("EXCEPTION : " . $ex);
		}
	}
	$sql = "SELECT formname FROM formtable where modulename='History'";
	$resultrow = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($resultrow); $i++) {
		$formtablename = $resultrow[$i][0];
		try {
			$sql = 'delete from formfieldreference where formname = ' . '\'' . $formtablename . '\'' . ' or refformname = ' . '\'' . $formtablename . '\'';
			$result = execSQL($con, $sql);
			insertSyncQueryDetails($con, "formfieldreference", "", SYNC_ACTION::$STRUC_DELETE, $sql, "");
			$sql = 'delete from formrelationtable where mtable = ' . '\'' . $formtablename . '\'' . ' or stable = ' . '\'' . $formtablename . '\'';
			$result = execSQL($con, $sql);
			insertSyncQueryDetails($con, "formrelationtable", "", SYNC_ACTION::$STRUC_DELETE, $sql, "");
			$sql = ' delete from formfieldtable where formname = ' . '\'' . $formtablename . '\'';
			$result = execSQL($con, $sql);
			insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_DELETE, $sql, "");
			$sql = ' delete from formfieldtable where formname = ' . '\'' . $formtablename . '\'';
			$result = execSQL($con, $sql);
			insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_DELETE, $sql, "");
			$sql = 'delete from formactiontable where formname = ' . '\'' . $formtablename . '\'';
			$result = execSQL($con, $sql);
			insertSyncQueryDetails($con, "formactiontable", "", SYNC_ACTION::$STRUC_DELETE, $sql, "");
			$sql = 'delete from table_2_frmscreen where formname in (' . '\'' . $formtablename . ',' . $formtablename . '\',\',' . $formtablename . '\',\'' . $formtablename . ',\')';
			$result = execSQL($con, $sql);
			insertSyncQueryDetails($con, "table_2_frmscreen", "", SYNC_ACTION::$STRUC_DELETE, $sql, "");
			$sql = 'delete from table_2_frmaction where formname = ' . '\'' . $formtablename . '\'';
			$result = execSQL($con, $sql);
			insertSyncQueryDetails($con, "table_2_frmaction", "", SYNC_ACTION::$STRUC_DELETE, $sql, "");
			$sql = 'delete from table_2_frmfields where formname = ' . '\'' . $formtablename . '\'';
			$result = execSQL($con, $sql);
			insertSyncQueryDetails($con, "table_2_frmfields", "", SYNC_ACTION::$STRUC_DELETE, $sql, "");
			$sql = 'delete from formtable where formname = ' . '\'' . $formtablename . '\'';
			$result = execSQL($con, $sql);
			insertSyncQueryDetails($con, "formtable", "", SYNC_ACTION::$STRUC_DELETE, $sql, "");
			$maintable = $formtablename . '_frm';
			$tablesql = "show tables like '$maintable';";
			$tablelist = getResultArray($con, $tablesql);
			if (sizeof($tablelist) > 0) {
				$sql = 'drop table ' . $maintable;
				$result = execSQL($con, $sql);
				insertSyncQueryDetails($con, $formtablename, "", SYNC_ACTION::$STRUC_FORM_DELETE, $sql, "");
			}
		} catch ( Exception $ex ) {
			debug("EXCEPTION : " . $ex);
		}
	}
}

function addMobileClientInLicense($con) {
	$sql = "select * from " . DBINFO::$APPDBNAME . ".featuretable where name = 'Mobile Client' ";
	$resultrow = getResultArray($con, $sql);
	if (sizeof($resultrow) == 0) {
		$sql = "insert into " . DBINFO::$APPDBNAME . ".featuretable values('19','2','Mobile Client','0','Addon')";
		$result = execSQL($con, $sql);
	} else {
		$sql = "update " . DBINFO::$APPDBNAME . ".featuretable set featureindex='19',parentfeatureindex=2 where name='Mobile Client'";
		$result = execSQL($con, $sql);
	}
}

function updateShiftTimeInOrgMaster($con) {
	$sql = "select max(cast(relationid as signed)) from formrelationtable";
	$resultrows = getResultArray($con, $sql);
	$mrel = $resultrows[0][0] + 1;
	$sql = "select fieldorder from formfieldtable where formname = 'table_21' and name = 'table_6_0_createdusername'";
	$result = getResultArray($con, $sql);
	$orgfieldorder = $result[0][0];
	$sql = "select fieldorder from formfieldtable where formname = 'table_39' and name = 'table_6_0_createdusername'";
	$result = getResultArray($con, $sql);
	$sftfieldorder = $result[0][0];
	$sql = "update formfieldtable set fieldorder = fieldorder + 1 where formname = 'table_21' and fieldorder >= $orgfieldorder";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder = fieldorder + 1 where formname = 'table_39' and fieldorder >= $sftfieldorder";
	$result = execSQL($con, $sql);

	$sql = "update formtable set style = 'g_root,g_root,0,1,0,0,0,0$" . "true,g_root,g_Company Details,0,2,0,0,0,0$" . "true,g_Company Details,f_1,0,0,0,0,0,0$" . "true,g_Company Details,f_2,1,0,0,0,0,0$" . "true,g_Company Details,f_9,2,0,0,0,0,0$" . "true,g_Company Details,f_10,3,0,0,0,0,0$" . "true,g_Company Details,f_13,4,0,0,0,0,0$" . "true,g_Company Details,f_14,5,0,0,0,0,0$" . "true,g_root,g_Contact Details,1,2,0,0,0,0$" . "true,g_Contact Details,f_3,0,0,0,0,0,0$" . "true,g_Contact Details,f_4,1,0,0,0,0,0$" . "true,g_Contact Details,f_5,2,0,0,0,0,0$" . "true,g_Contact Details,f_6,3,0,0,0,0,0$" . "true,g_Contact Details,f_7,4,0,0,0,0,0$" . "true,g_root,g_Global Settings,2,2,0,0,0,0$" . "true,g_Global Settings,f_11,0,0,0,0,0,0$" . "true,g_Global Settings,f_12,1,0,0,0,0,0$" . "true,g_Global Settings,f_18,2,0,0,0,0,0$" . "true,g_Global Settings,f_25,3,0,0,0,0,0$" . "true' where formname = 'table_21'";
	$result = execSQL($con, $sql);

	$sql = "insert into formfieldtable values
         ('Setup', 'table_39', 'table_21_0_table_21', 'Shift Timing', 'subtable', '40', '', '', '', '', '0', '0', '100', '200', '150', '0','0', 'Normal', 'Advanced', '', '1', '0', '$sftfieldorder', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', $mrel+1),
        ('Setup', 'table_21', 'table_39_0_table_39_id', 'Shift Timing', 'reference', '40', '', '', '', '', '0', '0', '100', '200','150', '0', '0', 'Normal', 'Advanced', '', '1', '0', '$orgfieldorder', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', $mrel);";
	$result = execSQL($con, $sql);

	$sql = "update table_2_frmfields set fields = concat(fields,'#table_39_0_table_39_id,table_39_0_table_39_id#1,1$') where formname = 'table_21' and fields != ''";
	$result = execSQL($con, $sql);

	$sql = "insert into formrelationtable values
        ($mrel,$mrel+1,0, 'table_21', 'table_39', 'n-1', '', 0, ''),
        ($mrel+1,$mrel,3, 'table_39', 'table_21', '1-n', '', 0, '');";
	$result = execSQL($con, $sql);
	$sql = "insert into formfieldreference values
        ('Setup','table_21','table_39_0_table_39_id','Setup','table_39','Start_Time', $mrel),
        ('Setup','table_39','table_21_0_table_21','Setup','table_21','', $mrel+1);";
	$result = execSQL($con, $sql);
	$sql = "insert into fetchallfilterreference values('table_21', 'table_39_0_table_39_id', '', '0', '');";
	$result = execSQL($con, $sql);

	$sql = "alter table table_39_frm add 0table_21_id varchar(30) after `0table_6_id`;";
	$result = execSQL($con, $sql);
	$sql = "alter table table_21_frm add table_39_0_table_39_id varchar(30) after `appid`;";
	$result = execSQL($con, $sql);
	$sql = "alter table table_21_frm add CONSTRAINT `table_21_frmtable_39_0_table_39_id` foreign key(table_39_0_table_39_id) references table_39_frm(table_39_id);";
	$result = execSQL($con, $sql);
	$sql = "create table `0table_39_table_21_frm` (table_39_id varchar(30), table_21_id varchar(30)) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$result = execSQL($con, $sql);
}

function migrateHistoryTables($con) {
	$sql = "update formfieldtable set type='Date_Time_Text' where name='Time_Taken';";
	$result = execSQL($con, $sql);
	$sql = "select formname FROM formfieldtable where name='Time_Taken'";
	$resultrows = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($resultrows); $i++) {
		$formtablename = $resultrows[$i][0] . "_frm";
		$sql = "alter table $formtablename modify column Time_Taken varchar(50);";
		$result = execSQL($con, $sql);
	}
}

function createUserUsageReport($con) {
	$sql = "select max(cast(relationid as signed)) from formrelationtable;";
	$result = getResultArray($con, $sql);
	$mrel = $result[0][0] + 1;

	$sql = "INSERT INTO formtable VALUES ('Setup','table_49','Userwise Usage Details','',0,'',0,0,0,1,0,'USer-Status.png','g_root,g_root,0,1,0,0,0,0$true,g_root,g_Usage Details,0,2,0,0,0,0$true,g_Usage Details,f_1,0,0,0,0,0,0$true,g_Usage Details,f_5,1,0,0,0,0,0$true,g_Usage Details,f_2,2,0,0,0,0,0$true,g_Usage Details,f_4,3,0,0,0,0,0$true,g_Usage Details,f_6,4,0,0,0,0,0$true,g_Usage Details,f_7,5,0,0,0,0,0$true,g_Usage Details,f_8,6,0,0,0,0,0$true,g_Usage Details,f_9,7,0,0,0,0,0$true',0,0,0,0,0,0,0,0,0,'','',0,0,0,1,0);";
	$result = execSQL($con, $sql);

	$sql = "INSERT INTO `idgenerator` VALUES ('table_49_frm','0');";
	$result = execSQL($con, $sql);

	$sql = "insert into formfieldtable values
('Setup', 'table_49', 'User', 'User', 'Text', '40', '', '', '', '', '0', '0', 100, 100, 100, '0', '0', 'Normal', 'Advanced', '', '1', '1', '1', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
('Setup', 'table_49', 'Total', 'Total', 'Int', '40', '', '', '', '', '0', '0', 100, 100, 100, '0', '0', 'Normal', 'Advanced', '', '1', '1', '2', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
('Setup', 'table_49', 'Forms', 'Forms', 'Text', '40', '', '', '', '', '0', '0', 100, 100, 100, '0', '0', 'Normal', 'Advanced', '', '1', '1', '3', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
('Setup', 'table_49', 'Last_Usage_Details', 'Last Usage Details', 'Date_Time', '40', '', '', '', '', '0', '0', 100, 100, 100, '0', '0', 'Normal', 'Advanced', '', '1', '1', '4', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),

('Setup', 'table_49', 'table_6_0_createdusername', 'Created Username', 'form_history', '40', '', '', '', '', '1', '1',100, 100, 100, '0', '0', 'Auto', 'Advanced', '', '1', '1', '5', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', '1'),
('Setup', 'table_49', 'createdon', 'Created Time', 'form_history', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0','Auto', 'Advanced', '', '1', '1', '6', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
('Setup', 'table_49', 'table_6_1_updatedusername', 'Updated Username', 'form_history', '40', '', '', '', '', '1', '1',100, 100, 100, '0', '0', 'Auto', 'Advanced', '', '1', '1', '7', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', '2'),
('Setup', 'table_49', 'updatedon', 'Updated Time', 'form_history', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0','Auto', 'Advanced', '', '1', '1', '8', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL),
('Setup', 'table_49', 'table_6_2_viewedusername', 'Viewed Username', 'form_history', '40', '', '', '', '', '1', '1',100, 100, 100, '0', '0', 'Auto', 'Advanced', '', '1', '1', '9', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', '3'),
('Setup', 'table_49', 'viewedon', 'Viewed Time', 'form_history', '40', '', '', '', '', '1', '1', 100, 100, 100, '0', '0','Auto', 'Advanced', '', '1', '1', '10', '0', '0', '0', 0, 0, '', 1, 0, 0, 0, 'ALL', NULL);";
	$result = execSQL($con, $sql);

	$sql = "INSERT INTO `formactiontable` VALUES ('Setup','table_49','Add','Add',1,'',0),('Setup','table_49','Calendar','Calendar',1,'',5),('Setup','table_49','Delete','Delete',1,'',2),('Setup','table_49','Edit','Edit',1,'',1),('Setup','table_49','Export','Export',1,'',7),('Setup','table_49','Import','Import',1,'',6),('Setup','table_49','Print','Print',1,'',8),('Setup','table_49','Search','Search',1,'',4),('Setup','table_49','View','View',1,'',3);";
	$result = execSQL($con, $sql);
	$sql = "INSERT INTO `formfieldreference` VALUES ('Setup','table_49','table_6_0_createdusername','Setup','table_6','Name',$mrel),('Setup','table_49','table_6_1_updatedusername','Setup','table_6','Name',$mrel+1),('Setup','table_49','table_6_2_viewedusername','Setup','table_6','Name',$mrel+2);";
	$result = execSQL($con, $sql);
	$sql = "INSERT INTO `formrelationtable` VALUES ($mrel,$mrel,0,'table_49','table_6','n-1','',0,''),($mrel+1,$mrel+1,1,'table_49','table_6','n-1','',0,''),($mrel+2,$mrel+2,2,'table_49','table_6','n-1','',0,'');";
	$result = execSQL($con, $sql);

	$sql = "insert into table_2_frmscreen values('super admin profile','Setup','table_49,table_49');
INSERT INTO `table_2_frmfields` VALUES ('super admin profile','Setup','table_49','table_49_id,table_49_id#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$#User,User#1,1$#Total,Total#1,1$#Forms,Forms#1,1$#Last_Usage_Details,Last_Usage_Details#1,1$#Date,Date#1');";
	$result = execSQL($con, $sql);
	$sql = "INSERT INTO `table_2_frmaction` VALUES ('super admin profile','Setup','table_49','ScreenAccess,ScreenAccess#ScreenAccess,ScreenAccess#Add,Add#Edit,Edit#Delete,Delete#View,View#Search,Search#Calendar,Calendar#Import,Import#Export,Export#Print,Print#');";
	$result = execSQL($con, $sql);

	$sql = "CREATE TABLE `table_49_frm` (
  `table_49_id` varchar(40) NOT NULL,
  `table_6_0_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `createdon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `User` varchar(40) DEFAULT NULL,
  `Total` varchar(40) DEFAULT NULL,
  `Forms` varchar(40) DEFAULT NULL,
  `Last_Usage_Details` varchar(40) DEFAULT NULL,
  `table_6_1_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `updatedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `table_6_2_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `viewedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`table_49_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$result = execSQL($con, $sql);

	$sql = "select max(cast(reportid as signed)) from reportform FOR UPDATE ;";
	$result = getResultArray($con, $sql);
	$reportid = $result[0][0];
	$reportid = $reportid + 1;

	$sql = "insert into reportform values($reportid, '0',  'Daily Usage Details','','','','','', 'Table', 0,'USer-Status.png',0, 0, 0, '','1','214-10-15 17:46:06','0','Setup','table_49');";
	$result = execSQL($con, $sql);

	$sql = "select max(cast(groupid as signed)) from reportgrouptable FOR UPDATE ; ";
	$result = getResultArray($con, $sql);
	$groupid = $result[0][0];
	$groupid = $groupid + 1;

	$sql = "insert into reportgrouptable values($reportid,'Daily Usage Details', $groupid, 0);";
	$result = execSQL($con, $sql);

	$sql = "insert into reportgroupdetailtable
    values ($groupid,'Setup','table_49', 'User','1','0','0');";
	$result = execSQL($con, $sql);

	$sql = "insert into reportfieldtable values($reportid,'Setup', 'table_49', 'User', '', '','0','0','100','','','','','0');";
	$result = execSQL($con, $sql);

	$sql = "insert into reportfieldtable values($reportid,'Setup', 'table_49', 'Total', '', '','0','0','100','','','','','1');";
	$result = execSQL($con, $sql);

	$sql = "insert into reportfieldtable values($reportid,'Setup', 'table_49', 'Forms', '', '','0','0','100','','','','','2');";
	$result = execSQL($con, $sql);

	$sql = "insert into reportfieldtable values($reportid,'Setup', 'table_49', 'Last_Usage_Details', '', '','0','0','100','','','','','3');";
	$result = execSQL($con, $sql);

	$sql = "insert into reportfilterfieldtable values($reportid,'Setup', 'table_49', 'User','0');";
	$result = execSQL($con, $sql);
	$sql = "insert into reportfilterfieldtable values($reportid,'Setup', 'table_49', 'Forms','1');";
	$result = execSQL($con, $sql);
	$sql = "insert into reportfilterfieldtable values($reportid,'Setup', 'table_49', 'Last_Usage_Details','2');";
	$result = execSQL($con, $sql);
	// $sql = "insert into reportfilterfieldvaluetable values($reportid,'Setup', 'table_49', 'Date','Today', '214-05-14#214-05-14','',0);";
	// $result = execSQL($con, $sql);

	$sql = "delete from reportmodule where reportid=$reportid;";
	$result = execSQL($con, $sql);

	$sql = " insert into reportmodule values( 'System Reports', $reportid);";
	$result = execSQL($con, $sql);

	$sql = "delete from reportsubmodule where reportid=$reportid;";
	$result = execSQL($con, $sql);

	$sql = "insert into reportsubmodule values( '', $reportid);";
	$result = execSQL($con, $sql);

	$sql = "delete from reportaccesstable where reportid=$reportid;";
	$result = execSQL($con, $sql);
}

function createProductionAndCleaningDetailsReport($con) {
	if (DinamalarReportDetails::$IS_DINAMALAR_APP) {
		$sql = "select max(cast(reportid as signed)) from reportform FOR UPDATE ;";
		$result = getResultArray($con, $sql);
		$reportid = $result[0][0];
		$reportid = $reportid + 1;

		$sql = "insert into reportform values($reportid, '0',  'Production Details','','','','','', 'Table', 0,'USer-Status.png',0, 0, 0, '','1','2014-11-15 17:46:06','0','Master','table_201');";
		$result = execSQL($con, $sql);

		$sql = "insert into reportfieldtable values($reportid,'Master', 'table_201', 'Date', '', '','0','0','100','','','','','0');";
		$result = execSQL($con, $sql);

		$sql = "insert into reportfieldtable values($reportid,'Master', 'table_201', 'Total_KW', '', '','0','0','100','','','','','1');";
		$result = execSQL($con, $sql);

		$sql = "insert into reportfieldtable values($reportid,'Master', 'table_201', 'Total_EBR', '', '','0','0','100','','','','','2');";
		$result = execSQL($con, $sql);

		$sql = "delete from reportmodule where reportid=$reportid;";
		$result = execSQL($con, $sql);

		$sql = " insert into reportmodule values( 'Mailer Reports', $reportid);";
		$result = execSQL($con, $sql);

		$sql = "delete from reportsubmodule where reportid=$reportid;";
		$result = execSQL($con, $sql);

		$sql = "insert into reportsubmodule values( '', $reportid);";
		$result = execSQL($con, $sql);

		$sql = "delete from reportaccesstable where reportid=$reportid;";
		$result = execSQL($con, $sql);

		// Cleanning Detail Report
		$reportid = $reportid + 1;

		$sql = "insert into reportform values($reportid, '0',  'Cleaning Details','','','','','', 'Table', 0,'USer-Status.png',0, 0, 0, '','1','2014-11-15 17:46:06','0','Master','" . DinamalarReportDetails::$CLEANING_DETAILS_FORMNAME . "');";
		$result = execSQL($con, $sql);

		$sql = "insert into reportfieldtable values($reportid,'Master', '" . DinamalarReportDetails::$CLEANING_DETAILS_FORMNAME . "', 'Date', '', '','0','0','100','','','','','0');";
		$result = execSQL($con, $sql);

		$sql = "insert into reportfieldtable values($reportid,'Master', '" . DinamalarReportDetails::$CLEANING_DETAILS_FORMNAME . "', 'Segments', '', '','0','0','100','','','','','1');";
		$result = execSQL($con, $sql);

		$sql = "insert into reportfieldtable values($reportid,'Master', '" . DinamalarReportDetails::$CLEANING_DETAILS_FORMNAME . "', 'Row', '', '','0','0','100','','','','','2');";
		$result = execSQL($con, $sql);

		$sql = "insert into reportfieldtable values($reportid,'Master', '" . DinamalarReportDetails::$CLEANING_DETAILS_FORMNAME . "', 'Row_No', '', '','0','0','100','','','','','2');";
		$result = execSQL($con, $sql);

		$sql = "delete from reportmodule where reportid=$reportid;";
		$result = execSQL($con, $sql);

		$sql = " insert into reportmodule values( 'Mailer Reports', $reportid);";
		$result = execSQL($con, $sql);

		$sql = "delete from reportsubmodule where reportid=$reportid;";
		$result = execSQL($con, $sql);

		$sql = "insert into reportsubmodule values( '', $reportid);";
		$result = execSQL($con, $sql);

		$sql = "delete from reportaccesstable where reportid=$reportid;";
		$result = execSQL($con, $sql);
	}
}

function createTeamandTerritoryForm($con) {
	$sql = "CREATE TABLE `table_50_frm` (
  `table_50_id` varchar(40) NOT NULL,
  `table_6_0_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `createdon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Name` varchar(40) DEFAULT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `table_6_1_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `updatedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `table_6_2_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `viewedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`table_50_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_50", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");

	$sql = "CREATE TABLE `table_51_frm` (
  `table_51_id` varchar(40) NOT NULL,
  `table_6_0_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `createdon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Name` varchar(40) DEFAULT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `table_6_1_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `updatedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `table_6_2_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `viewedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`table_51_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_51", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "SELECT max(relationid) FROM formrelationtable;";
	$result = getResultArray($con, $sql);
	$maxrelation = $result[0][0];

	$sql = "INSERT INTO `formtable` VALUES ('Setup','table_50','Team','',0,'',0,0,'1,1',1,0,'ficon.png','g_root,g_root,0,1,0,0,0,0$true,g_root,g_Basic Information,0,2,0,0,0,0$true,g_Basic Information,f_1,0,0,0,0,0,0$true,g_Basic Information,f_2,1,0,0,0,0,0$true',0,0,0,0,0,0,0,0,0,'','',0,0,0,1,0),('Setup','table_51','Territory','',0,'',0,0,'1,1',1,0,'ficon.png','g_root,g_root,0,1,0,0,0,0$true,g_root,g_Basic Information,0,2,0,0,0,0$true,g_Basic Information,f_1,0,0,0,0,0,0$true,g_Basic Information,f_2,1,0,0,0,0,0$true',0,0,0,0,0,0,0,0,0,'','',0,0,0,1,0);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "INSERT INTO `formfieldtable` VALUES ('Setup','table_50','createdon','Created Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,4,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Setup','table_50','Description','Description','Text Area','1000','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,2,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Setup','table_50','Name','Name','Text','40','','','','',0,0,100,200,150,0,0,'Normal','ALL','',1,0,1,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Setup','table_50','table_50_id','table_50_id','form_entityid','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,0,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Setup','table_50','table_6_0_createdusername','Created Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,3,0,0,0,0,0,'',1,0,0,0,'ALL',$maxrelation+1),('Setup','table_50','table_6_1_updatedusername','Updated Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,5,0,0,0,0,0,'',1,0,0,0,'ALL',$maxrelation+2),('Setup','table_50','table_6_2_viewedusername','Viewed Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,7,0,0,0,0,0,'',1,0,0,0,'ALL',$maxrelation+3),('Setup','table_50','updatedon','Updated Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,6,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Setup','table_50','viewedon','Viewed Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,8,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Setup','table_51','createdon','Created Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,4,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Setup','table_51','Description','Description','Text Area','1000','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,2,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Setup','table_51','Name','Name','Text','40','','','','',0,0,100,200,150,0,0,'Normal','ALL','',1,0,1,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Setup','table_51','table_51_id','table_51_id','form_entityid','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,0,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Setup','table_51','table_6_0_createdusername','Created Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,3,0,0,0,0,0,'',1,0,0,0,'ALL',$maxrelation+4),('Setup','table_51','table_6_1_updatedusername','Updated Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,5,0,0,0,0,0,'',1,0,0,0,'ALL',$maxrelation+5),('Setup','table_51','table_6_2_viewedusername','Viewed Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,7,0,0,0,0,0,'',1,0,0,0,'ALL',$maxrelation+6),('Setup','table_51','updatedon','Updated Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,6,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Setup','table_51','viewedon','Viewed Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,8,0,0,0,0,0,'',1,0,0,0,'ALL',NULL);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "INSERT INTO `formactiontable` VALUES ('Setup','table_50','Add','Add',1,'',0),('Setup','table_50','Calendar','Calendar',1,'',5),('Setup','table_50','Customize','Customize',1,'',9),('Setup','table_50','Delete','Delete',1,'',2),('Setup','table_50','Edit','Edit',1,'',1),('Setup','table_50','Export','Export',1,'',7),('Setup','table_50','Import','Import',1,'',6),('Setup','table_50','Print','Print',1,'',8),('Setup','table_50','Search','Search',1,'',4),('Setup','table_50','View','View',1,'',3),('Setup','table_51','Add','Add',1,'',0),('Setup','table_51','Calendar','Calendar',1,'',5),('Setup','table_51','Customize','Customize',1,'',9),('Setup','table_51','Delete','Delete',1,'',2),('Setup','table_51','Edit','Edit',1,'',1),('Setup','table_51','Export','Export',1,'',7),('Setup','table_51','Import','Import',1,'',6),('Setup','table_51','Print','Print',1,'',8),('Setup','table_51','Search','Search',1,'',4),('Setup','table_51','View','View',1,'',3);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formactiontable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "INSERT INTO `table_2_frmfields` VALUES ('super admin profile','Setup','table_50','#table_50_id,table_50_id#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$#Name,Name#1,1$#Description,Description#1,1$'),('super admin profile','Setup','table_51','#table_51_id,table_51_id#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$#Name,Name#1,1$#Description,Description#1,1$');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_2_frmfields", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "INSERT INTO `table_2_frmaction` VALUES ('super admin profile','Setup','table_50','ScreenAccess,ScreenAccess#Add,Add#Edit,Edit#Delete,Delete#View,View#Search,Search#Calendar,Calendar#Import,Import#Export,Export#Print,Print#Customize,Customize#'),('super admin profile','Setup','table_51','ScreenAccess,ScreenAccess#Add,Add#Edit,Edit#Delete,Delete#View,View#Search,Search#Calendar,Calendar#Import,Import#Export,Export#Print,Print#Customize,Customize#');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_2_frmaction", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "INSERT INTO `table_2_frmscreen` VALUES ('super admin profile','Setup','table_50,table_50'),('super admin profile','Setup','table_51,table_51');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_2_frmscreen", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "INSERT INTO `idgenerator` VALUES ('table_50_frm','0'),('table_51_frm','0');";
	$result = execSQL($con, $sql);
	$sql = 'insert into formfieldreference values
        (' . '\'' . 'Setup' . '\'' . ',' . '\'table_50\'' . ',' . '\'' . 'table_6_0_createdusername' . '\'' . ',' . '\'' . 'Setup' . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . 'Name' . '\'' . ',' . ($maxrelation + 1) . '),
        (' . '\'' . 'Setup' . '\'' . ',' . '\'table_50\'' . ',' . '\'' . 'table_6_1_updatedusername' . '\'' . ',' . '\'' . 'Setup' . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . 'Name' . '\'' . ',' . ($maxrelation + 2) . '),
        (' . '\'' . 'Setup' . '\'' . ',' . '\'table_50\'' . ',' . '\'' . 'table_6_2_viewedusername' . '\'' . ',' . '\'' . 'Setup' . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . 'Name' . '\'' . ',' . ($maxrelation + 3) . '),
        (' . '\'' . 'Setup' . '\'' . ',' . '\'table_51\'' . ',' . '\'' . 'table_6_0_createdusername' . '\'' . ',' . '\'' . 'Setup' . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . 'Name' . '\'' . ',' . ($maxrelation + 4) . '),
        (' . '\'' . 'Setup' . '\'' . ',' . '\'table_51\'' . ',' . '\'' . 'table_6_1_updatedusername' . '\'' . ',' . '\'' . 'Setup' . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . 'Name' . '\'' . ',' . ($maxrelation + 5) . '),
        (' . '\'' . 'Setup' . '\'' . ',' . '\'table_51\'' . ',' . '\'' . 'table_6_2_viewedusername' . '\'' . ',' . '\'' . 'Setup' . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . 'Name' . '\'' . ',' . ($maxrelation + 6) . ')';
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldreference", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = 'insert into formrelationtable values
        (' . ($maxrelation + 1) . ',' . ($maxrelation + 1) . ',0,' . '\'' . 'table_50' . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . 'n-1' . '\'' . ', ' . '\'' . '' . '\'' . ',0,' . '\'' . '' . '\'' . '),
        (' . ($maxrelation + 2) . ',' . ($maxrelation + 2) . ',1,' . '\'' . 'table_50' . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . 'n-1' . '\'' . ', ' . '\'' . '' . '\'' . ',0,' . '\'' . '' . '\'' . '),
        (' . ($maxrelation + 3) . ',' . ($maxrelation + 3) . ',2,' . '\'' . 'table_50' . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . 'n-1' . '\'' . ', ' . '\'' . '' . '\'' . ',0,' . '\'' . '' . '\'' . '),
        (' . ($maxrelation + 4) . ',' . ($maxrelation + 4) . ',0,' . '\'' . 'table_51' . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . 'n-1' . '\'' . ', ' . '\'' . '' . '\'' . ',0,' . '\'' . '' . '\'' . '),
        (' . ($maxrelation + 5) . ',' . ($maxrelation + 5) . ',1,' . '\'' . 'table_51' . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . 'n-1' . '\'' . ', ' . '\'' . '' . '\'' . ',0,' . '\'' . '' . '\'' . '),
        (' . ($maxrelation + 6) . ',' . ($maxrelation + 6) . ',2,' . '\'' . 'table_51' . '\'' . ',' . '\'' . 'table_6' . '\'' . ',' . '\'' . 'n-1' . '\'' . ', ' . '\'' . '' . '\'' . ',0,' . '\'' . '' . '\'' . ')';
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formrelationtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
}

function createActivityForm($con) {
	$sql = "CREATE TABLE `table_52_frm` (
  `table_52_id` varchar(40) NOT NULL,
  `table_6_0_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `createdon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Due_Date` date DEFAULT NULL,
  `table_6_3_table_6_id` varchar(30) DEFAULT NULL,
  `table_6_3_table_6_group_id` varchar(30) DEFAULT NULL,
  `Subject` varchar(1000) DEFAULT NULL,
  `Status` varchar(40) DEFAULT NULL,
  `Planned_Start` varchar(40) DEFAULT NULL,
  `Planned_End` varchar(40) DEFAULT NULL,
  `Actual_Start` varchar(40) DEFAULT NULL,
  `Actual_End` varchar(40) DEFAULT NULL,
  `Planned_Hours` varchar(50) DEFAULT NULL,
  `Actual_Hours` varchar(50) DEFAULT NULL,
  `Comments` varchar(2000) DEFAULT NULL,
  `table_6_1_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `updatedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `table_6_2_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `viewedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`table_52_id`),
  KEY `table_52_frmtable_6_3_table_6_id` (`table_6_3_table_6_id`),
  KEY `table_52_frmtable_6_3_table_6_group_id` (`table_6_3_table_6_group_id`),
  CONSTRAINT `table_52_frmtable_6_3_table_6_group_id` FOREIGN KEY (`table_6_3_table_6_group_id`) REFERENCES `table_6_group_frm` (`table_6_group_id`),
  CONSTRAINT `table_52_frmtable_6_3_table_6_id` FOREIGN KEY (`table_6_3_table_6_id`) REFERENCES `table_6_frm` (`table_6_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_52", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");

	$sql = "alter table table_6_frm add column `3table_52_id` varchar(4000) DEFAULT NULL;";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_52", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");

	$sql = "CREATE TABLE `3table_6_table_52_frm` (
  `table_6_id` varchar(30) DEFAULT NULL,
  `table_52_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_52", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");

	$sql = "SELECT max(relationid) FROM formrelationtable;";
	$result = getResultArray($con, $sql);
	$maxrelation = $result[0][0];
	$sql = "select * from moduletable where name='Tasks'";
	$modulearr = getResultArray($con, $sql);
	$modulename = "Tasks";
	if (sizeof($modulearr) == 0) {
		$sql = "select max(cast(moduleorder as unsigned)) from moduletable";
		$moduleorderarr = getResultArray($con, $sql);
		$moduleorder = $moduleorderarr[0][0];
		$sql = "insert into moduletable values('$modulename','micon.png','$moduleorder+1')";
		$result = execSQL($con, $sql);
		insertSyncQueryDetails($con, "moduletable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	}
	$sql = "INSERT INTO `formtable` VALUES ('$modulename','table_52','Activity','',0,'',0,0,'1,1',1,0,'notes.png','g_root,g_root,0,1,0,0,0,0$true,g_root,g_Basic Information,0,2,0,0,0,0$true,g_Basic Information,f_4,0,0,0,0,0,0$true,g_Basic Information,f_1,1,0,0,0,0,0$true,g_Basic Information,f_2,2,0,0,0,0,0$true,g_Basic Information,f_5,3,0,0,0,0,0$true,g_root,g_Hours Information,1,2,0,0,0,0$true,g_Hours Information,f_6,0,0,0,0,0,0$true,g_Hours Information,f_7,1,0,0,0,0,0$true,g_Hours Information,f_8,2,0,0,0,0,0$true,g_Hours Information,f_9,3,0,0,0,0,0$true,g_Hours Information,f_10,4,0,0,0,0,0$true,g_Hours Information,f_11,5,0,0,0,0,0$true,g_root,g_Comments,2,1,0,0,0,0$true,g_Comments,f_12,0,0,0,0,0,0$true',0,0,0,0,0,0,0,0,0,'','',0,1,0,1,0);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");

	$sql = "delete from picklisttable where name='Activity Status'";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "picklisttable", "", SYNC_ACTION::$STRUC_DELETE, $sql, "");

	$sql = "INSERT INTO `picklisttable` VALUES ('Activity Status','Closed',2,'0','2015-02-18 10:31:24','0'),('Activity Status','Open',0,'0','2015-02-18 10:31:24','0'),('Activity Status','Progress',1,'0','2015-02-18 10:31:24','0');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "picklisttable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "select max(fieldorder) from formfieldtable where formname='table_6' and type not in ('form_history');";
	$result = getResultArray($con, $sql);
	$maxfieldorder = $result[0][0];
	$maxfieldorder = $maxfieldorder + 1;
	$sql = "INSERT INTO `formfieldtable` VALUES ('$modulename','table_52','Actual_End','Actual End','Date_Time','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,9,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('$modulename','table_52','Actual_Hours','Actual Hours','Date_Time_Text','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,11,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('$modulename','table_52','Actual_Start','Actual Start','Date_Time','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,8,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('$modulename','table_52','Comments','Comments','Text Area','2000','','','','',0,0,100,500,300,0,0,'Normal','Advanced','',1,0,12,0,0,1,0,0,'',0,0,0,0,'ALL',NULL),('$modulename','table_52','createdon','Created Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,14,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('$modulename','table_52','Due_Date','Due Date','date','40','','','','',0,0,100,200,150,0,1,'Normal','Advanced','current',1,0,1,0,0,1,0,0,'',1,0,0,0,'ALL',NULL),('$modulename','table_52','Planned_End','Planned End','Date_Time','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,7,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('$modulename','table_52','Planned_Hours','Planned Hours','Date_Time_Text','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,10,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('$modulename','table_52','Planned_Start','Planned Start','Date_Time','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','current',1,0,6,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('$modulename','table_52','Status','Status','ComboBox','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','Activity Status,Open',1,0,5,0,0,1,0,0,'',1,0,0,0,'ALL',NULL),('$modulename','table_52','Subject','Subject','Text','1000','','','','',0,0,100,500,300,0,1,'Normal','Advanced','',1,0,4,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('$modulename','table_52','table_52_id','table_52_id','form_entityid','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,0,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('$modulename','table_52','table_6_0_createdusername','Created Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,13,0,0,0,0,0,'',1,0,0,0,'ALL',$maxrelation+1),('$modulename','table_52','table_6_1_updatedusername','Updated Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,15,0,0,0,0,0,'',1,0,0,0,'ALL',$maxrelation+2),('$modulename','table_52','table_6_2_viewedusername','Viewed Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,17,0,0,0,0,0,'',1,0,0,0,'ALL',$maxrelation+3),('$modulename','table_52','table_6_3_table_6_group_id','Assigned to group','reference_group','40','','','','',1,1,100,200,150,0,0,'Normal','Advanced','current',1,0,3,0,0,0,0,0,'',1,0,0,0,'ALL',$maxrelation+6),('$modulename','table_52','table_6_3_table_6_id','Assigned To','entity_group','40','','','','',0,0,100,200,150,0,1,'Normal','Advanced','current',1,0,2,0,0,1,0,0,'',1,0,0,0,'ALL',$maxrelation+4),('$modulename','table_52','updatedon','Updated Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,16,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('$modulename','table_52','viewedon','Viewed Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,18,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
	('Setup','table_6','table_52_3_table_52','Activity','subtable','40','','','','',1,0,100,200,150,0,0,'Normal','Advanced','current',1,0,$maxfieldorder,0,0,0,0,0,'',1,0,0,0,'ALL',$maxrelation+5),
	('Setup','table_6_group','table_52_0_table_52','Activity','subtable','40','','','','',1,1,100,200,150,0,0,'Normal','Advanced','current',1,0,4,0,0,0,0,0,'',1,0,0,0,'ALL',$maxrelation+7);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "update formfieldtable set fieldorder=fieldorder+1 where formname='table_6' and type in
('form_history')";
	execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "INSERT INTO `formactiontable` VALUES ('$modulename','table_52','Add','Add',1,'',0),('$modulename','table_52','Calendar','Calendar',1,'',5),('$modulename','table_52','Customize','Customize',1,'',9),('$modulename','table_52','Delete','Delete',1,'',2),('$modulename','table_52','Edit','Edit',1,'',1),('$modulename','table_52','Export','Export',1,'',7),('$modulename','table_52','Import','Import',1,'',6),('$modulename','table_52','Print','Print',1,'',8),('$modulename','table_52','Search','Search',1,'',4),('$modulename','table_52','View','View',1,'',3);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formactiontable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");

	$sql = "INSERT INTO `table_2_frmfields` VALUES ('super admin profile','$modulename','table_52','#table_52_id,table_52_id#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$#Due_Date,Due_Date#1,1$#table_6_3_table_6_id,table_6_3_table_6_id#1,1$#table_6_3_table_6_group_id,table_6_3_table_6_group_id#1,1$#Subject,Subject#1,1$#Status,Status#1,1$#Planned_Start,Planned_Start#1,1$#Planned_End,Planned_End#1,1$#Actual_Start,Actual_Start#1,1$#Actual_End,Actual_End#1,1$#Planned_Hours,Planned_Hours#1,1$#Actual_Hours,Actual_Hours#1,1$#Comments,Comments#1,1$');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_2_frmfields", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");

	$sql = "INSERT INTO `table_2_frmaction` VALUES ('super admin profile','$modulename','table_52','ScreenAccess,ScreenAccess#Add,Add#Edit,Edit#Delete,Delete#View,View#Search,Search#Calendar,Calendar#Import,Import#Export,Export#Print,Print#Customize,Customize#');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_2_frmaction", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");

	$sql = "INSERT INTO `table_2_frmscreen` VALUES ('super admin profile','$modulename','table_52,table_52');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_2_frmscreen", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");

	$sql = "INSERT INTO `idgenerator` VALUES ('table_52_frm','0');";
	$result = execSQL($con, $sql);

	$sql = "INSERT INTO `formfieldreference` VALUES ('$modulename','table_52','table_6_0_createdusername','Setup','table_6','Name',$maxrelation+1),('$modulename','table_52','table_6_1_updatedusername','Setup','table_6','Name',$maxrelation+2),('$modulename','table_52','table_6_2_viewedusername','Setup','table_6','Name',$maxrelation+3),('$modulename','table_52','table_6_3_table_6_group_id','Setup','table_6_group','groupname',$maxrelation+6),('$modulename','table_52','table_6_3_table_6_id','Setup','table_6','Name',$maxrelation+4),
	('Setup','table_6','table_52_3_table_52','$modulename','table_52','',$maxrelation+5),
	('Setup','table_6_group','table_52_0_table_52','$modulename','table_52','',$maxrelation+7);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldreference", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");

	$sql = "INSERT INTO `formrelationtable` VALUES
	($maxrelation+1,$maxrelation+1,0,'table_52','table_6','n-1','',0,''),($maxrelation+2,$maxrelation+2,1,'table_52','table_6','n-1','',0,''),($maxrelation+3,$maxrelation+3,2,'table_52','table_6','n-1','',0,''),($maxrelation+4,$maxrelation+5,3,'table_52','table_6','n-1','',1,''),($maxrelation+5,$maxrelation+4,3,'table_6','table_52','1-n','',1,''),($maxrelation+6,$maxrelation+7,0,'table_52','table_6_group','n-1','',1,''),($maxrelation+7,$maxrelation+6,0,'table_6_group','table_52','1-n','',1,'');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formrelationtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");

	$sql = "SELECT max(templateid) FROM searchtemplate ";
	$result = getResultArray($con, $sql);
	$maxtempid = $result[0][0];

	$sql = "INSERT INTO `searchtemplate` VALUES ('','table_52','sadmin','@','Setup',1,'',$maxtempid+1,1,1,0,NULL,'0'),('All records','table_52','sadmin','@','Setup',1,'',$maxtempid+2,1,1,0,NULL,'0'),('My records','table_52','sadmin','@','Setup',1,'',$maxtempid+3,1,1,0,NULL,'0'),('Todays records','table_52','sadmin','@','Setup',1,'',$maxtempid+4,1,1,0,NULL,'0'),('Recently Created','table_52','sadmin','@','Setup',1,'',$maxtempid+5,1,1,0,NULL,'0'),('Recently Updated','table_52','sadmin','@','Setup',1,'',$maxtempid+6,1,1,0,NULL,'0'),('Recently Viewed','table_52','sadmin','@','Setup',1,'',$maxtempid+7,1,1,0,NULL,'0');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "searchtemplate", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
}

function addAdditionalSetupFields($con) {
	$sql = "update formtable set labelname='Account Usage' where formname='table_38'";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formfieldtable set ismandatory=0 where formname='table_6' and name='loginid'";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formfieldtable set label='Role' where formname='table_6' and name='table_4_0_table_4_id';";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formfieldtable set label='Access' where formname='table_6' and name='table_2_0_table_2_id';";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formfieldtable set label='Name' where formname='table_6' and name='Name';";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formfieldtable set isconfighide=1,isviewhide=1 where formname='table_6' and name in('Last_Name','loginid','Employee_Type','Is_Admin');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "select max(fieldorder) from formfieldtable where modulename='Setup' and formname='table_6' and type not in ('subtable','form_history');";
	$result = getResultArray($con, $sql);
	$fieldorder = $result[0][0];
	$sql = "INSERT INTO `formfieldtable` VALUES ('Setup','table_6','Show_All_Reportee_Data','Show All Reportee Data','CheckBox','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','false',1,0,$fieldorder+1,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Setup','table_6','Show_Reportee_Data','Show Reportee Data','CheckBox','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','true',1,0,$fieldorder+2,0,0,0,0,0,'',1,0,0,0,'ALL',NULL)";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "alter table table_6_frm add Show_All_Reportee_Data varchar(30) after `Account_Type`;";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_6", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "alter table table_6_frm add Show_Reportee_Data varchar(30) after `Show_All_Reportee_Data`;";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_6", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "SELECT max(relationid) FROM formrelationtable;";
	$result = getResultArray($con, $sql);
	$maxrelation = $result[0][0];
	$sql = "insert into formrelationtable values($maxrelation+1,$maxrelation+2,0, 'table_6', 'table_50', 'n-1', '', 1, '');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formrelationtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "insert into formrelationtable values($maxrelation+2,$maxrelation+1,3, 'table_50', 'table_6', '1-n', '', 1, '');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formrelationtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "insert into formrelationtable values($maxrelation+3,$maxrelation+4,0, 'table_6', 'table_51', 'n-1', '', 1, '');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formrelationtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "insert into formrelationtable values($maxrelation+4,$maxrelation+3,3, 'table_51', 'table_6', '1-n', '', 1, '');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formrelationtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$teamreferenceid = "table_50_0_table_50_id";
	$territoryreferenceid = "table_51_0_table_51_id";
	$sql = "insert into formfieldtable values('Setup','table_6','$teamreferenceid','Team','reference','40','','','','','0','0','100','200','150','0','0', 'Normal','Advanced','','1','0',$fieldorder+3,'0','0','0','0','0','','1',0,0,0,'ALL',$maxrelation+1);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "insert into formfieldtable values('Setup','table_6','$territoryreferenceid','Territory','reference','40','','','','','0','0','100','200','150','0','0', 'Normal','Advanced','','1','0',$fieldorder+4,'0','0','0','0','0','','1',0,0,0,'ALL',$maxrelation+3);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "select max(fieldorder) from formfieldtable where modulename='Setup' and formname='table_50' and type not in ('subtable','form_history');";
	$result = getResultArray($con, $sql);
	$fieldorder = $result[0][0];
	$sql = "insert into formfieldtable values('Setup','table_50','table_6_3_table_6','User','subtable','40','','','','','0','0','100','200','150','0','0','Normal',
 'Advanced','','1','0',$fieldorder+1,'0','0','0','0','0','','1',0,0,0,'ALL',$maxrelation+2);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "select max(fieldorder) from formfieldtable where modulename='Setup' and formname='table_51' and type not in ('subtable','form_history');";
	$result = getResultArray($con, $sql);
	$fieldorder = $result[0][0];
	$sql = "insert into formfieldtable values('Setup','table_51','table_6_3_table_6','User','subtable','40','','','','','0','0','100','200','150','0','0','Normal',
 'Advanced','','1','0',$fieldorder+1,'0','0','0','0','0','','1',0,0,0,'ALL',$maxrelation+4);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$systemfields = array();
	$systemfields[] = 'table_6_0_createdusername';
	$systemfields[] = 'createdon';
	$systemfields[] = 'table_6_1_updatedusername';
	$systemfields[] = 'updatedon';
	$systemfields[] = 'table_6_2_viewedusername';
	$systemfields[] = 'viewedon';
	$size = sizeof($systemfields);
	for ($i = 0; $i < $size; $i++) {
		$sql = 'update formfieldtable set fieldorder = fieldorder+1 where formname in (\'table_50\',\'table_51\') and name=' . '\'' . $systemfields[$i] . '\'' . ';';
		$result = execSQL($con, $sql);
		insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	}
	$result = execSQL($con, $sql);
	$sql = "alter table table_6_frm add $teamreferenceid varchar(30) after `Show_Reportee_Data`;";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_6", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "alter table table_6_frm add $territoryreferenceid varchar(30) after `$teamreferenceid`;";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_6", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "insert into formfieldreference values('Setup','table_6','$teamreferenceid','Setup','table_50','Name', $maxrelation+1);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldreference", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "insert into formfieldreference values('Setup','table_50','table_6_3_table_6','Setup','table_6','', $maxrelation+2);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldreference", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "insert into formfieldreference values('Setup','table_6','$territoryreferenceid','Setup','table_51','Name', $maxrelation+3);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldreference", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "insert into formfieldreference values('Setup','table_51','table_6_3_table_6','Setup','table_6','', $maxrelation+4);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldreference", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "insert into fetchallfilterreference values('table_6', '$teamreferenceid', '', '0', '');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "fetchallfilterreference", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "insert into fetchallfilterreference values('table_6', '$territoryreferenceid', '', '0', '');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "fetchallfilterreference", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "alter table table_6_frm add CONSTRAINT `table_6_frm$teamreferenceid` foreign key($teamreferenceid) references table_50_frm(table_50_id);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_6", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "alter table table_6_frm add CONSTRAINT `table_6_frm$territoryreferenceid` foreign key($territoryreferenceid) references table_51_frm(table_51_id);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_6", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "create table `0table_50_table_6_frm` (table_50_id varchar(30), table_6_id varchar(30)) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "0table_50_table_6_frm", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "create table `0table_51_table_6_frm` (table_51_id varchar(30), table_6_id varchar(30)) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "0table_51_table_6_frm", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "alter table table_50_frm add 0table_6_id varchar(30) after `Description`;";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_50", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "alter table table_51_frm add 0table_6_id varchar(30) after `Description`;";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_51", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = 'update formfieldtable set fieldorder = fieldorder+4 where formname in (\'table_6\') and type in (\'subtable\',\'form_history\');';
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "SELECT name FROM formfieldtable where formname='table_6' order by fieldorder";
	$result = getResultArray($con, $sql);
	$profilestr = "";
	for ($i = 0; $i < sizeof($result); $i++) {
		$fieldname = $result[$i][0];
		$profilestr = $profilestr . "#$fieldname,$fieldname#1,1$";
	}
	$sql = "update table_2_frmfields set fields='$profilestr' where rolename='super admin profile' and formname='table_6';";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_2_frmfields", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "update formfieldtable set label='Shift Timing' where formname='table_6' and name='table_39_0_table_39_id'";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formtable set style='g_root,g_root,0,1,0,0,0,0$true,g_root,g_User Information,0,2,0,0,0,0$true,g_User Information,f_1,0,0,0,0,0,0$true,g_User Information,f_7,1,0,0,0,0,0$true,g_User Information,f_8,2,0,0,0,0,0$true,g_User Information,f_9,3,0,0,0,0,0$true,g_User Information,f_5,4,0,0,0,0,0$true,g_User Information,f_6,5,0,0,0,0,0$true,g_User Information,f_17,6,0,0,0,0,0$true,g_User Information,f_18,7,0,0,0,0,0$true,g_User Information,f_11,8,0,0,0,0,0$true,g_User Information,f_24,9,0,0,0,0,0$true,g_User Information,f_25,10,0,0,0,0,0$true,g_User Information,f_26,11,0,0,0,0,0$true,g_User Information,f_27,12,0,0,0,0,0$true,g_User Information,f_28,13,0,0,0,0,0$true' where formname='table_6'";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formfieldtable set label='Email' where formname='table_6' and name='Emailid'";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formfieldtable set label='Mobile' where formname='table_6' and name='MobileNo'";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
}

function modifyOrganizationDetails($con) {
	$sql = "INSERT INTO `formfieldtable` VALUES ('Setup','table_21','Display_Name','Display Name','Text','100','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,20,0,0,0,0,0,'',1,0,0,0,'ALL',NULL);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "update formfieldtable set fieldorder=fieldorder+1 where formname='table_21' and type in('form_history');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "alter table table_21_frm add Display_Name varchar(100) after `table_39_0_table_39_id`;";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_21", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formfieldtable set label='Email' where formname='table_21' and name='Email_Id';";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formfieldtable set label='Mobile' where formname='table_21' and name='Phone_No_2';";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formfieldtable set label='Phone' where formname='table_21' and name='Phone_No_1';";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formfieldtable set ismandatory='0' where formname='table_21' and name='Date_Format';";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formfieldtable set defaultvalue='true' where formname='table_21' and name in ('Email_Status');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formfieldtable set defaultvalue='false' where formname='table_21' and name in ('SMS_Status');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formtable set style = 'g_root,g_root,0,1,0,0,0,0$true,g_root,g_Account Information,0,2,0,0,0,0$true,g_Account Information,f_1,0,0,0,0,0,0$true,g_Account Information,f_20,1,0,0,0,0,0$true,g_Account Information,f_5,2,0,0,0,0,0$true,g_Account Information,f_6,3,0,0,0,0,0$true,g_Account Information,f_4,4,0,0,0,0,0$true,g_Account Information,f_3,5,0,0,0,0,0$true,g_Account Information,f_19,6,0,0,0,0,0$true,g_Account Information,f_2,7,0,0,0,0,0$true,g_root,f_7,1,0,0,0,0,0$true,g_root,f_9,2,0,0,0,0,0$true,g_root,f_10,3,0,0,0,0,0$true,g_root,f_11,4,0,0,0,0,0$true,g_root,f_12,5,0,0,0,0,0$true,g_root,f_13,6,0,0,0,0,0$true,g_root,f_14,7,0,0,0,0,0$true,g_root,f_17,8,0,0,0,0,0$true,g_root,f_18,9,0,0,0,0,0$true' where formname='table_21' and modulename = 'Setup';";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formfieldtable set isconfighide=1,isviewhide=1 where formname='table_21' and name in('Website','Fax','Financial_Year_Start','Default_Currency','Email_Status','SMS_Status','Date_Format','Time_Zone','Settings_Mode','Is_Mobile_Client','appid');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update table_2_frmfields set fields='#table_21_id,table_21_id#1,1$#Organization_Name,Organization_Name#1,1$#Logo,Logo#1,1$#Address,Address#1,1$#Email_Id,Email_Id#1,1$#Phone_No_1,Phone_No_1#1,1$#Phone_No_2,Phone_No_2#1,1$#Website,Website#1,1$#Fax,Fax#1,1$#Financial_Year_Start,Financial_Year_Start#1,1$#Default_Currency,Default_Currency#1,1$#Email_Status,Email_Status#1,1$#SMS_Status,SMS_Status#1,1$#Date_Format,Date_Format#1,1$#Time_Zone,Time_Zone#1,1$#Time_Interval,Time_Interval#1,1$#Settings_Mode,Settings_Mode#1,1$#Is_Mobile_Client,Is_Mobile_Client#1,1$#appid,appid#1,1$#table_39_0_table_39_id,table_39_0_table_39_id#1,1$#Display_Name,Display_Name#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$' where formname='table_21'";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_2_frmfields", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formfieldtable set label='Business Timing' where formname='table_21' and name='table_39_0_table_39_id'";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formfieldtable set label='Company Name' where formname='table_21' and name='Organization_Name'";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formtable set labelname='Account' where formname='table_21'";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formfieldreference set reffieldname='Shift_Name' where formname='table_21' and fieldname='table_39_0_table_39_id';";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldreference", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formtable set labelname='Color Formatting' where formname='table_14'";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
}

function updateOrgAndUserFormLabelsInTemplate($con) {
	$sql = "select * from printtemplate";
	$resultrows = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($resultrows); $i++) {
		$formname = $resultrows[$i][0];
		$name = $resultrows[$i][1];
		$content = $resultrows[$i][2];
		$content = str_replace('@org@Organization Name@', '@org@Company Name@', $content);
		$content = str_replace('@org@Product Incharge Mail Id@', '@org@Email@', $content);
		$content = str_replace('@org@Phone No@', '@org@Phone@', $content);
		$content = str_replace('@org@Mobile No@', '@org@Mobile@', $content);
		// $content = str_replace('@First Name@]', '@Name@]', $content);
		// $content = str_replace('@Emailid@]', '@Email@]', $content);
		// $content = str_replace('@MobileNo@]', '@Mobile@]', $content);
		$content = replacespecialchar($content);
		$sql = "update printtemplate set content = '$content' where formname = '$formname' and name = '$name'";
		$result = execSQL($con, $sql);
	}

	$sql = "select formname,name,content from emailtemplate";
	$resultrows = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($resultrows); $i++) {
		$formname = $resultrows[$i][0];
		$name = $resultrows[$i][1];
		$content = $resultrows[$i][2];
		$content = str_replace('@org@Organization Name@', '@org@Company Name@', $content);
		$content = str_replace('@org@Product Incharge Mail Id@', '@org@Email@', $content);
		$content = str_replace('@org@Phone No@', '@org@Phone@', $content);
		$content = str_replace('@org@Mobile No@', '@org@Mobile@', $content);
		// $content = str_replace('@First Name@]', '@Name@]', $content);
		// $content = str_replace('@Emailid@]', '@Email@]', $content);
		// $content = str_replace('@MobileNo@]', '@Mobile@]', $content);
		$content = replacespecialchar($content);
		$sql = "update emailtemplate set content = '$content' where formname = '$formname' and name = '$name'";
		$result = execSQL($con, $sql);
	}
}

function modifyAccountDetails($con) {
	$sql = "update formfieldtable set isconfighide='1', isviewhide='1' where formname='table_21' and name='Phone_No_2';";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formfieldtable set flength='35' where formname='table_21' and name='Display_Name';";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update table_21_frm set Display_Name = Organization_Name where Display_Name is Null;";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
}

function createCleaningDetailsReport($con) {
	if (DinamalarReportDetails::$IS_DINAMALAR_APP) {
	}
}

function updateSubtableFieldSize($con) {
	$sql = "SELECT frel.mtable,frel.stable,frel.nthinstance FROM formfieldtable ff left join formrelationtable frel on ff.relationid = frel.relationid where type = 'subtable' and formname not in('table_6','table_39','table_6_group') and frel.stable != 'table_6'";
	$dbrows = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($dbrows); $i++) {
		$formname = $dbrows[$i][0];
		$refformname = $dbrows[$i][1];
		$nthinstance = $dbrows[$i][2];
		$subfieldname = $nthinstance . $refformname . "_id";
		$sql="show columns from ".$formname."_frm where field='$subfieldname'";
		$resultarray = getResultArray($con, $sql);
		if(sizeof($resultarray) > 0){
		$sql = "ALTER TABLE `" . $formname . "_frm` MODIFY COLUMN `" . $subfieldname . "` VARCHAR(3500) DEFAULT NULL;";
		$result = execSQL($con, $sql);	
		}		
	}
}

function updateSearchTemplate($con) {
	$sql = "UPDATE
  `searchtemplate`
   SET
  `templatename` = IF (`templatename` LIKE '%Recently created Records%', 'Recently Created', `templatename`),
  `templatename` = IF (`templatename` LIKE '%Recently updated Records%', 'Recently Updated', `templatename`),
  `templatename` = IF (`templatename` LIKE '%Recently viewed Records%', 'Recently Viewed', `templatename`);";
	execSQL($con, $sql);
}

function migrateLogTable($con) {
	$sql = "show columns from table_28_frm where field='Reason';";
	$resultrow = getResultArray($con, $sql);
	if (sizeof($resultrow) == 0) {
		$sql = "ALTER TABLE `table_28_frm` ADD COLUMN `Reason` varchar(100) DEFAULT NULL AFTER `Status`;";
		$result = execSQL($con, $sql);
		// insertSyncQueryDetails($con, "table_28_frm", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
		$sql = "insert into formfieldtable values ('Setup', 'table_28', 'Reason', 'Reason', 'Text', '100', '', '', '', '', '0', '0', '100', '200', '150', '0', '0', 'Normal','Advanced', '', '1', '0', '18', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', NULL);";
		$result = execSQL($con, $sql);
		// insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
		$sql = "update  `table_2_frmfields` set fields = '#table_28_id,table_28_id#1,1$#Client_id,Client_id#1,1$#Mobile_No,Mobile_No#1,1$#SMSContent,SMSContent#1,1$#ScreenName,ScreenName#1,1$#DateTime,DateTime#1,1$#Status,Status#1,1$#DeliveredTime,DeliveredTime#1,1$#Type,Type#1,1$#T_Id,T_Id#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$,1$#Reason,Reason#1,1$,1$#viewedon,viewedon#1,1$#Reason,Reason#1,1$' where rolename in ('super admin profile','Admin profile') and modulename = 'Setup' and formname = 'table_28';";
		$result = execSQL($con, $sql);
		// insertSyncQueryDetails($con, "table_2_frmfields", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
		$sql = "update searchtemplate set viewfields = '0,0,1,0,2,0,3,0,4,0,5,0,6,0,7,0,9,0,10,0,18,0,' where formname='table_28' and templatename = 'All records';";
		$result = execSQL($con, $sql);
		// insertSyncQueryDetails($con, "searchtemplate", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
		$sql = "update formtable set style = 'g_root,g_root,0,1,0,0,0,0\$true,g_root,g_SMS Logs,0,2,0,0,0,0\$true,g_SMS Logs,f_1,0,0,0,0,0,0\$true,g_SMS Logs,f_2,1,0,0,0,0,0\$true,g_SMS Logs,f_4,2,0,0,0,0,0\$true,g_SMS Logs,f_5,3,0,0,0,0,0\$true,g_SMS Logs,f_6,4,0,0,0,0,0\$true,g_SMS Logs,f_18,5,0,0,0,0,0\$true,g_SMS Logs,f_7,6,0,0,0,0,0\$true,g_root,g_Content,1,1,0,0,0,0\$true,g_Content,f_3,0,0,0,0,0,0\$true,g_root,f_8,2,0,0,0,0,0\$true,g_root,f_9,3,0,0,0,0,0\$true' where formname='table_28' and modulename = 'Setup'";
		$result = execSQL($con, $sql);
		// insertSyncQueryDetails($con, "formtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	}
	$sql = "show columns from table_27_frm where field='Reason';";
	$resultrow = getResultArray($con, $sql);
	if (sizeof($resultrow) == 0) {
		$sql = "ALTER TABLE `table_27_frm` ADD COLUMN `Reason` varchar(100) DEFAULT NULL AFTER `Status`;";
		$result = execSQL($con, $sql);
		// insertSyncQueryDetails($con, "table_27_frm", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
		$sql = "insert into formfieldtable values ('Setup', 'table_27', 'Reason', 'Reason', 'Text', '100', '', '', '', '', '0', '0', '100', '200', '150', '0', '0', 'Normal','Advanced', '', '1', '0', '18', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', NULL);";
		$result = execSQL($con, $sql);
		// insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
		$sql = "update  `table_2_frmfields` set fields = '#table_27_id,table_27_id#1,1$#Client_id,Client_id#1,1$#Mobile_No,Mobile_No#1,1$#SMSContent,SMSContent#1,1$#ScreenName,ScreenName#1,1$#DateTime,DateTime#1,1$#Status,Status#1,1$#DeliveredTime,DeliveredTime#1,1$#Type,Type#1,1$#T_Id,T_Id#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$,1$#Reason,Reason#1,1$,1$#viewedon,viewedon#1,1$#Reason,Reason#1,1$' where rolename in ('super admin profile','Admin profile') and modulename = 'Setup' and formname = 'table_27';";
		$result = execSQL($con, $sql);
		// insertSyncQueryDetails($con, "table_2_frmfields", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
		$sql = "update searchtemplate set viewfields = '0,0,1,0,2,0,3,0,4,0,5,0,6,0,7,0,9,0,10,0,18,0,' where formname='table_27' and templatename = 'All records';";
		$result = execSQL($con, $sql);
		// insertSyncQueryDetails($con, "searchtemplate", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
		$sql = "update formtable set style = 'g_root,g_root,0,1,0,0,0,0\$true,g_root,g_SMS Logs,0,2,0,0,0,0\$true,g_SMS Logs,f_1,0,0,0,0,0,0\$true,g_SMS Logs,f_2,1,0,0,0,0,0\$true,g_SMS Logs,f_4,2,0,0,0,0,0\$true,g_SMS Logs,f_5,3,0,0,0,0,0\$true,g_SMS Logs,f_6,4,0,0,0,0,0\$true,g_SMS Logs,f_18,5,0,0,0,0,0\$true,g_SMS Logs,f_7,6,0,0,0,0,0\$true,g_root,g_Content,1,1,0,0,0,0\$true,g_Content,f_3,0,0,0,0,0,0\$true,g_root,f_8,2,0,0,0,0,0\$true,g_root,f_9,3,0,0,0,0,0\$true' where formname='table_27' and modulename = 'Setup'";
		$result = execSQL($con, $sql);
		// insertSyncQueryDetails($con, "formtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	}
}

function migrateActivityForm($con) {
	$sql = "select max(fieldorder) from formfieldtable where formname='table_52' and type not in ('form_history','subtable');";
	$resultrow = getResultArray($con, $sql);
	if (sizeof($resultrow) > 0) {
		$maxfieldorder = $resultrow[0][0];
		$sql = "select modulename from formtable where formname='table_52'";
		$result = getResultArray($con, $sql);
		$modulename = $result[0][0];
		$sql = "insert into formfieldtable values('$modulename','table_52','trigger_action','trigger action','CheckBox','40','','','','','1','1','100','200','150','0','0','Normal','NO',
 'No','1','0','$maxfieldorder','0','0','0','0','0','','1',0,0,0,'ALL',NULL);";
		$result = execSQL($con, $sql);
		insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
		$sql = "update formfieldtable set fieldorder = fieldorder+1 where formname='table_52' and type in ('form_history','subtable');";
		$result = execSQL($con, $sql);
		insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
		$sql = "alter table table_52_frm add `trigger_action` varchar(40) after `Comments`";
		$result = execSQL($con, $sql);
		insertSyncQueryDetails($con, "table_52_frm", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	}
}

function removeFieldfromActivityForm($con) {
	$sql = "delete from formfieldtable where formname='table_52' and name='Due_Date'";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_52_frm", "", SYNC_ACTION::$STRUC_DELETE, $sql, "");
	$sql = "alter table table_52_frm drop column Due_Date;";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_52_frm", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "select rolename,fields FROM table_2_frmfields where formname='table_52'";
	$result = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($result); $i++) {
		$rolename = $result[$i][0];
		$fields = $result[$i][1];
		$fieldsarr = explode('$', $fields);
		$profilestr = "";
		for ($j = 0; $j < sizeof($fieldsarr); $j++) {
			$fieldstr = $fieldsarr[$j];
			if (strpos($fieldstr, 'Due_Date')) {
				continue;
			}
			$profilestr .= $fieldstr . "$";
		}
		$sql = "update table_2_frmfields set fields='$profilestr' where formname='table_52' and rolename='$rolename';";
		$result = execSQL($con, $sql);
		insertSyncQueryDetails($con, "table_52_frm", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	}
}

function UserandAccountFormChanges($con) {
	$sql = "update formfieldtable set name='Photo', label='Photo', type='Image', flength='40', instruction='', tooltip='', linkname='', linkurl='', isconfighide='0', isviewhide='1', viewcolminwidth='100', viewcolmaxwidth='100', viewcolprefwidth='100', isgui='0', ismandatory='0', enabletype='Normal', searchtype='Advanced', defaultvalue='img1.png', defaultvisible='1', issytemfield='0', isunique='0', isquickcreate='0', ismassedit='0', issearch='0', isdisplay='0', groupname='', islabeldisplay='1', isviewmandatory = '0', isrollingupdate='0', iscustomfield='0', fieldvisiblefor =''where modulename='Setup' and formname='table_6' and name='Photo';";
	$result = execSQL($con, $sql);

	$sql = "update formfieldtable set isconfighide = '1' , isviewhide = '1' where label in ('Team','Territory') and formname = 'table_6' and name in ('table_51_0_table_51_id','table_50_0_table_50_id')";
	$result = execSQL($con, $sql);

	$sql = "update formfieldtable set enabletype = 'Normal' where formname = 'table_6' and name = 'Name' and label = 'Name';";
	$result = execSQL($con, $sql);

	$sql = "update formfieldtable set enabletype = 'Normal' where formname = 'table_21' and name = 'Organization_Name';";
	$result = execSQL($con, $sql);

	$sql = "update formfieldtable set label = 'Application Tittle' where name = 'Display_Name' and formname ='table_21';";
	$result = execSQL($con, $sql);

	$sql = "update  formfieldtable set isconfighide = '1',isviewhide = '1' where formname = 'table_21'  and name = 'table_39_0_table_39_id';";
	$result = execSQL($con, $sql);
}

function UpdateAttachmentasHistory($con) {
	$sql = "select labelname,formname from formtable where modulename='Attachments'";
	$result = getResultArray($con, $sql);
	$j = sizeof($result);
	for ($i = 0; $i < $j; $i++) {
		$labelname = $result[$i][0];
		$formname = $result[$i][1];
		$labelname = split("\ ", $labelname);
		$labelname = $labelname[0] . ' History';
		$sql = "update formtable set labelname = '$labelname' where modulename = 'Attachments' and formname = '$formname';";
		$result1 = execSQL($con, $sql);
		debug("The Update Query" . $sql);
	}
}

function RevertAttachmentasHistory($con) {
	$sql = "select labelname,formname from formtable where modulename='Attachments'";
	$result = getResultArray($con, $sql);
	$j = sizeof($result);
	for ($i = 0; $i < $j; $i++) {
		$labelname = $result[$i][0];
		$formname = $result[$i][1];
		$labelname = split("\ ", $labelname);
		$labelname = $labelname[0] . ' Attachments';
		$sql = "update formtable set labelname = '$labelname' where modulename = 'Attachments' and formname = '$formname';";
		$result1 = execSQL($con, $sql);
		debug("The Update Query" . $sql);
	}
}

function migrateORGINFOtables($con) {
	$sql = 'SELECT table_name FROM information_schema.tables WHERE table_schema = ' . '\'' . DBINFO::$APPDBNAME . '\'' . ' AND table_name like \'%_orginfo\'';
	$resultrows = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($resultrows); $i++) {
		$tablename = $resultrows[$i][0];
		$sql = "alter table " . DBINFO::$APPDBNAME . ".$tablename modify column city varchar(500);";
		$result = execSQL($con, $sql);
	}
}

function ChangeOrgTable($con) {
	$sql = "insert into formfieldtable values('Setup', 'table_21', 'Name', 'Name', 'Text', '40', '', '', '', '', '0', '0', '100', '200', '150', '0', '0', 'Normal', 'Advanced', '','1', '0', '21', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', NULL);";
	$result = execSQL($con, $sql);
	$sql = "alter table table_21_frm add `Name` varchar(40) default '' after `createdon`;";
	$result = execSQL($con, $sql);
	$sql = "update table_2_frmfields set fields=concat(fields,'#Name,Name#1,1$') where formname='table_21';";
	$result = execSQL($con, $sql);
	$sql = "insert into formfieldtable values('Setup', 'table_21', 'Designation', 'Designation', 'Text', '40', '', '', '', '', '0', '0', '100', '200', '150', '0', '0', 'Normal','Advanced', '', '1', '0', '22', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL',NULL);";
	$result = execSQL($con, $sql);
	$sql = "alter table table_21_frm add `Designation` varchar(40) default ''  after `Name`;";
	$result = execSQL($con, $sql);
	$sql = "update table_2_frmfields set fields=concat(fields,'#Designation,Designation#1,1$') where formname='table_21';";
	$result = execSQL($con, $sql);
	$sql = "insert into formfieldtable values('Setup', 'table_21', 'Street_1', 'Street 1', 'Text', '40', '', '', '', '', '0', '0', '100', '200', '150', '0', '0', 'Normal','Advanced', '', '1', '0', '23', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', NULL);";
	$result = execSQL($con, $sql);
	$sql = "alter table table_21_frm add `Street_1`  varchar(40)  default '' after `Designation`;";
	$result = execSQL($con, $sql);
	$sql = "update table_2_frmfields set fields=concat(fields,'#Street_1,Street_1#1,1$') where formname='table_21';";
	$result = execSQL($con, $sql);
	$sql = "insert into formfieldtable values('Setup', 'table_21', 'Street_2', 'Street 2', 'Text', '40', '', '', '', '', '0', '0', '100', '200', '150', '0', '0', 'Normal','Advanced', '', '1', '0', '24', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', NULL);";
	$result = execSQL($con, $sql);
	$sql = "alter table table_21_frm add `Street_2` varchar(40) default ''  after `Street_1`;";
	$result = execSQL($con, $sql);
	$sql = "update table_2_frmfields set fields=concat(fields,'#Street_2,Street_2#1,1$') where formname='table_21';";
	$result = execSQL($con, $sql);
	$sql = "insert into formfieldtable values('Setup', 'table_21', 'City', 'City', 'Text', '40', '', '', '', '', '0', '0', '100', '200', '150', '0', '0', 'Normal', 'Advanced','', '1', '0', '25', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', NULL);";
	$result = execSQL($con, $sql);
	$sql = "alter table table_21_frm add `City` varchar(40) default ''  after `Street_2`;";
	$result = execSQL($con, $sql);
	$sql = "update table_2_frmfields set fields=concat(fields,'#City,City#1,1$') where formname='table_21';";
	$result = execSQL($con, $sql);
	$sql = "insert into formfieldtable values('Setup', 'table_21', 'PinZip_Code', 'Pin/Zip Code', 'Text', '40', '', '', '', '', '0', '0', '100', '200', '150', '0', '0','Normal', 'Advanced', '', '1', '0', '26', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', NULL);";
	$result = execSQL($con, $sql);
	$sql = "alter table table_21_frm add `PinZip_Code` varchar(40) default ''  after `City`;";
	$result = execSQL($con, $sql);
	$sql = "update table_2_frmfields set fields=concat(fields,'#PinZip_Code,PinZip_Code#1,1$') where formname='table_21';";
	$result = execSQL($con, $sql);
	$sql = "insert into formfieldtable values('Setup', 'table_21', 'State', 'State', 'Text', '40', '', '', '', '', '0', '0', '100', '200', '150', '0', '0', 'Normal', 'Advanced','', '1', '0', '27', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', NULL);";
	$result = execSQL($con, $sql);
	$sql = "alter table table_21_frm add `State` varchar(40) default ''  after `PinZip_Code`;";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder = fieldorder+1 where formname='table_21' and name='table_6_0_createdusername';";
	$result = execSQL($con, $sql);
	$sql = " update table_2_frmfields set fields=concat(fields,'#State,State#1,1$') where formname='table_21' ;";
	$result = execSQL($con, $sql);
	$sql = "insert into formfieldtable values('Setup', 'table_21', 'Country', 'Country', 'Text', '40', '', '', '', '', '0', '0', '100', '200', '150', '0', '0', 'Normal','Advanced', '', '1', '0', '28', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', NULL);";
	$result = execSQL($con, $sql);
	$sql = "update table_2_frmfields set fields = '#table_21_id,table_21_id#1,1$#Organization_Name,Organization_Name#1,1$#Logo,Logo#1,1$#Address,Address#1,1$#Email_Id,Email_Id#1,1$#Phone_No_1,Phone_No_1#1,1$#Phone_No_2,Phone_No_2#1,1$#Website,Website#1,1$#Fax,Fax#1,1$#Financial_Year_Start,Financial_Year_Start#1,1$#Default_Currency,Default_Currency#1,1$#Email_Status,Email_Status#1,1$#SMS_Status,SMS_Status#1,1$#Date_Format,Date_Format#1,1$#Time_Zone,Time_Zone#1,1$#Time_Interval,Time_Interval#1,1$#Settings_Mode,Settings_Mode#1,1$#Is_Mobile_Client,Is_Mobile_Client#1,1$#appid,appid#1,1$#table_39_0_table_39_id,table_39_0_table_39_id#1,1$#Display_Name,Display_Name#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$#Name,Name#1,1$#Name,Name#1,1$#Name,Name#1,1$#Name,Name#1,1$#Name,Name#1,1$#Designation,Designation#1,1$#Designation,Designation#1,1$#Designation,Designation#1,1$#Designation,Designation#1,1$#Designation,Designation#1,1$#Street_1,Street_1#1,1$#Street_1,Street_1#1,1$#Street_1,Street_1#1,1$#Street_1,Street_1#1,1$#Street_1,Street_1#1,1$#Street_2,Street_2#1,1$#Street_2,Street_2#1,1$#Street_2,Street_2#1,1$#Street_2,Street_2#1,1$#Street_2,Street_2#1,1$#City,City#1,1$#City,City#1,1$#City,City#1,1$#City,City#1,1$#City,City#1,1$#PinZip_Code,PinZip_Code#1,1$#PinZip_Code,PinZip_Code#1,1$#PinZip_Code,PinZip_Code#1,1$#PinZip_Code,PinZip_Code#1,1$#PinZip_Code,PinZip_Code#1,1$#State,State#1,1$#State,State#1,1$#State,State#1,1$#State,State#1,1$#State,State#1,1$#Country,Country#1,1$' where rolename = 'super admin profile' and formname = 'table_21' and modulename = 'Setup';";
	$result = execSQL($con, $sql);
	$sql = "alter table table_21_frm add `Country` varchar(40) default ''  after `State`;";
	$result = execSQL($con, $sql);
	$sql = "update table_2_frmfields set fields=concat(fields,'#Country,Country#1,1$') where formname='table_21' ;";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set isconfighide = '0',isviewhide='0' where formname = 'table_21' and name = 'Phone_No_2';";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set isconfighide = '0',isviewhide='0' where formname = 'table_21' and name = 'Website';";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set isconfighide = '1',isviewhide='1' where formname = 'table_21' and name = 'Address';";
	$result = execSQL($con, $sql);
	$sql = "update formtable set style = 'g_root,g_root,0,1,0,0,0,0$true,g_root,g_Account Information,0,2,0,0,0,0$true,g_Account Information,f_1,0,0,0,0,0,0$true,g_Account Information,f_19,1,0,0,0,0,0$true,g_Account Information,f_7,2,0,0,0,0,0$true,g_Account Information,f_5,3,0,0,0,0,0$true,g_Account Information,f_2,4,0,0,0,0,0$true,g_root,g_Primary Contact Detail,1,2,0,0,0,0$true,g_Primary Contact Detail,f_21,0,0,0,0,0,0$true,g_Primary Contact Detail,f_4,1,0,0,0,0,0$true,g_Primary Contact Detail,f_6,2,0,0,0,0,0$true,g_Primary Contact Detail,f_22,3,0,0,0,0,0$true,g_root,g_Address Information,2,2,0,0,0,0$true,g_Address Information,f_23,0,0,0,0,0,0$true,g_Address Information,f_24,1,0,0,0,0,0$true,g_Address Information,f_25,2,0,0,0,0,0$true,g_Address Information,f_26,3,0,0,0,0,0$true,g_Address Information,f_27,4,0,0,0,0,0$true,g_Address Information,f_28,5,0,0,0,0,0$true' where formname='table_21' and modulename = 'Setup';";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder = fieldorder+8 where formname='table_21' and name='table_6_0_createdusername';";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder = fieldorder+8 where formname='table_21' and name='createdon';";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder = fieldorder+8 where formname='table_21' and name='table_6_1_updatedusername';";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder = fieldorder+8 where formname='table_21' and name='updatedon';";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder = fieldorder+8 where formname='table_21' and name='table_6_2_viewedusername';";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder = fieldorder+8 where formname='table_21' and name='viewedon';";
	$result = execSQL($con, $sql);
}

function addDescriptionFieldInProfile($con) {
	$sql = " insert into formfieldtable values('Setup', 'table_2', 'Description', 'Description', 'Text', '40', '', '', '', '', '0', '0', '100', '200', '150', '0', '0', 'Normal','Advanced', '', '1', '0', '4', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', NULL);";
	$result = execSQL($con, $sql);
	$sql = "update table_2_frmfields set fields = '#table_2_id,table_2_id#1,1$#Profile_Name,Profile_Name#1,1$#table_2_id,table_2_id#1,1$#Profile_Name,Profile_Name#1,1$#table_2_id,table_2_id#1,1$#Profile_Name,Profile_Name#1,1$#is_portal_profile,is_portal_profile#1,1$#is_mapview,is_mapview#1,1$#Description,Description#1,1$#Description,Description#1,1$#Description,Description#1,1$#Description,Description#1,1$#Description,Description#1,1$#Description,Description#1,1$#Description,Description#1,1$#Description,Description#1,1$#Description,Description#1,1$#Description,Description#1,1$#Description,Description#1,1$#Description,Description#1,1$#Description,Description#1,1$#Description,Description#1,1$#Description,Description#1,1$#Description,Description#1,1$#Description,Description#1,1$#Description,Description#1,1$#Description,Description#1,1$#Description,Description#1,1$#Description,Description#1,1$#Description,Description#1,1$' where rolename = 'super admin profile' and formname = 'table_2' and modulename = 'Setup';";
	$result = execSQL($con, $sql);
	$sql = "alter table table_2_frm add `Description` varchar(40) after `createdon`;";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder = fieldorder+1 where formname='table_2' and name='table_6_0_createdusername';";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder = fieldorder+1 where formname='table_2' and name='createdon';";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder = fieldorder+1 where formname='table_2' and name='table_6_1_updatedusername';";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder = fieldorder+1 where formname='table_2' and name='updatedon';";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder = fieldorder+1 where formname='table_2' and name='table_6_2_viewedusername';";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder = fieldorder+1 where formname='table_2' and name='viewedon';";
	$result = execSQL($con, $sql);
	$sql = "update table_2_frmfields set fields=concat(fields,'#Description,Description#1,1$') where formname='table_2';";
	$result = execSQL($con, $sql);
}

function UpdateEmailHistory($con) {
	$sql = "select distinct formname from formfieldtable where modulename = 'EmailSend'";
	$resultrows = getResultArray($con, $sql);
	$size = sizeof($resultrows);
	for ($i = 0; $i < $size; $i++) {
		$formname = $resultrows[$i][0];
		$tablename = $formname . "_frm";
		$sql = "ALTER TABLE $tablename MODIFY Subject VARCHAR(100);";
		$result = execSQL($con, $sql);
		$sql = "update formfieldtable set flength = '100' where formname = '$formname' and name = 'Subject' ;";
		;
		$result = execSQL($con, $sql);
	}
}

function updateEmailHistoryForm($con) {
	$sql = "select formname from formtable where modulename='EmailSend'";
	$resultrows = getResultArray($con, $sql);
	$size = sizeof($resultrows);
	for ($i = 0; $i < $size; $i++) {
		$formname = $resultrows[$i][0];
		$sql = "update formfieldtable set isviewhide=0 where formname='$formname' and name in ('createdon','updatedon','viewedon');";
		$result = execSQL($con, $sql);
	}
}

function migrateTimeZoneListValues($con) {
	$sql = "select itemname from picklisttable where name='Time Zone' ";
	$resultrows = getResultArray($con, $sql);
	$size = sizeof($resultrows);
	for ($i = 0; $i < $size; $i++) {
		$olditemname = $resultrows[$i][0];	
		if($olditemname != ''){
		$target_time_zone = new DateTimeZone($olditemname);
		$target_date_time = new DateTime('now', $target_time_zone);
		$newitemname = '(GMT ' . $target_date_time -> format('P') . ")-" . $olditemname;
		$sql = "update picklisttable set itemname='$newitemname' where name='Time Zone' and itemname='$olditemname'";
		$result = execSQL($con, $sql);	
		}
	}
}

function migrateTimeZoneListOrder($con) {
	$sql = "select itemname from picklisttable where name='Time Zone' order by itemname";
	$resultrows = getResultArray($con, $sql);
	$size = sizeof($resultrows);
	for ($i = 0; $i < $size; $i++) {
		$itemname = $resultrows[$i][0];
		$sql = "update picklisttable set itemorder='$i' where name='Time Zone' and itemname='$itemname'";
		$result = execSQL($con, $sql);
	}
}

function createSystemReports($con) {
	$sql = "select formname,modulename from formtable where formtype = 'checkin/checkout';";
	$resultrows = getResultArray($con, $sql);
	if (sizeof($resultrows) == 0) {
		return;
	}
	$formname = $resultrows[0][0];
	$attmodulename = $resultrows[0][1];
	$sql = "select modulename from formtable where formname = 'table_52';";
	$resultrows = getResultArray($con, $sql);
	$taskmodulename = $resultrows[0][0];
	$sql = "select max(cast(reportid as signed)) from reportform FOR UPDATE ;";
	$result = getResultArray($con, $sql);
	$reportid = $result[0][0];
	$reportid = $reportid + 1;
	$sql = "select max(moduleorder) from reportmodule;";
	$result = getResultArray($con, $sql);
	$maxmoduleorder = $result[0][0];
	$maxmoduleorder = $maxmoduleorder + 1;
	$reportorder = 1;
	$sql = "insert into reportform values($reportid, '',  'Attendance Report','','Attendance Report','','','', 'Table', 0,'Attach.png',0, 0, 0, '','1','2015-06-12 15:12:08','0','$attmodulename','$formname');";
	execSQL($con, $sql);
	$sql = "insert into reportfieldtable values($reportid,'$attmodulename', '$formname', 'table_6_3_table_6_id', '', '','0','0','100','','','','','0');";
	execSQL($con, $sql);
	$sql = "insert into reportfieldtable values($reportid,'$attmodulename', '$formname', 'In_Location', 'Check In', \"concat(concat(concat('Time:',DATE_FORMAT(In_Time,'%d %b %Y %h:%i %p')),'<br>'),concat('Location:',In_Location))\",'0','0','100','','','','','1');";
	execSQL($con, $sql);
	$sql = "insert into reportfieldtable values($reportid,'$attmodulename', '$formname', 'Out_Location', 'Check Out', \"concat(concat(concat('Time:',DATE_FORMAT(Out_Time,'%d %b %Y %h:%i %p')),'<br>'),concat('Location:',Out_Location))\",'0','0','100','','','','','2');";
	execSQL($con, $sql);
	$sql = "insert into reportfilterfieldtable values($reportid,'$attmodulename', '$formname', 'table_6_3_table_6_id','0');";
	execSQL($con, $sql);
	$sql = "insert into reportfilterfieldvaluetable values($reportid,'$attmodulename', '$formname', 'In_Time','Yesterday', '2015-06-24 00:00:00#2015-06-24 23:59:00','',0);";
	execSQL($con, $sql);
	$sql = "insert into reportmodule values( 'Daily Reports', $reportid,'$reportorder','$maxmoduleorder');";
	execSQL($con, $sql);
	$sql = "insert into reportsubmodule values( '', $reportid);";
	execSQL($con, $sql);
	if (sizeof($resultrows) == 0) {
		return;
	}
	$reportid = $reportid + 1;
	$reportorder = $reportorder + 1;
	$sql = "select max(cast(groupid as signed)) from reportgrouptable FOR UPDATE ;";
	$result = getResultArray($con, $sql);
	$groupid = $result[0][0];
	$groupid = $groupid + 1;
	$sql = "insert into reportform values($reportid, '0',  'Task Summary','','Task Summary','Footer','Top Page title','Bottom Page title', 'Pivot Table', 0,'USer-Status.png',0, 0, 0, '','1','2015-06-22 16:48:44','0','$taskmodulename','table_52')";
	execSQL($con, $sql);
	$sql = "insert into reportgrouptable values($reportid,'New Group', '$groupid', 0)";
	execSQL($con, $sql);
	$sql = "insert into reportfieldtable values($reportid,'$taskmodulename', 'table_52', 'Planned_Hours', 'Planned Hrs', '','2','0','100','1','','','','0')";
	execSQL($con, $sql);
	$sql = "insert into reportfieldtable values($reportid,'$taskmodulename', 'table_52', 'Status', '', '','1','0','100','','','','','0')";
	execSQL($con, $sql);
	$sql = "insert into reportfieldtable values($reportid,'$taskmodulename', 'table_52', 'table_6_3_table_6_id', 'Staffs', '','0','0','100','','','','','0')";
	execSQL($con, $sql);
	$sql = "insert into reportfieldtable values($reportid,'$taskmodulename', 'table_52', 'Actual_Hours', 'Actual Hrs', '','2','0','100','1','','','','1')";
	execSQL($con, $sql);
	$sql = "insert into reportfieldtable values($reportid,'$taskmodulename', 'table_52', 'Subject', 'Completed Task', '','2','0','100','','','','','2')";
	execSQL($con, $sql);
	$sql = " insert into reportfilterfieldvaluetable values($reportid,'$taskmodulename', 'table_52', 'Planned_Start','Yesterday', '2015-06-24 00:00:00#2015-06-24 23:59:00','',0);";
	execSQL($con, $sql);
	$sql = "insert into reportmodule values( 'Daily Reports', $reportid,'$reportorder','$maxmoduleorder')";
	execSQL($con, $sql);
	$sql = "insert into reportsubmodule values( '', $reportid)";
	execSQL($con, $sql);
	$reportid = $reportid + 1;
	$reportorder = $reportorder + 1;
	$groupid = $groupid + 1;
	$sql = "insert into reportform values($reportid, '',  'Task Details','','','','','', 'Summary Column', 0,'Activity1.png',0, 0, 0, '','1','2015-06-16 12:44:48','0','$taskmodulename','table_52')";
	execSQL($con, $sql);
	$sql = "insert into reportgrouptable values($reportid,'New Group', '$groupid', 0)";
	execSQL($con, $sql);
	$sql = "insert into reportgroupdetailtable values ('$groupid','$taskmodulename','table_52', 'table_6_3_table_6_id','1','0','0','100','')";
	execSQL($con, $sql);
	$sql="select name from formfieldtable where formname='table_52' and name='table_201_0_table_201_id'";
	$result = getResultArray($con, $sql);
	$reportfieldorder=0;
	if(sizeof($result) > 0){
	$sql = "insert into reportfieldtable values($reportid,'$taskmodulename', 'table_52', 'table_201_0_table_201_id', '', '','0','0','100','','','','','$reportfieldorder')";
	execSQL($con, $sql);	
	$reportfieldorder++;
	}
	$sql = "insert into reportfieldtable values($reportid,'$taskmodulename', 'table_52', 'Comments', '', '','0','0','100','','','','','$reportfieldorder')";
	execSQL($con, $sql);
	$reportfieldorder++;
	$sql="select name from formfieldtable where formname='table_52' and name='Actual_Start_Location'";
	$result = getResultArray($con, $sql);
	if(sizeof($result) > 0){
	$sql = "insert into reportfieldtable values($reportid,\"$taskmodulename\", \"table_52\", \"Actual_Start_Location\", \"Started\", \"concat(concat(concat('Time:',DATE_FORMAT(Actual_Start,'%d %b %Y %h:%i %p')),'<br>'),concat('Location:',Actual_Start_Location)) \",'0','0','100','','','','','$reportfieldorder')";
	execSQL($con, $sql);
	$reportfieldorder++;	
	$sql = "insert into reportfieldtable values($reportid,\"$taskmodulename\", \"table_52\", \"Actual_End_Location\", \"Ended\", \"concat(concat(concat('Time:',DATE_FORMAT(Actual_End,'%d %b %Y %h:%i %p')),'<br>'),concat('Location:',Actual_End_Location))\",'0','0','100','','','','','$reportfieldorder')";
	execSQL($con, $sql);
	}	
	$sql = " insert into reportfilterfieldvaluetable values($reportid,'$taskmodulename', 'table_52', 'Planned_Start','Yesterday', '2015-06-24 00:00:00#2015-06-24 23:59:00','',0);";
	execSQL($con, $sql);
	$sql = "insert into reportmodule values( 'Daily Reports', $reportid,'$reportorder','$maxmoduleorder');";
	execSQL($con, $sql);
	$sql = "insert into reportsubmodule values( '', $reportid)";
	execSQL($con, $sql);
}

function reCreateTaskSummaryReport($con) {
	$sql = "select rf.reportid from reportform rf left join reportmodule rm ON rf.reportid = rm.reportid where rm.name = 'Daily Reports' and rf.reportname = 'Task Summary';";
	$result = getResultArray($con, $sql);
	$reportid = $result[0][0];
	$sql = "select modulename from formtable where formname = 'table_52';";
	$resultrows = getResultArray($con, $sql);
	$taskmodulename = $resultrows[0][0];
	if ($reportid != "") {
		$sql = "select groupid from reportgrouptable where reportid='$reportid'";
		$result = getResultArray($con, $sql);
		$groupid = $result[0][0];
		$sql = "delete from  reportgroupdetailtable where groupid='$groupid';";
		execSQL($con, $sql);
		$sql = "delete from  reportgrouptable where reportid='$reportid';";
		execSQL($con, $sql);
		$sql = "delete from  reportfilterfieldtable where reportid='$reportid';";
		execSQL($con, $sql);
		$sql = "delete from  reportfilterfieldvaluetable where reportid='$reportid';";
		execSQL($con, $sql);
		$sql = "delete from  reportfieldtable where reportid='$reportid';";
		execSQL($con, $sql);
		$sql = "delete from  reportmodule where reportid='$reportid';";
		execSQL($con, $sql);
		$sql = "delete from  reportsubmodule where reportid='$reportid';";
		execSQL($con, $sql);
		$sql = "delete from  reportform where reportid='$reportid';";
		execSQL($con, $sql);
		$sql = "delete from reportscheduler where reportid = '$reportid';";
		execSQL($con, $sql);
		$sql = "delete from reportschedulerusermailstaus where reportid = '$reportid';";
		execSQL($con, $sql);
	}
	$sql = "select max(cast(reportid as signed)) from reportform FOR UPDATE ;";
	$result = getResultArray($con, $sql);
	$reportid = $result[0][0];
	$reportid = $reportid + 1;
	$sql = " insert into reportform values($reportid, '',  'Task Summary','','','','','', 'Table', 0,'USer-Status.png',0, 0, 0, '','1','2015-07-03 15:25:56','0','$taskmodulename','table_52');";
	execSQL($con, $sql);
	$sql = " insert into reportfieldtable values($reportid,'$taskmodulename', 'table_52', 'table_6_3_table_6_id', '', '','0','0','100','','','','','0');";
	execSQL($con, $sql);
	$sql = " insert into reportfieldtable values($reportid,'$taskmodulename', 'table_52', 'Subject', 'Completed Task', '','0','0','100','','','','','1');";
	execSQL($con, $sql);
	$sql = " insert into reportfieldtable values($reportid,'$taskmodulename', 'table_52', 'Planned_Hours', 'Planned Hrs', '','0','0','100','','','','','2');";
	execSQL($con, $sql);
	$sql = " insert into reportfieldtable values($reportid,'$taskmodulename', 'table_52', 'Actual_Hours', 'Actual Hrs', '','0','0','100','','','','','3');";
	execSQL($con, $sql);
	$sql = " insert into reportfilterfieldvaluetable values($reportid,'$taskmodulename', 'table_52', 'Status','is', 'Closed','',0);";
	execSQL($con, $sql);
	$sql = " delete from reportmodule where reportid=$reportid;";
	execSQL($con, $sql);
	$sql = " select moduleorder from reportmodule where name='Daily Reports';";
	$result = getResultArray($con, $sql);
	$moduleorder = $result[0][0];
	$sql = " select max(reportorder) from reportmodule where name='Daily Reports';";
	$result = getResultArray($con, $sql);
	$reportorder = $result[0][0];
	$reportorder = $reportorder + 1;
	$sql = " insert into reportmodule values( 'Daily Reports', $reportid,'$reportorder','$moduleorder');";
	execSQL($con, $sql);
	$sql = " delete from reportsubmodule where reportid=$reportid;";
	execSQL($con, $sql);
	$sql = " insert into reportsubmodule values( '', $reportid);";
	execSQL($con, $sql);
}

function createUserLoginField($con) {
	$currentime = date('Y-m-d H:i:s');
	$sql = "insert into picklisttable values( 'UserLogin', 'All', 0,0,'$currentime','0' )";
	execSQL($con, $sql);
	$sql = "insert into picklisttable values( 'UserLogin', 'Web', 1,0,'$currentime','0' )";
	execSQL($con, $sql);
	$sql = "insert into picklisttable values( 'UserLogin', 'Mobile', 2,0,'$currentime','0' )";
	execSQL($con, $sql);
	$sql = "select max(fieldorder) from formfieldtable where formname='table_6' and type not in
('form_history','subtable')";
	$result = getResultArray($con, $sql);
	$fieldorder = $result[0][0];
	$sql = "insert into formfieldtable values('Setup', 'table_6', 'Login_Allowed', 'Login Allowed', 'ComboBox', '40', '', '', '', '', '0', '0', '100', '200', '150', '0', '0','Normal', 'Advanced', '', '1', '0', $fieldorder+1, '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', NULL);";
	execSQL($con, $sql);
	$sql = "update table_2_frmfields set fields = '#table_6_id,table_6_id#1,1$#Name,Name#1,1$#loginid,loginid#1,1$#Last_Name,Last_Name#1,1$#Password,Password#1,1$#table_4_0_table_4_id,table_4_0_table_4_id#1,1$#table_2_0_table_2_id,table_2_0_table_2_id#1,1$#Emailid,Emailid#1,1$#MobileNo,MobileNo#1,1$#Account_Status,Account_Status#1,1$#Is_Admin,Is_Admin#1,1$#table_6_3_table_6_id,table_6_3_table_6_id#1,1$#table_20_0_table_20_id,table_20_0_table_20_id#1,1$#table_19_0_table_19_id,table_19_0_table_19_id#1,1$#table_18_0_table_18_id,table_18_0_table_18_id#1,1$#Languages,Languages#1,1$#Date_of_Birth,Date_of_Birth#1,1$#Photo,Photo#1,1$#Address,Address#1,1$#Alternate_contact_number,Alternate_contact_number#1,1$#Default_Currency,Default_Currency#1,1$#Time_Zone,Time_Zone#1,1$#table_26_0_table_26_id,table_26_0_table_26_id#1,1$#Account_Type,Account_Type#1,1$#table_39_0_table_39_id,table_39_0_table_39_id#1,1$#Show_All_Reportee_Data,Show_All_Reportee_Data#1,1$#Show_Reportee_Data,Show_Reportee_Data#1,1$#table_50_0_table_50_id,table_50_0_table_50_id#1,1$#table_51_0_table_51_id,table_51_0_table_51_id#1,1$#table_235_3_table_235,table_235_3_table_235#1,1$#table_238_3_table_238,table_238_3_table_238#1,1$#table_204_3_table_204,table_204_3_table_204#1,1$#table_221_3_table_221,table_221_3_table_221#1,1$#table_227_3_table_227,table_227_3_table_227#1,1$#table_41_3_table_41,table_41_3_table_41#1,1$#table_45_3_table_45,table_45_3_table_45#1,1$#table_47_3_table_47,table_47_3_table_47#1,1$#table_46_3_table_46,table_46_3_table_46#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$#table_243_3_table_243,table_243_3_table_243#1,1$#Login_Allowed,Login_Allowed#1,1$' where rolename = 'super admin profile' and formname = 'table_6' and modulename = 'Setup'";
	execSQL($con, $sql);
	$sql = "alter table table_6_frm add `Login_Allowed` varchar(40);";
	execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder=fieldorder+1 where formname='table_6' and type in
('subtable','form_history')";
	execSQL($con, $sql);
	$sql = "update table_2_frmfields set fields=concat(fields,'#Login_Allowed,Login_Allowed#1,1$') where formname='table_6' and rolename='super admin profile';";
	execSQL($con, $sql);
	$sql = "update table_6_frm set Login_Allowed = 'All' where Login_Allowed is NUll";
	execSQL($con, $sql);
	$sql = "update formfieldtable set defaultvalue='UserLogin,All' where formname='table_6' and name='Login_Allowed';";
	execSQL($con, $sql);
}

function updateOrgFormDetails($con) {
	$sql = "update formtable set labelname = 'My Company' where formname = 'table_21' and labelname = 'Account'";
	execSQL($con, $sql);
	$sql = "update formfieldtable set label = 'Employee ID' where formname = 'table_6' and name = 'loginid'";
	execSQL($con, $sql);
	$sql = "insert into formfieldtable values('Setup', 'table_21', 'Is_Daily_Reports_Needed', 'Is Daily Reports Needed', 'CheckBox', '40', '', '', '', '','0', '0', '100', '200', '150', '0', '0', 'Normal', 'Advanced', '', '1', '0', '29', '0', '0', '0', '0', '0', '', '1', 0, 0, 0,'ALL', NULL);";
	$result = execSQL($con, $sql);
	$sql = "alter table table_21_frm add `Is_Daily_Reports_Needed` varchar(40) after `Country`;";
	$result = execSQL($con, $sql);
	$sql = "update table_2_frmfields set fields=concat(fields,'#Is_Daily_Reports_Needed,Is_Daily_Reports_Needed#1,1$') where formname='table_21';";
	$result = execSQL($con, $sql);
	$sql = " insert into formfieldtable values('Setup', 'table_21', 'Daily_Reports_Time', 'Daily Reports Time', 'Time', '40', '','', '', '','0', '0', '100', '200', '150','0', '0','Normal', 'Advanced', '', '1','0', '30', '0', '0', '0','0', '0', '', '1', 0, 0, 0, 'ALL', NULL);";
	$result = execSQL($con, $sql);
	$sql = "alter table table_21_frm add `Daily_Reports_Time` Time  NULL after `Is_Daily_Reports_Needed`;";
	$result = execSQL($con, $sql);
	$sql = "update table_2_frmfields set fields=concat(fields,'#Daily_Reports_Time,Daily_Reports_Time#1,1$') where formname='table_21';";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder=fieldorder+2 where formname='table_21' and type in
('form_history')";
	execSQL($con, $sql);
	$sql = "update formtable set style = 'g_root,g_root,0,1,0,0,0,0$true,g_root,g_Account Information,0,2,0,0,0,0$true,g_Account Information,f_1,0,0,0,0,0,0$true,g_Account Information,f_7,1,0,0,0,0,0$true,g_Account Information,f_5,2,0,0,0,0,0$true,g_Account Information,f_2,3,0,0,0,0,0$true,g_root,g_Primary Contact Detail,1,2,0,0,0,0$true,g_Primary Contact Detail,f_21,0,0,0,0,0,0$true,g_Primary Contact Detail,f_4,1,0,0,0,0,0$true,g_Primary Contact Detail,f_6,2,0,0,0,0,0$true,g_Primary Contact Detail,f_22,3,0,0,0,0,0$true,g_root,g_Address Information,2,2,0,0,0,0$true,g_Address Information,f_23,0,0,0,0,0,0$true,g_Address Information,f_24,1,0,0,0,0,0$true,g_Address Information,f_25,2,0,0,0,0,0$true,g_Address Information,f_26,3,0,0,0,0,0$true,g_Address Information,f_27,4,0,0,0,0,0$true,g_Address Information,f_28,5,0,0,0,0,0$true,g_root,g_Other Information,3,2,0,0,0,0$true,g_Other Information,f_9,0,0,0,0,0,0$true,g_Other Information,f_10,1,0,0,0,0,0$true,g_Other Information,f_14,2,0,0,0,0,0$true,g_root,g_Daily Reports,4,3,0,0,0,0$true,g_Daily Reports,f_29,0,0,0,0,0,0$true,g_Daily Reports,f_30,1,0,0,0,0,0$true' where formname='table_21' and modulename = 'Setup';";
	$result = execSQL($con, $sql);
}

function updateOrgFormDetails_1($con) {
	$currentime = date('Y-m-d H:i:s');
	$sql = "insert into formfieldtable values('Setup','table_21','Email_To','Email To','Text Area','1000','','','','','0','0','100','200','150','0','0','Normal','Advanced','','1','0','31','0','0','0','0','0','','1',0,0,0,'ALL',NULL);";
	$result = execSQL($con, $sql);
	$sql = "alter table table_21_frm add `Email_To` varchar(1000) after `Daily_Reports_Time`";
	$result = execSQL($con, $sql);
	$sql = "insert into picklisttable values( 'Auto Tracking', 'On', 0,0,'$currentime','0' )";
	$result = execSQL($con, $sql);
	$sql = "insert into picklisttable values( 'Auto Tracking', 'Off', 1,0,'$currentime','0' )";
	$result = execSQL($con, $sql);
	$sql = "insert into formfieldtable values('Setup','table_21','Auto_Tracking','Auto Tracking','ComboBox','40','','','','','0','0','100','200','150','0','0','Normal',
'Advanced','Auto Tracking,On','1','0','32','0','0','0','0','0','','1',0,0,0,'ALL',NULL);";
	$result = execSQL($con, $sql);
	$sql = "alter table table_21_frm add `Auto_Tracking` varchar(40) after `Email_To`";
	$result = execSQL($con, $sql);
	$sql = "insert into formfieldtable values('Setup','table_21','Force_Location_Capture','Force Location Capture','CheckBox','40','','','','','0','0','100','200','150',
 '0','0','Normal','Advanced','Yes','1','0','33','0','0','0','0','0','','1',0,0,0,'ALL',NULL);";
	$result = execSQL($con, $sql);
	$sql = "alter table table_21_frm add `Force_Location_Capture` varchar(40) after `Auto_Tracking`";
	$result = execSQL($con, $sql);
	$sql = "insert into picklisttable values( 'Tracking Interval', '15 Minutes', 0,0,'$currentime','0' )";
	$result = execSQL($con, $sql);
	$sql = "insert into picklisttable values( 'Tracking Interval', '30 Minutes', 1,0,'$currentime','0' )";
	$result = execSQL($con, $sql);
	$sql = "insert into picklisttable values( 'Tracking Interval', '45 Minutes', 2,0,'$currentime','0' )";
	$result = execSQL($con, $sql);
	$sql = "insert into picklisttable values( 'Tracking Interval', '60 Minutes', 3,0,'$currentime','0' )";
	$result = execSQL($con, $sql);
	$sql = "insert into formfieldtable values('Setup','table_21','Tracking_Interval','Tracking Interval','ComboBox','40','','','','','0','0','100','200','150','0',
 '0','Normal','Advanced','Tracking Interval,15 Minutes','1','0','34','0','0','0','0','0','','1',0,0,0,'ALL',NULL);";
	$result = execSQL($con, $sql);
	$sql = "alter table table_21_frm add `Tracking_Interval` varchar(40) after `Force_Location_Capture`";
	$result = execSQL($con, $sql);
	$sql = "update formtable set style = 'g_root,g_root,0,1,0,0,0,0$true,g_root,g_Account Information,0,2,0,0,0,0$true,g_Account Information,f_19,0,0,0,0,0,0$true,g_Account Information,f_1,1,0,0,0,0,0$true,g_Account Information,f_7,2,0,0,0,0,0$true,g_Account Information,f_5,3,0,0,0,0,0$true,g_Account Information,f_2,4,0,0,0,0,0$true,g_root,g_Primary Contact Detail,1,2,0,0,0,0$true,g_Primary Contact Detail,f_21,0,0,0,0,0,0$true,g_Primary Contact Detail,f_4,1,0,0,0,0,0$true,g_Primary Contact Detail,f_6,2,0,0,0,0,0$true,g_Primary Contact Detail,f_22,3,0,0,0,0,0$true,g_root,g_Address Information,2,2,0,0,0,0$true,g_Address Information,f_23,0,0,0,0,0,0$true,g_Address Information,f_24,1,0,0,0,0,0$true,g_Address Information,f_25,2,0,0,0,0,0$true,g_Address Information,f_26,3,0,0,0,0,0$true,g_Address Information,f_27,4,0,0,0,0,0$true,g_Address Information,f_28,5,0,0,0,0,0$true,g_root,g_Other Information,3,2,0,0,0,0$true,g_Other Information,f_9,0,0,0,0,0,0$true,g_Other Information,f_10,1,0,0,0,0,0$true,g_Other Information,f_14,2,0,0,0,0,0$true,g_root,g_Settings-Daily Reports,4,2,0,0,0,0$true,g_Settings-Daily Reports,f_29,0,0,0,0,0,0$true,g_Settings-Daily Reports,f_30,1,0,0,0,0,0$true,g_Settings-Daily Reports,f_31,2,0,0,0,0,0$true,g_root,g_Settings-Auto Tracking,5,2,0,0,0,0$true,g_Settings-Auto Tracking,f_32,0,0,0,0,0,0$true,g_Settings-Auto Tracking,f_34,1,0,0,0,0,0$true,g_root,g_Settings-Location,6,2,0,0,0,0$true,g_Settings-Location,f_33,0,0,0,0,0,0$true' where formname='table_21' and modulename = 'Setup'";
	$result = execSQL($con, $sql);
	$sql = "update table_2_frmfields set fields=concat(fields,'#Email_To,Email_To#1,1$#Auto_Tracking,Auto_Tracking#1,1$#Force_Location_Capture,Force_Location_Capture#1,1$#Tracking_Interval,Tracking_Interval#1,1$') where formname='table_21';";
	$result = execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder=fieldorder+3 where formname='table_21' and type in
	('form_history','subtable')";
	execSQL($con, $sql);
	$sql = "select min(fieldorder) from formfieldtable where formname='table_6' and type in('Subtable');";
	$result = getResultArray($con, $sql);
	$fieldorder = $result[0][0];
	$sql = "select fieldorder from formfieldtable where formname='table_6' and name in('Login_Allowed');";
	$result = getResultArray($con, $sql);
	$lfieldorder = $result[0][0];
	$increment = 0;
	if ($lfieldorder > $fieldorder) {
		$sql = "update formfieldtable set fieldorder='$fieldorder' where formname='table_6' and name in('Login_Allowed');";
		$result = execSQL($con, $sql);
		if ($result > 0) {
			insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
			$increment = $increment + 1;
		}
	}
	$sql = "insert into formfieldtable values('Setup','table_6','Auto_Tracking','Auto Tracking','ComboBox','40','','','','','0','0','100','200','150','0','0','Normal',
'Advanced','Auto Tracking,On','1','0',$fieldorder+$increment,'0','0','0','0','0','','1',0,0,0,'ALL',NULL);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "alter table table_6_frm add `Auto_Tracking` varchar(40) after `Login_Allowed`";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_6_frm", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update table_2_frmfields set fields=concat(fields,'#Auto_Tracking,Auto_Tracking#1,1$') where formname='table_6' and rolename='super admin profile';";
	execSQL($con, $sql);
	$sql = "update formfieldtable set fieldorder=fieldorder+($increment+1) where formname='table_6' and type in
('subtable','form_history')";
	execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
}

function addSystemReports($con) {
	$sql = "select formname,modulename from formtable where formtype = 'checkin/checkout';";
	$resultrows = getResultArray($con, $sql);
	$attformname = $resultrows[0][0];
	$attmodulename = $resultrows[0][1];
	$sql = "select name from formfieldtable where formname = 'table_52' and label like  '%Customer%' and type = 'reference' and name like 'table_%'";
	$result = getResultArray($con, $sql);
	$customerfieldname = $result[0][0];
	$customerformnamearr = split("_", $customerfieldname);
	$customerformname = $customerformnamearr[0] . "_" . $customerformnamearr[1];
	$sql = "select max(cast(reportid as signed)) from reportform FOR UPDATE ;";
	$result = getResultArray($con, $sql);
	$reportid = $result[0][0];
	$reportid = $reportid + 1;
	$sql = " select moduleorder from reportmodule where name='Daily Reports';";
	$result = getResultArray($con, $sql);
	$maxmoduleorder = $result[0][0];
	$sql = " select max(reportorder) from reportmodule where name='Daily Reports';";
	$result = getResultArray($con, $sql);
	$reportorder = $result[0][0];
	$reportorder = $reportorder + 1;
	$sql = "select max(cast(groupid as signed)) from reportgrouptable FOR UPDATE ;";
	$result = getResultArray($con, $sql);
	$groupid = $result[0][0];
	$groupid = $groupid + 1;
	$sql = "select modulename from formtable where formname = 'table_52';";
	$resultrows = getResultArray($con, $sql);
	$taskmodulename = $resultrows[0][0];
	$currentdatetime = date("Y-m-d H:i:s");
	$sql = " insert into reportform values($reportid, '',  'Customer Wise Time Spending','','Customer Wise Task Detail','','','', 'Table', 0,'USer-Status.png',0, 0, 0, '','1','2015-07-03 15:25:56','0','$taskmodulename','table_52');";
	execSQL($con, $sql);
	$reportfieldorder=0;
	if ($customerfieldname != "") {
		$sql = " insert into reportfieldtable values($reportid,'$taskmodulename', 'table_52', '$customerfieldname', '', '','0','0','100','','','','','$reportfieldorder');";
		execSQL($con, $sql);
		$reportfieldorder++;
	}
	$sql = " insert into reportfieldtable values($reportid,'$taskmodulename', 'table_52', 'Subject', 'Completed Task', '','0','0','100','','','','','$reportfieldorder');";
	execSQL($con, $sql);
	$reportfieldorder++;
	$sql = " insert into reportfieldtable values($reportid,'$taskmodulename', 'table_52', 'Planned_Hours', 'Planned Hrs', '','0','0','100','','','','','$reportfieldorder');";
	execSQL($con, $sql);
	$reportfieldorder++;
	$sql = " insert into reportfieldtable values($reportid,'$taskmodulename', 'table_52', 'Actual_Hours', 'Actual Hrs', '','0','0','100','','','','','$reportfieldorder');";
	execSQL($con, $sql);	
	$sql = " insert into reportfilterfieldvaluetable values($reportid,'$taskmodulename', 'table_52', 'Status','is', 'Closed','',0);";
	execSQL($con, $sql);	
	$sql = "insert into reportmodule values( 'Daily Reports', $reportid,'$reportorder','$maxmoduleorder')";
	execSQL($con, $sql);
	$sql = "insert into reportsubmodule values( '', $reportid)";
	execSQL($con, $sql);

	if ($attmodulename != "" && $attformname != "") {
		$reportid = $reportid + 1;
		$reportorder = $reportorder + 1;
		$groupid = $groupid + 1;
		$sql = " insert into reportform values($reportid, '',  'Payroll Report','','Payroll Report','','','', 'Table', 0,'USer-Status.png',0, 0, 0, '','1','2015-07-03 15:25:56','0','$attmodulename','$attformname');";
		execSQL($con, $sql);
		$reportfieldorder=0;
		$sql = " insert into reportfieldtable values($reportid,'Setup', 'table_6', 'loginid', '', '','0','0','100','','','','','$reportfieldorder');";
		execSQL($con, $sql);
		$reportfieldorder++;
		$sql = " insert into reportfieldtable values($reportid,'Setup', 'table_6', 'Name', '', '','0','0','100','','','','','$reportfieldorder');";
		execSQL($con, $sql);
		$reportfieldorder++;
		$sql = " insert into reportfieldtable values($reportid,'$attmodulename', '$attformname', 'In_Location', 'Date', '','0','0','100','','','','','$reportfieldorder');";
		execSQL($con, $sql);
		$reportfieldorder++;
		$sql="select name from formfieldtable where formname='$attformname' and name='In_Notes'";
		$result = getResultArray($con, $sql);
		if(sizeof($result)>0){
		$sql = " insert into reportfieldtable values($reportid,'$attmodulename', '$attformname', 'In_Notes', 'Status', '','0','0','100','','','','','$reportfieldorder');";
		execSQL($con, $sql);
		$reportfieldorder++;	
		}	
		$sql = " insert into reportfieldtable values($reportid,'$attmodulename', '$attformname', 'In_Time', 'Check In', '','0','0','100','','','','','$reportfieldorder');";
		execSQL($con, $sql);
		$reportfieldorder++;
		$sql = " insert into reportfieldtable values($reportid,'$attmodulename', '$attformname', 'Out_Time', 'Check Out', '','0','0','100','','','','','$reportfieldorder');";
		execSQL($con, $sql);
		$reportfieldorder++;
		$sql="select name from formfieldtable where formname='$attformname' and name='Out_Notes'";
		$result = getResultArray($con, $sql);
		if(sizeof($result) > 0){
		$sql = " insert into reportfieldtable values($reportid,'$attmodulename', '$attformname', 'Out_Notes', 'Total Hrs', '','0','0','100','','','','','$reportfieldorder');";
		execSQL($con, $sql);
		$reportfieldorder++;	
		}		
		$sql = " insert into reportfieldtable values($reportid,'$attmodulename', '$attformname', 'In_Location_latitude', 'Working Hrs', '','0','0','100','','','','','$reportfieldorder');";
		execSQL($con, $sql);
		$sql = " insert into reportfilterfieldvaluetable values($reportid,'$attmodulename', '$attformname', 'In_Time','Last 30 Days', '22015-07-22 00:00:00#2015-08-22 23:59:00','',0);";
		execSQL($con, $sql);
		$sql = " insert into reportfilterfieldtable values($reportid,'Setup', 'table_6', 'Name','0');";
		execSQL($con, $sql);
		$sql = " insert into reportfilterfieldtable values($reportid,'Setup', 'table_6', 'loginid','1');";
		execSQL($con, $sql);
		$sql = "insert into reportmodule values( 'Daily Reports', $reportid,'$reportorder','$maxmoduleorder')";
		execSQL($con, $sql);
		$sql = "insert into reportsubmodule values( '', $reportid)";
		execSQL($con, $sql);
	}
}

function migrateapiupdatelogtable($con) {
	$sql = "show columns from apiupdatelog where field='retrycount';";
	$collist = getResultArray($con, $sql);
	if (sizeof($collist) == 0) {
		$sql = "alter table apiupdatelog add `retrycount` varchar(50) default '0';";
		execSQL($con, $sql);
	}
}

function removeindexfromuserformtable($con) {
	$sql = "show index from table_6_frm where key_name='Unique_Keys';";
	$collist = getResultArray($con, $sql);
	if (sizeof($collist) > 0) {
		$sql = "alter table table_6_frm drop index `Unique_Keys`;";
		execSQL($con, $sql);
	}
}

function createEmaillogTable($con) {
	$sql = "use  " . DBINFO::$APPDBNAME;
	execSQL($con, $sql);
	$sql = "show tables like 'emaillog'";
	$applist = getResultArray($con, $sql);
	if (sizeof($applist) <= 0) {
		$sql = "create table " . DBINFO::$APPDBNAME . ".emaillog (appid varchar(50),formname varchar(50),formid varchar(50),updatefield varchar(50),messageid varchar(50),toaddress varchar(100),ccaddress varchar(100),bccaddress varchar(100)) ENGINE=InnoDB";
		execSQL($con, $sql);
	}
}

function createVisitForm($con) {
	$sql = "CREATE TABLE `table_55_frm` (
  `table_55_id` varchar(40) NOT NULL,
  `table_6_0_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `createdon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Due_Date` date DEFAULT NULL,
  `table_6_3_table_6_id` varchar(30) DEFAULT NULL,
  `table_6_3_table_6_group_id` varchar(30) DEFAULT NULL,
  `Subject` varchar(1000) DEFAULT NULL,
  `Status` varchar(40) DEFAULT NULL,
  `Planned_Start` varchar(40) DEFAULT NULL,
  `Planned_End` varchar(40) DEFAULT NULL,
  `Actual_Start` varchar(40) DEFAULT NULL,
  `Actual_End` varchar(40) DEFAULT NULL,
  `Planned_Hours` varchar(50) DEFAULT NULL,
  `Actual_Hours` varchar(50) DEFAULT NULL,
  `Comments` varchar(2000) DEFAULT NULL,
  `table_6_1_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `updatedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `table_6_2_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `viewedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`table_55_id`),
  KEY `table_55_frmtable_6_3_table_6_id` (`table_6_3_table_6_id`),
  KEY `table_55_frmtable_6_3_table_6_group_id` (`table_6_3_table_6_group_id`),
  CONSTRAINT `table_55_frmtable_6_3_table_6_group_id` FOREIGN KEY (`table_6_3_table_6_group_id`) REFERENCES `table_6_group_frm` (`table_6_group_id`),
  CONSTRAINT `table_55_frmtable_6_3_table_6_id` FOREIGN KEY (`table_6_3_table_6_id`) REFERENCES `table_6_frm` (`table_6_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_55", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");

	$sql = "alter table table_6_frm add column `3table_55_id` varchar(4000) DEFAULT NULL;";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_55", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");

	$sql = "CREATE TABLE `3table_6_table_55_frm` (
  `table_6_id` varchar(30) DEFAULT NULL,
  `table_55_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_55", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");

	$sql = "SELECT max(relationid) FROM formrelationtable;";
	$result = getResultArray($con, $sql);
	$maxrelation = $result[0][0];
	$sql = "INSERT INTO `formtable` VALUES ('Scheduler','table_55','Visits','',0,'',0,0,'1,1',1,0,'notes.png','g_root,g_root,0,1,0,0,0,0$true,g_root,g_Basic Information,0,2,0,0,0,0$true,g_Basic Information,f_4,0,0,0,0,0,0$true,g_Basic Information,f_1,1,0,0,0,0,0$true,g_Basic Information,f_2,2,0,0,0,0,0$true,g_Basic Information,f_5,3,0,0,0,0,0$true,g_root,g_Hours Information,1,2,0,0,0,0$true,g_Hours Information,f_6,0,0,0,0,0,0$true,g_Hours Information,f_7,1,0,0,0,0,0$true,g_Hours Information,f_8,2,0,0,0,0,0$true,g_Hours Information,f_9,3,0,0,0,0,0$true,g_Hours Information,f_10,4,0,0,0,0,0$true,g_Hours Information,f_11,5,0,0,0,0,0$true,g_root,g_Comments,2,1,0,0,0,0$true,g_Comments,f_12,0,0,0,0,0,0$true',0,0,0,0,0,0,0,0,0,'','',0,1,0,1,0);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");

	$sql = "delete from picklisttable where name='Visit Status'";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "picklisttable", "", SYNC_ACTION::$STRUC_DELETE, $sql, "");

	$sql = "INSERT INTO `picklisttable` VALUES ('Visit Status','Closed',2,'0','2015-02-18 10:31:24','0'),('Visit Status','Open',0,'0','2015-02-18 10:31:24','0'),('Visit Status','Progress',1,'0','2015-02-18 10:31:24','0');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "picklisttable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "select max(fieldorder) from formfieldtable where formname='table_6' and type not in ('form_history');";
	$result = getResultArray($con, $sql);
	$maxfieldorder = $result[0][0];
	$maxfieldorder = $maxfieldorder + 1;
	$sql = "INSERT INTO `formfieldtable` VALUES ('Scheduler','table_55','Actual_End','Actual End','Date_Time','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,9,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
	('Scheduler','table_55','Actual_Hours','Actual Hours','Date_Time_Text','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,11,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
	('Scheduler','table_55','Actual_Start','Actual Start','Date_Time','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,8,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
	('Scheduler','table_55','Comments','Comments','Text Area','2000','','','','',0,0,100,500,300,0,0,'Normal','Advanced','',1,0,12,0,0,1,0,0,'',0,0,0,0,'ALL',NULL),
	('Scheduler','table_55','createdon','Created Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,14,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
	('Scheduler','table_55','Due_Date','Due Date','date','40','','','','',0,0,100,200,150,0,1,'Normal','Advanced','current',1,0,1,0,0,1,0,0,'',1,0,0,0,'ALL',NULL),
	('Scheduler','table_55','Planned_End','Planned End','Date_Time','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,7,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
	('Scheduler','table_55','Planned_Hours','Planned Hours','Date_Time_Text','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,10,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
	('Scheduler','table_55','Planned_Start','Planned Start','Date_Time','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','current',1,0,6,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
	('Scheduler','table_55','Status','Status','ComboBox','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','Visit Status,Open',1,0,5,0,0,1,0,0,'',1,0,0,0,'ALL',NULL),
	('Scheduler','table_55','Subject','Subject','Text','1000','','','','',0,0,100,500,300,0,0,'Normal','Advanced','',1,0,4,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
	('Scheduler','table_55','table_55_id','table_55_id','form_entityid','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,0,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
	('Scheduler','table_55','table_6_0_createdusername','Created Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,13,0,0,0,0,0,'',1,0,0,0,'ALL',$maxrelation+1),
	('Scheduler','table_55','table_6_1_updatedusername','Updated Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,15,0,0,0,0,0,'',1,0,0,0,'ALL',$maxrelation+2),
	('Scheduler','table_55','table_6_2_viewedusername','Viewed Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,17,0,0,0,0,0,'',1,0,0,0,'ALL',$maxrelation+3),
	('Scheduler','table_55','table_6_3_table_6_group_id','Assigned to group','reference_group','40','','','','',1,1,100,200,150,0,0,'Normal','Advanced','current',1,0,3,0,0,0,0,0,'',1,0,0,0,'ALL',$maxrelation+6),
	('Scheduler','table_55','table_6_3_table_6_id','Assigned To','entity_group','40','','','','',0,0,100,200,150,0,1,'Normal','Advanced','current',1,0,2,0,0,1,0,0,'',1,0,0,0,'ALL',$maxrelation+4),
	('Scheduler','table_55','updatedon','Updated Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,16,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
	('Scheduler','table_55','viewedon','Viewed Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,18,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),
	('Setup','table_6','table_55_3_table_55','Visits','subtable','40','','','','',1,0,100,200,150,0,0,'Normal','Advanced','current',1,0,$maxfieldorder,0,0,0,0,0,'',1,0,0,0,'ALL',$maxrelation+5),
	('Setup','table_6_group','table_55_0_table_55','Visits','subtable','40','','','','',1,1,100,200,150,0,0,'Normal','Advanced','current',1,0,4,0,0,0,0,0,'',1,0,0,0,'ALL',$maxrelation+7);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "update formfieldtable set fieldorder=fieldorder+1 where formname='table_6' and type in
('form_history')";
	execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "INSERT INTO `formactiontable` VALUES ('Scheduler','table_55','Add','Add',1,'',0),('Scheduler','table_55','Calendar','Calendar',1,'',5),('Scheduler','table_55','Customize','Customize',1,'',9),('Scheduler','table_55','Delete','Delete',1,'',2),('Scheduler','table_55','Edit','Edit',1,'',1),('Scheduler','table_55','Export','Export',1,'',7),('Scheduler','table_55','Import','Import',1,'',6),('Scheduler','table_55','Print','Print',1,'',8),('Scheduler','table_55','Search','Search',1,'',4),('Scheduler','table_55','View','View',1,'',3);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formactiontable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");

	$sql = "INSERT INTO `table_2_frmfields` VALUES ('super admin profile','Scheduler','table_55','#table_55_id,table_55_id#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$#Due_Date,Due_Date#1,1$#table_6_3_table_6_id,table_6_3_table_6_id#1,1$#table_6_3_table_6_group_id,table_6_3_table_6_group_id#1,1$#Subject,Subject#1,1$#Status,Status#1,1$#Planned_Start,Planned_Start#1,1$#Planned_End,Planned_End#1,1$#Actual_Start,Actual_Start#1,1$#Actual_End,Actual_End#1,1$#Planned_Hours,Planned_Hours#1,1$#Actual_Hours,Actual_Hours#1,1$#Comments,Comments#1,1$');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_2_frmfields", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");

	$sql = "INSERT INTO `table_2_frmaction` VALUES ('super admin profile','Scheduler','table_55','ScreenAccess,ScreenAccess#Add,Add#Edit,Edit#Delete,Delete#View,View#Search,Search#Calendar,Calendar#Import,Import#Export,Export#Print,Print#Customize,Customize#');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_2_frmaction", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");

	$sql = "INSERT INTO `table_2_frmscreen` VALUES ('super admin profile','Scheduler','table_55,table_55');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_2_frmscreen", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");

	$sql = "INSERT INTO `idgenerator` VALUES ('table_55_frm','0');";
	$result = execSQL($con, $sql);

	$sql = "INSERT INTO `formfieldreference` VALUES ('Scheduler','table_55','table_6_0_createdusername','Setup','table_6','Name',$maxrelation+1),('Scheduler','table_55','table_6_1_updatedusername','Setup','table_6','Name',$maxrelation+2),('Scheduler','table_55','table_6_2_viewedusername','Setup','table_6','Name',$maxrelation+3),('Scheduler','table_55','table_6_3_table_6_group_id','Setup','table_6_group','groupname',$maxrelation+6),('Scheduler','table_55','table_6_3_table_6_id','Setup','table_6','Name',$maxrelation+4),
	('Setup','table_6','table_55_3_table_55','Scheduler','table_55','',$maxrelation+5),
	('Setup','table_6_group','table_55_0_table_55','Scheduler','table_55','',$maxrelation+7);";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldreference", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");

	$sql = "INSERT INTO `formrelationtable` VALUES
	($maxrelation+1,$maxrelation+1,0,'table_55','table_6','n-1','',0,''),($maxrelation+2,$maxrelation+2,1,'table_55','table_6','n-1','',0,''),($maxrelation+3,$maxrelation+3,2,'table_55','table_6','n-1','',0,''),($maxrelation+4,$maxrelation+5,3,'table_55','table_6','n-1','',1,''),($maxrelation+5,$maxrelation+4,3,'table_6','table_55','1-n','',1,''),($maxrelation+6,$maxrelation+7,0,'table_55','table_6_group','n-1','',1,''),($maxrelation+7,$maxrelation+6,0,'table_6_group','table_55','1-n','',1,'');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "formrelationtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");

	$sql = "SELECT max(cast(templateid as unsigned)) FROM searchtemplate";
	$result = getResultArray($con, $sql);
	$maxtempid = $result[0][0];

	$sql = "INSERT INTO `searchtemplate` VALUES ('','table_55','sadmin','@','Setup',1,'',$maxtempid+1,1,1,0,NULL,'0','0'),
	('All records','table_55','sadmin','@','Setup',1,'',$maxtempid+2,1,1,0,NULL,'0','0'),
	('My records','table_55','sadmin','@','Setup',1,'',$maxtempid+3,1,1,0,NULL,'0','0'),
	('Todays records','table_55','sadmin','@','Setup',1,'',$maxtempid+4,1,1,0,NULL,'0','0'),
	('Recently Created','table_55','sadmin','@','Setup',1,'',$maxtempid+5,1,1,0,NULL,'0','0'),
	('Recently Updated','table_55','sadmin','@','Setup',1,'',$maxtempid+6,1,1,0,NULL,'0','0'),
	('Recently Viewed','table_55','sadmin','@','Setup',1,'',$maxtempid+7,1,1,0,NULL,'0','0');";
	$result = execSQL($con, $sql);
	insertSyncQueryDetails($con, "searchtemplate", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
}

function migrateVisitForm($con) {
	$sql = "select max(fieldorder) from formfieldtable where formname='table_55' and type not in ('form_history','subtable');";
	$resultrow = getResultArray($con, $sql);
	if (sizeof($resultrow) > 0) {
		$maxfieldorder = $resultrow[0][0];
		$sql = "select modulename from formtable where formname='table_55'";
		$result = getResultArray($con, $sql);
		$modulename = $result[0][0];
		$sql = "insert into formfieldtable values('$modulename','table_55','trigger_action','trigger action','CheckBox','40','','','','','1','1','100','200','150','0','0','Normal','NO',
		'No','1','0','$maxfieldorder','0','0','0','0','0','','1',0,0,0,'ALL',NULL);";
		$result = execSQL($con, $sql);
		insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
		$sql = "update formfieldtable set fieldorder = fieldorder+1 where formname='table_55' and type in ('form_history','subtable');";
		$result = execSQL($con, $sql);
		insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
		$sql = "alter table table_55_frm add `trigger_action` varchar(40) after `Comments`";
		$result = execSQL($con, $sql);
		insertSyncQueryDetails($con, "table_55_frm", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	}
}

function migrateTaskForm($con) {
	$sql = "select modulename from formtable where formname='table_52';";
	$result = getResultArray($con, $sql);
	$modulename = $result[0][0];
	if ($modulename != 'Tasks') {
		$sql = "select * from moduletable where name='Tasks'";
		$modulearr = getResultArray($con, $sql);
		$modulename = "Tasks";
		if (sizeof($modulearr) == 0) {
			$sql = "select max(cast(moduleorder as unsigned)) from moduletable";
			$moduleorderarr = getResultArray($con, $sql);
			$moduleorder = $moduleorderarr[0][0];
			$sql = "insert into moduletable values('$modulename','micon.png','$moduleorder+1')";
			$result = execSQL($con, $sql);
			insertSyncQueryDetails($con, "moduletable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
		}
		$sql = "SET FOREIGN_KEY_CHECKS = 0;";
		$result = execSQL($con, $sql);
		$sql = "update formtable set modulename='$modulename' where formname='table_52';";
		$result = execSQL($con, $sql);
		insertSyncQueryDetails($con, "formtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
		$sql = "update formfieldtable set modulename='$modulename' where formname='table_52';";
		$result = execSQL($con, $sql);
		insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
		$sql = "update formactiontable set modulename='$modulename' where formname='table_52';";
		$result = execSQL($con, $sql);
		insertSyncQueryDetails($con, "formactiontable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
		$sql = "update table_2_frmfields set modulename='$modulename' where formname='table_52';";
		$result = execSQL($con, $sql);
		insertSyncQueryDetails($con, "table_2_frmfields", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
		$sql = "update table_2_frmaction set modulename='$modulename' where formname='table_52';";
		$result = execSQL($con, $sql);
		insertSyncQueryDetails($con, "table_2_frmaction", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
		$sql = "update formfieldreference set modulename='$modulename' where formname='table_52';";
		$result = execSQL($con, $sql);
		insertSyncQueryDetails($con, "formfieldreference", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
		$sql = "update table_2_frmscreen set modulename='$modulename' where formname like '%table_52%';";
		$result = execSQL($con, $sql);
		insertSyncQueryDetails($con, "table_2_frmscreen", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
		$sql = "SET FOREIGN_KEY_CHECKS = 1;";
		$result = execSQL($con, $sql);
	}
}

function createTaxForms($con) {

	$sql = "select * from moduletable where name = 'Products' ;";
	$res = getResultArray($con, $sql);
	if (sizeof($res) <= 0) {
		$sql = "select max(cast(moduleorder as signed)) from moduletable";
		$resultrows = getResultArray($con, $sql);
		$morder = $resultrows[0][0] + 1;
		$sql = "insert into moduletable values ('Products','micon.png','$morder');";
		$result = execSQL($con, $sql);
	}
	$sql = "select * from formtable where formname = 'table_56';";
	$res = getResultArray($con, $sql);
	if (sizeof($res) <= 0) {
		$sql = "INSERT INTO `formtable` VALUES ('Products','table_56','Tax Master Line Item','',0,'',0,0,'0,0',1,0,'ficon.png','g_root,g_root,0,1,0,0,0,0$true,g_root,g_Tax Info,0,2,0,0,0,0$true,g_Tax Info,f_1,0,0,0,0,0,0$true,g_Tax Info,f_2,1,0,0,0,0,0$true',0,0,0,0,0,0,0,0,0,'','',0,1,0,1,0);";
		$result = execSQL($con, $sql);
		$sql = "INSERT INTO `formfieldtable` VALUES 
		('Products','table_56','createdon','Created Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,5,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Products','table_56','table_56_id','Form ID','form_entityid','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,0,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Products','table_56','table_57_0_table_57_id','Tax Group','reference','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,3,0,0,0,0,0,'',1,0,0,0,'ALL',436),('Products','table_56','table_6_0_createdusername','Created Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,4,0,0,0,0,0,'',1,0,0,0,'ALL',429),('Products','table_56','table_6_1_updatedusername','Updated Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,6,0,0,0,0,0,'',1,0,0,0,'ALL',430),('Products','table_56','table_6_2_viewedusername','Viewed Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,8,0,0,0,0,0,'',1,0,0,0,'ALL',431),('Products','table_56','Tax_Name','Tax Name','Referred','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,1,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Products','table_56','Tax__in_','Tax ( in %)','Referred','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,2,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Products','table_56','updatedon','Updated Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,7,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Products','table_56','viewedon','Viewed Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,9,0,0,0,0,0,'',1,0,0,0,'ALL',NULL);";
		$result = execSQL($con, $sql);
		$sql = "INSERT INTO `idgenerator` VALUES ('table_56_frm','0');";
		$result = execSQL($con, $sql);
		$sql = "INSERT INTO `formactiontable` VALUES ('Products','table_56','Add','Add',1,'',0),('Products','table_56','Calendar','Calendar',1,'',5),('Products','table_56','Customize','Customize',1,'',9),('Products','table_56','Delete','Delete',1,'',2),('Products','table_56','Edit','Edit',1,'',1),('Products','table_56','Export','Export',1,'',7),('Products','table_56','Import','Import',1,'',6),('Products','table_56','Print','Print',1,'',8),('Products','table_56','Search','Search',1,'',4),('Products','table_56','View','View',1,'',3);";
		$result = execSQL($con, $sql);
		$sql = "select max(cast(relationid as signed)) from formfieldreference";
		$resultrows = getResultArray($con, $sql);
		$refid = $resultrows[0][0] + 1;
		$nextid = $refid + 1;
		$nextpid = $refid + 2;

		$sql = "insert into formfieldreference VALUES ('Products','table_56','table_6_0_createdusername','Setup','table_6','Name',$refid),('Products','table_56','table_6_1_updatedusername','Setup','table_6','Name',$nextid),('Products','table_56','table_6_2_viewedusername','Setup','table_6','Name',$nextpid);";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `formrelationtable` VALUES ($refid,$refid,0,'table_56','table_6','n-1','',0,''),($nextid,$nextid,1,'table_56','table_6','n-1','',0,''),($nextpid,$nextpid,2,'table_56','table_6','n-1','',0,'');";
		$result = execSQL($con, $sql);

		$sql = "select max(cast(refid as signed)) from refferedfielddetails";
		$resultrows = getResultArray($con, $sql);
		$refid = $resultrows[0][0] + 1;
		$nextid = $refid + 1;
		$sql = "INSERT INTO `refferedfielddetails` VALUES ($refid,'$refid','Products','table_56','Tax_Name','Products','table_54','Tax_Name','true','','false','','false','','true'),($nextid,'$nextid','Products','table_56','Tax__in_','Products','table_54','Tax_in_','false','','false','','true','$refid','false');";
		$result = execSQL($con, $sql);
		$sql = "select max(cast(templateid as signed)) from searchtemplate";
		$resultrows = getResultArray($con, $sql);
		$tempid = $resultrows[0][0] + 1;
		$tempone = $tempid + 1;
		$temptwo = $tempid + 2;
		$tempthree = $tempid + 3;
		$tempfour = $tempid + 4;
		$tempfive = $tempid + 5;
		$tempsix = $tempid + 6;
		$sql = "INSERT INTO `searchtemplate` VALUES ('','table_56','sadmin','@','Products',1,'',$tempid,1,1,0,NULL,'0','0'),('All records','table_56','sadmin','@','Products',1,'',$tempone,1,1,0,NULL,'0','0'),('My records','table_56','sadmin','@','Products',1,'',$temptwo,1,1,0,NULL,'0','0'),('Todays records','table_56','sadmin','@','Products',1,'',$tempthree,1,1,0,NULL,'0','0'),('Recently Created','table_56','sadmin','@','Products',1,'',$tempfour,1,1,0,NULL,'0','0'),('Recently Updated','table_56','sadmin','@','Products',1,'',$tempfive,1,1,0,NULL,'0','0'),('Recently Viewed','table_56','sadmin','@','Products',1,'',$tempsix,1,1,0,NULL,'0','0');";
		$result = execSQL($con, $sql);
		$sql = "INSERT INTO `table_2_frmaction` VALUES ('super admin profile','Products','table_56','ScreenAccess,ScreenAccess#Add,Add#Edit,Edit#Delete,Delete#View,View#Search,Search#Calendar,Calendar#Import,Import#Export,Export#Print,Print#Customize,Customize#');";
		$result = execSQL($con, $sql);
		$sql = "INSERT INTO `table_2_frmfields` VALUES ('super admin profile','Products','table_56','#table_56_id,table_56_id#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$#Tax_Name,Tax_Name#1,1$#Tax_Name,#1$#Tax__in_,Tax__in_#1,1$#Tax__in_,#1$#table_57_0_table_57_id,table_57_0_table_57_id#1,1$');";
		$result = execSQL($con, $sql);
		$sql = "INSERT INTO `table_2_frmscreen` VALUES ('super admin profile','Products','table_56,table_56');";
		$result = execSQL($con, $sql);
		$sql = "CREATE TABLE `table_56_frm` (
  `table_56_id` varchar(40) NOT NULL,
  `table_6_0_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `createdon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Tax_Name` varchar(40) DEFAULT NULL,
  `Tax__in_` varchar(40) DEFAULT NULL,
  `table_57_0_table_57_id` varchar(30) DEFAULT NULL,
  `table_6_1_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `updatedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `table_6_2_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `viewedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`table_56_id`)
) ENGINE=InnoDB;";
		$result = execSQL($con, $sql);
		$sql = "CREATE TABLE `0table_57_table_56_frm` (
  `table_57_id` varchar(30) DEFAULT NULL,
  `table_56_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB;";
		$result = execSQL($con, $sql);
	}

	$sql = "select * from formtable where formname = 'table_54';";
	$res = getResultArray($con, $sql);
	if (sizeof($res) <= 0) {
		$sql = "INSERT INTO `formtable` VALUES ('Products','table_54','Tax Master','',0,'',0,0,'0,0',1,0,'ficon.png','g_root,g_root,0,1,0,0,0,0$true,g_root,g_Tax Info,0,2,0,0,0,0$true,g_Tax Info,f_1,0,0,0,0,0,0$true,g_Tax Info,f_2,1,0,0,0,0,0$true,g_root,g_Notes,1,1,0,0,0,0$true,g_Notes,f_3,0,0,0,0,0,0$true',0,0,0,0,0,0,0,0,0,'','',0,1,0,1,0);";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `formfieldtable` VALUES 
		('Products','table_54','createdon','Created Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,5,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Products','table_54','Notes','Notes','Text Area','200','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,3,0,0,0,0,0,'',0,0,0,0,'ALL',NULL),('Products','table_54','table_54_id','Form ID','form_entityid','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,0,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Products','table_54','table_6_0_createdusername','Created Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,4,0,0,0,0,0,'',1,0,0,0,'ALL',321),('Products','table_54','table_6_1_updatedusername','Updated Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,6,0,0,0,0,0,'',1,0,0,0,'ALL',322),('Products','table_54','table_6_2_viewedusername','Viewed Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,8,0,0,0,0,0,'',1,0,0,0,'ALL',323),('Products','table_54','Tax_in_','Tax ( in % )','Float','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','0.00',1,0,2,0,1,0,0,0,'',1,0,0,0,'ALL',NULL),('Products','table_54','Tax_Name','Tax Name','Text','40','','','','',0,0,100,200,150,0,1,'Normal','ALL','',1,0,1,1,1,0,0,0,'',1,0,0,0,'ALL',NULL),('Products','table_54','updatedon','Updated Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,7,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Products','table_54','viewedon','Viewed Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,9,0,0,0,0,0,'',1,0,0,0,'ALL',NULL);";
		$result = execSQL($con, $sql);
		$sql = "INSERT INTO `cmprwaccesstable` VALUES ('table_54','40','40',1),('table_54','40','41',1),('table_54','40','42',1),('table_54','40','43',1),('table_54','40','44',1),('table_54','40','45',1),('table_54','40','46',1),('table_54','41','40',1),('table_54','41','41',1),('table_54','41','42',1),('table_54','41','43',1),('table_54','41','44',1),('table_54','41','45',1),('table_54','41','46',1),('table_54','42','44',1),('table_54','42','45',1),('table_54','42','46',1),('table_54','43','44',1),('table_54','43','45',1),('table_54','43','46',1);";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `formactiontable` VALUES ('Products','table_54','Add','Add',1,'',0),('Products','table_54','Calendar','Calendar',1,'',5),('Products','table_54','Customize','Customize',1,'',9),('Products','table_54','Delete','Delete',1,'',2),('Products','table_54','Edit','Edit',1,'',1),('Products','table_54','Export','Export',1,'',7),('Products','table_54','Import','Import',1,'',6),('Products','table_54','Print','Print',1,'',8),('Products','table_54','Search','Search',1,'',4),('Products','table_54','View','View',1,'',3);";
		$result = execSQL($con, $sql);

		/*
		 $sql = "INSERT INTO `formfieldreference` VALUES ('Products','table_54','table_6_0_createdusername','Setup','table_6','Name',321),('Products','table_54','table_6_1_updatedusername','Setup','table_6','Name',322);";
		 $result = execSQL($con, $sql);*/
		$sql = "select max(cast(relationid as signed)) from formfieldreference";
		$resultrows = getResultArray($con, $sql);
		$refid = $resultrows[0][0] + 1;
		$nextid = $refid + 1;
		$nextpid = $refid + 2;

		$sql = "insert into formfieldreference VALUES ('Products','table_54','table_6_0_createdusername','Setup','table_6','Name',$refid),('Products','table_54','table_6_1_updatedusername','Setup','table_6','Name',$nextid),('Products','table_54','table_6_2_viewedusername','Setup','table_6','Name',$nextpid);";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `formrelationtable` VALUES ($refid,$refid,0,'table_54','table_6','n-1','',0,''),($nextid,$nextid,1,'table_54','table_6','n-1','',0,''),($nextpid,$nextpid,2,'table_54','table_6','n-1','',0,'');";
		$result = execSQL($con, $sql);

		// $sql = "select max(cast(relationid as signed)) from formrelationtable";
		// $resultrows = getResultArray($con, $sql);
		// $nextid = $resultrows[0][0] + 1;
		// $nextpone = $nextid + 1;
		// $nextptwo = $nextid + 2;
// 
		// $sql = "INSERT INTO `formrelationtable` VALUES ($nextid ,$nextid ,0,'table_54','table_6','n-1','',0,''),($nextpone,$nextpone ,1,'table_54','table_6','n-1','',0,''),($nextptwo ,$nextptwo ,2,'table_54','table_6','n-1','',0,'');";
		// $result = execSQL($con, $sql);

		$sql = "INSERT INTO `idgenerator` VALUES ('table_54_frm','0');";
		$result = execSQL($con, $sql);

		$sql = "select max(cast(refid as signed)) from refferedfielddetails";
		$resultrows = getResultArray($con, $sql);
		$nextid = $resultrows[0][0] + 1;

		/*
		 $sql = "INSERT INTO `refferedfielddetails` VALUES ($nextid,'1','Products','table_53','Tax_Name','Products','table_54','Tax_Name','true','','false','','false','','true'),($nextid++,'1','Products','table_53','Tax__in__','Products','table_54','Tax_in_','false','','false','','true','10','true'),($nextid++,'1','Products','table_56','Tax_Name','Products','table_54','Tax_Name','true','','false','','false','','true'),($nextid++,'1','Products','table_56','Tax__in_','Products','table_54','Tax_in_','false','','false','','true','21','false'),($nextid++,'1','ProductLineItem','table_229','Tax_Code','Products','table_54','Tax_Name','true','','false','','false','1','true'),($nextid++,'1','ProductLineItem','table_229','Tax__in__','Products','table_54','Tax_in_','false','','false','','true','23','true');";
		 $result = execSQL($con, $sql);*/

		$sql = "INSERT INTO `roleaccesstable` VALUES ('Products','table_54','Role',2,'1','Role',0,'1',1,'2016-01-19 04:53:08','0'),('Products','table_54','Role',2,'2','Role',0,'2',1,'2016-01-19 04:53:18','0'),('Products','table_54','Role',3,'1','Role',0,'1',1,'2016-01-19 04:53:13','0');";
		$result = execSQL($con, $sql);
		$sql = "select max(cast(templateid as signed)) from searchtemplate";
		$resultrows = getResultArray($con, $sql);
		$tempid = $resultrows[0][0] + 1;
		$tempone = $tempid + 1;
		$temptwo = $tempid + 2;
		$tempthree = $tempid + 3;
		$tempfour = $tempid + 4;
		$sql = "INSERT INTO `searchtemplate` VALUES ('','table_54','sadmin','@','Products',1,'',$tempid,1,1,0,NULL,'0','0'),('All Taxes','table_54','sadmin','','Products',1,'1,0,2,0,3,0,',$tempone,1,1,0,'','0','0'),('Recently Created','table_54','sadmin','','Products',1,'1,0,2,0,3,0,',$temptwo,1,0,0,'','0','0'),('Recently Updated','table_54','sadmin','','Products',1,'1,0,2,0,3,0,',$tempthree,1,0,0,'','0','0'),('Recently Viewed','table_54','sadmin','','Products',1,'1,0,2,0,3,0,',$tempfour,1,0,0,'','0','0');";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `table_2_frmaction` VALUES ('super admin profile','Products','table_54','ScreenAccess,ScreenAccess#Add,#Edit,#Delete,#View,View#Search,Search#Calendar,#Import,#Export,#'),('Field Staff','Products','table_54','ScreenAccess,ScreenAccess#Add,#Edit,#View,View#Search,Search#');";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `table_2_frmfields` VALUES ('super admin profile','Products','table_54','#table_54_id,table_54_id#1,1$#Tax_Name,Tax_Name#1,1$#Tax_in_,Tax_in_#1,1$#Notes,Notes#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$'),('Field Staff','Products','table_54','#table_54_id,table_54_id#1,1$#Tax_Name,Tax_Name#1,1$#Tax_in_,#1,$#Notes,Notes#1,1$#createdon,createdon#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$');";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `table_2_frmscreen` VALUES ('Field Staff','Products','table_54,table_54'),('super admin profile','Products','table_54,table_54');";
		$result = execSQL($con, $sql);

		$sql = "CREATE TABLE `table_54_frm` (
  `table_54_id` varchar(40) NOT NULL,
  `table_6_0_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `createdon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Tax_Name` varchar(40) DEFAULT NULL,
  `Tax_in_` float(40,2) DEFAULT NULL,
  `Notes` varchar(200) DEFAULT NULL,
  `table_6_1_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `updatedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `table_6_2_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `viewedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`table_54_id`),
  UNIQUE KEY `Unique_Keys` (`Tax_Name`)
) ENGINE=InnoDB;";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `cmpviewaccesstable` VALUES ('table_54','40','42,43,44,45,46,40,41'),('table_54','41','42,43,44,45,46,40,41'),('table_54','42','44,45,46'),('table_54','43','44,45,46');";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `fetchallfilterreference` VALUES ('table_54','Tax__in__','',0,''),('table_54','Tax_in_','',0,''),('table_54','Notes','',0,''),('table_54','Tax_Name','',0,'');";
		$result = execSQL($con, $sql);
	}

	$sql = "select * from formtable where formname = 'table_53';";
	$res = getResultArray($con, $sql);
	if (sizeof($res) <= 0) {
		$sql = "INSERT INTO `formtable` VALUES ('Products','table_53','Products','',0,'',0,0,'1,0',0,0,'product_icon.png','g_root,g_root,0,1,0,0,0,0$true,g_root,g_Product / Service Info,0,2,0,0,0,0$true,g_Product / Service Info,f_1,0,0,0,0,0,0$true,g_root,g_Product / Service Description,1,1,0,0,0,0$true,g_Product / Service Description,f_2,0,0,0,0,0,0$true',0,0,0,0,0,0,0,0,0,'','',0,1,0,1,0);";
		$result = execSQL($con, $sql);

		$sql = "DROP TABLE IF EXISTS `table_53_frm`;";
		$result = execSQL($con, $sql);
		$sql = "CREATE TABLE `table_53_frm` (
  `table_53_id` varchar(40) NOT NULL DEFAULT '',
  `table_6_0_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `createdon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Product_Name` varchar(200) DEFAULT NULL,
  `Unit_Price` float(40,2) DEFAULT NULL,
  `Taxable` varchar(40) DEFAULT NULL,
  `Tax__in__` varchar(40) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `Usage_Unit` varchar(40) DEFAULT NULL,
  `Qty_Ordered` float(40,2) DEFAULT NULL,
  `Qty_in_Stock` float(40,2) DEFAULT NULL,
  `Reorder_Level` float(40,2) DEFAULT NULL,
  `Qty_in_Demand` float(40,2) DEFAULT NULL,
  `Purchase_Price` float(40,2) DEFAULT NULL,
  `Product_Type` varchar(40) DEFAULT NULL,
  `Tax_Name` varchar(100) DEFAULT NULL,
  `Status` varchar(40) DEFAULT NULL,
  `table_6_1_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `updatedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `table_6_2_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `viewedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`table_53_id`)
) ENGINE=InnoDB;";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `formfieldtable` VALUES ('Products','table_53','createdon','Created Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','NO','',1,1,4,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Products','table_53','Description','Product / Service Description','Text Area','500','','','','',0,0,750,750,750,0,0,'Normal','NO','',1,0,2,0,1,0,0,0,'',0,0,0,0,'ALL',NULL),('Products','table_53','Product_Name','Product / Service Name','Text','200','','','','',0,0,200,200,200,0,1,'Normal','ALL','',1,0,1,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Products','table_53','table_53_id','Form ID','form_entityid','40','','','','',1,1,100,100,100,0,0,'Auto','NO','',1,1,0,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Products','table_53','table_6_0_createdusername','Created Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','NO','',1,1,3,0,0,0,0,0,'',1,0,0,0,'ALL',131),('Products','table_53','table_6_1_updatedusername','Updated Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','NO','',1,1,5,0,0,0,0,0,'',1,0,0,0,'ALL',132),('Products','table_53','table_6_2_viewedusername','Viewed Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','NO','',1,1,7,0,0,0,0,0,'',1,0,0,0,'ALL',133),('Products','table_53','updatedon','Updated Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','NO','',1,1,6,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Products','table_53','viewedon','Viewed Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','NO','',1,1,8,0,0,0,0,0,'',1,0,0,0,'ALL',NULL);";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `fetchallfilterreference` VALUES ('table_53','Product_Name','',0,''),('table_216','table_6_3_table_6_id','',0,''),('table_53','Unit_Price','',0,''),('table_53','Description','',0,''),('table_53','Taxable','',0,''),('table_53','Tax__in__','',0,''),('table_229','Tax_Amount','',0,''),('table_53','table_53_id','',0,''),('table_53','Usage_Unit','',0,''),('table_53','Product_Code','',0,''),('table_53','table_201_0_table_201','',0,''),('table_53','Status','',0,''),('table_53','Product_Type','',0,''),('table_53','Product_Group','',0,''),('table_53','Product_Active','',0,''),('table_53','Purchase_Price','',0,''),('table_53','Tax_Name','',0,''),('table_53','Excise_Duty','',0,''),('table_53','Cess','',0,'');";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `formactiontable` VALUES ('Products','table_53','Add','Add',1,'',0),('Products','table_53','Calendar','Calendar',1,'',5),('Products','table_53','Customize','Customize',1,'',9),('Products','table_53','Delete','Delete',1,'',2),('Products','table_53','Edit','Edit',1,'',1),('Products','table_53','Export','Export',1,'',7),('Products','table_53','Import','Import',1,'',6),('Products','table_53','Print','Print',1,'',8),('Products','table_53','Search','Search',1,'',4),('Products','table_53','View','View',1,'',3);";
		$result = execSQL($con, $sql);

		/*
		 $sql = "select max(cast(moduleorder as signed)) from moduletable";
		 $resultrows = getResultArray($con, $sql);
		 $morder = $resultrows[0][0] + 1;
		 $sql = "INSERT INTO `formfieldreference` VALUES ('Products','table_53','table_6_0_createdusername','Setup','table_6','Name',131),('Products','table_53','table_6_1_updatedusername','Setup','table_6','Name',132),('Products','table_53','table_6_2_viewedusername','Setup','table_6','Name',133);";
		 $result = execSQL($con, $sql);*/

		$sql = "select max(cast(relationid as signed)) from formfieldreference";
		$resultrows = getResultArray($con, $sql);
		$refid = $resultrows[0][0] + 1;
		$nextid = $refid + 1;
		$nextpid = $refid + 2;

		$sql = "insert into formfieldreference VALUES ('Products','table_53','table_6_0_createdusername','Setup','table_6','Name',$refid),('Products','table_53','table_6_1_updatedusername','Setup','table_6','Name',$nextid),('Products','table_53','table_6_2_viewedusername','Setup','table_6','Name',$nextpid);";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `formrelationtable` VALUES ($refid,$refid,0,'table_53','table_6','n-1','',0,''),($nextid,$nextid,1,'table_53','table_6','n-1','',0,''),($nextpid,$nextpid,2,'table_53','table_6','n-1','',0,'');";
		$result = execSQL($con, $sql);

		/*
		 $sql = "select max(cast(relationid as signed)) from formrelationtable";
		 $resultrows = getResultArray($con, $sql);
		 $nextid = $resultrows[0][0] + 1;
		 $nextpone = $nextid + 1;
		 $nextptwo = $nextid + 2;

		 $sql = "INSERT INTO `formrelationtable` VALUES ($nextid,$nextid,0,'table_53','table_6','n-1','',0,''),($nextpone,$nextpone,1,'table_53','table_6','n-1','',0,''),($nextptwo,$nextptwo,2,'table_53','table_6','n-1','',0,'');";
		 $result = execSQL($con, $sql);*/

		$sql = "INSERT INTO `idgenerator` VALUES ('table_53_frm','0');";
		$result = execSQL($con, $sql);

		$sql = "select max(cast(refid as signed)) from refferedfielddetails";
		$resultrows = getResultArray($con, $sql);
		$refid = $resultrows[0][0] + 1;
		$refidp = $refid + 1;
		$sql = "INSERT INTO `refferedfielddetails` VALUES ('$refid','$refid','Products','table_53','Tax_Name','Products','table_54','Tax_Name','true','','false','','false','','true'),('$refidp','$refidp','Products','table_53','Tax__in__','Products','table_54','Tax_in_','false','','false','','true','$refid','true');";
		$result = execSQL($con, $sql);
		$sql = "select max(cast(templateid as signed)) from searchtemplate";
		$resultrows = getResultArray($con, $sql);
		$tempid = $resultrows[0][0] + 1;
		$tempone = $tempid + 1;
		$temptwo = $tempid + 2;
		$tempthree = $tempid + 3;
		$tempfour = $tempid + 4;
		$sql = "INSERT INTO `searchtemplate` VALUES ('','table_53','sadmin','@','Products',1,'',$tempid,1,1,0,NULL,'0','0'),('All Products','table_53','sadmin','','Products',1,'1,1,6,0,2,0,3,0,5,0,',$tempone,1,1,0,'1,50,3,50,5,50,','0','0'),('Recently Created','table_53','sadmin','','Products',1,'1,0,6,0,2,0,3,0,5,0,',$temptwo,1,1,0,'1,50,3,50,5,50,','0','0'),('Recently Updated','table_53','sadmin','','Products',1,'1,0,6,0,2,0,3,0,5,0,',$tempthree,1,1,0,'1,50,3,50,5,50,','0','0'),('Recently Viewed','table_53','sadmin','','Products',1,'1,0,6,0,2,0,3,0,5,0,',$tempfour,1,1,0,'1,50,3,50,5,50,','0','0');";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `table_2_frmaction` VALUES ('super admin profile','Products','table_53','ScreenAccess,ScreenAccess#Add,#Edit,#Delete,#View,View#Search,Search#Calendar,#Import,#Export,#'),('Administrator','Products','table_53','ScreenAccess,ScreenAccess#Add,Add#Edit,Edit#Delete,Delete#View,View#Search,Search#Calendar,#Import,#Export,#'),('Manager','Products','table_53','ScreenAccess,ScreenAccess#Add,#Edit,#Delete,#View,View#Search,Search#Import,#Export,#'),('Field Staff','Products','table_53','ScreenAccess,ScreenAccess#Add,#Edit,#View,View#Search,Search#'),('Employee','Products','table_53','ScreenAccess,ScreenAccess#Add,Add#Edit,Edit#View,View#Search,Search#');";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `table_2_frmfields` VALUES ('super admin profile','Products','table_53','#table_53_id,table_53_id#1,1$#Product_Name,Product_Name#1,1$#Usage_Unit,Usage_Unit#1,1$#Unit_Price,Unit_Price#1,1$#Taxable,Taxable#1,1$#Tax__in__,Tax__in__#1,1$#Description,Description#1,1$#Qty_Ordered,Qty_Ordered#1,1$#Qty_in_Stock,Qty_in_Stock#1,1$#Reorder_Level,Reorder_Level#1,1$#Qty_in_Demand,Qty_in_Demand#1,1$#Purchase_Price,Purchase_Price#1,1$#Product_Type,Product_Type#1,1$#Tax_Name,Tax_Name#1,1$#Status,Status#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$#Tax_Code,Tax_Code#1,1$#Tax_Code,#1$'),('Administrator','Products','table_53','#table_53_id,table_53_id#1,1$#Product_Name,Product_Name#1,1$#Usage_Unit,Usage_Unit#1,1$#Unit_Price,Unit_Price#1,1$#Taxable,Taxable#1,1$#Tax__in__,Tax__in__#1,1$#Description,Description#1,1$#Qty_Ordered,Qty_Ordered#1,1$#Qty_in_Stock,Qty_in_Stock#1,1$#Reorder_Level,Reorder_Level#1,1$#Qty_in_Demand,Qty_in_Demand#1,1$#Purchase_Price,Purchase_Price#1,1$#Product_Type,Product_Type#1,1$#Tax_Name,Tax_Name#1,1$#Status,Status#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$#Tax_Code,#1$'),('Manager','Products','table_53','#table_53_id,table_53_id#1,1$#Product_Name,Product_Name#1,1$#Usage_Unit,Usage_Unit#1,1$#Unit_Price,Unit_Price#1,1$#Taxable,Taxable#1,1$#Tax__in__,Tax__in__#1,1$#Description,Description#1,1$#Qty_Ordered,Qty_Ordered#1,1$#Qty_in_Stock,Qty_in_Stock#1,1$#Reorder_Level,Reorder_Level#1,1$#Qty_in_Demand,Qty_in_Demand#1,1$#Purchase_Price,Purchase_Price#1,1$#Product_Type,Product_Type#1,1$#Tax_Name,Tax_Name#1,1$#Status,Status#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$#Tax_Code,#1$'),('Field Staff','Products','table_53','#table_53_id,table_53_id#1,1$#Product_Name,Product_Name#1,1$#Product_Code,Product_Code#1,1$#Usage_Unit,Usage_Unit#1,1$#Unit_Price,Unit_Price#1,1$#Taxable,Taxable#1,1$#Tax__in__,Tax__in__#1,1$#Description,Description#1,1$#Qty_Ordered,Qty_Ordered#1,1$#Qty_in_Stock,Qty_in_Stock#1,1$#Reorder_Level,Reorder_Level#1,1$#Qty_in_Demand,Qty_in_Demand#1,1$#Purchase_Price,Purchase_Price#1,1$#Product_Group,Product_Group#1,1$#Product_Type,Product_Type#1,1$#Tax_Name,Tax_Name#1,1$#Status,Status#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$#Excise_Duty,#1$#Cess,#1$#Tax_Code,#1$'),('Employee','Products','table_53','#table_53_id,table_53_id#1,1$#Product_Name,Product_Name#1,1$#Usage_Unit,Usage_Unit#1,1$#Unit_Price,Unit_Price#1,1$#Taxable,Taxable#1,1$#Tax__in__,Tax__in__#1,1$#Description,Description#1,1$#Qty_Ordered,Qty_Ordered#1,1$#Qty_in_Stock,Qty_in_Stock#1,1$#Reorder_Level,Reorder_Level#1,1$#Qty_in_Demand,Qty_in_Demand#1,1$#Purchase_Price,Purchase_Price#2,2$#Product_Type,Product_Type#1,1$#Tax_Name,Tax_Name#1,1$#Status,Status#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$#Tax_Code,#1$');";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `table_2_frmscreen` VALUES ('Administrator','Products','table_53,table_53'),('Employee','Products','table_53,table_53'),('Field Staff','Products','table_53,table_53'),('Manager','Products','table_53,table_53'),('super admin profile','Products','table_53,table_53');";
		$result = execSQL($con, $sql);

	}

	$sql = "select * from formtable where formname = 'table_57';";
	$res = getResultArray($con, $sql);
	if (sizeof($res) <= 0) {
		$sql = "INSERT INTO `formtable` VALUES ('Products','table_57','Tax Group','',0,'',0,0,'1,1',0,0,'ficon.png','g_root,g_root,0,1,0,0,0,0$true,g_root,g_Tax Group Info,0,2,0,0,0,0$true,g_Tax Group Info,f_1,0,0,0,0,0,0$true,g_Tax Group Info,f_2,1,0,0,0,0,0$true,g_root,g_Tax Master,1,1,0,0,0,0$true,g_Tax Master,f_4,0,0,0,0,0,0$true,g_root,g_Description,2,1,0,0,0,0$true,g_Description,f_3,0,0,0,0,0,0$true',0,0,0,0,0,0,0,0,0,'','',0,1,0,1,0)";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `formfieldtable` VALUES ('Products','table_57','createdon','Created Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,6,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Products','table_57','Notes','Notes','Text Area','200','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,3,0,0,0,0,0,'',0,0,0,0,'ALL',NULL),('Products','table_57','table_56_0_table_56','Tax Master','subtable','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,4,0,0,0,0,0,'',1,0,0,0,'ALL',435),('Products','table_57','table_57_id','Form ID','form_entityid','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,0,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Products','table_57','table_6_0_createdusername','Created Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,5,0,0,0,0,0,'',1,0,0,0,'ALL',432),('Products','table_57','table_6_1_updatedusername','Updated Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,7,0,0,0,0,0,'',1,0,0,0,'ALL',433),('Products','table_57','table_6_2_viewedusername','Viewed Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,9,0,0,0,0,0,'',1,0,0,0,'ALL',434),('Products','table_57','Tax_in_','Tax ( in % )','Float','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,2,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Products','table_57','Tax_Name','Tax Name','Text','40','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,1,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Products','table_57','updatedon','Updated Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,8,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Products','table_57','viewedon','Viewed Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,10,0,0,0,0,0,'',1,0,0,0,'ALL',NULL);";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `fetchallfilterreference` VALUES ('table_57','table_56_0_table_56','',0,''),('table_57','Notes','',0,'')";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `formactiontable` VALUES ('Products','table_57','Add','Add',1,'',0),('Products','table_57','Calendar','Calendar',1,'',5),('Products','table_57','Customize','Customize',1,'',9),('Products','table_57','Delete','Delete',1,'',2),('Products','table_57','Edit','Edit',1,'',1),('Products','table_57','Export','Export',1,'',7),('Products','table_57','Import','Import',1,'',6),('Products','table_57','Print','Print',1,'',8),('Products','table_57','Search','Search',1,'',4),('Products','table_57','View','View',1,'',3);";
		$result = execSQL($con, $sql);

		/*
		 $sql = "INSERT INTO `formfieldreference` VALUES ('Products','table_57','table_56_0_table_56','Products','table_56','',435),('Products','table_57','table_6_0_createdusername','Setup','table_6','Name',432),('Products','table_57','table_6_1_updatedusername','Setup','table_6','Name',433),('Products','table_57','table_6_2_viewedusername','Setup','table_6','Name',434);";
		 $result = execSQL($con, $sql);
		 */
		$sql = "select max(cast(relationid as signed)) from formfieldreference";
		$resultrows = getResultArray($con, $sql);
		$refid = $resultrows[0][0] + 1;
		$nextid = $refid + 1;
		$nextpid = $refid + 2;

		$sql = "insert into formfieldreference VALUES ('Products','table_57','table_6_0_createdusername','Setup','table_6','Name',$refid),('Products','table_57','table_6_1_updatedusername','Setup','table_6','Name',$nextid),('Products','table_57','table_6_2_viewedusername','Setup','table_6','Name',$nextpid);";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `formrelationtable` VALUES ($refid,$refid,0,'table_57','table_6','n-1','',0,''),($nextid,$nextid,1,'table_57','table_6','n-1','',0,''),($nextpid,$nextpid,2,'table_57','table_6','n-1','',0,'');";
		$result = execSQL($con, $sql);

		$sql = "select max(cast(relationid as signed)) from formrelationtable";
		$resultrows = getResultArray($con, $sql);
		$nextid = $resultrows[0][0] + 1;
		$nextpone = $nextid + 1;

		$sql = "INSERT INTO `formrelationtable` VALUES ($nextid,$nextpone ,0,'table_57','table_56','1-n','',0,''),($nextpone,$nextid ,0,'table_56','table_57','n-1','',0,'');";
		$result = execSQL($con, $sql);

		$sql = "insert into formfieldreference VALUES ('Products','table_56','table_57_0_table_57_id','Products','table_57','Tax_Name',$nextpone),('Products','table_57','table_56_0_table_56','Products','table_56','',$nextid);";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `idgenerator` VALUES ('table_57_frm','1');";
		$result = execSQL($con, $sql);
		$sql = "select max(cast(templateid as signed)) from searchtemplate";
		$resultrows = getResultArray($con, $sql);
		$tempid = $resultrows[0][0] + 1;
		$tempone = $tempid + 1;
		$temptwo = $tempid + 2;
		$tempthree = $tempid + 3;
		$tempfour = $tempid + 4;
		$tempfive = $tempid + 5;
		$tempsix = $tempid + 6;		
		$sql = "INSERT INTO `searchtemplate` (templatename,formname,username,searchfields,modulename,access_rights,viewfields,templateid,issystem,ismobile,ismobiledefault,mobileviewfields,forsearchtemplate,ishideinview) VALUES ('','table_57','sadmin','@','Products',1,'',$tempid,1,1,0,NULL,'0','0'),('All records','table_57','sadmin','@','Products',1,'',$tempone,1,1,0,NULL,'0','0'),('My records','table_57','sadmin','@','Products',1,'',$temptwo,1,1,0,NULL,'0','0'),('Todays records','table_57','sadmin','@','Products',1,'',$tempthree,1,1,0,NULL,'0','0'),('Recently Created','table_57','sadmin','@','Products',1,'',$tempfour,1,1,0,NULL,'0','0'),('Recently Updated','table_57','sadmin','@','Products',1,'',$tempfive,1,1,0,NULL,'0','0'),('Recently Viewed','table_57','sadmin','@','Products',1,'',$tempsix,1,1,0,NULL,'0','0');";
		$result = execSQL($con, $sql);

		$sql = "insert into table_2_frmscreen (rolename,modulename,formname) values('super admin profile','Products','table_57,table_57');";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `table_2_frmaction` (rolename,modulename,formname,actions) VALUES ('super admin profile','Products','table_57','ScreenAccess,ScreenAccess#Add,Add#Edit,Edit#Delete,Delete#View,View#Search,Search#Calendar,Calendar#Import,Import#Export,Export#Print,Print#Customize,Customize#'),('super admin profile','Products','table_296','ScreenAccess,ScreenAccess#');";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `table_2_frmfields` (rolename,modulename,formname,fields) VALUES ('super admin profile','Products','table_57','#table_57_id,table_57_id#1,1$#Tax_Name,Tax_Name#1,1$#Tax_in_,Tax_in_#1,1$#Notes,Notes#1,1$#table_56_0_table_56,table_56_0_table_56#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$');";
		$result = execSQL($con, $sql);

		$sql = "select max(cast(templateid as signed)) from subtable_searchtemplate";
		$resultrows = getResultArray($con, $sql);
		$nextid = $resultrows[0][0] + 1;
		$sql = "INSERT INTO `subtable_searchtemplate` VALUES ('$nextid','temp','table_57','table_56','Tax Name,Tax ( in %),Tax Group',colsize='100,100,100','sadmin');";
		$result = execSQL($con, $sql);

		/*
		 $sql = " update table_2_frmfields set fields = '' where rolename = 'super admin profile' and modulename = 'Products' and formname = 'table_57'";
		 $result = execSQL($con, $sql);
		 */

		$sql = "CREATE TABLE `table_57_frm` (
  `table_57_id` varchar(40) NOT NULL,
  `table_6_0_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `createdon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Tax_Name` varchar(40) DEFAULT NULL,
  `Tax_In_` float(40,2) DEFAULT NULL,
  `Notes` varchar(200) DEFAULT NULL,
  `0table_56_id` varchar(4000) DEFAULT NULL,
  `table_6_1_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `updatedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `table_6_2_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `viewedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`table_57_id`)
) ENGINE=InnoDB;";

		$result = execSQL($con, $sql);

		$sql = "DROP TABLE IF EXISTS `0table_57_table_56_frm`;";
		$result = execSQL($con, $sql);

		$sql = "CREATE TABLE `0table_57_table_56_frm` (
  `table_57_id` varchar(30) DEFAULT NULL,
  `table_56_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB;";
		$result = execSQL($con, $sql);
		$nextsysactid = getFormMaxId($con, "newsystemactiontable");
	$sql = "insert into newsystemactiontable values ($nextsysactid,'TAX SUM','','table_57',1,'ColSum','Products.table_57.Tax_in_=Products.table_56.Tax__in__#Products.Tax Group.Tax ( in % )=Products.Tax Master Line Item.Tax ( in %)','Active','','2016-01-27 04:03:36','0');";
	$result = execSQL($con, $sql);
	$nexttriggerid = getFormMaxId($con, "newtriggertable");
	$sql = " insert into newtriggertable values ($nexttriggerid,'TAX SUM','TAX SUM UP','table_57','User','table_56_0_table_56','Enter',0,'Active','User','2016-01-27 04:04:40','0');";
	$result = execSQL($con, $sql);
	$sql = "select max(cast(triggerorder as signed)) from triggersystemactiontable";
	$resultrows = getResultArray($con, $sql);
	$nextid = $resultrows[0][0] + 1;
	$sql = "insert into triggersystemactiontable values ('$nexttriggerid','$nextsysactid','$nextid');";
	$result = execSQL($con, $sql);
	}
	
}

function createTermandConditionForm($con) {
	$sql = "select * from moduletable where name = 'Terms and Conditions' ;";
	$res = getResultArray($con, $sql);
	if (sizeof($res) <= 0) {
		$sql = "select max(cast(moduleorder as signed)) from moduletable";
		$resultrows = getResultArray($con, $sql);
		$morder = $resultrows[0][0] + 1;
		$sql = "insert into moduletable values ('Terms and Conditions','micon.png','$morder');";
		$result = execSQL($con, $sql);
	}
	$sql = "select * from formtable where formname = 'table_58';";
	$res = getResultArray($con, $sql);
	if (sizeof($res) <= 0) {

		$sql = "INSERT INTO `formtable` VALUES ('Terms and Conditions','table_58','Terms and Conditions','',0,'',0,0,'1,0',0,0,'ficon.png','g_root,g_root,0,1,0,0,0,0$true,g_root,g_Terms Name,0,1,0,0,0,0$true,g_Terms Name,f_1,0,0,0,0,0,0$true,g_root,g_Terms and Conditions,1,1,0,0,0,0$true,g_Terms and Conditions,f_2,0,0,0,0,0,0$true',0,0,0,0,0,0,0,0,0,'','',0,1,0,1,0);";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `formfieldtable` VALUES ('Terms and Conditions','table_58','createdon','Created Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,4,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Terms and Conditions','table_58','table_58_id','Form ID','form_entityid','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,0,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Terms and Conditions','table_58','table_6_0_createdusername','Created Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,3,0,0,0,0,0,'',1,0,0,0,'ALL',429),('Terms and Conditions','table_58','table_6_1_updatedusername','Updated Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,5,0,0,0,0,0,'',1,0,0,0,'ALL',430),('Terms and Conditions','table_58','table_6_2_viewedusername','Viewed Username','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,7,0,0,0,0,0,'',1,0,0,0,'ALL',431),('Terms and Conditions','table_58','Terms_and_Conditions','Terms and Conditions','Html Text','10000','','','','',0,0,1000,200,150,0,0,'Normal','Advanced','',1,0,2,0,0,0,0,0,'',0,0,0,0,'ALL',NULL),('Terms and Conditions','table_58','Terms_Name','Terms Name','Text','200','','','','',0,0,200,200,150,0,0,'Normal','Advanced','',1,0,1,0,0,0,0,0,'',0,0,0,0,'ALL',NULL),('Terms and Conditions','table_58','updatedon','Updated Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,6,0,0,0,0,0,'',1,0,0,0,'ALL',NULL),('Terms and Conditions','table_58','viewedon','Viewed Time','form_history','40','','','','',1,1,100,100,100,0,0,'Auto','Advanced','',1,1,8,0,0,0,0,0,'',1,0,0,0,'ALL',NULL);";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `formactiontable` VALUES ('Terms and Conditions','table_58','Add','Add',1,'',0),('Terms and Conditions','table_58','Calendar','Calendar',1,'',5),('Terms and Conditions','table_58','Customize','Customize',1,'',9),('Terms and Conditions','table_58','Delete','Delete',1,'',2),('Terms and Conditions','table_58','Edit','Edit',1,'',1),('Terms and Conditions','table_58','Export','Export',1,'',7),('Terms and Conditions','table_58','Import','Import',1,'',6),('Terms and Conditions','table_58','Print','Print',1,'',8),('Terms and Conditions','table_58','Search','Search',1,'',4),('Terms and Conditions','table_58','View','View',1,'',3);";
		$result = execSQL($con, $sql);

		$sql = "select max(cast(relationid as signed)) from formrelationtable";
		$resultrows = getResultArray($con, $sql);
		$nextid = $resultrows[0][0] + 1;
		$nextpone = $nextid + 1;

		$sql = "select max(cast(relationid as signed)) from formfieldreference";
		$resultrows = getResultArray($con, $sql);
		$refid = $resultrows[0][0] + 1;
		$nextid = $refid + 1;
		$nextpid = $refid + 2;

		$sql = "insert into formfieldreference VALUES ('Terms and Conditions','table_58','table_6_0_createdusername','Setup','table_6','Name',$refid),('Terms and Conditions','table_58','table_6_1_updatedusername','Setup','table_6','Name',$nextid),('Terms and Conditions','table_58','table_6_2_viewedusername','Setup','table_6','Name',$nextpid);";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `formrelationtable` VALUES ($refid,$refid,0,'table_58','table_6','n-1','',0,''),($nextid,$nextid,1,'table_58','table_6','n-1','',0,''),($nextpid,$nextpid,2,'table_58','table_6','n-1','',0,'');";
		$result = execSQL($con, $sql);

		$sql = "CREATE TABLE `table_58_frm` (
  `table_58_id` varchar(40) NOT NULL,
  `table_6_0_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `createdon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Terms_Name` varchar(200) DEFAULT NULL,
  `Terms_and_Conditions` varchar(10000) DEFAULT NULL,
  `table_6_1_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `updatedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `table_6_2_table_6_id` varchar(30) NOT NULL DEFAULT '',
  `viewedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`table_58_id`)
) ENGINE=InnoDB;";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `table_2_frmaction` VALUES ('super admin profile','Terms and Conditions','table_58','ScreenAccess,ScreenAccess#Add,Add#Edit,Edit#Delete,Delete#View,View#Search,Search#Calendar,Calendar#Import,Import#Export,Export#Print,Print#Customize,Customize#'),('super admin profile','Terms and Conditions','table_290','ScreenAccess,ScreenAccess#');";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `table_2_frmfields` VALUES ('super admin profile','Terms and Conditions','table_58','#table_58_id,table_58_id#1,1$#Terms_Name,Terms_Name#1,1$#Terms_and_Conditions,Terms_and_Conditions#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$');";
		$result = execSQL($con, $sql);

		$sql = "INSERT INTO `table_2_frmscreen` VALUES ('super admin profile','Terms and Conditions','table_58,table_58');";
		$result = execSQL($con, $sql);
		$sql = "select max(cast(templateid as signed)) from searchtemplate";
		$resultrows = getResultArray($con, $sql);
		$tempid = $resultrows[0][0] + 1;
		$tempone = $tempid + 1;
		$temptwo = $tempid + 2;
		$tempthree = $tempid + 3;
		$tempfour = $tempid + 4;
		$tempfive = $tempid + 5;
		$tempsix = $tempid + 6;
		$sql = "INSERT INTO `searchtemplate` VALUES ('','table_58','sadmin','@','Terms and Conditions',1,'',$tempid,1,1,0,NULL,'0','0'),('All records','table_58','sadmin','@','Terms and Conditions',1,'',$tempone,1,1,0,NULL,'0','0'),('My records','table_58','sadmin','@','Terms and Conditions',1,'',$temptwo,1,1,0,NULL,'0','0'),('Todays records','table_58','sadmin','@','Terms and Conditions',1,'',$tempthree,1,1,0,NULL,'0','0'),('Recently Created','table_58','sadmin','@','Terms and Conditions',1,'',$tempfour,1,1,0,NULL,'0','0'),('Recently Updated','table_58','sadmin','@','Terms and Conditions',1,'',$tempfive,1,1,0,NULL,'0','0'),('Recently Viewed','table_58','sadmin','@','Terms and Conditions',1,'',$tempsix,1,1,0,NULL,'0','0');";
		$result = execSQL($con, $sql);
		$sql = "INSERT INTO `idgenerator` VALUES ('table_58_frm','0');";
		$result = execSQL($con, $sql);
	}
}

function migrateaddonmodules($con) {
	$sql = " insert into addonforms select formname from formtable where formtype in ('','request','checkin/checkout','config','Recurring','inputform') and (modulename not in('Setup','Settings','Reports','Calendar') or formname in ('table_47','table_37','table_41')) order by labelname";
	$result = execSQL($con, $sql);
	$sql = "select formname,actionitems from formactiontable where actionitems != '' and modulename not in('Setup','Reports');";
	$result = getResultArray($con, $sql);
	$actionsql = "";
	for ($i = 0; $i < sizeof($result); $i++) {
		$forname = $result[$i][0];
		$actionitems = $result[$i][1];
		$actionarr = explode(",", $actionitems);
		for ($j = 0; $j < sizeof($actionarr); $j++) {
			$action = $actionarr[$j];
			$actionsql .= "('" . $forname . "','" . $action . "'),";
		}
	}
	if ($actionsql != "") {
		$actionsql = lastchartrim($actionsql);
		$sql = "insert into addonformactions values $actionsql";
		$result = execSQL($con, $sql);
	}
}

function autoprefixIdUpdate($con) {
	$sql = "create table if not exists autoprefixid (formname varchar(100),fieldname varchar(100),idvalue varchar(100),defaultvalue varchar(100)) ENGINE=InnoDB";
	execSQL($con, $sql);
	$sql = "select formname,name,defaultvalue from formfieldtable where type like 'auto_%';";
	$result = getResultArray($con, $sql);
	for ($i = 0; $i < sizeof($result); $i++) {
		$formname = $result[$i][0];
		$fieldname = $result[$i][1];
		$defaultvalue = $result[$i][2];
		$sql = "SELECT id FROM idgenerator where tablename = '" . $formname . "_frm'";
		$idresult = getResultArray($con, $sql);
		$formid = $idresult[0][0];
		$sql = "insert into autoprefixid values ('$formname','$fieldname','$formid','$defaultvalue');";
		execSQL($con, $sql);

	}

}

function addLogoPanelInOrg($con) {
	$sql = "select max(fieldorder) from formfieldtable where formname='table_21' and type not in ('form_history');";
	$result = getResultArray($con, $sql);
	$maxid = $result[0][0];
	$maxid = $maxid + 1;

	$sql = "insert into formfieldtable values('Setup', 'table_21', 'Is_Header_Needed', 'Is Logo Panel Needed', 'CheckBox', '40', '', '', '', '', '0', '0', '100', '200', '150', '0','0', 'Normal', 'Advanced', '', '1', '0', '$maxid', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', NULL);";
	execSQL($con, $sql);

	$sql = "update table_2_frmfields set fields = '#table_21_id,table_21_id#1,1$#Organization_Name,Organization_Name#1,1$#Logo,Logo#1,1$#Address,Address#1,1$#Email_Id,Email_Id#1,1$#Phone_No_1,Phone_No_1#1,1$#Phone_No_2,Phone_No_2#1,1$#Website,Website#1,1$#Fax,Fax#1,1$#Financial_Year_Start,Financial_Year_Start#1,1$#Default_Currency,Default_Currency#1,1$#Email_Status,Email_Status#1,1$#SMS_Status,SMS_Status#1,1$#Date_Format,Date_Format#1,1$#Time_Zone,Time_Zone#1,1$#Time_Interval,Time_Interval#1,1$#Settings_Mode,Settings_Mode#1,1$#Is_Mobile_Client,Is_Mobile_Client#1,1$#appid,appid#1,1$#Display_Name,Display_Name#1,1$#Name,Name#1,1$#Designation,Designation#1,1$#Street_1,Street_1#1,1$#Street_2,Street_2#1,1$#City,City#1,1$#table_39_0_table_39_id,table_39_0_table_39_id#1,1$#PinZip_Code,PinZip_Code#1,1$#State,State#1,1$#Country,Country#1,1$#Is_Daily_Reports_Needed,Is_Daily_Reports_Needed#1,1$#Daily_Reports_Time,Daily_Reports_Time#1,1$#Email_To,Email_To#1,1$#Auto_Tracking,Auto_Tracking#1,1$#Force_Location_Capture,Force_Location_Capture#1,1$#Tracking_Interval,Tracking_Interval#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$#Is_Header_Needed,Is_Header_Needed#1,1$' where rolename = 'super admin profile' and formname = 'table_21' and modulename = 'Setup';";
	execSQL($con, $sql);

	$sql = "alter table table_21_frm add  Is_Header_Needed varchar(40) NOT NULL  default 'Yes'  after Is_Daily_Reports_Needed";
	execSQL($con, $sql);

	$sql = "update formfieldtable set fieldorder=fieldorder+($increment+1) where formname='table_21' and type in
	('form_history')";
	execSQL($con, $sql);
}

function migrateTaxGroupMaster($con) {
	$sql = "select * from formtable where formname = 'table_57';";
	$res = getResultArray($con, $sql);
	if (sizeof($res) > 0) {
		$sql = "select name from picklisttable where name='Tax Group Type';";
	$result1 = getResultArray($con, $sql);
	if (sizeof($result1) == 0) {
		$sql = "insert into picklisttable values( 'Tax Group Type', 'Normal', 0,0,CURRENT_TIMESTAMP,'0' );";
		execSQL($con, $sql);
		$sql = "insert into picklisttable values( 'Tax Group Type', 'Recursion', 1,0,CURRENT_TIMESTAMP,'0' );";
		execSQL($con, $sql);
	}
	$sql = "select name from formfieldtable where formname='table_57' and name='Type'";
	$result1 = getResultArray($con, $sql);
	if (sizeof($result1) == 0) {
		$sql = "select max(fieldorder) from formfieldtable where modulename='Products' and formname='table_57' and (  name !='table_6_0_createdusername' and
                name !='createdon' and
                name !='table_6_1_updatedusername' and
                name !='updatedon' and
                name !='table_6_2_viewedusername' and
                name !='viewedon' )  and name !='table_56_0_table_56';";
	$result2 = getResultArray($con, $sql);
	$fieldorder = $result2[0][0];
	$fieldorder = $fieldorder + 1;
	$sql = "insert into formfieldtable values('Products','table_57','Type','Type','ComboBox','40','','','','','0','0','100','200','150','0','0','Normal',
'Advanced','Tax Group Type,Normal','1','0','$fieldorder','0','0','0','0','0','','1',0,0,0,'ALL',NULL);";
	execSQL($con, $sql);
	$sql = "update table_2_frmfields set fields = '#table_57_id,table_57_id#1,1$#Tax_Name,Tax_Name#1,1$#Tax_in_,Tax_in_#1,1$#Notes,Notes#1,1$#table_56_0_table_56,table_56_0_table_56#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$#Type,Type#1,1$' where rolename = 'super admin profile' and formname = 'table_57' and modulename = 'Products'";
	execSQL($con, $sql);
	$sql = "SHOW COLUMNS FROM table_57_frm";
	$result3 = getResultArray($con, $sql);
	if (sizeof($result3) > 0) {
		$sql = "alter table table_57_frm add `Type` varchar(40) after `0table_56_id`";
		execSQL($con, $sql);
	}
	$sql = "update formfieldtable set fieldorder=fieldorder+1 where formname='table_57' and  type in ('subtable','form_history');";
	execSQL($con, $sql);
	$sql = "update formtable set style = 'g_root,g_root,0,1,0,0,0,0$true,g_root,g_Tax Group Info,0,2,0,0,0,0$true,g_Tax Group Info,f_1,0,0,0,0,0,0$true,g_Tax Group Info,f_2,1,0,0,0,0,0$true,g_Tax Group Info,f_4,2,0,0,0,0,0$true,g_root,g_Tax Master,1,1,0,0,0,0$true,g_root,g_Description,2,1,0,0,0,0$true,g_Description,f_3,0,0,0,0,0,0$true,g_root,f_5,3,0,0,0,0,0$true' where formname='table_57' and modulename = 'Products'";
	execSQL($con, $sql);
		}	
	}	
}

function migrateTaskChanges1($con) {
	require_once ("process/ngbuilder.php");
	$obj -> {"oldname"} = "Activity";
	$obj -> {"newname"} = "Activities";
	ModuleRename($con, $obj);
	$sql = "update formtable set labelname = 'Activities' where formname='table_52';";
	execSQL($con, $sql);
	insertSyncQueryDetails($con, "formtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
}

function migrateTaskChanges($con) {
	require_once ("process/ngbuilder.php");
	$obj -> {"oldname"} = "Tasks";
	$obj -> {"newname"} = "Activity";
	ModuleRename($con, $obj);
	$sql = "update formtable set labelname = 'Activity' where formname='table_52';";
	execSQL($con, $sql);
	insertSyncQueryDetails($con, "formtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formfieldtable set label='Due Date' where formname='table_52' and name='Planned_Start';";
	execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formfieldtable set  label='Notes' where formname='table_52' and name='Subject';";
	execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "select max(fieldorder)+1 from formfieldtable where formname='table_52' and (  name !='table_6_0_createdusername' and
                name !='createdon' and
                name !='table_6_1_updatedusername' and
                name !='updatedon' and
                name !='table_6_2_viewedusername' and
                name !='viewedon' ) ;";
	$result = getResultArray($con, $sql);
	$fieldorder = $result[0][0];
	$sql = "insert into formfieldtable values('Activity','table_52','Type','Type','ComboBox','40','','','','','0','0','100','200','150','0','0','Normal',
 'Advanced','Activity Type,Task','1','0','$fieldorder','0','0','0','0','0','','1',0,0,0,'ALL',NULL);";
	execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql = "alter table table_52_frm add `Type` varchar(40) after `trigger_action`";
	execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_52", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update formfieldtable set fieldorder=fieldorder+1 where formname='table_52' and  type in ('subtable','form_history');";
	execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update table_2_frmfields set fields=concat(fields,'#Type,#1$') where formname='table_52' and rolename='super admin profile'";
	execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_2_frmfields", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql = "update picklisttable set  itemname='Notes',updatedon ='CURRENT_TIMESTAMP',updated_userid = '0' where itemname='Visit' and name='Activity Type'";
	execSQL($con, $sql);
	insertSyncQueryDetails($con, "picklisttable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
}

function migrateFormActionTable($con) {
	$sql = "select modulename,formname from formactiontable group by modulename,formname;";
	$result = getResultArray($con, $sql);
	for ($ai = 0; $ai < sizeof($result); $ai++) {
		$modulename = $result[$ai][0];
		$formname = $result[$ai][1];
		$sql = "select max(cast(actionorder as unsigned)) from formactiontable where modulename='$modulename' and formname='$formname';";
		$maxactionorderarr = getResultArray($con, $sql);
		$maxactionorder = $maxactionorderarr[0][0];
		$maxactionorder=$maxactionorder+1;
		$sql = "insert into formactiontable values('$modulename','$formname','Mass Edit','Mass Edit','1','','$maxactionorder');";
		execSQL($con, $sql);
		insertSyncQueryDetails($con, "formactiontable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
		$maxactionorder=$maxactionorder+1;
		$sql = "insert into formactiontable values('$modulename','$formname','Mass Print','Mass Print','1','','$maxactionorder');";
		execSQL($con, $sql);
		insertSyncQueryDetails($con, "formactiontable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	}
}
function migrateFormActionTable1($con) {
	$sql = "select modulename,formname from formactiontable group by modulename,formname;";
	$result = getResultArray($con, $sql);
	for ($ai = 0; $ai < sizeof($result); $ai++) {
		$modulename = $result[$ai][0];
		$formname = $result[$ai][1];
		$sql = "select max(cast(actionorder as unsigned)) from formactiontable where modulename='$modulename' and formname='$formname';";
		$maxactionorderarr = getResultArray($con, $sql);
		$maxactionorder = $maxactionorderarr[0][0];
		$maxactionorder=$maxactionorder+1;
		$sql = "insert into formactiontable values('$modulename','$formname','Mass Email','Mass Email','1','','$maxactionorder');";
		execSQL($con, $sql);
		insertSyncQueryDetails($con, "formactiontable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
		$maxactionorder=$maxactionorder+1;
		$sql = "insert into formactiontable values('$modulename','$formname','Mass SMS','Mass SMS','1','','$maxactionorder');";
		execSQL($con, $sql);
		insertSyncQueryDetails($con, "formactiontable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	}
}
function migrateTaskReminder($con) {
	$sql = "select name from picklisttable where name='Task Reminder List';";
	$result = getResultArray($con, $sql);
	$currentdatetime = date("Y-m-d H:i:s");
	if (sizeof($result) == 0) {
		$sql = "insert into picklisttable values( 'Task Reminder List', 'None', 0,0,'$currentdatetime','0' );";
		execSQL($con, $sql);
		insertSyncQueryDetails($con, "picklisttable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
		$sql = "insert into picklisttable values( 'Task Reminder List', 'On Due Time', 1,0,'$currentdatetime','0' );";
		execSQL($con, $sql);
		insertSyncQueryDetails($con, "picklisttable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
		$sql = "insert into picklisttable values( 'Task Reminder List', 'Before 15 Mins', 2,0,'$currentdatetime','0' );";
		execSQL($con, $sql);
		insertSyncQueryDetails($con, "picklisttable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
		$sql = "insert into picklisttable values( 'Task Reminder List', 'Before 30 Mins', 3,0,'$currentdatetime','0' );";
		execSQL($con, $sql);
		insertSyncQueryDetails($con, "picklisttable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
		$sql = "insert into picklisttable values( 'Task Reminder List', 'Before 1 Hour', 4,0,'$currentdatetime','0' );";
		execSQL($con, $sql);
		insertSyncQueryDetails($con, "picklisttable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
		$sql = "insert into picklisttable values( 'Task Reminder List', 'Before 2 Hours', 5,0,'$currentdatetime','0' );";
		execSQL($con, $sql);
		insertSyncQueryDetails($con, "picklisttable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
		$sql = "insert into picklisttable values( 'Task Reminder List', 'Before 4 Hours', 6,0,'$currentdatetime','0' );";
		execSQL($con, $sql);
		insertSyncQueryDetails($con, "picklisttable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
		$sql = "insert into picklisttable values( 'Task Reminder List', 'Before 1 Day', 7,0,'$currentdatetime','0' );";
		execSQL($con, $sql);
		insertSyncQueryDetails($con, "picklisttable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	}
	$sql = "select name from picklisttable where name='Task Reminder Option';";
	$result = getResultArray($con, $sql);
	if (sizeof($result) == 0) {
		$sql = "insert into picklisttable values( 'Task Reminder Option', 'All', 0,0,'$currentdatetime','0' );";
		execSQL($con, $sql);
		insertSyncQueryDetails($con, "picklisttable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
		$sql = "insert into picklisttable values( 'Task Reminder Option', 'Email', 1,0,'$currentdatetime','0' );";
		execSQL($con, $sql);
		insertSyncQueryDetails($con, "picklisttable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
		$sql = "insert into picklisttable values( 'Task Reminder Option', 'Sms', 2,0,'$currentdatetime','0' );";
		execSQL($con, $sql);
		insertSyncQueryDetails($con, "picklisttable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	}
	$sql="select modulename from formtable where formname='table_52'";
	$result = getResultArray($con, $sql);
	$modulename=$result[0][0];
	$sql = "select max(fieldorder) from formfieldtable where formname='table_52' and type not in ('subtable','form_history');";
	$result = getResultArray($con, $sql);
	$maxfieldorder = $result[0][0];
	$sql="select name from formfieldtable where formname='table_52' and fieldorder='$maxfieldorder';";
	$result = getResultArray($con, $sql);
	$maxfieldname=$result[0][0];
	$maxfieldorder++;
	$sql = "insert into formfieldtable values('$modulename','table_52','Remind_Me_At','Remind Me At','ComboBox','40','','','','','0','0','100','200','150','0','0','Normal','Advanced','Task Reminder List,None','1','0','$maxfieldorder','0','0','0','0','0','','1',0,0,0,'ALL',NULL);";
    execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$maxfieldorder++;
	$sql = "insert into formfieldtable values('$modulename','table_52','Remind_By','Remind By','ComboBox','40','','','','','0','0','100','200','150','0','0','Normal','Advanced','Task Reminder Option,All','1','0','$maxfieldorder','0','0','0','0','0','','1',0,0,0,'ALL',NULL);";
    execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");	
	$sql="alter table table_52_frm add `Remind_Me_At` varchar(40) after `$maxfieldname`";
	execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_52", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql="alter table table_52_frm add `Remind_By` varchar(40) after `Remind_Me_At`";
	execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_52", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql="select fields from table_2_frmfields where rolename = 'super admin profile' and formname = 'table_52' and modulename = '$modulename'";
    $result = getResultArray($con, $sql);
	$fields=$result[0][0];
	$fields.="#Remind_Me_At,Remind_Me_At#1,1$#Remind_By,Remind_By#1,1$";
	$sql="update table_2_frmfields set fields = '$fields' where rolename = 'super admin profile' and formname = 'table_52'";
    execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_2_frmfields", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql="update formfieldtable set fieldorder=fieldorder+2 where formname='table_52' and type in ('subtable','form_history');";	
	execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
}
function migrateTaskChanges2($con){
    $sql = "select max(fieldorder) from formfieldtable where formname='table_52' and type not in ('subtable','form_history');";
	$result = getResultArray($con, $sql);
	$maxfieldorder = $result[0][0];
	$maxfieldorder++;
	$sql="select modulename from formtable where formname='table_52'";
	$result = getResultArray($con, $sql);
	$modulename=$result[0][0];
	$sql="insert into formfieldtable values('$modulename','table_52','Reference_Link','Reference Link','Text','40','','','','','0','1','100','200','150','0','0','Normal','Advanced','','1','0','$maxfieldorder','0','0','0','0','0','','1',0,0,0,'ALL',NULL);";	
    execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
	$sql="alter table table_52_frm add `Reference_Link` varchar(40) after `Remind_By`";
	execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_52", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql="select fields from table_2_frmfields where rolename = 'super admin profile' and formname = 'table_52' and modulename = '$modulename'";
    $result = getResultArray($con, $sql);
	$fields=$result[0][0];
	$fields.="#Reference_Link,Reference_Link#1,1$";
	$sql="update table_2_frmfields set fields = '$fields' where rolename = 'super admin profile' and formname = 'table_52'";
    execSQL($con, $sql);
	insertSyncQueryDetails($con, "table_2_frmfields", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
	$sql="update formfieldtable set fieldorder=fieldorder+1 where formname='table_52' and type in ('subtable','form_history');";	
	execSQL($con, $sql);
	insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
}

function createConversationForm($con){
  $sql="create table if not exists `" . DBINFO::$APPDBNAME . "`.`appmailboxdetails` (
  `appid` VARCHAR(50) NULL,
  `mailbox` VARCHAR(100) NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
  execSQL($con, $sql);
  $sql="select max(cast(moduleorder as signed)) from moduletable FOR UPDATE ;";
  $result = getResultArray($con, $sql);
  $moduleorder=$result[0][0];
  $sql="insert into moduletable values('Conversations', 'micon.png',$moduleorder+1);";
  execSQL($con, $sql);
  $sql="insert into formtable values('Conversations', 'table_59', 'Conversations', '', '0', '', '0', 0, '1,1', '0', '0', 'mail3.png', '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '', '','0','0','1','');";
  execSQL($con, $sql);
  $sql="insert into table_2_frmscreen values('super admin profile','Conversations','table_59,table_59','NULL');";
  execSQL($con, $sql);
  $sql="insert into formfieldtable values('Conversations','table_59','table_59_id','Form ID','form_entityid','40','','','','','1','1',100,100,100,'0',
 '0','Auto','Advanced','','1','1','0','0','0','0',0,0,'',1,0,0,0,'ALL',NULL);";
    execSQL($con, $sql);
  $sql="insert into formfieldtable values('Conversations','table_59','Subject','Subject','Text','1000','','','','','0','0','100','200','150','0','0','Normal','ALL','','1','0','1','0','0','0','0','0','','0',0,0,0,'ALL',NULL
);";
  execSQL($con, $sql);
  $sql="insert into formfieldtable values('Conversations','table_59','Received_From','Received From','Text','500','','','','','0','0','100','200','150','0','0','Normal','ALL','','1','0','2','0','0','0','0','0','','1',0,0,0,'ALL',NULL);";
    execSQL($con, $sql);
  $sql="insert into formfieldtable values('Conversations','table_59','Received_To','Received To','Text','500','','','','','0','0','100','200','150','0','0','Normal','ALL','','1','0','3','0','0','0','0','0','','1',0,0,0,'ALL',NULL);";
    execSQL($con, $sql);
  $sql="insert into formfieldtable values('Conversations','table_59','Cc','Cc','Text','500','','','','','0','0','100','200','150','0','0','Normal','ALL','','1','0','4','0','0','0','0','0','','1',0,0,0,'ALL',NULL
);";
  execSQL($con, $sql);
$sql="insert into formfieldtable values(
'Conversations','table_59','Bcc','Bcc','Text','500','','','','','0','0','100','200','150','0','0','Normal','ALL','','1','0','5','0','0','0','0','0','','1',0,0,0,'ALL',NULL
);";
  execSQL($con, $sql);
$sql="insert into formfieldtable values(
'Conversations','table_59','Received_Date','Received Date','Date_Time','40','','','','','0','0','100','200','150','0','0','Normal','ALL','','1','0','6','0','0','0','0','0','','1',0,0,0,'ALL',NULL
);";
  execSQL($con, $sql);
$sql="insert into formfieldtable values('Conversations','table_59','Html_Body','Html Body','Html Text','10000','','','','','0','0','100','200','150','0','0','Normal','Advanced','','1','0','7','0','0','0','0','0','','0',0,0,0,'ALL',NULL);";
  execSQL($con, $sql);
$sql="insert into formfieldtable values('Conversations','table_59','Plain_Body','Plain Body','Text Area','10000','','','','','0','0','100','200','150','0','0','Normal','Advanced','','1','0','8','0','0','0','0','0','','0',0,0,0,'ALL',NULL);";
  execSQL($con, $sql);
$sql="select max(cast(relationid as unsigned)) from formrelationtable";
$result = getResultArray($con, $sql);
$maxrelationid=$result[0][0];
$sql="insert into formfieldtable values('Conversations','table_59','table_6_0_createdusername','Created Username','form_history','40','','','','','1',
 '1',100,100,100,'0','0','Auto','Advanced','','1','9','1','0','0','0',0,0,'',1,0,0,0,'ALL',$maxrelationid+1);";
   execSQL($con, $sql);
 $sql="insert into formfieldtable values('Conversations','table_59','createdon','Created Time','form_history','40','','','','','1','1',100,100,100,'0',
 '0','Auto','Advanced','','1','1','10','0','0','0',0,0,'',1,0,0,0,'ALL',NULL);";
   execSQL($con, $sql);
 $sql="insert into formfieldtable values('Conversations','table_59','table_6_1_updatedusername','Updated Username','form_history','40','','','','','1','1',100,100,100,'0','0','Auto','Advanced','','1','1','11','0','0','0',0,0,'',1,0,0,0,'ALL',$maxrelationid+2);";
   execSQL($con, $sql);
 $sql="insert into formfieldtable values('Conversations','table_59','updatedon','Updated Time','form_history','40','','','','','1','1',100,100,100,'0','0','Auto','Advanced','','1','1','12','0','0','0',0,0,'',1,0,0,0,'ALL',NULL);";
   execSQL($con, $sql);
 $sql="insert into formfieldtable values('Conversations','table_59','table_6_2_viewedusername','Viewed Username','form_history','40','','','','','1','1',100,100,100,'0','0','Auto','Advanced','','1','1','13','0','0','0',0,0,'',1,0,0,0,'ALL',$maxrelationid+3);";
   execSQL($con, $sql);
 $sql="insert into formfieldtable values('Conversations','table_59','viewedon','Viewed Time','form_history','40','','','','','1','1',100,100,100,'0','0','Auto','Advanced','','1','1','14','0','0','0',0,0,'',1,0,0,0,'ALL',NULL);";
  execSQL($con, $sql);
 $sql="insert into formrelationtable values ( $maxrelationid+1, $maxrelationid+1, 0, 'table_59', 'table_6', 'n-1', '', 0, '');";
  execSQL($con, $sql);
 $sql="insert into formrelationtable values ( $maxrelationid+2, $maxrelationid+2, 1, 'table_59', 'table_6', 'n-1', '', 0, '');";
  execSQL($con, $sql);
 $sql="insert into formrelationtable values ( $maxrelationid+3, $maxrelationid+3, 2, 'table_59', 'table_6', 'n-1', '', 0, '');"; 
  execSQL($con, $sql);
 $sql="insert into formfieldreference values('Conversations','table_59','table_6_0_createdusername','Setup','table_6','Name', $maxrelationid+1);";
  execSQL($con, $sql);
 $sql="insert into formfieldreference values('Conversations','table_59','table_6_1_updatedusername','Setup','table_6','Name', $maxrelationid+2);";
  execSQL($con, $sql);
 $sql="insert into formfieldreference values('Conversations','table_59','table_6_2_viewedusername','Setup','table_6','Name', $maxrelationid+3);";
  execSQL($con, $sql);
 $sql="insert into table_2_frmaction values('super admin profile','Conversations','table_59','ScreenAccess,ScreenAccess#Delete,Delete#View,View#Search,Search#Print,Print#','NULL');";
  execSQL($con, $sql);
 $sql="insert into formactiontable values('Conversations','table_59','Add','Add','1','','0');";
  execSQL($con, $sql);
 $sql="insert into formactiontable values('Conversations','table_59','Edit','Edit','1','','1');";
  execSQL($con, $sql);
 $sql="insert into formactiontable values('Conversations','table_59','Delete','Delete','1','','2');";
  execSQL($con, $sql);
 $sql="insert into formactiontable values('Conversations','table_59','View','View','1','','3');";
  execSQL($con, $sql);
 $sql="insert into formactiontable values('Conversations','table_59','Search','Search','1','','4');";
  execSQL($con, $sql);
 $sql="insert into formactiontable values('Conversations','table_59','Calendar','Calendar','1','','5');";
  execSQL($con, $sql);
 $sql="insert into formactiontable values('Conversations','table_59','Import','Import','1','','6');";
   execSQL($con, $sql);
$sql="insert into formactiontable values('Conversations','table_59','Export','Export','1','','7');";
  execSQL($con, $sql);
$sql="insert into formactiontable values('Conversations','table_59','Print','Print','1','','8');";
  execSQL($con, $sql);
$sql="insert into formactiontable values('Conversations','table_59','Customize','Customize','1','','9');";
 execSQL($con, $sql);
$sql="insert into formactiontable values('Conversations','table_59','Mass Edit','Mass Edit','1','','10');";
  execSQL($con, $sql);
$sql="insert into formactiontable values('Conversations','table_59','Mass Print','Mass Print','1','','11');";
  execSQL($con, $sql);
$sql="create table if not exists table_59_frm (table_59_id varchar(40) primary key,`Subject` varchar(1000)  DEFAULT '',`Received_From` varchar(500) DEFAULT '', `Received_To` varchar(500) DEFAULT '',`Cc` varchar(500) DEFAULT '',`Bcc` varchar(500) DEFAULT '',`Received_Date` varchar(40) DEFAULT '',`Html_Body` varchar(10000) DEFAULT '',`Plain_Body` varchar(10000) DEFAULT '', `table_6_0_table_6_id` varchar(30) NOT NULL DEFAULT '', `createdon` TIMESTAMP  NOT NULL DEFAULT '0000-00-00 00:00:00', `table_6_1_table_6_id` varchar(30) NOT NULL DEFAULT '', `updatedon` TIMESTAMP  NOT NULL, `table_6_2_table_6_id` varchar(30) NOT NULL DEFAULT '', `viewedon` TIMESTAMP  NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
  execSQL($con, $sql);
$sql="insert into table_2_frmfields values('super admin profile','Conversations','table_59','#table_59_id,table_59_id#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$#Subject,Subject#1,1$#Subject,#1$#Received_From,Received_From#1,1$#Received_From,#1$#Received_To,Received_To#1,1$#Received_To,#1$#Cc,Cc#1,1$#Cc,#1$#Bcc,Bcc#1,1$#Bcc,#1$#Received_Date,Received_Date#1,1$#Received_Date,#1$#Html_Body,Html_Body#1,1$#Html_Body,#1$#Plain_Body,Plain_Body#1,1$','NULL');";
  execSQL($con, $sql);
$sql="update formtable set style = 'g_root,g_root,0,1,0,0,0,0$true,g_root,g_Subject,0,1,0,0,0,0$true,g_Subject,f_1,0,0,0,0,0,0$true,g_root,g_Receipient Informations,1,2,0,0,0,0$true,g_Receipient Informations,f_2,0,0,0,0,0,0\$true,g_Receipient Informations,f_3,1,0,0,0,0,0\$true,g_Receipient Informations,f_4,2,0,0,0,0,0\$true,g_Receipient Informations,f_5,3,0,0,0,0,0\$true,g_Receipient Informations,f_6,4,0,0,0,0,0\$true,g_root,g_Html Body,2,1,0,0,0,0\$true,g_Html Body,f_7,0,0,0,0,0,0\$true,g_root,g_Plain Body,3,1,0,0,0,0\$true,g_Plain Body,f_8,0,0,0,0,0,0\$true' where formname='table_59' and modulename = 'Conversations'";
  execSQL($con, $sql);
$sql="insert into idgenerator values('table_59_frm','0');";
  execSQL($con, $sql);
$sql="select max(cast(templateid as signed)) from searchtemplate;";
 $result = getResultArray($con, $sql);
$maxtemplateid=$result[0][0];
$sql="insert into searchtemplate (templateid, templatename, formname, username, searchfields, modulename, access_rights, viewfields, issystem)
                    values($maxtemplateid+1, '', 'table_59', 'sadmin', '@', 'Conversations', '1', '', '1');";
				 execSQL($con, $sql);
					$sql="insert into searchtemplate (templateid, templatename, formname, username, searchfields, modulename, access_rights, viewfields, issystem)
                    values($maxtemplateid+2, 'All records', 'table_59', 'sadmin', '@', 'Conversations', '1', '', '1');";
				    execSQL($con, $sql);
					$sql="insert into searchtemplate (templateid, templatename, formname, username, searchfields, modulename, access_rights, viewfields, issystem)
                    values($maxtemplateid+3, 'Todays records', 'table_59', 'sadmin', '@', 'Conversations', '1', '', '1');";
                    execSQL($con, $sql);
                    $sql="insert into searchtemplate (templateid, templatename, formname, username, searchfields, modulename, access_rights, viewfields, issystem)
                    values($maxtemplateid+4, 'Recently Created', 'table_59', 'sadmin', '@', 'Conversations', '1', '', '1');";
                    execSQL($con, $sql);
				    $sql="insert into searchtemplate (templateid, templatename, formname, username, searchfields, modulename, access_rights, viewfields, issystem)
                    values($maxtemplateid+5, 'Recently Updated', 'table_59', 'sadmin', '@', 'Conversations', '1', '', '1');";
                    execSQL($con, $sql);
                    $sql="insert into searchtemplate (templateid, templatename, formname, username, searchfields, modulename, access_rights, viewfields, issystem)
                    values($maxtemplateid+6, 'Recently Viewed', 'table_59', 'sadmin', '@', 'Conversations', '1', '', '1');";
					execSQL($con, $sql);
					$sql="create table if not exists `escanparsertable` (
  `scannerid` int(11)  NOT NULL DEFAULT 0,
  `parserid` int(11)  NOT NULL DEFAULT 0,
`name` varchar(300)  NOT NULL DEFAULT '',
`parsertemplate` varchar(10000)  NOT NULL DEFAULT '',
`originaltemplate` varchar(10000)   NOT NULL DEFAULT '',
`selectionlist` varchar(2000)  NOT NULL DEFAULT '',
`updatedon` timestamp  NOT NULL DEFAULT '0000-00-00 00:00:00',
`updated_userid` varchar(30)  NOT NULL DEFAULT '') ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	execSQL($con, $sql);
	$sql="alter table escanruletable add column parserid int(11) after ackstatus;";
	execSQL($con, $sql);

}
function migratereportfieldtable($con){
$sql="alter table table_47_frm ADD Sync_Location varchar(500) after Mobile_Updated";
execSQL($con, $sql);
insertSyncQueryDetails($con, "table_47", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
$sql="insert into formfieldtable values('Setup','table_47','Sync_Location','Sync_Location','Text','500','','','','',0,0,100,200,150,0,0,'Normal','Advanced','',1,0,15,0,0,0,0,0,'',1,0,0,0,'',NULL);";	
execSQL($con, $sql);
insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
$sql="update table_2_frmfields set fields = '#table_47_id,#1,$#Formname,#1,$#table_6_3_table_6_id,#1,$#Total_Records,#1,$#Date,#1,$#Delivered_to_Mobile,#1,$#Pending_to_Delivered,#1,$#Mobile_Inserted,#1,$#Mobile_Updated,#1,$#table_6_0_createdusername,#1,$#createdon,#1,$#table_6_1_updatedusername,#1,$#updatedon,#1,$#table_6_2_viewedusername,#1,$#viewedon,#1,$#Sync_Location,Sync_Location#1,1$' where rolename = 'super admin profile' and modulename = 'Setup' and formname = 'table_47';";
execSQL($con, $sql);
insertSyncQueryDetails($con, "table_2_frmfields", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
$sql="select reportid from reportform where formname='table_47';";
$result = getResultArray($con, $sql);
$reportid=$result[0][0];
if($reportid != ""){
    $sql="delete from reportfieldtable where reportid=$reportid;";	
	execSQL($con, $sql);
	$sql="insert into reportfieldtable values($reportid,'Setup', 'table_47', 'updatedon', 'Last Sync Time', '','0','0','100','','','','','0');";
	execSQL($con, $sql);
	$sql="insert into reportfieldtable values($reportid,'Setup', 'table_47', 'Sync_Location', 'Last Sync Location', '','0','0','100','','','','','1');";
	execSQL($con, $sql);
	$sql="insert into reportfieldtable values($reportid,'Setup', 'table_47', 'Delivered_to_Mobile', 'Download to Mobile', '','0','0','100','1','','','','2');";
	execSQL($con, $sql);
	$sql="insert into reportfieldtable values($reportid,'Setup', 'table_47', 'Mobile_Inserted', '', '','0','0','100','1','','','','3');";
	execSQL($con, $sql);
	$sql="insert into reportfieldtable values($reportid,'Setup', 'table_47', 'Mobile_Updated', '', '','0','0','100','1','','','','4');";
	execSQL($con, $sql);
	$sql="insert into reportfieldtable values($reportid,'Setup', 'table_47', 'Formname', '', '','0','0','100','','','','','5');";
	execSQL($con, $sql);
	$sql="delete from reportfilterfieldvaluetable where reportid = '$reportid';";
    execSQL($con, $sql);
}
}

function migrateActivityTable($con){
$sql="select name from formfieldtable where formname='table_52' and name='Category';";
$result = getResultArray($con, $sql);
if(sizeof($result) ==  0){
$sql="select max(fieldorder) from formfieldtable where formname='table_52' and type not in ('subtable','form_history');";
$result = getResultArray($con, $sql);	
$maxfieldorder=$result[0][0];
$maxfieldorder++;
$sql="insert into formfieldtable values('Activities','table_52','Category','Category','ComboBox','40','','','','','0','0','100','200','150','0','0','Normal','Advanced','','1','0','$maxfieldorder', '0','0','0','0','0','','1',0,0,0,'ALL',NULL);";
execSQL($con, $sql);
insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
$sql="select fields from table_2_frmfields where rolename = 'super admin profile' and formname = 'table_52'";
$result = getResultArray($con, $sql);	
$fields=$result[0][0];
$fields.="#Category,Category#1,1$";
$sql="update table_2_frmfields set fields='$fields' where rolename = 'super admin profile' and formname = 'table_52'";
execSQL($con, $sql);
insertSyncQueryDetails($con, "table_2_frmfields", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
$maxfieldorder--;
$sql="select name from formfieldtable where formname='table_52' and fieldorder='$maxfieldorder';";
$result = getResultArray($con, $sql);	
$fieldname=$result[0][0];
$sql="alter table table_52_frm add `Category` varchar(40) after `$fieldname`";
execSQL($con, $sql);
insertSyncQueryDetails($con, "table_52", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
$sql="update formfieldtable set fieldorder = fieldorder+1 where formname='table_52' and type in ('subtable','form_history');";
execSQL($con, $sql);
insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
$currentdatetime = date("Y-m-d H:i:s");
$sql="insert into picklisttable values( 'Activity Type', 'Visit', 2,0,'$currentdatetime','0' )";
execSQL($con, $sql);
insertSyncQueryDetails($con, "picklisttable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
$sql="update formwisemodifiedddetails set updated_time='$currentdatetime' where formname='picklisttable'";
execSQL($con, $sql);	
}
$sql="update formtable set labelname='Outbound SMS' where formname='table_28';";
execSQL($con, $sql);
insertSyncQueryDetails($con, "formtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
$sql="update formtable set labelname='Outbound Mails' where formname='table_27';";
execSQL($con, $sql);
insertSyncQueryDetails($con, "formtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
$sql="update formtable set labelname='Inbound Mails' where formname='table_59';";
execSQL($con, $sql);
insertSyncQueryDetails($con, "formtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
$sql="update formtable set labelname='Email to Form' where formname='table_30';";
execSQL($con, $sql);
insertSyncQueryDetails($con, "formtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");
}

function migrateGeneralChanges($con){
$sql="alter table ". DBINFO::$APPDBNAME .".smsconfig modify column username varchar(50);";
execSQL($con, $sql);
$sql="alter table ". DBINFO::$APPDBNAME .".smsconfig modify column password varchar(50);";
execSQL($con, $sql);
$sql = "show tables like 'table_37_frm'";
$result = getResultArray($con, $sql);
		if (sizeof($result) > 0) {
	$sql="alter table table_37_frm modify Record_url varchar(1000);";
execSQL($con, $sql);
		}
$sql="update ". DBINFO::$APPDBNAME .".featuretable set parentfeatureindex='1',featuretype='' where featureindex in ('18','19');";
execSQL($con, $sql);	
}
function migrateLocationConversion($con){
$sql="CREATE TABLE if not exists ". DBINFO::$APPDBNAME .".googleapikeydetails (
  `apikey` VARCHAR(200) NOT NULL,
  `usedcount` INT NULL DEFAULT 0,
  `useddate` DATE NULL) ENGINE=InnoDB;";
 execSQL($con, $sql);
 $sql="select * from ". DBINFO::$APPDBNAME .".googleapikeydetails";	
 $result = getResultArray($con, $sql);	
if(sizeof($result) == 0){
$sql="insert into ". DBINFO::$APPDBNAME .".googleapikeydetails values('AIzaSyDJeQLdZ0ZkFBswnB1Zrn4yWdxuppsJytg','0',NOW());";
execSQL($con, $sql);
$sql="insert into ". DBINFO::$APPDBNAME .".googleapikeydetails values('AIzaSyCB3tCQ9m5ZByyg1yx_B4ZJ9p7Pou-_bBQ','0',NOW());";
execSQL($con, $sql);
$sql="insert into ". DBINFO::$APPDBNAME .".googleapikeydetails values('AIzaSyAlu6LHRfZAT7ofIuXT-_XWf5XacjE0zFE','0',NOW());";
execSQL($con, $sql);
$sql="insert into ". DBINFO::$APPDBNAME .".googleapikeydetails values('AIzaSyBsPgTnBCFDeYPpiHQ7-T8PzB38Yc1Qeus','0',NOW());";
execSQL($con, $sql);
 }
}
function migrateFeatureTable($con){
$sql="select * from ". DBINFO::$APPDBNAME .".featuretable where featureindex='20'";	
$result = getResultArray($con, $sql);	
if(sizeof($result) == 0){
$sql="insert into ". DBINFO::$APPDBNAME .".featuretable values('20','1','Form Numbering','0','');";
execSQL($con, $sql);
}	
}
function updateOrgNameInApplicationListTable($con){
$sql="select appid from ". DBINFO::$APPDBNAME .".applicationlist where f8 = ''";
$result = getResultArray($con, $sql);	
for($ai=0;$ai<sizeof($result);$ai++){
$appid=$result[$ai][0];	
$appdb=DBINFO::$APPDBNAME.$appid;
$sql="select Organization_Name from ".$appdb.".table_21_frm";
		$resultset = getResultArray($con, $sql);
		if(sizeof($resultset) > 0){
		$orgname = $resultset[0][0];
		$orgname=mysql_escape_string($orgname);
	$sql="update ". DBINFO::$APPDBNAME .".applicationlist set f8='$orgname' where appid='$appid'";	
	execSQL($con, $sql);
		}
}
}
function addSyncLogInModuleTable($con){
$sql="select * from moduletable where name='Sync Logs';";
$result = getResultArray($con, $sql);	
if(sizeof($result) == 0){
$sql="insert into moduletable select 'Sync Logs','micon.png',max(moduleorder)+1 from moduletable;";	
execSQL($con, $sql);
insertSyncQueryDetails($con, "moduletable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
}
}
function updateHistoryFieldRelationIDS($con){
$sql="select formname,fieldname,relationid from formfieldreference where formname in ('table_52','table_53','table_54','table_55','table_56','table_57','table_58') and fieldname like 'table_6%username';";	
$result = getResultArray($con, $sql);
for($i=0;$i<sizeof($result);$i++){
$formname=$result[$i][0];
$fieldname=$result[$i][1];
$relationid=$result[$i][2];
$sql="update formfieldtable set relationid='$relationid' where formname='$formname' and name='$fieldname'";
execSQL($con, $sql);
insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "");	
}
}
function migrateCpanelforEmailParsers($con){
	$sql="CREATE TABLE if not exists ". DBINFO::$APPDBNAME .".escangrouptable (
  `groupid` INT(11) NOT NULL,
  `groupname` VARCHAR(100) NOT NULL,
  `selectionlist` VARCHAR(500) default '',
  PRIMARY KEY (`groupid`)) ENGINE=InnoDB;";
  execSQL($con, $sql);
  $sql="CREATE TABLE if not exists ". DBINFO::$APPDBNAME .".escanparsertable (
  `parserid` INT(11) NOT NULL,
  `groupid` INT(11) NOT NULL,
  `name` VARCHAR(100) default '',
  `parsertemplate` VARCHAR(10000) default '',
  `originaltemplate` VARCHAR(10000) default '',
  `selectionlist` VARCHAR(2000) default '',
  `keywords` VARCHAR(2000) default '',
  `updatedon` TIMESTAMP NULL,
  `updated_userid` VARCHAR(45) NULL,
  PRIMARY KEY (`parserid`))  ENGINE=InnoDB DEFAULT CHARSET=latin1;";
  execSQL($con, $sql);
  $sql="CREATE TABLE if not exists seswhitelistdetails (
  `id` INT(11) NOT NULL,
  `type` VARCHAR(50) NULL,
  `value` VARCHAR(150) NULL,
  PRIMARY KEY (`id`))  ENGINE=InnoDB;";
  execSQL($con, $sql);
  $sql="update formfieldtable set fieldorder='9' where formname='table_59' and name='table_6_0_createdusername';";
 execSQL($con, $sql);
 $sql="alter table escanruletable modify column parserid varchar(50);";
 execSQL($con, $sql);
 $sql="update formfieldtable set label='Record Status' where formname='table_59' and name='Bcc';";
  execSQL($con, $sql);
  }
  function createDocumentForm($con){
  $sql="select max(cast(moduleorder as signed)) from moduletable FOR UPDATE ;";
  $result = getResultArray($con, $sql);
  $moduleorder=$result[0][0];
  $sql="insert into moduletable values('Documents', 'micon.png',$moduleorder+1);";
  execSQL($con, $sql);	
  insertSyncQueryDetails($con, "moduletable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
  $sql="insert into formtable values('Documents', 'table_60', 'Documents', '', '0', '', '0', 0, '1,1', '0', '0', 'ficon.png', 'g_root,g_root,0,1,0,0,0,0$true,g_root,g_Document Information,0,2,0,0,0,0$true,g_Document Information,f_1,0,0,0,0,0,0$true,g_Document Information,f_2,1,0,0,0,0,0$true,g_Document Information,f_4,2,0,0,0,0,0$true,g_Document Information,f_5,3,0,0,0,0,0$true,g_root,g_Description,1,1,0,0,0,0$true,g_Description,f_3,0,0,0,0,0,0$true', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '', '','0','0','1','');";
  execSQL($con, $sql);
  insertSyncQueryDetails($con, "formtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
  $sql="insert into table_2_frmscreen values('super admin profile','Documents','table_60,table_60','NULL');";
  execSQL($con, $sql);
  insertSyncQueryDetails($con, "table_2_frmscreen", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
  $sql="insert into formfieldtable values('Documents','table_60','table_60_id','Form ID','form_entityid','40','','','','','1','1',100,100,100,'0','0','Auto','Advanced','','1','1','0',
'0','0','0',0,0,'',1,0,0,0,'ALL',NULL);";
  execSQL($con, $sql);
  insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
    $sql="insert into formfieldtable values('Documents','table_60','Name','Name','Text','100','','','','','0','0','100','200','150','0','0','Normal',
 'ALL','','1','0','1','1','0','0','0','0','','1',0,0,0,'ALL',NULL);";
  execSQL($con, $sql);
  insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
  $sql="insert into formfieldtable values('Documents','table_60','Document','Document','Document','100','','','','','0','0','100','200','150','0',
 '1','Normal','ALL','','1','0','2','0','0','0','0','0','','1',0,0,0,'ALL',NULL);";
  execSQL($con, $sql);
  insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
  $sql="insert into formfieldtable values('Documents','table_60','Description','Description','Text Area','200','','','','','0','0','100','200','150',
 '0','0','Normal','Advanced','','1','0','3','0','0','0','0','0','','0',0,0,0,'ALL',NULL);";
  execSQL($con, $sql);
  insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
  $sql="insert into formfieldtable values('Documents','table_60','Type','Type','ComboBox','40','','','','','0','0','100','200','150','0','0','Normal',
 'ALL','','1','0','4','0','0','0','0','0','','1',0,0,0,'ALL',NULL);";
  execSQL($con, $sql);
  insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
  $sql="insert into formfieldtable values('Documents','table_60','Size','Size in MB','Float','40','','','','','0','0','100','200','150','0','0','Auto','Advanced','','1','0','5','0','0','0',
 '0','0','','1',0,0,0,'ALL',NULL);";
  execSQL($con, $sql);
  insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
  $sql="select max(cast(relationid as unsigned)) from formrelationtable";
$result = getResultArray($con, $sql);
$maxrelationid=$result[0][0];
  $sql="insert into formfieldtable values('Documents','table_60','table_6_0_createdusername','Created Username','form_history','40','','','','','1','1',
 100,100,100,'0','0','Auto','Advanced','','1','1','6','0','0','0',0,0,'',1,0,0,0,'ALL',$maxrelationid+1);";
  execSQL($con, $sql);
  insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
   $sql="insert into formfieldtable values('Documents','table_60','createdon','Created Time','form_history','40','','','','','1','1',100,100,100,'0','0',
 'Auto','Advanced','','1','1','7','0','0','0',0,0,'',1,0,0,0,'ALL',NULL);";
  execSQL($con, $sql);
  insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
  $sql="insert into formfieldtable values('Documents','table_60','table_6_1_updatedusername','Updated Username','form_history','40','','','','','1',
 '1',100,100,100,'0','0','Auto','Advanced','','1','1','8','0','0','0',0,0,'',1,0,0,0,'ALL',$maxrelationid+2);";
  execSQL($con, $sql);
  insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
  $sql="insert into formfieldtable values('Documents','table_60','updatedon','Updated Time','form_history','40','','','','','1','1',100,100,100,'0',
 '0','Auto','Advanced','','1','1','9','0','0','0',0,0,'',1,0,0,0,'ALL',NULL);";
  execSQL($con, $sql);
  insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
  $sql="insert into formfieldtable values('Documents','table_60','table_6_2_viewedusername','Viewed Username','form_history','40','','','','','1','1',
 100,100,100,'0','0','Auto','Advanced','','1','1','10','0','0','0',0,0,'',1,0,0,0,'ALL',$maxrelationid+3);";
  execSQL($con, $sql);
  insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
  $sql="insert into formfieldtable values('Documents','table_60','viewedon','Viewed Time','form_history','40','','','','','1','1',100,100,100,'0','0',
 'Auto','Advanced','','1','1','11','0','0','0',0,0,'',1,0,0,0,'ALL',NULL);";
  execSQL($con, $sql);
  insertSyncQueryDetails($con, "formfieldtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
   $sql="insert into formrelationtable values ( $maxrelationid+1, $maxrelationid+1, 0, 'table_60', 'table_6', 'n-1', '', 0, '');";
  execSQL($con, $sql);
  insertSyncQueryDetails($con, "formrelationtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
 $sql="insert into formrelationtable values ( $maxrelationid+2, $maxrelationid+2, 1, 'table_60', 'table_6', 'n-1', '', 0, '');";
  execSQL($con, $sql);
   insertSyncQueryDetails($con, "formrelationtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
 $sql="insert into formrelationtable values ( $maxrelationid+3, $maxrelationid+3, 2, 'table_60', 'table_6', 'n-1', '', 0, '');"; 
  execSQL($con, $sql);
   insertSyncQueryDetails($con, "formrelationtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
 $sql="insert into formfieldreference values('Documents','table_60','table_6_0_createdusername','Setup','table_6','Name', $maxrelationid+1);";
  execSQL($con, $sql);
   insertSyncQueryDetails($con, "formrelationtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
 $sql="insert into formfieldreference values('Documents','table_60','table_6_1_updatedusername','Setup','table_6','Name', $maxrelationid+2);";
  execSQL($con, $sql);
   insertSyncQueryDetails($con, "formrelationtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
 $sql="insert into formfieldreference values('Documents','table_60','table_6_2_viewedusername','Setup','table_6','Name', $maxrelationid+3);";
  execSQL($con, $sql);
   insertSyncQueryDetails($con, "formrelationtable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
  $sql="insert into table_2_frmaction values('super admin profile','Documents','table_60','ScreenAccess,ScreenAccess#Add,Add#Edit,Edit#Delete,Delete#View,View#Search,Search#','NULL');";
  execSQL($con, $sql);
   insertSyncQueryDetails($con, "table_2_frmaction", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
  $sql="insert into formactiontable values('Documents','table_60','Add','Add','1','','0');";
  execSQL($con, $sql);
  insertSyncQueryDetails($con, "formactiontable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
 $sql="insert into formactiontable values('Documents','table_60','Edit','Edit','1','','1');";
  execSQL($con, $sql);
   insertSyncQueryDetails($con, "formactiontable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
 $sql="insert into formactiontable values('Documents','table_60','Delete','Delete','1','','2');";
  execSQL($con, $sql);
   insertSyncQueryDetails($con, "formactiontable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
 $sql="insert into formactiontable values('Documents','table_60','View','View','1','','3');";
  execSQL($con, $sql);
   insertSyncQueryDetails($con, "formactiontable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
 $sql="insert into formactiontable values('Documents','table_60','Search','Search','1','','4');";
  execSQL($con, $sql);
   insertSyncQueryDetails($con, "formactiontable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
 $sql="insert into formactiontable values('Documents','table_60','Calendar','Calendar','1','','5');";
  execSQL($con, $sql);
   insertSyncQueryDetails($con, "formactiontable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
 $sql="insert into formactiontable values('Documents','table_60','Import','Import','1','','6');";
   execSQL($con, $sql);
    insertSyncQueryDetails($con, "formactiontable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
$sql="insert into formactiontable values('Documents','table_60','Export','Export','1','','7');";
  execSQL($con, $sql);
   insertSyncQueryDetails($con, "formactiontable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
$sql="insert into formactiontable values('Documents','table_60','Print','Print','1','','8');";
  execSQL($con, $sql);
   insertSyncQueryDetails($con, "formactiontable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
$sql="insert into formactiontable values('Documents','table_60','Customize','Customize','1','','9');";
 execSQL($con, $sql);
  insertSyncQueryDetails($con, "formactiontable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
$sql="insert into formactiontable values('Documents','table_60','Mass Edit','Mass Edit','1','','10');";
  execSQL($con, $sql);
   insertSyncQueryDetails($con, "formactiontable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
$sql="insert into formactiontable values('Documents','table_60','Mass Print','Mass Print','1','','11');";
  execSQL($con, $sql);
   insertSyncQueryDetails($con, "formactiontable", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
  $sql="create table if not exists table_60_frm (table_60_id varchar(40) primary key,`Name` varchar(100) NOT NULL DEFAULT '',`Document` varchar(100) NOT NULL DEFAULT '',`Description` varchar(200) NOT NULL DEFAULT '',`Type` varchar(100) NOT NULL DEFAULT '',`Size` float (40,2) NOT NULL DEFAULT '0', `table_6_0_table_6_id` varchar(30) NOT NULL DEFAULT '', `createdon` TIMESTAMP  NOT NULL DEFAULT '0000-00-00 00:00:00', `table_6_1_table_6_id` varchar(30) NOT NULL DEFAULT '', `updatedon` TIMESTAMP  NOT NULL, `table_6_2_table_6_id` varchar(30) NOT NULL DEFAULT '', `viewedon` TIMESTAMP  NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
  execSQL($con, $sql);
   insertSyncQueryDetails($con, "table_60", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
  $sql="insert into table_2_frmfields values('super admin profile','Documents','table_60','#table_60_id,table_60_id#1,1$#Name,Name#1,1$#Document,Document#1,1$#Description,Description#1,1$#table_6_0_createdusername,table_6_0_createdusername#1,1$#createdon,createdon#1,1$#table_6_1_updatedusername,table_6_1_updatedusername#1,1$#updatedon,updatedon#1,1$#table_6_2_viewedusername,table_6_2_viewedusername#1,1$#viewedon,viewedon#1,1$#table_236_0_table_236_id,table_236_0_table_236_id#1,1$#table_207_0_table_207_id,table_207_0_table_207_id#1,1$#table_236_0_table_236,table_236_0_table_236#1,1$#table_207_0_table_207,table_207_0_table_207#1,1$#Type,Type#1,1$#Size,Size#1,1$','NULL');";
  execSQL($con, $sql);
  insertSyncQueryDetails($con, "table_2_frmfields", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
  $sql="insert into idgenerator values('table_60_frm','0');";
  execSQL($con, $sql);
   insertSyncQueryDetails($con, "idgenerator", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
  $sql="select max(cast(templateid as signed)) from searchtemplate;";
 $result = getResultArray($con, $sql);
$maxtemplateid=$result[0][0];
$sql="insert into searchtemplate (templateid, templatename, formname, username, searchfields, modulename, access_rights, viewfields, issystem)
                    values($maxtemplateid+1, '', 'table_60', 'sadmin', '@', 'Documents', '1', '', '1');";
				 execSQL($con, $sql);
				    insertSyncQueryDetails($con, "searchtemplate", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
					$sql="insert into searchtemplate (templateid, templatename, formname, username, searchfields, modulename, access_rights, viewfields, issystem)
                    values($maxtemplateid+2, 'All records', 'table_60', 'sadmin', '@', 'Documents', '1', '', '1');";
				    execSQL($con, $sql);
					 insertSyncQueryDetails($con, "searchtemplate", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
					$sql="insert into searchtemplate (templateid, templatename, formname, username, searchfields, modulename, access_rights, viewfields, issystem)
                    values($maxtemplateid+3, 'Todays records', 'table_60', 'sadmin', '@', 'Documents', '1', '', '1');";
                    execSQL($con, $sql);
                     insertSyncQueryDetails($con, "searchtemplate", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
                    $sql="insert into searchtemplate (templateid, templatename, formname, username, searchfields, modulename, access_rights, viewfields, issystem)
                    values($maxtemplateid+4, 'Recently Created', 'table_60', 'sadmin', '@', 'Documents', '1', '', '1');";
                    execSQL($con, $sql);
                     insertSyncQueryDetails($con, "searchtemplate", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
				    $sql="insert into searchtemplate (templateid, templatename, formname, username, searchfields, modulename, access_rights, viewfields, issystem)
                    values($maxtemplateid+5, 'Recently Updated', 'table_60', 'sadmin', '@', 'Documents', '1', '', '1');";
                    execSQL($con, $sql);
                     insertSyncQueryDetails($con, "searchtemplate", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
                    $sql="insert into searchtemplate (templateid, templatename, formname, username, searchfields, modulename, access_rights, viewfields, issystem)
                    values($maxtemplateid+6, 'Recently Viewed', 'table_60', 'sadmin', '@', 'Documents', '1', '', '1');";
					execSQL($con, $sql);
					insertSyncQueryDetails($con, "searchtemplate", "", SYNC_ACTION::$STRUC_INSERT, $sql, "");
					$sql="insert into addonforms values ('table_60');";
					execSQL($con, $sql);
					$sql="update licenseinfo set attachment_storage_size='0'";
					execSQL($con, $sql);
					$sql="delete from attachmentinfo";
					execSQL($con, $sql);
					$sql="alter table attachmentinfo add column fieldname varchar(100) after isimage";
					execSQL($con, $sql);
  }
  function migrateEScanGroupTable($con){
  $sql="show columns from ". DBINFO::$APPDBNAME .".escangrouptable where field='fromid';";
  $result = getResultArray($con, $sql);
  if(sizeof($result) == 0){
  $sql="alter table ". DBINFO::$APPDBNAME .".escangrouptable add column (fromid varchar(1000) not null default '',subject varchar(1000) not null default '');";
  execSQL($con, $sql);		
  } 
  $sql="update formtable set labelname='Lead Automation' where formname='table_30';";
execSQL($con, $sql);
$sql="update escanruletable set ackstatus=0 ;";
execSQL($con, $sql);
  }
  function migrateGeneralSettings($con){
  $sql="alter table generalsettings modify column propertyvalue varchar(500);";
  execSQL($con, $sql);
  $sql="select max(cast(id as unsigned)) from generalsettings;";
  $result = getResultArray($con, $sql);
  $maxid=$result[0][0];
  $maxid++;
  $sql="insert into generalsettings values ('$maxid','MAP_VIDEO_HELP_URL','http://dlo8kfdxrc8rf.cloudfront.net/posters/Map.png,http://dlo8kfdxrc8rf.cloudfront.net/videos/Map.mp4');";
  execSQL($con, $sql);
  $maxid++;
  $sql="insert into generalsettings values ('$maxid','IMPORT_VIDEO_HELP_URL','http://dlo8kfdxrc8rf.cloudfront.net/posters/Import-Export.png,http://dlo8kfdxrc8rf.cloudfront.net/videos/Import-Export.mp4');";	
  execSQL($con, $sql);
  $maxid++;
  $sql="insert into generalsettings values ('$maxid','GETTING_STARTED_VIDEO_HELP_URL','http://dlo8kfdxrc8rf.cloudfront.net/posters/Getting-started-web-application.png,http://dlo8kfdxrc8rf.cloudfront.net/videos/Getting-started-web-application.mp4');";
  execSQL($con, $sql);
  }
  function migrateDocumentForm($con){
  $sql="select * from picklisttable where name='Document Type' and itemname='Attachment';";
  $result = getResultArray($con, $sql);
  if(sizeof($result) == 0){
  $sql="select max(cast(itemorder as unsigned))+1 from picklisttable where name='Document Type';";	
  $result = getResultArray($con, $sql);
  $maxitemorder=$result[0][0];
  $currenttime = date ('Y-m-d H:i:s');
  $sql="insert into picklisttable values('Document Type','Attachment','$maxitemorder','0','$currenttime','0');";
  execSQL($con, $sql);
  }
  }
  function migrateUserUsageReports($con){
  $sql="select reportid from reportform where formname='table_49';";	
  $result = getResultArray($con, $sql);
  for($ri=0;$ri<sizeof($result);$ri++){
  $reportid=$result[$ri][0];  
  $sql="delete FROM reportgroupdetailtable  where groupid in (select groupid from reportgrouptable where reportid=$reportid);";
  execSQL($con, $sql);
  $sql="delete from reportgrouptable where reportid=$reportid;";
  execSQL($con, $sql);
  $sql="delete from reportfieldtable where reportid=$reportid;";
   execSQL($con, $sql);
  $sql="delete from reportfilterfieldtable where reportid=$reportid;";
   execSQL($con, $sql);
  $sql="delete from reportfilterfieldvaluetable where reportid=$reportid;";
   execSQL($con, $sql);
  $sql="delete from reportmodule where reportid=$reportid;";
   execSQL($con, $sql);
  $sql="delete from reportsubmodule where reportid=$reportid;";
   execSQL($con, $sql);
  $sql="delete from reportschedulerusermailstaus where reportid = '$reportid'";
   execSQL($con, $sql);
  $sql="delete from reportscheduler where reportid='$reportid';";
   execSQL($con, $sql);
   $sql="delete from reportform where reportid='$reportid';";
   execSQL($con, $sql);
  }
  $sql="select max(reportid)+1 from reportform;";
  $result = getResultArray($con, $sql);
  $newreportid=$result[0][0];
  $currenttime = date ('Y-m-d H:i:s');
  $sql="insert into reportform values ('$newreportid','0','Userwise Usage Details','To view the user\'s last crm usage information','','','','','Table','0','Content/images/micon.png','1','1','0','','1','$currenttime','0','Setup','table_49');";
  execSQL($con, $sql);
  $sql="insert into reportfieldtable values($newreportid,'Setup', 'table_49', 'User', '', '','0','0','100','','','','','0');";
  execSQL($con, $sql);
  $sql="insert into reportfieldtable values($newreportid,'Setup', 'table_49', 'Total', '', '','0','0','100','','','','','1');";
  execSQL($con, $sql);
  $sql="insert into reportfieldtable values($newreportid,'Setup', 'table_49', 'Forms', '', '','0','0','100','','','','','2');";
  execSQL($con, $sql);
  $sql="insert into reportfieldtable values($newreportid,'Setup', 'table_49', 'Last_Usage_Details', '','','0','0','100','','','','','3');";
  execSQL($con, $sql);
  $sql="insert into reportfilterfieldtable values($newreportid,'Setup', 'table_49', 'User','0');";
  execSQL($con, $sql);
  $sql="select moduleorder from reportmodule where name='Usage Reports';";
  $result = getResultArray($con, $sql);
  $moduleorder=$result[0][0];
  if(sizeof($result) == 0){
  $sql="select max(moduleorder)+1 from reportmodule;";
  $result = getResultArray($con, $sql);	
  $moduleorder=$result[0][0];
  }
  $sql="select max(reportorder)+1 from reportmodule where name='Usage Reports';";
  $result = getResultArray($con, $sql);	
  $reportorder=1;
  if(sizeof($result) > 0){
  $reportorder=$result[0][0];	
  }
  $sql="insert into reportmodule values( 'Usage Reports', $newreportid,'$reportorder','$moduleorder');";
  execSQL($con, $sql);
  $sql="insert into reportsubmodule values( '', $newreportid);";
  execSQL($con, $sql);
  $sql="insert into reportschedulerusermailstaus values('$newreportid','0','')";
  execSQL($con, $sql);
  $sql="alter table table_49_frm modify column Last_Usage_Details varchar(1000);";
  execSQL($con, $sql);
  $sql="select * from addonforms where formname='table_49';";
  $result = getResultArray($con, $sql);	
  if(sizeof($result) == 0){
  $sql="insert into addonforms values ('table_49')";
  execSQL($con, $sql);	
  }
  }
 function migrateUserUsageReports1($con){
 $sql="select max(fieldorder)+1 from formfieldtable where formname='table_6' and type not in ('subtable','form_history');";
 $result = getResultArray($con, $sql);
 $maxfieldorder=$result[0][0];
 $sql="insert into formfieldtable values('Setup','table_6','Last_Used_Device','Last Used Device','Text','40','','','','','1','1','100','200','150','0','0','Normal','Advanced','','1','0','$maxfieldorder','0','0','0','0','0','','1',0,0,0,'ALL',NULL
);";
 execSQL($con, $sql);
$maxfieldorder=$maxfieldorder+1;
$sql="insert into formfieldtable values(
'Setup','table_6','Last_Used_Form','Last Used Form','Text','100','','','','','1','1','100','200','150','0','0','Normal','NO','','1','0','$maxfieldorder','0','0','0','0','0','','1',0,0,0,'ALL',NULL
);";
 execSQL($con, $sql);
$maxfieldorder=$maxfieldorder+1;
$sql="insert into formfieldtable values(
'Setup','table_6','Last_Used_Time','Last Used Time','Date_Time','100','','','','','1','1','100','200','150','0','0','Normal','NO','','1','0','$maxfieldorder','0','0','0','0','0','','1',0,0,0,'ALL',NULL
);";
 execSQL($con, $sql);
$maxfieldorder=$maxfieldorder+1;
$sql="insert into formfieldtable values(
'Setup','table_6','Last_Used_Location','Last Used Location','Text','500','','','','','1','1','100','200','150','0','0','Normal','Advanced','','1','0','$maxfieldorder','0','0','0','0','0','','1',0,0,0,'ALL',NULL
);";
 execSQL($con, $sql);
 $sql="alter table table_6_frm add `Last_Used_Device` varchar(40)";
 execSQL($con, $sql);
 $sql="alter table table_6_frm add `Last_Used_Form` varchar(100)";
 execSQL($con, $sql);
 $sql="alter table table_6_frm add `Last_Used_Time` varchar(40)";
 execSQL($con, $sql);
 $sql="alter table table_6_frm add `Last_Used_Location` varchar(500)";
 execSQL($con, $sql);
 $sql="update formfieldtable set fieldorder=fieldorder+4 where formname='table_6' and type in ('subtable','form_history');";
 execSQL($con, $sql);
 $sql="select rolename from table_2_frmscreen where formname like 'table_6,%';";
 $result = getResultArray($con, $sql);
 for($ri=0;$ri<sizeof($result);$ri++){
 $rolename=$result[$ri][0];
 $sql="update table_2_frmfields set fields=concat(fields,'#Last_Used_Device,#0,$#Last_Used_Form,#0,$#Last_Used_Time,#0,$#Last_Used_Location,#0,$') where formname='table_6' and rolename='$rolename';";
 execSQL($con, $sql); 
}
  $sql="select reportid from reportform where formname='table_49';";	
  $result = getResultArray($con, $sql);
  for($ri=0;$ri<sizeof($result);$ri++){
  $reportid=$result[$ri][0];  
  $sql="delete FROM reportgroupdetailtable  where groupid in (select groupid from reportgrouptable where reportid=$reportid);";
  execSQL($con, $sql);
  $sql="delete from reportgrouptable where reportid=$reportid;";
  execSQL($con, $sql);
  $sql="delete from reportfieldtable where reportid=$reportid;";
   execSQL($con, $sql);
  $sql="delete from reportfilterfieldtable where reportid=$reportid;";
   execSQL($con, $sql);
  $sql="delete from reportfilterfieldvaluetable where reportid=$reportid;";
   execSQL($con, $sql);
  $sql="delete from reportmodule where reportid=$reportid;";
   execSQL($con, $sql);
  $sql="delete from reportsubmodule where reportid=$reportid;";
   execSQL($con, $sql);
  $sql="delete from reportschedulerusermailstaus where reportid = '$reportid'";
   execSQL($con, $sql);
  $sql="delete from reportscheduler where reportid='$reportid';";
   execSQL($con, $sql);
   $sql="delete from reportform where reportid='$reportid';";
   execSQL($con, $sql);
  }
  $sql="select max(reportid)+1 from reportform;";
  $result = getResultArray($con, $sql);
  $newreportid=$result[0][0];
  $currenttime = date ('Y-m-d H:i:s');
  $sql="insert into reportform values ('$newreportid','0','Crm Usage Details','To view the user\'s last crm usage information','','','','','Table','0','Content/images/micon.png','1','1','0','','1','$currenttime','0','Setup','table_6');";
  execSQL($con, $sql);
  $sql="insert into reportfieldtable values($newreportid,'Setup', 'table_6', 'Name', 'User Name', '','0','0','100','','','','','0');";
  execSQL($con, $sql);
  $sql="insert into reportfieldtable values($newreportid,'Setup', 'table_6', 'MobileNo', 'Mobile No', '','0','0','100','','','','','1');";
  execSQL($con, $sql);
  $sql="insert into reportfieldtable values($newreportid,'Setup', 'table_6', 'Last_Used_Form', 'Last Action', '','0','0','100','','','','','2');";
  execSQL($con, $sql);
  $sql="insert into reportfieldtable values($newreportid,'Setup', 'table_6', 'Last_Used_Time', 'Last Active Date/ Time', '','0','2','100','','','','','3');";
  execSQL($con, $sql);
  $sql="insert into reportfieldtable values($newreportid,'Setup', 'table_6', 'Last_Used_Device', 'Accessed Via', '','0','0','100','','','','','4');";
  execSQL($con, $sql);
  $sql="insert into reportfilterfieldtable values($newreportid,'Setup', 'table_6', 'Name','0');";
  execSQL($con, $sql);
  $sql="insert into reportfilterfieldvaluetable values($newreportid,'Setup', 'table_6', 'Account_Status','is', 'Active','',0);";
  execSQL($con, $sql);
  $sql="select moduleorder from reportmodule where name='Usage Reports';";
  $result = getResultArray($con, $sql);
  $moduleorder=$result[0][0];
  if(sizeof($result) == 0){
  $sql="select max(moduleorder)+1 from reportmodule;";
  $result = getResultArray($con, $sql);	
  $moduleorder=$result[0][0];
  }
  $sql="select max(reportorder)+1 from reportmodule where name='Usage Reports';";
  $result = getResultArray($con, $sql);	
  $reportorder=1;
  if(sizeof($result) > 0){
  $reportorder=$result[0][0];	
  }  
  $sql="insert into reportmodule values( 'Usage Reports', $newreportid,'$reportorder','$moduleorder');";
  execSQL($con, $sql);
  $sql="insert into reportsubmodule values( '', $newreportid);";
  execSQL($con, $sql);
  $sql="insert into reportschedulerusermailstaus values('$newreportid','0','')";
  execSQL($con, $sql);
 }
function migrateUserTable($con){
 $sql="select max(fieldorder)+1 from formfieldtable where formname='table_6' and type not in ('subtable','form_history');";
 $result = getResultArray($con, $sql);
 $maxfieldorder=$result[0][0];
 $sql="insert into formfieldtable values('Setup','table_6','Apply_Territory_Sharing','Apply Territory Sharing','CheckBox','40','','','','','0','0','100','200','150','0','0','Normal','Advanced','Yes','1','0','$maxfieldorder','0','0','0','0','0','','1',0,0,0,'ALL',NULL
);";
 execSQL($con, $sql);
 $sql="alter table table_6_frm add `Apply_Territory_Sharing` varchar(40) default 'Yes'";
 execSQL($con, $sql);
 $sql="update formfieldtable set fieldorder=fieldorder+1 where formname='table_6' and type in ('subtable','form_history');";
 execSQL($con, $sql);
 $sql="select rolename from table_2_frmscreen where formname like 'table_6,%';";
 $result = getResultArray($con, $sql);
 for($ri=0;$ri<sizeof($result);$ri++){
 $rolename=$result[$ri][0];
 $sql="update table_2_frmfields set fields=concat(fields,'#Apply_Territory_Sharing,Apply_Territory_Sharing#1,1$') where formname='table_6' and rolename='$rolename';";
 execSQL($con, $sql); 
}
  $sql="show columns from ". DBINFO::$APPDBNAME .".ctintegration where field='kplan';";
  $result = getResultArray($con, $sql);
  if(sizeof($result) == 0){
  $sql="alter table ". DBINFO::$APPDBNAME .".ctintegration add column kplan varchar(100) default 'Basic' after username;";
  execSQL($con, $sql);
  $sql="alter table ". DBINFO::$APPDBNAME .".ctintegration modify column username varchar(200);";
  execSQL($con, $sql);		
  } 
}
function migrateCompanyForm($con){
 $sql="show columns from table_21_frm where field='PAN_No';";
 $result = getResultArray($con, $sql);
 if(sizeof($result) == 0){
 $sql="select max(fieldorder)+1 from formfieldtable where formname='table_21' and type not in ('subtable','form_history');";
 $result = getResultArray($con, $sql);
 $maxfieldorder=$result[0][0];
 $sql="insert into formfieldtable values('Setup', 'table_21', 'PAN_No', 'PAN No', 'Text', '100', '', '', '', '', '0', '0', '100', '200', '150', '0', '0', 'Normal', 'Advanced', '', '1', '0', '$maxfieldorder', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', NULL);";
 execSQL($con, $sql);	
 $maxfieldorder++;
 $sql="insert into formfieldtable values('Setup', 'table_21', 'GST_IN', 'GST IN', 'Text', '100', '', '', '', '', '0', '0', '100', '200', '150', '0', '0', 'Normal', 'Advanced', '', '1', '0', '$maxfieldorder', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', NULL);";
 execSQL($con, $sql);	
 $sql="alter table table_21_frm add `PAN_No` varchar(100) after `Tracking_Interval`";
 execSQL($con, $sql);
 $sql="alter table table_21_frm add `GST_IN` varchar(100) after `PAN_No`";
 execSQL($con, $sql);
 $sql="update formfieldtable set fieldorder=fieldorder+2 where formname='table_21' and type in ('subtable','form_history');";
 execSQL($con, $sql);
 $sql="select rolename from table_2_frmscreen where formname like 'table_21,%';";
 $result = getResultArray($con, $sql);
 for($ri=0;$ri<sizeof($result);$ri++){
 $rolename=$result[$ri][0];
 $sql="update table_2_frmfields set fields=concat(fields,'#PAN_No,PAN_No#1,1$#GST_IN,GST_IN#1,1$') where formname='table_21' and rolename='$rolename';";
 execSQL($con, $sql); 
 }	
 $sql="update formtable set style = 'g_root,g_root,0,1,0,0,0,0$true,g_root,g_Account Info,0,2,0,0,0,0$true,g_Account Info,f_1,0,0,0,0,0,0$true,g_Account Info,f_19,1,0,0,0,0,0$true,g_Account Info,f_7,2,0,0,0,0,0$true,g_Account Info,f_5,3,0,0,0,0,0$true,g_Account Info,f_3,4,0,0,0,0,0$true,g_Account Info,f_2,5,0,0,0,0,0$true,g_Account Info,f_36,6,0,0,0,0,0$true,g_Account Info,f_37,7,0,0,0,0,0$true,g_root,g_Billing Contact Info,1,2,0,0,0,0$true,g_Billing Contact Info,f_20,0,0,0,0,0,0$true,g_Billing Contact Info,f_21,1,0,0,0,0,0$true,g_Billing Contact Info,f_4,2,0,0,0,0,0$true,g_Billing Contact Info,f_6,3,0,0,0,0,0$true,g_root,g_Address Info,2,2,0,0,0,0$true,g_Address Info,f_22,0,0,0,0,0,0$true,g_Address Info,f_23,1,0,0,0,0,0$true,g_Address Info,f_24,2,0,0,0,0,0$true,g_Address Info,f_25,3,0,0,0,0,0$true,g_Address Info,f_26,4,0,0,0,0,0$true,g_Address Info,f_27,5,0,0,0,0,0$true,g_Address Info,f_28,6,0,0,0,0,0$true,g_root,g_Other Info,3,2,0,0,0,0$true,g_Other Info,f_9,0,0,0,0,0,0$true,g_Other Info,f_10,1,0,0,0,0,0$true,g_Other Info,f_14,2,0,0,0,0,0$true,g_Other Info,f_33,3,0,0,0,0,0$true,g_Other Info,f_35,4,0,0,0,0,0$true,g_root,g_Settings-Daily Reports,4,2,0,0,0,0$true,g_Settings-Daily Reports,f_29,0,0,0,0,0,0$true,g_Settings-Daily Reports,f_30,1,0,0,0,0,0$true,g_Settings-Daily Reports,f_31,2,0,0,0,0,0$true,g_root,g_Settings-Auto Tracking,5,2,0,0,0,0$true,g_Settings-Auto Tracking,f_32,0,0,0,0,0,0$true,g_Settings-Auto Tracking,f_34,1,0,0,0,0,0$true,g_root,g_Settings-Location,6,2,0,0,0,0$true,g_root,f_8,7,0,0,0,0,0$true,g_root,f_11,8,0,0,0,0,0$true,g_root,f_12,9,0,0,0,0,0$true,g_root,f_13,10,0,0,0,0,0$true,g_root,f_15,11,0,0,0,0,0$true,g_root,f_16,12,0,0,0,0,0$true,g_root,f_17,13,0,0,0,0,0$true,g_root,f_18,14,0,0,0,0,0$true' where formname='table_21' and modulename = 'Setup'";
 execSQL($con, $sql);  
}
 $sql="show columns from table_53_frm where field='HSNSAC_Code';";
 $result = getResultArray($con, $sql);
 if(sizeof($result) == 0){
 $sql="select max(fieldorder)+1 from formfieldtable where formname='table_53' and type not in ('subtable','form_history');";
 $result = getResultArray($con, $sql);
 $maxfieldorder=$result[0][0];
 $sql="select name from formfieldtable where formname='table_53' and type not in('subtable','form_history') order by fieldorder desc";
 $result = getResultArray($con, $sql);
 $lastcolname=$result[0][0];
 $sql="insert into formfieldtable values('Products', 'table_53', 'HSNSAC_Code', 'HSN/SAC Code', 'Text', '100', '', '', '', '', '0', '0', '100', '200', '150', '0', '0', 'Normal', 'Advanced', '', '1', '0', '$maxfieldorder', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', NULL);";
 execSQL($con, $sql);  
 $sql="alter table table_53_frm add `HSNSAC_Code` varchar(100) after `$lastcolname`";
 execSQL($con, $sql); 
 $sql="update formfieldtable set fieldorder=fieldorder+1 where formname='table_53' and type in ('subtable','form_history');";
 execSQL($con, $sql);
 $sql="select rolename from table_2_frmscreen where formname like 'table_53,%';";
 $result = getResultArray($con, $sql);
 for($ri=0;$ri<sizeof($result);$ri++){
 $rolename=$result[$ri][0];
 $sql="update table_2_frmfields set fields=concat(fields,'#HSNSAC_Code,HSNSAC_Code#1,1$') where formname='table_53' and rolename='$rolename';";
 execSQL($con, $sql); 
 }
 $sql="update formtable set style = 'g_root,g_root,0,1,0,0,0,0$true,g_root,g_Product / Service Info,0,2,0,0,0,0$true,g_Product / Service Info,f_1,0,0,0,0,0,0$true,g_Product / Service Info,f_3,1,0,0,0,0,0$true,g_Product / Service Info,f_4,2,0,0,0,0,0$true,g_Product / Service Info,f_6,3,0,0,0,0,0$true,g_Product / Service Info,f_5,4,0,0,0,0,0$true,g_root,g_Product / Service Description,1,1,0,0,0,0$true,g_Product / Service Description,f_2,0,0,0,0,0,0$true' where formname='table_53' and modulename = 'Products'";
 execSQL($con, $sql);  
 $sql="select * from searchtemplate where formname='table_53' and templatename ='Import Template'";
 $result = getResultArray($con, $sql);
 if(sizeof($result) == 0){
 $sql="update searchtemplate set viewfields=concat(viewfields,'$maxfieldorder,0,') where formname='table_53' and templatename ='Import Template';";	
 execSQL($con, $sql); 
 }
 $sql="select formname from refferedfielddetails where refformname='table_53' and reffieldname='Product_Name' and fieldname='Item_Name';";
 $result = getResultArray($con, $sql);
 if(sizeof($result) > 0){
 $pltfname=$result[0][0];
 $sql="select max(fieldorder)+1 from formfieldtable where formname='$pltfname' and type not in ('subtable','form_history');";
 $result = getResultArray($con, $sql);
 $maxfieldorder=$result[0][0];
 $sql="select name from formfieldtable where formname='$pltfname' and type not in('subtable','form_history') order by fieldorder desc";
 $result = getResultArray($con, $sql);
 $lastcolname=$result[0][0];
 $sql="insert into formfieldtable values('ProductLineItem', '$pltfname', 'HSNSAC_Code', 'HSN/SAC Code', 'Referred', '100', '', '', '', '', '0', '0', '100', '200', '150', '0', '0', 'Normal', 'Advanced', '', '1', '0', '$maxfieldorder', '0', '0', '0', '0', '0', '', '1', 0, 0, 0, 'ALL', NULL);";	
 execSQL($con, $sql); 
 $sql="alter table $pltfname"."_frm add `HSNSAC_Code` varchar(100) after `$lastcolname`";
 execSQL($con, $sql); 
 $sql="update formfieldtable set fieldorder=fieldorder+1 where formname='$pltfname' and type in ('subtable','form_history');";
 execSQL($con, $sql);
 $sql="select rolename from table_2_frmscreen where formname like '$pltfname,%';";
 $result = getResultArray($con, $sql);
 for($ri=0;$ri<sizeof($result);$ri++){
 $rolename=$result[$ri][0];
 $sql="update table_2_frmfields set fields=concat(fields,'#HSNSAC_Code,HSNSAC_Code#1,1$') where formname='$pltfname' and rolename='$rolename';";
 execSQL($con, $sql); 
 }
 $sql="select * from refferedfielddetails where fieldname='HSNSAC_Code' and formname = '$pltfname'";
 $result = getResultArray($con, $sql);
 if(sizeof($result) == 0){
 $sql="select refid from refferedfielddetails where fieldname='Item_Name' and formname = '$pltfname'";
 $result = getResultArray($con, $sql); 
 $baserefid=$result[0][0];	
 $sql="select max(cast(refid as signed)) from refferedfielddetails FOR UPDATE ; ";
 $result = getResultArray($con, $sql); 
 $newrefid=$result[0][0];
 $newrefid++;
 $sql="insert into refferedfielddetails values('$newrefid','1','ProductLineItem','$pltfname','HSNSAC_Code','Products','table_53','HSNSAC_Code','false','','false','','true','$baserefid','false','')";
 execSQL($con, $sql); 
 }
 }
 }
 }
?>
