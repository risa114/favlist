<?php

    //定義ファイル
    require( "defines.php" );

    // include_pathにパス追加
    $includes = array(LIB_PATH, ROOT_PATH . '/models',LIB_PATH . '/Smarty',LIB_PATH . '/Smarty/sysplugins');

    $incPath = implode(PATH_SEPARATOR, $includes);
    set_include_path(get_include_path() . PATH_SEPARATOR . $incPath);

    // オートロード
    function __autoload($className){
        require_once $className . ".php";
    }

    // DB接続情報設定
    $connInfo = array(
                      'host'     => DB_HOST,
                      'dbname'   => DB_NAME,
                      'dbuser'   => DB_USER,
                      'password' => DB_PASS
                      );
    ModelBase::setConnectionInfo($connInfo);

    // リクエスト処理
    $dispatcher = new Dispatcher();
    $dispatcher->setSystemRoot(ROOT_PATH);
    $dispatcher->dispatch();
