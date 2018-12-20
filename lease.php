<?php
function leasecx($custid, $device_id)
{
$conn = dbconnect();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
	$result = false;
		
	if ($conn)
	{
	$start_time =  date("Y-m-d H:i:s");
	$end_time = date("Y-m-d H:i:s", strtotime('+1 week', $start_time));
	}
	
	mysqli_close($conn);
	return $result;
	
	$sql = "INSERT INTO Lease (customer_id, device_id, start_time,end_time)
	VALUES ('$customer_id', '$device_id', '$start_time', '$end_time')";
	
	
	
$conn->close();
?>




<input type=\"hidden\" name=\"devices\" value=\"true\">
<input type=\"hidden\" name=\"lease_device\" value=\"true\">	

<?php
function modifylease($custid, $device_id)
{
	$conn = dbconnect();
	$result = false;
		
	if ($conn)
	{
		$sql = "UPDATE Lease SET ='$customer_id', laite='$device_id', aloitus='$start_time', lopetus='$end_time' WHERE `customer_id` = $userid";
		$result = $conn->query($sql);
	}
	
	mysqli_close($conn);
	return $result;
}

?>
<?php
function deletelease($id)
{
	$conn = dbconnect();
	$result = false;
		
	if ($conn)
	{
		$sql = "UPDATE lease SET hide=1 WHERE device_id=$id";
		
		$result = $conn->query($sql);
	}
	mysqli_close($conn);
	return $result;
}
?>
