<?php
namespace Psalm\Storage;

use Psalm\CodeLocation;
use Psalm\Internal\Analyzer\ClassLikeAnalyzer;
use Psalm\Type;

class PropertyStorage
{
    use CustomMetadataTrait;

    /**
     * @var ?bool
     */
    public $is_static;

    /**
     * @var int
     */
    public $visibility = 0;

    /**
     * @var CodeLocation|null
     */
    public $location;

    /**
     * @var CodeLocation|null
     */
    public $stmt_location;

    /**
     * @var CodeLocation|null
     */
    public $type_location;

    /**
     * @var CodeLocation|null
     */
    public $signature_type_location;

    /**
     * @var Type\Union|null
     */
    public $type;

    /**
     * @var Type\Union|null
     */
    public $signature_type;

    /**
     * @var Type\Union|null
     */
    public $suggested_type;

    /**
     * @var bool
     */
    public $has_default = false;

    /**
     * @var bool
     */
    public $deprecated = false;

    /**
     * @var bool
     */
    public $internal = false;

    /**
     * @var bool
     */
    public $readonly = false;

    /**
     * Whether or not to allow mutation by internal methods
     *
     * @var bool
     */
    public $allow_private_mutation = false;

    /**
     * @var null|string
     */
    public $psalm_internal = null;

    /**
     * @var ?string
     */
    public $getter_method = null;

    public function getInfo() : string
    {
        switch ($this->visibility) {
            case ClassLikeAnalyzer::VISIBILITY_PRIVATE:
                $visibility_text = 'private';
                break;

            case ClassLikeAnalyzer::VISIBILITY_PROTECTED:
                $visibility_text = 'protected';
                break;

            default:
                $visibility_text = 'public';
        }

        return $visibility_text . ' ' . ($this->type ? $this->type->getId() : 'mixed');
    }
}
