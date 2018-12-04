<?php


class FastSetup
{
	public function __construct( $path = '' )
	{
		$this->path = $path;
		$this->db_pwd = utils::GetConfig()->Get('db_pwd');
	}

	public function run ()
    {

    }

    public function init ()
    {
        $sDirPath = $this->path . '/toolkit';
        if ( is_dir($sDirPath) )
        {
            echo "Toolkit already exists. No need to init.";
            exit();
        }
        else
        {
            mkdir($sDirPath);

        }
    }

    public function generate ()
    {
        $sInstall = $this->get_last_install();
        echo "fsqdffqdsfqdsf";
        if ( $sInstall != null )
        {
            $sContent = file_get_contents($sInstall);
            $sContent = $this->replace_db_password($sContent);
            file_put_contents($this->path . '/toolkit/default-params.xml', $sContent);
        }
        else
        {
            // TODO:
            return null;
        }
    }

    public function replace_db_password ( $sContent )
    {
        $sContent = str_replace(
            '**removed**',
            $this->db_pwd,
            $sContent
        );
        return $sContent;
    }

    public function get_last_install ()
    {
        $aInstall = glob($this->path . '/log/install-*.xml');
        if ( count($aInstall) > 0 )
        {
            return $aInstall[ count($aInstall) - 1 ];
        }
        else
        {
            return null;
        }
    }
}

$path = $argv[1];

if ( !include_once( $path . '/approot.inc.php') )
{
    echo "Fail to load approot. Please run this command in iTop directory\n";
    exit(1);
}

if ( !include_once( $path . '/application/application.inc.php'))
{
	echo "Fail to load application base. Please run this command in iTop directory\n";
	exit(1);
}


$oFastSetup = new FastSetup($path);
$oFastSetup->generate();
