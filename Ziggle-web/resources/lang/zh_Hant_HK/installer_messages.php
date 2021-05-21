<?php 
return array (
  'title' => 'zCart安裝程序',
  'next' => '下一步',
  'back' => '以前',
  'finish' => '安裝',
  'forms' => 
  array (
    'errorTitle' => '發生以下錯誤：',
  ),
  'wait' => '請等待，安裝可能需要幾分鐘。',
  'welcome' => 
  array (
    'templateTitle' => '歡迎',
    'title' => 'zCart安裝程序',
    'message' => '簡易安裝和設置嚮導。',
    'next' => '檢查要求',
  ),
  'requirements' => 
  array (
    'templateTitle' => '步驟1 |服務器要求',
    'title' => '服務器要求',
    'next' => '檢查權限',
    'required' => '需要設置所有服務器要求才能繼續',
  ),
  'permissions' => 
  array (
    'templateTitle' => '步驟2 |權限',
    'title' => '權限',
    'next' => '配置環境',
    'required' => '根據需要設置權限以繼續。閱讀文檔。求助。',
  ),
  'environment' => 
  array (
    'menu' => 
    array (
      'templateTitle' => '步驟3 |環境設定',
      'title' => '環境設定',
      'desc' => '請選擇您要如何配置應用程序<code> .env </ code>文件。',
      'wizard-button' => '表單嚮導設置',
      'classic-button' => '經典文字編輯器',
    ),
    'wizard' => 
    array (
      'templateTitle' => '步驟3 |環境設置|嚮導嚮導',
      'title' => '引導的<code> .env </ code>嚮導',
      'tabs' => 
      array (
        'environment' => '環境',
        'database' => '數據庫',
        'application' => '應用',
      ),
      'form' => 
      array (
        'name_required' => '必須輸入環境名稱。',
        'app_name_label' => '應用名稱',
        'app_name_placeholder' => '應用名稱',
        'app_environment_label' => '應用環境',
        'app_environment_label_local' => '本地',
        'app_environment_label_developement' => '發展歷程',
        'app_environment_label_qa' => 'a',
        'app_environment_label_production' => '生產',
        'app_environment_label_other' => '其他',
        'app_environment_placeholder_other' => '輸入您的環境...',
        'app_debug_label' => '應用調試',
        'app_debug_label_true' => '真正',
        'app_debug_label_false' => '假',
        'app_log_level_label' => '應用日誌級別',
        'app_log_level_label_debug' => '調試',
        'app_log_level_label_info' => '信息',
        'app_log_level_label_notice' => '注意',
        'app_log_level_label_warning' => '警告',
        'app_log_level_label_error' => '錯誤',
        'app_log_level_label_critical' => '危急',
        'app_log_level_label_alert' => '警報',
        'app_log_level_label_emergency' => '緊急情況',
        'app_url_label' => '應用程式網址',
        'app_url_placeholder' => '應用程式網址',
        'db_connection_failed' => '無法連接到數據庫。檢查配置。',
        'db_connection_label' => '數據庫連接',
        'db_connection_label_mysql' => 'MySQL的',
        'db_connection_label_sqlite' => 'sqlite',
        'db_connection_label_pgsql' => 'pgsql',
        'db_connection_label_sqlsrv' => 'sqlsrv',
        'db_host_label' => '數據庫主機',
        'db_host_placeholder' => '數據庫主機',
        'db_port_label' => '數據庫端口',
        'db_port_placeholder' => '數據庫端口',
        'db_name_label' => '數據庫名稱',
        'db_name_placeholder' => '數據庫名稱',
        'db_username_label' => '數據庫用戶名',
        'db_username_placeholder' => '數據庫用戶名',
        'db_password_label' => '數據庫密碼',
        'db_password_placeholder' => '數據庫密碼',
        'app_tabs' => 
        array (
          'more_info' => '更多信息',
          'broadcasting_title' => '廣播，緩存，會話和隊列',
          'broadcasting_label' => '廣播驅動程序',
          'broadcasting_placeholder' => '廣播驅動程序',
          'cache_label' => '緩存驅動程序',
          'cache_placeholder' => '緩存驅動程序',
          'session_label' => '會話驅動程序',
          'session_placeholder' => '會話驅動程序',
          'queue_label' => '隊列驅動程序',
          'queue_placeholder' => '隊列驅動程序',
          'redis_label' => 'Redis驅動',
          'redis_host' => 'Redis主機',
          'redis_password' => 'Redis密碼',
          'redis_port' => '雷迪斯港口',
          'mail_label' => '郵件',
          'mail_driver_label' => '郵件驅動',
          'mail_driver_placeholder' => '郵件驅動',
          'mail_host_label' => '郵件主機',
          'mail_host_placeholder' => '郵件主機',
          'mail_port_label' => '郵件端口',
          'mail_port_placeholder' => '郵件端口',
          'mail_username_label' => '郵件用戶名',
          'mail_username_placeholder' => '郵件用戶名',
          'mail_password_label' => '郵件密碼',
          'mail_password_placeholder' => '郵件密碼',
          'mail_encryption_label' => '郵件加密',
          'mail_encryption_placeholder' => '郵件加密',
          'pusher_label' => '推桿',
          'pusher_app_id_label' => '推送器應用ID',
          'pusher_app_id_palceholder' => '推送器應用ID',
          'pusher_app_key_label' => '推送器應用程序密鑰',
          'pusher_app_key_palceholder' => '推送器應用程序密鑰',
          'pusher_app_secret_label' => 'Pusher App Secret',
          'pusher_app_secret_palceholder' => 'Pusher App Secret',
        ),
        'buttons' => 
        array (
          'setup_database' => '設置數據庫',
          'setup_application' => '設置應用',
          'install' => '安裝',
        ),
      ),
    ),
    'classic' => 
    array (
      'backup' => '為避免混亂，請在進行任何更改之前將默認配置複製並保存在其他位置。',
      'templateTitle' => '步驟3 |環境設置|經典編輯器',
      'title' => '環境文件編輯器',
      'save' => '保存配置',
      'back' => '使用表單嚮導',
      'install' => '安裝',
      'required' => '解決該問題以繼續。',
    ),
    'success' => '您的.env文件設置已保存。',
    'errors' => '.env文件無法保存，請手動創建。',
  ),
  'verify' => 
  array (
    'verify_purchase' => '驗證購買',
    'submit' => '提交',
    'form' => 
    array (
      'email_address_label' => '電子郵件地址',
      'email_address_placeholder' => '電子郵件地址',
      'purchase_code_label' => '購買代碼',
      'purchase_code_placeholder' => '購買代碼或許可證密鑰',
      'root_url_label' => '根網址',
      'root_url_placeholder' => '根URL（末尾沒有/）',
    ),
  ),
  'install' => '安裝',
  'verified' => '許可證已成功驗證。',
  'verification_failed' => '許可證驗證失敗！',
  'installed' => 
  array (
    'success_log_message' => 'zCart安裝程序已成功安裝',
  ),
  'final' => 
  array (
    'title' => '最後一步',
    'templateTitle' => '最後一步',
    'finished' => '應用程序已成功安裝。',
    'migration' => '遷移和種子控制台輸出：',
    'console' => '應用程序控制台輸出：',
    'log' => '安裝日誌條目：',
    'env' => '最終的.env文件：',
    'exit' => '點擊此處登錄',
    'import_demo_data' => '導入演示數據',
  ),
  'updater' => 
  array (
    'title' => 'zCart更新器',
    'welcome' => 
    array (
      'title' => '歡迎使用更新程序',
      'message' => '歡迎使用更新嚮導。',
    ),
    'overview' => 
    array (
      'title' => '總覽',
      'message' => '有1個更新。|有 :number個更新。',
      'install_updates' => '安裝更新',
    ),
    'final' => 
    array (
      'title' => '已完成',
      'finished' => '應用程序的數據庫已成功更新。',
      'exit' => '點擊此處退出',
    ),
    'log' => 
    array (
      'success_message' => 'zCart安裝程序已成功更新',
    ),
  ),
);