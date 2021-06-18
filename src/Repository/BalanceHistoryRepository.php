<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class BalanceHistoryRepository extends EntityRepository
{
    public function getUserBalance(int $userId): ?float
    {
        $balanceHistories = $this
            ->createQueryBuilder('bh')
            ->where('bh.userId = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('bh.createdAt', 'DESC')
            ->getQuery()
            ->getResult();

        if (count($balanceHistories)) {
            $balanceHistory = array_shift($balanceHistories);

            return $balanceHistory->getBalance();
        }

        return null;
    }

    public function getHistory(int $limit): array
    {
        return $this
            ->createQueryBuilder('bh')
            ->orderBy('bh.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}