<?php

it('get users recent transactions', function () {
    $this->actingAs(createUser());

    // we make transactions for more than 10 different people
    for ($i = 1; $i < 10; $i++) {
        createTransaction();
    }

    $response = $this->get(route('users.recent-transactions'));

    // we should only get 3 of them
    $response->assertSuccessful()->assertJsonCount(3, 'data');
});
