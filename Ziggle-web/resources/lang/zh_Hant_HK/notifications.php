<?php 
return array (
  'password_updated' => 
  array (
    'subject' => '您的 :marketplace密碼已成功更新！',
    'greeting' => '您好 :user！',
    'message' => '您的帳戶登錄密碼已成功更改！如果您沒有進行此更改，請盡快與我們聯繫！單擊下面的按鈕登錄到您的個人資料頁面。',
    'button_text' => '訪問您的個人資料',
  ),
  'invoice_created' => 
  array (
    'subject' => ':marketplace每月訂閱費發票',
    'greeting' => '您好 :merchant！',
    'message' => '感謝您一直以來的支持。我們已附上您的發票副本作為記錄。如果您有任何疑問或疑慮，請告訴我們！',
    'button_text' => '前往資訊主頁',
  ),
  'customer_registered' => 
  array (
    'subject' => '歡迎來到 :marketplace市場！',
    'greeting' => '恭喜 :customer！',
    'message' => '您的帳戶已成功創建！點擊下面的按鈕以驗證您的電子郵件地址。',
    'button_text' => '驗證我',
  ),
  'customer_updated' => 
  array (
    'subject' => '帳戶信息更新成功！',
    'greeting' => '您好 :customer！',
    'message' => '這是一條通知，通知您您的帳戶已成功更新！',
    'button_text' => '訪問您的個人資料',
  ),
  'customer_password_reset' => 
  array (
    'subject' => '重置密碼通知',
    'greeting' => '你好！',
    'message' => '您收到此電子郵件是因為我們收到了您帳戶的密碼重置請求。如果您不要求重設密碼，只需忽略此通知，就不需要其他的button_text了。',
    'button_text' => '重設密碼',
  ),
  'dispute_acknowledgement' => 
  array (
    'subject' => '[訂單ID： :order_id]爭議已成功提交',
    'greeting' => '你好 :customer',
    'message' => '這是一條通知，通知您我們已經收到您關於訂單ID： :order_id的爭議，我們的支持團隊將盡快與您聯繫。',
    'button_text' => '查看爭議',
  ),
  'dispute_created' => 
  array (
    'subject' => '訂單ID： :order_id的新爭議',
    'greeting' => '您好 :merchant！',
    'message' => '您已收到有關訂單ID :order_id的新爭議。請與客戶一起檢查並解決問題。',
    'button_text' => '查看爭議',
  ),
  'dispute_updated' => 
  array (
    'subject' => '[訂單ID： :order_id]爭議狀態已更新！',
    'greeting' => '您好 :customer！',
    'message' => '訂單ID :order_id的爭議已使用來自賣方“：reply”的此消息進行了更新。請檢查以下內容，如果需要任何幫助，請與我們聯繫。',
    'button_text' => '查看爭議',
  ),
  'dispute_appealed' => 
  array (
    'subject' => '[訂單ID： :order_id]爭議已上訴！',
    'greeting' => '你好！',
    'message' => '訂單ID :order_id的爭議已通過以下消息“：reply”提出申訴。請檢查以下詳細信息。',
    'button_text' => '查看爭議',
  ),
  'appealed_dispute_replied' => 
  array (
    'subject' => '[訂單ID： :order_id]上訴爭議的新回复！',
    'greeting' => '你好！',
    'message' => '訂單ID :order_id的爭議已通過以下消息得到答复：</br> </br>“：reply”',
    'button_text' => '查看爭議',
  ),
  'low_inventory_notification' => 
  array (
    'subject' => '低庫存警報！',
    'greeting' => '你好！',
    'message' => '您的一個或多個庫存項目越來越少。是時候添加更多庫存以使商品繼續投放市場了。',
    'button_text' => '更新庫存',
  ),
  'inventory_bulk_upload_procceed_notice' => 
  array (
    'subject' => '您的批量庫存導入請求已完成。',
    'greeting' => '你好！',
    'message' => '很高興通知您，您的批量庫存導入請求已完成。成功導入到平台的行總數 :success，失敗的行數 :failed',
    'failed' => '請為失敗的行找到附件。',
    'button_text' => '查看庫存',
  ),
  'new_message' => 
  array (
    'subject' => ':subject',
    'greeting' => '你好 :receiver',
    'message' => ':message',
    'button_text' => '在現場查看消息',
  ),
  'message_replied' => 
  array (
    'subject' => ':user回复 :subject',
    'greeting' => '你好 :receiver',
    'message' => ':reply',
    'button_text' => '在現場查看消息',
  ),
  'order_created' => 
  array (
    'subject' => '[訂單ID： :order]，您的訂單已成功下達！',
    'greeting' => '你好 :customer',
    'message' => '感謝您選擇我們！您的訂單[訂單ID :order]已成功下達。我們將通知您訂單狀態。',
    'button_text' => '參觀商店',
  ),
  'merchant_order_created_notification' => 
  array (
    'subject' => '新訂單[訂單ID： :order]已放置在您的商店中！',
    'greeting' => '你好 :merchant',
    'message' => '新訂單[訂單ID :order]已下達。請檢查訂單詳細信息並儘快完成訂單。',
    'button_text' => '完成訂單',
  ),
  'order_updated' => 
  array (
    'subject' => '[訂單ID： :order]，您的訂單狀態已更新！',
    'greeting' => '你好 :customer',
    'message' => '這是一條通知，通知您訂單[訂單ID :order]已更新。請參閱下面的訂單詳細信息。您也可以從信息中心檢查訂單。',
    'button_text' => '參觀商店',
  ),
  'order_fulfilled' => 
  array (
    'subject' => '[訂單ID： :order]您的訂單就這樣了！',
    'greeting' => '你好 :customer',
    'message' => '這是一條通知，通知您您的訂單[訂單ID :order]已發貨，並且正在運送中。請參閱下面的訂單詳細信息。您也可以從信息中心檢查訂單。',
    'button_text' => '參觀商店',
  ),
  'order_paid' => 
  array (
    'subject' => '[訂單ID： :order]您的訂單已成功付款！',
    'greeting' => '你好 :customer',
    'message' => '這是一條通知，通知您您的訂單[訂單ID :order]已成功付款，並且正在付款。請參閱下面的訂單詳細信息。您也可以從信息中心檢查訂單。',
    'button_text' => '參觀商店',
  ),
  'order_payment_failed' => 
  array (
    'subject' => '[訂單ID： :order]付款失敗！',
    'greeting' => '你好 :customer',
    'message' => '這是一條通知，通知您您的訂單[訂單ID :order]付款失敗。請參閱下面的訂單詳細信息。您也可以從信息中心檢查訂單。',
    'button_text' => '參觀商店',
  ),
  'refund_initiated' => 
  array (
    'subject' => '[訂單ID： :order]已開始退款！',
    'greeting' => '你好 :customer',
    'message' => '這是一條通知，通知您我們已經針對您的訂單 :order發起了退款請求。我們的小組成員之一將盡快審核該請求。我們將讓您知道請求的狀態。',
  ),
  'refund_approved' => 
  array (
    'subject' => '[訂單ID： :order]，退款申請已獲批准！',
    'greeting' => '你好 :customer',
    'message' => '這是一條通知，通知您我們已經批准了您的訂單 :order的退款請求。退款金額是 :amount。我們已將款項匯入您的付款方式，這可能需要幾天的時間才能生效。如果幾天后看不到這筆款項，請與您的付款提供商聯繫。',
  ),
  'refund_declined' => 
  array (
    'subject' => '[訂單ID： :order]，退款申請已被拒絕！',
    'greeting' => '你好 :customer',
    'message' => '這是一條通知，通知您 :order訂單的退款請求已被拒絕。如果您對商家的解決方案不滿意，可以直接從平台與商家聯繫，甚至可以在 :marketplace上提出爭議。我們將介入以解決問題。',
  ),
  'shop_created' => 
  array (
    'subject' => '您的商店已準備就緒！',
    'greeting' => '恭喜 :merchant！',
    'message' => '您的商店 :shop_name已成功創建！單擊下面的按鈕以登錄商店管理面板。',
    'button_text' => '前往資訊主頁',
  ),
  'shop_updated' => 
  array (
    'subject' => '店鋪信息已成功更新！',
    'greeting' => '您好 :merchant！',
    'message' => '這是一條通知，通知您您的商店 :shop_name已成功更新！',
    'button_text' => '前往資訊主頁',
  ),
  'shop_config_updated' => 
  array (
    'subject' => '店鋪配置成功更新！',
    'greeting' => '您好 :merchant！',
    'message' => '您的商店配置已成功更新！單擊下面的按鈕以登錄商店管理面板。',
    'button_text' => '前往資訊主頁',
  ),
  'shop_down_for_maintainace' => 
  array (
    'subject' => '您的商店倒閉了！',
    'greeting' => '您好 :merchant！',
    'message' => '這是一條通知，通知您 :shop_name商店已關閉！在重新恢復營業之前，沒有客戶可以訪問您的商店。',
    'button_text' => '進入配置頁面',
  ),
  'shop_is_live' => 
  array (
    'subject' => '您的商店重新上線了！',
    'greeting' => '你好 :merchant',
    'message' => '這是一條通知，通知您 :shop_name商店已成功恢復正常運轉！',
    'button_text' => '前往資訊主頁',
  ),
  'shop_deleted' => 
  array (
    'subject' => '您的商店已從 :marketplace中刪除！',
    'greeting' => '你好商人！',
    'message' => '這是一條通知，通知您您的商店已從我們的標記處刪除！我們會想你的。',
  ),
  'system_is_down' => 
  array (
    'subject' => '您的市場 :marketplace現在下跌了！',
    'greeting' => '您好 :user！',
    'message' => '這是一條通知，讓您知道 :marketplace交易平台已關閉！在重新恢復運行之前，沒有客戶可以訪問您的市場。',
    'button_text' => '進入配置頁面',
  ),
  'system_is_live' => 
  array (
    'subject' => '您的 :marketplace交易平台重現活力！',
    'greeting' => '您好 :user！',
    'message' => '這是一條通知，通知您 :marketplace交易平台已成功恢復正常運行！',
    'button_text' => '前往資訊主頁',
  ),
  'system_info_updated' => 
  array (
    'subject' => ':marketplace-市場信息已成功更新！',
    'greeting' => '您好 :user！',
    'message' => '這是一條通知，通知您您的市場 :marketplace已成功更新！',
    'button_text' => '前往資訊主頁',
  ),
  'system_config_updated' => 
  array (
    'subject' => ':marketplace-市場配置成功更新！',
    'greeting' => '您好 :user！',
    'message' => '您的交易平台 :marketplace的配置已成功更新！單擊下面的按鈕登錄到管理面板。',
    'button_text' => '查看設定',
  ),
  'new_contact_us_message' => 
  array (
    'subject' => '通過與我們聯繫的形式發送新消息： :subject',
    'greeting' => '你好！',
    'message_footer_with_phone' => '您可以回复此電子郵件或直接聯繫此手機 :phone',
    'message_footer' => '您可以直接回复此電子郵件。',
  ),
  'ticket_acknowledgement' => 
  array (
    'subject' => '[票證ID： :ticket_id] :subject',
    'greeting' => '你好 :user',
    'message' => '這是一條通知，通知您我們已成功收到您的機票 :ticket_id！我們的支持團隊將盡快與您聯繫。',
    'button_text' => '查看門票',
  ),
  'ticket_created' => 
  array (
    'subject' => '新支持票[票證ID： :ticket_id] :subject',
    'greeting' => '你好！',
    'message' => '您已從供應商 :vendor收到新的支持憑單ID :ticket_id，發件人 :sender。審查並評估票證以支持團隊。',
    'button_text' => '查看門票',
  ),
  'ticket_assigned' => 
  array (
    'subject' => '剛剛分配給您的票證[票證IF： :ticket_id] :subject',
    'greeting' => '你好 :user',
    'message' => '這是一條通知，通知您票證[票證ID： :ticket_id] :subject剛剛向您提供。盡快檢查並答复票證。',
    'button_text' => '回复票',
  ),
  'ticket_replied' => 
  array (
    'subject' => ':user回复票證[票證ID： :ticket_id] :subject',
    'greeting' => '你好 :user',
    'message' => ':reply',
    'button_text' => '查看門票',
  ),
  'ticket_updated' => 
  array (
    'subject' => '工單[工單ID： :ticket_id] :subject已更新！',
    'greeting' => '您好 :user！',
    'message' => '您的一張支持憑單憑單ID＃：ticket_id :subject已更新。如果您需要任何幫助，請與我們聯繫。',
    'button_text' => '查看門票',
  ),
  'user_created' => 
  array (
    'subject' => ':admin將您添加到 :marketplace市場！',
    'greeting' => '恭喜 :user！',
    'message' => ' :admin已將您添加到 :marketplace！點擊下面的按鈕登錄您的帳戶。使用臨時密碼進行初始登錄。',
    'alert' => '登錄後不要忘記更改密碼。',
    'button_text' => '訪問您的個人資料',
  ),
  'user_updated' => 
  array (
    'subject' => '帳戶信息更新成功！',
    'greeting' => '您好 :user！',
    'message' => '這是一條通知，通知您您的帳戶已成功更新！',
    'button_text' => '訪問您的個人資料',
  ),
  'verdor_registered' => 
  array (
    'subject' => '新供應商剛剛註冊！',
    'greeting' => '恭喜你！',
    'message' => '您的市場 :marketplace剛得到一個新商戶，其商店名稱為<strong>：shop_name </ strong>，商家的電子郵件地址為 :merchant_email',
    'button_text' => '前往資訊主頁',
  ),
  'email_verification' => 
  array (
    'subject' => '驗證您的 :marketplace帳戶！',
    'greeting' => '恭喜 :user！',
    'message' => '您的帳戶已成功創建！點擊下面的按鈕以驗證您的電子郵件地址。',
    'button_text' => '驗證我的電子郵件',
  ),
  'dispute_solved' => 
  array (
    'subject' => '爭議[訂單ID： :order_id]已被標記為已解決！',
    'greeting' => '您好 :customer！',
    'message' => '訂單ID： :order_id的爭議已標記為已解決。感謝您與我們在一起。',
    'button_text' => '查看爭議',
  ),
);