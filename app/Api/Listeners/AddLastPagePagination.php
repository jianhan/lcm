<?php

namespace App\Api\Listeners;

use Dingo\Api\Event\ResponseWasMorphed;

class AddLastPagePagination
{
    public function handle(ResponseWasMorphed $event)
    {
        if (isset($event->content['meta']['pagination'])) {
            $event->content['meta']['pagination']['last_page'] = $event->content['meta']['pagination']['total_pages'];
        }
    }
}