<?php
require_once("rest.php");

class API extends REST
{

  public $data = "";

  const DB_SERVER = "127.0.0.1";
  const DB_USER = "root";
  const DB_PASSWORD = "root";
  const DB = "boardtasks";

  private $db = NULL;
  private $mysqli = NULL;

  public function __construct()
  {
    parent::__construct();
    $this->dbConnect();
  }

  /**
   *  Connect to Database.
   */
  private function dbConnect()
  {
    $this->mysqli = new mysqli(
      self::DB_SERVER,
      self::DB_USER,
      self::DB_PASSWORD,
      self::DB
    );
  }

  /**
   * Dynmically call the method based on the query string.
   */
  public function processApi()
  {

    $func = strtolower(trim(str_replace("/", "", $_REQUEST['x'])));
    if ((int) method_exists($this, $func) > 0) {
        $this->$func();
    }
    else {
      $this->response('', 404);
    }
  }

  private function listTasks()
  {

  }

  private function insertTask()
  {
    if ($this->get_request_method() != 'POST') {
      $this->response('', 406);
    }

    $customer = json_decode(file_get_contents("php://input"),true);

    print_r(file_get_contents("php://input"));
    $this->response($this->json(),200);
  }

  private function updateTask()
  {

  }

  private function deleteTask(){

  }

  /**
   *  Encode array into JSON.
   */
  private function json($data)
  {
    if(is_array($data)){
      return json_encode($data);
    }
  }
}

// Initiiate Library.
$api = new API;
$api->processApi();

?>
