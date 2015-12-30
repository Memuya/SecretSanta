<?php
/**
 * Matches people together for secret santa
 * Also allows for restrictions to be placed
 *
 * @Version 1.0
 * @Year 2015
 * @Author Mehmet Uyanik
 */

require_once 'Errors.php';

use Memuya\ErrorHandler\Errors;

class SecretSanta {
	/**
	 * @var array
	 */
	private $givers;
	/**
	 * @var array
	 */
	private $takers;
	/**
	 * @var array
	 *
	 * Sorted in nested arrays and checked in the match() method (E.G - [['Person1' => 'Person2'], ['Person1' => 'Person2']])
	 */
	private $restrictions;
	/**
	 * @var array (associative)
	 */
	private $results;

	/**
	 * Sets all the varibles for the class.
	 * Checks to see if the givers, takers and restrictions variables are arrays.
	 *
	 * @param array $givers
	 * @param array $takers
	 * @param array $restrictions
	 */
	public function __construct($people, $restrictions) {
		$this->givers = $this->convertToArray($people);
		$this->takers = $this->givers;

		//Set restrictions if present
		if(!empty($restrictions)) {
			foreach ($restrictions as $restriction) {
				if(!empty($restriction)) {
					$restriction = $this->convertToArray($restriction);
					//$restriction = explode(', ', $restriction);

					//Make sure 2 names are entered into the restrictions field to operate
					if(!empty($restriction[1]))
						$this->restrictions[] = [strtolower($restriction[0]) => strtolower($restriction[1])];
					else
						$this->restrictions = null;
				}
			}
		}

		if(!$this->checkIfArray([$this->givers, $this->takers]))
			throw new Exception("Signature only takes array values.");
	}

	/**
	 * Runs the logic to pair givers with takers
	 */
	public function match() {
		//Loop variable
		$x = true;

		//There must be more than 1 person involved to continue
		if(count($this->givers) <= 1) {
			Errors::add('More than 1 person must be involved.');
		} else {

			while($x) {
				//Randomize array elements
				shuffle($this->givers);
				shuffle($this->takers);

				//Combine both the givers a takers arrays to make a associative array
				$this->results = array_combine($this->givers, $this->takers);

				foreach($this->results as $key => $match) {
					//Make sure givers can not get themselves
					if($key === $match)
						break;

					//Make sure no people that are in the restrictions array can be matched together
					if(!empty($this->restrictions)) {
						foreach($this->restrictions as $restriction)
							foreach($restriction as $rKey => $r)
								if($rKey == $key && $r == $match)
									break 3;
					}
					
					//End while loop at the end of the matches array
					if($match == end($this->results))
						$x = false;
				}
			}

			return $this->results;
		}
	}

	/**
	 * Checks to see if the given variables are an array
	 *
	 * @param array $arrays
	 */
	private function checkIfArray($arrays) {
		foreach($arrays as $array)
			if(!is_array($array))
				return false;

		return true;
	}

	/**
	 * Converts a string of text into an array
	 *
	 * @param string $str
	 */
	public function convertToArray($str) {
		if(!is_array($str)) {
			//Values to be search
			$values = [',', ', ', ' ,', ' '];
			//Get rid of all white space in between
			$str = str_replace(' ', '', $str);
			//Replace above values with white space
			$str = str_replace($values, ' ', $str);
			//Turn string into an array
			$str = explode(' ', strtolower($str));
			//Makes sure all values inside the array are unquie
			$str = array_unique($str);

			return $str;
		}
	}

	/**
	 * Returns the results generated from the match() method
	 */
	public function results() {
		return $this->results;
	}
}
