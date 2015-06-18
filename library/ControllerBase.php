<?php

    abstract class ControllerBase
    {
        protected $systemRoot;
        protected $controller = 'index';
        protected $action = 'index';
        protected $view;
        protected $templatePath;

        // ルートディレクトリパスを設定
        public function setSystemRoot($path)
        {
            $this->systemRoot = $path;
        }

        // コントローラーとアクションの文字列設定
        public function setControllerAction($controller, $action)
        {
            $this->controller = $controller;
            $this->action = $action;
        }

        // 処理実行
        public function run()
        {
            try {
                // ビューの初期化
                $this->initializeView();

                // アクションメソッド
                $_methodName = sprintf('%sAction', $this->action);
                $this->$_methodName();

                // 表示
                $this->view->display($this->templatePath);
            } catch (Exception $e) {
            }
        }

        // ビューの初期化
        protected function initializeView()
        {
            $this->view = new Smarty();

            $this->view->template_dir = sprintf('%s/layouts/', $this->systemRoot);
            $this->view->compile_dir = sprintf('%s/layouts/cache/', $this->systemRoot);

            $this->templatePath = sprintf('%s/%s.tpl', $this->controller, $this->action);
        }
    }
