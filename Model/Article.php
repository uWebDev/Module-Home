<?php

namespace App\Module\Home\Model;

use Dore\Core\Foundation\Model;
use Dore\Core\Exception\EnvironmentExceptions\NotExistsException;

/**
 * Class Article
 * @package App\Module\Home\Model
 */
class Article extends Model
{
    /** @var \PDO  */
    private $db;

    /**
     * Article constructor.
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
     * Извлекаем данные о статье
     * @param $id
     *
     * @return mixed
     * @throws NotExistsException
     */
    public function data($id)
    {
        $sql = 'SELECT IFNULL((SELECT COUNT(*) FROM `article` WHERE id < :id AND id_category = category.id ORDER BY id DESC LIMIT 1), NULL) AS `pagination`, IFNULL((SELECT id FROM `article` WHERE id < :id AND id_category = category.id ORDER BY id DESC LIMIT 1), NULL) AS `previous`, IFNULL((SELECT id FROM `article` WHERE id > :id AND id_category = category.id ORDER BY id ASC LIMIT 1), NULL) AS `next`, article.*, category.title AS name FROM article JOIN category WHERE article.id = :id AND article.id_category = category.id';
        $STH = $this->db->prepare($sql);
        $STH->execute(array('id' => $id));
        if ($STH->rowCount() != 1) {
            throw new NotExistsException('No such article');
        }
        return $STH->fetch();
    }

    /**
     * @param $idCategory
     * @param $title
     * @param $description
     *
     * @return bool
     * @throws NotExistsException
     */
    public function add($idCategory, $title, $description)
    {
        $sql = 'INSERT INTO article (id_category, title, description, time_creation) VALUES (?, ?, ?, ?)';
        $STH = $this->db->prepare($sql);
        $STH->execute(array($idCategory, $title, $description, time()));
        if (!$STH) { //TODO
            throw new NotExistsException('Unable to add');
        }
        return true;
    }

    /**
     * @return boolean
     * @throws NotExistsException
     */
    public function edit()
    {
        $sql = '';
        $STH = $this->db->prepare($sql);
        $STH->execute();
        if (!$STH) {
            throw new NotExistsException('Failed to update the article');
        }
        return true;
    }

    /**
     * @return boolean
     * @throws NotExistsException
     */
    public function del()
    {
        $sql = '';
        $STH = $this->db->prepare($sql);
        $STH->execute();
        if (!$STH) {
            throw new NotExistsException('Failed to delete Article');
        }
        return true;
    }

    /**
     * @param        $idCategory
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     *
     * @return mixed
     * @throws NotExistsException
     */
    public function listInCategory($idCategory, $start = 0, $limit = 10, $sort = 'time_creation')
    {
        $sql = 'SELECT * FROM `article` WHERE `id_category` = ? GROUP BY ' . $sort . ' LIMIT ?, ?';
        $STH = $this->db->prepare($sql);
        $STH->bindParam(1, $idCategory, \PDO::PARAM_INT);
        $STH->bindParam(2, $start, \PDO::PARAM_INT);
        $STH->bindParam(3, $limit, \PDO::PARAM_INT);
        $STH->execute();
        if ($STH->rowCount() < 1) {
            throw new NotExistsException('No articles in this category');
        }
        return $STH->fetchAll();
    }

    /**
     * @param $idCategory
     *
     * @return int
     */
    public function countInCategory($idCategory)
    {
        $sql = 'SELECT COUNT(*) AS `count` FROM `article` WHERE `id_category` = ?';
        $STH = $this->db->prepare($sql);
        $STH->execute(array($idCategory));
        return (int)$STH->fetch(\PDO::FETCH_OBJ)->count;
    }

}
