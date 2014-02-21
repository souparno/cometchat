<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Chat</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <link rel="stylesheet" href="assets/css/bootstrap.css" media="screen">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/bootswatch.min.css">

    </head>
    <body>

        <div class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="../" class="navbar-brand">Tree Frog</a>
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="bs-docs-section">
                <div class="row">
                    <div class="well">
                        <form class="bs-example form-horizontal">
                            <fieldset>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <center>
                                            <h3>Welcome to Tree Frog Chat</h3>
                                        </center>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="well">
                        <form class="bs-example form-horizontal">
                            <fieldset>
                                <div class="form-group">
                                    <div class="col-lg-9">
                                        <form>
                                            <input type="text" class="form-control" name="UserName" placeholder="Choose a Name" value="<?php echo isset($_GET["UserName"]) ? $_GET["UserName"] : ''; ?>">
                                            </div>
                                            <div class="col-lg-3">
                                                <button type="submit" class="btn btn-primary col-lg-4">Join</button>
                                        </form>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php

        class CheckUser {

            protected $cachedir;     // Gets the cache directory name
            protected $cachefile;    // Gets the cache file name
            protected $cachefileName;
            protected $UserName;

            public function __construct() {
                $this->cachedir = realpath(dirname(__FILE__)) . '/assets/db/';
                $this->cachefile = "OnlineUsers.txt";
                $this->cachefileName = $this->cachedir . $this->cachefile;
                $this->UserName = isset($_GET['UserName']) ? $_GET['UserName'] : '';
            }

            public function CheckName() {

                $user_present = $this->RefreshUsers(json_decode(file_get_contents($this->cachedir . $this->cachefile), true));
                if ($user_present == 1) {
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="bs-example">
                                <div class="alert alert-dismissable alert-warning">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <p>Name all ready Taken...Give another try... :).</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    header("Location: chat.php?UserName=" . $this->UserName);
                    exit();
                }
            }

            // returns array with online users in chat, in last "cachetime" sec.
            protected function RefreshUsers($users) {

                $flag = 0;
                if (count($users) > 0) {
                    foreach ($users as $usr) {
                        if ($usr == $this->UserName) {
                            $flag = 1;
                            break;
                        }
                    }
                }
                return $flag;
            }

        }

        if (isset($_GET['UserName'])) {
            $usr = new CheckUser();
            $usr->CheckName();
        }
        ?>
    </body>
</html>