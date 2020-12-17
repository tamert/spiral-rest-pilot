<?php
/**
 * {project-name}
 *
 * @author {author-name}
 */
declare(strict_types=1);

namespace App\Database;

use Cycle\Annotated\Annotation as Cycle;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Cycle\Entity(repository = "App\Repository\NewsRepository")
 */

/**
 * @Cycle\Entity()
 */
class News
{
    /**
     * @Cycle\Column(type = "primary")
     */
    public $id;

    /**
     * @Cycle\Column(type = "string")
     */
    public $title;

    /**
     * @Cycle\Column(type = "text")
     */
    public $content;

    /**
     * @Cycle\Relation\BelongsTo(target = "User", nullable = false)
     * @var User
     */
    public $author;

    /**
     * @Cycle\Relation\HasMany(target = "Comment")
     * @var ArrayCollection|Comment
     */
    public $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }
}
