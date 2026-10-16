<?php

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\LazyCollection;

use function PHPStan\Testing\assertType;

/** @implements Arrayable<int, User> */
class UserList implements Arrayable
{
    public function toArray(): array
    {
        return [new User];
    }
}

/**
 * @param  Arrayable<int, Model>  $models
 * @return Arrayable<int, Model>
 */
function acceptsModels(Arrayable $models): Arrayable
{
    return $models;
}

assertType('Illuminate\Contracts\Support\Arrayable<int, Illuminate\Database\Eloquent\Model>', acceptsModels(collect([new User])));
assertType('Illuminate\Contracts\Support\Arrayable<int, Illuminate\Database\Eloquent\Model>', acceptsModels(new LazyCollection([new User])));
assertType('Illuminate\Contracts\Support\Arrayable<int, Illuminate\Database\Eloquent\Model>', acceptsModels(new UserList));
