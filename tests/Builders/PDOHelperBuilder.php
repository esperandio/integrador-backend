<?php

declare(strict_types=1);

namespace Test\Builders;

use App\External\Repositories\PDO\PDOHelper;

class PDOHelperBuilder
{
    private PDOHelper $helper;

    private function __construct(string $dsn)
    {
        $this->helper = new PDOHelper(new \PDO($dsn));
    }

    public static function aHelper(string $dsn = 'sqlite::memory:'): PDOHelperBuilder
    {
        return new PDOHelperBuilder($dsn);
    }

    public function withUsersTable(): PDOHelperBuilder
    {
        $this->helper->command('DROP TABLE IF EXISTS users');
        $this->helper->command('
            CREATE TABLE users (
                id integer NOT NULL,
                ds_email varchar(100) NOT NULL,
                ds_password varchar(100) NOT NULL,
                group_id int DEFAULT NULL,
                PRIMARY KEY (id)
            )
        ');

        return $this;
    }

    public function withGroupsTable(): PDOHelperBuilder
    {
        $this->helper->command('DROP TABLE IF EXISTS groups');
        $this->helper->command('
            CREATE TABLE groups (
                id integer,
                nm_group varchar(50) NOT NULL,
                nr_milliseconds_idle_time int DEFAULT NULL,
                ds_role_key varchar(15) DEFAULT NULL,
                PRIMARY KEY (id)
            )
        ');

        return $this;
    }

    public function build(): PDOHelper
    {
        return $this->helper;
    }
}
