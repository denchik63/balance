<?php

namespace App\Service\Api;

use App\Entity\BalanceHistory;
use App\Model\BalanceHistory\User;

class BalanceHistoryMethod extends AbstractMethod
{
    public function getBalance(User $user): ?float
    {
        $this->validateObject($user);

        return $this->entityManager
            ->getRepository(BalanceHistory::class)
            ->getUserBalance($user->getId());
    }

    public function getHistory(int $limit): array
    {
        return $this->entityManager
            ->getRepository(BalanceHistory::class)
            ->getHistory($limit);
    }
}