<?php

it('health ping', function () {
    $response = $this->get(route('health.ping'));

    $response->assertSuccessful();
});
