<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Job;

use App\Model\Test;
use Hyperf\AsyncQueue\Job;
use Hyperf\DbConnection\Db;
use Hyperf\Utils\Coroutine;

class FooJob extends Job
{
    public function __construct(public bool $throw)
    {
    }

    public function handle()
    {
        Db::beginTransaction();
        try {
            var_dump(Coroutine::id());
            $model = new Test();
            $model->name = uniqid();
            $model->save();
            $this->throw && throw new \Exception('xxx');
            Db::commit();
        } catch (\Throwable $exception) {
        }
    }
}
