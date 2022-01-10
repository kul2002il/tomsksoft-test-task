# Построить систему расчета ЗП сотрудников.

1) Представить сотрудника отдельным классом с некоторым набором
стандартных атрибутов (имя, телефон, ник и тд).

Представить менеджера отдельным классом: менеджер тоже является
сотрудником, но кроме того
менеджер может быть руководителем любого сотрудника (1 менеджер - много
сотрудников).
У менеджера может быть собственный менеджер.

Сайт должен позволять добавлять новых сотрудников и менеджеров, а также
устанавливать связи Менеджер-Сотрудник

2) Ввести логику расчета зарплаты: сотрудник может иметь почасовую
зарплату или окладную (1 сотрудник имеет одну логику).
При этом это верно как для сотрудника, так и для менеджера, то есть
существуют сотрудники с почасовой и окладной ЗП и менеджеры с почасовой
и окладной ЗП.
Формулы для расчета ЗП не играют роли и выбираются произвольно автором.
Логику расчета зарплаты представить отдельными классами.
Дизайн классов нужно предусмотреть, чтобы можно было добавлять новые
типы сотрудников и новые типы расчета ЗП.

3) Продемонстрировать использование классов. Вывести список сотрудников
с рассчитанной зарплатой.

* Менеджер 1 <Salary>
    * Сотрудник 1 <Salary>
    * Сотрудник 2 <Salary>
    * Сотрудник 3 <Salary>
* Менеджер 2 <Salary>
    * Менеджер 3 <Salary>
        * Сотрудник 4 <Salary>

(Менеджер 1 является руководителем сотрудников 1-3, Менеджер 2 не имеет
своих сотрудников, кроме Менеджер 3, у которого один Сотрудник 4)

Подготовкой отчета должен заниматься отдельный класс SalaryReport.
Важно, чтобы при добавлении новых типов сотрудников или расчета ЗП класс
SalaryReport не менялся.

## Требования:

1. PHP 8, ООП/ООД, дизайн классов должен быть максимально однозначным и
понятным
2. Шаблоны (template engine) для разделения HTML и PHP, опционально
3. Комментарии на английском языке (phpdocformat).