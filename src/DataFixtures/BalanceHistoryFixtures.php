<?php

namespace App\DataFixtures;

use App\Entity\BalanceHistory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BalanceHistoryFixtures extends Fixture
{
    /** @var ObjectManager */
    private $entityManager;

    public function load(ObjectManager $manager): void
    {
        $this->entityManager = $manager;

        for ($i = 0; $i < 20; $i++) {
            $userId = $i + 1;
            $previousBalanceHistory = $this->createBalanceHistoryItem($userId, 0.0);
            sleep(1);
            $previousBalanceHistory = $this->createBalanceHistoryItem($userId, (float)random_int(1, 10000), $previousBalanceHistory);
            sleep(1);
            $this->createBalanceHistoryItem($userId, (float)random_int(1, 10000) * -1, $previousBalanceHistory);
            sleep(1);
        }

        $this->entityManager->flush();
    }

    private function createBalanceHistoryItem(int $userId, float $value, ?BalanceHistory $previousBalanceHistory = null): BalanceHistory
    {
        $previousBalance = 0.0;
        if (null !== $previousBalanceHistory) {
            $previousBalance = $previousBalanceHistory->getBalance();
        }
        $balanceHistory = new BalanceHistory();
        $balanceHistory->setValue($value);
        $balanceHistory->setBalance($previousBalance + $value);
        $balanceHistory->setUserId($userId);
        $this->entityManager->persist($balanceHistory);

        return $balanceHistory;
    }
}
