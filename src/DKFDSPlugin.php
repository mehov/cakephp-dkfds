<?php

namespace Bakeoff\DKFDS;

use Cake\Console\CommandCollection;

class DKFDSPlugin extends \Cake\Core\BasePlugin
{

    /**
     * Plugin name.
     *
     * @var string
     */
    protected ?string $name = 'dkfds';

    public function console(CommandCollection $commands): CommandCollection
    {
        return $commands
            ->add('dkfds install', \Bakeoff\DKFDS\Command\InstallCommand::class)
            ;
    }

}
