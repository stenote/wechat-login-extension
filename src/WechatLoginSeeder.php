<?php

namespace Deepdevelop\WechatLoginExtension;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Anomaly\PostsModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;

class WechatLoginSeeder extends Seeder
{
    /**
     * The field repository.
     *
     * @var FieldRepositoryInterface
     */
    protected $fields;

    /**
     * The streams repository.
     *
     * @var StreamRepositoryInterface
     */
    protected $streams;

    /**
     * The assignment repository.
     *
     * @var AssignmentRepositoryInterface
     */
    protected $assignments;

    /**
     * Create a new TypeSeeder instance.
     *
     * @param FieldRepositoryInterface      $fields
     * @param StreamRepositoryInterface     $streams
     * @param AssignmentRepositoryInterface $assignments
     */
    public function __construct(
        FieldRepositoryInterface $fields,
        StreamRepositoryInterface $streams,
        AssignmentRepositoryInterface $assignments
    ) {
        $this->fields = $fields;
        $this->streams = $streams;
        $this->assignments = $assignments;
    }

    /**
     * Run the seeder.
     */
    public function run()
    {
        $weixin_openid_field = $this->fields->create(
            [
                'namespace' => 'users',
                'name' => 'weixin_openid',
                'slug' => 'weixin_openid',
                'type' => 'anomaly.field_type.text',
            ]
        );

        $stream = $this->streams->findBySlugAndNamespace('users', 'users');

        $this->assignments->create(
            [
                'stream' => $stream,
                'field' => $weixin_openid_field,
            ]
        );
    }
}
