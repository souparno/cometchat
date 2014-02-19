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
<script type="text/javascript">
 var Comet = Class.create();
  Comet.prototype = {
 
    timestamp: 0,
    url: './server.php',
    noerror: true,
 
    initialize: function() { },
 
    connect: function()
    {
      this.ajax = new Ajax.Request(this.url, {
        method: 'get',
        parameters: { 'timestamp' : this.timestamp },
        onSuccess: function(transport) {
          // handle the server response
          var response = transport.responseText.evalJSON();
          this.comet.timestamp = response['timestamp'];
          this.comet.handleResponse(response);
          this.comet.noerror = true;
        },
        onComplete: function(transport) {
          // send a new ajax request when this request is finished
          if (!this.comet.noerror)
            // if a connection problem occurs, try to reconnect each 5 seconds
            setTimeout(function(){ comet.connect(); }, 5000); 
          else
            this.comet.connect();
          this.comet.noerror = false;
        }
      });
      this.ajax.comet = this;
    },
 
    disconnect: function()
    {
    },
 
    handleResponse: function(response)
    {
      $('content').innerHTML += '<div>' + response['msg'] + '</div>';
      document.getElementById('content').scrollTop = document.getElementById('content').scrollHeight;
    },
 
    doRequest: function(UserName,request)
    {
      var  UserName=document.getElementById("inputName").value;
      var request=document.getElementById("word").value;
      
      new Ajax.Request(this.url, {
        method: 'get',
        parameters: {'UserName':UserName , 'msg' : request }});
        document.getElementById("word").value="";
       
    }

    
  };

  var comet = new Comet();
  comet.connect();
  </script>
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
                    <a href="#home" data-toggle="tab">Chat <span class="badge">0</span></a>
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
              <form class="bs-example form-horizontal" action="" method="get" onsubmit="comet.doRequest();return false;">
                <fieldset>
                  <div class="form-group">
                    <div class="col-lg-2">
                      <input type="text" class="form-control" id="inputName" placeholder="Name">
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
                 <div class="bs-example">
              <ul class="list-group">
                <li class="list-group-item">
                  Cras justo odio
                </li>
                <li class="list-group-item">
                  Dapibus ac facilisis in
                </li>
                <li class="list-group-item">
                  Morbi leo risus
                </li>
              </ul>
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