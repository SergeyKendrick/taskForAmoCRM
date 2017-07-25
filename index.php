<?php

$subdomain='new59774e8b5258d';

require_once('auth.php');

require_once('getleads.php');

$leads_without_task = [];

foreach($Response['leads'] as $key => $lead) {
    
    if($lead['closest_task'] == 0) {
        $leads_without_task[] = $lead['id'];
    }
    
}

if($leads_without_task) {

    foreach($leads_without_task as $newtask) {

        $tasks[] = array(
            'element_id'=>$newtask, #ID сделки
            'element_type'=>2, #Показываем, что это - сделка, а не контакт
            'task_type'=>1, #Звонок
            'text'=>'Сделка без задачи',
            'complete_till'=>time()+82800,
        );   
    }

    $tasks['request']['tasks']['add'] = $tasks;

    require_once('sendtasks.php');
    
    echo "Задачи успешно добавлены.".PHP_EOL.$output;
    
    
} else {
    echo "Упсики. Нет сделок без задач.";
}

?>