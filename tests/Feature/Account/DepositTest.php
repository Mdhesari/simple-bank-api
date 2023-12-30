<?php

use App\Events\TransactionCreated;
use Illuminate\Support\Facades\Event;

it('can user deposit to another user', function () {
    $srcUser = createUser();
    $dstUser = createUser();

    $this->actingAs($srcUser);

    // make sure we have enough balance
    $srcCard = $srcUser->creditCards()->first();
    $srcCard->account->update([
        'quantity' => 23000,
    ]);

    Event::fake(TransactionCreated::class);

    $response = $this->post(route('account.deposit'), [
        'src_card_number' => $srcCard->card_number,
        'dst_card_number' => $dstUser->creditCards()->first()->card_number,
        'quantity'        => 23000,
    ]);

    $response->assertSuccessful();

    Event::assertDispatched(TransactionCreated::class);
});

it('cannot user deposit to another user with low balance', function () {
    $srcUser = createUser();
    $dstUser = createUser();

    $this->actingAs($srcUser);

    $srcCard = $srcUser->creditCards()->first();
    $srcCard->account->update([
        'quantity' => 1000,
    ]);

    $response = $this->post(route('account.deposit'), [
        'src_card_number' => $srcCard->card_number,
        'dst_card_number' => $dstUser->creditCards()->first()->card_number,
        'quantity'        => 23000,
    ]);

    $response->assertJsonValidationErrors([
        'src_card_number' => __('validation.card_enough_balance')
    ]);
});

it('cannot user deposit to another user with invalid dst card number', function () {
    $srcUser = createUser();

    $this->actingAs($srcUser);

    // make sure we have enough balance

    $response = $this->post(route('account.deposit'), [
        'src_card_number' => $srcUser->creditCards()->first()->card_number,
        'dst_card_number' => '123234', // invalid
        'quantity'        => 23000,
    ]);

    $response->assertJsonValidationErrors([
        'dst_card_number' => __('validation.ir_credit_card')
    ]);
});
