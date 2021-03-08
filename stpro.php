<?php
//Имеется массив ($array), содержащий данные об истории изменения юридических
//адресов организации (address) и данные о том, когда организация переехала на
//новый адрес (date_from) и до какого дня по этому адресу значилась (date_to).

$array = [
	['address' => 'г.Минск, ул.Восточная, д.33', 'date_from' => '31-12-2002', 'date_to' => '31-12-2005'],
	['address' => 'г.Минск, ул.Восточная, д.34', 'date_from' => '31-12-2005', 'date_to' => '31-12-2006'],
	['address' => 'г.Минск, ул.Восточная, д.34', 'date_from' => '31-12-2006', 'date_to' => '31-12-2008'],
	['address' => 'г.Минск, ул.Тихая, д.33', 'date_from' => '31-12-2000', 'date_to' => '31-12-2002'],
	['address' => 'г.Минск, ул.Ленина, д.33', 'date_from' => '31-12-2008', 'date_to' => '31-12-2010'],
	['address' => 'г.Минск, ул.Ленина, д.33', 'date_from' => '31-12-2010', 'date_to' => '31-12-2011'],
	['address' => 'г.Минск, ул.Тихая, д.33', 'date_from' => '31-12-2012'],
	['address' => 'г.Минск, ул.Ленина, д.33', 'date_from' => '31-12-2011', 'date_to' => '31-12-2012'],
];

//Сортировка массива относительно date_from
foreach ($array as $key => $value) {
	$date_from[$key] = $value['date_from'];
}
$date_from = array_column($array, 'date_from');
array_multisort($date_from, SORT_ASC, $array);

//Создаем новый массив в который добавляем 1-ый элемент старого массива
$array_new = [];
array_push($array_new, $array[0]);
//создаём счетчик для нового массива
$counter = 0;

for ($row = 0; $row < count($array); $row++) {
	//Для значение, у которого отсутствует date_to присваем сегодняшнюю дату
	if (!isset($array[$row]['date_to'])){
		$array[$row]['date_to'] = date('d-m-Y');
	}
	//Проверяем на повторение адресов, если они не совпадают то меняем date_to,
	// если же совпадают то добавляем элемент в новый массив
	if ($array[$row]['address'] <> $array_new[$counter]['address']){
		array_push($array_new, $array[$row]);
		$counter += 1;
	} else {
		$array_new[$counter]['date_to'] = $array[$row]['date_to'];
	}
}
//Вывод получившегося массива
for ($row = 0; $row < count($array_new); $row++) {
	echo $array_new[$row]['date_from'] . '/' . $array_new[$row]['date_to'] . ': ' . $array_new[$row]['address'];
	echo "\n";
}

