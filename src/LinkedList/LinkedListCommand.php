<?php declare(strict_types=1);

namespace App\LinkedList;

use App\LinkedList\Exceptions\LinkedListIsNotAlphabetic;
use App\LinkedList\Exceptions\LinkedListIsNotInteger;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

#[AsCommand(name: 'app:linked-list')]
final class LinkedListCommand extends Command
{
    protected function configure(): void
    {
        $this->setDescription('Sorts a list of integers or alphabetic character(s).');
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $list = new LinkedList();

        do {
            $isFinish = false;

            try {
                $value = $this->getQuestionValue($input, $output);

                if ($value === null) {
                    $isFinish = true;
                } else {
                    $list->addValue($value);
                }
            } catch (LinkedListIsNotInteger|LinkedListIsNotAlphabetic $exception) {
                $output->writeln($exception->getMessage());
                continue;
            }
        } while (!$isFinish);

        $values = $list->getValues();

        if ($values) {
            $output->writeln(sprintf("Sorted list: %s", implode(' ', $values)));
        } else {
            $output->writeln('Sorted list is empty.');
        }

        return Command::SUCCESS;
    }


    protected function getQuestionValue(InputInterface $input, OutputInterface $output): int|string|null
    {
        $value = $this->ask($input, $output);

        if ($value === null) {
            return null;
        }

        if (is_numeric($value)) {
            if (ctype_digit($value)) {
                return (int) $value;
            }

            throw new LinkedListIsNotInteger();
        }

        if (ctype_alpha($value)) {
            return (string) $value;
        }

        throw new LinkedListIsNotAlphabetic();
    }


    protected function ask(InputInterface $input, OutputInterface $output): mixed
    {
        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');
        $question = new Question('Enter an integer or an alphabetic character(s) (or leave blank to finish): ');

        return $helper->ask($input, $output, $question);
    }
}
