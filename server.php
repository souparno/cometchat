<?php

Class Server {

    protected $chatdir;      // Gets the chat_db directory name
    protected $chatfile;     // Gets the chat_db file name
    protected $filename;     // Gets the path of the chat_db
    protected $lastModified;
    protected $UserName;
    protected $msg;

    public function __construct() {
        $this->chatdir = realpath(dirname(__FILE__)) . '/assets/db/';
        $this->chatfile = 'data.txt';
        $this->filename = $this->chatdir . $this->chatfile;
        $this->lastModified = isset($_GET['timestamp']) ? $_GET['timestamp'] : 0;
        $this->UserName = isset($_GET['UserName']) ? $_GET['UserName'] : '';
        $this->msg = isset($_GET['msg']) ? $_GET['msg'] : '';
    }

    //A daemon is a long-running background process that answers requests for services
    private function Daemon() {
        $currentmodif = filemtime($this->filename);
        while ($currentmodif <= $this->lastModified) { // check if the data file has been modified
            usleep(10000); // sleep 10ms to unload the CPU
            clearstatcache();
            $currentmodif = filemtime($this->filename);
        }
        return $currentmodif;
    }

    // starts a service for the particular user
    private function Service() {

        $currentmodif = $this->Daemon();
        $data = json_decode(file_get_contents($this->filename), true);
        $response = array();
        $response['msg'] = "<blockquote>
                        <p>" . $data["UserName"] . "</p>
                        <small>" . $data["msg"] . " (<cite>" . $data["time"] . "</cite>)</small>
                        </blockquote>";
        $response['timestamp'] = $currentmodif;
        echo json_encode($response);
        flush();
    }

    public function run() {
        if ($this->UserName != '' && $this->msg != '') {
            file_put_contents($this->filename, json_encode(
                            array('time' => date("F j, Y, g:i a"),
                                'UserName' => $this->UserName,
                                'msg' => $this->msg)));
            die();
        }
        $this->Service();
    }

}

$server = new Server();
$server->run();
?>


