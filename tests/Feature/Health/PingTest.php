<?php

it('can ping health', function () {
    $response = $this->get(route('health.ping'));

    $response->assertSuccessful();
});
