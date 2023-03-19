<?php 
include_once 'config/db.php'; 
include_once 'calender.php'; 

$database = new Database();
$conn = $database->getConnection();

header('Content-Type: application/json');

date_default_timezone_set('Europe/Istanbul'); 

$calendar = new Calendar($conn);
$action = $_GET['action'] ?? null;
 
$startDate = $_GET['start'] ?? date('Y-m-d');
$endDate = $_GET['end'] ?? date('Y-m-d');
 
$id = $_POST['id'] ?? null;
$title = $_POST['title'] ?? null;
$start = $_POST['start'] ?? null;
$end = $_POST['end'] ?? null; 
  
switch ($action) {
    case 'list':   
        $events = $calendar->getEvents($startDate,$endDate);
        $response = $events; 
        break;
    case 'create': 
        $calendar->addEvent($title, $start, $end);  
        $response = ['success'=>true, 'message'=>'Etkinlik Oluşturuldu!'];  
        break; 
    case 'update': 
        if ($id != null && $title != null) {
           $calendar->updateEvent($id,$title); 
           $response = ['success'=>true, 'message'=>'Etkinlik güncellendi!'];  
        } else {
            http_response_code(400);
            $response = ['error' => 'Güncelleme İşleminde Bir Hata Oldu'];  
        }
        break; 
     case 'dropupdate':
        $calendar->dropEvent($id,$start,$end);
        $response = ['success'=>true, 'message'=>'Etkinlik güncellendi!'];  
     break;
     case 'delete':
        $calendar->deleteEvent($id);
        $response = ['success'=>true, 'message'=>'Etkinlik Başarıyla Silindi!'];  
     break;
    default:
        http_response_code(400);
        $response = ['error' => 'İşlemde Bir Hata Oldu'];  
} 

echo  json_encode($response);