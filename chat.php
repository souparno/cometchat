<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Chat</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <link rel="stylesheet" href="assets/css/bootstrap.css" media="screen">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/bootswatch.min.css">
        <script type="text/javascript" src="assets/js/prototype.js"></script>
        <script type="text/javascript" src="assets/js/engine.js"></script>
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
                    <div class="col-lg-12">
                        <div class="bs-example">
                            <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                                <li class="active">
                                    <a href="#home" data-toggle="tab">Chat <span class="badge" style="color: greenyellow">0</span></a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane fade active in" id="home">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <div class="row">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading"> </div>
                                                    <div class="panel-body" style="height:300px; overflow: auto;" id="content">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="well">
                                                    <form class="bs-example form-horizontal" action="" method="get" onsubmit="comet.doRequest();
                return false;">
                                                        <fieldset>
                                                            <div class="form-group">
                                                                <div class="col-lg-2">
                                                                    <input type="text" class="form-control" id="inputName" placeholder="Name" value="<?php echo isset($_GET["UserName"]) ? $_GET["UserName"] : ''; ?>" style="background: white" readonly="">
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" id="word" placeholder="Message">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary col-lg-1">Send</button> 
                                                            </div>
                                                        </fieldset>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="bs-example" id="online-users" style="height: 300px;overflow: auto">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>