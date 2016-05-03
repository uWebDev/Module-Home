<?php

namespace App\Module\Home\Model;

use Dore\Core\Foundation\Model;
use Dore\Core\Exception\EnvironmentExceptions\NotExistsException;

/**
 * Class Category
 * @package App\Module\Home\Model
 */
class Category extends Model
{
    /** @var \PDO */
    protected $db;

    /**
     * Category constructor.
     *
     * @param \Violin\Contracts\ValidatorContract $db
     * @param                                     $validate
     */
    public function __construct($db, $validate)
    {
        parent::__construct($validate);
        $this->db = $db;
    }

    /**
     * @param $id
     *
     * @return mixed
     * @throws NotExistsException
     */
    public function data($id)
    {
        $sql = 'SELECT * FROM category WHERE id = ?';
        $STH = $this->db->prepare($sql);
        $STH->execute(array($id));
        if ($STH->rowCount() != 1) {
            throw new NotExistsException('No such category');
        }
        return $STH->fetch();
    }

    /**
     * @return array
     * @throws NotExistsException
     */
    public function allList()
    {
        $sql = 'SELECT category.*, COUNT(*) AS count FROM category'
            . ' JOIN article ON article.id_category = category.id GROUP BY category.id';
        $STH = $this->db->prepare($sql);
        if (!$STH->execute()) {
            throw new NotExistsException('Could not get a list of categories');
        }
        return $STH->fetchAll();
    }

}
