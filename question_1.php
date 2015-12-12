<?php
/**
 * This file generates a list of customers and their occupations.
 *
 * @package		SoftwareEngineerTest
 * @subpackage	Question1
 * @license		http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author		Toby Nieboer <toby@nieboer.com.au>
 */
 
namespace SoftwareEngineerTest;
use \PDO;
use \PDOException;

// Question 1a

$DB_HOST = 'localhost';
$DB_NAME = 'test';
$DB_USER = 'test';
$DB_PASS = 'test';

// write your sql to get customer_data here

try {
    $connect = new PDO('mysql:host='.$DB_HOST.';dbname='.$DB_NAME, $DB_USER, $DB_PASS);
} catch (PDOException $e) {
    print "Connection error: " . $e->getMessage() . "<br/>";
    die();
}

$sql = "SELECT customer_id, 
		first_name, 
		last_name, 
		CASE  
			WHEN occupation_name IS NULL THEN 'un-employed' 
			ELSE occupation_name 
			END 
		AS occupation_name
		FROM customer LEFT JOIN customer_occupation ON customer.customer_occupation_id = customer_occupation.customer_occupation_id";
if($_GET['occupation_name']){
	$sql .= " WHERE occupation_name = :occupation_name";
	$query = $connect->prepare($sql);
	$query->bindParam(':occupation_name', $_GET['occupation_name'], PDO::PARAM_STR);
	$query->execute();
} else {
	$query = $connect->prepare($sql);
	$query->execute();
}
?>

<h2>Customer List</h2>

<table>
	<tr>
		<th>Customer ID</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Occupation</th>
	</tr>

	<!-- Write your code here -->
	<?php
	while($row = $query->fetch(PDO::FETCH_ASSOC)){
	?>	
		<tr>
			<td><?php echo $row['customer_id'];?></td>	
			<td><?php echo $row['first_name'];?></td>	
			<td><?php echo $row['last_name'];?></td>	
			<td><?php echo $row['occupation_name'];?></td>
		</tr>
	<?php		
	}
	?>
</table>