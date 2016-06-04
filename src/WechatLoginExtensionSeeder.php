<?php  namespace Deepdevelop\WechatLoginExtension;


use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Deepdevelop\WechatLoginExtension\WechatLoginSeeder;

class WechatLoginExtensionSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run()
    {
        $this->call(WechatLoginSeeder::class);
    }
}
