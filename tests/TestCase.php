<?php
namespace Tests;

use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Feature\Concerns\AttachmentsConcerns;
use Tests\Feature\Concerns\MaterialConcern;
use Tests\Feature\Concerns\UserConcerns;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use InteractsWithDatabase;
    use UserConcerns;
    use MaterialConcern;
    use AttachmentsConcerns;
}
