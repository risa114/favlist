<?php

    class ListModel extends ModelBase
    {
        // リスト取得
        public function getFavList()
        {
            $_sql = "SELECT * FROM tbl_info WHERE revisit = 0 AND status < 'w' ORDER BY tbl_info_id DESC";

            $stmt = $this->db->query($_sql);
            $_favList = $stmt->fetchAll();

            return $_favList;
        }

        // 再訪リスト取得
        public function getRevisitList()
        {
            $_sql = "SELECT * FROM `tbl_info` WHERE revisit= 1 AND status < 'w'";
            $stmt = $this->db->query($_sql);
            $_favList = $stmt->fetchAll();

            return $_favList;
        }

        // 都道府県リスト取得
        public function getPrefecture()
        {
            $_sql = "SELECT `mst_prefecture_id`,`prefecture_name` FROM `mst_prefecture`";
            $stmt = $this->db->query($_sql);
            $_prefecture = $stmt->fetchAll();

            return $_prefecture;
        }

        // 新規登録
        public function registList($data)
        {
            $_item = '';
            foreach ($data as $_key => $_value) {
                //複数選択の項目
                switch ($_key) {
                    case 'time':
                    case 'goWith':
                        foreach ($_value as $_val) {
                            $_item .= $_val . ',';
                        }
                        $data[$_key] = rtrim($_item , ',');
                        break;
                    default:
                        break;
                }
            }

            $_items = '';
            $_binds = '';
            foreach ($data as $_key => $_value) {
                $_items .= $_key . ',';
                $_binds .= ':' . $_key . ',';
            }
            $_items = rtrim($_items , ',');
            $_binds = rtrim($_binds , ',');

            $_strSql = 'INSERT INTO tbl_info (' . $_items .')'
            . ' VALUES (' . $_binds . ');';
//var_dump($strSql);
            $_sql = $this->db->prepare($_strSql);

            //登録
            foreach ($data as $_key => $_value) {
                $_sql->bindValue($_key,  $_value);
            }
            try {
                $_sql->execute();

            } catch (PDOEXeption $error) {
                die($error->getMessage());
            }

        }
        // リスト検索
        public function getSearchList()
        {
            $_where = '';
            foreach ($_POST as $_key => $_value) {
                switch ($_key) {
                    //複数選択の項目
                    case 'genre':
                    case 'time':
                    case 'goWith':
                        $_items = '';
                        foreach ($_value as $_val) {
                            $_items .=  " " . $_key . " LIKE '%" . $_val . "%' OR ";
                        }
                        $_items = rtrim($_items, 'OR ');
                        $_items = "(" . $_items . ")";
                        $_where .= $_items . ' AND ';
                        break;
                    //自由記入の項目
                    case 'name':
                        $_item =  " " . $_key . " LIKE '%" . $_value . "%' AND ";
                        $_where .= $_item;
                        break;
                    default:
                        break;
                }
            }
            $_where = rtrim($_where, 'AND ');
            $_sql = "SELECT * FROM `tbl_info` WHERE ". $_where;

            $stmt = $this->db->prepare($_sql);
            $stmt->execute();
            $_list = $stmt->fetchAll();

            return $_list;
        }

    }
