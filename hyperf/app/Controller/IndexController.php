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
namespace App\Controller;

use App\Job\FooJob;

class IndexController extends Controller
{
    public function index()
    {
        queue_push(new FooJob(true));
        queue_push(new FooJob(false));
        return $this->response->success('Hello World.');
    }
}
