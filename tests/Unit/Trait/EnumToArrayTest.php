<?php

use Tests\Mock\SampleEnum;

it('can get enum to array', function () {
    $enums = SampleEnum::toArray();

    $this->assertEquals($enums, ['SampleCaseOne', 'SampleCaseTwo']);
});
