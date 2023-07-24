<?php
include_once "./task.php";

class TaskModel {

    private array $task_list;
    private $dataFilePath = 'DevoTeams\web\json_tasks.json"';

public function __construct() {
    $this->task_list = array();
    
}
private function saveData($task_data) : void{
        
    $jsonData = json_encode($task_data, JSON_PRETTY_PRINT);
    file_put_contents($this->dataFilePath, $jsonData);

    }

private function readData() {
    // va al archivo json
    $tasksData = file_get_contents($this->dataFilePath);
    
    // lee el archivo json y lo transforma 
    $data_read = json_decode($tasksData, true);
}
public function addtask(Task $task) : void {

    $task_data[] = $task;
    //$this->task_list[] = $task_data;
    
    $this ->saveData($task_data);

}   



/*private function loadData()
    {
        if (file_exists($this->dataFilePath)) {
            $jsonData = file_get_contents($this->dataFilePath);
            $this->tasks = json_decode($jsonData, true);
        } else {
            $this->tasks = ["tasks" => []];
        }
    }*/

    

    public function getAllTasks()
    {
        return $this->tasks['tasks'];
    }

    public function modifyTask($taskId, $newTaskData)
    {
        foreach ($this->tasks['tasks'] as &$task) {
            if ($task['id'] === $taskId) {
                $task = array_merge($task, $newTaskData);
                $this->saveData();
                return true;
            }
        }
        return false;
    }


}

?>