<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

spl_autoload_register(function ($class) {
    require_once './' . str_replace('\\', '/', $class) . '.php';
});

$storage = new models\personStorage\PersonStorageInPDO();
$core = new models\kernel\CorePersons($storage);
$core->regSalaryMethod(new models\salaryMethods\HourlySalary());
$core->regSalaryMethod(new models\salaryMethods\RegularSalary());
$core->regPersonFactory(new models\positions\manager\ManagerFactory());
$core->regPersonFactory(new models\positions\employee\EmployeeFactory());
$report = new models\salaryReport\SalaryReport($core);
$htmlReport = new models\renderReport\HTMLRenderReport($report);


if(isset($_POST['savePerson']))
{
    if(isset($_POST['id']))
    {
        $editPerson = $core->findById((int)$_POST['id']);
    }
    else
    {
        $editPerson = new models\positions\employee\Employee();
        $editPerson->setCore($core);
        $editPerson->setSalaryMethod($core->getSalaryMethodByCode('Hourly'));
    }
    $editPerson->loadFromArray($_POST);
    $core->savePerson($editPerson);
}
else if(isset($_GET['edit_person']))
{
    $editPerson = $core->findById((int)$_GET['edit_person']);
}
else
{
    $editPerson = new models\positions\employee\Employee();
    $editPerson->setCore($core);
    $editPerson->setSalaryMethod($core->getSalaryMethodByCode('Hourly'));
}
$editPersonData = $editPerson->exportToArray();

$managers = $core->find('position_code="manager"');

$positionsStorage = new models\personStorage\PositionsStorage();
$salaryMethodsStorage = new models\personStorage\SalaryMethodsStorage();

$positions = $positionsStorage->findAssoc();
$salaryMethods = $salaryMethodsStorage->findAssoc();

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
	<?php $htmlReport->render(); ?>
	</pre>
	<h2>Создание сотрудника</h2>
	<form method="post">
		<?php if($editPerson->getId()): ?>
		<input type="hidden" name="id"
		value="<?=$editPerson->getId() ?>"/>
		<?php endif; ?>
		<ul>
			<li>
				<label for="name">ФИО полностью:</label>
				<input type="text" name="name" id="name"
					placeholder="Иванов Иван Иванович"
					value="<?=$editPersonData['name'] ?>">
			</li>
			<li>
				<label for="phone">Номер телефона:</label>
				+7<input type="text" name="phone" id="phone"
					placeholder="9008007755" pattern="[0-9]{10}"
					value="<?=$editPersonData['phone'] ?>">
			</li>
			<li>
				<label for="telegram">Telegram:</label>
				@<input type="text" name="telegram" id="telegram"
					pattern="[a-z0-9_]{5-32}" placeholder="adsd_3g"
					value="<?=$editPersonData['telegram'] ?>">
			</li>
			<li>
				<label for="position">Должность:</label>
				<select name="position" id="position">
				<?php foreach ($positions as $position): ?>
					<option value="<?=$position['code'] ?>"
					<?=$editPersonData['position_code'] == $position['code']?
					'selected' : ''?>>
						<?=$position['name'] ?>
					</option>
				<?php endforeach; ?>
				</select>
			</li>
			<li>
				<label for="salaryMethod">Вид оплаты труда:</label>
				<select name="salary_method_code" id="salaryMethod">
				<?php foreach ($salaryMethods as $salaryMethod): ?>
					<option value="<?=$salaryMethod['code'] ?>"
					<?=$editPersonData['salary_method_code'] == $salaryMethod['code'] ?
					'selected' : ''?>>
						<?=$salaryMethod['name'] ?>
					</option>
				<?php endforeach; ?>
				</select>
			</li>
			<li>
				<label for="manager">В подчинении у</label>
				<select name="id_manager" id="manager">
				<?php foreach ($managers as $manager): ?>
					<option value="<?=$manager->getId() ?>"
					<?=$editPersonData['id_manager'] == $manager->getId() ?
					'selected' : ''?>>
						<?=$manager->getName() ?>
					</option>
				<?php endforeach; ?>
				</select>
			</li>
		</ul>
		<input type="submit" name="savePerson">
	</form>
</body>
</html>