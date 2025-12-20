<?php

namespace Bakeoff\DKFDS\Command;

use Cake\Console\ConsoleIo;

class InstallCommand extends \Cake\Command\Command
{

    use \Cake\Command\PluginAssetsTrait;

    /**
     * @inheritDoc
     */
    public function execute(\Cake\Console\Arguments $args, ConsoleIo $io): ?int
    {
        // Fix '$io must not be accessed before initialization'
        $this->io = $io;

        // Make this class aware of the plugin we're in
        $this->pluginClass = \Bakeoff\DKFDS\DKFDSPlugin::class;
        $this->plugin = new $this->pluginClass();

        // Debug output
        $io->info(sprintf('Installing %s', $this->plugin->getName()));

        /*
         * (Re-)Link our plugin webroot to dkfds/dkfds dist folder
         */
        // First, remove existing link, if any
        $this->_remove(['namespaced' => false, 'destDir' => $this->plugin->getPath(), 'link' => 'webroot']);
        // Point our plugin webroot to dkfds/dkfds dist folder
        $vendor = \dirname(\CORE_PATH, 2);
        $dkfds_dist = $vendor . '/dkfds/dkfds/dist';
        $plugin_webroot = $this->plugin->getPath() . 'webroot';
        $result = $this->_createSymlink($dkfds_dist, $plugin_webroot);
        if (!$result) {
            $io->abort("Failed creating symlink\n  TARGET $dkfds_dist\n  LINK $plugin_webroot");
            return static::CODE_ERROR;
        }

        /*
         * (Re-)Link our plugin webroot to app webroot
         */
        // First, remove existing link, if any
        $this->_remove(['namespaced' => false, 'destDir' => WWW_ROOT, 'link' => $this->plugin->getName()]);
        // Create a shortcut to this plugin webroot in main app webroot
        $app_webroot_plugin = WWW_ROOT . $this->plugin->getName();
        $result = $this->_createSymlink($plugin_webroot, $app_webroot_plugin);
        if (!$result) {
            $io->abort("Failed creating symlink\n  TARGET $plugin_webroot\n  LINK $app_webroot_plugin");
            return static::CODE_ERROR;
        }

        $io->success(sprintf('Installing %s completed', $this->plugin->getName()));
        return static::CODE_SUCCESS;
    }

}
