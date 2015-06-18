<?php

    require_once 'Smarty/Smarty.class.php';

    class Dispatcher
    {
        private $sysRoot;

         // ルートディレクトリを設定
        public function setSystemRoot($path)
        {
            $this->sysRoot = rtrim($path, '/');
        }


        // 振分け処理
        public function dispatch()
        {
            $_params = array();
            if ($_SERVER['REQUEST_URI'] != '' && $_SERVER['REQUEST_URI'] != '/') {
                $_params = explode('/', $_SERVER['REQUEST_URI']);
            }

            // １番目のパラメーターをコントローラーとして取得
            $_controller = 'index';
            if (0 < count($_params)) {
              $_controller = $_params[1];
            }
            $_controllerInstance = $this->getControllerInstance($_controller);
            if (null == $_controller) {
                header("HTTP/1.0 404 Not Found");
                exit;
            }

            // 2番目のパラメーターをアクションとして取得
            $_action = "index";
            if (1 < count($_params)) {
              $_action = $_params[2];
            }
            if (false == method_exists($_controllerInstance, $_action . 'Action')) {
                header("HTTP/1.0 404 Not Found");
                exit;
            }

            // コントローラー初期設定
            $_controllerInstance->setSystemRoot($this->sysRoot);
            $_controllerInstance->setControllerAction($_controller, $_action);
            // 処理実行
            $_controllerInstance->run();
        }

         // コントローラークラスのインスタンスを取得
        private function getControllerInstance($controller)
        {
            // 一文字目のみ大文字に変換＋"Controller"
            $_className = ucfirst(strtolower($controller)) . 'Controller';

            // コントローラーファイル名
            $_controllerFileName = sprintf('%s/controllers/%s.php', $this->sysRoot, $_className);

            if (false == file_exists($_controllerFileName)) {
                return null;
            }
            // クラスファイルを読込
            require_once $_controllerFileName;

            if (false == class_exists($_className)) {
                return null;
            }
            // クラスインスタンス生成
            $_controllerInstarnce = new $_className();

            return $_controllerInstarnce;
        }
    }
