<?php

    class ModelBase
    {
        private static $connInfo;
        protected $db;

        public function __construct()
        {
            $this->initDb();
        }

        public function initDb()
        {
            $dsn = sprintf(
                           'mysql:host=%s;dbname=%s;charset=utf8',
                           self::$connInfo['host'],
                           self::$connInfo['dbname']
                           );
            $this->db = new PDO($dsn, self::$connInfo['dbuser'], self::$connInfo['password']);
        }

        public static function setConnectionInfo($connInfo)
        {
            self::$connInfo = $connInfo;
        }
    }
