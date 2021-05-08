<?php

use App\Http\Controllers\Users\ProfileController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class DeleteAvatarTest extends \Codeception\Test\Unit
{
    /**
     * @var \FunctionalTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testDeleteTempAvatarFunction()
    {
        $fileName = 'temp_avatar_' . Carbon::now() . '.tmp';
        $fileName = str_replace([':', '\\'], '_', $fileName);
        $path = 'public/images/avatars';
        Storage::copy($path . '/default_avatar.jpg', $path . '/' . $fileName);
        $pattern = '.tmp';
        $files = collect(Storage::allFiles($path))->filter(function ($f) use ($pattern) {
            return str_contains($f, $pattern);
        });
        $count = $files->count();
        $this->assertTrue($count >= 1);
        $pc = new ProfileController();
        $pc->deleteTempAvatars($path, $pattern);
        $files = collect(Storage::allFiles($path))->filter(function ($f) use ($pattern) {
            return str_contains($f, $pattern);
        });
        $count = $files->count();
        $this->assertTrue($count == 0);
    }
}
