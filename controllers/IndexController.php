<?php

    class IndexController extends ControllerBase
    {

        public function __construct()
        {
            $this->model= new ListModel();
        }

        public function indexAction()
        {
            //ひとまずリストアクションにまわす
            return $this->ListAction();
        }

        // リスト一覧
        public function ListAction()
        {
            $_list = $this->model->getFavList();

            $this->view->assign('list' , $_list);
            $this->view->display('list.tpl');
        }

        // 絞り込み検索
        public function SearchAction()
        {
            if (!empty($_POST)) {
                //検索結果を取得してリスト表示
                $_list = $this->model->getSearchList();
                $this->view->assign('list' , $_list);
                $this->view->display('list.tpl');
            } else {
                $this->view->display('search.tpl');
            }
            $_prefecture = $this->model->getPrefecture();
            $this->view->assign('prefecture' , $_prefecture);
        }

        // 再訪リスト取得
        public function RevisitAction()
        {
            $_revisitList = $this->model->getRevisitList();

            $this->view->assign('list' , $_revisitList);
            $this->view->display('revisit.tpl');
        }

        // 新規登録
        public function RegistAction()
        {
            if (!empty($_POST)) {
                $_data = $_POST;
                //登録処理
                $_res = $this->model->registList($_data);
            } else {
            }

            $_prefecture = $this->model->getPrefecture();

            $this->view->assign('prefecture' , $_prefecture);
            $this->view->display('regist.tpl');
        }
    }
