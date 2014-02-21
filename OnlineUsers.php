<?php

class OnlineUsers_Server {

    protected $cachedir;     // Gets the cache directory name
    protected $cachefile;    // Gets the cache file name
    protected $cachetime;    // Gets the cache time
    protected $cachefileName;

    public function __construct() {

        $this->cachedir = realpath(dirname(__FILE__)) . '/assets/db/';
        $this->cachefile = "OnlineUsers.txt";
        $this->cachefileName = $this->cachedir . $this->cachefile;
        $this->cachetime = 60;
        $this->UserName = isset($_GET['UserName']) ? $_GET['UserName'] : '';
    }

    protected function GetOnlineUsers() {

        $users = $this->RefreshUsers(json_decode(file_get_contents($this->cachedir . $this->cachefile), true));
        file_put_contents($this->cachedir . $this->cachefile, json_encode($users));
        $onlineUsers = "<ul class='list-group'>";
        foreach ($users as $usr) {
            $onlineUsers = $onlineUsers . "<li class='list-group-item'>" . $usr . "<span class='badge' style='background-color: greenyellow;color: greenyellow'>.</span></li>";
        }
        $onlineUsers = $onlineUsers . "</ul>";
        return $onlineUsers;
    }

    // returns array with online users in chat, in last "cachetime" sec.
    protected function RefreshUsers($users) {
        $regtime = time();
        $reusr = array();

        // if users, traverses the arrsy and stores the users in last 7 sec.
        if (count($users) > 0) {
            foreach ($users as $t => $usr) {
                if ($usr == $this->UserName)
                    continue;
                else if ($this->cachetime > ($regtime - intval($t)))
                    $reusr[$t] = $usr;
            }
        }

        // adds current user in list
        if ($this->chatuser !== '')
            $reusr[$regtime] = $this->UserName;
        return array_unique($reusr);
        ;
    }

    // starts a service for the particular user
    private function Service() {
        $response = array();
        $response["usr"] = $this->GetOnlineUsers();
        echo json_encode($response);
        flush();
    }

    public function run() {
        if ($this->UserName == '')
            die();
        $this->Service();
    }

}

$server = new OnlineUsers_Server();
$server->run();
?>
