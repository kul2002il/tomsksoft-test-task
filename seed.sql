INSERT INTO positions (name, code) VALUES
("Сотрудник", "worker"),
("Менеджер", "manager");

INSERT INTO salary_method (name, code) VALUES
("Окладная оплата", "RegularSalary"),
("Почасовая оплата", "HourlySalary");

INSERT INTO persons (name, phone, telegram, id_position, id_salary_method, id_manager) VALUES
("Иванов Иван Иванович", 1231231234, "tm123123", 2, 1, NULL),
("Тяпкин Василий Павлович", 1232241234, "tm123224", 1, 1, 1),
("Игорь Иванович Печкин", 1232251234, "tm123225", 1, 1, 1),
("Третьякова Лидия Мэлоровна", 1232261234, "tm123226", 1, 2, 1),
("Кудрявцева Стелла Богуславовна", 1231251234, "tm123125", 2, 2, NULL),
("Муравьёв Фрол Макарович", 1231261234, "tm123126", 2, 2, 5),
("Орлова Лиза Наумовна", 1231271234, "tm123127", 1, 1, 6);
