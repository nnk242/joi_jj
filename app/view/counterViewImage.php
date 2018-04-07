<?php

namespace App\View;

use App\Images;
use Illuminate\Session\Store;

class counterViewImage
{
    private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function handle(Images $images)
    {
        if (!$this->isPostViewed($images)) {
            $images->increment('view');
            $this->storePost($images);
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