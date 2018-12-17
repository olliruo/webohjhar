<head>
	<!-- website title -->
	<title>Meisseli Oy Ab</title>
	
	<!-- set charset to UTF-8 -->
	<meta charset="UTF-8">
	
	<!-- get device width, set as viewport width -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<!-- IE compability -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<!-- custom CSS -->
	<link rel="stylesheet" type="text/css" href="styles/styles.css">
</head>

<body>

<?php
ini_set('error_reporting', E_ALL);

if (isset($_GET["login"])) $login_request = $_GET["login"];
else $login_request = "false";
if (isset($_GET["register"])) $register_request = $_GET["register"];
else $register_request = "false";
if (isset($_GET["registerapply"])) $registerapply_request = $_GET["registerapply"];
else $registerapply_request = "false";
if (isset($_GET["changeinfo"])) $changeinfo_request = $_GET["changeinfo"];
else $changeinfo_request = "false";
if (isset($_GET["changeinfoapply"])) $changeinfoapply_request = $_GET["changeinfoapply"];
else $changeinfoapply_request = "false";
if (isset($_GET["devices"])) $devices_request = $_GET["devices"];
else $devices_request = "false";
if (isset($_GET["deviceslease"])) $devices_lease_request = $_GET["deviceslease"];
else $devices_lease_request = "false";
if (isset($_GET["newdevice"])) $newdevice_request = $_GET["newdevice"];
else $newdevice_request = "false";
if (isset($_GET["deldevice"])) $deldevice_request = $_GET["deldevice"];
else $deldevice_request = "false";
if (isset($_GET["moddevice"])) $moddevice_request = $_GET["moddevice"];
else $moddevice_request = "false";
if (isset($_GET["logout"])) $logout = $_GET["logout"];
else $logout = "false";

if (!($register_request == "true" || $changeinfo_request == "true" || $devices_request == "true" || $devices_lease_request == "true"))
{
	$login_request = true;
}


// Start session
if(session_status()!= PHP_SESSION_ACTIVE)
{
	session_start();
}

if ($logout == "true")
{
	$cust = array();
	$_SESSION["cust"] = array();
	session_unset();
	session_destroy();
}


//customer tiedot
$cust = array();

$cust["id"] = "";
$cust["username"] = "";
$cust["firstname"] = "";
$cust["lastname"] = "";
$cust["address"] = "";
$cust["postal"] = "";
$cust["city"] = "";
$cust["email"] = "";
$cust["phone"] = "";
$cust["password"] = "";

if (isset($_SESSION["cust"]))
{
	$cust = $_SESSION["cust"];
}

if (isset($_GET["username"])) $username = $_GET["username"];
else $username = "";
if (isset($_GET["firstname"])) $firstname = $_GET["firstname"];
else $firstname = "";
if (isset($_GET["lastname"])) $lastname = $_GET["lastname"];
else $lastname = "";
if (isset($_GET["address"])) $address = $_GET["address"];
else $address = "";
if (isset($_GET["postal"])) $postal = $_GET["postal"];
else $postal = "";
if (isset($_GET["city"])) $city = $_GET["city"];
else $city = "";
if (isset($_GET["email"])) $email = $_GET["email"];
else $email = "";
if (isset($_GET["phone"])) $phone = $_GET["phone"];
else $phone = "";
if (isset($_GET["password"])) $password = $_GET["password"];
else $password = "";
if (isset($_GET["confirm_password"])) $confirm_password = $_GET["confirm_password"];
else $confirm_password = "";

if (isset($_GET["device_id"])) $device_id = $_GET["device_id"];
else $device_id = "";
if (isset($_GET["device_category"])) $device_category = $_GET["device_category"];
else $device_category = "";
if (isset($_GET["device_name"])) $device_name = $_GET["device_name"];
else $device_name = "";
if (isset($_GET["device_manufactor"])) $device_manufactor = $_GET["device_manufactor"];
else $device_manufactor = "";
if (isset($_GET["device_model"])) $device_model = $_GET["device_model"];
else $device_model = "";
if (isset($_GET["device_description"])) $device_description = $_GET["device_description"];
else $device_description = "";
if (isset($_GET["device_serialnumber"])) $device_serialnumber = $_GET["device_serialnumber"];
else $device_serialnumber = "";


if(session_status() == PHP_SESSION_ACTIVE)
{
dbgetcustomer($cust["username"]);

if (strlen($cust["username"]) > 3 || $login_request == true && strlen($username) > 3) // NAVBAR
{
	echo '<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="#" class="navbar-brand">Välinevuokraamo meisseli </a>
			</div>
			<div class="dropdown navbar-right" id="right">
				<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Valikko<span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><form>
						<input type = "hidden" name = "deviceslease" value = "true">
						<input class="btn btn-nav" type="submit" value="Varattavissa olevat laitteet">
					</form></li>
					<li><form>
						<input type = "hidden" name = "devices" value = "true">
						<input class="btn btn-nav" type="submit" value="Minun laitteet">
					</form></li>
					<li><form>
						<input type = "hidden" name = "changeinfo" value = "true">
						<input class="btn btn-nav" type="submit" value="Henkilötiedot">
					</form></li>
					<li><form>
						<input type = "hidden" name = "logout" value = "true">
						<input class="btn btn-nav" type="submit" value="Kirjaudu ulos">
					</form></li>
				</ul>
			</div>
		</div>
	</nav>';
}

if ($devices_request == "true")
{
	if ($newdevice_request == "true")
	{
		if (dbnewdevice($cust["id"], $device_category, $device_name, $device_manufactor, $device_model, $device_description, $device_serialnumber ))
		{
			echo "<p>Laite lisätty!</p>";
		}
		else
		{
			echo "Laitteen lisääminen epäonnistui. :(";
		}
	}
	
	if ($deldevice_request == "true")
	{
		if (dbdeletedevice($device_id))
		{
			echo "<p>Laite poistettu!</p>";
		}
		else
		{
			echo "Laitteen poistaminen epäonnistui. :( byhyy";
		}
	}
	
	if ($moddevice_request == "true")
	{
		echo "Laitteen muokkaus pyydetty";
	}
	
	dbgetdevices($cust["id"]);
	
	// Etusivu / omat laitteet
	echo'			
	<div class="container">
		<div class="row">
			<h1>Laitteet</h1>
			<div class="list-group">';
				echo(buttonsfordevices($_SESSION["devices"]));
				echo '
			</div>
			<a class="btn btn-primary" data-toggle="modal" data-target="#newdevice">Lisää laite</a>
		</div>
	</div>';
}

if ($devices_lease_request == "true")
{
	echo'			
	<div class="container">
		<div class="row">
			<h1>Varattavissa olevat laitteet</h1>
			<form action="index.php">
				<input type="hidden" name="deviceslease" value="true">
				<input style="width: 200px;" type="text" name="searchwords" class="form-control pull-right" placeholder="Hae kirjoittamalla..." value="">
			</form>
			<br /><br />
			<div class="list-group">';
				echo(buttonsfordevices($_SESSION["devices"], true));
				echo '
			</div>
		</div>
	</div>';
}
if ($changeinfo_request == "true")
{
	if($changeinfoapply_request == "true")
	{
		if(dbmodify($cust["id"], $firstname, $lastname, $address, $postal, $city, $phone, $email))
		{
			$cust["firstname"] = $firstname;
			$cust["lastname"] = $lastname;
			$cust["address"] = $address;
			$cust["postal"] = $postal;
			$cust["city"] = $city;
			$cust["email"] = $email;
			$cust["phone"] = $phone;
			
			$_SESSION["cust"] = $cust;
			
			echo "<p>Tiedot päivitettiin onnistuneesti!</p>";
		}
		
		else
		{
			echo "<p>Tietojen päivitys epäonnistui!</p>";
		}
	}
	echo "
	<form name=\"frmRegistration\" method=\"get\" action=\"index.php\">
		<table border=\"0\" width=\"500\" align=\"center\" class=\"demo-table\">
			<tr>
				<td>Etunimi</td>
				<td><input type=\"text\" class=\"demoInputBox\" name=\"firstname\" value=\"" . $cust["firstname"] . "\"></td>
			</tr>
			<tr>
				<td>Sukunimi</td>
				<td><input type=\"text\" class=\"demoInputBox\" name=\"lastname\" value=\"" . $cust["lastname"] . "\"></td>
			</tr>
			<tr>
				<td>Osoite</td>
				<td><input type=\"text\" class=\"demoInputBox\" name=\"address\" value=\"" . $cust["address"] . "\"></td>
			</tr>
			<tr>
				<td>Postinumero</td>
				<td><input type=\"text\" class=\"demoInputBox\" name=\"postal\" value=\"" . $cust["postal"] . "\"></td>
			</tr>
			<tr>
				<td>Kaupunki</td>
				<td><input type=\"text\" class=\"demoInputBox\" name=\"city\" value=\"" . $cust["city"] . "\"></td>
			</tr>
			<tr>
				<td>Sähköpostiosoite</td>
				<td><input type=\"text\" class=\"demoInputBox\" name=\"email\" value=\"" . $cust["email"] . "\"></td>
			</tr>
			<tr>
				<td>Puhelinnumero</td>
				<td><input type=\"text\" class=\"demoInputBox\" name=\"phone\" value=\"" . $cust["phone"] . "\"></td>
			</tr>
			<tr>
				<input type = \"hidden\" name = \"changeinfoapply\" value = \"true\">
				<input type = \"hidden\" name = \"changeinfo\" value = \"true\">
				<td colspan=2><input type=\"submit\" value=\"Tallenna\" class=\"btnRegister\"></td>
			</tr>
		</table>
	</form>";
}

if ($register_request == "true")
{
	if ($registerapply_request == "true" && isset($username) && isset($firstname) && isset($lastname) && isset($address) && isset($postal) && isset($city) && isset($email) && isset($phone) && isset($password) && isset($confirm_password))
	{
		if (dbregister($username, $firstname, $lastname, $address, $postal, $city, $password, $confirm_password, $phone, $email))
		{
			echo "<p>Registered succesfully!</p>";
		}
		else
		{
			echo "<p>Not work</p>";
		}
	}
	else
	{
		echo "<p>Syötä kaikki tarvittavat tiedot!</p>";
	}
	echo "
	<form name=\"frmRegistration\" method=\"get\" action=\"index.php\">
		<table border=\"0\" width=\"500\" align=\"center\" class=\"demo-table\">
			<tr>
				<td>User Name</td>
				<td><input type=\"text\" class=\"demoInputBox\" name=\"username\" value=\"" . $username . "\"></td>
			</tr>
			<tr>
				<td>First Name</td>
				<td><input type=\"text\" class=\"demoInputBox\" name=\"firstname\" value=\"" . $firstname . "\"></td>
			</tr>
			<tr>
				<td>Last Name</td>
				<td><input type=\"text\" class=\"demoInputBox\" name=\"lastname\" value=\"" . $lastname . "\"></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><input type=\"text\" class=\"demoInputBox\" name=\"address\" value=\"" . $address . "\"></td>
			</tr>
			<tr>
				<td>Postal</td>
				<td><input type=\"text\" class=\"demoInputBox\" name=\"postal\" value=\"" . $postal . "\"></td>
			</tr>
			<tr>
				<td>City</td>
				<td><input type=\"text\" class=\"demoInputBox\" name=\"city\" value=\"" . $city . "\"></td>
			</tr>
					<tr>
				<td>Email</td>
				<td><input type=\"text\" class=\"demoInputBox\" name=\"email\" value=\"" . $email . "\"></td>
			</tr>
					<tr>
				<td>Phone</td>
				<td><input type=\"text\" class=\"demoInputBox\" name=\"phone\" value=\"" . $phone . "\"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type=\"password\" class=\"demoInputBox\" name=\"password\"></td>
			</tr>
			<tr>
				<td>Confirm Password</td>
				<td><input type=\"password\" class=\"demoInputBox\" name=\"confirm_password\"></td>
			</tr>
			<tr>
				<input type = \"hidden\" name = \"registerapply\" value = \"true\">
				<input type = \"hidden\" name = \"register\" value = \"true\">
				<td colspan=2><input type=\"checkbox\" name=\"terms\"> I accept Terms and Conditions <input type=\"submit\" name=\"register-user\" value=\"Register\" class=\"btnRegister\"></td>
			</tr>
		</table>
	</form>";
}

}
else $login_request = "true";
	
if ($login_request == "true")
{
	if (!isset($username) || $username == "")
	{
		echo '
		<table border="0" width="500" align="center" class="demo-table">
			<form name="frmRegistration" method="get" action="index.php">
				<tr>
					<td>User Name</td>
					<td><input type="text" class="demoInputBox" name="username" value="' . $username . '"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" class="demoInputBox" name="password" value=""></td>
				</tr>
				<tr>
					<td><input type = "hidden" name = "login" value = "true"></td>
					<td><input type="submit" value="Login"></td>
				</tr>
			</form>
				<tr>
					<td colspan="2"><form>
							<input type = "hidden" name = "register" value = "true">
							<p>Eikö sinulla ole käyttäjää? Voi harmi, </p>
							<input class="btn btn-primary" type="submit" value="Paina tästä">
						</form></td>
				</tr>
			</table>
		';
	}
	else
	{
		if (dblogin($username, $password))
		{
			// Etusivu / omat laitteet
			echo'			
			<div class="container">
				<div class="row">
					<h1>Tervetuloa takaisin ' . $cust["username"] . '!</h1>
					<form>
						<input type = "hidden" name = "devices" value = "true">
						<input class="btn btn-nav" type="submit" value="No ookoo">
					</form>
				</div>
			</div>';
		}
		else
		{
			echo '
			<p>User name and password do not match ;)</p>
				<table border="0" width="500" align="center" class="demo-table">
				<form name="frmRegistration" method="get" action="index.php">
					<tr>
						<td>User Name</td>
						<td><input type="text" class="demoInputBox" name="username" value="' . $username . '"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="password" class="demoInputBox" name="password" value=""></td>
					</tr>
					<tr>
						<td><input type = "hidden" name = "login" value = "true"></td>
						<td><input type="submit" value="Login"></td>
					</tr>
				</form>
					<tr>
						<td colspan="2"><form>
								<input type = "hidden" name = "register" value = "true">
								<p>Eikö sinulla ole käyttäjää? Voi harmi, </p>
								<input class="btn btn-primary" type="submit" value="Paina tästä">
							</form></td>
					</tr>
				</table>
			';
		}
	}
}

function dbconnect()
{
    $servername = "localhost";
	$username   = "device";
	$password   = "YsCxMmyQm6FQTP2C";
	$database   = "deviceregister";  

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error)
    {
        mysqli_close($conn);
		echo "Can't connect to DB.";
        return false;
    }

    else
    {
        mysqli_set_charset($conn, "utf8");
        return $conn;
    }
}

function dblogin($user, $pass)
{
	// Ohita sisäänkirjautuminen
    //return true;
	
	$conn = dbconnect();

    if ($conn)
    {
        $sql = "SELECT * FROM customer WHERE username='$user' AND password='$pass'";
		
        $result = $conn->query($sql);
        
		$row = array();
		
		$row = $result->fetch_array(MYSQLI_ASSOC);

        mysqli_close($conn);
		
		if (isset($row["username"]) && isset($row["password"]))
		{
			if($row["username"] == $user && $row["password"] == $pass)
			{
				dbgetcustomer($user);
				return true;
			}
		}
        return false;
    }
    mysqli_close($conn);
    return false;
}

function dbregister($username, $firstname, $lastname, $address, $postal, $city, $password, $confirm_password, $phone, $email)
{
	if ($password === $confirm_password)
	{
		$conn = dbconnect();
		
		if ($conn)
		{
			$sql = "SELECT * FROM customer WHERE `username` = '$username' LIMIT 1";
			$result = $conn->query($sql);
			mysqli_close($conn);
			
			$row = array();
		
			if ($result = false) return false;

			if (is_array($result)) $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			
			if (isset($result))
			{
				if(is_array($result))
				{
					if($result->num_rows != 0) //Username already exists
					{
						return false;
					}
				}
			}
			else
			{
				$join_date = $last_login = date('Y-m-d H:i:s', time());

				$conn = dbconnect();
			
				if ($conn)
				{
					$sql = "INSERT INTO customer(username, password, firstname, lastname, address, postal, city, phone, email, join_date, last_login) VALUES ('$username', '$password', '$firstname', '$lastname', '$address', '$postal', '$city', '$phone', '$email', '$join_date', '$last_login')";
					$result = $conn->query($sql);
					mysqli_close($conn);
					return $result;
				}
				
				else
				{
					echo "INSERT";
					mysqli_close($conn);
					return false;
				}
			}
		}
		else
		{
			mysqli_close($conn);
			return false;
		}
	}
	else 
	{	
		echo("<p>salasanat eivät täsmää</p>");
		return false;
	}
}

function dbmodify($userid, $firstname, $lastname, $address, $postal, $city, $phone, $email)
{
	$conn = dbconnect();
	$result = false;
		
	if ($conn)
	{
		$sql = "UPDATE customer SET firstname='$firstname', lastname='$lastname', address='$address', postal='$postal', city='$city', phone='$phone', email='$email' WHERE `customer_id` = $userid";
		$result = $conn->query($sql);
	}
	
	mysqli_close($conn);
	return $result;
}

function dbmodifydevice($deviceid, $cateid, $name, $manufactor, $model, $desc, $serial) // Ounsin työ mua
{
	$conn = dbconnect();
	$result = false;
		
	if ($conn)
	{
		$sql = "UPDATE devices SET name='$name', manufactor='$manufactor', model='$model', desc='$desc', serial='$serial', WHERE `device_id` = '$device_id'";
		$result = $conn->query($sql);
		mysqli_close($conn);
	}
	
	mysqli_close($conn);
	return $result;
}

function dbnewdevice($custid, $cateid, $name, $manufactor, $model, $desc, $serial)
{
	$conn = dbconnect();
		
	if ($conn)
	{
		$sql = "INSERT INTO devices(customer_id, category_id, name, manufactor, model, description, serialnumber) VALUES ($custid, $cateid, '$name', '$manufactor', '$model', '$desc', '$serial')";
		$result = $conn->query($sql);
		mysqli_close($conn);
		return $result;
	}
	
	mysqli_close($conn);
	return false;
}

function dbgetcustomer($username)
{
	$conn = dbconnect();
		
	if ($conn)
	{
		$sql = "SELECT * FROM customer WHERE username = '$username'";
		
		$result = $conn->query($sql);
		
		$row = array();

		$row = $result->fetch_array(MYSQLI_ASSOC);

		$cust["id"] = 			$row['customer_id'];
		$cust["username"] = 	$row['username'];
		$cust["firstname"] = 	$row['firstname'];
		$cust["lastname"] = 	$row['lastname'];
		$cust["address"] = 		$row['address'];
		$cust["postal"] = 		$row['postal'];
		$cust["city"] = 		$row['city'];
		$cust["email"] = 		$row['email'];
		$cust["phone"] = 		$row['phone'];
		$cust["password"] = 	$row['password'];
		
		$_SESSION["cust"] = $cust;
	}
	mysqli_close($conn);
	return false;
}

function dbgetdevices($userid)
{
	$conn = dbconnect();
		
	if ($conn)
	{
		$sql = "SELECT * FROM devices WHERE customer_id = '$userid'";
		
		$result = $conn->query($sql);
		
		$rows = array();
		while ($row = $result->fetch_assoc())
		{
			$rows[] = $row;
		}
		
		$_SESSION["devices"] = $rows;
	}
	mysqli_close($conn);
	return false;
}

function dbgetcategories()
{
	$conn = dbconnect();
			
	if ($conn)
	{
		$sql = "SELECT * FROM category";
		
		$result = $conn->query($sql);
		
		$rows = array();
		while ($row = $result->fetch_assoc())
		{
			$rows[] = $row;
		}
		
		$categories = $rows;
	}
		
	mysqli_close($conn);
	
	$html = "<div class=\"form-group\"><select class=\"form-control\" id=\"catselect\" name=\"device_category\">";
	
	if (isset($categories))
	{
		foreach($categories as $c)
		{
			$html = $html . "<option value=\"" . $c["category_id"] . "\">" . $c["name"] . "</option>";
		}
	}
	else
	{
		$html = "<option value=\"0\">Ei kategorioita</option>";
	}
	
	$html = $html . "</select></div>";
	return $html;
}

function dbdeletedevice($id)
{
	$conn = dbconnect();
	$result = false;
		
	if ($conn)
	{
		$sql = "UPDATE devices SET hide=1 WHERE device_id=$id";
		
		$result = $conn->query($sql);
	}
	mysqli_close($conn);
	return $result;
}

function buttonsfordevices($devices, $showall = false)
{
	$html = "";
	$i = 0;
	
	if($showall == true)
	{
		$conn = dbconnect();
		
		$sql = "SELECT * FROM devices";
		
		$result = $conn->query($sql);
		
		$rows = array();
		while ($row = $result->fetch_assoc())
		{
			$rows[] = $row;
		}
		
		foreach($rows as $d)
		{
			$i++;
			if($d["hide"] == 0)
			{
				$html = $html . "
				<a class=\"btn list-group-item\" data-toggle=\"modal\" data-target=\"#device$i\">
					<h3>" . $d["name"] . "</h3>
					<p>" . $d["description"] . "</p>
				</a>";
			}
		}
	}
	
	else if (isset($devices))
	{
		foreach($devices as $d)
		{
			$i++;
			if($d["hide"] == 0)
			{
				$html = $html . "
				<a class=\"btn list-group-item\" data-toggle=\"modal\" data-target=\"#device$i\">
					<h3>" . $d["name"] . "</h3>
					<p>" . $d["description"] . "</p>
				</a>";
			}
		}
	}
	else
	{
		$html = "<h3>Laitteita ei löytynyt!</h3><p>Lisää uusi laite painamalla nappia.</p>";
	}

	return $html;
}

function modalsfordevices($devices, $showall = false)
{
	$html = "";
	$i = 0;
	
	if($showall == true)
	{
		$conn = dbconnect();
		
		$sql = "SELECT * FROM devices";
		
		$result = $conn->query($sql);
		
		$rows = array();
		while ($row = $result->fetch_assoc())
		{
			$rows[] = $row;
		}
		
		foreach($rows as $d)
		{
			$i++;
			if($d["hide"] == 0)
			{
				$html = $html . "
				<div id=\"device$i\" class=\"modal fade\" role=\"dialog\">
					<div class=\"modal-dialog\">
						<div class=\"modal-content\">
							<div class=\"modal-header\">
								<h3 class=\"modal-title\">" . $d["name"] . "</h3>
							</div>
							<div class=\"modal-body text-center\">
								<p>Omistaja: " . $d["customer_id"] . "</p>
								<p>Kategoria: " . $d["category_id"] . "</p>
								<p>Kuvaus: " . $d["description"] . "</p>
								<p>Valmistaja: " . $d["manufactor"] . "</p>
								<p>Malli: " . $d["model"] . "</p>
								<p>Sarjanumero: " . $d["serialnumber"] . "</p>
							</div>
							<div class=\"modal-footer\">
								<form action=\"index.php\">
									<input class=\"btn btn-primary pull-left\" type=\"submit\" value=\"Varaa tämä laite\">
								</form>
								<button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\">Sulje</button>
							</div>
						</div>
					</div>
				</div>";
			}
		}
	}
	
	if (isset($devices))
	{
		foreach($devices as $d)
		{
			$i++;
			if($d["hide"] == 0)
			{
				$html = $html . "
				<div id=\"device$i\" class=\"modal fade\" role=\"dialog\">
					<div class=\"modal-dialog\">
						<div class=\"modal-content\">
							<div class=\"modal-header\">
								<h3 class=\"modal-title\">" . $d["name"] . "</h3>
							</div>
							<div class=\"modal-body text-center\">
								<p>Kategoria: " . $d["category_id"] . "</p>
								<p>Kuvaus: " . $d["description"] . "</p>
								<p>Valmistaja: " . $d["manufactor"] . "</p>
								<p>Malli: " . $d["model"] . "</p>
								<p>Sarjanumero: " . $d["serialnumber"] . "</p>
							</div>
							<div class=\"modal-footer\">
								<form action=\"index.php\">
									<input type=\"hidden\" name=\"devices\" value=\"true\">
									<input type=\"hidden\" name=\"deldevice\" value=\"true\">
									<input type=\"hidden\" name=\"device_id\" value=\"" . $d["device_id"] . "\">
									<input class=\"btn btn-danger pull-left\" type=\"submit\" value=\"Poista laite\">
								</form>
								<form action=\"index.php\">
									<input type=\"hidden\" name=\"devices\" value=\"true\">
									<input type=\"hidden\" name=\"moddevice\" value=\"true\">
									<input type=\"hidden\" name=\"device_id\" value=\"" . $d["device_id"] . "\">
									<input class=\"btn btn-warning pull-left\" type=\"submit\" value=\"Muokkaa laitteen tietoja\">
								</form>
								<button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\">Sulje</button>
							</div>
						</div>
					</div>
				</div>";
			}
		}
	}
	else $html = "<!-- modalsfordevices: NO DEVICES FOUND, NO MODALS CREATED -->";
	return $html;
}
?>


<footer>
	<p>footer</p>
</footer>

<div id="newdevice" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Lisää laite</h3>
			</div>
			<div class="modal-body text-center">
				<form name="newdevice" method="get" action="index.php">
					<table border="0" width="500" align="center" class="demo-table">
						<tr>
							<td>Kategoria</td>
							<td><?php echo(dbgetcategories()); ?></td>
						</tr>
						<tr>
							<td>Nimi</td>
							<td><input type="text" class="demoInputBox" name="device_name" value=""></td>
						</tr>
						<tr>
							<td>Valmistaja</td>
							<td><input type="text" class="demoInputBox" name="device_manufactor" value=""></td>
						</tr>
						<tr>
							<td>Malli</td>
							<td><input type="text" class="demoInputBox" name="device_model" value=""></td>
						</tr>
						<tr>
							<td>Kuvuas</td>
							<td><input type="text" class="demoInputBox" name="device_description" value=""></td>
						</tr>
						<tr>
							<td>Sarjanumero</td>
							<td><input type="text" class="demoInputBox" name="device_serialnumber" value=""></td>
						</tr>
						
						<input type = "hidden" name = "newdevice" value = "true">
						<input type = "hidden" name = "devices" value = "true">
					</table>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Peruuta ja sulje</button>
				<input class="btn btn-primary pull-left" type="submit" name="save-device" value="Tallenna" class="btnRegister">
				</form>
			</div>
		</div>
	</div>
</div><!-- end modal -->

<?php
if(isset($_SESSION["devices"]))
{
	if ($devices_lease_request == "true")
	{
		echo(modalsfordevices($_SESSION["devices"], true));
	}
	else
	{
		echo(modalsfordevices($_SESSION["devices"]));
	}
}
?>

</body>