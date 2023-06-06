<?
function dbconnect($host, $id, $pass, $db)
{
    $conn = mysqli_connect($host, $id, $pass, $db);
	
    if ($conn == false) {
        die('Not connected : ' . mysqli_error());
    }

    return $conn;
}

function removeQuotes($str) 
{
    return str_replace("'", '', $str);
}

function msg($msg)
{
    $msg = removeQuotes($msg);
    echo "
        <script>
             window.alert('$msg');
             history.go(-1);
        </script>";
    exit;
}

function s_msg($msg)
{
    echo "
        <script>
            window.alert('$msg');
        </script>";
}

function check_id($conn, $id)
{
	$query = "select customer_id from customer where customer_id='$id'";
	$result = mysqli_query($conn, $query);
	
	$result = mysqli_fetch_array($result);
	if ($result){
		return true;
	}
	else{
		return false;
	}
}

function addDaysToDate($date, $days) 
{
    $dateObject = DateTime::createFromFormat('Y-m-d', $date);
    $dateObject->modify("+$days days");
    return $dateObject->format('Y-m-d');
}
?>
