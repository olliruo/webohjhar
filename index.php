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
	<link href="https://fonts.googleapis.com/css?family=Bungee" rel="stylesheet">
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
if (isset($_GET["devices_lease_search"])) $devices_search_request = $_GET["devices_lease_search"];
else $devices_search_request = "false";
if (isset($_GET["devices"])) $devices_request = $_GET["devices"];
else $devices_request = "false";
if (isset($_GET["deviceslease"])) $devices_lease_request = $_GET["deviceslease"];
else $devices_lease_request = "false";
if (isset($_GET["lease"])) $lease_request = $_GET["lease"];
else $lease_request = "false";
if (isset($_GET["newdevice"])) $newdevice_request = $_GET["newdevice"];
else $newdevice_request = "false";
if (isset($_GET["deldevice"])) $deldevice_request = $_GET["deldevice"];
else $deldevice_request = "false";
if (isset($_GET["moddevice"])) $moddevice_request = $_GET["moddevice"];
else $moddevice_request = "false";
if (isset($_GET["modifydevice"])) $save_moddevice = $_GET["modifydevice"];
else $save_moddevice = "false";
if (isset($_GET["logout"])) $logout = $_GET["logout"];
else $logout = "false";
if (isset($_GET["my_reservations"])) $my_reservations = $_GET["my_reservations"];
else $my_reservations = "false";

if (!($register_request == "true" || $changeinfo_request == "true" || $devices_request == "true" || $devices_lease_request == "true" || $moddevice_request == "true" || $my_reservations == "true"))
{
	$login_request = true;
}

//Search variables
{
	$search = array();
	
	if (isset($_GET["search_category"])) $search["category"] = $_GET["search_category"];
	else $search["category"] = "false";
	
	if (isset($_GET["search_name"])) $search["name"] = $_GET["search_name"];
	else $search["name"] = "false";
	
	if (isset($_GET["search_manufactor"])) $search["manufactor"] = $_GET["search_manufactor"];
	else $search["manufactor"] = "false";
	
	if (isset($_GET["search_model"])) $search["model"] = $_GET["search_model"];
	else $search["model"] = "false";
	
	if (isset($_GET["search_location"])) $search["location"] = $_GET["search_location"];
	else $search["location"] = "false";
	
	if (isset($_GET["search_owner"])) $search["owner"] = $_GET["search_owner"];
	else $search["owner"] = "false";
	
	if (isset($_GET["search_serial"])) $search["serial"] = $_GET["search_serial"];
	else $search["serial"] = "false";
	
	$_SESSION["search"] = $search;
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
$cust["is_admin"] = false;

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
if (isset($_GET["device_owner"])) $device_owner = $_GET["device_owner"];
else $device_owner = "";
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

if (isset($_GET["lease_device_id"])) $lease_device_id = $_GET["lease_device_id"];
else $lease_device_id = "";
if (isset($_GET["lease_customer_id"])) $lease_customer_id = $_GET["lease_customer_id"];
else $lease_customer_id = "";
if (isset($_GET["lease_end_date"])) $lease_end_date = $_GET["lease_end_date"];
else $lease_end_date = "";
if (isset($_GET["lease_start_date"])) $lease_start_date = $_GET["lease_start_date"];
else $lease_start_date = "";

if(session_status() == PHP_SESSION_ACTIVE)
{
dbgetcustomer($cust["username"]);

if (strlen($cust["username"]) > 3 || $login_request == true && strlen($username) > 3) // NAVBAR
{
	echo '<nav class="navbar navbar-default" style="background-color: rgb(249, 150, 29);">
		<div class="container-fluid">
			<div class="navbar-header">
				<h1 style="font-size: 40px ; font-family: \'Bungee\', cursive; color: white;">Meisseli Oy Ab</h1>
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
						<input type = "hidden" name = "my_reservations" value = "true">
						<input class="btn btn-nav" type="submit" value="Minun varaukset">
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

if ($moddevice_request == "true")
{
	if ($save_moddevice == "true")
	{
		if (dbmodifydevice($_GET["device_id"], $_GET["device_category"], $_GET["device_name"], $_GET["device_manufactor"], $_GET["device_model"], $_GET["device_description"], $_GET["device_serialnumber"]))
		{
			echo "<p>Laitteen tiedot päivitetty!</p>";
		}
		
		else echo "<p>Laitteen tietojen päivitys epäonnistui nuuh!</p>";
	}
	
	if(isset($_GET["device_id"]))
	{
		$modify_device_info = dbgetdevice($_GET["device_id"]);
	
		echo "			
		<form name=\"newdevice\" method=\"get\" action=\"index.php\" style=\"margin-bottom: 300px;\">
			<table border=\"0\" width=\"500\" align=\"center\" class=\"demo-table\">
				<tr>
					<td colspan=\"2\">
						<h3>Muokkaat laitetta " . $modify_device_info["name"] . "</h3>
					</td>
				</tr>
				<tr>
					<td>Kategoria</td>
					<td>" . dbgetcategories() . "</td>
				</tr>
				<tr>
					<td>Nimi</td>
					<td><input type=\"text\" class=\"demoInputBox\" name=\"device_name\" value=\"" . $modify_device_info["name"] . "\"></td>
				</tr>
				<tr>
					<td>Valmistaja</td>
					<td><input type=\"text\" class=\"demoInputBox\" name=\"device_manufactor\" value=\"" . $modify_device_info["manufactor"] . "\"></td>
				</tr>
				<tr>
					<td>Malli</td>
					<td><input type=\"text\" class=\"demoInputBox\" name=\"device_model\" value=\"" . $modify_device_info["model"] . "\"></td>
				</tr>
				<tr>
					<td>Kuvaus</td>
					<td><input type=\"text\" class=\"demoInputBox\" name=\"device_description\" value=\"" . $modify_device_info["description"] . "\"></td>
				</tr>
				<tr>
					<td>Sarjanumero</td>
					<td><input type=\"text\" class=\"demoInputBox\" name=\"device_serialnumber\" value=\"" . $modify_device_info["serialnumber"] . "\"></td>
				</tr>
				<tr>
					<td colspan=\"2\">
						<input type = \"hidden\" name = \"device_id\" value = \"" . $modify_device_info["device_id"] . "\">
						<input type = \"hidden\" name = \"moddevice\" value = \"true\">
						<input type = \"hidden\" name = \"modifydevice\" value = \"true\">
						<input class=\"btn btn-primary pull-left\" type=\"submit\" name=\"save-device\" value=\"Tallenna\" class=\"btnRegister\">
					</td>
				</tr>
			</table>
		</form>";
	}
	else
	{
		echo "<p>Laitteen tietojen haku epäonnistui!</p>";
	}
}

if ($devices_request == "true")
{
	if ($newdevice_request == "true")
	{
		if (dbnewdevice($device_owner, $device_category, $device_name, $device_manufactor, $device_model, $device_description, $device_serialnumber ))
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
			echo "Laitteen poistaminen epäonnistui.";
		}
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
			';
			if($cust["is_admin"] == "true")
			{
				echo '<a class="btn btn-primary" data-toggle="modal" data-target="#newdevice">Lisää laite</a>';
			}
			echo '
		</div>
	</div>';
}

if ($my_reservations == "true")
{
	dbmy_reservations($cust["id"]);
	// sivu varatuille laitteille
	echo'
	<div class="container">
		<div class="row">
			<h1>Minun varaukset</h1>
			<div class="list-group">';
				echo(buttonsforleases($_SESSION["leases"]));
				
				
				echo '
			</div>
		</div>
	</div>';
}

if ($devices_lease_request == "true")
{
	dbgetdevices($cust["id"]);
	
	if ($lease_request == "true")
	{
		if (dbcreatereservation($cust["id"], $lease_device_id, $lease_start_date, $lease_end_date))
		{
			echo "<p>Laite varattu!</p>";
		}
		else
		{
			echo "Laitteen varaaminen epäonnistui.";
		}
	}
	
	echo'			
	<div class="container">
		<div class="row">
			<h1>Varattavissa olevat laitteet</h1>
			<br /><br />
			
			<div class="col-sm-6">
				' . generatesearch() . '
			</div>
			<div class="col-sm-6">
				<div class="list-group">';
					if ($devices_search_request == "true")
					{
						echo(buttonsfordevices($_SESSION["devices"], true, $search));
					}
					else
					{
						echo(buttonsfordevices($_SESSION["devices"], true));
					}
					
					echo '
				</div>
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
	$regsuccess = false;
	if ($registerapply_request == "true" && isset($username) && isset($firstname) && isset($lastname) && isset($address) && isset($postal) && isset($city) && isset($email) && isset($phone) && isset($password) && isset($confirm_password))
	{
		if (dbregister($username, $firstname, $lastname, $address, $postal, $city, $password, $confirm_password, $phone, $email))
		{
			dbgetcustomer($username);
			echo '<div class="container">
				<div class="row">
					<h1>Rekisteröinti onnistui ' . $cust["username"] . '!</h1>
					<form>
						<input type = "hidden" name = "devices" value = "true">
						<input class="btn btn-nav" type="submit" value="Hyvä homma">
					</form>
				</div>
			</div>';
			$regsuccess = true;
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
	
	if ($regsuccess == false)
	{
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

}
else $login_request = "true";
	
if ($login_request == "true")
{
	if (!isset($username) || $username == "")
	{
		echo '
		<h1 style="font-size: 50px ; font-family: \'Bungee\', cursive; text-align: center;">Meisseli Oy Ab</h1>
		<table border="0" width="500" align="center" class="demo-table" style="margin-top: 10%;">
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
							<p>Eikö sinulla ole käyttäjää? Klikkaa alta rekisteröityäksesi. </p>
							<input class="btn btn-primary" type="submit" value="Paina tästä rekisteröityäksesi.">
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
			<p>Username and password do not match! Try again </p>
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
		
			if ($result = false)
			{
				echo "<p>Select ee toemi :(</p>";
				return false;
			}

			if (is_array($result)) $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			
			if (isset($result))
			{
				if(is_array($result))
				{
					if($result->num_rows != 0) //Username already exists
					{
						echo "<p>Käyttäjä onp jo olemasa!</p>";
						return false;
					}
				}
			}
			
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
				echo "<p>Käyttäjän lisääminen tietokantaan ei onnistunut, yyy</p>";
				mysqli_close($conn);
				return false;
			}
		}
		else
		{
			echo "<p>Tapahtui odottamaton virhe, virhekoodi: \"pizzaperjantai\" alennusta 10% kaikista pizzoista perjantaina #PizzaOnline</p>";
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

function dbmodifydevice($deviceid, $category_id, $name, $manufactor, $model, $desc, $serial)
{
	$conn = dbconnect();
	$result = false;
		
	if ($conn)
	{
		$sql = "UPDATE devices SET category_id='$category_id', name='$name', manufactor='$manufactor', model='$model', description='$desc', serialnumber='$serial' WHERE `device_id` = '$deviceid'";
		
		$result = $conn->query($sql);
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
		
		if ($row['is_admin'] == 1) $cust["is_admin"] = true;
		else $cust["is_admin"] = false;
		
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
		$sql = "SELECT
		devices.device_id,
		devices.customer_id,
		devices.category_id,
		devices.name,
		devices.manufactor,
		devices.model,
		devices.description,
		devices.serialnumber,
		devices.hide,
		customer.firstname as cust_firstname,
		customer.lastname as cust_lastname,
		customer.address as cust_address,
		customer.postal as cust_postal,
		customer.city as cust_city
		FROM devices
		INNER JOIN customer ON devices.customer_id = customer.customer_id
		WHERE devices.customer_id = '$userid'";
				
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

function dbmy_reservations($userid)
{
	$conn = dbconnect();
		
	if ($conn)
	{
		
		$sql = "SELECT * FROM lease WHERE customer_id = '$userid'";
		
		$result = $conn->query($sql);
		
		$rows = array();
		while ($row = $result->fetch_assoc())
		{
			$rows[] = $row;
		}
		
		$_SESSION["leases"] = $rows;
	}
	mysqli_close($conn);
	return false;

}

function dbgetdevice($deviceid) // Palauttaa määrätyn laitteen tiedot ID:een perusteella
{
	$conn = dbconnect();
	
	$result = false;
	
	if ($conn)
	{
		$sql = "SELECT * FROM devices WHERE device_id = '$deviceid'";
		
        $result = $conn->query($sql);
		
		$result = $result->fetch_array(MYSQLI_ASSOC);
	}
	
	mysqli_close($conn);
	return $result;
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

function buttonsfordevices($devices, $showall = false, $search = array())
{
	$html = "";
	$i = 0;
	
	if($showall == true)
	{
		if(!empty($search))
		{
			$conn = dbconnect();
			
			$sql = "SELECT
			devices.device_id,
			devices.customer_id,
			devices.category_id,
			devices.name,
			devices.manufactor,
			devices.model,
			devices.description,
			devices.serialnumber,
			devices.hide,
			customer.firstname as cust_firstname,
			customer.lastname as cust_lastname,
			customer.address as cust_address,
			customer.postal as cust_postal,
			customer.city as cust_city
			FROM devices INNER JOIN customer ON devices.customer_id = customer.customer_id INNER JOIN category ON devices.category_id = category.category_id";
			
			$sql = $sql . " WHERE ";
			if (!empty($search["category"])) $sql = $sql . "category.name LIKE '%" . $search["category"] . "%' AND ";
			if (!empty($search["name"])) $sql = $sql . "devices.name LIKE '%" . $search["name"] . "%' AND ";
			if (!empty($search["manufactor"])) $sql = $sql . "devices.manufactor LIKE '%" . $search["manufactor"] . "%' AND ";
			if (!empty($search["model"])) $sql = $sql . "devices.model LIKE '%" . $search["model"] . "%' AND ";
			if (!empty($search["location"])) $sql = $sql . "customer.address LIKE '%" . $search["location"] . "%' OR ";
			if (!empty($search["location"])) $sql = $sql . "customer.postal LIKE '%" . $search["location"] . "%' OR ";
			if (!empty($search["location"])) $sql = $sql . "customer.city LIKE '%" . $search["location"] . "%' AND ";
			if (!empty($search["owner"])) $sql = $sql . "customer.firstname LIKE '%" . $search["owner"] . "%' AND ";
			if (!empty($search["owner"])) $sql = $sql . "customer.lastname LIKE '%" . $search["owner"] . "%' AND ";
			if (!empty($search["serial"])) $sql = $sql . "devices.serialnumber LIKE '%" . $search["serial"] . "%'";
			
			if (endsWith($sql, " AND ")) $sql = substr($sql, 0, -5);
			
			$result = $conn->query($sql);
			
			if ($result == false)
			{
				$html = "<h3>Kohteita ei löytynyt!</h3>";
			}
			
			else
			{
				$rows = array();
				while ($row = $result->fetch_assoc())
				{
					$rows[] = $row;
				}
				
				$_SESSION["devices"] = $rows;
				
				foreach($rows as $d)
				{
					$i++;
					if($d["hide"] == 0)
					{
						$html = $html . "
						<a class=\"btn list-group-item\" data-toggle=\"modal\" data-target=\"#device" . $d["device_id"] . "\">
							<h3>" . $d["name"] . "</h3>
							<p>" . $d["description"] . "</p>
						</a>";
					}
				}
			}
		}
		
		else
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
					<a class=\"btn list-group-item\" data-toggle=\"modal\" data-target=\"#device" . $d["device_id"] . "\">
						<h3>" . $d["name"] . "</h3>
						<p>" . $d["description"] . "</p>
					</a>";
				}
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
				<a class=\"btn list-group-item\" data-toggle=\"modal\" data-target=\"#device" . $d["device_id"] . "\">
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

function endsWith($haystack, $needle)
{
    return substr($haystack, -strlen($needle))===$needle;
}

function modalsfordevices($devices, $showall = false)
{
	$html = "";
	$i = 0;
	
	if($showall == true)
	{
		$conn = dbconnect();
		
		$sql = "SELECT
		devices.device_id,
		devices.customer_id,
		devices.category_id,
		devices.name,
		devices.manufactor,
		devices.model,
		devices.description,
		devices.serialnumber,
		devices.hide,
		customer.firstname as cust_firstname,
		customer.lastname as cust_lastname,
		customer.address as cust_address,
		customer.postal as cust_postal,
		customer.city as cust_city
		FROM devices
		INNER JOIN customer ON devices.customer_id = customer.customer_id";		
		
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
				<div id=\"device" . $d["device_id"] . "\" class=\"modal fade\" role=\"dialog\">
					<div class=\"modal-dialog\">
						<div class=\"modal-content\">
							<div class=\"modal-header\" style=\"background-color: rgb(249, 150, 29)\">
								<h3 class=\"modal-title\" style=\"color:white;\">" . $d["name"] . "</h3>
							</div>
							<div class=\"modal-body text-center\">
								<p>Omistaja: " . $d["customer_id"] . "</p>
								<p>Kategoria: " . $d["category_id"] . "</p>
								<p>Kuvaus: " . $d["description"] . "</p>
								<p>Valmistaja: " . $d["manufactor"] . "</p>
								<p>Malli: " . $d["model"] . "</p>
								<p>Sarjanumero: " . $d["serialnumber"] . "</p>
								<p>Sijainti: " . $d["cust_address"] . ", " . $d["cust_postal"] . " " . $d["cust_city"] . "</p>
								<p>Omistaja: " . $d["cust_firstname"] . " " . $d["cust_lastname"] . "</p>
							</div>
							<div class=\"modal-footer\">
								<form method=\"GET\" action=\"index.php\">
									<input type=\"hidden\" name=\"lease_device_id\" value=\"" . $d["device_id"] . "\">
									<input type=\"hidden\" name=\"lease\" value=\"true\">
									<input type=\"hidden\" name=\"deviceslease\" value=\"true\">
									<p>Valitse varauksen alkamispäivämäärä: <input type=\"datetime-local\" name=\"lease_start_date\" value=\"\"></p>
									<p>Valitse varauksen päättymispäivämäärä: <input type=\"datetime-local\" name=\"lease_end_date\" value=\"\"></p>
									<input class=\"btn btn-primary pull-left\" type=\"submit\" value=\"Varaa laite.\">
								</form>";								
								if ($_SESSION["cust"]["is_admin"] == true) $html = $html . "
								<form action=\"index.php\">
									<input type=\"hidden\" name=\"devices\" value=\"true\">
									<input type=\"hidden\" name=\"deldevice\" value=\"true\">
									<input type=\"hidden\" name=\"device_id\" value=\"" . $d["device_id"] . "\">
									<input class=\"btn btn-danger pull-left\" type=\"submit\" value=\"Poista laite\">
								</form>
								<form action=\"index.php\">
									<input type=\"hidden\" name=\"moddevice\" value=\"true\">
									<input type=\"hidden\" name=\"device_id\" value=\"" . $d["device_id"] . "\">
									<input class=\"btn btn-warning pull-left\" type=\"submit\" value=\"Muokkaa laitteen tietoja\">
								</form>";
								
								$html = $html . "<button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\">Sulje</button>
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
				<div id=\"device" . $d["device_id"] . "\" class=\"modal fade\" role=\"dialog\">
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
								<p>Sijainti: " . $d["cust_address"] . ", " . $d["cust_postal"] . " " . $d["cust_city"] . "</p>
							</div>
							<div class=\"modal-footer\">";
							
								if ($_SESSION["cust"]["is_admin"] == true) $html = $html . "
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
								</form>";
								
								$html = $html . "<button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\">Sulje</button>
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

function optionsforcategories()
{
	$html = "<option value=\"0\">Valitse kategoria</option>";
	
	$conn = dbconnect();
		
	$sql = "SELECT * FROM category";
	
	$result = $conn->query($sql);
		
	$rows = array();
	while ($row = $result->fetch_assoc())
	{
		$rows[] = $row;
	}
	
	foreach($rows as $c)
	{
		$html = $html . "<option value=\"" . $c["name"] . "\">" . $c["name"] . "</option>";
	}
	mysqli_close($conn);
	
	return $html; // palauttaa luodut optionit stringinä
}

function optionsforowners()
{
	$html = "<option value=\"0\">Valitse omistaja</option>";
	
	$conn = dbconnect();
		
	$sql = "SELECT * FROM customer";
	
	$result = $conn->query($sql);
		
	$rows = array();
	while ($row = $result->fetch_assoc())
	{
		$rows[] = $row;
	}
	
	foreach($rows as $c)
	{
		$html = $html . "<option value=\"" . $c["customer_id"] . "\">" . $c["firstname"] . " " . $c["lastname"] . "</option>";
	}
	mysqli_close($conn);
	
	return $html; // palauttaa luodut optionit stringinä
}

function generatesearch()
{
	$html = '
	<div class="container">
		<form method="GET" action="index.php">

		<h2>Selaa</h2>
		<div class="form-group">
			<select name="search_category" class="dropdown">
				' . optionsforcategories() . '
			</select>
		</div>
		<div class="form-group">
			<input type="text" name="search_name" placeholder="Nimi" value="" . $search["name"]  . "">
		</div>
		<div class="form-group">
			<input type="text" name="search_manufactor" placeholder="Merkki" value="" . $search["manufactor"]  . "">
		</div>
		<div class="form-group">
			<input type="text" name="search_model" placeholder="Malli" value="" . $search["model"]  . "">
		</div>
		<div class="form-group">
			<input type="text" name="search_location" placeholder="Sijainti" value="" . $search["location"]  . "">
		</div>
		<div class="form-group">
			<input type="text" name="search_owner" placeholder="Omistaja" value="" . $search["owner"]  . "">
		</div>
		<div class="form-group">
			<input type="text" name="search_serial" placeholder="Sarjanumero" value="" . $search["serial"]  . "">
		</div>

		<input type="hidden" name="deviceslease" value="true">
		<input type="hidden" name="devices_lease_search" value="true">
		<input type="submit" value="Hae">
		
		</form>
	</div>';
	return $html;
}

function dbcreatereservation($custid, $device_id, $start_datetime, $end_datetime)
{
	$conn = dbconnect();
	$sql = "SELECT * FROM lease WHERE device_id = '$device_id'";
	
	$result = $conn->query($sql);
	
	while ($row = $result->fetch_assoc())
	{
		$rows[] = $row;
	}
	
	$leases = $rows;
	
	if (is_array($leases))
	{
		foreach($leases as $l)
		{
			if (strtotime($l["end"]) > time())
			{
				echo "<p>Laite on varattu eikä varauksen aika ole vielä loppunut.</p>";
				echo "<p>Laite vapautuu: " . $l["end"] . ".</p>";
				return false;
			}
		}
	}
	
	$conn = dbconnect();
		
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	
	$result = false;
		
	if ($conn)
	{
		$start_time =  date("Y-m-d H:i:s", strtotime($start_datetime));
		$end_time = date("Y-m-d H:i:s", strtotime($end_datetime));
		
		$sql = "INSERT INTO lease (customer_id, device_id, start, end)
		VALUES ('$custid', '$device_id', '$start_time', '$end_time')";
		
		$result = mysqli_query($conn, $sql);
	}
	mysqli_close($conn);
	return $result;
}

function buttonsforleases()
{
	$conn = dbconnect();
			
	$sql = "SELECT
	devices.device_id,
	devices.customer_id,
	devices.category_id,
	devices.name,
	devices.manufactor,
	devices.model,
	devices.description,
	devices.serialnumber,
	devices.hide,
	customer.firstname as cust_firstname,
	customer.lastname as cust_lastname,
	customer.address as cust_address,
	customer.postal as cust_postal,
	customer.city as cust_city,
	lease.start as lease_start,
	lease.end as lease_end
	FROM devices INNER JOIN customer ON devices.customer_id = customer.customer_id INNER JOIN category ON devices.category_id = category.category_id INNER JOIN lease ON devices.device_id = lease.device_id";
	
	$result = $conn->query($sql);
	
	if ($result == false)
	{
		$html = "<h3>Varauksia ei löytynyt!</h3>";
	}
	
	else
	{
		$rows = array();
		while ($row = $result->fetch_assoc())
		{
			$rows[] = $row;
		}
		
		foreach($rows as $d)
		{
			
			if($d["hide"] == 0)
			{
				$html = "
				<a class=\"btn list-group-item\" data-toggle=\"modal\" data-target=\"#device" . $d["device_id"] . "\">
					<h3>" . $d["name"] . "</h3>
					<p>" . $d["description"] . "</p>
					<p>" . $d["lease_start"] . "</p>
					<p>" . $d["lease_end"] . "</p>
				</a>";
			}
		}
	}
}

function modalsforleases()
{
	$conn = dbconnect();
			
	$sql = "SELECT
	devices.device_id,
	devices.customer_id,
	devices.category_id,
	devices.name,
	devices.manufactor,
	devices.model,
	devices.description,
	devices.serialnumber,
	devices.hide,
	customer.firstname as cust_firstname,
	customer.lastname as cust_lastname,
	customer.address as cust_address,
	customer.postal as cust_postal,
	customer.city as cust_city,
	lease.start as lease_start,
	lease.end as lease_end
	FROM devices INNER JOIN customer ON devices.customer_id = customer.customer_id INNER JOIN category ON devices.category_id = category.category_id INNER JOIN lease ON devices.device_id = lease.device_id";
	
	$result = $conn->query($sql);
	
	if ($result == false)
	{
		$html = "<h3>Varauksia ei löytynyt!</h3>";
	}
	
	else
	{
		$rows = array();
		while ($row = $result->fetch_assoc())
		{
			$rows[] = $row;
		}
		
		foreach($rows as $d)
		{
			$html = $html . "
			<div id=\"device" . $d["device_id"] . "\" class=\"modal fade\" role=\"dialog\">
				<div class=\"modal-dialog\">
					<div class=\"modal-content\">
						<div class=\"modal-header\" style=\"background-color: rgb(249, 150, 29)\">
							<h3 class=\"modal-title\" style=\"color:white;\">" . $d["name"] . "</h3>
						</div>
						<div class=\"modal-body text-center\">
							<h3>Varauksen tiedot</h3>
							<p>Alkaa: " . $d["lease_start"] . "</p>
							<p>Loppuu: " . $d["lease_end"] . "</p>
							<h3>Laitteen tiedot</h3>
							<p>Omistaja: " . $d["customer_id"] . "</p>
							<p>Kategoria: " . $d["category_id"] . "</p>
							<p>Kuvaus: " . $d["description"] . "</p>
							<p>Valmistaja: " . $d["manufactor"] . "</p>
							<p>Malli: " . $d["model"] . "</p>
							<p>Sarjanumero: " . $d["serialnumber"] . "</p>
							<p>Sijainti: " . $d["cust_address"] . ", " . $d["cust_postal"] . " " . $d["cust_city"] . "</p>
							<p>Omistaja: " . $d["cust_firstname"] . " " . $d["cust_lastname"] . "</p>
						</div>
						<div class=\"modal-footer\">
							<form method=\"GET\" action=\"index.php\">
								<input type=\"hidden\" name=\"lease_device_id\" value=\"" . $d["device_id"] . "\">
								<input type=\"hidden\" name=\"lease\" value=\"true\">
								<input type=\"hidden\" name=\"deviceslease\" value=\"true\">
								<p>Valitse varauksen alkamispäivämäärä: <input type=\"datetime-local\" name=\"lease_start_date\" value=\"\"></p>
								<p>Valitse varauksen päättymispäivämäärä: <input type=\"datetime-local\" name=\"lease_end_date\" value=\"\"></p>
								<input class=\"btn btn-primary pull-left\" type=\"submit\" value=\"Varaa laite.\">
							</form>";	

							// VAIHDA del device jne -> del reservation (sama mod device -> mod reservation jne)
							if ($_SESSION["cust"]["is_admin"] == true) $html = $html . "
							<form action=\"index.php\">
								<input type=\"hidden\" name=\"devices\" value=\"true\">
								<input type=\"hidden\" name=\"del_reservation\" value=\"true\">
								<input type=\"hidden\" name=\"device_id\" value=\"" . $d["device_id"] . "\">
								<input class=\"btn btn-danger pull-left\" type=\"submit\" value=\"Poista varaus\">
							</form>
							<form action=\"index.php\">
								<input type=\"hidden\" name=\"mod_reservation\" value=\"true\">
								<input type=\"hidden\" name=\"device_id\" value=\"" . $d["device_id"] . "\">
								<input class=\"btn btn-warning pull-left\" type=\"submit\" value=\"Muokkaa varausta\">
							</form>";
							
							$html = $html . "<button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\">Sulje</button>
						</div>
					</div>
				</div>
			</div>";
		}
	}
}

echo '
<footer style="background-color: rgb(249, 150, 29); position: relative; bottom: 0; left: 0; overflow: hidden; width: 100%; height: 120px; colour: white;">

    <!-- Footer Links -->
    <div class="container-fluid text-center text-md-left">

      <!-- Grid row -->
      <div class="row">

        <h1 style="font-size: 36px ; font-family: \'Bungee\', cursive; text-align: center; color: white;">Meisseli Oy Ab</h1>
        <a href="toimintolista.html" style="color: white;">Toimintolista</a>

      </div>
      <!-- Grid row -->

    </div>
    <!-- Footer Links -->

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
							<td><select name="device_category" class="dropdown">' . optionsforcategories() . '</select></td>
						</tr>
						<tr>
							<td>Omistaja</td>
							<td><select name="device_owner" class="dropdown">' . optionsforowners() . '</select></td>
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
							<td>Kuvaus</td>
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
</div><!-- end modal -->';


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