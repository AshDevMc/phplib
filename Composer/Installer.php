<?php namespace phplib\Composer;

class MyInstaller implements \Composer\Installer\InstallerInterface 
{
	/**
     * @inheritDoc
     */
    public function getInstallPath(\Composer\Package\PackageInterface $package)
    {
        return "";
    }

    /**
     * @inheritDoc
     */
    public function supports($packageType)
    {
        return "ashmcdev-library" === $packageType;
    }
}
}

?>