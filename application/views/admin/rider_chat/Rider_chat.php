<style>
    .app span {
        height: 100%;
        width: 100%;
        overflow: hidden;
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    .fa-2x {
        font-size: 1.5em;
    }

    .app {
        position: relative;
        overflow: hidden;
        height: calc(100% - 38px);
        margin: auto;
        padding: 0;
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .06), 0 2px 5px 0 rgba(0, 0, 0, .2);
    }

    .app-one {
        background-color: #f7f7f7;
        height: 100%;
        overflow: hidden;
        margin: 0;
        padding: 0;
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .06), 0 2px 5px 0 rgba(0, 0, 0, .2);
    }

    .side {
        padding: 0;
        margin: 0;
        height: 100%;
    }

    .side-one {
        padding: 0;
        margin: 0;
        height: 100%;
        width: 100%;
        z-index: 1;
        position: relative;
        display: block;
        top: 0;
    }

    .heading {
        padding: 10px 16px 10px 15px;
        margin: 0;
        height: 60px;
        width: 100%;
        background-color: #eee;
        z-index: 1000;
    }

    .heading-avatar {
        padding: 0;
        cursor: pointer;

    }

    .heading-avatar-icon img {
        border-radius: 50%;
        height: 40px;
        width: 40px;
    }

    .heading-name {
        padding: 0 !important;
        cursor: pointer;
    }

    .heading-name-meta {
        font-weight: 700;
        font-size: 100%;
        padding: 5px;
        padding-bottom: 0;
        text-align: left;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: #000;
        display: block;
    }

    .heading-online {
        display: none;
        padding: 0 5px;
        font-size: 12px;
        color: #93918f;
    }

    .heading-compose {
        padding: 0;
    }

    .heading-compose i {
        text-align: center;
        padding: 5px;
        color: #93918f;
        cursor: pointer;
    }

    .heading-dot {
        padding: 0;
        margin-left: 10px;
    }

    .heading-dot i {
        text-align: right;
        padding: 5px;
        color: #93918f;
        cursor: pointer;
    }

    .searchBox {
        padding: 0 !important;
        margin: 0 !important;
        height: 60px;
        width: 100%;
    }

    .searchBox-inner {
        height: 100%;
        width: 100%;
        padding: 10px !important;
        background-color: #fbfbfb;
    }


    /*#searchBox-inner input {
    box-shadow: none;
    }*/

    .searchBox-inner input:focus {
        outline: none;
        border: none;
        box-shadow: none;
    }

    .sideBar {
        padding: 0 !important;
        margin: 0 !important;
        background-color: #fff;
        overflow-y: auto;
        border: 1px solid #f7f7f7;
        height: calc(600px - 120px);
    }

    .sideBar-body {
        position: relative;
        padding: 10px !important;
        border-bottom: 1px solid #f7f7f7;
        height: 72px;
        margin: 0 !important;
        cursor: pointer;
    }

    .sideBar-body:hover,
    .sideBar-body.active {
        background-color: #f2f2f2;
    }

    .sideBar-avatar {
        text-align: center;
        padding: 0 !important;
    }

    .avatar-icon img {
        border-radius: 50%;
        height: 49px;
        width: 49px;
    }

    .sideBar-main {
        padding: 0 !important;
    }

    .sideBar-main .row {
        padding: 0 !important;
        margin: 0 !important;
    }

    .sideBar-name {
        padding: 10px !important;
    }

    .name-meta {
        font-size: 100%;
        padding: 1% !important;
        text-align: left;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: #000;
    }

    .sideBar-time {
        padding: 10px !important;
    }

    .time-meta {
        text-align: right;
        font-size: 12px;
        padding: 1% !important;
        color: rgba(0, 0, 0, .4);
        vertical-align: baseline;
    }

    /*New Message*/

    .newMessage {
        padding: 0 !important;
        margin: 0 !important;
        height: 100%;
        position: relative;
        left: -100%;
    }

    .newMessage-heading {
        padding: 10px 16px 10px 15px !important;
        margin: 0 !important;
        height: 100px;
        width: 100%;
        background-color: #00bfa5;
        z-index: 1001;
    }

    .newMessage-main {
        padding: 10px 16px 0 15px !important;
        margin: 0 !important;
        height: 60px;
        margin-top: 30px !important;
        width: 100%;
        z-index: 1001;
        color: #fff;
    }

    .newMessage-title {
        font-size: 18px;
        font-weight: 700;
        padding: 10px 5px !important;
    }

    .newMessage-back {
        text-align: center;
        vertical-align: baseline;
        padding: 12px 5px !important;
        display: block;
        cursor: pointer;
    }

    .newMessage-back i {
        margin: auto !important;
    }

    .composeBox {
        padding: 0 !important;
        margin: 0 !important;
        height: 60px;
        width: 100%;
    }

    .composeBox-inner {
        height: 100%;
        width: 100%;
        padding: 10px !important;
        background-color: #fbfbfb;
    }

    .composeBox-inner input:focus {
        outline: none;
        border: none;
        box-shadow: none;
    }

    .compose-sideBar {
        padding: 0 !important;
        margin: 0 !important;
        background-color: #fff;
        overflow-y: auto;
        border: 1px solid #f7f7f7;
        height: calc(100% - 160px);
    }

    /*Conversation*/

    .conversation {
        padding: 0 !important;
        margin: 0 !important;
        height: 100%;
        /*width: 100%;*/
        border-left: 1px solid rgba(0, 0, 0, .08);
        /*overflow-y: auto;*/
    }

    .message {
        padding: 0 !important;
        margin: 0 !important;
        /* background: url("w.jpg") no-repeat fixed center; */
        background-size: cover;
        overflow-y: auto;
        border: 1px solid #f7f7f7;
        height: calc(500px - 120px);
        width: 100%;
    }

    .message-previous {
        margin: 0 !important;
        padding: 0 !important;
        height: auto;
        width: 100%;
    }

    .previous {
        font-size: 15px;
        text-align: center;
        padding: 10px !important;
        cursor: pointer;
    }

    .previous a {
        text-decoration: none;
        font-weight: 700;
    }

    .message-body {
        margin: 0 !important;
        padding: 0 !important;
        width: auto;
        height: auto;
    }

    .message-main-receiver {
        padding: 3px 20px !important;
        max-width: 60%;
    }

    .message-main-sender {
        padding: 3px 20px !important;
        margin-left: 40% !important;
        max-width: 60%;
    }

    .message-text {
        margin: 0 !important;
        padding: 5px !important;
        word-wrap: break-word;
        font-weight: 200;
        font-size: 14px;
        padding-bottom: 0 !important;
    }

    .message-time {
        margin: 0 !important;
        margin-left: 50px !important;
        font-size: 12px;
        text-align: right;
        color: #9a9a9a;

    }

    .receiver {
        width: auto !important;
        padding: 4px 10px 7px !important;
        border-radius: 10px 10px 10px 0;
        background: #ffffff;
        font-size: 12px;
        text-shadow: 0 1px 1px rgba(0, 0, 0, .2);
        word-wrap: break-word;
        display: inline-block;
    }

    .sender {
        float: right;
        width: auto !important;
        background: #dcf8c6;
        border-radius: 10px 10px 0 10px;
        padding: 4px 10px 7px !important;
        font-size: 12px;
        text-shadow: 0 1px 1px rgba(0, 0, 0, .2);
        display: inline-block;
        word-wrap: break-word;
    }


    /*Reply*/

    .reply {
        height: 60px;
        width: 100%;
        background-color: #f5f1ee;
        padding: 10px 5px 10px 5px !important;
        margin: 0 !important;
        z-index: 1000;
    }

    .reply-emojis {
        padding: 5px !important;
    }

    .reply-emojis i {
        text-align: center;
        padding: 5px 5px 5px 5px !important;
        color: #93918f;
        cursor: pointer;
    }

    .reply-recording {
        padding: 5px !important;
    }

    .reply-recording i {
        text-align: center;
        padding: 5px !important;
        color: #93918f;
        cursor: pointer;
    }

    .reply-send {
        padding: 5px !important;
    }

    .reply-send i {
        text-align: center;
        padding: 5px !important;
        color: #93918f;
        cursor: pointer;
    }


    .reply-main textarea {
        width: 100%;
        resize: none;
        overflow: hidden;
        padding: 5px !important;
        outline: none;
        border: none;
        text-indent: 5px;
        box-shadow: none;
        height: 100%;
        font-size: 16px;
    }

    .reply-main textarea:focus {
        outline: none;
        border: none;
        text-indent: 5px;
        box-shadow: none;
    }
</style>
<div class="page-content">
    <div class="page-heading">
        <h1>Chat With Rider</h1>
        <small>
            <ol class="breadcrumb">
                <li><a href="<?= base_url(); ?><?= ADMINFOLDER; ?>dashboard">Dashboard</a></li>
                <li class="active">Rider Chat</li>
            </ol>
        </small>
    </div>

    <div class="container-fluid">

        <main class="content">
            <div class="app">
                <div class="app-one">
                    <div class="col-sm-4 side">
                        <div class="side-one">

                            <!-- <div class="row searchBox">
                                <div class="col-sm-12">
                                    <div class="form-group has-feedback">
                                        <input id="searchText" type="text" class="form-control" name="searchText" placeholder="Search Rider">
                                    </div>
                                </div>
                            </div> -->

                            <div class="row sideBar" id="riderlist">
                                <?php /* if(!empty($riderslist)){
                                    foreach($riderslist as $rider){ ?>
                                        <div class="row sideBar-body">
                                            <div class="col-sm-3 col-xs-3 sideBar-avatar">
                                                <div class="avatar-icon">
                                                    <img src="<?=DOMAIN_URL?>assets/image/userprofile/noimage.png">
                                                </div>
                                            </div>
                                            <div class="col-sm-9 col-xs-9 sideBar-main">
                                                <div class="row">
                                                    <div class="col-sm-8 col-xs-8 sideBar-name">
                                                        <span class="name-meta"><?=$rider['kitchenname']?></span>
                                                    </div>
                                                    <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                                                        <span class="time-meta pull-right">18:18</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                } */ ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-8 conversation">
                        <div id="chatbox"></div>
                    </div>
                </div>
            </div>
        </main>

    </div> <!-- .container-fluid -->
</div> <!-- #page-content -->