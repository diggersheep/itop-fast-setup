<?php

class FastSetup
{
	public function __construct( $path = '' )
	{
		$this->path = $path;
	}
}


$path = getcwd();

/*
if ( !@include_once $path . '/application/' )
{
	echo "Fail to load application base. Please run this command in iTop directory\n";
	exit(1);
}
*/

$oFastSetup = new FastSetup($path);

echo $oFastSetup->path;
echo "\n";


