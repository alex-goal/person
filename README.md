PHP-библиотека по управлению персональными данными человека

### Установка

```
composer require alex-goal/person
```

### Требования

```
PHP >=7.1
```

### Возможности

#### Форматирование ФИО

```php
use AlexGoal\Person\Person;

// Создание объекта Person
$person = new Person('иванов петр сидорович'); // ИЛИ
$person = Person::create('иванов петр сидорович'); // ИЛИ
$person = Person::create()
    ->setLastName('иванов')
    ->setFirstName('петр')
    ->setMiddleName('сидорович');

// Форматирование
$person->getFisrtName(); // Петр
$person->getFullName('%Ff %Mm %Ll'); // Петр Сидорович Иванов
$person->getFullName('%Ff %Mm %L1.'); // Петр Сидорович И.
$person->getShortName(); // Иванов П.С.
$person->getInitials(); // П.С.
$person->getFullNameUpper(); // ИВАНОВ ПЕТР СИДОРОВИЧ
$person->getFullNameLower(); // иванов петр сидорович
```

Доступные спецификаторы для форматирования имён

|     | Описание                          | Пример    |
|:----|:----------------------------------|:----------|
| %Ll | Фамилия (первая буква прописная)  | Иванов    |
| %Ff | Имя (первая буква прописная)      | Петр      |
| %Mm | Отчество (первая буква прописная) | Сидорович |
| %LL | Фамилия (все буквы прописные)     | ИВАНОВ    |
| %FF | Имя (все буквы прописные)         | ПЕТР      |
| %MM | Отчество (все буквы прописные)    | СИДОРОВИЧ |
| %ll | Фамилия (все буквы строчные)      | иванов    |
| %ff | Имя (все буквы строчные)          | петр      |
| %mm | Отчество (все буквы строчные)     | сидорович |
| %L1 | Прописная первая буква фамилии    | И         |
| %F1 | Прописная первая буква имени      | П         |
| %M1 | Прописная первая буква отчества   | С         |
| %l1 | Строчная первая буква фамилии     | и         |
| %f1 | Строчная первая буква имени       | п         |
| %m1 | Строчная первая буква отчества    | с         |
| %l  | Фамилия, как указано изначально   |           |
| %f  | Имя, как указано изначально       |           |
| %m  | Отчество, как указано изначально  |           |

#### Управление датой рождения

```php
use AlexGoal\Person\Components\Birthday;
use AlexGoal\Person\Person;

// Создание объекта Birthday
$birthday = new Birthday('2001-01-01'); // ИЛИ
$birthday = Birthday::create('2001-01-01'); // ИЛИ
$birthday = Birthday::create()->setDate('2001-01-01'); // ИЛИ
$birthday = Birthday::create()->setDate(new DataTime('2001-01-01'));

// Возраст
$birthday->getAge(); // возраст на текущую дату
$birthday->getAge('2101-01-01'); // 100 (возраст на дату 2101-01-01)
$birthday->getDateByFormat('d.m.y'); // 01.01.01
$birthday->getAgePhrase('2002-01-01') // 1 год (возраст со словом год|года|лет);

// Совершеннолетие
$birthday->isAdult(); // true (на текущую дату)
$birthday->isAdult('2011-01-01'); // false (на дату 2011-01-01)

// Использование совместно с Person
$person = Person::create('иванов петр сидорович')->setBirhday('2000-01-01'); // ИЛИ
$person = Person::create('иванов петр сидорович')->setBirhday(new Birthday('2000-01-01'));

$person->getAge(); // возраст
$person->isAdult(); // совершеннолетие
```

#### Управление полом

```php
use AlexGoal\Person\Components\Gender;
use AlexGoal\Person\Person;

// Создание объекта Gender
$gender = new Gender('мужской'); // ИЛИ
$gender = Gender::create('муж'); // ИЛИ
$gender = Gender::create()->setName('male'); // ИЛИ
Gender::create()->setMale();

$gender->getName(); // male
$gender->getName('М', 'Ж'); // М
$gender->isMale(); // true
$gender->isFemale(); // false

// Использование совместно с Person
$person = Person::create('иванов петр сидорович')->setGender('male'); // ИЛИ
$person = Person::create('иванов петр сидорович')->setGender(new Gender('мужской')); // ИЛИ
$person = Person::create('иванов петр сидорович')->setMale();

$person->getGenderName(); // male
$person->getGenderName('МУЖ', 'ЖЕН'); // МУЖ
$person->isMale(); // true
$gender->isFemale(); // false
```