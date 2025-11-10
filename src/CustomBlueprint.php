<?php

namespace OpenAdmin\Admin;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;

class CustomBlueprint extends Blueprint
{
    /**
     * Add the "user stamps" columns (created_by, updated_by, deleted_by) to the table.
     * @return \$columnIlluminate\Support\Collection
     */
    public function userStamps()
    {
        return new Collection([
            $this->unsignedBigInteger('created_by')->nullable(),
            $this->unsignedBigInteger('updated_by')->nullable()->after('created_by'),
            $this->unsignedBigInteger('deleted_by')->nullable()->after('updated_by'),
        ]);
    }
}