<?php

namespace BrainMaestro\GitHooks\Commands;

use BrainMaestro\GitHooks\Hook;
use BrainMaestro\GitHooks\Commands\AddCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateCommand extends AddCommand
{
    protected function configure()
    {
        $this
            ->setName('update')
            ->setDescription('Update git hooks specified in the composer config')
            ->setHelp('This command allows you to update git hooks')
            ->addOption('git-dir', 'g', InputOption::VALUE_REQUIRED, 'Path to git directory', '.git')
            ->addOption('force-win', null, InputOption::VALUE_NONE, 'Force windows bash compatibility')
            ->addOption('global', null, InputOption::VALUE_NONE, 'Update global git hooks')
        ;
    }

    protected function init($input)
    {
        $this->windows = $input->getOption('force-win') || is_windows();
        $this->force = true;
        $this->noLock = true;
        $this->ignoreLock = false;
    }

    protected function command()
    {
        if (empty($this->dir)) {
            if ($this->global) {
                $this->error('You need to run the add command globally first before you try to update');
            } else {
                $this->error('You did not specify a git directory to use');
            }

            return;
        }

        parent::command();
    }
}
