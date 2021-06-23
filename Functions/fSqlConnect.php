<?php
namespace eBOSS\Functions;

class fSqlConnect
{
    protected $vIsConnected;

    /**
     * fSqlConnect constructor.
     * @param $ServerName: Tên Server
     * @param $UserName: Tài khoản đăng nhập Server
     * @param $Password: Mật khẩu đăng nhập Server
     * @param $DatabaseName: Tên Database
     * @param false $IsSystem: Dữ liệu System
     */
    public function __construct(string $ServerName = null, string $UserName = null, $Password = null, $DatabaseName = null, bool $IsSystem = false)
    {
        if ($ServerName == null){
            $CurrentServerName = null;
            $CurrentUserName = null;
            $CurrentPassword = null;
            $TempDatabaseName = null;
            if ($IsSystem)
                $CurrentDatabase = $TempDatabaseName.'_System';
            else
                $CurrentDatabase = $TempDatabaseName;
        }else{
            $CurrentServerName = $ServerName;
            $CurrentUserName = $UserName;
            $CurrentPassword = $Password;
            if ($IsSystem)
                $CurrentDatabase = $DatabaseName.'_System';
            else
                $CurrentDatabase = $DatabaseName;
        }

        $ConnectionInfo = array("Database" => (string)$CurrentDatabase, "UID" => (string)$CurrentUserName, "PWD" => (string)$CurrentPassword, "CharacterSet" => "UTF-8");
        $this->vIsConnected = sqlsrv_connect((string)$CurrentServerName, $ConnectionInfo);
    }

    /**
     * @return false|resource: Kểm tra kết nối
     */
    public function IsConnected(){
        return $this->vIsConnected;
    }

    /**
     * Ngắt kết nối Sql Server
     */
    public function Disconnect(){
        sqlsrv_close($this->vIsConnected);
    }
}