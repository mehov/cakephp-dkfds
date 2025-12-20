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
        // Make InstallCommand aware of the plugin
        $this->pluginClass = \Bakeoff\DKFDS\DKFDSPlugin::class;
        $this->plugin = new $this->pluginClass();
        $this->pluginWebroot = $this->plugin->getPath() . 'webroot';
        // (Re-)Link our webroot to dkfds/dkfds dist
        $this->unlinkWebroot($io);
        $this->linkWebroot($io);
        $io->out();
        $io->success('Installation completed.');
        return static::CODE_SUCCESS;
    }

    /**
     * Unlinks webroot in this plugin, if exists and is a symlink
     *
     * @param \Cake\Console\ConsoleIo $io The console io.
     * @return void
     */
    public function unlinkWebroot(ConsoleIo $io): void
    {
        if (is_link($this->pluginWebroot)) {
            unlink($this->pluginWebroot);
        }
    }

    /**
     * Links this plugin webroot to dkfds/dkfds dist
     *
     * @param \Cake\Console\ConsoleIo $io The console io.
     * @return void
     */
    public function linkWebroot(ConsoleIo $io): void
    {
        // Actual path to dkfds/dkfds dist folder
        $vendor = \dirname(\CORE_PATH, 2);
        $target = $vendor . '/dkfds/dkfds/dist';
        $io->info(sprintf('Pointing %s webroot to dkfds/dkfds dist ...', $this->pluginClass));
        $io->info(sprintf('  %s -> %s', $target, $this->pluginWebroot));
        $result = @symlink($target, $this->pluginWebroot);
        if (!$result) {
            $io->error('... failed.');
            $this->abort($result);
        }
    }

}
