<?php
/**
 * This file handles bronze, silver and gold customers.
 *
 * @package		SoftwareEngineerTest
 * @subpackage	Question2
 * @license		http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author		Toby Nieboer <toby@nieboer.com.au>
 */
namespace SoftwareEngineerTest;
use \InvalidArgumentException;

// Question 2 & 3 & 4

/**
 * Class Customer
 * 
 * @package		SoftwareEngineerTest
 * @subpackage	Question2
 * @author		Toby Nieboer <toby@nieboer.com.au>
*/
abstract class Customer {
	/** @var string Customer ID */
	protected $id;
	/** @var int Customer balance */
	protected $balance = 0;

	/**
	 * Constructor
	 * 
	 * @param		int			$id
	 * @return		void		
	*/
	public function __construct($id) {
		$this->id = $id;
	}

	/**
	 * Returns current value of $balance
	 * 
	 * @return	int		
	*/
	public function get_balance() {
		return $this->balance;
	}

}

// Write your code below

/**
 * Class Bronze
 * 
 * @package		SoftwareEngineerTest
 * @subpackage	Question2
 * @author		Toby Nieboer <toby@nieboer.com.au>
*/
class Bronze extends Customer {
	/**
	 * Increments $balance by $amount
	 * 
	 * @param		int			$amount
	 * @return		void		
	*/
	public function deposit($amount){
		$new_balance = parent::get_balance() + $amount;
		$this->balance = $new_balance;
	}
	/**
	 * Generates a username consisting of B and 29 semi-random alphanumeric characters
	 * 
	 * @return		string		
	*/
	public function generate_username(){
		$username = 'B'.substr(md5(microtime()),-29);
		return $username;
		
	}
}
/**
 * Class Silver
 * 
 * @package		SoftwareEngineerTest
 * @subpackage	Question2
 * @author		Toby Nieboer <toby@nieboer.com.au>
*/
class Silver extends Customer {
	/**
	 * Increments $balance by $amount * 1.05
	 * 
	 * @param		int			$amount
	 * @return		void		
	*/
	public function deposit($amount){
		$new_balance = parent::get_balance() + ($amount * 1.05);
		$this->balance = $new_balance;
	}
	/**
	 * Generates a username consisting of S and 29 semi-random alphanumeric characters
	 * 
	 * @return		string		
	*/
	public function generate_username(){
		$username = 'S'.substr(md5(microtime()),-29);
		return $username;
		
	}
}
/**
 * Class Gold
 * 
 * @package		SoftwareEngineerTest
 * @subpackage	Question2
 * @author		Toby Nieboer <toby@nieboer.com.au>
*/

class Gold extends Customer {
	/**
	 * Increments $balance by $amount * 1.1
	 * 
	 * @param		int			$amount
	 * @return		void		
	*/
	public function deposit($amount){
		$new_balance = parent::get_balance() + ($amount * 1.1);
		$this->balance = $new_balance;
	}
	
	/**
	 * Generates a username consisting of G and 29 semi-random alphanumeric characters
	 * 
	 * @return		string		
	*/
	public function generate_username(){
		$username = 'G'.substr(md5(microtime()),-29);
		return $username;
		
	}
}

/**
 * Class CustFactory
 * 
 * @package		SoftwareEngineerTest
 * @subpackage	Question3
 * @author		Toby Nieboer <toby@nieboer.com.au>
*/

class CustFactory {

	/** @var string Customer type */
	protected $type;

	/**
	 * Gets customer type based on ID
	 * 
	 * @param		int			$custid
	 * @return		Gold|Silver|Bronze		
	*/
	public function get_instance($custid){
		if(strtolower(substr($custid,0,1)) == 'b'){
			return $this->type = new Bronze($custid);
		} elseif(strtolower(substr($custid,0,1)) == 's'){
			return $this->type = new Silver($custid);
		} elseif(strtolower(substr($custid,0,1)) == 'g'){
			return $this->type = new Gold($custid);
		}
	throw new InvalidArgumentException($custid.' is not a valid customer ID');
	}
}
