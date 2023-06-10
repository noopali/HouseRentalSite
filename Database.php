<?php

    class Database
{
    private static $host = "localhost";
    private static $user = "root";
    private static $pass = "";
    private static $db = "basobas";

    public $con = null;

    public function __construct()
    {
        $this->con = mysqli_connect(self::$host, self::$user, self::$pass, self::$db);

        if (!$this->con) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function getConnection()
    {
        if ($this->con != null) {
            return $this->con;
        }
        return null;
    }
}
?>

