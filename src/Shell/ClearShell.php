<?php
namespace App\Shell;

use Cake\Console\Shell;

/**
 * Clear shell command.
 */
class ClearShell extends Shell
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Dishes');
    }

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();
        $parser->addOption('yes', [
            'short' => 'y',
            'help' => 'All is yes',
            'boolean' => true,
        ]);
        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        if(!$this->params['yes'])
        {
            $ans = $this->in('Are you sure to clear db?', ['y', 'n'], 'n');
            if($ans == 'n') return;
        }
        $this->out('Clear!');
        $this->Dishes->deleteAll('1 = 1', false);
    }
}
