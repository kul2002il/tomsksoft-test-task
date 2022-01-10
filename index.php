<?php
use models\Positions;
use models\SalaryMethodsStorage;
use models\Person;
use models\SalaryReport;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

spl_autoload_register(function ($class) {
    require_once './' . str_replace('\\', '/', $class) . '.php';
});

$mysqli = require_once 'config/connectDB.php';


if(isset($_POST['savePerson']))
{
    if(isset($_POST['editPerson']))
    {
        $editPerson = Person::findById((int)$_POST['editPerson']);
    }
    else
    {
        $editPerson = new Person();
    }
    $editPerson->name = $_POST['name'];
    $editPerson->phone = $_POST['phone'];
    $editPerson->telegram = $_POST['telegram'];
    $editPerson->id_position = $_POST['position'];
    $editPerson->id_salary_method = $_POST['salaryMethod'];
    $editPerson->id_manager = $_POST['manager'];
    $editPerson->save();
}

if(isset($_GET['edit_person']))
{
    $editPerson = Person::findById((int)$_GET['edit_person']);
}
else
{
    $editPerson = new Person();
}


$salaryReport = new SalaryReport();

// print_r($salaryReport->report());
function renderReport(array $data)
{
    echo '<ol>';
    foreach ($data as $pin) {
        echo "<li>{$pin['name']} — {$pin['salary']} <a href=\"?edit_person={$pin['id']}\">Изменить</a>";
        if (isset($pin['employees'])) {
            renderReport($pin['employees']);
        }
        echo "</li>";
    }
    echo '</ol>';
}

$positions = Positions::find();
$salaryMethods = SalaryMethodsStorage::find();
$stuff = Person::find();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Система расчета ЗП</title>
</head>
<body>
	<h1>Система расчета ЗП</h1>
	<h2>Отчёт</h2>
	<pre>
	<?php
renderReport($salaryReport->report());
?>
	</pre>
	<h2>Создание сотрудника</h2>
	<form method="post">
		<?php if($editPerson->getId()): ?>
		<input type="hidden" name="editPerson"
		value="<?=$editPerson->getId() ?>"/>
		<?php endif; ?>
		<ul>
			<li>
				<label for="name">ФИО полностью:</label>
				<input type="text" name="name" id="name"
					placeholder="Иванов Иван Иванович"
					value="<?=$editPerson->name ?>">
			</li>
			<li>
				<label for="phone">Номер телефона:</label>
				+7<input type="text" name="phone" id="phone"
					placeholder="9008007755" pattern="[0-9]{10}"
					value="<?=$editPerson->phone ?>">
			</li>
			<li>
				<label for="telegram">Telegram:</label>
				@<input type="text" name="telegram" id="telegram"
					pattern="[a-z0-9_]{5-32}" placeholder="adsd_3g"
					value="<?=$editPerson->telegram ?>">
			</li>
			<li>
				<label for="position">Должность:</label>
				<select name="position" id="position">
				<?php foreach ($positions as $position): ?>
					<option value="<?=$position->getId() ?>"
					<?=$editPerson->id_position == $position->getId() ?
					'selected' : ''?>>
						<?=$position->name ?>
					</option>
				<?php endforeach; ?>
				</select>
			</li>
			<li>
				<label for="salaryMethod">Вид оплаты труда:</label>
				<select name="salaryMethod" id="salaryMethod">
				<?php foreach ($salaryMethods as $salaryMethod): ?>
					<option value="<?=$salaryMethod->getId() ?>"
					<?=$editPerson->id_salary_method == $salaryMethod->getId() ?
					'selected' : ''?>>
						<?=$salaryMethod->name ?>
					</option>
				<?php endforeach; ?>
				</select>
			</li>
			<li>
				<label for="manager">В подчинении у</label>
				<select name="manager" id="manager">
				<?php foreach ($stuff as $manager): ?>
					<option value="<?=$manager->getId() ?>"
					<?=$editPerson->id_manager == $manager->getId() ?
					'selected' : ''?>>
						<?=$manager->name ?>
					</option>
				<?php endforeach; ?>
				</select>
			</li>
		</ul>
		<input type="submit" name="savePerson">
	</form>
</body>
</html>