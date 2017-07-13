<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Datasource\ConnectionManager;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Clean shell command.
 */
class CleanShell extends Shell
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
            $ans = $this->in('Are you sure to clean dishes?', ['y', 'n'], 'n');
            if($ans == 'n') return;
        }
        $connection = ConnectionManager::get('default');
        $connection->execute('SET foreign_key_checks = 0;');
        $connection->execute('TRUNCATE TABLE dishes');
        $connection->execute('TRUNCATE TABLE users');
        $connection->execute('SET foreign_key_checks = 1;');

        $imgdir = new Folder($path = WWW_ROOT . 'img/dish');
        $imgs = $imgdir->find('.*\.(jpg|png)', false);
        foreach($imgs as $img) {
            $file = new File(sprintf("%s/%s", $path, $img));
            $file->delete();
        }
    }
}
