
var OnlineUserCallBusy = 0;

var Comet = Class.create();
Comet.prototype = {
    timestamp: 0,
    url: './server.php',
    noerror: true,
    initialize: function() {
    },
    connect: function()
    {
        this.ajax = new Ajax.Request(this.url, {
            method: 'get',
            parameters: {'timestamp': this.timestamp},
            onSuccess: function(transport) {
                this.comet.callbackSuccess(transport);
            },
            onComplete: function() {
                this.comet.callbackComplete();
            }
        });
        this.ajax.comet = this;
    },
    callbackSuccess: function(transport) {
        // handle the server response
        var response = transport.responseText.evalJSON();
        this.timestamp = response['timestamp'];
        this.handleResponse(response);
        this.noerror = true;
    },
    callbackComplete: function() {
        var _instance = this;
        // send a new ajax request when this request is finished
        if (!this.noerror)
            // if a connection problem occurs, try to reconnect each 5 seconds
            setTimeout(function() {
                _instance.connect();
            }, 5000);
        else
            this.connect();
        this.noerror = false;
    },
    GetonlineUser: function() {

        if (OnlineUserCallBusy === 0) {

            OnlineUserCallBusy = 1;
            var usr = '';
            if (document.getElementById("inputName")) {
                usr = document.getElementById("inputName").value;
            }
            this.onlineUsers = new Ajax.Request('OnlineUsers.php', {
                method: 'get',
                parameters: {UserName: usr},
                onSuccess: function(transport) {
                    this.comet.onGetonlineUsersSuccess(transport);
                },
                onComplete: function() {
                    this.comet.onGetonlineUsersComplete();
                }
            });
            this.onlineUsers.comet = this;

        }

        var _instance = this;
        setTimeout(function() {
            _instance.GetonlineUser();
        }, 10000);


    },
    onGetonlineUsersSuccess: function(transport) {
        var response = transport.responseText.evalJSON();
        document.getElementById("online-users").innerHTML = response.usr;
    },
    onGetonlineUsersComplete: function() {
        OnlineUserCallBusy = 0;

    },
    handleResponse: function(response)
    {
        $('content').innerHTML += '<div>' + response['msg'] + '</div>';
        document.getElementById('content').scrollTop = document.getElementById('content').scrollHeight;
    },
    doRequest: function()
    {
        var UserName = document.getElementById("inputName").value;
        var request = document.getElementById("word").value;

        new Ajax.Request(this.url, {
            method: 'get',
            parameters: {'UserName': UserName, 'msg': request}});
        document.getElementById("word").value = "";

    }
};

var comet = new Comet();
comet.connect();
window.onload=function(){
   comet.GetonlineUser(); 
};


