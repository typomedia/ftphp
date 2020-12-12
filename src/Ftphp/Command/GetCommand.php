<?php

namespace Ftphp\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Touki\FTP\Connection\Connection;
use Touki\FTP\Exception\ConnectionEstablishedException;
use Touki\FTP\Exception\ConnectionException;
use Touki\FTP\Exception\ConnectionUnestablishedException;
use Touki\FTP\FTPWrapper;

class GetCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('get')
            ->setDescription('Downloads a file')
            ->setHelp('This command downloads a file from ftp...')
            ->addOption(
                'address',
                'a',
                InputOption::VALUE_REQUIRED,
                'Server address'
            )
            ->addOption(
                'username',
                'u',
                InputOption::VALUE_REQUIRED,
                'Username'
            )
            ->addOption(
                'password',
                'p',
                InputOption::VALUE_REQUIRED,
                'Password'
            )
            ->addArgument(
                'remotefile',
                InputArgument::REQUIRED,
                'File on FTP server'
            )
            ->addArgument(
                'localfile',
                InputArgument::OPTIONAL,
                'File in local filesystem'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $options = $input->getOptions();
        $arguments = $input->getArguments();

        $output->writeln($this->getApplication()->getName() .  '@' . $this->getApplication()->getVersion() . ' by Typomedia Foundation, Philipp Speck');

        $connection = new Connection($options['address'], $options['username'], $options['password']);
        $ftpwrapper = new FTPWrapper($connection);

        try {
            $connection->open();

            $output->writeln('<info>Downloading ' . $arguments['remotefile'] . '...</info>');
            $ftpwrapper->get($arguments['localfile'] ?: $arguments['remotefile'], $arguments['remotefile']);

            try {
                $connection->close();
            } catch (ConnectionUnestablishedException $e) {
                $output->writeln('<error>' . $e->getMessage() . '</error>');
            }
        } catch (ConnectionEstablishedException $e) {
            print $e->getMessage();
        } catch (ConnectionException $e) {
            print $e->getMessage();
        }
    }
}
