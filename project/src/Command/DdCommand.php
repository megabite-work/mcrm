<?php

namespace App\Command;

use App\Dto\Nomenclature\RequestQueryDto;
use App\Repository\NomenclatureRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'dd',
    description: 'Add a short description for your command',
)]
class DdCommand extends Command
{
    public function __construct(private NomenclatureRepository $repo)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        // $this
        //     ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
        //     ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        // ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $dto = new RequestQueryDto(1);
        $data = $this->repo->findAllNomenclatures($dto);
        dd($data);
        return Command::SUCCESS;
    }
}
