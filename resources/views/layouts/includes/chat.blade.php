<div id="smsaero-chat" style="display: block;">
    <div id="toggle-chat">
        <div class="icon-chat">
            <i class="fa fa-comments-o" aria-hidden="true"></i>
        </div>
        <div class="title-chat">
            <span>Есть вопрос? Напишите нам!</span>
        </div>
    </div>

    <div id="body-chat">
        <button id="close-chat" title="Скрыть чат" type="button" class="mfp-close">×</button>
        <div id="loader-chat" title="Чат загружается, пожалуйста подождите" style="display: none;">
            <div id="spinner"></div>
        </div>
        <div class="header-chat">
            <div class="support-avatar">
                <img id="support-avatar" src="data:image/png;base64,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">
            </div>
            <div class="online-circle" title="Специалист готов ответить на ваши вопросы"></div>
            <div class="support-name">
                <div id="support-name">Александр</div>
                <div class="support-position">специалист Поддержки</div>
                <div id="user-write" style="display: none">Печатает<span id="write-animation">..</span></div>
            </div>
        </div>

        <div class="container-text-area">
            <div id="text-area">
                <div id="empty-messages-history-text">Нет сообщений</div>
            </div>
        </div>

        <div id="message-enter">
            <div id="add-file" title="Прикрепить файл">
                <i class="fa fa-paperclip" id="icon-chat-file" aria-hidden="true"></i>
                <input type="file" id="chat-file">
            </div>

            <div class="container-message-texarea">
                <textarea maxlength="2000" id="message-textarea" style="overflow: hidden; overflow-wrap: break-word;"></textarea>
            </div>

            <div id="send-button" title="Отправить сообщение">
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 486.736 486.736" style="enable-background:new 0 0 486.736 486.736;" xml:space="preserve"><g><path d="M481.883,61.238l-474.3,171.4c-8.8,3.2-10.3,15-2.6,20.2l70.9,48.4l321.8-169.7l-272.4,203.4v82.4c0,5.6,6.3,9,11,5.9
                l60-39.8l59.1,40.3c5.4,3.7,12.8,2.1,16.3-3.5l214.5-353.7C487.983,63.638,485.083,60.038,481.883,61.238z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
            </div>
        </div>

    </div>
</div>

<style>
    #user-write{
        position: absolute;
        font-size: 11px;
        top: 35px;
        left: 0;
    }

    .support-name{
      position: relative;
    }

    #smsaero-chat .file-container{
        display: flex;
        margin-bottom: 5px;
        align-items: center;
        color: #0f151a;
        text-decoration: none;
    }

    #smsaero-chat .file-block{
        margin-right: 10px;
        font-size: 33px;
    }

    #smsaero-chat .file-data{
        text-align: left;
    }

    #smsaero-chat .file-size{
        font-size: 9px;
        line-height: 9px;
        color: #8E8E8E;
    }

    #smsaero-chat .file-size .status-del{
        color: #1b80af;
    }

    #smsaero-chat .file-name{
        color: #36bed9;
        text-decoration: underline;
        overflow: hidden;
        max-width: 125px;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    #smsaero-chat .file-name:hover{
        color: #49d6f2;
    }

    #chat-file{
        display: none;
    }

    #load-more{
        color: #36bed9;
        text-align: center;
        font-size: 11px;
        cursor: pointer;
    }

    #empty-messages-history-text{
        width: 100%;
        text-align: center;
        font-size: 13px;
        color: #8e8e8e;
    }

    #message-enter{
        margin-top: 26px;
        display: flex;
        align-items: center;
    }

    /*input[type=email],
    input[type=password],
    input[type=search],
    input[type=tel],
    input[type=text],*/
    textarea {
        -webkit-appearance: none;
        box-sizing: border-box;
        height: 40px;
        padding: 10px;
        font-size: 15px;
        line-height: 20px;
        color: #0f151a;
        border-radius: 20px;
        border: 0;
        background: #f2f4f6;
        outline: 0;
        width: auto;
        max-width: 100%;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
        /*margin-bottom: 10px;*/
        /*box-shadow: inset 0 2px 0 #d3dae1;*/
        height: auto;
        resize: none;
    }

    #message-textarea{
        margin-bottom: 0;
        width: 230px;
        font-size: 13px;
        line-height: 13px;
        height: 33px;
        max-height: 215px;
        box-shadow: inset 0 2px 0 #d3dae1;
    }

    .container-message-texarea{
        position: relative;
        height: 33px;
    }

    .container-text-area{
        height: 270px;
    }

    #text-area .message-text{
        white-space: pre-line;
        word-wrap: break-word;
    }

    #phantom-message-texarea{
        width: 230px;
        font-size: 13px;
        line-height: 13px;
        min-height: 33px;
        -webkit-appearance: none;
        box-sizing: border-box;
        padding: 10px;
        font-family: ubunturegular;
        color: #0f151a;
        border-radius: 20px;
        border: 0;
        background: #f2f4f6;
        outline: 0;
        max-width: 100%;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 10px;
        box-shadow: inset 0 2px 0 #d3dae1;
        white-space: pre-line;
        word-wrap: break-word;
    }

    #text-area{
        margin-top: 20px;
        border-top: 1px solid #d3dae1;
        border-bottom: 1px solid #d3dae1;
        padding: 10px 5px;
        height: 271px;
        overflow: hidden;
        overflow-y: auto;
    }

    #add-file,
    #send-button{
        margin: 5px;
        width: 20px;
        text-align: center;
        cursor: pointer;
    }

    #add-file .fa {
        font-size: 18px;
    }

    #send-button{
        width: 28px;
        height: 28px;
        fill: #656464;
    }

    .online-circle{
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background: #7eb336;
        margin-right: 10px;
    }

    #smsaero-chat{
        position: fixed;
        right: 10px;
        bottom: 65px;
        display: none;
        z-index: 5;
    }

    @media print {
        #smsaero-chat {
            display: none!important;
        }
    }

    #body-chat{
        background: #ffffff;
        box-sizing: content-box;
        display: none;
        width: 300px;
        height: 400px;
        position: relative;
        padding: 20px;
        box-shadow: 0 7px 21px rgba(83, 92, 105, 0.12), 0 -1px 6px 0 rgba(83, 92, 105, 0.06)
    }

    .message-container{
        display: inline-block;
        width: 100%;
        box-sizing: border-box;
        margin-bottom: 10px;
    }

    .message-container:last-child{
        margin-bottom: 0;
    }

    .message-time{
        font-size: 9px;
        line-height: 9px;
        color: #8E8E8E;
        text-align: right;
        user-select: none;
    }

    .message-user{
        float: right;
        background: #f2f4f6;
    }

    .message.file{
        background: none;
    }

    .message-support{
        float: left;
        background: #1b80af;
        color: #ffffff;
    }

    .message-support .link{
        color: #ffffff;
    }

    .message-support .message-time{
        color: #ffffff;
    }

    .message-support.file .message-time{
        color: #8E8E8E;
    }

    #smsaero-chat .message{
        padding: 10px;
        border-radius: 10px;
        max-width: 225px;
        font-size: 13px;
    }

    #close-chat{
        color: #d9dfe5;
        z-index: 2;
    }

    button.mfp-arrow, button.mfp-close {
        overflow: visible;
        cursor: pointer;
        background: 0 0;
        border: 0;
        -webkit-appearance: none;
        display: block;
        outline: 0;
        padding: 0;
        z-index: 1046;
        box-shadow: none;
        touch-action: manipulation;
    }
    .mfp-close {
        width: 44px;
        height: 44px;
        line-height: 44px;
        right: 0;
        top: 0;
        text-decoration: none;
        opacity: .65;
        padding: 0 0 18px 10px;
        font-style: normal;
        font-size: 28px;
        font-family: Arial,Baskerville,monospace;
    }
    .mfp-close, .mfp-preloader {
        text-align: center;
        position: absolute;
    }
    .mfp-close:focus, .mfp-close:hover {
        opacity: 1;
    }
    .mfp-close:active {
        top: 1px;
    }

    .header-chat{
        display: flex;
        align-items: center;
    }

    #support-name{
        font-size: 17px;
        line-height: 21px;
        color: #0f151a;
    }

    .support-position{
        color: #5d6978;
        font-size: 13px;
    }

    #smsaero-chat .support-avatar{
        margin-right: 10px;
        border-radius: 50%;
        overflow: hidden;
        box-sizing: border-box;
        width: 40px;
        height: 40px;

    }

    #support-avatar{
        width: 40px;
        height: 40px;
    }

    #loader-chat{
        width: 100%;
        display: none;
        height: 100%;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
        background: #ffffff;
    }

    #spinner{
        display: block;
        width: 128px;
        height: 128px;
        background-image: url(/cabinet/assets/images/preloader.gif);
    }

    #toggle-chat{
        display: flex;
        align-items: center;
    }

    #smsaero-chat .icon-chat{
        width: 50px;
        height: 50px;
        border-radius: 50%;
        color: #1b80af;
        border: 2px solid #1b80af;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
        box-sizing: border-box;
        z-index: 2;
        cursor: pointer;
    }

    #smsaero-chat .icon-chat .fa-comments-o{
        font-size: 26px;
    }

    #smsaero-chat .title-chat{
        font-size: 13px;
        height: 40px;
        color: #ffffff;
        background: #1b80af;
        padding: 0 30px 0 45px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
        margin-left: -30px;
        cursor: pointer;
        user-select: none;
    }

    /*#smsaero-chat:active .icon-chat{
        color: #d9213f;
        border-color: #d9213f;
    }

    #smsaero-chat:active .title-chat{
        background: #d9213f;
    }*/

    /* width */
    #text-area::-webkit-scrollbar {
        width: 6px;
    }

    /* Track */
    #text-area::-webkit-scrollbar-track {
        background: #f1f1f1;
        display: none;
    }

    /* Handle */
    #text-area::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    #text-area::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    #message-textarea::-webkit-scrollbar {
        width: 6px;
    }

    /* Track */
    #message-textarea::-webkit-scrollbar-track {
        background: #f1f1f1;
        display: none;
    }

    /* Handle */
    #message-textarea::-webkit-scrollbar-thumb {
        background: #888;

    }

    /* Handle on hover */
    #message-textarea::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    @media screen and (max-width: 639px){
        #smsaero-chat .title-chat{
            display: none;
        }
    }
</style>
