<?php
/**
 * The Errors class can be used to help display error messages to a users.
 * 
 * @Version 2.0
 * @Year 2015
 * @Author Mehmet Uyanik
 */

namespace Memuya\ErrorHandler;

class Errors {
	private static $errors = [];

	/**
	* Check if an error exist inside the errors array
	*/
	public static function hasErrors() {
		if(count(self::$errors) > 0)
			return true;
		else
			return false;
	}
	
	/**
	* Returns all values inside the errors array
	* 
	* @param int $style
	*/
	public static function getErrors($style = 1) {
		$m = null;
		if(self::hasErrors()) {
			switch($style) {
				case 0:
					$css = '';
					break;
				case 1:
					$css = 'red-notice';
					break;
				case 2:
					$css = 'yellow-notice';
					break;
				default:
					$css = 'red-notice';
					break;
			}

			($style !== 0) ? $m .='<div class="notice-box '.$css.'">' : null;
			
			foreach(self::$errors as $e)
				$m .= (!empty($e)) ? $e."<br>" : null;
			
			($style !== 0) ? $m .= '</div>' : null;
			
			return $m;
			
		}
	}
	
	/**
	* Displays the list of errors in the errors array or a success message
	* Set $style to 0 to only return a string of errors with no styling
	* Set $style to 1 to display the notice box red (default)
	* Set $style to 2 to display the notice box yellow
	* Set $message to 0 (int) if you do not want to display a success message
	* 
	* @param string $message
	* @param int $style
	*/
	public static function display($message, $style = 1) {
		if(self::hasErrors())
			return self::getErrors($style);
		else
			return ($message === 0) ? null : (($style !== 0) ? '<div class="notice-box green-notice">'.$message.'</div>' : $message);
	}

	/**
	* Returns the amount of errors stored in the $errors array
	* 
	*/
	public function getCount() {
		return count(self::$errors);
	}

	/**
	* Add a string to the $errors array
	* 
	* @param string $message
	*/
	public static function add($message) {
		(!empty($message)) ? self::$errors[] = trim($message) : null;
	}

	/**
	* Clear the errors array
	*/
	public static function clear() {
		self::$errors = [];
	}
	
}