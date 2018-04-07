<?php

namespace App\View;

use App\Groups;
use Illuminate\Session\Store;
use App\Views;

class counterView
{
    private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function handle(Groups $groups)
    {
        if (!$this->isPostViewed($groups)) {
            $groups->increment('view');
            $this->storePost($groups);
        }
    }

    private function isPostViewed($post)
    {
        $viewed = $this->session->get('viewed_posts', []);

        return array_key_exists($post->id, $viewed);
    }

    private function storePost($post)
    {
        $key = 'viewed_posts.' . $post->id;

        $this->session->put($key, time());
    }
}