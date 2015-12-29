<?php
require_once '../classes/SecretSanta.php';
require_once '../classes/Errors.php';

use Memuya\ErrorHandler\Errors;

//Get input fields from form
$people = $_POST['users'];
$restrictions = $_POST['restrictions'];

try {
	//Create the Secret Santa object and match all people
	$kk = new SecretSanta($people, $restrictions);
	$kk->match();

	//Output any errors in the Errors object
	if(Errors::hasErrors())	
		echo Errors::display(0);

} catch(Exception $e) {
	die($e->getMessage());
}
?>

<?php if(!empty($kk->results()) && !Errors::hasErrors()): ?>
	<table>
		<tr>
			<th>Giver</th>
			<th>Taker</th>
		</tr>
		<?php foreach($kk->results() as $giver => $taker): ?>
			
			<tr>
				<td><?=ucfirst($giver)?></td>
				<td><?=ucfirst($taker)?></td>
			</tr>

		<?php endforeach; ?>
	</table>
<?php endif; ?>