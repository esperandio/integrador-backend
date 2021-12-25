<?php

declare(strict_types=1);

namespace App\External\Repositories\PDO;

use PDO;
use PDOStatement;
use Exception;
use App\External\Repositories\PDO\Ports\PDOResultData;

class PDOHelper
{
    public function __construct(
        private PDO $pdoConnection
    ) {
    }

    /**
     * @param array<string, mixed> $bindParams
     * @return null|array<string, mixed>
     */
    public function fetch(string $sql, array $bindParams = []): ?array
    {
        $stmt = $this->pdoConnection->prepare($sql);

        if ($stmt == false) {
            throw new Exception("Database server cannot successfully prepare the statement!");
        }

        if (!empty($bindParams)) {
            $this->bindParams($stmt, $bindParams);
        }

        $success = $stmt->execute();

        if (!$success) {
            throw new Exception("Database server cannot successfully execute the statement!");
        }

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result == false) {
            return null;
        }

        return (array) $result;
    }

    /**
     * @param array<string, mixed> $bindParams
     */
    public function fetchResultDataInstance(
        string $pdoResultDataClass,
        string $sql,
        array $bindParams = []
    ): ?PDOResultData {
        $result = $this->fetch($sql, $bindParams);

        if (empty($result)) {
            return null;
        }

        /**
         * @var PDOResultData $resultDataInstance
         */
        $resultDataInstance = new $pdoResultDataClass(... $result);

        return $resultDataInstance;
    }

    /**
     * @param array<string, mixed> $bindParams
     * @return array<array<string, mixed>>
     */
    public function fetchAll(string $sql, array $bindParams = []): array
    {
        $stmt = $this->pdoConnection->prepare($sql);

        if ($stmt == false) {
            throw new Exception("Database server cannot successfully prepare the statement!");
        }

        if (!empty($bindParams)) {
            $this->bindParams($stmt, $bindParams);
        }

        $success = $stmt->execute();

        if (!$success) {
            throw new Exception("Database server cannot successfully execute the statement!");
        }

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result == false) {
            return [];
        }

        return (array) $result;
    }

    /**
     * @param array<string, mixed> $bindParams
     */
    public function command(string $sql, array $bindParams = []): void
    {
        $stmt = $this->pdoConnection->prepare($sql);

        if ($stmt == false) {
            throw new Exception("Database server cannot successfully prepare the statement!");
        }

        if (!empty($bindParams)) {
            $this->bindParams($stmt, $bindParams);
        }

        $success = $stmt->execute();

        if (!$success) {
            throw new Exception("Database server cannot successfully execute the statement!");
        }
    }

    public function tableRowsCount(string $tableName): int
    {
        $result = $this->pdoConnection->query('SELECT COUNT(*) as total FROM ' . $tableName);

        if ($result == false) {
            throw new Exception("Database server cannot successfully execute the statement!");
        }

        return (int) $result->fetchColumn();
    }

    /**
     * @param array<string, mixed> $bindParams
     */
    private function bindParams(PDOStatement $stmt, array $bindParams): void
    {
        foreach ($bindParams as $key => $value) {
            $pdoParam = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;

            $stmt->bindValue(':' . $key, $value, $pdoParam);
        }
    }
}
