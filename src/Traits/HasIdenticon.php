<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Identicon.
 *
 * (c) Brian Faust <hello@basecode.sh>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Artisanry\Identicon\Traits;

use function Artisanry\Identicon\identicon;

trait HasIdenticon
{
    /** @var array */
    public $identicon = [
        'from' => 'email',
        'to'   => 'avatar',
    ];

    public static function bootHasIdenticon()
    {
        static::creating(function ($model) {
            $identicon = identicon($model->{$model->identicon['from']});
            $model->{$model->identicon['to']} = $identicon;
        });
    }

    public function generateIdenticon()
    {
        $identicon = identicon($this->{$this->identicon['from']});
        $this->{$this->identicon['to']} = $identicon;
        $this->save();
    }
}
