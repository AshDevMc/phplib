<?php namespace phplib\Composer;

class MyPlugin implements \Composer\Plugin\PluginInterface 
{
	public function activate(\Composer\Composer $composer, \Composer\IO\IOInterface $io)
    {
        $installer = new MyInstaller($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }
}

?>